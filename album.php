<?php
error_reporting(0);
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

if (isset($_GET['mid'])) $mid = $purifier->purify($_GET['mid']);

if (isset($_GET['aid'])) $aid = $purifier->purify($_GET['aid']);

if (!isset($mid) && !isset($aid)) {
  redirect_user();
  exit();
}

$album_details = mysqli_query($dbcon, "SELECT ab.album_name, ab.album_pic,
DATE_FORMAT(ab.release_date, '%M %e %Y') AS release_date, at.artist_name FROM album ab INNER JOIN
artist at ON ab.artist_id=at.artist_id WHERE ab.album_id=$mid AND ab.artist_id=$aid");
// Check the result:
if (mysqli_num_rows($album_details) == 1) {
  // fetch the records
  $fetch_album_details = mysqli_fetch_assoc($album_details);
  // Audio Details
  $album_name = $purifier->purify($fetch_album_details['album_name']);
  $album_pic = $purifier->purify($fetch_album_details['album_pic']);
  $release_date = $purifier->purify($fetch_album_details['release_date']);
  $artist_name = $purifier->purify($fetch_album_details['artist_name']);
  $album_pic = (empty($album_pic)) ? $adminPicture : "$album_pic";
}

// Set character encoding for emoji
// $dbcon->set_charset("utf8mb4");
if (isset($artist_name)) {
  $page_title = "$album_name - $artist_name";
}
require_once('include/header.php');
?>
<div class="cover_album_pic" style='background-image: url(<?php echo "$album_pic"; ?>);'></div>
<div class="" style="overflow:hidden;">
  <div class="container-lg mt-3 album-container">
    <div class="row">
      <div class="card w-100 h-100 bg-transparent" id="track_list">
        <div class="card-body text-white">
          <h1 class="h4 card-subtitle"><?php echo "$artist_name"; ?></h1>
          <h1 class="h2 card-title"><?php echo "$album_name"; ?></h1>
          <p class="text-light">Release Date: <?php echo "$release_date"; ?></p>
          <h1 class="h6"><u>Track List</u></h1>
          <?php
          $audio_details = mysqli_query($dbcon, "SELECT audio_id, audio_name, audio_file, audio_number, tagged_artist
          FROM audio WHERE album_id=$mid AND artist_id=$aid ORDER BY audio_number");
          // Check the result:
          if (mysqli_num_rows($audio_details) > 0) {
            // echo "<div class='card'>";
            // fetch the records
            while ($fetch_audio_details = mysqli_fetch_assoc($audio_details)) {
              // Audio Details
              $audio_id = $purifier->purify($fetch_audio_details['audio_id']);
              $audio_name = $purifier->purify($fetch_audio_details['audio_name']);
              $audio_file = $purifier->purify($fetch_audio_details['audio_file']);
              $audio_number = $purifier->purify($fetch_audio_details['audio_number']);
              $tagged_artist = $purifier->purify($fetch_audio_details['tagged_artist']);
              $audio_file = "$audio_file";
              $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
              $download_file = urlencode($audio_file);
              $link = "music.php?mid=$audio_id&aid=$aid";

              echo "<div class=''><a href='$link' class='text-white'>$audio_number. $audio_name $tagged_artist</a></div>";
            }
            // echo "</div>";
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- FOOTER -->
<!-- <div class="row" class="text-center justify-content-center"> -->
<footer class="row text-center justify-content-center mx-auto fixed-bottom">
  <!-- <h6 class="text-center justify-content-center">Demo view: Responsive Navbar with offcanvas view on mobile. <span class="text-danger">Change browser size to see in action</span> </h6> -->
  <!-- <div class="d-none" style="width: 100%;">
    <div id="calamansi-player-1">
			<div class="spinner-border text-primary" role="status">
				<span class="sr-only">Loading...</span>
			</div>
    </div>
	</div> -->
  <div class="" id="cplayer-app"></div>
</footer>

<?php require('include/footerJS.php'); ?>
<!-- Font Awesome -->
<script src="js/fontawesome.min.js"></script>
<!-- cplayer audio plugin JS-->
<script src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>
<script type="text/javascript" src="js/apps.js"></script>
<script type="text/javascript">
  // <!-- 加载 cplayer 脚本 -->
  let player = new cplayer({
    element: document.getElementById('cplayer-app'),
    width: '99VW',
    // dark: true,
    // big : true, // for video type
    // playlist: [
    //   {
    // 		src : 'music/Mama.mp4',
    // 	  poster : 'music/Burna_Boy.jpg',
    // 	  name : 'Burna_Boy',
    // 	  type : 'video'
    //   },
    // 	{
    // 		src : 'music/Mama1.mp4',
    // 	  poster : 'music/Ckay.jpg',
    // 	  name : 'Ckay',
    // 	  type : 'video'
    //   },
    // 	{
    // 		src : 'music/Mama2.mp4',
    // 	  poster : 'music/Wizkid.jpg',
    // 	  name : 'Wizkid',
    // 	  type : 'video'
    //   }
    // ]
    playlist: [
      <?php
      $queryPlayList = mysqli_query($dbcon, "SELECT ab.album_name, ab.album_pic, au.audio_name, au.audio_file,
    au.audio_number, au.tagged_artist, at.artist_name FROM album ab INNER JOIN audio au ON ab.album_id=au.album_id
    INNER JOIN artist at ON ab.artist_id=at.artist_id WHERE ab.album_id=$mid AND ab.artist_id=$aid ORDER BY au.audio_number");
      // Check the result:
      if (mysqli_num_rows($queryPlayList) > 0) {
        // fetch the records
        while ($fetch_playlist = mysqli_fetch_assoc($queryPlayList)) {
          // Audio Details
          $album_name = $purifier->purify($fetch_playlist['album_name']);
          $album_pic = $purifier->purify($fetch_playlist['album_pic']);
          $audio_name = $purifier->purify($fetch_playlist['audio_name']);
          $audio_file = $purifier->purify($fetch_playlist['audio_file']);
          $tagged_artist = $purifier->purify($fetch_playlist['tagged_artist']);
          // $lyrics = $purifier->purify($fetch_playlist['lyrics']);
          $artist_name = $purifier->purify($fetch_playlist['artist_name']);
          $audio_file = "$audio_file";
          $album_pic = "$album_pic";
          $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
          $lyrics = "Lyrics for this song is not available at the moment...";

          echo "{
          src: '$audio_file',
          poster: '$album_pic',
          name: '$artist_name $tagged_artist',
          artist: '$audio_name',
          lyric: '$lyrics',
          sublyric: '$lyrics',
          album: '$album_name'
        },";
        }
      }
      ?>
      // {
      //   src: 'music/1.mp3',
      //   poster: 'music/Burna_Boy.jpg',
      //   name: '1.mp3',
      //   artist: '歌手名称...',
      //   lyric: '歌词...',
      //   sublyric: '副歌词，一般为翻译...',
      //   album: '专辑，唱片...'
      // },
      // {
      // 	src: 'music/2.mp3',
      //   poster: 'music/Ckay.jpg',
      //   name: '2.mp3',
      //   artist: '歌手名称...',
      //   lyric: '歌词...',
      //   sublyric: '副歌词，一般为翻译...',
      //   album: '专辑，唱片...'
      // },
    ]
  });
</script>
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
      $("#track_list").mCustomScrollbar({
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