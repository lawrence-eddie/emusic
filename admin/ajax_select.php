<?php
//ob_start();
// Initialize a session:
session_start();
require_once('../obaEddie_connect.php');
require_once('../include/config.inc.php');

//require '../vendor/autoload.php';
//use Carbon\Carbon;

// Purify plugin
//$dbcon->set_charset("utf8mb4");
require_once '../HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

//header('Content-type: text/plain; charset=utf-8');
//require_once('../include/userTZ.php');
//require_once('process_admin_index.php');

//$adminUser_id = $_SESSION['user_id'];
$return_arr = array();

// For Add Audio Album details
if (isset($_POST['selectAudioAlbum_id']) and !empty($_POST['selectAudioAlbum_id'])) {
  $artist_id = $purifier->purify($_POST['selectAudioAlbum_id']);
  $queryAlbumDetails = mysqli_query($dbcon, "SELECT album_id, album_name FROM album WHERE artist_id=$artist_id ORDER BY album_name");
  // Check the result:
  if (mysqli_num_rows($queryAlbumDetails) > 0) {
    while ($fetch_AlbumDetails = mysqli_fetch_assoc($queryAlbumDetails)) {
      $album_id = $purifier->purify($fetch_AlbumDetails['album_id']);
      $album_name = $purifier->purify($fetch_AlbumDetails['album_name']);

      $return_arr[] = array("id" => $album_id, "name" => $album_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Add Video Audio details
if (isset($_POST['selectVideoAudio_id']) and !empty($_POST['selectVideoAudio_id'])) {
  $artist_id = $purifier->purify($_POST['selectVideoAudio_id']);
  $querySongDetails = mysqli_query($dbcon, "SELECT audio_id, audio_name FROM audio WHERE artist_id=$artist_id ORDER BY audio_name");
  // Check the result:
  if (mysqli_num_rows($querySongDetails) > 0) {
    while ($fetch_SongDetails = mysqli_fetch_assoc($querySongDetails)) {
      $audio_id = $purifier->purify($fetch_SongDetails['audio_id']);
      $audio_name = $purifier->purify($fetch_SongDetails['audio_name']);

      $return_arr[] = array("id" => $audio_id, "name" => $audio_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Add Video Album details
if (isset($_POST['selectVideoAlbum_id']) and !empty($_POST['selectVideoAlbum_id'])) {
  $artist_id = $purifier->purify($_POST['selectVideoAlbum_id']);
  $queryAlbumDetails = mysqli_query($dbcon, "SELECT album_id, album_name FROM album WHERE artist_id=$artist_id ORDER BY album_name");
  // Check the result:
  if (mysqli_num_rows($queryAlbumDetails) > 0) {
    while ($fetch_AlbumDetails = mysqli_fetch_assoc($queryAlbumDetails)) {
      $album_id = $purifier->purify($fetch_AlbumDetails['album_id']);
      $album_name = $purifier->purify($fetch_AlbumDetails['album_name']);

      $return_arr[] = array("id" => $album_id, "name" => $album_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Edit Post details
if (isset($_POST['editPostApp_id']) and !empty($_POST['editPostApp_id'])) {
  $app_id = $purifier->purify($_POST['editPostApp_id']);
  $queryAppDetails = mysqli_query($dbcon, "SELECT admin_post_num, msg_header FROM post WHERE app_id=$app_id ORDER BY admin_post_num");
  // Check the result:
  if (mysqli_num_rows($queryAppDetails) > 0) {
    while ($fetch_AppDetails = mysqli_fetch_assoc($queryAppDetails)) {
      $postNum = $purifier->purify($fetch_AppDetails['admin_post_num']);
      $msg_header = $purifier->purify($fetch_AppDetails['msg_header']);

      $return_arr[] = array("id" => $postNum, "name" => $msg_header);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// for delete Post details
if (isset($_POST['deletePostNum']) and !empty($_POST['deletePostNum'])) {
  $app_id = $purifier->purify($_POST['deletePostNum']);
  $queryAppDetails = mysqli_query($dbcon, "SELECT post_id, admin_post_num, msg_header FROM post WHERE app_id=$app_id AND admin_post_num IS NOT NULL ORDER BY admin_post_num");
  // Check the result:
  if (mysqli_num_rows($queryAppDetails) > 0) {
    while ($fetch_AppDetails = mysqli_fetch_assoc($queryAppDetails)) {
      $post_id = $purifier->purify($fetch_AppDetails['post_id']);
      $msg_header = $purifier->purify($fetch_AppDetails['msg_header']);

      $return_arr[] = array("id" => $post_id, "name" => $msg_header);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Edit Album details
if (isset($_POST['editAlbumArtist_id']) and !empty($_POST['editAlbumArtist_id'])) {
  $artist_id = $purifier->purify($_POST['editAlbumArtist_id']);
  $queryAlbumDetails = mysqli_query($dbcon, "SELECT album_id, album_name FROM album WHERE artist_id=$artist_id ORDER BY album_name");
  // Check the result:
  if (mysqli_num_rows($queryAlbumDetails) > 0) {
    while ($fetch_AlbumDetails = mysqli_fetch_assoc($queryAlbumDetails)) {
      $album_id = $purifier->purify($fetch_AlbumDetails['album_id']);
      $album_name = $purifier->purify($fetch_AlbumDetails['album_name']);

      $return_arr[] = array("id" => $album_id, "name" => $album_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Delete Album details
if (isset($_POST['deleteAlbumArtist_id']) and !empty($_POST['deleteAlbumArtist_id'])) {
  $artist_id = $purifier->purify($_POST['deleteAlbumArtist_id']);
  $queryAlbumDetails = mysqli_query($dbcon, "SELECT album_id, album_name FROM album WHERE artist_id=$artist_id ORDER BY album_name");
  // Check the result:
  if (mysqli_num_rows($queryAlbumDetails) > 0) {
    while ($fetch_AlbumDetails = mysqli_fetch_assoc($queryAlbumDetails)) {
      $album_id = $purifier->purify($fetch_AlbumDetails['album_id']);
      $album_name = $purifier->purify($fetch_AlbumDetails['album_name']);

      $return_arr[] = array("id" => $album_id, "name" => $album_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Delete Song details
if (isset($_POST['deleteSongArtist_id']) and !empty($_POST['deleteSongArtist_id'])) {
  $artist_id = $purifier->purify($_POST['deleteSongArtist_id']);
  $querySongDetails = mysqli_query($dbcon, "SELECT audio_id, audio_name FROM audio WHERE artist_id=$artist_id ORDER BY audio_name");
  // Check the result:
  if (mysqli_num_rows($querySongDetails) > 0) {
    while ($fetch_SongDetails = mysqli_fetch_assoc($querySongDetails)) {
      $audio_id = $purifier->purify($fetch_SongDetails['audio_id']);
      $audio_name = $purifier->purify($fetch_SongDetails['audio_name']);

      $return_arr[] = array("id" => $audio_id, "name" => $audio_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}

// For Delete Video details
if (isset($_POST['deleteVideoArtist_id']) and !empty($_POST['deleteVideoArtist_id'])) {
  $artist_id = $purifier->purify($_POST['deleteVideoArtist_id']);
  $queryVideoDetails = mysqli_query($dbcon, "SELECT video_id, video_name FROM video WHERE artist_id=$artist_id ORDER BY video_name");
  // Check the result:
  if (mysqli_num_rows($queryVideoDetails) > 0) {
    while ($fetch_VideoDetails = mysqli_fetch_assoc($queryVideoDetails)) {
      $video_id = $purifier->purify($fetch_VideoDetails['video_id']);
      $video_name = $purifier->purify($fetch_VideoDetails['video_name']);

      $return_arr[] = array("id" => $video_id, "name" => $video_name);
    }
  }
  //Return json formatted data
  echo json_encode($return_arr);
}


//============================ FOR ADMIN NOTIFICATION ========================//
// Update New User Notification number on click
if (isset($_POST['new_user'])) {
  // $msgerUser_id = $purifier->purify($_POST['msgerUser_id']);
  mysqli_query($dbcon, "UPDATE users SET new_user='no'");
}

// Update Message Notification number on click
if (isset($_POST['admin_users_msg'])) {
  // $msgerUser_id = $purifier->purify($_POST['msgerUser_id']);
  mysqli_query($dbcon, "UPDATE admin_msg_reply SET opened='yes'");
}

if (isset($_POST['contactForm_msg'])) {
  // $msgerUser_id = $purifier->purify($_POST['msgerUser_id']);
  mysqli_query($dbcon, "UPDATE contact_us SET opened='yes'");
}
