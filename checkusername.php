<?php //checkuser.php
  require_once('obaEddie_connect.php');

  if (isset($_POST['user']))
  {
    $user   = filter_var($_POST['user'], FILTER_SANITIZE_STRING);

    $query = "SELECT user_id FROM users WHERE user_name=?";

    $q = mysqli_stmt_init($dbcon);
    mysqli_stmt_prepare($q, $query);

     //bind $id to SQL Statement
    mysqli_stmt_bind_param($q, "s", $user);
     //execute query
    mysqli_stmt_execute($q);
    $result = mysqli_stmt_get_result($q);

     //Check the result:
    if (mysqli_num_rows($result) > 0) {
      echo  "<small style='color:red;'> &nbsp;&#x2718; The username '$user' is taken</small>";
    }else{
      echo "<small style='color:skyblue;'> &nbsp;&#x2714; The username '$user' is available</small>";
    }
  }
