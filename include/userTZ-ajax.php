<?php
session_start();

if(isset($_POST["timeZ"]) && !empty($_POST["timeZ"])) {
  $_SESSION['user_timezone'] = $_POST['timeZ'];
}
?>
