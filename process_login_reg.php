<?php
// Connect to the database .
require_once('obaEddie_connect.php');

define('ERROR_LOG', 'logs/errors.log');

require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

// Load the validation functions.
require_once('include/login_functions.inc.php');

// Was the form submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['sign_in'])) {
    // Check the login data
    list($check, $data) = check_login($dbcon, $_POST['user_login'], $_POST['password_login']);
    // If successful, set session data and display the forum.php page
    if ($check) {
      // Access the session details
      $_SESSION['user_id'] = $data['user_id'];
      $_SESSION['first_name'] = $data['first_name'];
      $_SESSION['user_name'] = $data['user_name'];
      $_SESSION['user_level'] = $data['user_level'];
      // Store the HTTP_USER_AGENT:
      $_SESSION['browser'] = sha1($_SERVER['HTTP_USER_AGENT']);
      // I need to set a cookie for the users picture here so i could display it next to the login form
      setcookie('user_name', $data['user_name'], time() + (365 * 24 * 60 * 60), "/", "", 0, 0);

      if (isset($_POST['rememberme'])) {
        $rememberme = $_POST['rememberme'];
      }
      if ($rememberme != NULL) {
        setcookie('user_id', $data['user_id'], time() + (365 * 24 * 60 * 60), "/", "", 0, 0);
      }
      if ($_SESSION['user_level'] == 71) {
        redirect_user('admin/index.php');
      } else {
        redirect_user('index.php');
      }
    }
    // If it fails, set the error messages
    else {
      $errors = $data;
    }
    // Close the database connection.
    mysqli_close($dbcon);
  }

  if (isset($_POST['sign_up'])) {
    try {
      $error = array(); // Initialize an error array.

      // --------------------check the entries-------------
      // Trim the first name
      $first_name = $purifier->purify(filter_var($_POST['first_name']));
      if ((!empty($first_name)) && (preg_match('/[a-z\-\']/i', $first_name))) {
        //Sanitize the trimmed first name
        $first_name = ucfirst($first_name);
      } else {
        $error[] = 'First name missing or not alphabetic characters.';
      }

      //Is the last name present? If it is, trim it and sanitize it
      $last_name = $purifier->purify(filter_var($_POST['last_name']));
      if ((!empty($last_name)) && (preg_match('/[a-z\-\']/i', $last_name))) {
        //Sanitize the trimmed last name
        $last_name = ucfirst($last_name);
      } else {
        $error[] = 'Last name missing or not alphabetic or dash';
      }

      // Trim the user name
      $user_name = $purifier->purify(filter_var($_POST['user_name']));
      if ((!empty($user_name)) && (preg_match('/[a-z0-9\-\_.]/i', $user_name))) {
        //Sanitize the trimmed first name
        $user_name = $user_name;
      } else {
        $error[] = 'User name missing or not alphabetic and numeric characters.';
      }

      // Check that an email address has been entered
      // $email = $_POST['email'];
      $email = $purifier->purify(strtolower(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL)));
      if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $errors[] = 'You forgot to enter your email address';
        $errors[] = ' or the e-mail format is incorrect.';
      }

      // Check for password and match against the comfirmed password:
      $password1trim = $purifier->purify(filter_var($_POST['sign_password']));
      if (empty($password1trim)) {
        $error[] = "Please enter a valid password";
      } else {
        if (!preg_match(
          '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d#$@!%&*?]{8,}$/',
          $password1trim
        )) {
          $error[] = "Invalid password, not less than 8 characters. At least one upper,
          one lower, one number.";
        } else {
          $password2trim = $purifier->purify(filter_var($_POST['confirm_password']));
          if ($password1trim === $password2trim) {
            $password = $password1trim;
          } else {
            $error[] = "Your two passwords do not match.";
          }
        }
      }

      if (isset($_POST['gender'])) {
        $gender = filter_var($_POST['gender']);
      }
      if (empty($gender)) {
        $error[] = "Please select a gender";
      }

      if (empty($error)) { // If everything's OK.
        // If no problems encountered, register user in the database
        //Determine whether the email address has already been registered
        $query = "SELECT user_id FROM users WHERE email=? OR user_name=?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        mysqli_stmt_bind_param($q, 'ss', $email, $user_name);
        mysqli_stmt_execute($q);
        $result = mysqli_stmt_get_result($q);

        if (mysqli_num_rows($result) == 0) { //The email address or user_name has not been registered
          //already therefore register the user in the users table
          //-------------Valid Entries - Save to database -----
          //Start of the SUCCESSFUL SECTION. i.e all the required fields were filled out
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
          // Create the activation code:
          $activation_code = md5(uniqid(rand(), true));

          // Register the user in the database...
          $query = "INSERT INTO users (first_name, last_name, user_name, email, password, gender, activated, reg_date)";
          $query .= "VALUES (?,?,?,?,?,?,'', NOW())";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $query);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          // mysqli_stmt_bind_param($q, 'sssssss', $first_name, $last_name, $user_name, $email, $hashed_password, $gender, $activation_code);
          mysqli_stmt_bind_param($q, 'ssssss', $first_name, $last_name, $user_name, $email, $hashed_password, $gender);
          // execute query
          mysqli_stmt_execute($q);

          if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted

            // Send the email:
            // $body = "Thank you for registering on emusic. \nTo activate your account, please click on the link below:\n\n";
            // $body .= BASE_URL . 'activate.php?x=' . urlencode($email) . "&y=$activation_code";
            // $sendMail = mail($email, 'Registration Confirmation', $body, 'From: noreply@emusic');
            // if (function_exists('mail')) {
            //   if ($sendMail) { // echo "Email Sent Successfully";
            //   } // else { echo "Mail Failed";}
            // }
            // else { echo 'mail() has been disabled';}

            // Finish the page:
            // $confirm_text = "<h2 style='color:green;'><strong>Registration!</strong></h2>\n\n<h5 class='lead' style='color:green;'>
            // A confirmation mail has been sent to your email address. Please click on the link in your email in order to activate your account.</h5>";
            $confirm_text = "<br><h5 style='color:green;'><strong>Registration sucessful!</strong></h5>\n\n<p style='color:green;'>
            Thank you for registering on Emusic.<br><a href='login_register.php'>Please Login with your details to continue</p>";
            //exit(); // Stop the page.
          } else { // if it did not run OK.
            // Debugging message bellow do not use in production
            // echo "Invalid query: " . $dbcon->error;
            // Public Message
            $errorstring = '<p id="err_msg" class="errors" style="color:red;">System is busy, please try again later</p>';
            //echo "<p class='text-center col-sm-2' style='color:red;'>$errorstring</p>";
            mysqli_close($dbcon); // Close the database connection.
            //exit();
          }
        } else { // The email address is already registered
          $errorstring = "The email address or username is already registered.";
          //echo "<p class='text-center col-sm-2' style='color:brown;'>
          //$errorstring</p>";
        }
      } else { // Report the errors
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        //echo "<p class = 'text-center col-sm-2' style = 'color:red;'>$errorstring</p>";
      } // End of if (empty($errors)) IF.
    }
    // We finally handle any problems here:
    catch (Exception $e) {
      // print "An Exception occured message: " . $e->getMessage();
      print "The system is busy please try later";
      $date = date('m.d.y h:i:s');
      $errormessage = $e->getMessage();
      $eMessage = $date . " | Exception Error | " . $errormessage . "\n";
      error_log($eMessage, 3, ERROR_LOG);
      // e-mail support person to alert there is a problem
      // error_log("Date/Time: $date - Exception Error, Check error log for
      //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom: Error
      //Log <errorlog@helpme.com>" . "\r\n");
      header("refresh:5; url= " . $_SERVER['PHP_SELF']);
    } catch (Error $e) {
      // print "An Error occured message: " . $e->getMessage();
      print "The system is busy please try later";
      $date = date('m.d.y h:i:s');
      $errormessage = $e->getMessage();
      $eMessage = $date . " | Error | " . $errormessage . "\n";
      error_log($eMessage, 3, ERROR_LOG);
      // e-mail support person to alert there is a problem
      // error_log("Date/Time: $date - Error, Check error log for
      //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error
      //Log <errorlog@helpme.com>" . "\r\n");
      header("refresh:5; url= " . $_SERVER['PHP_SELF']);
    }
  }
}
