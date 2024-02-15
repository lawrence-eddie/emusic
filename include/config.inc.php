<?php # config.inc.php
/* This script:
 * - define constants and settings
 * - dictates how errors are handled
 * - defines useful functions
 */

// Document who created this site, when, why, etc.


/* This function determines an absolute URL and redirects the user there.
 * The function takes one argument: the page to be redirected to.
 * The argument defaults to index.php.
 */

//error_reporting(0);
require_once('include/session_cookie.php');


function redirect_user($page = 'index.php')
{

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');

	// Add the page:
	$url .= '/' . $page;

	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.

function sanitizeString($var)
{
	// global $dbcon;
	$var = strip_tags($var);
	$var = htmlentities($var);
	// if (get_magic_quotes_gpc())
	$var = stripslashes($var);
	// if (function_exists('get_magic_quotes_gpc')) {
	// 	if (get_magic_quotes_gpc()) $var = stripslashes($var);
	// } else {
	// 	$var = stripslashes($var);
	// }
	//return mysqli_real_escape_string($dbcon,$var);
	return $var;
}

// Function to remove a directory and all its content
function removeDir($dir)
{
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir . "/" . $object) == "dir") removeDir($dir . "/" . $object);
				else unlink($dir . "/" . $object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
} // End of remove directory function



// ********************************** //
// ************ SETTINGS ************ //

// Admin Details
$adminUser_id = 2;
$admin_userLevel = 71;
$admin_email = "lawrence.eddie@hotmail.com";
$adminPicture = "logo/logo.png";
$logo = $adminPicture;

// Flag variable for site status:
define('LIVE', FALSE);

// Admin contact address:
define('ADMIN_EMAIL', 'lawrenceeddie555@gmail.com');

// Site URL (base for all redirections):
//define('BASE_URL', 'http://www.example.com/');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . '/' . 'emusic/');
// Use redirect_user function instead

// Location of the MySQL connection script:
//define('MYSQL', '../mysqli_connect.php');

// Adjust the time zone for PHP 5.1 and greater:
//date_default_timezone_set('America/New_York');

//================ Notification Post Header Table =====================//
$adminPost_header = "Admin post";
$newApp_header = "New app";
$newMusic_header = "New music";

//================ Notification Post Description Table ====================//
$adminPost_description = "New post has been added.";
$newApp_description = "New app has been added.";
$newMusic_description = "New music alert!";

//================ Notification Messages Header Table ======================//
$adminNotiMsg_header = "Admin message";

//================ Notification Messages Description Table ====================//
$adminNotiMsg_description = "You have a new message from admin!";

// ************ SETTINGS ************ //
// ********************************** //


// ****************************************** //
// ************ ERROR MANAGEMENT ************ //

// Create the error handler:
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars)
{

	// Build the error message:
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";

	// Add the date and time:
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";

	if (!LIVE) { // Development (print the error).

		// Show the error message:
		echo '<div class="error">' . nl2br($message);

		// Add the variables and a backtrace:
		echo '<pre>' . print_r($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';
	} else { // Don't show the error:

		// Send an email to the admin:
		$body = $message . "\n" . print_r($e_vars, 1);
		mail(ADMIN_EMAIL, 'Site Error!', $body, 'From: noreply@emc.net');

		// Only print an error message if the error isn't a notice:
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br>';
		}
	} // End of !LIVE IF.

} // End of my_error_handler() definition.

// Use my error handler:
//set_error_handler('my_error_handler');

// ************ ERROR MANAGEMENT ************ //
// ****************************************** //

// ****************************************** //

$app_name = 'emusic';

if (isset($_SESSION['user_id']) && isset($_SESSION['browser'])) {
	$user_id  = $_SESSION['user_id'];
	$user_name  = $_SESSION['user_name'];
	$first_name = $_SESSION['first_name'];
}

if (!isset($_SESSION['app_id']) && !isset($app_id)) {
	$getAppID = mysqli_query($dbcon, "SELECT app_id FROM apps WHERE app_name='$app_name'");
	// Check the result:
	if (mysqli_num_rows($getAppID) == 1) {
		// fetch the records
		$fetch_AppID = mysqli_fetch_assoc($getAppID);
		$_SESSION['webapp_id'] = $fetch_AppID['app_id'];
		if (session_status() == PHP_SESSION_ACTIVE) {
			session_regenerate_id(true);
			$app_id = $_SESSION['webapp_id'];
		}
	}
}
