<?php # header.html
// This page begins the HTML header for the site.
/* This script:
* - starts the HTML template
* - indicates the encoding using header()
* - starts the session
*/

// Indicate the encoding:
header('Content-Type: text/html; charset=UTF-8');

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
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
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
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/index-header-style.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
</head>

<body>

	<!-- Navbar-->
	<div class="navbar index_navbar navbar-expand-lg fixed-top scrollable-menu nav-color index_header">
		<div class="container scrollable-menu">

			<a href="index.php" class="navbar-brand index_navbar-brand navbar_brand font-italic h3-responsive"><img src="logo/logo.png" alt="Emusic"> <span class="sr-only">
					<?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo '(current)'; ?></span></a>

			<button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" role="menubar">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav scrollable-menu ml-auto index_header">
					<li class="nav-item index_nav-item"><a href="index.php" class="nav-link index_nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>">Home</a></li>
					<li class="nav-item index_nav-item"><a href="about.php" class="nav-link index_nav-link">About</a></li>
					<?php if (basename($_SERVER['PHP_SELF']) != 'contactUs.php')
						echo '<li class="nav-item index_nav-item"><a href="contactUs.php" class="nav-link index_nav-link">Contact Us</a></li>';
					?>
				</ul>
			</div>

		</div>
	</div>

	<!--End Navbar-->