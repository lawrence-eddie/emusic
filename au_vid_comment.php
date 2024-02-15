<?php
// App comment
// Initialize a session:
session_start();

// database connection
require_once('obaEddie_connect.php');
require 'vendor/autoload.php';

use Carbon\Carbon;

// Purify plugin
$dbcon->set_charset("utf8mb4");
//$dbcon->query("SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci");
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

// This is the app comment page for account script
//require('include/config.inc.php');
//require_once('include/session_cookie.php');

if (isset($_SESSION['user_timezone'])) {
  $user_timezone = $_SESSION['user_timezone'];
  date_default_timezone_set($user_timezone);
}

$user_id = $_SESSION['user_id'];
$app_id = $_SESSION['webapp_id'];

// Audio comment
if (isset($_POST["commentxt"]) && !empty($_POST['commentxt'])) {
  $commentxt = $purifier->purify($_POST['commentxt']);
  $artist_id = $purifier->purify($_POST['artist_id']);
  $audio_id = $purifier->purify($_POST['audio_id']);
  //$app_commentxt = sanitizeString($_POST['app_commentxt']);
  $patterns = array("/https/", "/http/", "/www./", "/\.org/", "/\.com/", "/\.net/", "/\.io/", "/<script>/", "/<\/script>/");
  $commentxttrim = preg_replace($patterns, "", $commentxt);

  // Insert comment into audio_video_comment table
  $query1 = "INSERT INTO audio_video_comment (user_id, app_id, artist_id, audio_id, comment, date_time) VALUES (?,?,?,?,?, NOW())";
  $q = mysqli_stmt_init($dbcon);
  mysqli_stmt_prepare($q, $query1);
  // use prepared statement to insure that only text is inserted
  // bind fields to SQL Statement
  mysqli_stmt_bind_param($q, 'iiiis', $user_id, $app_id, $artist_id, $audio_id, $commentxttrim);
  // execute query
  mysqli_stmt_execute($q);

  if (mysqli_stmt_affected_rows($q) == 1) {
    $com_id = mysqli_insert_id($dbcon);
  }
  ////////////////////////////  Query the app_comment table ////////////////////////////
  $app_comment = mysqli_query($dbcon, "SELECT * FROM audio_video_comment WHERE comment_id=$com_id AND artist_id=$artist_id AND audio_id=$audio_id");
  // Check the result:
  $fetch_comment = mysqli_fetch_assoc($app_comment);
  // fetch the records
  $com_user_id = $purifier->purify($fetch_comment['user_id']);
  $comment = $purifier->purify($fetch_comment['comment']);
  $date   = $fetch_comment['date_time'];
  $time = Carbon::parse($date);
  $time_since = $time->diffForHumans();

  ////////////////////////////  Query the users table for commentor names ////////////////////////////
  $commentor1 = mysqli_query($dbcon, "SELECT first_name, middle_name, last_name, gender FROM users WHERE user_id=$com_user_id");
  //LEFT JOIN user_info i USING (user_id) WHERE user_id=$com_user_id");
  // Check the result:
  $fetch_com_user = mysqli_fetch_assoc($commentor1);
  $com_first_name = $purifier->purify($fetch_com_user['first_name']);
  $com_middle_name = $purifier->purify($fetch_com_user['middle_name']);
  $com_last_name = $purifier->purify($fetch_com_user['last_name']);
  $com_gender = $purifier->purify($fetch_com_user['gender']);
  $com_middle_name = $com_middle_name == NULL || "" ? '' : $com_middle_name;
  $com_full_name = $com_first_name . ' ' . $com_middle_name . ' ' . $com_last_name;

  $commentor2 = mysqli_query($dbcon, "SELECT profile_pic FROM user_info WHERE user_id=$com_user_id LIMIT 1");
  if (mysqli_num_rows($commentor2) == 1) {
    $fetch_com_pic = mysqli_fetch_assoc($commentor2);
    $com_profile_pic = $purifier->purify($fetch_com_pic['profile_pic']);
    $com_profile_pic = "$com_profile_pic";
  }

  //Return Comments
  echo "
  <li class='media app_comment ajax-comment' style='overflow-wrap:break-word;word-wrap:break-word;-ms-word-break:break-all;word-break:break-word;'>
    <img src='$com_profile_pic' class='mr-2 d-flex rounded-circle' alt='$com_full_name' style='height:42px; width:42px;'>
    <div class='media-body'>
      <h6 class='mt-0 mb-1'>$com_full_name <small class='text-muted'>$time_since</small></h6>
      <span class='comment'>$comment</span>
    </div>
  </li>";
}

// Video comment
if (isset($_POST["vidCommenTxt"]) && !empty($_POST['vidCommenTxt'])) {
  $commentxt = $purifier->purify($_POST['vidCommenTxt']);
  $artist_id = $purifier->purify($_POST['vidArtist_id']);
  $video_id = $purifier->purify($_POST['video_id']);
  //$app_commentxt = sanitizeString($_POST['app_commentxt']);
  $patterns = array("/https/", "/http/", "/www./", "/\.org/", "/\.com/", "/\.net/", "/\.io/", "/<script>/", "/<\/script>/");
  $commentxttrim = preg_replace($patterns, "", $commentxt);

  // Insert comment into audio_video_comment table
  $query1 = "INSERT INTO audio_video_comment (user_id, app_id, artist_id, video_id, comment, date_time) VALUES (?,?,?,?,?, NOW())";
  $q = mysqli_stmt_init($dbcon);
  mysqli_stmt_prepare($q, $query1);
  // use prepared statement to insure that only text is inserted
  // bind fields to SQL Statement
  mysqli_stmt_bind_param($q, 'iiiis', $user_id, $app_id, $artist_id, $video_id, $commentxttrim);
  // execute query
  mysqli_stmt_execute($q);

  if (mysqli_stmt_affected_rows($q) == 1) {
    $com_id = mysqli_insert_id($dbcon);
  }
  ////////////////////////////  Query the app_comment table ////////////////////////////
  $app_comment = mysqli_query($dbcon, "SELECT * FROM audio_video_comment WHERE comment_id=$com_id AND artist_id=$artist_id AND video_id=$video_id");
  // Check the result:
  $fetch_comment = mysqli_fetch_assoc($app_comment);
  // fetch the records
  $com_user_id = $purifier->purify($fetch_comment['user_id']);
  $comment = $purifier->purify($fetch_comment['comment']);
  $date   = $fetch_comment['date_time'];
  $time = Carbon::parse($date);
  $time_since = $time->diffForHumans();

  ////////////////////////////  Query the users table for commentor names ////////////////////////////
  $commentor1 = mysqli_query($dbcon, "SELECT first_name, middle_name, last_name, gender FROM users WHERE user_id=$com_user_id");
  //LEFT JOIN user_info i USING (user_id) WHERE user_id=$com_user_id");
  // Check the result:
  $fetch_com_user = mysqli_fetch_assoc($commentor1);
  $com_first_name = $purifier->purify($fetch_com_user['first_name']);
  $com_middle_name = $purifier->purify($fetch_com_user['middle_name']);
  $com_last_name = $purifier->purify($fetch_com_user['last_name']);
  $com_gender = $purifier->purify($fetch_com_user['gender']);
  $com_middle_name = $com_middle_name == NULL || "" ? '' : $com_middle_name;
  $com_full_name = $com_first_name . ' ' . $com_middle_name . ' ' . $com_last_name;

  $commentor2 = mysqli_query($dbcon, "SELECT profile_pic FROM user_info WHERE user_id=$com_user_id LIMIT 1");
  if (mysqli_num_rows($commentor2) == 1) {
    $fetch_com_pic = mysqli_fetch_assoc($commentor2);
    $com_profile_pic = $purifier->purify($fetch_com_pic['profile_pic']);
    $com_profile_pic = "$com_profile_pic";
  }

  //Return Comments
  echo "
  <li class='media app_comment ajax-comment' style='overflow-wrap:break-word;word-wrap:break-word;-ms-word-break:break-all;word-break:break-word;'>
    <img src='$com_profile_pic' class='mr-2 d-flex rounded-circle' alt='$com_full_name' style='height:42px; width:42px;'>
    <div class='media-body'>
      <h6 class='mt-0 mb-1'>$com_full_name <small class='text-muted'>$time_since</small></h6>
      <span class='comment'>$comment</span>
    </div>
  </li>";
}

// News Comment
if (isset($_POST["post_commentxt"]) && !empty($_POST['post_commentxt'])) {
  $post_commentxt = $purifier->purify($_POST['post_commentxt']);
  $post_comm_id = $purifier->purify($_POST['post_comm_id']);
  //$app_commentxt = sanitizeString($_POST['app_commentxt']);
  $patterns = array("/https/", "/http/", "/www./", "/\.org/", "/\.com/", "/\.net/", "/\.io/", "/<script>/", "/<\/script>/");
  $post_commentxttrim = preg_replace($patterns, "", $post_commentxt);

  // Insert comment into post comment table
  $post_query = "INSERT INTO post_comment (user_id, app_id, post_id, comment, date_time) VALUES (?,?,?,?, NOW())";
  $q = mysqli_stmt_init($dbcon);
  mysqli_stmt_prepare($q, $post_query);
  // use prepared statement to insure that only text is inserted
  // bind fields to SQL Statement
  mysqli_stmt_bind_param($q, 'iiis', $user_id, $app_id, $post_comm_id, $post_commentxttrim);
  // execute query
  mysqli_stmt_execute($q);

  if (mysqli_stmt_affected_rows($q) == 1) {
    $com_id = mysqli_insert_id($dbcon);

    ////////////////////////////  Query the post_comment table ////////////////////////////
    $post_comment = mysqli_query($dbcon, "SELECT pc.*, ur.first_name, ur.middle_name, ur.last_name, ur.gender, ui.profile_pic
    FROM post_comment pc LEFT JOIN users ur USING (user_id) LEFT JOIN user_info ui USING (user_id) WHERE comment_id=$com_id
    AND app_id=$app_id AND post_id=$post_comm_id");
    // Check the result:
    $fetch_comment = mysqli_fetch_assoc($post_comment);
    // fetch the records
    $com_user_id = $purifier->purify($fetch_comment['user_id']);
    $comment = $purifier->purify($fetch_comment['comment']);
    $first_name = $purifier->purify($fetch_comment['first_name']);
    $middle_name = $purifier->purify($fetch_comment['middle_name']);
    $last_name = $purifier->purify($fetch_comment['last_name']);
    $profile_pic = $purifier->purify($fetch_comment['profile_pic']);
    $com_full_name = $first_name . ' ' . $middle_name . ' ' . $last_name;
    $com_profile_pic = "$profile_pic";
    $date   = $fetch_comment['date_time'];
    $time = Carbon::parse($date);
    $time_since = $time->diffForHumans();

    //Return Comments
    echo "
    <li class='media app_comment ajax-comment' style='overflow-wrap:break-word;word-wrap:break-word;-ms-word-break:break-all;word-break:break-word;'>
      <img src='$com_profile_pic' class='mr-2 d-flex rounded-circle' alt='$com_full_name' style='height:42px; width:42px;'>
      <div class='media-body'>
        <h6 class='mt-0 mb-1'>$com_full_name <small class='text-muted'>$time_since</small></h6>
        <span class='comment'>$comment</span>
      </div>
    </li>";
  }
}

// Reply News Comment
if (isset($_POST["reply_commentxt"]) && !empty($_POST['reply_commentxt'])) {
  $reply_commentxt = $purifier->purify($_POST['reply_commentxt']);
  $reply_comm_id = $purifier->purify($_POST['reply_comm_id']);
  $post_id = $purifier->purify($_POST['post_id']);
  //$app_commentxt = sanitizeString($_POST['app_commentxt']);
  $patterns = array("/https/", "/http/", "/www./", "/\.org/", "/\.com/", "/\.net/", "/\.io/", "/<script>/", "/<\/script>/");
  $reply_commentxttrim = preg_replace($patterns, "", $reply_commentxt);

  // Insert comment into post comment table
  $reply_query = "INSERT INTO post_comment_reply (post_comment_reply_id, comment_id, user_id, post_id, comment, date_time) VALUES ('',?,?,?,?, NOW())";
  $q = mysqli_stmt_init($dbcon);
  mysqli_stmt_prepare($q, $reply_query);
  // use prepared statement to insure that only text is inserted
  // bind fields to SQL Statement
  mysqli_stmt_bind_param($q, 'iiis', $reply_comm_id, $user_id, $post_id, $reply_commentxttrim);
  // execute query
  mysqli_stmt_execute($q);

  if (mysqli_stmt_affected_rows($q) == 1) {
    // $com_id = mysqli_insert_id($dbcon);

    ////////////////////////////  Query the post_comment_reply table ////////////////////////////
    $reply_comment = mysqli_query($dbcon, "SELECT rc.*, ur.first_name, ur.middle_name, ur.last_name, ur.gender, ui.profile_pic
    FROM post_comment_reply rc LEFT JOIN users ur USING (user_id) LEFT JOIN user_info ui USING (user_id) WHERE comment_id=$reply_comm_id
    AND post_id=$post_id");
    // Check the result:
    $fetch_comm_reply = mysqli_fetch_assoc($reply_comment);
    // fetch the records
    // $com_user_id = $purifier->purify($fetch_reply_comment['user_id']);
    $pcr_comment = $purifier->purify($fetch_comm_reply['comment']);
    $pcr_first_name = $purifier->purify($fetch_comm_reply['first_name']);
    $pcr_middle_name = $purifier->purify($fetch_comm_reply['middle_name']);
    $pcr_last_name = $purifier->purify($fetch_comm_reply['last_name']);
    $pcr_profile_pic = $purifier->purify($fetch_comm_reply['profile_pic']);
    $pcr_com_full_name = $pcr_first_name . ' ' . $pcr_middle_name . ' ' . $pcr_last_name;
    $pcr_com_profile_pic = "$pcr_profile_pic";
    $pcr_date   = $fetch_comm_reply['date_time'];
    $pcr_time = Carbon::parse($pcr_date);
    $pcr_time_since = $pcr_time->diffForHumans();

    echo "<hr><div clas='media py-0 my-0'>
          <span class='float-left mr-2'>
            <img src='$pcr_com_profile_pic' alt='$pcr_com_full_name' class='mr-md-1 d-flex rounded-circle' style='height:42px; width:42px;'>
          </span>
          <div class='media-body mr-md-2'>
            <h6 class='mt-0 mb-1'>$pcr_com_full_name <small class='text-muted d-block d-md-inline-block'>$pcr_time_since</small></h6>
            <span class=''>$pcr_comment</span>
          </div></div>";
  }
}

// Update download button number on click
if (isset($_POST['song_id'])) {
  $song_id = $purifier->purify($_POST['song_id']);

  $query_download = mysqli_query($dbcon, "SELECT downloads FROM audio WHERE audio_id=$song_id");
  // fetch the records
  $fetchNumOfDownloads = mysqli_fetch_assoc($query_download);
  $numOfDownloads = $purifier->purify($fetchNumOfDownloads['downloads']);

  if ($numOfDownloads == NULL) {
    mysqli_query($dbcon, "UPDATE audio SET downloads= 1 WHERE audio_id=$song_id");
  } else {
    mysqli_query($dbcon, "UPDATE audio SET downloads= downloads + 1 WHERE audio_id=$song_id");
  }
}
