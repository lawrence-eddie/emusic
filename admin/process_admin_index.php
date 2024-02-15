<?php
define('ERROR_LOG', 'logs/errors.log');

//Admin Details
$adminUser_id = 2;
$admin_userLevel = 71;
// $adminPicture = "img/admin_pic_small.png";

// Was the POST form submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check for app addition
  if (isset($_POST['add_app'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app_dev = $purifier->purify($_POST['select_app_dev']);
      if (empty($select_app_dev)) {
        $error[] = "Select app developer...";
      }

      $app_name = $purifier->purify($_POST['app_name']);
      if (!empty($app_name)) {
        $app_name = ucwords($app_name);
      } else $error[] = "Enter app name...";

      $app_image = $_FILES['app_image'];
      if (empty($app_image)) {
        $app_image = NULL;
      }

      $app_demo = $_FILES['app_demo'];
      if (empty($app_demo)) {
        $app_demo = NULL;
      }

      if (empty($error)) { // If everything's OK.
        // check if app name already exist
        $checkAppName = mysqli_query($dbcon, "SELECT app_name FROM apps WHERE app_name='$app_name'");
        if (mysqli_num_rows($checkAppName) == 0) { // app name does not exist
          $app_name_dir = preg_replace('/\s/', '_', $app_name);
          define('APP_DIR', "../$app_name_dir/"); // folder name
          // Check if app dir exist
          if (!is_dir(APP_DIR)) {
            mkdir(APP_DIR, 0777, true);
          }
          define('APP_URL', "$app_name_dir/");
          $app_url = APP_URL; // app url

          // check for new uploaded pic
          if (!empty($_FILES['app_image']['tmp_name']) || is_uploaded_file($_FILES['app_image']['tmp_name'])) {
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['app_image']['type'], $allowed)) {
              $file_name = $_FILES['app_image']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$app_name_dir.$ext";
              $saveto = APP_DIR . $file_name; // where to move image
              if (move_uploaded_file($_FILES['app_image']['tmp_name'], $saveto)) {
                // Uploaded app image has been moved
                $app_pic = APP_URL . $file_name; // app image
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            $app_pic = "$adminPicture";
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['app_image']['tmp_name']) && is_file($_FILES['app_image']['tmp_name'])) {
            unlink($_FILES['app_image']['tmp_name']);
          }

          // check for app demo video if any?
          if (!empty($_FILES['app_demo']['tmp_name']) || is_uploaded_file($_FILES['app_demo']['tmp_name'])) {
            // Validate the type. Should be mp4/webm or ogg.
            $allowed = ['video/mp4', 'video/webm', 'video/webmv', 'video/ogg', 'video/ogv'];
            if (in_array($_FILES['app_demo']['type'], $allowed)) {
              $file_name = $_FILES['app_demo']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$app_name_dir.$ext";
              $saveto = APP_DIR . $file_name; // where to move image
              if (move_uploaded_file($_FILES['app_demo']['tmp_name'], $saveto)) {
                // Uploaded app image has been moved
                $app_demo_vid = APP_URL . $file_name; // app demo video
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload an acceptable video format file";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            $app_demo_vid = "$adminPicture";
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['app_demo']['tmp_name']) && is_file($_FILES['app_demo']['tmp_name'])) {
            unlink($_FILES['app_demo']['tmp_name']);
          }

          $addAppQuery = "INSERT INTO apps (app_dev_id, app_name, app_pic, app_demo, app_url) VALUES (?,?,?,?,?)";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $addAppQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param($q, 'issss', $select_app_dev, $app_name, $app_pic, $app_demo_vid, $app_url);
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) {
            $lastInsertedApp_ID = mysqli_insert_id($dbcon);
            // get all user id for app visit insertion
            $queryUserIDApp_visit = mysqli_query($dbcon, "SELECT user_id FROM users WHERE user_id!=$adminUser_id");
            // Check the result:
            if (mysqli_num_rows($queryUserIDApp_visit) > 0) {
              // fetch the records
              while ($fetch_queryUserIDApp_visit = mysqli_fetch_assoc($queryUserIDApp_visit)) {
                $user_idApp_visit  = $purifier->purify($fetch_queryUserIDApp_visit['user_id']);
                $noti_link = BASE_URL . $app_url;
                mysqli_query($dbcon, "INSERT INTO notification (post_id, noti_header, noti_body,
                user_from, user_to, noti_pic, description, noti_link, user_level, date_time) VALUES ($lastInsertedApp_ID,
                '$newApp_header', '$app_name', $adminUser_id, $user_idApp_visit, '$app_pic',
                '$newApp_description', '$noti_link', $admin_userLevel, Now())");
              }
            }
          }
          $sucstring = "App has been added successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else { // app name already exists
          $errorstring = "Sorry the app name already exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for app eddition
  if (isset($_POST['edit_app'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app = $purifier->purify($_POST['select_app']);
      if (empty($select_app)) {
        $error[] = "Select app name...";
      }

      $edit_app_name = $purifier->purify($_POST['edit_app_name']);
      if (empty($edit_app_name)) {
        $edit_app_name = NULL;
      } else $edit_app_name = ucwords($edit_app_name);

      $edit_app_image = $_FILES['edit_app_image'];
      if (empty($edit_app_image)) {
        $_FILES['edit_app_image'] = NULL;
      }

      $edit_app_demo = $_FILES['edit_app_demo'];
      if (empty($edit_app_demo)) {
        $_FILES['edit_app_demo'] = NULL;
      }

      if (empty($error)) { // If everything's OK.
        //delete app dir and create new one if app name is changed?
        // select former app
        $query_former_app = mysqli_query($dbcon, "SELECT app_name, app_pic, app_demo FROM apps WHERE app_id=$select_app");
        if (mysqli_num_rows($query_former_app) == 1) {
          $fetch_former_app = mysqli_fetch_assoc($query_former_app);
          $former_app_name = $purifier->purify($fetch_former_app['app_name']);
          $former_app_pic = $purifier->purify($fetch_former_app['app_pic']);
          $former_app_demo = $purifier->purify($fetch_former_app['app_demo']);
          $former_app_name_dir = preg_replace('/\s/', '_', $former_app_name);
          if (!empty($edit_app_name)) {
            $edit_app_name_dir = preg_replace('/\s/', '_', $edit_app_name);
            define('FORMER_APPNAME_DIR', "../$former_app_name_dir/"); // former folder name
            $former_appname_dir = FORMER_APPNAME_DIR;
            define('NEW_APPNAME_DIR', "../$edit_app_name_dir/"); // new folder name
            $new_appname_dir = NEW_APPNAME_DIR;
            // Check if app dir exist
            if (is_dir(FORMER_APPNAME_DIR)) {
              if (rename(realpath(dirname(__FILE__)) . "/../$former_app_name_dir", realpath(dirname(__FILE__)) . "/../$edit_app_name_dir")) {
                //rename successful
              } else {
                $errorstring = "The folder you are renaming $former_app_name to: ($edit_app_name), already exist!";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            }
          } else {
            $edit_app_name = $former_app_name;
            $edit_app_name_dir = $former_app_name_dir;
            define('NEW_APPNAME_DIR', "../$former_app_name_dir/"); // retain former folder name as new directory
            $new_appname_dir = NEW_APPNAME_DIR;
          }

          // check for new uploaded pic
          if (!empty($_FILES['edit_app_image']['tmp_name']) || is_uploaded_file($_FILES['edit_app_image']['tmp_name'])) {
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['edit_app_image']['type'], $allowed)) {
              $file_name = $_FILES['edit_app_image']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$edit_app_name_dir.$ext";
              // Check if destination dir exist
              if (!is_dir(NEW_APPNAME_DIR)) {
                mkdir(NEW_APPNAME_DIR, 0777, true);
              }
              $app_pic = "$edit_app_name_dir/$file_name";
              //checking if file exsists
              // if(file_exists(NEW_APPNAME_DIR.$file_name)) unlink(NEW_APPNAME_DIR.$file_name);
              // Delete other image files
              $images = glob("$new_appname_dir*.{jpg,jpeg,png}", GLOB_BRACE); //Delete image file
              foreach ($images as $image) {
                unset($images);
                gc_collect_cycles(); //Forces collection of any existing garbage cycles
                unlink($image);
              }

              $saveto = NEW_APPNAME_DIR . $file_name; // where to move image
              if (move_uploaded_file($_FILES['edit_app_image']['tmp_name'], $saveto)) {
                $query_update_app_pic = "UPDATE apps SET app_pic=? WHERE app_id=? LIMIT 1";
                $q = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($q, $query_update_app_pic);
                // bind values to SQL statement
                mysqli_stmt_bind_param($q, 'si', $app_pic, $select_app);
                // execute query
                mysqli_stmt_execute($q);
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            if (str_contains($former_app_pic, $former_app_name_dir)) {
              $file_name = explode('/', $former_app_pic, 2);
              $file_name_pic = $file_name[1];
              $app_pic = "$edit_app_name_dir/$file_name_pic";
              $query_update_app_pic = "UPDATE apps SET app_pic=? WHERE app_id=? LIMIT 1";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_app_pic);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'si', $app_pic, $select_app);
              // execute query
              mysqli_stmt_execute($q);
            } else {
              $app_pic = "$adminPicture";
              $query_update_app_pic = "UPDATE apps SET app_pic=? WHERE app_id=? LIMIT 1";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_app_pic);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'si', $app_pic, $select_app);
              // execute query
              mysqli_stmt_execute($q);
            }
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['edit_app_image']['tmp_name']) && is_file($_FILES['edit_app_image']['tmp_name'])) {
            unlink($_FILES['edit_app_image']['tmp_name']);
          }

          // check for new uploaded demo video
          if (!empty($_FILES['edit_app_demo']['tmp_name']) || is_uploaded_file($_FILES['edit_app_demo']['tmp_name'])) {
            if (($_FILES['edit_app_demo']['size'] >= 5000) || ($_FILES['edit_app_demo']["size"] == 0)) {
              // Validate the type. Should be mp4/webm or ogg.
              $allowed = ['video/mp4', 'video/webm', 'video/webmv', 'video/ogg', 'video/ogv'];
              if (in_array($_FILES['edit_app_demo']['type'], $allowed)) {
                $file_name = $_FILES['edit_app_demo']['name'];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
                $file_name = "$edit_app_name_dir.$ext";
                // Check if destination dir exist
                if (!is_dir(NEW_APPNAME_DIR)) {
                  mkdir(NEW_APPNAME_DIR, 0777, true);
                }
                //checking if file exsists
                if (file_exists(NEW_APPNAME_DIR . $file_name)) unlink(NEW_APPNAME_DIR . $file_name);
                // Delete other image files
                $vids = glob("$new_appname_dir*.{mp4,webm,webmv,ogg,ogv}", GLOB_BRACE); //Delete image file
                foreach ($vids as $vid) {
                  unlink($vid);
                }

                $app_demo = "$edit_app_name_dir/$file_name";
                $saveto = NEW_APPNAME_DIR . $file_name; // where to move video
                if (move_uploaded_file($_FILES['edit_app_demo']['tmp_name'], $saveto)) {
                  $query_update_app_demo = "UPDATE apps SET app_demo=? WHERE app_id=? LIMIT 1";
                  $q = mysqli_stmt_init($dbcon);
                  mysqli_stmt_prepare($q, $query_update_app_demo);
                  // bind values to SQL statement
                  mysqli_stmt_bind_param($q, 'si', $app_demo, $select_app);
                  // execute query
                  mysqli_stmt_execute($q);
                } else {
                  $errorstring = "System is busy please try later.";
                  header("refresh:1; url= " . $_SERVER['PHP_SELF']);
                }
              } else { // Invalid type.
                $errorstring = "Please upload an acceptable video format file";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else {
              $errorstring = "File too large. File must be less than 5MB.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            if (str_contains($former_app_demo, $former_app_name_dir)) {
              $file_name = explode('/', $former_app_demo, 2);
              $file_name_demo = $file_name[1];
              $app_demo = "$edit_app_name_dir/$file_name_demo";
              $query_update_app_demo = "UPDATE apps SET app_demo=? WHERE app_id=? LIMIT 1";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_app_demo);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'si', $app_demo, $select_app);
              // execute query
              mysqli_stmt_execute($q);
            } else {
              $app_demo = "$adminPicture";
              $query_update_app_demo = "UPDATE apps SET app_demo=? WHERE app_id=? LIMIT 1";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_app_demo);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'si', $app_demo, $select_app);
              // execute query
              mysqli_stmt_execute($q);
            }
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['edit_app_demo']['tmp_name']) && is_file($_FILES['edit_app_demo']['tmp_name'])) {
            unlink($_FILES['edit_app_demo']['tmp_name']);
          }

          $app_url = "$edit_app_name_dir/";
          $query_update_app_name = "UPDATE apps SET app_name=?, app_url=? WHERE app_id=? LIMIT 1";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $query_update_app_name);
          // bind values to SQL statement
          mysqli_stmt_bind_param($q, 'ssi', $edit_app_name, $app_url, $select_app);
          // execute query
          mysqli_stmt_execute($q);
          $sucstring = "App has been edited successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else {
          $errorstring = "The app you are trying to edit do not exist!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for app deletion
  if (isset($_POST['delete_app'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app = $purifier->purify($_POST['select_app']);
      if (!empty($select_app)) {
        //Sanitize the trimmed select_app
        $select_app = $select_app;
      } else {
        $error[] = "Select app name...";
      }

      if (empty($error)) { // If everything's OK.
        //delete app and its directory
        $query_appName = mysqli_query($dbcon, "SELECT app_name, app_url FROM apps WHERE app_id=$select_app");
        if (mysqli_num_rows($query_appName) == 1) {
          $fetch_appName = mysqli_fetch_assoc($query_appName);
          $appName = $purifier->purify($fetch_appName['app_name']);
          $appNameDir = $purifier->purify($fetch_appName['app_url']);
          define('APPNAME_DIR', "../$appNameDir"); // former folder name
          // delete app from database
          mysqli_query($dbcon, "DELETE FROM notification WHERE post_id=$select_app AND noti_header='New app'");
          $tables = array("apps", "app_comment", "app_rating", "post", "post_comment", "audio_video_comment");
          foreach ($tables as $table) {
            $queryDelApp = "DELETE FROM $table WHERE app_id=?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryDelApp);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'i', $select_app);
            // execute query
            mysqli_stmt_execute($q);
            if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
              // delete its directory
              removeDir(APPNAME_DIR);
              $sucstring = "That app has been deleted/removed from database!";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  //Check for developer addition
  if (isset($_POST['add_app_dev'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $app_dev_first_name = $purifier->purify($_POST['app_dev_first_name']);
      if (!empty($app_dev_first_name)) {
        //Sanitize the trimmed $app_dev_name
        $app_dev_first_name = ucwords($app_dev_first_name);
      } else {
        $error[] = "Enter app developers first name...";
      }

      $app_dev_last_name = $purifier->purify($_POST['app_dev_last_name']);
      if (!empty($app_dev_last_name)) {
        //Sanitize the trimmed $app_dev_name
        $app_dev_last_name = ucwords($app_dev_last_name);
      } else {
        $error[] = "Enter app developers last name...";
      }

      $app_dev_desc = $purifier->purify($_POST['app_dev_desc']);
      if ((!empty($app_dev_desc)) && (strlen($app_dev_desc) <= 200)) {
        //Sanitize the trimmed $app_dev_desc
        $app_dev_desc = $app_dev_desc;
      } else {
        $error[] = "Please describe yourself not more than 120 letters...";
      }

      $app_dev_lang = $purifier->purify($_POST['app_dev_lang']);
      if (!empty($app_dev_lang)) {
        //Sanitize the trimmed $app_dev_lang
        $app_dev_lang = $app_dev_lang;
      } else {
        $error[] = "Enter Computer/Programming language(s).";
      }

      $app_dev_framework = $purifier->purify($_POST['app_dev_framework']);
      if (!empty($app_dev_framework)) {
        //Sanitize the trimmed $app_dev_framework
        $app_dev_framework = $app_dev_framework;
      } else {
        $app_dev_framework = NULL;
      }

      $app_dev_image = $_FILES['app_dev_image'];
      if (!empty($app_dev_image)) {
        //Sanitize the trimmed $app_dev_image
        $app_dev_image = $app_dev_image;
      } else {
        $error[] = "Select app developers image...";
      }

      $app_dev_mobile = $purifier->purify($_POST['app_dev_mobile']);
      if ((!empty($app_dev_mobile)) && (strlen($app_dev_mobile) <= 30)) {
        //Sanitize the trimmed phone number
        $app_dev_mobile = filter_var($app_dev_mobile, FILTER_SANITIZE_NUMBER_INT);
      } else {
        $error[] = "Enter app developers phone number. Integers only!";
      }

      $app_dev_email = filter_var($_POST['app_dev_email'], FILTER_SANITIZE_EMAIL);
      if ((empty($app_dev_email)) || (!filter_var($app_dev_email, FILTER_VALIDATE_EMAIL))
        || (strlen($app_dev_email > 60))
      ) {
        $error[] = 'You forgot to enter app developers email address or the e-mail format is incorrect.';
      }

      $app_dev_twitter_un = $purifier->purify($_POST['app_dev_twitter_un']);
      if (!empty($app_dev_twitter_un)) {
        //Sanitize the trimmed $app_dev_twitter_name
        $app_dev_twitter_un = $app_dev_twitter_un;
        //check for $app_dev_twitter_id
        $app_dev_twitter_id = $purifier->purify($_POST['app_dev_twitter_id']);
        if (!empty($app_dev_twitter_id)) {
          //Sanitize the trimmed $app_dev_twitter
          $app_dev_twitter_id = $app_dev_twitter_id;
        } else {
          $error[] = "Enter app developers twitter ID if username was entered";
        }
      } else {
        $app_dev_twitter_un = "";
        $app_dev_twitter_id = $purifier->purify($_POST['app_dev_twitter_id']);
        if (empty($app_dev_twitter_id)) {
          $app_dev_twitter = NULL;
        } else {
          $app_dev_twitter = "<a href='https://twitter.com/messages/compose?recipient_id=$app_dev_twitter_id&ref_src=twsrc%5Etfw'
          style='font-size:22px;' class='twitter-dm-button d-inline' data-text='Hello! $app_dev_twitter_un'
          data-show-screen-name='$app_dev_twitter_un' data-screen-name='$app_dev_twitter_un' data-show-count='false'><i class='fab fa-twitter'></i></a>";
        }
      }

      $app_dev_facebook = $purifier->purify($_POST['app_dev_facebook']);
      if (empty($app_dev_facebook)) {
        $app_dev_facebook = NULL;
      }

      $app_dev_whatsapp = $purifier->purify($_POST['app_dev_whatsapp']);
      if (empty($app_dev_whatsapp)) {
        $app_dev_whatsapp = NULL;
      } else {
        $app_dev_whatsapp = "https://wa.me/$app_dev_whatsapp?text=Hello%20$app_dev_first_name%20$app_dev_last_name";
      }

      if (empty($error)) { // If everything's OK.
        // check if app devs name exist?
        $query_app_dev_name = mysqli_query($dbcon, "SELECT app_dev_first_name, app_dev_last_name FROM app_dev WHERE app_dev_first_name='$app_dev_first_name' AND app_dev_last_name='$app_dev_last_name'");
        // Check the result:
        if (mysqli_num_rows($query_app_dev_name) == 0) { // app developers name does not exist
          $app_dev_first_name = preg_replace('/\s/', '_', $app_dev_first_name);
          $app_dev_last_name = preg_replace('/\s/', '_', $app_dev_last_name);
          $app_dev_dirname = $app_dev_first_name . "_" . $app_dev_last_name;
          // check for app dev profile pic
          if (isset($_FILES['app_dev_image']['tmp_name']) || is_uploaded_file($_FILES['app_dev_image']['tmp_name'])) {
            define('APP_DEV_DIR', "../app_dev/$app_dev_dirname/");
            $app_dev_dir = APP_DEV_DIR;
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['app_dev_image']['type'], $allowed)) {
              $file_name = $_FILES['app_dev_image']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$app_dev_dirname.$ext";
              // Check if destination dir exist
              if (!is_dir(APP_DEV_DIR)) {
                mkdir(APP_DEV_DIR, 0777, true);
              }
              $saveto = APP_DEV_DIR . $file_name; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              // Delete other image files
              $image_filenames = glob("$app_dev_dir*.{jpg,jpeg,png}", GLOB_BRACE);
              foreach ($image_filenames as $image_filename) {
                unlink($image_filename);
              }
              if (move_uploaded_file($_FILES['app_dev_image']['tmp_name'], $saveto)) {
                // Uploaded app image has been moved
                $app_dev_pic = "app_dev/$app_dev_dirname/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['app_dev_image']['tmp_name']) && is_file($_FILES['app_dev_image']['tmp_name'])) {
            unlink($_FILES['app_dev_image']['tmp_name']);
          }

          $addAppDevQuery = "INSERT INTO app_dev (app_dev_first_name, app_dev_last_name, description, prog_lang, frame_work, app_dev_pic, mobile, email, twitter, facebook, whatsapp) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $addAppDevQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param($q, 'sssssssssss', $app_dev_first_name, $app_dev_last_name, $app_dev_desc, $app_dev_lang, $app_dev_framework, $app_dev_pic, $app_dev_mobile, $app_dev_email, $app_dev_twitter, $app_dev_facebook, $app_dev_whatsapp);
          // execute query
          mysqli_stmt_execute($q);
          $sucstring = "Developer has been added successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else { // app developers name already exist
          $errorstring = "Sorry the app developers name already exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for app developer edition
  if (isset($_POST['edit_app_dev'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app_dev = $purifier->purify($_POST['select_app_dev']);
      if (!empty($select_app_dev)) {
        //Sanitize the trimmed select_app
        $select_app_dev = $select_app_dev;
      } else {
        $error[] = "Select app developer...";
      }

      $edit_app_dev_first_name = $purifier->purify($_POST['edit_app_dev_first_name']);
      if (!empty($edit_app_dev_first_name)) {
        //Sanitize the trimmed $app_dev_name
        $edit_app_dev_first_name = $edit_app_dev_first_name;
        //check for last name
        $edit_app_dev_last_name = $purifier->purify($_POST['edit_app_dev_last_name']);
        if (!empty($edit_app_dev_last_name)) {
          //Sanitize the trimmed $app_dev_name
          $edit_app_dev_last_name = $edit_app_dev_last_name;
        } else {
          $error[] = "Enter app developers last name...";
        }
      } else {
        $edit_app_dev_first_name = NULL;
        $edit_app_dev_last_name = NULL;
      }

      $edit_app_dev_desc = $purifier->purify($_POST['edit_app_dev_desc']);
      if ((!empty($edit_app_dev_desc)) && (strlen($edit_app_dev_desc) <= 200)) {
        //Sanitize the trimmed $edit_app_dev_desc
        $edit_app_dev_desc = $edit_app_dev_desc;
      } else {
        $edit_app_dev_desc = NULL;
      }

      $edit_app_dev_lang = $purifier->purify($_POST['edit_app_dev_lang']);
      if (!empty($edit_app_dev_lang)) {
        //Sanitize the trimmed $edit_app_dev_lang
        $edit_app_dev_lang = $edit_app_dev_lang;
      } else {
        $edit_app_dev_lang = NULL;
      }

      $edit_app_dev_framework = $purifier->purify($_POST['edit_app_dev_framework']);
      if (!empty($edit_app_dev_framework)) {
        //Sanitize the trimmed $edit_app_dev_framework
        $edit_app_dev_framework = $edit_app_dev_framework;
      } else {
        $edit_app_dev_framework = NULL;
      }

      $edit_app_dev_image = $_FILES['edit_app_dev_image'];
      if (!empty($edit_app_dev_image)) {
        //Sanitize the trimmed $app_dev_image
        $edit_app_dev_image = $edit_app_dev_image;
      } else {
        $error[] = "Select app developers image...";
      }

      $edit_app_dev_mobile = $purifier->purify($_POST['edit_app_dev_mobile']);
      if ((!empty($edit_app_dev_mobile)) && (strlen($edit_app_dev_mobile) <= 30)) {
        //Sanitize the trimmed phone number
        $edit_app_dev_mobile = filter_var($edit_app_dev_mobile, FILTER_SANITIZE_NUMBER_INT);
      } else {
        $edit_app_dev_mobile = NULL;
      }

      $edit_app_dev_email = filter_var($_POST['edit_app_dev_email'], FILTER_SANITIZE_EMAIL);
      if ((empty($edit_app_dev_email)) || (!filter_var($edit_app_dev_email, FILTER_VALIDATE_EMAIL))
        || (strlen($edit_app_dev_email > 60))
      ) {
        $edit_app_dev_email = NULL;
      }

      $edit_app_dev_twitter_un = $purifier->purify($_POST['edit_app_dev_twitter_un']);
      if (!empty($edit_app_dev_twitter_un)) {
        //Sanitize the trimmed $edit_app_dev_twitter_name
        $edit_app_dev_twitter_un = $edit_app_dev_twitter_un;
        //check for $edit_app_dev_twitter_id
        $edit_app_dev_twitter_id = $purifier->purify($_POST['edit_app_dev_twitter_id']);
        if (!empty($edit_app_dev_twitter_id)) {
          //Sanitize the trimmed $edit_app_dev_twitter
          $edit_app_dev_twitter_id = $edit_app_dev_twitter_id;
        } else {
          $error[] = "Enter app developers twitter ID if username was entered";
        }
      } else {
        $edit_app_dev_twitter_un = "";
        $edit_app_dev_twitter_id = $purifier->purify($_POST['edit_app_dev_twitter_id']);
        if (empty($edit_app_dev_twitter_id)) {
          $edit_app_dev_twitter_id = NULL;
        }
      }

      $edit_app_dev_facebook = $purifier->purify($_POST['edit_app_dev_facebook']);
      if (empty($edit_app_dev_facebook)) {
        $edit_app_dev_facebook = NULL;
      }

      $edit_app_dev_whatsapp = $purifier->purify($_POST['edit_app_dev_whatsapp']);
      if (empty($edit_app_dev_whatsapp)) {
        $edit_app_dev_whatsapp = NULL;
      }

      if (empty($error)) { // If everything's OK.
        $edit_app_dev_name = $edit_app_dev_first_name . "_" . $edit_app_dev_last_name;
        // select former app developers name
        $query_former_app_dev = mysqli_query($dbcon, "SELECT * FROM app_dev WHERE app_dev_id=$select_app_dev");
        if (mysqli_num_rows($query_former_app_dev) == 1) {
          $fetch_former_app_dev = mysqli_fetch_assoc($query_former_app_dev);
          $former_app_dev_first_name = $purifier->purify($fetch_former_app_dev['app_dev_first_name']);
          $former_app_dev_last_name = $purifier->purify($fetch_former_app_dev['app_dev_last_name']);
          $former_app_dev_desc = $purifier->purify($fetch_former_app_dev['description']);
          $former_app_dev_lang = $purifier->purify($fetch_former_app_dev['prog_lang']);
          $former_app_dev_framework = $purifier->purify($fetch_former_app_dev['frame_work']);
          $former_app_dev_image = $purifier->purify($fetch_former_app_dev['app_dev_pic']);
          $former_app_dev_mobile = $purifier->purify($fetch_former_app_dev['mobile']);
          $former_app_dev_email = $purifier->purify($fetch_former_app_dev['email']);
          $former_app_dev_twitter = $purifier->purify($fetch_former_app_dev['twitter']);
          $former_app_dev_facebook = $purifier->purify($fetch_former_app_dev['facebook']);
          $former_app_dev_whatsapp = $purifier->purify($fetch_former_app_dev['whatsapp']);
          $former_app_dev_name = $former_app_dev_first_name . "_" . $former_app_dev_last_name;
          if (!isset($edit_app_dev_first_name)) {
            $edit_app_dev_name = $former_app_dev_name;
            $edit_app_dev_first_name = $former_app_dev_first_name;
            $edit_app_dev_last_name = $former_app_dev_last_name;
          } else { // Rename the former app developers directory to the new one
            define('FORMER_APP_DEV_DIR', "../app_dev/$former_app_dev_name/");
            if (is_dir(FORMER_APP_DEV_DIR)) {
              rename(realpath(dirname(__FILE__)) . "/../app_dev/$former_app_dev_name/", realpath(dirname(__FILE__)) . "/../app_dev/$edit_app_dev_name/");
            }
          }
          if (!isset($edit_app_dev_desc)) {
            $edit_app_dev_desc = $former_app_dev_desc;
          }
          if (!isset($edit_app_dev_lang)) {
            $edit_app_dev_lang = $former_app_dev_lang;
          }
          if (!isset($edit_app_dev_framework)) {
            if (!empty($former_app_dev_framework)) {
              $edit_app_dev_framework = $former_app_dev_framework;
            } else $edit_app_dev_framework = NULL;
          }
          if (!isset($edit_app_dev_mobile)) {
            $edit_app_dev_mobile = $former_app_dev_mobile;
          }
          if (!isset($edit_app_dev_email)) {
            $edit_app_dev_email = $former_app_dev_email;
          }
          if (!isset($edit_app_dev_twitter_id)) {
            if (!empty($former_app_dev_twitter)) {
              $edit_app_dev_twitter = $former_app_dev_twitter;
            } else $edit_app_dev_twitter = NULL;
          } else {
            $edit_app_dev_twitter = "<a href='https://twitter.com/messages/compose?recipient_id=$edit_app_dev_twitter_id&ref_src=twsrc%5Etfw'
            style='font-size:22px;' class='twitter-dm-button d-inline' data-text='Hello! $edit_app_dev_twitter_un'
            data-show-screen-name='$edit_app_dev_twitter_un' data-screen-name='$edit_app_dev_twitter_un' data-show-count='false'><i class='fab fa-twitter'></i></a>";
          }
          if (!isset($edit_app_dev_facebook)) {
            if (!empty($former_app_dev_facebook)) {
              $edit_app_dev_facebook = $former_app_dev_facebook;
            } else $edit_app_dev_facebook = NULL;
          }
          if (!isset($edit_app_dev_whatsapp)) {
            if (!empty($former_app_dev_whatsapp)) {
              $edit_app_dev_whatsapp = $former_app_dev_whatsapp;
            } else $edit_app_dev_whatsapp = NULL;
          } else {
            $edit_app_dev_whatsapp = "https://wa.me/$edit_app_dev_whatsapp?text=Hello%20$edit_app_dev_first_name%20$edit_app_dev_last_name";
          }
        }
        define('APP_DEV_DIR', "../app_dev/$edit_app_dev_name/");
        $app_dev_dir = APP_DEV_DIR;
        // check for app dev profile pic
        if (isset($_FILES['edit_app_dev_image']['tmp_name']) || is_uploaded_file($_FILES['edit_app_dev_image']['tmp_name'])) {
          // Validate the type Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['edit_app_dev_image']['type'], $allowed)) {
            $file_name = $_FILES['edit_app_dev_image']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $file_name = "$edit_app_dev_name.$ext";
            // Check if destination dir exist
            if (!is_dir(APP_DEV_DIR)) {
              mkdir(APP_DEV_DIR, 0777, true);
            }
            $saveto = APP_DEV_DIR . $file_name; // File destination
            //checking if file exsists
            if (file_exists($saveto)) unlink($saveto);
            // Delete other image files
            $image_filenames = glob("$app_dev_dir*.{jpg,jpeg,png}", GLOB_BRACE);
            foreach ($image_filenames as $image_filename) {
              unlink($image_filename);
            }
            if (move_uploaded_file($_FILES['edit_app_dev_image']['tmp_name'], $saveto)) {
              // Uploaded app image has been moved
              $edit_app_dev_image = "app_dev/$edit_app_dev_name/$file_name";
              $query_update_app_dev_pic = "UPDATE app_dev SET app_dev_pic=? WHERE app_dev_id=? LIMIT 1";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_app_dev_pic);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'si', $edit_app_dev_image, $select_app_dev);
              // execute query
              mysqli_stmt_execute($q);
            } else {
              $errorstring = "System is busy please try later.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image.";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['edit_app_dev_image']['tmp_name']) && is_file($_FILES['edit_app_dev_image']['tmp_name'])) {
          unlink($_FILES['edit_app_dev_image']['tmp_name']);
        }
        $query_update_app_dev_edit = "UPDATE app_dev SET app_dev_first_name=?, app_dev_last_name=?, description=?, prog_lang=?, frame_work=?, mobile=?, email=?, twitter=?, facebook=?, whatsapp=? WHERE app_dev_id=? LIMIT 1";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query_update_app_dev_edit);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'ssssssssssi', $edit_app_dev_first_name, $edit_app_dev_last_name, $edit_app_dev_desc, $edit_app_dev_lang, $edit_app_dev_framework, $edit_app_dev_mobile, $edit_app_dev_email, $edit_app_dev_twitter, $edit_app_dev_facebook, $edit_app_dev_whatsapp, $select_app_dev);
        // execute query
        mysqli_stmt_execute($q);
        $sucstring = "App developer edited successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for app developer deletion
  if (isset($_POST['delete_appDev'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app_dev = $purifier->purify($_POST['select_app_dev']);
      if (empty($select_app_dev)) {
        $error[] = "Select app developers name...";
      }

      if (empty($error)) { // If everything's OK.
        //delete developer and its directory
        $query_appDevName = mysqli_query($dbcon, "SELECT CONCAT_WS('_', app_dev_first_name, app_dev_last_name) as app_dev_name FROM app_dev WHERE app_dev_id=$select_app_dev");
        if (mysqli_num_rows($query_appDevName) == 1) {
          $fetch_appDevName = mysqli_fetch_assoc($query_appDevName);
          $appDevName = $purifier->purify($fetch_appDevName['app_dev_name']);
          define('APPDEVNAME_DIR', "../app_dev/$appDevName"); // former folder name
          // delete from database
          $queryDelAppDev = "DELETE FROM app_dev WHERE app_dev_id=? LIMIT 1";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $queryDelAppDev);
          // bind values to SQL statement
          mysqli_stmt_bind_param($q, 'i', $select_app_dev);
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
            // delete his/her directory
            removeDir(APPDEVNAME_DIR);
            $sucstring = "Developer deleted successfully!";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for post addition
  if (isset($_POST['add_post'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------

      $select_app = $purifier->purify($_POST['select_app']);
      if (empty($select_app)) {
        $error[] = "Select app name...";
      }

      $msg_header = $purifier->purify($_POST['msg_header']);
      if (empty($msg_header)) {
        $error[] = "Blog post must have an title/header...";
      }

      $post_msg = $purifier->purify($_POST['post_msg']);
      if (empty($post_msg)) {
        $error[] = "You must input at least the first paragraph...";
      }

      $post_msg_2 = $purifier->purify($_POST['post_msg_2']);
      if (empty($post_msg_2)) {
        $post_msg_2 = NULL;
      }

      $post_msg_3 = $purifier->purify($_POST['post_msg_3']);
      if (empty($post_msg_3)) {
        $post_msg_3 = NULL;
      }

      $post_pic = $_FILES['post_pic'];
      if (empty($post_pic)) {
        $post_pic = NULL;
      }

      $post_audio = $_FILES['post_audio'];
      if (empty($post_audio)) {
        $post_audio = NULL;
      }

      $post_video = $_FILES['post_video'];
      if (empty($post_video)) {
        $post_video = NULL;
      }

      $post_youtube_url = $purifier->purify($_POST['post_youtube_url']);
      if (empty($post_youtube_url)) {
        $post_youtube_url = NULL;
      }

      $tag_posts = isset($_POST['tag_post']) ? array_filter($_POST['tag_post']) : '';
      if (empty($tag_posts)) {
        $tagged_post = NULL;
      } else {
        $tags = array();
        foreach ($tag_posts as $tag_post) {
          $tags[] = $tag_post;
        }
        $implodeTag = implode(',', $tags);
        $tagged_post = $implodeTag;
      }

      $newsfeedshow = $purifier->purify($_POST['newsfeedshow']);
      if (empty($newsfeedshow) or (int)$newsfeedshow != 1) {
        $newsfeedshow = 0;
      }

      $post_pic_1 = $_FILES['post_pic_1'];
      if (empty($post_pic_1)) {
        $post_pic_1 = NULL;
      }
      $post_pic_2 = $_FILES['post_pic_2'];
      if (empty($post_pic_2)) {
        $post_pic_2 = NULL;
      }
      $post_pic_3 = $_FILES['post_pic_3'];
      if (empty($post_pic_3)) {
        $post_pic_3 = NULL;
      }
      $post_pic_4 = $_FILES['post_pic_4'];
      if (empty($post_pic_4)) {
        $post_pic_4 = NULL;
      }
      $post_pic_5 = $_FILES['post_pic_5'];
      if (empty($post_pic_5)) {
        $post_pic_5 = NULL;
      }
      $post_pic_6 = $_FILES['post_pic_6'];
      if (empty($post_pic_6)) {
        $post_pic_6 = NULL;
      }
      $post_pic_7 = $_FILES['post_pic_7'];
      if (empty($post_pic_7)) {
        $post_pic_7 = NULL;
      }
      $post_pic_8 = $_FILES['post_pic_8'];
      if (empty($post_pic_8)) {
        $post_pic_8 = NULL;
      }
      $post_pic_9 = $_FILES['post_pic_9'];
      if (empty($post_pic_9)) {
        $post_pic_9 = NULL;
      }
      $post_pic_10 = $_FILES['post_pic_10'];
      if (empty($post_pic_10)) {
        $post_pic_10 = NULL;
      }
      $post_pic_11 = $_FILES['post_pic_11'];
      if (empty($post_pic_11)) {
        $post_pic_11 = NULL;
      }
      $post_pic_12 = $_FILES['post_pic_12'];
      if (empty($post_pic_12)) {
        $post_pic_12 = NULL;
      }
      $post_pic_13 = $_FILES['post_pic_13'];
      if (empty($post_pic_13)) {
        $post_pic_13 = NULL;
      }
      $post_pic_14 = $_FILES['post_pic_14'];
      if (empty($post_pic_14)) {
        $post_pic_14 = NULL;
      }
      $post_pic_15 = $_FILES['post_pic_15'];
      if (empty($post_pic_15)) {
        $post_pic_15 = NULL;
      }

      if (empty($error)) { // If everything's OK.
        $queryAdminPostNum = mysqli_query($dbcon, "SELECT MAX(admin_post_num) AS admin_post_num FROM post WHERE admin_post_num IS NOT NULL");
        // Check the result:
        if (mysqli_num_rows($queryAdminPostNum) == 1) {
          $fetch_adminPostNum = mysqli_fetch_assoc($queryAdminPostNum);
          $adminPostNum = $purifier->purify($fetch_adminPostNum['admin_post_num']);
          $adminPostNum++;
        } else {
          $adminPostNum = 1;
        }
        $adminPostFolder = $adminPostNum . "_post";
        // define admin posts folder
        define('ADMIN_POST_DIR', "../admin_post/$adminPostFolder/");
        $adminPostDir = ADMIN_POST_DIR;
        //check for post_pic
        if (!empty($_FILES['post_pic']['tmp_name']) || is_uploaded_file($_FILES['post_pic']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic']['type'], $allowed)) {
            $file_name = $_FILES['post_pic']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic.$ext"; // File destination
            if ($_FILES['post_pic']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic = "admin_post/$adminPostFolder/post_pic.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic = $adminPicture;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic']['tmp_name']) && is_file($_FILES['post_pic']['tmp_name'])) {
          unlink($_FILES['post_pic']['tmp_name']);
        }
        //check for post audio file
        if (!empty($_FILES['post_audio']['tmp_name']) || is_uploaded_file($_FILES['post_audio']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/wave', 'audio/ogg', 'audio/oga', 'audio/mp4', 'audio/m4a', 'audio/webm'];
          if (in_array($_FILES['post_audio']['type'], $allowed)) {
            $file_name = $_FILES['post_audio']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_audio.$ext"; // File destination
            //checking if file exsists
            if (file_exists($saveto)) unlink($saveto);
            if (move_uploaded_file($_FILES['post_audio']['tmp_name'], $saveto)) {
              // Uploaded audio file has been moved
              $post_audio = "admin_post/$adminPostFolder/post_audio.$ext";
            } else {
              $errorstring = "System is busy please try later.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload an audio file type";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_audio = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_audio']['tmp_name']) && is_file($_FILES['post_audio']['tmp_name'])) {
          unlink($_FILES['post_audio']['tmp_name']);
        }
        //check for post video file
        if (!empty($_FILES['post_video']['tmp_name']) || is_uploaded_file($_FILES['post_video']['tmp_name'])) {
          // Validate the type. Should be mp4 or webm.
          $allowed = ['video/mp4', 'video/webm', 'video/webmv', 'video/ogg', 'video/ogv'];
          if (in_array($_FILES['post_video']['type'], $allowed)) {
            $file_name = $_FILES['post_video']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_video.$ext"; // File destination
            //checking if file exsists
            if (file_exists($saveto)) unlink($saveto);
            if (move_uploaded_file($_FILES['post_video']['tmp_name'], $saveto)) {
              // Uploaded audio file has been moved
              $post_video = "admin_post/$adminPostFolder/post_video.$ext";
            } else {
              $errorstring = "System is busy please try later.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload an audio file type";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_video = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_video']['tmp_name']) && is_file($_FILES['post_video']['tmp_name'])) {
          unlink($_FILES['post_video']['tmp_name']);
        }
        //check for post_pic_1
        if (!empty($_FILES['post_pic_1']['tmp_name']) || is_uploaded_file($_FILES['post_pic_1']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_1']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_1']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_1.$ext"; // File destination
            if ($_FILES['post_pic_1']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_1']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_1 = "admin_post/$adminPostFolder/post_pic_1.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_1 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_1']['tmp_name']) && is_file($_FILES['post_pic_1']['tmp_name'])) {
          unlink($_FILES['post_pic_1']['tmp_name']);
        }
        //check for post_pic_2
        if (!empty($_FILES['post_pic_2']['tmp_name']) || is_uploaded_file($_FILES['post_pic_2']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_2']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_2']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_2.$ext"; // File destination
            if ($_FILES['post_pic_2']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_2']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_2 = "admin_post/$adminPostFolder/post_pic_2.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_2 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_2']['tmp_name']) && is_file($_FILES['post_pic_2']['tmp_name'])) {
          unlink($_FILES['post_pic_2']['tmp_name']);
        }
        //check for post_pic_3
        if (!empty($_FILES['post_pic_3']['tmp_name']) || is_uploaded_file($_FILES['post_pic_3']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_3']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_3']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_3.$ext"; // File destination
            if ($_FILES['post_pic_3']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_3']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_3 = "admin_post/$adminPostFolder/post_pic_3.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_3 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_3']['tmp_name']) && is_file($_FILES['post_pic_3']['tmp_name'])) {
          unlink($_FILES['post_pic_3']['tmp_name']);
        }
        //check for post_pic_4
        if (!empty($_FILES['post_pic_4']['tmp_name']) || is_uploaded_file($_FILES['post_pic_4']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_4']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_4']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_4.$ext"; // File destination
            if ($_FILES['post_pic_4']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_4']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_4 = "admin_post/$adminPostFolder/post_pic_4.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_4 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_4']['tmp_name']) && is_file($_FILES['post_pic_4']['tmp_name'])) {
          unlink($_FILES['post_pic_4']['tmp_name']);
        }
        //check for post_pic_5
        if (!empty($_FILES['post_pic_5']['tmp_name']) || is_uploaded_file($_FILES['post_pic_5']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_5']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_5']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_5.$ext"; // File destination
            if ($_FILES['post_pic_5']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_5']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_5 = "admin_post/$adminPostFolder/post_pic_5.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_5 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_5']['tmp_name']) && is_file($_FILES['post_pic_5']['tmp_name'])) {
          unlink($_FILES['post_pic_5']['tmp_name']);
        }
        //check for post_pic_6
        if (!empty($_FILES['post_pic_6']['tmp_name']) || is_uploaded_file($_FILES['post_pic_6']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_6']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_6']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_6.$ext"; // File destination
            if ($_FILES['post_pic_6']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_6']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_6 = "admin_post/$adminPostFolder/post_pic_6.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_6 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_6']['tmp_name']) && is_file($_FILES['post_pic_6']['tmp_name'])) {
          unlink($_FILES['post_pic_6']['tmp_name']);
        }
        //check for post_pic_7
        if (!empty($_FILES['post_pic_7']['tmp_name']) || is_uploaded_file($_FILES['post_pic_7']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_7']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_7']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_7.$ext"; // File destination
            if ($_FILES['post_pic_7']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_7']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_7 = "admin_post/$adminPostFolder/post_pic_7.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_7 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_7']['tmp_name']) && is_file($_FILES['post_pic_7']['tmp_name'])) {
          unlink($_FILES['post_pic_7']['tmp_name']);
        }
        //check for post_pic_8
        if (!empty($_FILES['post_pic_8']['tmp_name']) || is_uploaded_file($_FILES['post_pic_8']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_8']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_8']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_8.$ext"; // File destination
            if ($_FILES['post_pic_8']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_8']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_8 = "admin_post/$adminPostFolder/post_pic_8.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_8 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_8']['tmp_name']) && is_file($_FILES['post_pic_8']['tmp_name'])) {
          unlink($_FILES['post_pic_8']['tmp_name']);
        }
        //check for post_pic_9
        if (!empty($_FILES['post_pic_9']['tmp_name']) || is_uploaded_file($_FILES['post_pic_9']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_9']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_9']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_9.$ext"; // File destination
            if ($_FILES['post_pic_9']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_9']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_9 = "admin_post/$adminPostFolder/post_pic_9.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_9 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_9']['tmp_name']) && is_file($_FILES['post_pic_9']['tmp_name'])) {
          unlink($_FILES['post_pic_9']['tmp_name']);
        }
        //check for post_pic_10
        if (!empty($_FILES['post_pic_10']['tmp_name']) || is_uploaded_file($_FILES['post_pic_10']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_10']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_10']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_10.$ext"; // File destination
            if ($_FILES['post_pic_10']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_10']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_10 = "admin_post/$adminPostFolder/post_pic_10.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_10 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_10']['tmp_name']) && is_file($_FILES['post_pic_10']['tmp_name'])) {
          unlink($_FILES['post_pic_10']['tmp_name']);
        }
        //check for post_pic_11
        if (!empty($_FILES['post_pic_11']['tmp_name']) || is_uploaded_file($_FILES['post_pic_11']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_11']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_11']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_11.$ext"; // File destination
            if ($_FILES['post_pic_11']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_11']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_11 = "admin_post/$adminPostFolder/post_pic_11.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_11 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_11']['tmp_name']) && is_file($_FILES['post_pic_11']['tmp_name'])) {
          unlink($_FILES['post_pic_11']['tmp_name']);
        }
        //check for post_pic_12
        if (!empty($_FILES['post_pic_12']['tmp_name']) || is_uploaded_file($_FILES['post_pic_12']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_12']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_12']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_12.$ext"; // File destination
            if ($_FILES['post_pic_12']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_12']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_12 = "admin_post/$adminPostFolder/post_pic_12.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_12 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_12']['tmp_name']) && is_file($_FILES['post_pic_12']['tmp_name'])) {
          unlink($_FILES['post_pic_12']['tmp_name']);
        }
        //check for post_pic_13
        if (!empty($_FILES['post_pic_13']['tmp_name']) || is_uploaded_file($_FILES['post_pic_13']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_13']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_13']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_13.$ext"; // File destination
            if ($_FILES['post_pic_13']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_13']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_13 = "admin_post/$adminPostFolder/post_pic_13.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_13 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_13']['tmp_name']) && is_file($_FILES['post_pic_13']['tmp_name'])) {
          unlink($_FILES['post_pic_13']['tmp_name']);
        }
        //check for post_pic_14
        if (!empty($_FILES['post_pic_14']['tmp_name']) || is_uploaded_file($_FILES['post_pic_14']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_14']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_14']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_14.$ext"; // File destination
            if ($_FILES['post_pic_14']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_14']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_14 = "admin_post/$adminPostFolder/post_pic_14.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_14 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_14']['tmp_name']) && is_file($_FILES['post_pic_14']['tmp_name'])) {
          unlink($_FILES['post_pic_14']['tmp_name']);
        }
        //check for post_pic_15
        if (!empty($_FILES['post_pic_15']['tmp_name']) || is_uploaded_file($_FILES['post_pic_15']['tmp_name'])) {
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['post_pic_15']['type'], $allowed)) {
            $file_name = $_FILES['post_pic_15']['name'];
            // Check if destination dir exist
            if (!is_dir(ADMIN_POST_DIR)) {
              mkdir(ADMIN_POST_DIR, 0777, true);
            }
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $saveto = ADMIN_POST_DIR . "post_pic_15.$ext"; // File destination
            if ($_FILES['post_pic_15']['size'] < 1048576) {
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['post_pic_15']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $post_pic_15 = "admin_post/$adminPostFolder/post_pic_15.$ext";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid larger than 1Mb.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $post_pic_15 = NULL;
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['post_pic_15']['tmp_name']) && is_file($_FILES['post_pic_15']['tmp_name'])) {
          unlink($_FILES['post_pic_15']['tmp_name']);
        }
        // insert into post
        $addPostQuery = "INSERT INTO post (user_id, app_id, admin_post_num, admin_post_dir, msg_header, post_msg, post_msg_2, post_msg_3,
        post_pic, post_audio, post_video, youtube_url, tag_users, newsfeedshow, user_level, date_time) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $addPostQuery);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param(
          $q,
          'iiissssssssssii',
          $adminUser_id,
          $select_app,
          $adminPostNum,
          $adminPostDir,
          $msg_header,
          $post_msg,
          $post_msg_2,
          $post_msg_3,
          $post_pic,
          $post_audio,
          $post_video,
          $post_youtube_url,
          $tagged_post,
          $newsfeedshow,
          $admin_userLevel
        );
        // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) {
          $lastInsertedPost_ID = mysqli_insert_id($dbcon);
          $queryAppUrl = mysqli_query($dbcon, "SELECT app_url FROM apps WHERE app_id=$select_app");
          if (mysqli_num_rows($queryAppUrl) == 1) {
            // fetch the records
            $fetch_queryAppUrl = mysqli_fetch_assoc($queryAppUrl);
            $app_url  = $purifier->purify($fetch_queryAppUrl['app_url']);
          }
          // get all user id for app visit insertion
          $queryUserID = mysqli_query($dbcon, "SELECT user_id FROM users WHERE user_id!=$adminUser_id");
          // Check the result:
          if (mysqli_num_rows($queryUserID) > 0) {
            // fetch the records
            while ($fetch_queryUserID = mysqli_fetch_assoc($queryUserID)) {
              $user_idNoti  = $purifier->purify($fetch_queryUserID['user_id']);
              $noti_link = BASE_URL . $app_url . "post.php?pid=$lastInsertedPost_ID&uid=$user_idNoti";
              mysqli_query($dbcon, "INSERT INTO notification (post_id, noti_header, noti_body, user_from,
              user_to, noti_pic, description, noti_link, user_level, additional_info, date_time) VALUES ($lastInsertedPost_ID,
              '$adminPost_header', '$msg_header', $adminUser_id, $user_idNoti, '$post_pic',
              '$adminPost_description', '$noti_link', $admin_userLevel, $adminPostNum, Now())");
            }
          }

          // insert more pics if any?
          if (
            !empty($post_pic_1) or !empty($post_pic_2) or !empty($post_pic_3) or !empty($post_pic_4) or !empty($post_pic_5) or !empty($post_pic_6)
            or !empty($post_pic_7) or !empty($post_pic_8) or !empty($post_pic_9) or !empty($post_pic_10) or !empty($post_pic_11) or !empty($post_pic_12)
            or !empty($post_pic_13) or !empty($post_pic_14) or !empty($post_pic_15)
          ) {
            // insert into post_pic
            $addPost_picQuery = "INSERT INTO post_pic (post_id, post_pic_1, post_pic_2, post_pic_3, post_pic_4, post_pic_5, post_pic_6, post_pic_7, post_pic_8,
            post_pic_9, post_pic_10, post_pic_11, post_pic_12, post_pic_13, post_pic_14, post_pic_15, user_level) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $addPost_picQuery);
            // use prepared statement to insure that only text is inserted
            // bind fields to SQL Statement
            mysqli_stmt_bind_param(
              $q,
              'isssssssssssssssi',
              $lastInsertedPost_ID,
              $post_pic_1,
              $post_pic_2,
              $post_pic_3,
              $post_pic_4,
              $post_pic_5,
              $post_pic_6,
              $post_pic_7,
              $post_pic_8,
              $post_pic_9,
              $post_pic_10,
              $post_pic_11,
              $post_pic_12,
              $post_pic_13,
              $post_pic_14,
              $post_pic_15,
              $admin_userLevel
            );
            // execute query
            mysqli_stmt_execute($q);
          }
        }
        $sucstring = "Post has been added successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for artist addition
  if (isset($_POST['add_artist'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $artist_name = $purifier->purify($_POST['artist_name']);
      if (!empty($artist_name)) {
        $artist_name = ucwords($artist_name);
      } else $error[] = "Enter Artist name...";

      $artist_image = $_FILES['artist_image'];
      if (empty($artist_image)) {
        $artist_image = "$adminPicture";
      }

      $artist_desc = $purifier->purify($_POST['artist_desc']);
      if (!empty($artist_desc) && strlen($artist_desc) <= 250) {
        //Sanitize the trimmed $artist_desc
        $artist_desc = $artist_desc;
      } else {
        $artist_desc = NULL;
      }

      if (empty($error)) { // If everything's OK.
        // check if artist name exist?
        $query_artist_name = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_name='$artist_name'");
        // Check the result:
        if (mysqli_num_rows($query_artist_name) == 0) { // artist name does not exist
          $artist_nameDirName = preg_replace('/\s/', '_', $artist_name);
          // check for artist pic
          if (isset($_FILES['artist_image']['tmp_name']) || is_uploaded_file($_FILES['artist_image']['tmp_name'])) {
            define('ARTIST_DIR', "../artist/$artist_nameDirName/");
            $artist_dir = ARTIST_DIR;
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['artist_image']['type'], $allowed)) {
              $file_name = $_FILES['artist_image']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$artist_nameDirName.$ext";
              // Check if destination dir exist
              if (!is_dir(ARTIST_DIR)) {
                mkdir(ARTIST_DIR, 0777, true);
              }
              $saveto = ARTIST_DIR . $file_name; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              // Delete other image files
              $image_filenames = glob("$artist_dir*.{jpg,jpeg,png}", GLOB_BRACE);
              foreach ($image_filenames as $image_filename) {
                unlink($image_filename);
              }
              if (move_uploaded_file($_FILES['artist_image']['tmp_name'], $saveto)) {
                // Uploaded app image has been moved
                $artist_pic = "artist/$artist_nameDirName/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['artist_image']['tmp_name']) && is_file($_FILES['artist_image']['tmp_name'])) {
            unlink($_FILES['artist_image']['tmp_name']);
          }
          $addArtistQuery = "INSERT INTO artist (artist_name, artist_pic, description, user_level, date_added) VALUES (?,?,?,?,NOW())";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $addArtistQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param($q, 'ssss', $artist_name, $artist_pic, $artist_desc, $admin_userLevel);
          // execute query
          mysqli_stmt_execute($q);
          $sucstring = "Artist has been added successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else { // app developers name already exist
          $errorstring = "Sorry the artist name already exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for artist spotlight addition
  if (isset($_POST['add_artist_spotlight'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------

      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select Artist name...";
      }

      $real_name = $purifier->purify($_POST['real_name']);
      if (empty($real_name)) {
        $error[] = "Artist real name can not be empty";
      }

      $born = $purifier->purify($_POST['born']);
      if (empty($born)) {
        $error[] = "Artist date of birth can not be empty";
      }

      $nationality = $purifier->purify($_POST['nationality']);
      if (empty($nationality)) {
        $error[] = "Artist nationality can not be empty";
      }

      $artist_pic_1 = $_FILES['artist_pic_1'];
      if (empty($artist_pic_1)) {
        $error[] = "Upload artist picture";
      }
      $artist_pic_2 = $_FILES['artist_pic_2'];
      if (empty($artist_pic_2)) {
        $artist_pic_2 = "Upload artist picture";
      }
      $artist_pic_3 = $_FILES['artist_pic_3'];
      if (empty($artist_pic_3)) {
        $artist_pic_3 = "Upload artist picture";
      }

      $description_1 = $purifier->purify($_POST['description_1']);
      if (empty($description_1)) {
        $error[] = "You must input at least the first paragraph...";
      }

      $description_2 = $purifier->purify($_POST['description_2']);
      if (empty($description_2)) {
        $description_2 = NULL;
      }

      $description_3 = $purifier->purify($_POST['description_3']);
      if (empty($description_3)) {
        $description_3 = NULL;
      }

      $allDescription = $description_1 . $description_2 . $description_3;
      if (str_word_count($allDescription) < 150) {
        $error[] = "Artist Description must be above 150 words!";
      }

      if (empty($error)) { // If everything's OK.
        // check if artist name exist?
        $query_artist_name = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        if (mysqli_num_rows($query_artist_name) == 1) {
          // fetch the records
          $fetch_artistName = mysqli_fetch_assoc($query_artist_name);
          $artist_name = $purifier->purify($fetch_artistName['artist_name']);
        }
        define('ARTIST_SPOTLIGHT_DIR', "../artist_spotlight/");
        // check for artist pic
        if (!empty($_FILES['artist_pic_1']['tmp_name']) || is_uploaded_file($_FILES['artist_pic_1']['tmp_name'])) {
          $artist_spotlight_dir = ARTIST_SPOTLIGHT_DIR;
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['artist_pic_1']['type'], $allowed)) {
            $file_name = $_FILES['artist_pic_1']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $file_name = "Artist_pic.$ext";
            // Check if destination dir exist
            if (!is_dir(ARTIST_SPOTLIGHT_DIR)) {
              mkdir(ARTIST_SPOTLIGHT_DIR, 0777, true);
            }
            $saveto = ARTIST_SPOTLIGHT_DIR . $file_name; // File destination
            //checking if file exsists
            if (file_exists($saveto)) unlink($saveto);

            if (move_uploaded_file($_FILES['artist_pic_1']['tmp_name'], $saveto)) {
              // Uploaded artist image has been moved
              $artist_pic_1 = "artist_spotlight/$file_name";
              $query_update_artist_pic = "UPDATE artist_spotlight SET artist_pic_1=?";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_artist_pic);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 's', $artist_pic_1);
              // execute query
              mysqli_stmt_execute($q);
            } else {
              $errorstring = "System is busy please try later.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['artist_pic_1']['tmp_name']) && is_file($_FILES['artist_pic_1']['tmp_name'])) {
          unlink($_FILES['artist_pic_1']['tmp_name']);
        }

        if (!empty($_FILES['artist_pic_2']['tmp_name']) || is_uploaded_file($_FILES['artist_pic_2']['tmp_name'])) {
          // define('ARTIST_SPOTLIGHT_DIR', "../artist_spotlight/");
          $artist_spotlight_dir = ARTIST_SPOTLIGHT_DIR;
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['artist_pic_2']['type'], $allowed)) {
            $file_name = $_FILES['artist_pic_2']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $file_name = "Artist_pic2.$ext";
            // Check if destination dir exist
            if (!is_dir(ARTIST_SPOTLIGHT_DIR)) {
              mkdir(ARTIST_SPOTLIGHT_DIR, 0777, true);
            }
            $saveto = ARTIST_SPOTLIGHT_DIR . $file_name; // File destination
            //checking if file exsists
            if (file_exists($saveto)) unlink($saveto);

            if (move_uploaded_file($_FILES['artist_pic_2']['tmp_name'], $saveto)) {
              // Uploaded app image has been moved
              $artist_pic_2 = "artist_spotlight/$file_name";
              $query_update_artist_pic = "UPDATE artist_spotlight SET artist_pic_2=?";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_artist_pic);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 's', $artist_pic_2);
              // execute query
              mysqli_stmt_execute($q);
            } else {
              $errorstring = "System is busy please try later.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['artist_pic_2']['tmp_name']) && is_file($_FILES['artist_pic_2']['tmp_name'])) {
          unlink($_FILES['artist_pic_2']['tmp_name']);
        }

        if (!empty($_FILES['artist_pic_3']['tmp_name']) || is_uploaded_file($_FILES['artist_pic_3']['tmp_name'])) {
          // define('ARTIST_SPOTLIGHT_DIR', "../artist_spotlight/");
          $artist_spotlight_dir = ARTIST_SPOTLIGHT_DIR;
          // Validate the type. Should be JPEG or PNG.
          $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
          if (in_array($_FILES['artist_pic_3']['type'], $allowed)) {
            $file_name = $_FILES['artist_pic_3']['name'];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
            $file_name = "Artist_pic3.$ext";
            // Check if destination dir exist
            if (!is_dir(ARTIST_SPOTLIGHT_DIR)) {
              mkdir(ARTIST_SPOTLIGHT_DIR, 0777, true);
            }
            $saveto = ARTIST_SPOTLIGHT_DIR . $file_name; // File destination
            //checking if file exsists
            if (file_exists($saveto)) unlink($saveto);

            if (move_uploaded_file($_FILES['artist_pic_3']['tmp_name'], $saveto)) {
              // Uploaded app image has been moved
              $artist_pic_3 = "artist_spotlight/$file_name";
              $query_update_artist_pic = "UPDATE artist_spotlight SET artist_pic_3=?";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_update_artist_pic);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 's', $artist_pic_3);
              // execute query
              mysqli_stmt_execute($q);
            } else {
              $errorstring = "System is busy please try later.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else { // Invalid type.
            $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
        // Delete the file if it still exists:
        if (file_exists($_FILES['artist_pic_3']['tmp_name']) && is_file($_FILES['artist_pic_3']['tmp_name'])) {
          unlink($_FILES['artist_pic_3']['tmp_name']);
        }

        $query_update_artist_spotlight = "UPDATE artist_spotlight SET artist_id=?, artist_name=?, real_name=?, born=?, nationality=?, description_1=?, description_2=?, description_3=?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query_update_artist_spotlight);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'isssssss', $select_artist, $artist_name, $real_name, $born, $nationality, $description_1, $description_2, $description_3);
        // execute query
        mysqli_stmt_execute($q);
        $sucstring = "Artist spotlight edited successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for album addition
  if (isset($_POST['add_album'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select Artist name...";
      }

      $select_genre = $purifier->purify($_POST['select_genre']);
      if (empty($select_genre)) {
        $error[] = "Select genre...";
      }

      $album_name = $purifier->purify($_POST['album_name']);
      if (!empty($album_name)) {
        $album_name = ucwords($album_name);
      } else $error[] = "Enter Album name...";

      $album_image = $_FILES['album_image'];
      if (empty($album_image)) {
        $error[] = "Please upload album cover photo...";
      }

      if (isset($_POST['selectyear']) && isset($_POST['selectmonth']) && isset($_POST['selectday'])) {
        $releaseDate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
        $date = date_create($purifier->purify($releaseDate));
        $m = date_format($date, 'm');
        $d = date_format($date, 'd');
        $Y = date_format($date, 'Y');
        $releaseDate = date($Y . '-' . $m . '-' . $d);
      } else $error[] = "Enter album release date...";

      if (empty($error)) { // If everything's OK.
        // check if app devs name exist?
        $query_artist_id = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($query_artist_id) == 1) {
          // fetch the records
          $fetch_artist_name = mysqli_fetch_assoc($query_artist_id);
          $artist_name = $purifier->purify($fetch_artist_name['artist_name']);
          $artist_nameDirName = preg_replace('/\s/', '_', $artist_name);
          $album_nameDirName = preg_replace('/\s/', '_', $album_name);
          // check for artist album pic
          if (isset($_FILES['album_image']['tmp_name']) || is_uploaded_file($_FILES['album_image']['tmp_name'])) {
            define('ALBUM_DIR', "../artist/$artist_nameDirName/album/$album_nameDirName/");
            $album_dir = ALBUM_DIR;
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['album_image']['type'], $allowed)) {
              $file_name = $_FILES['album_image']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$album_nameDirName.$ext";
              // Check if destination dir exist
              if (!is_dir(ALBUM_DIR)) {
                mkdir(ALBUM_DIR, 0777, true);
              }
              $saveto = ALBUM_DIR . $file_name; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              // Delete other image files
              $image_filenames = glob("$album_dir*.{jpg,jpeg,png}", GLOB_BRACE);
              foreach ($image_filenames as $image_filename) {
                unlink($image_filename);
              }
              if (move_uploaded_file($_FILES['album_image']['tmp_name'], $saveto)) {
                // Uploaded app image has been moved
                $album_pic = "artist/$artist_nameDirName/album/$album_nameDirName/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['album_image']['tmp_name']) && is_file($_FILES['album_image']['tmp_name'])) {
            unlink($_FILES['album_image']['tmp_name']);
          }
          $addAlbumQuery = "INSERT INTO album (artist_id, genre_id, album_name, album_pic, release_date) VALUES (?,?,?,?,?)";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $addAlbumQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param($q, 'sssss', $select_artist, $select_genre, $album_name, $album_pic, $releaseDate);
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) {
            $lastInsertedAlbum_ID = mysqli_insert_id($dbcon);
            // Insert into Music Blog
            $addMusicBlog = "INSERT INTO music_blog (file_id, artist_id, file_name, file_pic, mime_type, date_added)
            VALUES (?,?,?,?,'album',?)";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $addMusicBlog);
            // use prepared statement to insure that only text is inserted
            // bind fields to SQL Statement
            mysqli_stmt_bind_param($q, 'iisss', $lastInsertedAlbum_ID, $select_artist, $album_name, $album_pic, $releaseDate);
            // execute query
            mysqli_stmt_execute($q);
          }
          $sucstring = "Album has been added successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else { // app developers name already exist
          $errorstring = "Sorry the artist name does not exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for audio addition
  if (isset($_POST['add_audio'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------

      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select Artist name...";
      }

      $select_app = $purifier->purify($_POST['select_app']);
      if ($select_app == 'NULL' || empty($select_app)) {
        $select_app = NULL;
      }

      $select_album = $purifier->purify($_POST['select_album']);
      if ($select_album == 'NULL' || empty($select_album)) {
        $select_album = NULL;
      }

      $audio_name = $purifier->purify($_POST['audio_name']);
      if (!empty($audio_name)) {
        $audio_name = ucfirst($audio_name);
      } else $error[] = "Enter Audio name...";

      $audio_file = $_FILES['audio_file'];
      if (empty($audio_file)) {
        $error[] = "Please upload an audio file...";
      }

      $audio_pic = $_FILES['audio_image'];
      if (empty($audio_pic)) {
        $audio_pic = "$adminPicture";
      }

      $audio_num = $purifier->purify($_POST['audio_num']);
      if (empty($audio_num) or (int)$audio_num == 0) {
        $audio_num = NULL;
      }

      $tag_artist = $purifier->purify($_POST['tag_artist']);
      if (empty($tag_artist)) {
        $tag_artist = NULL;
      }

      $lyrics = $purifier->purify($_POST['lyrics']);
      if (empty($lyrics)) {
        $lyrics = NULL;
      }

      $hit_track = $purifier->purify($_POST['hit_track']);
      if (empty($hit_track)) {
        $hit_track = "no";
      }

      $display_track = $purifier->purify($_POST['display_track']);
      if (empty($display_track)) {
        $display_track = "yes";
      }

      if (empty($error)) { // If everything's OK.
        // check if artist name exist?
        $queryAudio_artist_name = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($queryAudio_artist_name) == 1) {
          $fetch_audioArtistName = mysqli_fetch_assoc($queryAudio_artist_name);
          $audioArtistName = $purifier->purify($fetch_audioArtistName['artist_name']);
          $artist_nameDirName = preg_replace('/\s/', '_', $audioArtistName);
          define('AUDIO_DIR', "../artist/$artist_nameDirName/audio/");
          $audio_dir = AUDIO_DIR;
          // check for audio pic
          if (!empty($_FILES['audio_file']['tmp_name']) || is_uploaded_file($_FILES['audio_file']['tmp_name'])) {
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['audio/mpeg', 'audio/mp3', 'audio/wav', 'audio/wave', 'audio/ogg', 'audio/oga', 'audio/mp4', 'audio/m4a', 'audio/webm'];
            if (in_array($_FILES['audio_file']['type'], $allowed)) {
              $file_name = $_FILES['audio_file']['name'];
              $audio_name_file = preg_replace('/\s/', '_', $audio_name);
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$artist_nameDirName-$audio_name_file.$ext";
              // Check if destination dir exist
              if (!is_dir(AUDIO_DIR)) {
                mkdir(AUDIO_DIR, 0777, true);
              }
              $saveto = AUDIO_DIR . $file_name; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['audio_file']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $audio = "artist/$artist_nameDirName/audio/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload an audio file type";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['audio_file']['tmp_name']) && is_file($_FILES['audio_file']['tmp_name'])) {
            unlink($_FILES['audio_file']['tmp_name']);
          }

          // check for audio pic
          if (!empty($_FILES['audio_image']['tmp_name']) || is_uploaded_file($_FILES['audio_image']['tmp_name'])) {
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['audio_image']['type'], $allowed)) {
              $file_name = $_FILES['audio_image']['name'];
              $audio_name_file = preg_replace('/\s/', '_', $audio_name);
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$artist_nameDirName-$audio_name_file.$ext";
              // Check if destination dir exist
              if (!is_dir(AUDIO_DIR)) {
                mkdir(AUDIO_DIR, 0777, true);
              }
              $saveto = AUDIO_DIR . "$file_name"; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['audio_image']['tmp_name'], $saveto)) {
                // Uploaded audio file has been moved
                $audio_pic = "artist/$artist_nameDirName/audio/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            $audio_pic = "$adminPicture";
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['audio_image']['tmp_name']) && is_file($_FILES['audio_image']['tmp_name'])) {
            unlink($_FILES['audio_image']['tmp_name']);
          }
          $addAudioQuery = "INSERT INTO audio (app_id, user_id, artist_id, album_id, audio_name, audio_file, audio_pic, audio_number,
          tagged_artist, lyrics, hit_track, user_level, date_added) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,NOW())";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $addAudioQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param(
            $q,
            'iiiisssisssi',
            $select_app,
            $adminUser_id,
            $select_artist,
            $select_album,
            $audio_name,
            $audio,
            $audio_pic,
            $audio_num,
            $tag_artist,
            $lyrics,
            $hit_track,
            $admin_userLevel
          );
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) {
            $lastInsertedAudio_ID = mysqli_insert_id($dbcon);
            // select artist name and app url for notification insertion
            $queryArtistName = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
            if (mysqli_num_rows($queryArtistName) == 1) {
              $fetch_queryArtistName = mysqli_fetch_assoc($queryArtistName);
              $artistName  = $purifier->purify($fetch_queryArtistName['artist_name']);
            }
            $queryAppID = mysqli_query($dbcon, "SELECT app_url FROM apps WHERE app_id=$select_app");
            if (mysqli_num_rows($queryAppID) == 1) {
              // fetch the records
              $fetch_queryAppID = mysqli_fetch_assoc($queryAppID);
              $app_url  = $purifier->purify($fetch_queryAppID['app_url']);
            }
            // get all user id for app visit insertion
            $queryUserID = mysqli_query($dbcon, "SELECT user_id FROM users WHERE user_id!=$adminUser_id");
            // Check the result:
            if (mysqli_num_rows($queryUserID) > 0 && $display_track == 'yes') {
              // fetch the records
              while ($fetch_queryUserID = mysqli_fetch_assoc($queryUserID)) {
                $user_idNoti  = $purifier->purify($fetch_queryUserID['user_id']);
                $noti_link = BASE_URL . $app_url . "music.php?mid=$lastInsertedAudio_ID&aid=$select_artist";
                $noti_body = "$audio_name by: $artistName";
                mysqli_query($dbcon, "INSERT INTO notification (post_id, noti_header, noti_body, user_from,
                user_to, noti_pic, description, noti_link, user_level, additional_info, date_time) VALUES ($lastInsertedAudio_ID,
                '$newMusic_header', '$noti_body', $adminUser_id, $user_idNoti, '$audio_pic',
                '$newMusic_description', '$noti_link', $admin_userLevel, $select_artist, Now())");
              }
            }
            // Insert to Music Blog
            $addMusicBlog = "INSERT INTO music_blog (file_id, artist_id, file_name, file_pic, tagged_artist, display_track, mime_type, date_added)
            VALUES (?,?,?,?,?,?,'audio',NOW())";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $addMusicBlog);
            // use prepared statement to insure that only text is inserted
            // bind fields to SQL Statement
            mysqli_stmt_bind_param($q, 'iissss', $lastInsertedAudio_ID, $select_artist, $audio_name, $audio_pic, $tag_artist, $display_track);
            // execute query
            mysqli_stmt_execute($q);
          }
          $sucstring = "Audio has been added successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else { // Artist name does not exist
          $errorstring = "Sorry the artist name does not exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for video addition
  if (isset($_POST['add_video'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------

      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select Artist name...";
      }

      $select_song = $purifier->purify($_POST['select_song']);
      if ($select_song == 'NULL' || empty($select_song)) {
        $select_song = NULL;
      }

      $select_album = $purifier->purify($_POST['select_album']);
      if ($select_album == 'NULL' || empty($select_album)) {
        $select_album = NULL;
      }

      $video_name = $purifier->purify($_POST['video_name']);
      if (!empty($video_name)) {
        $video_name = ucfirst($video_name);
      } else $error[] = "Enter Video name...";

      $video_file = isset($_FILES['video_file']);
      if (empty($video_file)) {
        $video_file = NULL;
      }

      if (isset($_POST['youtube_url'])) {
        $youtube_url = sanitizeString($_POST['youtube_url']);
      } else {
        $youtube_url = NULL;
      }

      if (empty($video_file) && empty($youtube_url)) {
        $error[] = "Please upload a video file or enter a youtube url...";
      }

      if (!empty($video_file) && !empty($youtube_url)) {
        $error[] = "Either upload a video file or enter a youtube url...";
      }

      $video_pic = $_FILES['video_image'];
      if (empty($video_pic)) {
        $video_pic = "$adminPicture";
      }

      $tag_artist = $purifier->purify($_POST['tag_artist']);
      if (empty($tag_artist)) {
        $tag_artist = NULL;
      }

      $hit_track = $purifier->purify($_POST['hit_track']);
      if (empty($hit_track)) {
        $hit_track = "no";
      }

      $display_track = $purifier->purify($_POST['display_track']);
      if (empty($display_track)) {
        $display_track = "yes";
      }

      if (empty($error)) { // If everything's OK.
        // check if artist name exist?
        $queryVideo_artist_name = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($queryVideo_artist_name) == 1) {
          $fetch_videoArtistName = mysqli_fetch_assoc($queryVideo_artist_name);
          $videoArtistName = $purifier->purify($fetch_videoArtistName['artist_name']);
          $artist_nameDirName = preg_replace('/\s/', '_', $videoArtistName);
          define('VIDEO_DIR', "../artist/$artist_nameDirName/video/");
          $video_dir = VIDEO_DIR;
          // check for video file
          if (isset($_FILES['video_file']['tmp_name'])) {
            // Validate the type. Should be mp4 or webm.
            $allowed = ['video/mp4', 'video/webm', 'video/webmv', 'video/ogg', 'video/ogv'];
            if (in_array($_FILES['video_file']['type'], $allowed)) {
              $file_name = $_FILES['video_file']['name'];
              $video_name_file = preg_replace('/\s/', '_', $video_name);
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$artist_nameDirName-$video_name_file.$ext";
              // Check if destination dir exist
              if (!is_dir(VIDEO_DIR)) {
                mkdir(VIDEO_DIR, 0777, true);
              }
              //$videoFileName = pathinfo($file_name, PATHINFO_FILENAME); // Get file name without extension
              //$ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $saveto = VIDEO_DIR . "$file_name"; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['video_file']['tmp_name'], $saveto)) {
                // Uploaded video file has been moved
                $video_file = "artist/$artist_nameDirName/video/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload an video file type";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
            // Delete the file if it still exists:
            if (file_exists($_FILES['video_file']['tmp_name']) && is_file($_FILES['video_file']['tmp_name'])) {
              unlink($_FILES['video_file']['tmp_name']);
            }
          }

          // check for video pic
          if (!empty($_FILES['video_image']['tmp_name']) || is_uploaded_file($_FILES['video_image']['tmp_name'])) {
            // Validate the type. Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['video_image']['type'], $allowed)) {
              $file_name = $_FILES['video_image']['name'];
              $video_name_file = preg_replace('/\s/', '_', $video_name);
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$artist_nameDirName-$video_name_file.$ext";
              // Check if destination dir exist
              if (!is_dir(VIDEO_DIR)) {
                mkdir(VIDEO_DIR, 0777, true);
              }
              $saveto = VIDEO_DIR . "$file_name"; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              if (move_uploaded_file($_FILES['video_image']['tmp_name'], $saveto)) {
                // Uploaded video file has been moved
                $video_pic = "artist/$artist_nameDirName/video/$file_name";
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            $video_pic = "$adminPicture";
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['video_image']['tmp_name']) && is_file($_FILES['video_image']['tmp_name'])) {
            unlink($_FILES['video_image']['tmp_name']);
          }
          $addAudioQuery = "INSERT INTO video (user_id, artist_id, audio_id, album_id, video_name, video_file, youtube_url, video_pic,
          tagged_artist, hit_track, user_level, date_added) VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW())";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $addAudioQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param(
            $q,
            'iiiissssssi',
            $adminUser_id,
            $select_artist,
            $select_song,
            $select_album,
            $video_name,
            $video_file,
            $youtube_url,
            $video_pic,
            $tag_artist,
            $hit_track,
            $admin_userLevel
          );
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) {
            $lastInsertedVideo_ID = mysqli_insert_id($dbcon);
            // Insert into Music Blog
            $addMusicBlog = "INSERT INTO music_blog (file_id, artist_id, file_name, file_pic, tagged_artist, display_track, mime_type, date_added)
            VALUES (?,?,?,?,?,?,'video',NOW())";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $addMusicBlog);
            // use prepared statement to insure that only text is inserted
            // bind fields to SQL Statement
            mysqli_stmt_bind_param($q, 'iissss', $lastInsertedVideo_ID, $select_artist, $video_name, $video_pic, $tag_artist, $display_track);
            // execute query
            mysqli_stmt_execute($q);
          }
          $sucstring = "Video has been added successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else { // Artist name does not exist
          $errorstring = "Sorry the artist name does not exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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
      print "(Error) The system is busy please try later";
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

  // Check for genre addition
  if (isset($_POST['add_genre'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $genre_name = $purifier->purify($_POST['genre_name']);
      if (!empty($genre_name)) {
        $genre_name = ucwords($genre_name);
      } else $error[] = "Enter Genre name...";

      $genre_desc = $purifier->purify($_POST['genre_desc']);
      if ((!empty($genre_desc)) && (strlen($genre_desc) <= 250)) {
        //Sanitize the trimmed $genre_desc
        $genre_desc = $genre_desc;
      } else {
        $genre_desc = NULL;
      }

      if (empty($error)) {
        $queryGenre = "INSERT INTO genre (genre_name, genre_description) VALUES (?,?)";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $queryGenre);
        // use prepared statement to insure that only text is inserted
        // bind fields to SQL Statement
        mysqli_stmt_bind_param($q, 'ss', $genre_name, $genre_desc);
        // execute query
        mysqli_stmt_execute($q);
        $sucstring = "Music genre has been added successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for post edition
  if (isset($_POST['edit_post'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app = $purifier->purify($_POST['select_app']);
      if (empty($select_app)) {
        $error[] = "Select app name...";
      }

      $select_postNum = $purifier->purify($_POST['select_postNum']);
      if (empty($select_postNum)) {
        $error[] = "Select post to edit...";
      }

      $msg_header = $purifier->purify($_POST['msg_header']);
      if (empty($msg_header)) {
        $error[] = "Blog post must have an title/header...";
      }

      $post_msg = $purifier->purify($_POST['post_msg']);
      if (empty($post_msg)) {
        $error[] = "You must input at least the first paragraph...";
      }

      $post_msg_2 = $purifier->purify($_POST['post_msg_2']);
      if (empty($post_msg_2)) {
        $post_msg_2 = NULL;
      }

      $post_msg_3 = $purifier->purify($_POST['post_msg_3']);
      if (empty($post_msg_3)) {
        $post_msg_3 = NULL;
      }

      if (empty($error)) { // If everything's OK.
        // update post table
        $query_update_post = "UPDATE post SET msg_header=?, post_msg=?, post_msg_2=?, post_msg_3=? WHERE admin_post_num=? AND app_id=? LIMIT 1";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query_update_post);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'ssssii',  $msg_header, $post_msg, $post_msg_2, $post_msg_3, $select_postNum, $select_app);
        // execute query
        mysqli_stmt_execute($q);
        $sucstring = "Post edited successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for artist edition
  if (isset($_POST['edit_artist'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (!empty($select_artist)) {
        //Sanitize the trimmed select_app
        $select_artist = $select_artist;
      } else {
        $error[] = "Select artist...";
      }

      $edit_artist_name = $purifier->purify($_POST['edit_artist_name']);
      if (!empty($edit_artist_name)) {
        $edit_artist_name = ucwords($edit_artist_name);
      } else $edit_artist_name = NULL;

      $edit_artist_image = $_FILES['edit_artist_image'];
      if (empty($edit_artist_image)) {
        $edit_artist_image = NULL;
      }

      $edit_artist_desc = $purifier->purify($_POST['edit_artist_desc']);
      if ((!empty($edit_artist_desc)) && (strlen($edit_artist_desc) <= 250)) {
        //Sanitize the trimmed $edit_artist_desc
        $edit_artist_desc = $edit_artist_desc;
      } else {
        $edit_artist_desc = NULL;
      }

      if (empty($error)) { // If everything's OK.
        $edit_artist_nameDirName = preg_replace('/\s/', '_', $edit_artist_name);
        // select former artist details
        $query_former_artist = mysqli_query($dbcon, "SELECT * FROM artist WHERE artist_id=$select_artist");
        if (mysqli_num_rows($query_former_artist) == 1) {
          $fetch_former_artist = mysqli_fetch_assoc($query_former_artist);
          $former_artist_name = $purifier->purify($fetch_former_artist['artist_name']);
          $former_artist_image = $purifier->purify($fetch_former_artist['artist_pic']);
          $former_artist_desc = $purifier->purify($fetch_former_artist['description']);
          $former_artist_nameDirName = preg_replace('/\s/', '_', $former_artist_name);
          if (empty($edit_artist_name)) {
            $edit_artist_nameDirName = $former_artist_nameDirName;
            $edit_artist_name = $former_artist_name;
          } else { // Rename the former artist directory to the new one
            define('FORMER_ARTIST_DIR', "../artist/$former_artist_nameDirName/");
            if (is_dir(FORMER_ARTIST_DIR)) {
              rename(realpath(dirname(__FILE__)) . "/../artist/$former_artist_nameDirName/", realpath(dirname(__FILE__)) . "/../artist/$edit_artist_nameDirName/");
            }
            mysqli_query($dbcon, "DELETE FROM notification WHERE noti_header='New music' AND additional_info='$select_artist'");
          }
          if (!isset($edit_artist_desc)) {
            if (!empty($former_artist_desc)) {
              $edit_artist_desc = $former_artist_desc;
            } else $edit_artist_desc = NULL;
          }
          define('ARTIST_DIR', "../artist/$edit_artist_nameDirName/");
          $artist_dir = ARTIST_DIR;
          // check for artist profile pic
          if (!empty($_FILES['edit_artist_image']['tmp_name']) || is_uploaded_file($_FILES['edit_artist_image']['tmp_name'])) {
            // Validate the type Should be JPEG or PNG.
            $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
            if (in_array($_FILES['edit_artist_image']['type'], $allowed)) {
              $file_name = $_FILES['edit_artist_image']['name'];
              $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
              $file_name = "$edit_artist_nameDirName.$ext";
              // Check if destination dir exist
              if (!is_dir(ARTIST_DIR)) {
                mkdir(ARTIST_DIR, 0777, true);
              }
              $saveto = ARTIST_DIR . $file_name; // File destination
              //checking if file exsists
              if (file_exists($saveto)) unlink($saveto);
              // Delete other image files
              $image_filenames = glob("$artist_dir*.{jpg,jpeg,png}", GLOB_BRACE);
              foreach ($image_filenames as $image_filename) {
                unlink($image_filename);
              }
              if (move_uploaded_file($_FILES['edit_artist_image']['tmp_name'], $saveto)) {
                // Uploaded app image has been moved
                $edit_artist_image = "artist/$edit_artist_nameDirName/$file_name";
                $query_update_artist_pic = "UPDATE artist SET artist_pic=? WHERE artist_id=? LIMIT 1";
                $q = mysqli_stmt_init($dbcon);
                mysqli_stmt_prepare($q, $query_update_artist_pic);
                // bind values to SQL statement
                mysqli_stmt_bind_param($q, 'si', $edit_artist_image, $select_artist);
                // execute query
                mysqli_stmt_execute($q);
              } else {
                $errorstring = "System is busy please try later.";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else { // Invalid type.
              $errorstring = "Please upload a JPEG or PNG image.";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            $edit_artist_image = "$adminPicture";
            $query_update_artist_pic = "UPDATE artist SET artist_pic=? WHERE artist_id=? LIMIT 1";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query_update_artist_pic);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'si', $edit_artist_image, $select_artist);
            // execute query
            mysqli_stmt_execute($q);
          }
          // Delete the file if it still exists:
          if (file_exists($_FILES['edit_artist_image']['tmp_name']) && is_file($_FILES['edit_artist_image']['tmp_name'])) {
            unlink($_FILES['edit_artist_image']['tmp_name']);
          }
          $query_update_artist_edit = "UPDATE artist SET artist_name=?, description=?, user_level=? WHERE artist_id=? LIMIT 1";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $query_update_artist_edit);
          // bind values to SQL statement
          mysqli_stmt_bind_param($q, 'ssii', $edit_artist_name, $edit_artist_desc, $admin_userLevel, $select_artist);
          // execute query
          mysqli_stmt_execute($q);
          $sucstring = "Artist edited successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        } else {
          $errorstring = "Sorry we can't find the artist been selected!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for audio edition
  if (isset($_POST['edit_audio'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_audio = $purifier->purify($_POST['select_audio']);
      if (!empty($select_audio)) {
        //Sanitize the trimmed select_app
        $select_audio = $select_audio;
      } else {
        $error[] = "Select audio...";
      }

      $edit_audio_name = $purifier->purify($_POST['edit_audio_name']);
      if (!empty($edit_audio_name)) {
        $edit_audio_name = ucfirst($edit_audio_name);
      } else $edit_audio_name = NULL;

      $select_album = $purifier->purify(isset($_POST['select_album']));
      if (empty($select_album)) {
        $select_album = NULL;
      }

      $edit_audio_num = $purifier->purify($_POST['edit_audio_num']);
      if (empty($edit_audio_num) or (int)$edit_audio_num == 0) {
        $edit_audio_num = NULL;
      }

      $edit_lyrics = $purifier->purify($_POST['edit_lyrics']);
      if (empty($edit_lyrics)) {
        $edit_lyrics = NULL;
      }

      $edit_audio_playTime = $purifier->purify($_POST['edit_audio_playTime']);
      if (empty($edit_audio_playTime)) {
        $edit_audio_playTime = NULL;
      }

      $hit_track = $purifier->purify($_POST['hit_track']);
      if (empty($hit_track)) {
        $hit_track = "no";
      }

      $audio_pic = $_FILES['audio_image'];
      if (empty($audio_pic)) {
        $audio_pic = "$adminPicture";
      }

      if (empty($error)) { // If everything's OK.
        $query_former_audio = mysqli_query($dbcon, "SELECT * FROM audio WHERE audio_id=$select_audio");
        if (mysqli_num_rows($query_former_audio) == 1) {
          $fetch_former_audio = mysqli_fetch_assoc($query_former_audio);
          $former_artist_id = $purifier->purify($fetch_former_audio['artist_id']);
          $former_album_id = $purifier->purify($fetch_former_audio['album_id']);
          $former_audio_name = $purifier->purify($fetch_former_audio['audio_name']);
          $former_audio_number = $purifier->purify($fetch_former_audio['audio_number']);
          $former_lyrics = $purifier->purify($fetch_former_audio['lyrics']);
          $former_play_time = $purifier->purify($fetch_former_audio['play_time']);

          if (empty($select_album)) {
            if (!empty($former_album_id)) {
              $select_album = $former_album_id;
            } else $select_album = NULL;
          }
          if (empty($edit_audio_name)) {
            if (!empty($former_audio_name)) {
              $edit_audio_name = $former_audio_name;
            } else $edit_audio_name = NULL;
          }
          if (empty($edit_audio_num)) {
            if (!empty($former_audio_number)) {
              $edit_audio_num = $former_audio_number;
            } else $edit_audio_num = NULL;
          }
          if (empty($edit_lyrics)) {
            if (!empty($former_lyrics)) {
              $edit_lyrics = $former_lyrics;
            } else $edit_lyrics = NULL;
          }
          if (empty($edit_audio_playTime)) {
            if (!empty($former_play_time)) {
              $edit_audio_playTime = $former_play_time;
            } else $edit_audio_playTime = NULL;
          }

          // check if artist name exist?
          $queryAudio_artist_name = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$former_artist_id");
          // Check the result:
          if (mysqli_num_rows($queryAudio_artist_name) == 1) {
            $fetch_audioArtistName = mysqli_fetch_assoc($queryAudio_artist_name);
            $audioArtistName = $purifier->purify($fetch_audioArtistName['artist_name']);
            $artist_nameDirName = preg_replace('/\s/', '_', $audioArtistName);
            define('EDIT_AUDIO_PIC_DIR', "../artist/$artist_nameDirName/audio/");
            $audio_dir = EDIT_AUDIO_PIC_DIR;
            // check for audio pic
            if (!empty($_FILES['audio_image']['tmp_name']) || is_uploaded_file($_FILES['audio_image']['tmp_name'])) {
              // Validate the type. Should be JPEG or PNG.
              $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
              if (in_array($_FILES['audio_image']['type'], $allowed)) {
                $file_name = $_FILES['audio_image']['name'];
                $audio_name_file = preg_replace('/\s/', '_', $edit_audio_name);
                $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
                $file_name = "$artist_nameDirName-$audio_name_file.$ext";
                // Check if destination dir exist
                if (!is_dir(EDIT_AUDIO_PIC_DIR)) {
                  mkdir(EDIT_AUDIO_PIC_DIR, 0777, true);
                }
                $saveto = EDIT_AUDIO_PIC_DIR . "$file_name"; // File destination
                //checking if file exsists
                if (file_exists($saveto)) unlink($saveto);
                if (move_uploaded_file($_FILES['audio_image']['tmp_name'], $saveto)) {
                  // Uploaded audio file has been moved
                  $audio_pic = "artist/$artist_nameDirName/audio/$file_name";
                } else {
                  $errorstring = "System is busy please try later.";
                  header("refresh:1; url= " . $_SERVER['PHP_SELF']);
                }
              } else { // Invalid type.
                $errorstring = "Please upload a JPEG or PNG image";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            } else {
              $audio_pic = "$adminPicture";
            }
            // Delete the file if it still exists:
            if (file_exists($_FILES['audio_image']['tmp_name']) && is_file($_FILES['audio_image']['tmp_name'])) {
              unlink($_FILES['audio_image']['tmp_name']);
            }
          } else { // Artist name does not exist
            $errorstring = "Sorry the artist name does not exist";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }

        // update audio table
        $query_update_audio = "UPDATE audio SET album_id=?, audio_name=?, audio_pic=?, audio_number=?, lyrics=?, play_time=?, hit_track=? WHERE audio_id=? LIMIT 1";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query_update_audio);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, "ississsi", $select_album, $edit_audio_name, $audio_pic, $edit_audio_num, $edit_lyrics, $edit_audio_playTime, $hit_track, $select_audio);
        // execute query
        mysqli_stmt_execute($q);
        $sucstring = "Audio edited successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      }
    } catch (Exception $e) {
      // print "An Exception occured message: " . $e->getMessage();
      print "(Exception) The system is busy please try later";
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
      print "(Error) The system is busy please try later";
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

  // Check for album edition
  if (isset($_POST['edit_album'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select artist name...";
      }

      $select_album = $purifier->purify($_POST['select_album']);
      if (empty($select_album)) {
        $error[] = "Select album...";
      }

      $select_genre = $purifier->purify($_POST['select_genre']);
      if (empty($select_genre)) {
        $error[] = "Select genre...";
      }

      $edit_album_name = $purifier->purify($_POST['edit_album_name']);
      if (!empty($edit_album_name)) {
        $edit_album_name = ucwords($edit_album_name);
      } else $error[] = "Enter Album name...";

      $edit_album_image = $_FILES['edit_album_image'];
      if (empty($edit_album_image)) {
        $error[] = "Please upload album cover photo...";
      }

      if (isset($_POST['selectyear']) && isset($_POST['selectmonth']) && isset($_POST['selectday'])) {
        $releaseDate = $_POST['selectyear'] . '-' . $_POST['selectmonth'] . '-' . $_POST['selectday'];
        $date = date_create($purifier->purify($releaseDate));
        $m = date_format($date, 'm');
        $d = date_format($date, 'd');
        $Y = date_format($date, 'Y');
        $releaseDate = date($Y . '-' . $m . '-' . $d);
      } else $error[] = "Enter album release date...";

      if (empty($error)) { // If everything's OK.
        // check if artist name exist?
        $query_artist_id = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($query_artist_id) == 1) {
          // fetch the records
          $fetch_artist_name = mysqli_fetch_assoc($query_artist_id);
          $artist_name = $purifier->purify($fetch_artist_name['artist_name']);
          $artist_nameDirName = preg_replace('/\s/', '_', $artist_name);
          $new_album_nameDirName = preg_replace('/\s/', '_', $edit_album_name);
          // check if album name exist?
          $query_album_id = mysqli_query($dbcon, "SELECT album_name FROM album WHERE album_id=$select_album");
          // Check the result:
          if (mysqli_num_rows($query_album_id) == 1) {
            // fetch the records
            $fetch_album_name = mysqli_fetch_assoc($query_album_id);
            $former_album_name = $purifier->purify($fetch_album_name['album_name']);
            $former_album_nameDirName = preg_replace('/\s/', '_', $former_album_name);
            // Rename the former album directory to the new one
            define('FORMER_ALBUM_DIR', "../artist/$artist_nameDirName/album/$former_album_nameDirName/");
            if (is_dir(FORMER_ALBUM_DIR)) {
              rename(realpath(dirname(__FILE__)) . "/../artist/$artist_nameDirName/album/$former_album_nameDirName/", realpath(dirname(__FILE__)) . "/../artist/$artist_nameDirName/album/$new_album_nameDirName/");
            }
            // check for artist album pic
            if (!empty($_FILES['edit_album_image']['tmp_name']) || is_uploaded_file($_FILES['edit_album_image']['tmp_name'])) {
              define('ALBUM_DIR', "../artist/$artist_nameDirName/album/$new_album_nameDirName/");
              $album_dir = ALBUM_DIR;
              // Validate the type. Should be JPEG or PNG.
              $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
              if (in_array($_FILES['edit_album_image']['type'], $allowed)) {
                $file_name = $_FILES['edit_album_image']['name'];
                $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
                $file_name = "$new_album_nameDirName.$ext";
                // echo $file_name;
                // Check if destination dir exist
                if (!is_dir(ALBUM_DIR)) {
                  mkdir(ALBUM_DIR, 0777, true);
                }
                $saveto = ALBUM_DIR . $file_name; // File destination
                //checking if file exsists
                if (file_exists($saveto)) unlink($saveto);
                // Delete other image files
                $image_filenames = glob("$album_dir*.{jpg,jpeg,png}", GLOB_BRACE);
                foreach ($image_filenames as $image_filename) {
                  unlink($image_filename);
                }
                if (move_uploaded_file($_FILES['edit_album_image']['tmp_name'], $saveto)) {
                  // Uploaded album image has been moved
                  $album_pic = "artist/$artist_nameDirName/album/$new_album_nameDirName/$file_name";
                  $query_update_album_pic = "UPDATE album SET album_pic=? WHERE album_id=? LIMIT 1";
                  $q = mysqli_stmt_init($dbcon);
                  mysqli_stmt_prepare($q, $query_update_album_pic);
                  // bind values to SQL statement
                  mysqli_stmt_bind_param($q, 'si', $album_pic, $select_album);
                  // execute query
                  mysqli_stmt_execute($q);
                } else {
                  $errorstring = "System is busy please try later.";
                  header("refresh:1; url= " . $_SERVER['PHP_SELF']);
                }
              } else { // Invalid type.
                $errorstring = "Please upload a JPEG or PNG image less than 1Mb";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            }
            // Delete the file if it still exists:
            if (file_exists($_FILES['edit_album_image']['tmp_name']) && is_file($_FILES['edit_album_image']['tmp_name'])) {
              unlink($_FILES['edit_album_image']['tmp_name']);
            }
            mysqli_query($dbcon, "UPDATE music_blog SET file_name=$edit_album_name, file_pic=$album_pic WHERE file_id=$select_album AND mime_type='album'");
            $query_update_album_edit = "UPDATE album SET genre_id=?, album_name=?, release_date=? WHERE album_id=? LIMIT 1";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $query_update_album_edit);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'issi',  $select_genre, $edit_album_name, $releaseDate, $select_album);
            // execute query
            mysqli_stmt_execute($q);
            $sucstring = "Album edited successfully!";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          } else { // album name does not exist
            $errorstring = "Sorry the album name does not exist";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else { // artist name does not exist
          $errorstring = "Sorry the artist name does not exist";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      }
    } catch (Exception $e) {
      print "An Exception occured message: " . $e->getMessage();
      // print "The system is busy please try later";
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
      print "An Error occured message: " . $e->getMessage();
      // print "The system is busy please try later";
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

  // Check for post deletion
  if (isset($_POST['delete_post'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_app = $purifier->purify($_POST['select_app']);
      if (empty($select_app)) {
        $error[] = "Select app name...";
      }

      $select_post = $purifier->purify($_POST['select_post']);
      if (empty($select_post)) {
        $error[] = "Select post to delete...";
      }

      if (empty($error)) { // if everything is ok
        $deleteAdminPost = mysqli_query($dbcon, "SELECT admin_post_num, admin_post_dir FROM post WHERE post_id=$select_post AND app_id=$select_app");
        // Check the result:
        if (mysqli_num_rows($deleteAdminPost) == 1) {
          $fetch_adminPost = mysqli_fetch_assoc($deleteAdminPost);
          $adminPostNum = $purifier->purify($fetch_adminPost['admin_post_num']);
          $adminPostDir = $purifier->purify($fetch_adminPost['admin_post_dir']);
          // delete from database
          mysqli_query($dbcon, "DELETE FROM notification WHERE post_id=$select_post AND noti_header='Admin post' AND additional_info='$adminPostNum'");
          $tables = array("post", "post_pic", "post_comment");
          foreach ($tables as $table) {
            $queryDelPost = "DELETE FROM $table WHERE post_id=?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryDelPost);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'i', $select_post);
            // execute query
            mysqli_stmt_execute($q);
            if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
              // delete artist directory
              removeDir($adminPostDir);
              $sucstring = "Post has been deleted successfully!";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for artist deletion
  if (isset($_POST['delete_artist'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select artist name...";
      }

      if (empty($error)) { // If everything's OK.
        //delete artist and its directory
        $query_artistName = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        if (mysqli_num_rows($query_artistName) == 1) {
          $fetch_artistName = mysqli_fetch_assoc($query_artistName);
          $artistName = $purifier->purify($fetch_artistName['artist_name']);
          $artistName = preg_replace('/\s/', '_', $artistName);
          define('ARTISTNAME_DIR', "../artist/$artistName"); // former folder name
          // delete from database
          mysqli_query($dbcon, "DELETE FROM notification WHERE noti_header='New music' AND additional_info='$select_artist'");
          $tables = array("artist", "audio", "video", "audio_video_comment", "music_blog", "album");
          foreach ($tables as $table) {
            $queryDelArtist = "DELETE FROM $table WHERE artist_id=?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryDelArtist);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'i', $select_artist);
            // execute query
            mysqli_stmt_execute($q);
            if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
              // delete artist directory
              removeDir(ARTISTNAME_DIR);
              $sucstring = "Artist deleted successfully!";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for delete album
  if (isset($_POST['delete_album'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select artist name...";
      }

      $select_album = $purifier->purify($_POST['select_album']);
      if (empty($select_album)) {
        $error[] = "Select album name...";
      }

      if (empty($error)) { // if everything is ok
        // check if artist name exist?
        $query_artist_id = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($query_artist_id) == 1) {
          // fetch the records
          $fetch_artist_name = mysqli_fetch_assoc($query_artist_id);
          $artist_name = $purifier->purify($fetch_artist_name['artist_name']);
          $artist_nameDirName = preg_replace('/\s/', '_', $artist_name);
          // check if album name exist?
          $query_album_id = mysqli_query($dbcon, "SELECT album_name FROM album WHERE artist_id=$select_artist AND album_id=$select_album");
          // Check the result:
          if (mysqli_num_rows($query_album_id) == 1) {
            // fetch the records
            $fetch_album_name = mysqli_fetch_assoc($query_album_id);
            $former_album_name = $purifier->purify($fetch_album_name['album_name']);
            $former_album_nameDirName = preg_replace('/\s/', '_', $former_album_name);
            define('ALBUMNAME_DIR', "../artist/$artist_nameDirName/album/$former_album_nameDirName/"); // former folder name

            mysqli_query($dbcon, "DELETE FROM music_blog WHERE file_id=$select_album AND mime_type='album'");
            $queryDelAlbum = "DELETE FROM album WHERE artist_id=? AND album_id=? LIMIT 1";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryDelAlbum);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'ii', $select_artist, $select_album);
            // execute query
            mysqli_stmt_execute($q);
            if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
              // delete artist directory
              removeDir(ALBUMNAME_DIR);
              $sucstring = "Album deleted successfully!";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          } else {
            $errorstring = "Can't find selected album if any?...";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for delete song
  if (isset($_POST['delete_song'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select artist name...";
      }

      $select_song = $purifier->purify($_POST['select_song']);
      if (empty($select_song)) {
        $error[] = "Select song name...";
      }

      if (empty($error)) { // if everything is ok
        // check if artist name exist?
        $query_artist_id = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($query_artist_id) == 1) {
          // check if audio files exist?
          $query_audio_id = mysqli_query($dbcon, "SELECT audio_file, audio_pic FROM audio WHERE artist_id=$select_artist AND audio_id=$select_song");
          // Check the result:
          if (mysqli_num_rows($query_audio_id) == 1) {
            // fetch the records
            $fetch_audio_file = mysqli_fetch_assoc($query_audio_id);
            $former_audio_file = $purifier->purify($fetch_audio_file['audio_file']);
            $former_audio_pic = $purifier->purify($fetch_audio_file['audio_pic']);
            define('AUDIO_FILE', "../$former_audio_file");
            define('AUDIO_PIC', "../$former_audio_pic");
            // delete from database
            mysqli_query($dbcon, "DELETE FROM notification WHERE post_id=$select_song AND noti_header='New music'");
            mysqli_query($dbcon, "DELETE FROM music_blog WHERE file_id=$select_song AND mime_type='audio'");
            $tables = array("audio", "audio_video_comment");
            foreach ($tables as $table) {
              $queryDelSong = "DELETE FROM $table WHERE artist_id=? AND audio_id=?";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $queryDelSong);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'ii', $select_artist, $select_song);
              // execute query
              mysqli_stmt_execute($q);
              if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
                // delete song from directory
                if (file_exists(AUDIO_FILE)) unlink(AUDIO_FILE);
                if (file_exists(AUDIO_PIC)) unlink(AUDIO_PIC);
                $sucstring = "Song deleted successfully!";
                header("refresh:1; url= " . $_SERVER['PHP_SELF']);
              }
            }
          } else {
            $errorstring = "Can't find selected audio if any?...";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for delete video
  if (isset($_POST['delete_video'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_artist = $purifier->purify($_POST['select_artist']);
      if (empty($select_artist)) {
        $error[] = "Select artist name...";
      }

      $select_video = $purifier->purify($_POST['select_video']);
      if (empty($select_video)) {
        $error[] = "Select video name...";
      }

      if (empty($error)) { // if everything is ok
        // check if artist name exist?
        $query_artist_id = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$select_artist");
        // Check the result:
        if (mysqli_num_rows($query_artist_id) == 1) {
          // check if video file exist?
          $query_video_id = mysqli_query($dbcon, "SELECT video_file, youtube_url, video_pic FROM video WHERE artist_id=$select_artist AND video_id=$select_video");
          // Check the result:
          if (mysqli_num_rows($query_video_id) == 1) {
            // fetch the records
            $fetch_video_file = mysqli_fetch_assoc($query_video_id);
            $former_video_file = $purifier->purify($fetch_video_file['video_file']);
            $former_video_pic = $purifier->purify($fetch_video_file['video_pic']);
            $former_youtube_url = $purifier->purify($fetch_video_file['youtube_url']);
            define('VIDEO_FILE', "../$former_video_file");
            define('VIDEO_PIC', "../$former_video_pic");
          }
          // delete from database
          mysqli_query($dbcon, "DELETE FROM music_blog WHERE file_id=$select_video AND mime_type='video'");
          $tables = array("video", "audio_video_comment");
          foreach ($tables as $table) {
            $queryDelVideo = "DELETE FROM $table WHERE artist_id=? AND video_id=?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryDelVideo);
            // bind values to SQL statement
            mysqli_stmt_bind_param($q, 'ii', $select_artist, $select_video);
            // execute query
            mysqli_stmt_execute($q);
            if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
              // delete song from directory
              if (file_exists(VIDEO_PIC)) unlink(VIDEO_PIC);
              if (empty($former_youtube_url)) {
                if (file_exists(VIDEO_FILE)) unlink(VIDEO_FILE);
              }
              $sucstring = "Video deleted successfully!";
              header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            }
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for delete genre
  if (isset($_POST['delete_genre'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_genre = $purifier->purify($_POST['select_genre']);
      if (empty($select_genre)) {
        $error[] = "Select genre name...";
      }

      if (empty($error)) { // If everything's OK.
        $queryDelGenre = "DELETE FROM genre WHERE genre_id=? LIMIT 1";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $queryDelGenre);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'i', $select_genre);
        // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
          $sucstring = "Genre deleted successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for user addition
  if (isset($_POST['insert_user'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      // Trim the first name
      $insert_user_first_name = $purifier->purify(filter_var($_POST['insert_user_first_name']));
      if ((!empty($insert_user_first_name)) && (preg_match('/[a-z\s\']/i', $insert_user_first_name))) {
        //Sanitize the trimmed first name
        $insert_user_first_name = ucfirst($insert_user_first_name);
      } else {
        $error[] = 'First name missing or not alphabetic and space characters.';
      }

      // Trim the middle name
      $insert_user_middle_name = $purifier->purify(filter_var($_POST['insert_user_middle_name']));
      if ((!empty($insert_user_middle_name)) && (preg_match('/[a-z\s\']/i', $insert_user_middle_name))) {
        //Sanitize the trimmed first name
        $insert_user_middle_name = ucfirst($insert_user_middle_name);
      } else {
        $insert_user_middle_name = NULL;
      }

      //Is the last name present? If it is, trim it and sanitize it
      $insert_user_last_name = $purifier->purify(filter_var($_POST['insert_user_last_name']));
      if ((!empty($insert_user_last_name)) && (preg_match('/[a-z\-\']/i', $insert_user_last_name))) {
        //Sanitize the trimmed last name
        $insert_user_last_name = ucfirst($insert_user_last_name);
      } else {
        $error[] = 'Last name missing or not alphabetic or dash or';
      }

      // Trim the nickname
      $insert_user_nickname = $purifier->purify(filter_var($_POST['insert_user_nickname']));
      if ((!empty($insert_user_nickname)) && (preg_match('/[a-z\s\']/i', $insert_user_nickname))) {
        //Sanitize the trimmed first name
        $insert_user_nickname = ucfirst($insert_user_nickname);
      } else {
        $insert_user_nickname = NULL;
      }

      // Trim the user name
      $insert_user_name = $purifier->purify(filter_var($_POST['insert_user_name']));
      if ((!empty($insert_user_name)) && (preg_match('/[a-z0-9\-\_.]/i', $insert_user_name))) {
        //Sanitize the trimmed first name
        $insert_user_name = $insert_user_name;
      } else {
        $error[] = 'User name missing or not alphabetic and numeric characters.';
      }


      $insert_user_email = $purifier->purify($_POST['insert_user_email']);
      if (empty($insert_user_email)) {
        $error[] = 'You forgot to enter your email address or the e-mail format is incorrect.';
      }
      // Check that an email address has been entered
      //$insert_user_email = filter_var( $_POST['insert_user_email'], FILTER_SANITIZE_EMAIL);
      //if  ((empty($insert_user_email)) || (!filter_var($insert_user_email, FILTER_VALIDATE_EMAIL))) {
      //$errors[] = 'You forgot to enter your email address or the e-mail format is incorrect.';
      //}

      // Check for password and match against the comfirmed password:
      $insert_user_password = $purifier->purify(filter_var($_POST['insert_user_password']));
      if (empty($insert_user_password)) {
        $error[] = "Please enter a valid password";
      } else {
        if (!preg_match(
          '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d#$@!%&*?]{8,}$/',
          $insert_user_password
        )) {
          $error[] = "Invalid password, not less than 8 characters. At least one upper,
            one lower, one number.";
        } else {
          $insert_user_conpass = $purifier->purify(filter_var($_POST['insert_user_conpass']));
          if ($insert_user_password === $insert_user_conpass) {
            $insert_password = $insert_user_password;
          } else {
            $error[] = "Your two passwords do not match.";
          }
        }
      }

      $insert_user_gender = $purifier->purify($_POST['insert_user_gender']);
      if (empty($insert_user_gender)) {
        $error[] = "Please select a gender";
      }

      $insert_user_level = $purifier->purify($_POST['insert_user_level']);
      if (empty($insert_user_level)) {
        $insert_user_level = 0;
      }

      if (empty($error)) { // If everything's OK.
        // If no problems encountered, register user in the database
        //Determine whether the email address has already been registered
        $query_insert_user = "SELECT user_id FROM users WHERE email=? OR user_name=?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query_insert_user);
        mysqli_stmt_bind_param($q, 'ss', $insert_user_email, $insert_user_name);
        mysqli_stmt_execute($q);
        $result_insert_user = mysqli_stmt_get_result($q);

        if (mysqli_num_rows($result_insert_user) == 0) { //The email address or user_name has not been registered
          //already therefore register the user in the users table
          //-------------Valid Entries - Save to database -----
          //Start of the SUCCESSFUL SECTION. i.e all the required fields were filled out
          $hashed_password = password_hash($insert_password, PASSWORD_DEFAULT);
          // Create the activation code:
          $activation_code = md5(uniqid(rand(), true));

          // Register the user in the database...
          $query = "INSERT INTO users (first_name, middle_name, last_name, nickname, user_name, email, password, gender, activated, reg_date)";
          $query .= "VALUES (?,?,?,?,?,?,?,?,?, NOW())";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $query);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param($q, 'sssssssss', $insert_user_first_name, $insert_user_middle_name, $insert_user_last_name, $insert_user_nickname, $insert_user_name, $insert_user_email, $hashed_password, $insert_user_gender, $activation_code);
          // execute query
          mysqli_stmt_execute($q);

          if (mysqli_stmt_affected_rows($q) == 1) { // One record inserted

            // Send the email:
            $body = "Thank you for registering at emc.net. \nTo activate your account, please click on the link below:\n\n";
            $body .= BASE_URL . 'activate.php?x=' . urlencode($insert_user_email) . "&y=$activation_code";
            $sendMail = mail($insert_user_email, 'Registration Confirmation', $body, 'From: noreply@emc.net');
            if (function_exists('mail')) {
              if ($sendMail) { // echo "Email Sent Successfully";
              } // else { echo "Mail Failed";}
            } else {
              $errorstring = 'mail() function has been disabled';
            }

            // Finish the page:
            $sucstring = "<h6 style='color:green;' class='justify-content-center text-center'><strong>Registration!</strong></h6>\n\n
            A confirmation email has been sent to your address. Please click on the link in your email in order to activate your account.";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
            //exit(); // Stop the page.
          } else {
            $errorstring = "System is busy, please try again later";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else { // The email address is already registered
          $errorstring = "The email address or username is already registered.";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for user edition
  if (isset($_POST['edit_user'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_user = $purifier->purify($_POST['select_user']);
      if (empty($select_user)) {
        $error[] = "Please select a user...";
      }

      // Trim the first name
      $edit_user_first_name = $purifier->purify(filter_var($_POST['edit_user_first_name']));
      if ((!empty($edit_user_first_name)) && (preg_match('/[a-z\s\']/i', $edit_user_first_name))) {
        //Sanitize the trimmed first name
        $edit_user_first_name = ucfirst($edit_user_first_name);
      } else {
        $edit_user_first_name = NULL;
      }

      // Trim the middle name
      $edit_user_middle_name = $purifier->purify(filter_var($_POST['edit_user_middle_name']));
      if ((!empty($edit_user_middle_name)) && (preg_match('/[a-z\s\']/i', $edit_user_middle_name))) {
        //Sanitize the trimmed first name
        $edit_user_middle_name = ucfirst($edit_user_middle_name);
      } else {
        $edit_user_middle_name = NULL;
      }

      //Is the last name present? If it is, trim it and sanitize it
      $edit_user_last_name = $purifier->purify(filter_var($_POST['edit_user_last_name']));
      if ((!empty($edit_user_last_name)) && (preg_match('/[a-z\-\']/i', $edit_user_last_name))) {
        //Sanitize the trimmed last name
        $edit_user_last_name = ucfirst($edit_user_last_name);
      } else {
        $edit_user_last_name = NULL;
      }

      // Trim the nickname
      $edit_user_nickname = $purifier->purify(filter_var($_POST['edit_user_nickname']));
      if ((!empty($edit_user_nickname)) && (preg_match('/[a-z\s\']/i', $edit_user_nickname))) {
        //Sanitize the trimmed first name
        $edit_user_nickname = ucfirst($edit_user_nickname);
      } else {
        $edit_user_nickname = NULL;
      }

      // Trim the user name
      $edit_user_name = $purifier->purify(filter_var($_POST['edit_user_name']));
      if ((!empty($edit_user_name)) && (preg_match('/[a-z0-9\-\_.]/i', $edit_user_name))) {
        //Sanitize the trimmed username
        $edit_user_name = ucfirst($edit_user_name);
      } else {
        $edit_user_name = NULL;
      }

      $edit_user_email = $purifier->purify($_POST['edit_user_email']);
      if (empty($edit_user_email)) {
        $edit_user_email = NULL;
      }
      // Check that an email address has been entered
      //$edit_user_email = filter_var( $_POST['edit_user_email'], FILTER_SANITIZE_EMAIL);
      //if ((empty($edit_user_email)) || (!filter_var($edit_user_email, FILTER_VALIDATE_EMAIL))) {
      //$errors[] = 'You forgot to enter your email address or the e-mail format is incorrect.';
      //}

      $edit_user_gender = $purifier->purify($_POST['edit_user_gender']);
      if (empty($edit_user_gender)) {
        $edit_user_gender = NULL;
      }

      $edit_user_level = $purifier->purify($_POST['edit_user_level']);
      if (empty($edit_user_level)) {
        $edit_user_level = NULL;
      }

      $edit_user_activation = $purifier->purify($_POST['edit_user_activation']);
      if (empty($edit_user_activation)) {
        $edit_user_activation = NULL;
      } elseif ($edit_user_activation == 'NULL' or 'null') {
        $edit_user_activation = 'NULL';
      }

      $edit_report_user = $purifier->purify($_POST['edit_report_user']);
      if (empty($edit_report_user)) {
        $edit_report_user = 0;
      }

      $edit_blocked_user = $purifier->purify($_POST['edit_blocked_user']);
      if (empty($edit_blocked_user)) {
        $edit_blocked_user = '0';
      }

      if (empty($error)) { // If everything's OK.
        // select former user details
        $query_former_user = mysqli_query($dbcon, "SELECT * FROM users WHERE user_id=$select_user");
        if (mysqli_num_rows($query_former_user) == 1) {
          $fetch_former_user = mysqli_fetch_assoc($query_former_user);
          $former_first_name = $purifier->purify($fetch_former_user['first_name']);
          $former_midle_name = $purifier->purify($fetch_former_user['middle_name']);
          $former_last_name = $purifier->purify($fetch_former_user['last_name']);
          $former_nickname = $purifier->purify($fetch_former_user['nickname']);
          $former_user_name = $purifier->purify($fetch_former_user['user_name']);
          $former_email = $purifier->purify($fetch_former_user['email']);
          $former_gender = $purifier->purify($fetch_former_user['gender']);
          $former_user_level = $purifier->purify($fetch_former_user['user_level']);
          $former_activated = $purifier->purify($fetch_former_user['activated']);
          $former_report = $purifier->purify($fetch_former_user['report']);
          $former_blocked_user = $purifier->purify($fetch_former_user['blocked_user']);

          if (!isset($edit_user_first_name)) {
            if (!empty($former_first_name)) {
              $edit_user_first_name = $former_first_name;
            } else $edit_user_first_name = NULL;
          }
          if (!isset($edit_user_middle_name)) {
            if (!empty($former_midle_name)) {
              $edit_user_middle_name = $former_midle_name;
            } else $edit_user_middle_name = NULL;
          }
          if (!isset($edit_user_last_name)) {
            if (!empty($former_last_name)) {
              $edit_user_last_name = $former_last_name;
            } else $edit_user_last_name = NULL;
          }
          if (!isset($edit_user_nickname)) {
            if (!empty($former_nickname)) {
              $edit_user_nickname = $former_nickname;
            } else $edit_user_nickname = NULL;
          }
          if (!isset($edit_user_name)) {
            if (!empty($former_user_name)) {
              $edit_user_name = $former_user_name;
            } else $edit_user_name = NULL;
          }
          if (!isset($edit_user_email)) {
            if (!empty($former_email)) {
              $edit_user_email = $former_email;
            } else $edit_user_email = NULL;
          }
          if (!isset($edit_user_gender)) {
            if (!empty($former_gender)) {
              $edit_user_gender = $former_gender;
            } else $edit_user_gender = NULL;
          }
          if (!isset($edit_user_level)) {
            if (!empty($former_user_level)) {
              $edit_user_level = $former_user_level;
            } else $edit_user_level = NULL;
          }
          if (!isset($edit_user_activation)) {
            if (!empty($former_activated)) {
              $edit_user_activation = $former_activated;
            } else $edit_user_activation = NULL;
          } elseif ($edit_user_activation == 'NULL') {
            $edit_user_activation = NULL;
          }
          if (!isset($edit_report_user)) {
            if (!empty($former_report)) {
              $edit_report_user = $former_report;
            } else $edit_report_user = NULL;
          }
          if (!isset($edit_blocked_user)) {
            if (!empty($former_blocked_user)) {
              $edit_blocked_user = $former_blocked_user;
            } else $edit_blocked_user = NULL;
          }
        }

        $query_update_user_edit = "UPDATE users SET first_name=?, middle_name=?, last_name=?, nickname=?, user_name=?, email=?, gender=?, user_level=?, activated=?, report=?, blocked_user=? WHERE user_id=? LIMIT 1";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $query_update_user_edit);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'sssssssssssi', $edit_user_first_name, $edit_user_middle_name, $edit_user_last_name, $edit_user_nickname, $edit_user_name, $edit_user_email, $edit_user_gender, $edit_user_level, $edit_user_activation, $edit_report_user, $edit_blocked_user, $select_user);
        // execute query
        mysqli_stmt_execute($q);
        $sucstring = "User updated successfully!";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // Check for admin message submition
  if (isset($_POST['send_adminMsg'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $select_user = $purifier->purify($_POST['select_user']);
      if (empty($select_user)) {
        $error[] = "Please select a user...";
      }

      $admin_msgHeader = $purifier->purify($_POST['admin_msgHeader']);
      if (empty($admin_msgHeader)) {
        $admin_msgHeader = NULL;
      }

      $adminMessage = $purifier->purify($_POST['adminMessage']);
      if (empty($adminMessage)) {
        $error[] = "Please enter your message on the textarea box...";
      }

      if (empty($error)) {
        if ($select_user == 'allUsers') {
          // get all user id
          $queryUserIDMsg = mysqli_query($dbcon, "SELECT user_id FROM users WHERE user_id!=$adminUser_id");
          // Check the result:
          if (mysqli_num_rows($queryUserIDMsg) > 0) {
            // fetch the records
            while ($fetch_queryUserIDMsg = mysqli_fetch_assoc($queryUserIDMsg)) {
              $user_msg_id  = $purifier->purify($fetch_queryUserIDMsg['user_id']);
              $msgAdminQuery = "INSERT INTO admin_msg (msg_header, message, user_level, user_id, date_time) VALUES (?,?,?,?, NOW())";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $msgAdminQuery);
              // use prepared statement to insure that only text is inserted
              // bind fields to SQL Statement
              mysqli_stmt_bind_param($q, 'ssss', $admin_msgHeader, $adminMessage, $admin_userLevel, $user_msg_id);
              // execute query
              mysqli_stmt_execute($q);
              // insert into message notification table
              if (mysqli_stmt_affected_rows($q) == 1) {
                $lastInsertedAdminMsg_ID = mysqli_insert_id($dbcon);
                $noti_link = BASE_URL . "accountmsg.php?mid=$lastInsertedAdminMsg_ID&uf=$adminUser_id&ut=$user_msg_id";
                mysqli_query($dbcon, "INSERT INTO notification_msg (msg_id, msg_header, msg_body,
                user_from, user_to, noti_pic, description, noti_link, user_level, date_time) VALUES ($lastInsertedAdminMsg_ID,
                '$adminNotiMsg_header', '$adminMessage', $adminUser_id, $user_msg_id, '$adminPicture',
                '$adminNotiMsg_description', '$noti_link', $admin_userLevel, Now())");
              }
            }
            $sucstring = "Message delivered to all users successfully!";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        } else {
          $msgAdminQuery = "INSERT INTO admin_msg (msg_header, message, user_level, user_id, date_time) VALUES (?,?,?,?, NOW())";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $msgAdminQuery);
          // use prepared statement to insure that only text is inserted
          // bind fields to SQL Statement
          mysqli_stmt_bind_param($q, 'ssss', $admin_msgHeader, $adminMessage, $admin_userLevel, $select_user);
          // execute query
          mysqli_stmt_execute($q);
          // insert into message notification table
          if (mysqli_stmt_affected_rows($q) == 1) {
            $lastInsertedAdminMsg_ID = mysqli_insert_id($dbcon);
            $noti_link = BASE_URL . "accountmsg.php?mid=$lastInsertedAdminMsg_ID&uf=$adminUser_id&ut=$select_user";
            mysqli_query($dbcon, "INSERT INTO notification_msg (noti_id, msg_id, msg_header, msg_body,
            user_from, user_to, noti_pic, description, noti_link, user_level, date_time) VALUES ($lastInsertedAdminMsg_ID,
            '$adminNotiMsg_header', '$adminMessage', $adminUser_id, $select_user, '$adminPicture',
            '$adminNotiMsg_description', '$noti_link', $admin_userLevel, Now())");
          }
          $sucstring = "Message delivered successfully!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // check for delete Admin messages
  if (isset($_POST['deleteAdminMsg'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $deleteAdminMsg = $purifier->purify($_POST['deleteAdminMsgVal']);
      if (!empty($deleteAdminMsg)) {
        //Sanitize the trimmed deleted user
        $deleteAdminMsg = filter_var($deleteAdminMsg, FILTER_SANITIZE_NUMBER_INT);
      } else {
        $error[] = "Sorry! The Message could not be deleted due to invalid message id...";
      }

      if (empty($error)) { // if everything is ok
        // delete messages from database
        $tables = array("admin_msg", "admin_msg_reply");
        foreach ($tables as $table) {
          $queryDelAdminMsg = "DELETE FROM $table WHERE admin_msg_id = ?";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $queryDelAdminMsg);
          // bind values to SQL statement
          mysqli_stmt_bind_param($q, 'i', $deleteAdminMsg);
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
            $sucstring = "The message(s) has been deleted/removed from database!";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // check for delete Admin contactUs messages
  if (isset($_POST['deleteContactMsg'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $deleteContactMsg = $purifier->purify($_POST['deleteContactMsgVal']);
      if (!empty($deleteContactMsg)) {
        //Sanitize the trimmed deleted user
        $deleteContactMsg = filter_var($deleteContactMsg, FILTER_SANITIZE_NUMBER_INT);
      } else {
        $error[] = "Sorry! The Message could not be deleted due to invalid message id...";
      }

      if (empty($error)) { // if everything is ok
        // delete messages from database
        $queryDelContactMsg = "DELETE FROM contact_us WHERE contact_us_id = ?";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $queryDelContactMsg);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'i', $deleteContactMsg);
        // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
          $sucstring = "The message has been deleted/removed from database!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // check for delete users
  if (isset($_POST['deleteUser'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $deleteUser = $purifier->purify($_POST['deleteUserVal']);
      if (!empty($deleteUser)) {
        //Sanitize the trimmed deleted user
        $deleteUser = filter_var($deleteUser, FILTER_SANITIZE_NUMBER_INT);
      } else {
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
        define('USER_DIR', "../users/$user_name");
        // delete user from database
        $tables = array(
          "users", "user_address", "user_info", "post", "post_comment", "post_comment_reply",
          "pvt_msg", "testimony", "app_comment", "audio_video_comment", "admin_msg", "admin_msg_reply"
        );
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
            $sucstring = "The user has been deleted/removed from database!";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // check for delete search user
  if (isset($_POST['deleteSrchUser'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $deleteSrchUser = $purifier->purify($_POST['deleteSrchUserVal']);
      if (!empty($deleteSrchUser)) {
        //Sanitize the trimmed deleted user
        $deleteSrchUser = filter_var($deleteSrchUser, FILTER_SANITIZE_NUMBER_INT);
      } else {
        $error[] = "Sorry! The user could not be deleted due to invalid user id...";
      }

      if (empty($error)) { // if everything is ok
        // Check for username; then delete user folder
        $userName = mysqli_query($dbcon, "SELECT user_name FROM users WHERE user_id=$deleteSrchUser");
        // Check the result:
        if (mysqli_num_rows($userName) == 1) {
          // fetch the records
          $fetch_userName = mysqli_fetch_assoc($userName);
          $user_name = $purifier->purify($fetch_userName['user_name']);
        }
        define('USER_DIR', "../users/$user_name");
        // delete user from database
        $tables = array(
          "users", "user_address", "user_info", "post", "post_comment", "post_comment_reply",
          "pvt_msg", "testimony", "app_comment", "audio_video_comment", "admin_msg", "admin_msg_reply"
        );
        foreach ($tables as $table) {
          $queryDelSrchUser = "DELETE FROM $table WHERE user_id=?";
          $q = mysqli_stmt_init($dbcon);
          mysqli_stmt_prepare($q, $queryDelSrchUser);
          // bind values to SQL statement
          mysqli_stmt_bind_param($q, 'i', $deleteSrchUser);
          // execute query
          mysqli_stmt_execute($q);
          if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
            removeDir(USER_DIR);
            $sucstring = "The user has been deleted/removed from database!";
            header("refresh:1; url= " . $_SERVER['PHP_SELF']);
          }
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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

  // check for delete testimony
  if (isset($_POST['deleteTesti'])) {
    try {
      $error = array(); // Initialize an error array.
      // --------------------check entries-------------
      $deleteTesti = $purifier->purify($_POST['deleteTestiVal']);
      if (!empty($deleteTesti)) {
        //Sanitize the trimmed deleted user
        $deleteTesti = filter_var($deleteTesti, FILTER_SANITIZE_NUMBER_INT);
      } else {
        $error[] = "Sorry! The testimony could not be deleted due to invalid testimony id...";
      }

      if (empty($error)) { // if everything is ok
        // delete testimony from database
        $queryDelTesti = "DELETE FROM testimony WHERE testimony_id=? LIMIT 1";
        $q = mysqli_stmt_init($dbcon);
        mysqli_stmt_prepare($q, $queryDelTesti);
        // bind values to SQL statement
        mysqli_stmt_bind_param($q, 'i', $deleteTesti);
        // execute query
        mysqli_stmt_execute($q);
        if (mysqli_stmt_affected_rows($q) == 1) { // it ran OK
          $sucstring = "The testimony has been deleted/removed from database!";
          header("refresh:1; url= " . $_SERVER['PHP_SELF']);
        }
      } else {
        $errorstring = "Error! The following error(s) occured:<br>";
        foreach ($error as $msg) { // Print each error.
          $errorstring .= "$msg<br>\n";
        }
        $errorstring .= "Please try again.<br>";
        header("refresh:1; url= " . $_SERVER['PHP_SELF']);
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
