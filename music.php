<?php
// Turn off all error reporting
error_reporting(0);
// This is the index page for this site
// Start output buffering:
// Audio Plugin Site
// https://github.com/MoePlayer/cPlayer
// https://github.com/voerro/calamansi-js

// Video Plugin site
// https://www.cssscript.com/custom-html5-video-players-vlite-js/
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

if (isset($_GET['mid'])) $mid = $purifier->purify($_GET['mid']);

if (isset($_GET['aid'])) $aid = $purifier->purify($_GET['aid']);

if (!isset($mid) && !isset($aid)) {
  redirect_user();
  exit();
}

$artist_details = mysqli_query($dbcon, "SELECT au.audio_name, au.audio_file, au.audio_pic, au.tagged_artist, au.lyrics,
at.artist_name, ab.album_name FROM audio au INNER JOIN artist at ON au.artist_id=at.artist_id LEFT JOIN album ab ON
au.album_id=ab.album_id WHERE au.audio_id=$mid AND au.artist_id=$aid");
// Check the result:
if (mysqli_num_rows($artist_details) == 1) {
  // fetch the records
  $fetch_artist_details = mysqli_fetch_assoc($artist_details);
  // Audio Details
  $audio_name = $purifier->purify($fetch_artist_details['audio_name']);
  $audio_file = $purifier->purify($fetch_artist_details['audio_file']);
  $audio_pic = $purifier->purify($fetch_artist_details['audio_pic']);
  $tagged_artist = $purifier->purify($fetch_artist_details['tagged_artist']);
  $lyrics = $purifier->purify($fetch_artist_details['lyrics']);
  $artist_name = $purifier->purify($fetch_artist_details['artist_name']);
  $album_name = $purifier->purify($fetch_artist_details['album_name']);
  $audio_file = "$audio_file";
  $audio_pic = "$audio_pic";
  $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
  $album_name = (empty($album_name)) ? "" : $album_name;
}

// Set character encoding for emoji
$dbcon->set_charset("utf8mb4");
if (isset($artist_name)) {
  $page_title = "$artist_name $tagged_artist - $audio_name";
}
require_once('include/header.php');
?>
<div class="container-xl">
  <div class="row">
    <div class="col-md-8">
      <div class="card border-0 mt-3" id="artist-img-con">
        <?php echo "<img src='$audio_pic' alt='$artist_name' class='card-img-top artist-img'>"; ?>
      </div>
    </div>
    <div class="col-md-4 mb-0">
      <div class="card mt-3" id="audio_section">
        <h6 class="text-center card-subtitle mb-3 text-muted pt-3"><?php echo "$artist_name $tagged_artist - $audio_name"; ?></h6>
        <div class="card-body">
          <div class="audio-player" style="width: 100%;">
            <div id="calamansi-1">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>
          </div>
          <div class="music-download">
            <?php
            $download_file = urlencode($audio_file);
            echo "<p class='card-text mb-0 mt-3 font-italic'><small><a href='download_files.php?file=$download_file' class='text-primary'>
            <i class='fas fa-download'></i> Download $audio_name</a></small></p>";
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Lyrics Row -->
  <div class="row mt-5">
    <?php
    if (!empty($lyrics)) {
      echo "<div class='col-lg-8'>
        <div class='card bg-transparent'>
          <div class='card-body' id='lyrics-con'>
            <h5 class='card-title text-muted font-weight-bold pl-3'><u>Song lyrics</u></h5>
            <p class='lyrics font-italic text-monospace'>$lyrics</p>
          </div>
        </div>
      </div>";
    }
    ?>
    <div <?php if (!empty($lyrics)) echo "class='col-lg-4 row'";
          else echo "class='col-sm-12 row'"; ?>>
      <!-- ADVERTISEMENT -->
      <div <?php if (!empty($lyrics)) echo "class='mt-5 mt-md-5 px-0 px-md-2 mt-lg-0 col-md-6 col-lg-12'";
            else echo "class='mt-3 px-0 px-md-2 mt-lg-0 col-md-6'"; ?>>
        <div class="text-white advertisement music_advert mx-auto">
          <img src="img/advert.jpg" class="card-img" alt="...">
        </div>
      </div>
      <div <?php if (!empty($lyrics)) echo "class='mt-3 mt-md-5 px-0 px-md-2 mt-lg-3 col-md-6 col-lg-12'";
            else echo "class='mt-3 px-0 px-md-2 mt-lg-0 col-md-6'"; ?>>
        <div class="text-white advertisement music_advert mx-auto">
          <img src="img/advert.jpg" class="card-img" alt="...">
        </div>
      </div>
    </div>
  </div>

  <?php // Video Section
  $queryAudioVideo = mysqli_query($dbcon, "SELECT * FROM video WHERE audio_id=$mid LIMIT 1"); // SELECT * FROM video WHERE audio_id=$mid LIMIT 1
  if (mysqli_num_rows($queryAudioVideo) == 1) {
    $fetch_vid = mysqli_fetch_assoc($queryAudioVideo);
    $vid_name = $purifier->purify($fetch_vid['video_name']);
    $vid_file = $purifier->purify($fetch_vid['video_file']);
    $youtube_url = $purifier->purify($fetch_vid['youtube_url']);
    $vid_pic = $purifier->purify($fetch_vid['video_pic']);
    $tagged_artist = $purifier->purify($fetch_vid['tagged_artist']);
    $vid_file = (empty($vid_pic)) ? $adminPicture : "$vid_pic";
    $vid_pic = (empty($vid_pic)) ? $adminPicture : "$vid_pic";

    if (!empty($youtube_url)) {
      echo "<div class='row mt-5' id=''>
        <div class='col-lg-8'>
          <div class=''>
            <video style='max-width: 100%;' id='player1' preload='none'>
              <source type='video/youtube' src='$youtube_url'/>
            </video>
          </div>
        </div>
        <div class='d-none d-lg-block col-lg-4'>
          <div class='text-white advertisement large-rectangle-advert mx-auto'>
            <img src='img/advert.jpg' class='card-img' alt='...'>
          </div>
        </div>
        </div>";
      // echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/n1FIQVk1JEE" title="YouTube video player" frameborder="0"
      // allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    } else {
      echo "<div class='row mt-5' id=''>
        <div class='col-lg-8'>
          <div class=''>
            <video controls class='player' id='player2' height='360'
              width='100%' loop poster='$vid_pic'
              preload='none' src='$vid_file'
              style='max-width: 100%' tabindex='0' title='$vid_name'>
            </video>
          </div>
        </div>
        <div class='d-none d-lg-block col-lg-4'>
          <div class='text-white advertisement large-rectangle-advert mx-auto'>
            <img src='img/advert.jpg' class='card-img' alt='...'>
          </div>
        </div>
        </div>";
    }
  }
  ?>

  <!-- Related Songs -->
  <div class="row mt-5">
    <div class="col-lg-8">
      <?php
      $query_RelatedSongs = mysqli_query($dbcon, "SELECT au.audio_id, au.audio_name, au.artist_id, au.audio_pic, au.tagged_artist, at.artist_name
      FROM audio au INNER JOIN artist at ON au.artist_id=at.artist_id WHERE MATCH(at.artist_name) AGAINST('$artist_name') AND
      MATCH(au.tagged_artist) AGAINST('$artist_name') AND au.audio_id!=$mid OR MATCH(at.artist_name) AGAINST('$artist_name')
      AND au.audio_id!=$mid OR MATCH(au.tagged_artist) AGAINST('$artist_name') AND au.audio_id!=$mid
      ORDER BY au.audio_id DESC LIMIT 20");
      // Check the result:
      $query_RelatedSongsnumb = mysqli_num_rows($query_RelatedSongs);
      if ($query_RelatedSongsnumb >= 3) {
        echo "<div class='jumbotron-fluid py-3 float-app border'>
        <h6 class='text-muted pl-3 font-weight-bold text-muted'>Other song(s) by $artist_name</h6>
        <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3' data-aos='zoom-in' data-aos-duration='1000'>";
        // fetch the records
        while ($fetch_RelatedSongs = mysqli_fetch_assoc($query_RelatedSongs)) {
          // Audio Details
          $audio_id = $purifier->purify($fetch_RelatedSongs['audio_id']);
          $audio_name = $purifier->purify($fetch_RelatedSongs['audio_name']);
          $artist_id = $purifier->purify($fetch_RelatedSongs['artist_id']);
          $audio_pic = $purifier->purify($fetch_RelatedSongs['audio_pic']);
          $tagged_artist = $purifier->purify($fetch_RelatedSongs['tagged_artist']);
          $artist_name = $purifier->purify($fetch_RelatedSongs['artist_name']);
          $audio_pic = "$audio_pic";
          $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
          $artist_name = "$artist_name $tagged_artist";
          $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

          // echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='' class='round-img'/></a></div>";
          echo "<div class='col position-relative'><a href='$hit_link'><img src='$audio_pic' alt='$artist_name' class='rounded rel_song-carouselImg'/>
          <p class='text-wrap text-center text-white relSong_img_overlay'><small>$artist_name - $audio_name</small></p></a></div>";
        }
        echo "<div class='col'><div class='text-white advertisement large-rectangle-advert mx-auto'>
          <img src='img/advert.jpg' class='card-img' alt='...'>
        </div></div></div></div>";
      } elseif ($query_RelatedSongsnumb >= 2) {
        echo "<div class='jumbotron-fluid py-3 float-app border'>
        <h6 class='text-muted pl-3 font-weight-bold text-muted'>Other song(s) by $artist_name</h6>
        <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3' data-aos='zoom-in' data-aos-duration='1000'>";
        // fetch the records
        while ($fetch_RelatedSongs = mysqli_fetch_assoc($query_RelatedSongs)) {
          // Audio Details
          $audio_id = $purifier->purify($fetch_RelatedSongs['audio_id']);
          $audio_name = $purifier->purify($fetch_RelatedSongs['audio_name']);
          $artist_id = $purifier->purify($fetch_RelatedSongs['artist_id']);
          $audio_pic = $purifier->purify($fetch_RelatedSongs['audio_pic']);
          $tagged_artist = $purifier->purify($fetch_RelatedSongs['tagged_artist']);
          $artist_name = $purifier->purify($fetch_RelatedSongs['artist_name']);
          $audio_pic = "$audio_pic";
          $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
          $artist_name = "$artist_name $tagged_artist";
          $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

          // echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='' class='round-img'/></a></div>";
          echo "<div class='col-sm position-relative'><a href='$hit_link'><img src='$audio_pic' alt='$artist_name' class='rounded rel_song-carouselImg'/>
          <p class='text-wrap text-center text-white relSong_img_overlay'><small>$artist_name - $audio_name</small></p></a></div>";
        }
        echo "<div class='col'><div class='text-white advertisement large-rectangle-advert mx-auto'>
          <img src='img/advert.jpg' class='card-img' alt='...'>
        </div></div></div></div>";
      } elseif ($query_RelatedSongsnumb == 1) {
        echo "<div class='jumbotron-fluid py-3 float-app border'>
        <h6 class='text-muted pl-3 font-weight-bold text-muted'>Other song(s) by $artist_name</h6>
        <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3' data-aos='zoom-in' data-aos-duration='1000'>";
        // fetch the records
        while ($fetch_RelatedSongs = mysqli_fetch_assoc($query_RelatedSongs)) {
          // Audio Details
          $audio_id = $purifier->purify($fetch_RelatedSongs['audio_id']);
          $audio_name = $purifier->purify($fetch_RelatedSongs['audio_name']);
          $artist_id = $purifier->purify($fetch_RelatedSongs['artist_id']);
          $audio_pic = $purifier->purify($fetch_RelatedSongs['audio_pic']);
          $tagged_artist = $purifier->purify($fetch_RelatedSongs['tagged_artist']);
          $artist_name = $purifier->purify($fetch_RelatedSongs['artist_name']);
          $audio_pic = "$audio_pic";
          $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
          $artist_name = "$artist_name $tagged_artist";
          $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

          // echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='' class='round-img'/></a></div>";
          echo "<div class='col position-relative'><a href='$hit_link'><img src='$audio_pic' alt='$artist_name' class='rounded rel_song-carouselImg'/>
          <p class='text-wrap text-center text-white relSong_img_overlay'><small>$artist_name - $audio_name</small></p></a></div>";
        }
        echo "<div class='col'><div class='text-white advertisement large-rectangle-advert mx-auto'>
          <img src='img/advert.jpg' class='card-img' alt='...'>
        </div></div></div></div>";
      } else {
        echo '<div class="row mb-5">
          <div class="col-md">
            <div class="text-white advertisement music_advert mx-auto">
              <img src="img/advert.jpg" class="card-img" alt="...">
            </div>
          </div>
          <div class="col-md">
            <div class="text-white advertisement music_advert mx-auto">
              <img src="img/advert.jpg" class="card-img" alt="...">
            </div>
          </div>
        </div>';
      }
      ?>
    </div>
    <div class="col-lg-4 pt-5 pt-lg-0">
      <!-- ADVERTISEMENT -->
      <div class='text-white advertisement music_advert mx-auto'>
        <img src='img/advert.jpg' class='card-img' alt='...'>
      </div>
    </div>
  </div>

  <!-- Comment Section -->
  <div class="row mt-3 px-lg-2">
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
            <textarea class='expanding audio_commentxt form-control rounded-pill' spellcheck='true' autocomplete='on'
            placeholder='Write a comment...' rows='1' data-artist='$aid' data-audio='$mid'></textarea>
          </div>";
        }
        ?>
        <script type="text/javascript">
          document.addEventListener('DOMContentLoaded', function() {
            $("textarea.audio_commentxt").keypress(function(e) {
              if (!$.trim($(this).val()).length < 1 && e.which == 13 && !e.shiftKey) {
                e.preventDefault();
                //submit form via ajax, this is not JS but server side scripting so not showing here
                var val = $(this).val();
                var data_artist_id = $(this).attr("data-artist");
                var data_audio_id = $(this).attr("data-audio");
                //alert(val + " and app_id is " + app_comment_id);
                // AJAX Request
                $.ajax({
                  url: 'au_vid_comment.php',
                  type: 'post',
                  data: {
                    commentxt: val,
                    artist_id: data_artist_id,
                    audio_id: data_audio_id
                  },
                  success: function(comments) {
                    // alert(comments);
                    // Update comments
                    $("ul#comment_section_audio").prepend(comments);
                    if (!$.trim($('ul#comment_section_audio').html()).length) {
                      location.reload()
                    }
                    $("ul#comment_section_audio").load(window.location.href + " ul#comment_section_audio");
                  }
                });
                $(this).val("");
              }
            });
          });
        </script>
        <?php ////////////////////////////  Query the audio_video_comment table ////////////////////////////
        $app_comment = mysqli_query($dbcon, "SELECT avc.*, ur.first_name, ur.middle_name, ur.last_name, ur.gender, ui.profile_pic
        FROM audio_video_comment avc LEFT JOIN users ur USING (user_id) LEFT JOIN user_info ui USING (user_id) WHERE
        avc.app_id=$app_id AND avc.audio_id=$mid AND avc.artist_id=$aid ORDER BY comment_id DESC LIMIT 20");
        // Check the result:
        $app_com_num = mysqli_num_rows($app_comment);
        if ($app_com_num > 0) {
          echo "<ul class='list-unstyled ul-comment' id='comment_section_audio'>";
          while ($fetch_comment = mysqli_fetch_assoc($app_comment)) {
            // fetch the records
            // $com_user_id = $purifier->purify($fetch_comment['user_id']);
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
              <div class='media-body'>
                <h6 class='mt-0 mb-1'><?php echo $com_full_name; ?> <small class='text-muted'><?php echo $time_since; ?></small></h6>
                <span class="comment"><?php echo $comment; ?></span>
              </div>
            </li> <?php
                }
                echo "</ul>";
              } else echo "<div class='card-text commentFirst mt-2'>Be the first to comment!</div>";
                  ?>
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
<!-- Expand textarea automatically -->
<script src="js/expanding.jquery.js" type="text/javascript"></script>
<!-- Cut text -->
<script src="js/dotdotdot.js" type="text/javascript"></script>
<!-- SLick JS-->
<script type="text/javascript" src="slick/slick.min.js"></script>
<!-- Calamansi audio plugin JS-->
<script type="text/javascript" src="js/calamansi.min.js"></script>
<!-- Element.js AND Vlite Plugin -->
<!-- <script type="text/javascript" src="vlite/vlite.js"></script>
<script type="text/javascript" src="vlite/providers/youtube.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.17/mediaelement-and-player.min.js"></script>
<!-- <script src="media-element/build/renderers/youtube.min.js"></script> -->
<!-- Login ajax -->
<script type="text/javascript" src="js/app-login-register.js"></script>
<!-- AOS JS-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- <video autoplay controls class="player" id="player1" height="360"
	width="100%" loop muted poster="/path/to/poster.jpg"
	preload="none" src="/path/to/media.mp4"
	style="max-width: 100%" tabindex="0" title="MediaElement">
</video> -->

<script type="text/javascript">
  AOS.init();

  // Remove local storage url for login ajax page_reload
  if (localStorage.getItem("page_url")) {
    localStorage.removeItem("page_reload");
    localStorage.removeItem("page_url");
    window.location.reload(true);
    $(".audio_commentxt").focus();
  }

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

  // Center artist image
  const $img = $("#artist-img-con img");
  const $imgCon = $("#artist-img-con");
  var $img_height = $img.prop("naturalHeight");
  var $img_width = $img.prop("naturalWidth");
  if ($img_height > $img_width) {
    $img.css({
      'max-height': '450px',
      'max-width': '70%',
      'margin': 'auto',
      'display': 'block'
    });
    $imgCon.css('background-color', '#e1f3f8');
  } else if ($img_height == $img_width) {
    $img.css({
      'max-height': '450px',
      'max-width': '80%',
      'margin': 'auto',
      'display': 'block'
    });
    $imgCon.css('background-color', '#e1f3f8');
  } else {
    $img.css({
      'max-height': '450px',
      'max-width': 'auto',
      'margin': 'auto',
      'display': 'block'
    });
  }

  // mejs.Renderers.order = ['native_dash', 'youtube_iframe'];
  // Element js plugin
  $('video').mediaelementplayer({
    // more configuration here
    // renderers: ['native_dash', 'youtube_iframe'],
  });

  new Calamansi(document.querySelector('#calamansi-1'), {
    skin: 'calamansi-audio-skins/calamansi-compact',
    loadTrackInfoOnPlay: false,
    loop: true,
    playlists: {
      'My List': [{
        source: <?php echo "'$audio_file'"; ?>,
      }, ],
    },
    defaultAlbumCover: <?php echo "'$audio_pic'"; ?>
  });

  // Vlitejs.registerProvider('youtube', VlitejsYoutube);
  // new Vlitejs('#player',{
  //     provider: 'youtube'
  // });

  // document.addEventListener( "DOMContentLoaded", () => {
  //    let wrapper = document.querySelector( "#spotlight-writeUp" );
  //    let options = {
  //       // Options go here
  // 			// after: 'a.more',
  // 			// 'ellipsis':' [Show more...] '
  //    };
  //    new Dotdotdot( wrapper, options );
  // });


  // Login FORM
  $(document).ready(function() {
    // openLoginModal();
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

      // $(".notiDrop, .msgDrop, html").on("mouseup pointerup",function(e){
      // 	$(".dropdown-menu .mCSB_scrollTools").removeClass("mCSB_scrollTools_onDrag");
      // }).on("click",function(e){
      // 	if($(e.target).parents(".mCSB_scrollTools").length || $(".dropdown-menu .mCSB_scrollTools").hasClass("mCSB_scrollTools_onDrag")){
      // 		e.stopPropagation();
      // 	}
      // });
    });
  })(jQuery);
</script>
</body>

</html>