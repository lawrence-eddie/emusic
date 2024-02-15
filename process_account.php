<?php
// Was the form submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Check for profile_pic
  if (isset($_FILES['upload_image'])) {
    define('PROFILE_PIC_DIR', "users/$user_name/profile_pic/");
    try {
      // Validate the type. Should be JPEG or PNG.
      $allowed = ['image/pjpeg', 'image/jpeg', 'image/JPG', 'image/jpg', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png'];
      if (in_array($_FILES['upload_image']['type'], $allowed)) {
        $file_name = $_FILES['upload_image']['name'];
        // Check if destination dir exist
        if (!is_dir(PROFILE_PIC_DIR)) {
          mkdir(PROFILE_PIC_DIR, 0777, true);
        }
        $profile_pic_dir = PROFILE_PIC_DIR;
        $currentDateTime = date('d_m_Y_H_i_s'); // Add current datetime to image
        $ext = pathinfo($file_name, PATHINFO_EXTENSION); // Get file extension
        $saveto = PROFILE_PIC_DIR . $user_name . "$currentDateTime.$ext"; // File destination
        //$saveto = PROFILE_PIC_DIR."$user_name.$ext"; // File destination
        // Move the file over.
        if ($_FILES['upload_image']['size'] < 1048576) {
          //checking if file exsists
          if (file_exists($saveto)) unlink($saveto);
          // Delete other image files
          //$filenames = scandir(PROFILE_PIC_DIR);
          //foreach ($filenames as $file_name) {
          //unlink(PROFILE_PIC_DIR.$file_name);
          //}
          $images = glob("$profile_pic_dir*.{jpg,jpeg,png}", GLOB_BRACE); //Delete image file
          foreach ($images as $image) {
            unlink($image);
          }
          if (move_uploaded_file($_FILES['upload_image']['tmp_name'], $saveto)) {
            // Query info table
            $query_user_id = mysqli_query($dbcon, "SELECT user_id FROM user_info WHERE user_id=$user_id");
            if (mysqli_num_rows($query_user_id) == 1) {
              $query_info_update = "UPDATE user_info SET profile_pic=? WHERE user_id=? LIMIT 1";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_info_update);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'si', $saveto, $user_id);
              // execute query
              mysqli_stmt_execute($q);
              header('Location: ' . $_SERVER['PHP_SELF']);
            } else {
              $query_info_update = "INSERT INTO user_info (user_id, profile_pic) VALUES (?,?)";
              $q = mysqli_stmt_init($dbcon);
              mysqli_stmt_prepare($q, $query_info_update);
              // bind values to SQL statement
              mysqli_stmt_bind_param($q, 'is', $user_id, $saveto);
              // execute query
              mysqli_stmt_execute($q);
              header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
              header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
              header('Location: ' . $_SERVER['PHP_SELF']);
            }
          } else {
            $image_error = "System is busy please try later.";
            header("refresh:5; url= " . $_SERVER['PHP_SELF']);
          }
        } else { // Invalid larger than 1Mb.
          $image_error = "Please upload a JPEG or PNG image less than 1Mb";
          // header("refresh:5; url= " . $_SERVER['PHP_SELF']);
        }
      } else { // Invalid type.
        $image_error = "Please upload a JPEG or PNG image less than 1Mb";
        // header("refresh:5; url= " . $_SERVER['PHP_SELF']);
      }
      // Delete the file if it still exists:
      if (file_exists($_FILES['upload_image']['tmp_name']) && is_file($_FILES['upload_image']['tmp_name'])) {
        unlink($_FILES['upload_image']['tmp_name']);
      }
    } catch (Exception $e) {
      // print "An Exception occured message: " . $e->getMessage();
      print "The system is busy please try later";
      $date = date('m.d.y h:i:s');
      $errormessage = $e->getMessage();
      $eMessage = $date . " | Exception Error | " . $errormessage . "\n";
      error_log($eMessage, 3, ERROR_LOG);
      header("refresh:5; url= " . $_SERVER['PHP_SELF']);
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
      header("refresh:5; url= " . $_SERVER['PHP_SELF']);
      // e-mail support person to alert there is a problem
      // error_log("Date/Time: $date - Error, Check error log for
      //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error
      //Log <errorlog@helpme.com>" . "\r\n");
      header("refresh:5; url= " . $_SERVER['PHP_SELF']);
    }
  } // End of upload profile image
}
