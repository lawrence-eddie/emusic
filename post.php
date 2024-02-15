<?php
// Turn off all error reporting
// error_reporting(0);
// This is the post page for this site
// Start output buffering:
ob_start();

// Initialize a session:
// session_set_cookie_params(time() + (365 * 24 * 60 * 60), "/emusic/");
session_start();
require_once('obaEddie_connect.php');
define('ERROR_LOG', 'logs/errors.log');
require_once('include/config.inc.php');

require_once 'vendor/autoload.php';

use Carbon\Carbon;

// Purify plugin
//$dbcon->set_charset("utf8mb4");
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

require_once('include/userTZ.php');

if (isset($_GET['pid'])) $pid = $purifier->purify($_GET['pid']);

// if (isset($_GET['uid'])) {
//   $uid = $purifier->purify($_GET['uid']);
// } else $uid = '';

// if (isset($_GET['uid'])) $uid = $purifier->purify($_GET['uid']);

if (!isset($pid)) {
  redirect_user();
  exit();
}

$other_images = "";

$post_details = mysqli_query($dbcon, "SELECT post_id, msg_header, post_msg, post_msg_2, post_msg_3, post_pic,
post_audio, post_video, youtube_url, tag_users, date_time FROM post WHERE post_id=$pid AND block_post=0");
// Check the result:
if (mysqli_num_rows($post_details) == 1) {
  // fetch the records
  $fetch_post_details = mysqli_fetch_assoc($post_details);
  // Post Details
  $msg_header = $purifier->purify($fetch_post_details['msg_header']);
  $post_msg = $purifier->purify($fetch_post_details['post_msg']);
  $post_msg_2 = $purifier->purify($fetch_post_details['post_msg_2']);
  $post_msg_3 = $purifier->purify($fetch_post_details['post_msg_3']);
  $post_pic = $purifier->purify($fetch_post_details['post_pic']);
  $post_audio = $purifier->purify($fetch_post_details['post_audio']);
  $post_video = $purifier->purify($fetch_post_details['post_video']);
  $youtube_url = $purifier->purify($fetch_post_details['youtube_url']);
  $tag_posts = $purifier->purify($fetch_post_details['tag_users']);
  $date_time = $purifier->purify($fetch_post_details['date_time']);

  $post_pic = (empty($post_pic)) ? "$adminPicture" : "$post_pic";
  $post_audio = (empty($post_audio)) ? "" : "$post_audio";
  $post_video = (empty($post_video)) ? "" : "$post_video";
} else {
  redirect_user();
  exit();
}

$post_pic_details = mysqli_query($dbcon, "SELECT post_pic_1, post_pic_2, post_pic_3, post_pic_4, post_pic_5,
post_pic_6, post_pic_7, post_pic_8, post_pic_9, post_pic_10, post_pic_11, post_pic_12, post_pic_13, post_pic_14,
post_pic_15 FROM post_pic WHERE post_id=$pid");
// Check the result:
if (mysqli_num_rows($post_pic_details) == 1) {
  // fetch the records
  $fetch_post_pic_details = mysqli_fetch_assoc($post_pic_details);
  // Post Details
  $post_pic_1 = $purifier->purify($fetch_post_pic_details['post_pic_1']);
  $post_pic_2 = $purifier->purify($fetch_post_pic_details['post_pic_2']);
  $post_pic_3 = $purifier->purify($fetch_post_pic_details['post_pic_3']);
  $post_pic_4 = $purifier->purify($fetch_post_pic_details['post_pic_4']);
  $post_pic_5 = $purifier->purify($fetch_post_pic_details['post_pic_5']);
  $post_pic_6 = $purifier->purify($fetch_post_pic_details['post_pic_6']);
  $post_pic_7 = $purifier->purify($fetch_post_pic_details['post_pic_7']);
  $post_pic_8 = $purifier->purify($fetch_post_pic_details['post_pic_8']);
  $post_pic_9 = $purifier->purify($fetch_post_pic_details['post_pic_9']);
  $post_pic_10 = $purifier->purify($fetch_post_pic_details['post_pic_10']);
  $post_pic_11 = $purifier->purify($fetch_post_pic_details['post_pic_11']);
  $post_pic_12 = $purifier->purify($fetch_post_pic_details['post_pic_12']);
  $post_pic_13 = $purifier->purify($fetch_post_pic_details['post_pic_13']);
  $post_pic_14 = $purifier->purify($fetch_post_pic_details['post_pic_14']);
  $post_pic_15 = $purifier->purify($fetch_post_pic_details['post_pic_15']);

  $post_pic_1 = (empty($post_pic_1)) ? "" : "$post_pic_1";
  $post_pic_2 = (empty($post_pic_2)) ? "" : "$post_pic_2";
  $post_pic_3 = (empty($post_pic_3)) ? "" : "$post_pic_3";
  $post_pic_4 = (empty($post_pic_4)) ? "" : "$post_pic_4";
  $post_pic_5 = (empty($post_pic_5)) ? "" : "$post_pic_5";
  $post_pic_6 = (empty($post_pic_6)) ? "" : "$post_pic_6";
  $post_pic_7 = (empty($post_pic_7)) ? "" : "$post_pic_7";
  $post_pic_8 = (empty($post_pic_8)) ? "" : "$post_pic_8";
  $post_pic_9 = (empty($post_pic_9)) ? "" : "$post_pic_9";
  $post_pic_10 = (empty($post_pic_10)) ? "" : "$post_pic_10";
  $post_pic_11 = (empty($post_pic_11)) ? "" : "$post_pic_11";
  $post_pic_12 = (empty($post_pic_12)) ? "" : "$post_pic_12";
  $post_pic_13 = (empty($post_pic_13)) ? "" : "$post_pic_13";
  $post_pic_14 = (empty($post_pic_14)) ? "" : "$post_pic_14";
  $post_pic_15 = (empty($post_pic_15)) ? "" : "$post_pic_15";

  $other_images = array(
    $post_pic_1, $post_pic_2, $post_pic_3, $post_pic_4, $post_pic_5, $post_pic_6, $post_pic_7,
    $post_pic_8, $post_pic_9, $post_pic_10, $post_pic_11, $post_pic_12, $post_pic_13, $post_pic_14, $post_pic_15
  );
}


if (isset($msg_header)) {
  $page_title = "$msg_header";
}
require_once('include/header.php');
// Set character encoding for emoji
$dbcon->set_charset("utf8mb4");
?>
<style>
  body {
    height: 100% !important;
  }
</style>
<div class="container-xl">
  <!-- Main Picture -->
  <div class="row">
    <div class="col-12">
      <div class="mt-3">
        <div class="card bg-dark text-white">
          <img <?php echo "src='$post_pic' alt='$msg_header'"; ?> class="card-img postNewsMainImg">
          <div class="card-img-overlay">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Post Title -->
  <div class="row mt-3 mt-lg-5">
    <div class="post_title text-center justify-content-center mx-auto">
      <?php echo "<h1 class='font-weight-normal text-primary'>$msg_header</h1>"; ?>
    </div>
  </div>
  <!-- Main Column -->
  <div class="row mt-3">
    <div class="col-lg-9 mainPageHeight">
      <!-- Advert -->
      <div class="row">
        <div class="col-md-6">
          <div class='large-rectangle-advert mx-auto'>
            <img src='img/advert.jpg' class='advertisement' alt='...'>
          </div>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
          <div class='large-rectangle-advert mx-auto'>
            <img src='img/advert.jpg' class='advertisement' alt='...'>
          </div>
        </div>
      </div>
      <!-- Paragraphs -->
      <div class="1_paragraph mt-4 text-monospace">
        <?php
        if (!empty($post_msg)) {
          echo "<p class=''>$post_msg</p>";
          echo "<div class='row'>
            <div class='col-md-6'>
              <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
            </div>
            <div class='col-md-6 mt-3 mt-md-0'>
              <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
            </div>
          </div>";
        }
        ?>
      </div>
      <div class="2_paragraph mt-3 text-monospace">
        <?php
        if (!empty($post_msg_2)) {
          echo "<p class=''>$post_msg_2</p>";
          echo "<div class='row'>
            <div class='col-md-6'>
              <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
            </div>
            <div class='col-md-6 mt-3 mt-md-0'>
              <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
            </div>
          </div>";
        }
        ?>
      </div>
      <div class="3_paragraph mt-3 text-monospace">
        <?php
        if (!empty($post_msg_3)) {
          echo "<p class=''>$post_msg_3</p>";
          echo "<div class='row'>
            <div class='col-md-6'>
              <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
            </div>
            <div class='col-md-6 mt-3 mt-md-0'>
              <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
            </div>
          </div>";
        }
        ?>
      </div>
      <!-- Media files and Other images if any -->
      <div class="mt-5 mediaFilesOffset">
        <?php
        if (!empty($post_audio)) {
          echo "<div class='card mb-3' id='audio_section'>
            <h6 class='text-center card-subtitle text-bolder mb-3 text-muted pt-3'>Accompanied audio file</h6>
            <div class='card-body mx-auto'>
              <div class='audio-player' style='width: 80%;'>
                <div id='post_audio'>
            			<div class='spinner-border text-primary' role='status'>
            				<span class='sr-only'>Loading...</span>
            			</div>
                </div>
            	</div>
            </div>
          </div>";
        }
        if (!empty($other_images)) {
          echo "<h5 class=''>More images</h5>
          <div class='row px-0 mx-0 baguetteBoxOne mb-3'>";
          foreach (array_filter($other_images) as $other_image) {
            echo "<div class='col-6 col-md-4 col-lg-4 mt-2 px-0 mx-0'>
                <a href='$other_image'><img src='$other_image'/></a>
            </div>";
          }
          echo "</div>";
        }
        if (!empty($youtube_url)) {
          // echo "youtube url present";
          echo "<video class='mb-3' style='max-width: 100%;' id='player1' preload='none'>
            <source type='video/youtube' src='$youtube_url'/>
          </video>";
          // echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/n1FIQVk1JEE" title="YouTube video player" frameborder="0"
          // allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        }
        if (!empty($post_video)) {
          echo "<div class='mb-3'>
            <video controls class='player' id='player2' height='360'
              width='100%' loop poster='$post_pic'
              preload='none' src='$post_video'
              style='max-width: 100%' tabindex='0' title='$msg_header'>
            </video>
          </div>";
        }
        ?>
      </div>
    </div>
    <div class="col-lg-3 mt-5 mt-lg-0">
      <!-- NEWS POST FOR LARGE DEVICES -->
      <div class="d-none d-lg-block news-post">
        <div class="card">
          <div class="card-header text-info"><span class="glyphicon glyphicon-list-alt"></span><b><a href="news.php">News Feed</a></b></div>
          <div class="card-body">
            <div class="row">
              <div class="col-xs-12">
                <ul class="demo1">
                  <?php
                  $queryPost = mysqli_query($dbcon, "SELECT post_id, msg_header, post_pic FROM post WHERE post_id!=$pid AND admin_post_dir IS NOT NULL ORDER BY post_id DESC LIMIT 20");
                  // check for result
                  if (mysqli_num_rows($queryPost) > 0) {
                    while ($fetch_Post = mysqli_fetch_assoc($queryPost)) {
                      $post_id  = $purifier->purify($fetch_Post['post_id']);
                      $post_msg_header  = $purifier->purify($fetch_Post['msg_header']);
                      $post_pic  = $purifier->purify($fetch_Post['post_pic']);
                      $post_pic = (empty($post_pic)) ? $adminPicture : "$post_pic";
                      $link = "post.php?pid=$post_id";

                      echo "<li class='news-item'>
                        <a href='$link'>
                          <table cellpadding='4'>
                            <tr>
                              <td><img src='$post_pic' width='60' height='60' class='img-circle' /></td>
                              <td class='text-wrap news_msgHeader text-info'>$post_msg_header</td>
                            </tr>
                          </table>
                        </a>
                      </li>";
                    }
                  } else { ?>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Related Posts -->
  <div class="row">
    <div class="col-lg-8">
      <?php
      $querytagPosts = mysqli_query($dbcon, "SELECT tag_users FROM post WHERE post_id=$pid AND admin_post_dir IS NOT NULL");
      // Check the result:
      if (mysqli_num_rows($querytagPosts) == 1) {
        $fetch_tagPosts = mysqli_fetch_assoc($querytagPosts);
        $tag_posts = $purifier->purify($fetch_tagPosts['tag_users']);
        $tag_posts = explode(',', $tag_posts); // explode() returns array object
        $tagged_posts = implode("','", $tag_posts);

        $query_RelatedPosts = mysqli_query($dbcon, "SELECT post_id, msg_header, post_pic FROM post WHERE post_id IN ('$tagged_posts') AND admin_post_dir IS NOT NULL ORDER BY post_id DESC LIMIT 10");
        $query_RelatedPostsnumb = mysqli_num_rows($query_RelatedPosts);
        if ($query_RelatedPostsnumb >= 3) {
          echo "<div class='jumbotron-fluid py-3 float-app border'>
          <h6 class='text-muted pl-3 font-weight-bold text-muted'>Related Posts</h6>
          <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3'>";
          // fetch the records
          while ($fetch_RelatedPosts = mysqli_fetch_assoc($query_RelatedPosts)) {
            // TagPosts Details
            $post_id = $purifier->purify($fetch_RelatedPosts['post_id']);
            $msg_header = $purifier->purify($fetch_RelatedPosts['msg_header']);
            $post_pic = $purifier->purify($fetch_RelatedPosts['post_pic']);
            $post_pic = "$post_pic";
            $hit_link = "post.php?pid=$post_id";

            // echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='' class='round-img'/></a></div>";
            echo "<div class='col'><a class='' href='$hit_link'><img src='$post_pic' alt='$msg_header' class='rounded rel_song-carouselImg'/></a></div>";
          }
          echo "<div class='col'><div class='text-white advertisement large-rectangle-advert mx-auto'>
                  <img src='img/advert.jpg' class='card-img' alt='...'>
                </div></div></div></div>";
        } elseif ($query_RelatedPostsnumb >= 2) {
          echo "<div class='jumbotron-fluid py-3 float-app border'>
          <h6 class='text-muted pl-3 font-weight-bold text-muted'>Related Posts</h6>
          <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3'>";
          // fetch the records
          while ($fetch_RelatedPosts = mysqli_fetch_assoc($query_RelatedPosts)) {
            // TagPosts Details
            $post_id = $purifier->purify($fetch_RelatedPosts['post_id']);
            $msg_header = $purifier->purify($fetch_RelatedPosts['msg_header']);
            $post_pic = $purifier->purify($fetch_RelatedPosts['post_pic']);
            $post_pic = "$post_pic";
            $hit_link = "post.php?pid=$post_id";

            // echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='' class='round-img'/></a></div>";
            echo "<div class='col'><a class='' href='$hit_link'><img src='$post_pic' alt='$msg_header' class='rounded rel_song-carouselImg'/></a></div>";
          }
          echo "<div class='col'><div class='text-white advertisement large-rectangle-advert mx-auto'>
                  <img src='img/advert.jpg' class='card-img' alt='...'>
                </div></div></div></div>";
        } elseif ($query_RelatedPostsnumb == 1) {
          echo "<div class='jumbotron-fluid py-3 float-app border'>
          <h6 class='text-muted pl-3 font-weight-bold text-muted'>Related Posts</h6>
          <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3'>";
          // fetch the records
          while ($fetch_RelatedPosts = mysqli_fetch_assoc($query_RelatedPosts)) {
            // TagPosts Details
            $post_id = $purifier->purify($fetch_RelatedPosts['post_id']);
            $msg_header = $purifier->purify($fetch_RelatedPosts['msg_header']);
            $post_pic = $purifier->purify($fetch_RelatedPosts['post_pic']);
            $post_pic = "$post_pic";
            $hit_link = "post.php?pid=$post_id";

            // echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='' class='round-img'/></a></div>";
            echo "<div class='col'><a class='' href='$hit_link'><img src='$post_pic' alt='$msg_header' class='rounded rel_song-carouselImg'/></a></div>";
          }
          echo "<div class='col'><div class='text-white advertisement large-rectangle-advert mx-auto'>
                  <img src='img/advert.jpg' class='card-img' alt='...'>
                </div></div></div></div>";
        } else {
          echo '<div class="row mb-5">
          <div class="col-md-6">
            <div class="text-white advertisement large-rectangle-advert mx-auto">
              <img src="img/advert.jpg" class="card-img" alt="...">
            </div>
          </div>
          <div class="col-md-6">
            <div class="text-white advertisement large-rectangle-advert mx-auto">
              <img src="img/advert.jpg" class="card-img" alt="...">
            </div>
          </div>
        </div>';
        }
      }
      ?>
    </div>
    <div class="col-lg-4 pt-5 pt-lg-0 d-none d-lg-block">
      <!-- ADVERTISEMENT -->
      <div class="text-white advertisement large-rectangle-advert mx-auto">
        <img src="img/advert.jpg" class="card-img" alt="...">
      </div>
    </div>
  </div>

  <!-- Comment section -->
  <div class="row mt-3 px-lg-2 comment-row">
    <div class="jumbotron pt-3 col-sm-12" style="overflow:hidden;">
      <h4 class="text-muted mt-0 mb-3">Comments...</h4>
      <div class="" id="comment-sect">
        <?php
        if (!isset($user_id)) {
          echo "<div class='mb-3 mt-2'>
            <a data-toggle='modal' href='javascript:void(0)' onclick='openLoginModal();' class='border p-2 border-info text-decoration-none'>
            <i class='far fa-user-circle'></i> Log in to comment</a> <br class='d-block d-md-none'>&nbsp;<br class='d-block d-md-none'>
            <a href='login_register.php?signUp=#signUp' class='border p-2 border-info text-decoration-none'>
            <i class='fas fa-user-plus'></i> Create an account</a>
          </div>";
        } else {
          echo "<div class='expanding-wrapper p-1'>
            <textarea class='expanding post_commentxt form-control rounded-pill' spellcheck='true' autocomplete='on'
            placeholder='Write a comment...' rows='1' data-post='$pid'></textarea>
          </div>";
        }
        ?>
        <script type="text/javascript">
          document.addEventListener('DOMContentLoaded', function() {
            $("textarea.post_commentxt").keypress(function(e) {
              if (!$.trim($(this).val()).length < 1 && e.which == 13 && !e.shiftKey) {
                e.preventDefault();
                //submit form via ajax, this is not JS but server side scripting so not showing here
                var val = $(this).val();
                var data_post_id = $(this).attr("data-post");
                //alert(val + " and app_id is " + app_comment_id);
                // AJAX Request
                $.ajax({
                  url: 'au_vid_comment.php',
                  type: 'post',
                  data: {
                    post_commentxt: val,
                    post_comm_id: data_post_id
                  },
                  success: function(comments) {
                    // Update comments
                    $("ul#comment_section").prepend(comments);
                    if (!$.trim($('ul#comment_section').html()).length) {
                      location.reload()
                    }
                    $("ul#comment_section").load(window.location.href + " ul#comment_section");
                  }
                });
                $(this).val("");
              }
            });
          });
        </script>
        <?php ////////////////////////////  Query the post_comment table ////////////////////////////
        $post_comment = mysqli_query($dbcon, "SELECT pc.*, ur.first_name, ur.middle_name, ur.last_name, ur.gender, ui.profile_pic
        FROM post_comment pc LEFT JOIN users ur USING (user_id) LEFT JOIN user_info ui USING (user_id) WHERE
        pc.app_id=$app_id AND pc.post_id=$pid ORDER BY comment_id DESC LIMIT 20");
        // Check the result:
        $post_com_num = mysqli_num_rows($post_comment);
        if ($post_com_num > 0) {
          echo "<ul class='list-unstyled ul-comment' id='comment_section'>";
          while ($fetch_comment = mysqli_fetch_assoc($post_comment)) {
            // fetch the records
            // $com_user_id = $purifier->purify($fetch_comment['user_id']);
            $pc_comment_id = $purifier->purify($fetch_comment['comment_id']);
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
        ?>
            <!--Comments-->
            <li class='media app_comment' style="overflow-wrap:break-word;word-wrap:break-word;-ms-word-break:break-all;word-break:break-word;">
              <img src='<?php echo $com_profile_pic; ?>' class='mr-2 d-flex rounded-circle' alt='<?php echo $com_full_name; ?>' style="height:42px; width:42px;">
              <div class='media-body' style="overflow:auto;">
                <h6 class='mt-0 mb-1'><?php echo $com_full_name; ?> <small class='text-muted'><?php echo $time_since; ?></small></h6>
                <span class="comment"><?php echo $comment; ?></span>
                <!-- Reply commnet -->
                <?php
                $reply_comment = mysqli_query($dbcon, "SELECT pcr.*, us.first_name, us.middle_name, us.last_name, us.gender, up.profile_pic FROM
                post_comment_reply pcr INNER JOIN users us USING (user_id) LEFT JOIN user_info up USING (user_id) WHERE pcr.comment_id=$pc_comment_id
                AND pcr.post_id=$pid ORDER BY post_comment_reply_id DESC");
                // Check the result:
                $pcr_com_num = mysqli_num_rows($reply_comment);
                if ($pcr_com_num > 0) {
                  echo "<div class='m-md-3' id='replyComment_section'>";
                  while ($fetch_comm_reply = mysqli_fetch_assoc($reply_comment)) {
                    // fetch the records
                    // $com_user_id = $purifier->purify($fetch_comm_reply['user_id']);
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
                  echo "</div>";
                }
                if (isset($user_id)) {
                  echo "<p class='mt-0 reply-link_$pc_comment_id' style='font-size:14px;cursor:pointer;'><a class='text-info mt-1 float-left'><i class='fas fa-reply'></i> Reply</a></p>";
                }
                // require_once('newspost_replyMsg.php');
                echo "<div class='expanding-wrapper' style=''>
                <textarea class='reply-link_$pc_comment_id mt-3 reply_msgTxt form-control rounded-pill' name='reply_msgTxt' style='display:none;'
                spellcheck='true' autocomplete='on' placeholder='Reply message...' rows='1' data-id='$pid' id='$pc_comment_id'></textarea> </div>";
                ?>
                <!-- <div class="mt-3" style="clear:both;"></div> -->
                <script type="text/javascript">
                  document.addEventListener('DOMContentLoaded', function() {
                    // function replyLink() {
                    // Remove reply link and then display reply form
                    $(document).on('click', "p.reply-link_<?php echo $pc_comment_id; ?>", function(e) {
                      e.preventDefault();
                      $("p.reply-link_<?php echo $pc_comment_id; ?>").remove();
                      // $("#reply_msgTxt_3").attr("style", "display:visible");
                      $("textarea.reply-link_<?php echo $pc_comment_id; ?>").slideDown();
                      $("textarea.reply-link_<?php echo $pc_comment_id; ?>").autoResize();
                    });
                    // }

                    $(document).on("keypress", "textarea.reply-link_<?php echo $pc_comment_id; ?>", function(e) {
                      if (!$.trim($(this).val()).length < 1 && e.which == 13 && !e.shiftKey) {
                        e.preventDefault();
                        //submit form via ajax, this is not JS but server side scripting so not showing here
                        var val = $(this).val();
                        var reply_post_id = $(this).attr("id");
                        var post_id = $(this).attr("data-id");
                        // alert(val + " and reply_post_id is " + reply_post_id);
                        // AJAX Request
                        $.ajax({
                          url: 'au_vid_comment.php',
                          type: 'post',
                          data: {
                            reply_commentxt: val,
                            reply_comm_id: reply_post_id,
                            post_id: post_id
                          },
                          success: function(comments) {
                            // Update comments
                            $("div.replyComment_section").append(comments);
                            $("div#replyComment_section").load(window.location.href + " div#replyComment_section");
                            $("ul#comment_section").load(window.location.href + " ul#comment_section");
                          }
                        });
                        $(this).val("");
                      }
                    });
                    // Remove reply link and then display reply form
                    // replyLink();
                  });
                </script>
              </div>
            </li> <?php
                }
                echo "</ul>";
              } else echo "<div class='card-text commentFirst mt-2'>Be the first to comment!</div>";
                  ?>
      </div>
    </div>
  </div>

  <!-- Advert -->
  <!-- <div class="row">
    <div class="d-none d-lg-block">
      <div class='leaderboard-advert mx-auto'>
        <img src='img/advert.jpg' class='advertisement' alt='...'>
      </div>
    </div>
    <div class="col-md d-none d-lg-block mt-3 mt-md-0">
      <div class='large-rectangle-advert mx-auto'>
        <img src='img/advert.jpg' class='advertisement' alt='...'>
      </div>
    </div>
  </div> -->

  <!-- News feed for small devices -->
  <div class="row d-block d-lg-none">
    <div class="mt-3">
      <!-- NEWS POST FOR SMALL DEVICES-->
      <div class="news-post">
        <div class="card">
          <div class="card-header text-info"><span class="glyphicon glyphicon-list-alt"></span><b><a href="news.php">News Feed</a></b></div>
          <div class="card-body">
            <div class="row">
              <div class="col-xs-12">
                <ul class="demo1">
                  <?php
                  $queryPost = mysqli_query($dbcon, "SELECT post_id, msg_header, post_pic FROM post WHERE post_id!=$pid AND admin_post_dir IS NOT NULL ORDER BY post_id DESC LIMIT 20");
                  // check for result
                  if (mysqli_num_rows($queryPost) > 0) {
                    while ($fetch_Post = mysqli_fetch_assoc($queryPost)) {
                      $post_id  = $purifier->purify($fetch_Post['post_id']);
                      $post_msg_header  = $purifier->purify($fetch_Post['msg_header']);
                      $post_pic  = $purifier->purify($fetch_Post['post_pic']);
                      $post_pic = "$post_pic";
                      $link = "post.php?pid=$post_id";

                      echo "<li class='news-item'>
                        <a href='$link'>
                          <table cellpadding='4'>
                            <tr>
                              <td><img src='$post_pic' width='60' height='60' class='img-circle' /></td>
                              <td class='text-wrap news_msgHeader text-info'>$post_msg_header</td>
                            </tr>
                          </table>
                        </a>
                      </li>";
                    }
                  } else { ?>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                    <li class="news-item">
                      <table cellpadding="4">
                        <tr>
                          <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                          <td class="text-wrap">No Post/News to show yet... <a href="index.php">Read more...</a></td>
                        </tr>
                      </table>
                    </li>
                  <?php
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="box">
            <div class="content">
              <!-- <div class="social">
                      <a class="circle github" href="#">
                          <i class="fa fa-github fa-fw"></i>
                      </a>
                      <a id="google_login" class="circle google" href="#">
                          <i class="fa fa-google-plus fa-fw"></i>
                      </a>
                      <a id="facebook_login" class="circle facebook" href="#">
                          <i class="fa fa-facebook fa-fw"></i>
                      </a>
                  </div>
                  <div class="division">
                      <div class="line l"></div>
                        <span>or</span>
                      <div class="line r"></div>
                  </div> -->
              <div class="error"></div>
              <div class="form loginBox">
                <form method="" action="" id="ajaxModalLogin_form" accept-charset="UTF-8">
                  <input id="ajaxModalLogin_email" class="form-control" type="text" placeholder="Email/Username" name="email">
                  <input id="ajaxModalLogin_password" class="form-control" type="password" placeholder="Password" name="password">
                  <input id="loginAjaxButton" class="btn btn-default btn-login" type="button" value="Login" onclick="loginAjax()">
                  <div class='checkbox mb-1'>
                    <label class='text-primary' style='cursor:pointer;'>
                      <input id='ajaxModalLogin_rememberme' type='checkbox' class='' name='rememberme' checked style='margin-right:5px; color:green'>
                      Keep me logged in
                    </label>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- <div class="box">
              <div class="content registerBox" style="display:none;">
               <div class="form">
                  <form method="" html="{:multipart=>true}" data-remote="true" action="" accept-charset="UTF-8">
                  <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                  <input id="password" class="form-control" type="password" placeholder="Password" name="password">
                  <input id="password_confirmation" class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                  <input class="btn btn-default btn-register" type="button" value="Create account" name="commit">
                  </form>
                </div>
              </div>
            </div> -->
        </div>
        <div class="modal-footer">
          <div class="forgot login-footer">
            <span>Looking to <a href="login_register.php?signUp=#signUp">create an account</a>?</span>
            <!-- <span>Looking to <a href="javascript: showRegisterForm();">create an account</a>?</span> -->
          </div>
          <!-- <div class="forgot register-footer" style="display:none">
            <span>Already have an account?</span>
            <a href="javascript: showLoginForm();">Login</a>
          </div> -->
        </div>
      </div>
    </div>
  </div>

</div>

<?php require('include/footerJS.php'); ?>
<!-- Font Awesome -->
<script src="js/fontawesome.min.js"></script>
<!-- ScrollMagic Plugin for freezing element to a page -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
<!-- Expand textarea automatically -->
<script src="js/expanding.jquery.js" type="text/javascript"></script>
<script src="js/jquery.autoresize.min.js" type="text/javascript"></script>
<!-- News box plugin for news feed -->
<script src="js/jquery.bootstrap.newsbox.min.js"></script>
<!-- lightbox popup plugin -->
<script src="js/baguetteBox.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script src="js/line-cutter.js" type="text/javascript"></script>
<script src="js/dotdotdot.js" type="text/javascript"></script>
<!-- SLick JS-->
<script type="text/javascript" src="slick/slick.min.js"></script>
<!-- Media elements plugins -->
<!-- <script type="text/javascript" src="vlite/vlite.js"></script>
<script type="text/javascript" src="vlite/providers/youtube.js"></script> -->
<script type="text/javascript" src="js/calamansi.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelement-and-player.min.js"></script>
<!-- Login ajax -->
<script type="text/javascript" src="js/app-login-register.js"></script>
<script type="text/javascript" src="js/apps.js"></script>

<script type="text/javascript">
  // Ellipsis/clamp plugin(line-cutter)
  // $(".spotlight-body_msg1").line(13,'...');
  $(".news_msgHeader").line(3, '...');

  // Remove local storage url for login ajax page_reload
  if (localStorage.getItem("page_url")) {
    localStorage.removeItem("page_reload");
    localStorage.removeItem("page_url");
    window.location.reload(true);
    $("textarea.post_commentxt").focus();
  }

  $(function() {
    // https://www.cssscript.com/simple-gallery-lightbox-with-javascript-and-css3-baguettebox-js/
    baguetteBox.run('.baguetteBoxOne', {
      // captions: true, // display image captions.
      // buttons: 'auto', // arrows navigation
      // fullScreen: false,
      // noScrollbars: false,
      // bodyClass: 'baguetteBox-open',
      // titleTag: false,
      // async: false,
      // preload: 2,
      // animation: 'slideIn', // fadeIn or slideIn
      // verlayBackgroundColor: 'rgba(0,0,0,.8)'
    });
    // baguetteBox.run('.baguetteBoxOne', {
    // afterShow: null,
    // afterHide: null,
    // onChange: null
    // });
  });

  $('.rel_song-carousel').slick({
    dots: false,
    infinite: true,
    speed: 10000,
    slidesToShow: 2,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 0,
    cssEase: 'linear',
    arrows: false,
    centerMode: true,
    centerPadding: '10px',
    responsive: [{
        breakpoint: 1026,
        settings: {
          dots: false,
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
          centerMode: true,
          centerPadding: '10px'
        }
      },
      {
        breakpoint: 800,
        settings: {
          dots: false,
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
          centerMode: true,
          centerPadding: '20px'
        }
      },
      {
        breakpoint: 768,
        settings: {
          dots: false,
          slidesToShow: 2,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
          centerMode: false
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
          centerMode: false
        }
      },
      {
        breakpoint: 576,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
          centerMode: false
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });

  // News Ticker
  $(".demo1").bootstrapNews({
    // number of items per page
    newsPerPage: 6,
    // shows up/down navigation
    navigation: true,
    // enables autoplay
    autoplay: true,
    // or 'down'
    direction: 'up',
    // animation speed
    animationSpeed: 'normal',
    // autoplay interval
    newsTickerInterval: 4000,
    // pause on hover
    pauseOnHover: true,
    // Methods
    onStop: null,
    onPause: null,
    onReset: null,
    onPrev: null,
    onNext: null,
    onToDo: null
  });

  // init controller
  var controller = new ScrollMagic.Controller();

  $(window).on("load resize", function() {
    var news_postFeed = $('.news-post').offset().top;
    var commentOffset = $('.mainPageHeight').height() - news_postFeed;

    // create a scene for controller plugin
    if (this.matchMedia("(min-width: 992px)").matches) {
      new ScrollMagic.Scene({ // Desktop
          offset: 680, // start this scene after scrolling for 50px
          duration: commentOffset // the scene should last for a scroll distance of 1500px
        }).setPin('.news-post') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 991px)").matches) {
      // new ScrollMagic.Scene({ // Desktop
      // 	duration: 0, // the scene should last for a scroll distance of 100px
      // 	offset: 520 // start this scene after scrolling for 50px
      // }).setPin('.news-post') // pins the element for the the scene's duration
      // 	.addTo(controller); // assign the scene to the controller
      scene.removePin(true);
    }
  });

  // Element js plugin
  $('video').mediaelementplayer({
    // more configuration here
  });

  new Calamansi(document.querySelector('#post_audio'), {
    skin: 'calamansi-audio-skins/basic',
    loadTrackInfoOnPlay: false,
    loop: true,
    playlists: {
      'My List': [{
        source: <?php echo "'$post_audio'"; ?>,
      }, ],
    },
    defaultAlbumCover: <?php echo "'$post_pic'"; ?>
  });
</script>
<!-- Scrollbar Js -->
<?php if (isset($user_id)) {
  // echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
} ?>
<script src="https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
  (function($) {
    $(window).on("load resize", function() {
      //====== Scrollbar plugin ===========//
      // Page scrollbar
      // $("html").mCustomScrollbar({
      //   theme:"3d-thick-dark",
      //   mouseWheel:{ preventDefault:true }
      // });

      // Notifications scrollbar
      $("#comment-sect").mCustomScrollbar({
        theme: "minimal-dark",
        scrollInertia: 400, //scroll speed
        mouseWheel: {
          preventDefault: true
        }
      });

      $("#comment-sect, html").on("mouseup pointerup", function(e) {
        $("#comment-sect .mCSB_scrollTools").removeClass("mCSB_scrollTools_onDrag");
      }).on("click", function(e) {
        if ($(e.target).parents(".mCSB_scrollTools").length || $("#comment-sect .mCSB_scrollTools").hasClass("mCSB_scrollTools_onDrag")) {
          e.stopPropagation();
        }
      });
    });
  })(jQuery);
</script>
</body>

</html>