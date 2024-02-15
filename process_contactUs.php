<?php
define('ERROR_LOG', 'logs/errors.log');
require_once('include/config.inc.php');
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
// Was the form submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Connect to the database .
  require_once('obaEddie_connect.php');

  // Check for contact form submition
  if (isset($_POST['contact_us'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $contact_name = $purifier->purify(filter_var($_POST['contact_name']));
      if ((!empty($contact_name)) && (preg_match('/[a-z\s\'-_]/i', $contact_name))) {
        //Sanitize the trimmed first name
        $contact_name = ucwords($contact_name);
      } else {
        $error[] = 'Name missing or not alphabetic characters.';
      }

      // Check that an email address has been entered
      $email = $purifier->purify(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
      if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
        $error[] = 'You forgot to enter your email address or the e-mail format is incorrect.';
      }

      $phone = $purifier->purify($_POST['phone']);
      if (empty($phone)) {
        $phone = NULL;
      }

      $service = $purifier->purify($_POST['service']);
      if (empty($service)) {
        $error[] = "Please select service from the service list";
      }

      $requirement = $purifier->purify($_POST['requirement']);
      if (empty($requirement)) {
        $error[] = "Please select from the requirement list";
      }

      $get_message = $purifier->purify($_POST['message']);
      if (!empty($get_message)) {
        $patterns = array(
          "/https/", "/http/", "/www./", "/\.org/", "/\.com/", "/\.net/", "/\.io/", "/<script>/", "/<\/script>/", "/to:/",
          "/cc:/", "/bcc:/", "/content-type:/", "/mime-version:/", "/multipart-mixed:/", "/content-transfer-encoding:/", "/\n/", "/%0a/", "/%0d/"
        );
        $message = preg_replace($patterns, "--e--", $get_message);
      } else {
        $error[] = "Please enter message";
      }

      $news_letter = $purifier->purify($_POST['news_letter']);
      if (empty($news_letter)) {
        $news_letter = NULL;
      }

      if (empty($error)) {
        // Insert message into database...
        $query = "INSERT INTO contact_us (name, email, phone, service, requirement, message, date_added)";
        $query .= "VALUES (?,?,?,?,?,?, NOW())";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param($q, 'ssssss', $contact_name, $email, $phone, $service, $requirement, $message);
        // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted
          if (!empty($news_letter)) {
            //Determine whether the email address has already sign up for news letter
            $query_news_letter = "SELECT email FROM news_letter WHERE email=?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query_news_letter);
            mysqli_stmt_bind_param($q, 's', $email);
            mysqli_stmt_execute($q);
            $result_news_letter = mysqli_stmt_get_result($q);

            if (mysqli_num_rows($result_news_letter) == 0) { //The email address has not signed up yet
              // Insert email into news_letter table
              $query2 = "INSERT INTO news_letter (email) VALUES (?)";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query2);
              // use prepared statement to insure that only text is inserted
              // bind fields to SQL Statement
              mysqli_stmt_bind_param($q, 's', $email);
              // execute query
              mysqli_stmt_execute($q);
            }
          }
        } else {
          $errorstring = "System is busy, please try again later";
          header("refresh:7; url= " . $_SERVER['PHP_SELF']);
        }
        // everything's OK, send e-mail
        $subject = "Message from customer " . $contact_name;
        $messageproper =
          "__________________________________________________________\n" .
          "Name of sender: $contact_name\n" .
          "Email of sender: $email\n" .
          "Telephone: $phone\n" .
          "Service: $service\n" .
          "Requirement: $requirement\n" .
          "_________________________MESSAGE__________________________\n\n" .
          $message .
          "\n\n___________________________________________________________\n";
        $sendMail = mail($admin_email, $subject, $messageproper, "FROM: \"$contact_name\" <$email>");
        if (function_exists('mail')) {
          if ($sendMail) { // echo "Email Sent Successfully";
            $message_sent = "Your message has been sent.<br>
            \nThank you for contacting Emusic, we will reply you shortly via email.";
            header("refresh:15; url= " . $_SERVER['PHP_SELF']);
          } else {
            // $errorstring = 'Thanks for contacting Emusic.<br>Our mail service is currently down.<br>We will get back to you via email.';
            $message_sent = "Your message has been sent.<br>
            \nThank you for contacting Emusic, we will reply you shortly via email.";
            header("refresh:15; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          // $errorstring = 'mail() function has been disabled';
          // $errorstring = 'Thanks for contacting Emusic.<br>Our mail service is currently down.<br>We will get back to you via email.';
          $message_sent = "Your message has been sent.<br>
            \nThank you for contacting Emusic, we will reply you shortly via email.";
          header("refresh:15; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:8; url= " . $_SERVER['PHP_SELF']);
      }
    } catch (Exception $e) {
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
