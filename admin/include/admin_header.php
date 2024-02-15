<?php
// This is the admin page for this site
// Start output buffering:
ob_start();

// Initialize a session:
session_start();
require_once('../obaEddie_connect.php');
require_once('../include/config.inc.php');

require '../vendor/autoload.php';

use Carbon\Carbon;

// Purify plugin
//$dbcon->set_charset("utf8mb4");
require_once '../HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

require_once('../include/userTZ.php');
require_once('process_admin_index.php');

//$adminUser_id = $_SESSION['user_id'];
if ($_SESSION['user_id'] != $adminUser_id && $_SESSION['user_level'] != $admin_userLevel) {
	redirect_user("../login_register.php");
	exit();
}

$userNoti = 0;
$msgNoti = 0;

////////////////////////////  Query notification table for notification number ////////////////////////////
$query_userNoti = mysqli_query($dbcon, "SELECT user_id FROM users WHERE new_user='yes'");
// Check the result:
$Unread_userNoti = mysqli_num_rows($query_userNoti);
$userNoti = $userNoti + $Unread_userNoti;

////////////////////////////  Query notification_msg table for notification number ////////////////////////////
$query_msgReply = mysqli_query($dbcon, "SELECT * FROM admin_msg_reply WHERE opened='no'");
// Check the result:
$unread_msgReply = mysqli_num_rows($query_msgReply);
$msgNoti = $msgNoti + $unread_msgReply;

$query_contactUs_msg = mysqli_query($dbcon, "SELECT * FROM contact_us WHERE opened='no'");
// Check the result:
$unread_contactUsMsg = mysqli_num_rows($query_contactUs_msg);
$msgNoti = $msgNoti + $unread_contactUsMsg;

if ($userNoti == 0) {
	$userNoti = "";
}

if ($Unread_userNoti == 0) {
	$Unread_userNoti = "";
}

if ($msgNoti == 0) {
	$msgNoti = "";
}
if ($unread_msgReply == 0) {
	$unread_msgReply = "";
}
if ($unread_contactUsMsg == 0) {
	$unread_contactUsMsg = "";
}

if (!isset($page_title)) {
	$page_title = "Admin || Emusic";
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
	<link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
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
	<!-- Jqery user interface css for taginput -->
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="../css/jquery.tagsinput-revisited.min.css" />
	<!-- Fontawesome -->
	<link rel="stylesheet" href="../css/fontawesome.min.css">
	<!-- Text Editor plugin -->
	<link href="../css/linceControlTextEditor.css" type="text/css" rel="stylesheet" />
	<!-- Perfect scrollbar -->
	<link rel="stylesheet" href="../css/perfect-scrollbar.css">
	<!-- Style CSS -->
	<link rel="stylesheet" href="css/admin-style.css">
	<!-- Multiselect plugin -->
	<link rel="stylesheet" href="../css/bootstrap-multiselect.min.css" type="text/css" />
	<!-- Select2 plugin -->
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-center" href="index.php">Emusic</a>
		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<li class="nav-item text-nowrap list-inline-item">
			<a class="nav-link msgNotiLink" href=""><?php if (!empty($msgNoti)) echo "<span class='badge badge-pill d-none d-md-block d-lg-none msgTabNoti'>$msgNoti</span>
      <span class='badge badge-pill d-none d-lg-block msgPcNoti'>$msgNoti</span>"; ?>
				<i class="fas fa-envelope"></i></a>
		</li>
		<li class="nav-item text-nowrap list-inline-item">
			<a class="nav-link userNotiLink" href=""><?php if (!empty($userNoti)) echo "<span class='badge badge-pill d-none d-md-block d-lg-none userTabNoti'>$userNoti</span>
      <span class='badge badge-pill d-none d-lg-block userPcNoti'>$userNoti</span>"; ?>
				<i class="far fa-user"></i></a>
		</li>
		<li class="nav-item text-nowrap list-inline-item">
			<a class="nav-link" href="logout.php">Sign out</a>
		</li>
	</nav>