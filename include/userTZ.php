<?php
//error_reporting(0);

//jQuery
echo $jquery_JS = '<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
crossorigin="anonymous"></script>';

echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.28.0/moment.min.js" integrity="sha512-Q1f3TS3vSt1jQ8AwP2OuenztnLU6LwxgyyYOG1jgMW/cbEMHps/3wjvnl1P3WTrF3chJUWEoxDUEjMxDV8pujg==" crossorigin="anonymous"></script>';
echo '<script src="js/moment-timezone-with-data.min.js"></script>';

if (!isset($_SESSION['user_timezone'])) {
  echo "<script type='text/javascript'>";
  echo "const tz = moment.tz.guess(true);
    $.ajax({
      url: 'include/userTZ-ajax.php',
      type: 'post',
      data: {timeZ:tz},
      success: function(timezone){
        location.reload();
      }
    });";
  echo "</script>";
}

if (isset($_SESSION['user_timezone'])) {
  $user_timezone = $_SESSION['user_timezone'];
  date_default_timezone_set($user_timezone);
}
