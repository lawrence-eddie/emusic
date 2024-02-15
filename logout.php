<?php
require_once('obaEddie_connect.php');
require('include/config.inc.php');
session_start(); // access the current session.
// if no session variable exists then redirect the user
if (!isset($_SESSION['user_id']) & !isset($_SESSION['browser'])) {
  redirect_user();
  exit();
} ////cancel the session and redirect the user:
else { // cancel the session
  // $loggedout = mysqli_query($dbcon, "UPDATE users SET online='offline' WHERE user_id={$_SESSION['user_id']}");
  $_SESSION = array(); // Destroy the variables
  $params = session_get_cookie_params();
  // Destroy the cookie
  Setcookie(
    session_name(),
    '',
    time() - 42000,
    $params["path"],
    $params["domain"],
    $params["secure"],
    $params["httponly"]
  );
  if (session_status() == PHP_SESSION_ACTIVE) {
    session_destroy();
  } // Destroy the session itself
  setcookie('PHPSESSID', '', time() - 42000, '/', '', 0, 0); //Destroy the cookie
  setcookie('user_id', '', time() - 42000, '/', '', 0, 0);
  redirect_user('login_register.php');
}
