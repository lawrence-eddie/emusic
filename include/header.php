<?php # header for emusic web app
// This page begins the HTML header for the site.
/* This script:
* - starts the HTML template
* - indicates the encoding using header()
* - starts the session
*/
require_once('obaEddie_connect.php');
// Indicate the encoding:
header('Content-Type: text/html; charset=UTF-8');
require_once('process_account.php');

require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

if (isset($_SESSION['user_id'])) {
	$user_id  = $_SESSION['user_id'];

	///////////////// Check for user names: /////////////////////////////////
	$names = mysqli_query($dbcon, "SELECT first_name, last_name, gender FROM users WHERE user_id=$user_id");
	// Check the result:
	if (mysqli_num_rows($names) == 1) {
		// fetch the records
		$fetch_names = mysqli_fetch_assoc($names);
		$first_name = $purifier->purify($fetch_names['first_name']);
		$last_name   = $purifier->purify($fetch_names['last_name']);
		$gender = $purifier->purify($fetch_names['gender']);
		mysqli_free_result($names);
		//   $middle_name = $middle_name == NULL || "" ? '' : $middle_name;
		//   $user_full_name = $first_name.' '.$middle_name.' '.$last_name;
	}

	/////////////////////////// Add default image to new users ////////////////////////////
	$default_pic = mysqli_query($dbcon, "SELECT profile_pic FROM user_info WHERE user_id=$user_id");
	if (mysqli_num_rows($default_pic) == 0) {
		if ($gender == "male") {
			$set_default_pic = mysqli_query($dbcon, "INSERT INTO user_info (user_id, profile_pic) VALUES ($user_id, 'img/male.jpg')");
		} else {
			$set_default_pic = mysqli_query($dbcon, "INSERT INTO user_info (user_id, profile_pic) VALUES ($user_id, 'img/female.jpg')");
		}
	}
	mysqli_free_result($default_pic);

	////////////////////////////  Query the user_info table ////////////////////////////
	$user_info = mysqli_query($dbcon, "SELECT profile_pic FROM user_info WHERE user_id=$user_id");
	// Check the result:
	if (mysqli_num_rows($user_info) == 1) {
		// fetch the records
		$fetch_info = mysqli_fetch_assoc($user_info);
		$profile_pic   = $purifier->purify($fetch_info['profile_pic']);
	}
	mysqli_free_result($user_info);
}

if (!isset($page_title)) {
	$page_title = 'Emusic';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $page_title; ?></title>
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="logo/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="logo/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="logo/favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
	<!--<link rel="shortcut icon" href="img/favicon.ico">-->
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
	<!--[if IE 9]>
  	<link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie9.min.css" rel="stylesheet">
		<![endif]-->
	<!--[if lte IE 8]>
  	<link href="https://cdn.jsdelivr.net/gh/coliff/bootstrap-ie8/css/bootstrap-ie8.min.css" rel="stylesheet">
  	<script src="https://cdn.jsdelivr.net/g/html5shiv@3.7.3"></script>
		<![endif]-->
	<!-- Slick CSS-->
	<link rel="stylesheet" type="text/css" href="slick/slick.css" />
	<!-- Add the new slick-theme.css if you want the default styling-->
	<link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
	<!-- AOS style sheet-->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- Fontawesome -->
	<link rel="stylesheet" href="css/fontawesome.min.css">
	<!-- Calamansi audio plugin JS-->
	<link rel="stylesheet" href="css/calamansi.min.css">
	<!-- Video background plugin JS-->
	<?php if (basename($_SERVER['PHP_SELF']) == 'about.php') echo '
		<link rel="stylesheet" href="css/video.bacground.min.css">'; ?>
	<!-- Scrollbar CSS -->
	<!-- <link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css"> -->
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="https://malihu.github.io/custom-scrollbar/mCSB_buttons.png">
	<!-- Element.js -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelementplayer.min.css" />
	<!-- yBox image lightbox popup -->
	<?php if (basename($_SERVER['PHP_SELF']) == 'post.php') echo '
		<link href="css/baguetteBox.min.css" rel="stylesheet"/>'; ?>
	<!-- Login form -->
	<link href="css/app-login-register.css" rel="stylesheet" />
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

	<script type="text/javascript">
		/// some script

		// jquery ready start
		document.addEventListener('DOMContentLoaded', function() {
			// jQuery code
			$("[data-trigger]").on("click", function(e) {
				e.preventDefault();
				e.stopPropagation();
				var offcanvas_id = $(this).attr('data-trigger');
				$(offcanvas_id).toggleClass("show");
				$('body').toggleClass("offcanvas-active");
				$(".screen-overlay").toggleClass("show");
			});

			// Close menu when pressing ESC
			$(document).on('keydown', function(event) {
				if (event.keyCode === 27) {
					$(".mobile-offcanvas").removeClass("show");
					$("body").removeClass("overlay-active");
				}
			});

			$(".btn-close, .screen-overlay").click(function(e) {
				$(".screen-overlay").removeClass("show");
				$(".mobile-offcanvas").removeClass("show");
				$("body").removeClass("offcanvas-active");
			});

			/*
		   Hamburger Menu button
		  */
			function animatedMenu(x) {
				x.classList.toggle("animeOpenClose");
			}
			// to identify the element HTML that activate the menu
			var $menuBtn = document.getElementById('btn-hamburger');
			$("#btn-hamburger, .screen-overlay").click(function(e) {
				animatedMenu($menuBtn);
				e.preventDefault();
			});

		}); // jquery end
	</script>

	<style type="text/css">
		body.offcanvas-active {
			overflow: hidden;
		}

		.offcanvas-header {
			display: none;
		}

		.screen-overlay {
			width: 0%;
			height: 100%;
			z-index: 30;
			position: fixed;
			top: 0;
			left: 0;
			opacity: 0;
			visibility: hidden;
			background-color: rgba(34, 34, 34, 0.6);
			transition: opacity .2s linear, visibility .1s, width 1s ease-in;
		}

		.screen-overlay.show {
			transition: opacity .5s ease, width 0s;
			opacity: 1;
			width: 100%;
			visibility: visible;
		}

		@media all and (max-width:992px) {
			.offcanvas-header {
				display: block;
			}

			.mobile-offcanvas {
				visibility: hidden;
				transform: translateX(-100%);
				border-radius: 0;
				display: block;
				position: fixed;
				top: 0;
				left: 0;
				height: 100%;
				z-index: 1200;
				width: 80%;
				overflow-y: scroll;
				overflow-x: hidden;
				transition: visibility .2s ease-in-out, transform .2s ease-in-out;
			}

			.mobile-offcanvas.show {
				visibility: visible;
				transform: translateX(0);
			}
		}

		/* hamburger button */
		#btn-hamburger {
			border: none;
			outline: 0;
			background: black;
			border-radius: 5px;
			padding: 0.6em;
			cursor: pointer;
		}

		#btn-hamburger .line-1,
		#btn-hamburger .line-2,
		#btn-hamburger .line-3 {
			width: 22px;
			height: 2px;
			background-color: rgba(95, 251, 241, 1);
			margin: 4px 0;
			transition: 0.4s;
		}

		#btn-hamburger.animeOpenClose .line-1 {
			transform: rotate(-45deg) translate(-5px, 4px);
		}

		#btn-hamburger.animeOpenClose .line-2 {
			opacity: 0;
		}

		#btn-hamburger.animeOpenClose .line-3 {
			transform: rotate(45deg) translate(-4px, -4px);
		}

		#search_emusic {
			width: 130px !important;
			-webkit-transition: width 0.4s ease-in-out;
			transition: width 0.4s ease-in-out;
		}

		/* When the input field gets focus, change its width to 80% */
		#search_emusic:focus {
			width: 80% !important;
		}
	</style>
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function() {
			var emusicSearch_form = $("#emusicSearch-form");
			var search_emusic = $("#search_emusic");
			$("#emusicSearch-form").on('submit', function(e) {
				if (!$.trim(search_emusic.val()).length < 1) {
					emusicSearch_form.submit();
				} else {
					//stop form submission
					e.preventDefault();
				}
			});
		});
	</script>
</head>

<body class="bg-light">
	<b class="screen-overlay"></b>
	<div class="container-lg hamburger-container d-lg-none">
		<button id="btn-hamburger" data-trigger="#navbar_main" class="d-lg-none float-right">
			<div class="line-1"></div>
			<div class="line-2"></div>
			<div class="line-3"></div>
		</button>
		<a href="index.php" class="navbar-brand index_navbar-brand navbar_brand font-italic d-lg-none mx-auto">
			<img src="logo/logo.png" alt="eMusic" class="content-justify-center mx-auto"> <span class="sr-only">
				<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo '(current)'; ?></span></a>
		<!-- <button data-trigger="#card_mobile" class="d-lg-none btn btn-warning" type="button">  Show card </button> -->
	</div>

	<nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg scrollable-menu">

		<div class="offcanvas-header">
			<a href="index.php" class="navbar-brand index_navbar-brand navbar_brand font-italic h3-responsive d-lg-none">
				<img src="logo/logo.png" alt="eMusic"> <span class="sr-only">
					<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo '(current)'; ?></span></a>
			<!-- <h5 class="py-2 text-white">Main navbar</h5> -->
		</div>
		<div class="container-lg">
			<a href="index.php" class="navbar-brand index_navbar-brand navbar_brand font-italic h3-responsive d-none d-lg-block">
				<img src="logo/logo.png" alt="eMusic"> <span class="sr-only">
					<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo '(current)'; ?></span></a>
			<ul class="navbar-nav mx-lg-auto">
				<li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>" href="index.php"> Home </a></li>
				<li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'allSongs.php') echo 'active'; ?>" href="allSongs.php"> Songs </a></li>
				<li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'allVideo.php') echo 'active'; ?>" href="allVideo.php"> Videos </a></li>
				<li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'allAlbum.php') echo 'active'; ?>" href="allAlbum.php"> Albums </a></li>
				<li class="nav-item"><a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'news.php') echo 'active'; ?>" href="news.php"> News </a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> More</a>
					<ul class="dropdown-menu bg-transparent emusicNavbar-dropdown float-left mb-3 animate slideIn">
						<?php
						if (isset($_SESSION['user_id'])) {
							echo "<li class='dropdown-item img-dropdown-item'><h6 class='text-center card-subtitle mb-3 text-primary'>$first_name</h6>
							<div id='profile-resume' class='card m-0 p-0 bg-transparent border-0'>
							<img src='$profile_pic' class='card-img card-img-top rounded-circle mx-auto' alt='$first_name's profile picture' title='$first_name's profile picture'/>
							<div class='card-img-overlay position-relative profile_pic m-0 p-0'>
								<form class='m-0 p-0' action='" . $_SERVER['PHP_SELF'] . "' method='post' enctype='multipart/form-data'>
									<label class='upload_image rounded-circle border border-light' for='my-file-selector'>
										<input type='hidden' name='MAX_FILE_SIZE' value='1048576'>
										<input id='my-file-selector' type='file' class='d-none' name='upload_image' onchange='javascript:this.form.submit();'>
										<img class='' src='img/camera.svg' alt='Upload profile image' width='28' height='28' title='Upload profile image'>
									</label>
								</form>";
							echo '</div></div></li>';
							echo '<li><a class="dropdown-item text-primary" href="about.php">About</a></li>
							<li><a class="dropdown-item text-primary" href="contactUs.php">Contact us</a></li>
							<li><div class="dropdown-divider"></div></li>
							<li><a class="dropdown-item text-primary" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a></li>';
						} else {
							echo '<li><a class="dropdown-item text-primary" href="about.php">About</a></li>
							<li><a class="dropdown-item text-primary" href="login_register.php"><i class="fas fa-sign-in-alt"></i> Log In</a></li>
							<li><div class="dropdown-divider"></div></li>
							<li><a class="dropdown-item text-primary" href="login_register.php?signUp=#signUp"><i class="fas fa-user-plus"></i> Sign Up</a></li>';
						}
						?>
					</ul>
				</li>
				<li class="nav-item">
					<form class="my-auto pt-lg-1" action="search.php" method="get" accept-charset="utf8" spellcheck="true" id="emusicSearch-form">
						<!-- <input class="border-info bg-transparent float-right my-auto align-middle form-control form-control-sm"
							id="search_emusic" type="text" name="search" placeholder="Search..."> -->
						<!-- <a class="search_icon" type="submit"><i class="fas fa-search"></i></a> -->
						<div class="input-group">
							<input type="text" class="border-info bg-transparent float-right my-auto align-middle form-control form-control-sm" placeholder="Search..." name="search" aria-label="Search" aria-describedby="search-button-addon" id="search_emusic">
							<div class="input-group-append">
								<button class="btn btn-sm btn-outline-info" id="search-button-addon"><i class="fas fa-search"></i></button>
							</div>
						</div>
					</form>
				</li>
			</ul>
		</div>
	</nav>

	<?php
	if (isset($image_error)) {
		echo "<div class='alert alert-danger fade show' role='alert' id='image_error'>$image_error</div>";
		echo '<script type="text/javascript">
				window.setTimeout(function() {
				$("#image_error").fadeTo(500, 0).slideUp(500, function(){
					$("#image_error").alert("close");
				});
				}, 5000);
			</script>';
	}
	?>