<?php
// require_once('../obaEddie_connect.php');
// require('include/config.inc.php');

// check for delete users
if (isset($_POST['deleteAccount'])) {
  try {
    $error = array(); // Initialize an error array.
    // --------------------check entries-------------
    $deleteUser = $purifier->purify($_POST['deleteAccountID']);
    if (!empty($deleteUser) AND ($deleteUser == $user_id)) {
    	//Sanitize the trimmed deleted user
    	$deleteUser = filter_var($deleteUser, FILTER_SANITIZE_NUMBER_INT);
  	}else{
    	$error[] = "Sorry! The user could not be deleted due to invalid user id...";
  	}

    if (empty($error)) { // if everything is ok
      // Check for username; then delete user folder
      $userName = mysqli_query($dbcon, "SELECT user_name FROM users WHERE user_id=$deleteUser");
      // Check the result:
      if (mysqli_num_rows($userName) == 1) {
        // fetch the records
        $fetch_userName = mysqli_fetch_assoc($userName);
        $user_name = $purifier->purify($fetch_userName['user_name']);
      }
      define('USER_DIR', "users/$user_name");
      // delete user from database
      $tables = array("users", "user_address", "user_info", "post", "post_comment", "post_comment_reply",
      "pvt_msg", "testimony", "app_comment", "audio_video_comment", "admin_msg", "admin_msg_reply");
      foreach ($tables as $table) {
        $queryDelUser = "DELETE FROM $table WHERE user_id=?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $queryDelUser);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'i', $deleteUser);
        // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
          removeDir(USER_DIR);
          // cancel the session
          $loggedout = mysqli_query($dbcon, "UPDATE users SET online='offline' WHERE user_id={$_SESSION['user_id']}");
          $_SESSION = array(); // Destroy the variables
          $params = session_get_cookie_params();
          // Destroy the cookie
          Setcookie(session_name(), '', time() - 42000,
          $params["path"], $params["domain"],
          $params["secure"], $params["httponly"]);
          if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
          } // Destroy the session itself
          setcookie('PHPSESSID', '', time()-42000,'/', '', 0, 0);//Destroy the cookie
          setcookie('user_id', '', time()-42000, '/', '', 0, 0);
          setcookie('user_name', '', time()-42000, '/', '', 0, 0);
          redirect_user();
        }
      }
    }else {
      // $errorstring = "Error! The following error(s) occured:<br>";
      // foreach($error as $msg) {// Print each error.
      //   $errorstring.= "$msg<br>\n";
      // }
      // $errorstring.= "Please try again.<br>";
      header("refresh:1; url= ".$_SERVER['PHP_SELF']);
    }
  }catch (Exception $e) {
    // print "An Exception occured message: " . $e->getMessage();
    print "The system is busy please try later";
    $date = date('m.d.y h:i:s');
    $errormessage = $e->getMessage();
    $eMessage = $date . " | Exception Error | " . $errormessage . "\n";
    error_log($eMessage,3,ERROR_LOG);
    // e-mail support person to alert there is a problem
    // error_log("Date/Time: $date - Exception Error, Check error log for
    //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom: Error
    //Log <errorlog@helpme.com>" . "\r\n");
  }
  catch(Error $e) {
    // print "An Error occured message: " . $e->getMessage();
    print "The system is busy please try later";
    $date = date('m.d.y h:i:s');
    $errormessage = $e->getMessage();
    $eMessage = $date . " | Error | " . $errormessage . "\n";
    error_log($eMessage,3,ERROR_LOG);
    // e-mail support person to alert there is a problem
    // error_log("Date/Time: $date - Error, Check error log for
    //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error
    //Log <errorlog@helpme.com>" . "\r\n");
  }
}
?>
