<?php
require_once('../obaEddie_connect.php');

if (isset($_COOKIE['user_id']) && !isset($_SESSION['user_id'])) {
  // Create session and store cookie as session
  $_SESSION['user_id'] = $_COOKIE['user_id'];
  // Store the HTTP_USER_AGENT:
  $_SESSION['browser'] = sha1($_SERVER['HTTP_USER_AGENT']);

  $result = mysqli_query($dbcon, "SELECT first_name, user_name FROM users WHERE user_id={$_SESSION['user_id']}");
  // Check the result:
  if (mysqli_num_rows($result) == 1) {
    // fetch the records
    $data = mysqli_fetch_assoc($result);
    // Access the session details
    $_SESSION['first_name'] = $data['first_name'];
    $_SESSION['user_name'] = $data['user_name'];
    mysqli_free_result($result);
  }
  //$loggedin = mysqli_query($dbcon, "UPDATE users SET online='online' WHERE user_id=$user_id");
  $online_time = mysqli_query($dbcon, "UPDATE users SET online_time=now() WHERE user_id={$_SESSION['user_id']}");
  if (mysqli_affected_rows($dbcon) == 1) {
    $_SESSION['online'] = 'online';
    $online = $_SESSION['online'];
  }
} elseif (isset($_COOKIE['user_id']) && isset($_SESSION['user_id'])) {
  // Store cookie as session
  $_SESSION['user_id'] = $_COOKIE['user_id'];
  //$loggedin = mysqli_query($dbcon, "UPDATE users SET online='online' WHERE user_id=$user_id");
  $online_time = mysqli_query($dbcon, "UPDATE users SET online_time=now() WHERE user_id={$_SESSION['user_id']}");
  if (mysqli_affected_rows($dbcon) == 1) {
    if (!isset($_SESSION['online'])) {
      $_SESSION['online'] = 'online';
      $online = $_SESSION['online'];
    } else {
      $online = $_SESSION['online'];
    }
  }
} elseif (isset($_SESSION['user_id']) && !isset($_COOKIE['user_id'])) {
  //$loggedin = mysqli_query($dbcon, "UPDATE users SET online='online' WHERE user_id=$user_id");
  $online_time = mysqli_query($dbcon, "UPDATE users SET online_time=now() WHERE user_id={$_SESSION['user_id']}");
  if (mysqli_affected_rows($dbcon) == 1) {
    if (!isset($_SESSION['online'])) {
      $_SESSION['online'] = 'online';
      $online = $_SESSION['online'];
    } else {
      $online = $_SESSION['online'];
    }
  }
} else {
  // code...
}
