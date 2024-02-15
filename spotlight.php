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

require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

if (isset($_GET['aid'])) $aid = $purifier->purify($_GET['aid']);

if (!isset($aid)) {
  redirect_user();
  exit();
}

$queryArtistSpotlight = mysqli_query($dbcon, "SELECT * FROM artist_spotlight");
// Check the result:
if (mysqli_num_rows($queryArtistSpotlight) == 1) {
  // fetch the records
  $fetch_ArtistDetails = mysqli_fetch_assoc($queryArtistSpotlight);
  $artistSpotlight_id = $purifier->purify($fetch_ArtistDetails['artist_id']);
  $artist_name = $purifier->purify($fetch_ArtistDetails['artist_name']);
  $real_name = $purifier->purify($fetch_ArtistDetails['real_name']);
  $born = $purifier->purify($fetch_ArtistDetails['born']);
  $nationality = $purifier->purify($fetch_ArtistDetails['nationality']);
  $artist_pic1 = $purifier->purify($fetch_ArtistDetails['artist_pic_1']);
  $artist_pic2 = $purifier->purify($fetch_ArtistDetails['artist_pic_2']);
  $artist_pic3 = $purifier->purify($fetch_ArtistDetails['artist_pic_3']);
  $description1 = $purifier->purify($fetch_ArtistDetails['description_1']);
  $description2 = $purifier->purify($fetch_ArtistDetails['description_2']);
  $description3 = $purifier->purify($fetch_ArtistDetails['description_3']);
  $date_time = $purifier->purify($fetch_ArtistDetails['date_time']);
  $artist_pic_1 = "$artist_pic1";
  $artist_pic_2 = "$artist_pic2";
  $artist_pic_3 = "$artist_pic3";
  $description_1 = "$description1";
  $description_2 = "$description2";
  $description_3 = "$description3";
  $real_name = (empty($real_name)) ? "" : "$real_name";
  $born = (empty($born)) ? "" : "$born";
  $nationality = (empty($nationality)) ? "" : "$nationality";
}

if (isset($artist_name)) {
  $page_title = "$artist_name ($real_name)";
}
require_once('include/header.php');
?>

<div class="container-lg">
  <div class="row">
    <div class="col-12">
      <div class='mt-3' id='spotlight-carousel_2'>
        <?php echo "<div><img src='$artist_pic_1'alt='$artist_name' class='round-img'></div>"; ?>
        <?php echo "<div><img src='$artist_pic_2' alt='$artist_name' class='round-img'></div>"; ?>
        <?php echo "<div><img src='$artist_pic_3' alt='$artist_name' class='round-img'></div>"; ?>
      </div>
    </div>
  </div>

  <!-- Artist_details -->
  <div class="row">
    <div class="artistDetails">
      <div class="card" id="artistDetails_section">
        <div class="card-body bg-transparent">
          <?php echo "<h5 class='card-title text-info'>Name: <span class='text-muted'>$real_name</span> <span class='text-info font-weight-bolder'>($artist_name)</span></h5>
          <h5 class='card-title text-info'>Born: <span class='text-muted'>$born<span></h5>
          <h5 class='card-title text-info'>Nationality: <span class='text-muted'>$nationality</span></h5>"; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Descriptions -->
  <div class="row desc_col">
    <!-- <div class="card-body"> -->
    <div class="col-lg-9">
      <div class="descs">
        <?php
        if (!empty($description1)) {
          echo "<div class=''>$description_1</div>";
        }
        if (!empty($description2)) {
          echo "<div class=''><br>$description_2</div>";
        }
        if (!empty($description3)) {
          echo "<div class=''><br>$description_3</div>";
        }
        ?>
      </div>
    </div>
    <div class="col-lg-3" id="popular-songs">
      <div class="position-relative">
        <div class="card popularSongs_inner" id="stickyScrollMagic">
          <div class="d-none d-lg-block">
            <div class="" id=''>
              <?php
              $queryArtistSongs = mysqli_query($dbcon, "SELECT audio_id, audio_name, artist_id, audio_pic, tagged_artist, artist_name FROM audio
              INNER JOIN artist USING (artist_id) WHERE artist_id=$aid");
              // Check the result:
              $queryArtistSongsnumb = mysqli_num_rows($queryArtistSongs);
              if ($queryArtistSongsnumb >= 3) {
                echo "<h6 class='card-header text-info text-center'>Songs by $artist_name</h6>
                <div class='card-block'>
                  <div class='' id='popular-songsCarousel'>";
                // fetch the records
                while ($fetch_artistSongs = mysqli_fetch_assoc($queryArtistSongs)) {
                  // Audio Details
                  $audio_id = $purifier->purify($fetch_artistSongs['audio_id']);
                  $audio_name = $purifier->purify($fetch_artistSongs['audio_name']);
                  $artist_id = $purifier->purify($fetch_artistSongs['artist_id']);
                  $audio_pic = $purifier->purify($fetch_artistSongs['audio_pic']);
                  $popTagged_artist = $purifier->purify($fetch_artistSongs['tagged_artist']);
                  $popArtist_name = $purifier->purify($fetch_artistSongs['artist_name']);
                  $audio_pic = "$audio_pic";
                  $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                  $popArtist_name = "$popArtist_name $popTagged_artist";
                  $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                  echo "<div class='popularSong_items position-relative'><a class='' href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='round-img'/>
												<p class='text-wrap text-center text-white popSong_img_overlay'><small>$popArtist_name - $audio_name</small></p></a></div>";
                }
                echo "</div></div><div class='card-footer'></div>";
              } elseif ($queryArtistSongsnumb >= 2) {
                echo "<h6 class='card-header text-info text-center'>Songs by $artist_name</h6>
                <div class='card-block'>";
                while ($fetch_artistSongs = mysqli_fetch_assoc($queryArtistSongs)) {
                  // Audio Details
                  $audio_id = $purifier->purify($fetch_artistSongs['audio_id']);
                  $artist_id = $purifier->purify($fetch_artistSongs['artist_id']);
                  $audio_pic = $purifier->purify($fetch_artistSongs['audio_pic']);
                  $popTagged_artist = $purifier->purify($fetch_artistSongs['tagged_artist']);
                  $popArtist_name = $purifier->purify($fetch_artistSongs['artist_name']);
                  $audio_pic = "$audio_pic";
                  $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                  $popArtist_name = "$popArtist_name $popTagged_artist";
                  $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                  echo "<div class=''><a class='' href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='rounded p-2' style='height:200px; width:100%;'/></a></div>";
                }
                echo "</div><div class='card-footer'></div>";
              } else {
                echo "<h6 class='card-header text-info text-center'>Song by $artist_name</h6>
                <div class='card-block'>";
                while ($fetch_artistSongs = mysqli_fetch_assoc($queryArtistSongs)) {
                  // Audio Details
                  $audio_id = $purifier->purify($fetch_artistSongs['audio_id']);
                  $artist_id = $purifier->purify($fetch_artistSongs['artist_id']);
                  $audio_pic = $purifier->purify($fetch_artistSongs['audio_pic']);
                  $popTagged_artist = $purifier->purify($fetch_artistSongs['tagged_artist']);
                  $popArtist_name = $purifier->purify($fetch_artistSongs['artist_name']);
                  $audio_pic = "$audio_pic";
                  $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                  $popArtist_name = "$popArtist_name $popTagged_artist";
                  $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                  echo "<div class=''><a class='' href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='rounded p-2' style='height:200px; width:100%;'/></a></div>";
                }
                echo "</div><div class='card-footer'></div>";
              }
              ?>
            </div>
          </div>
          <div class="d-lg-none mb-5">
            <!-- <div class=""> -->
            <?php
            $querySongs = mysqli_query($dbcon, "SELECT audio_id, audio_name, artist_id, audio_pic, tagged_artist, artist_name FROM audio
              INNER JOIN artist USING (artist_id) WHERE artist_id=$aid");
            // Check the result:
            $querySongsnumb = mysqli_num_rows($querySongs);
            if ($querySongsnumb >= 3) {
              echo "<div class='jumbotron-fluid py-3 float-app'>
                <h6 class='text-muted pl-3 font-weight-bold text-muted'>Songs by $artist_name</h6>
                <div class='rel_song-carousel mx-auto justify-content-center col-sm-12 py-3'>";
              // fetch the records
              while ($fetch_artistSongs = mysqli_fetch_assoc($querySongs)) {
                // Audio Details
                $audio_id = $purifier->purify($fetch_artistSongs['audio_id']);
                $audio_name = $purifier->purify($fetch_artistSongs['audio_name']);
                $artist_id = $purifier->purify($fetch_artistSongs['artist_id']);
                $audio_pic = $purifier->purify($fetch_artistSongs['audio_pic']);
                $popTagged_artist = $purifier->purify($fetch_artistSongs['tagged_artist']);
                $popArtist_name = $purifier->purify($fetch_artistSongs['artist_name']);
                $audio_pic = "$audio_pic";
                $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                $popArtist_name = "$popArtist_name $popTagged_artist";
                $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                // echo "<div><a class='' href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='rounded popular-songsCarousel'/></a></div>";
                echo "<div class='col position-relative'><a href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='rounded rel_song-carouselImg'/>
                      <p class='text-wrap text-center text-white relSong_img_overlay'><small>$popArtist_name - $audio_name</small></p></a></div>";
              }
              echo "</div></div>";
            } elseif ($querySongsnumb >= 2) {
              echo "<h6 class='card-header text-info text-center'>Songs by $artist_name</h6>
                <div class='card-block row'>";
              while ($fetch_artistSongs = mysqli_fetch_assoc($querySongs)) {
                // Audio Details
                $audio_id = $purifier->purify($fetch_artistSongs['audio_id']);
                $audio_name = $purifier->purify($fetch_artistSongs['audio_name']);
                $artist_id = $purifier->purify($fetch_artistSongs['artist_id']);
                $audio_pic = $purifier->purify($fetch_artistSongs['audio_pic']);
                $popTagged_artist = $purifier->purify($fetch_artistSongs['tagged_artist']);
                $popArtist_name = $purifier->purify($fetch_artistSongs['artist_name']);
                $audio_pic = "$audio_pic";
                $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                $popArtist_name = "$popArtist_name $popTagged_artist";
                $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                echo "<div class='col position-relative'><a href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='rounded spotlight-songsCarousel p-1' style='height:120px; width:100%;'/>
                      <p class='text-wrap text-center text-white relSong_img_overlay'><small>$popArtist_name - $audio_name</small></p></a></div>";
              }
              echo "</div>";
            } else {
              echo "<h6 class='card-header text-info text-center'>Song by $artist_name</h6>
                <div class='card-body'>";
              while ($fetch_artistSongs = mysqli_fetch_assoc($querySongs)) {
                // Audio Details
                $audio_id = $purifier->purify($fetch_artistSongs['audio_id']);
                $audio_name = $purifier->purify($fetch_artistSongs['audio_name']);
                $artist_id = $purifier->purify($fetch_artistSongs['artist_id']);
                $audio_pic = $purifier->purify($fetch_artistSongs['audio_pic']);
                $popTagged_artist = $purifier->purify($fetch_artistSongs['tagged_artist']);
                $popArtist_name = $purifier->purify($fetch_artistSongs['artist_name']);
                $audio_pic = "$audio_pic";
                $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                $popArtist_name = "$popArtist_name $popTagged_artist";
                $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                echo "<div class='mx-auto'><a href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='rounded spotlight-oneSongCarousel' style='width:100%;'/></a></div>";
              }
              echo "</div>";
            }
            ?>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- </div> -->
  </div>
  <!-- </div> -->
  <!-- Advertisement -->
  <!-- <div class="row mb-3 d-none d-md-block">
    <div class="col-md mt-3 mt-md-5">
      <div class="leaderboard-advert mx-auto">
        <img src="img/fixed.jpg" class="advertisement" alt="...">
      </div>
    </div>
  </div> -->

  <!-- <div class="row mb-5">
    <div class="col-md-6 col-lg-4 mt-3 mt-md-5">
      <div class="large-rectangle-advert mx-auto">
        <img src="img/fixed.jpg" class="advertisement" alt="...">
      </div>
    </div>
    <div class="col-md-6 col-lg-4 mt-3 mt-md-5">
      <div class="large-rectangle-advert mx-auto">
        <img src="img/fixed.jpg" class="advertisement" alt="...">
      </div>
    </div>
    <div class="d-none d-lg-block col-md-6 col-lg-4 mt-3 mt-md-5">
      <div class="large-rectangle-advert mx-auto">
        <img src="img/fixed.jpg" class="advertisement" alt="...">
      </div>
    </div>
  </div> -->
</div>
</div>

<!-- footer -->
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
<!-- SLick JS-->
<script type="text/javascript" src="slick/slick.min.js"></script>
<!-- ScrollMagic Plugin for freezing element to a page -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
<!-- cplayer audio plugin JS-->
<script src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/apps.js"></script>
<script type="text/javascript">
  $(function() {
    $('#spotlight-carousel_2').slick({
      dots: false,
      infinite: true,
      speed: 200,
      fade: true,
      autoplay: true,
      arrows: false,
      cssEase: 'linear'
    });

    $('#popular-songsCarousel').slick({
      dots: false,
      infinite: true,
      speed: 6000,
      slidesToShow: 2,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 0,
      cssEase: 'linear',
      arrows: false,
      centerMode: true,
      vertical: true,
      verticalSwiping: true,
      centerPadding: '110px',
      responsive: [{
          breakpoint: 1026,
          settings: {
            dots: false,
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
            centerMode: true,
            vertical: true,
            verticalSwiping: true,
            centerPadding: '110px'
          }
        },
        {
          breakpoint: 800,
          settings: {
            dots: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            arrows: false,
            centerMode: true,
            vertical: true,
            verticalSwiping: true,
            centerPadding: '30px'
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
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
            centerPadding: '110px'
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
  });

  // <!-- 加载 cplayer 脚本 -->
  let player = new cplayer({
    element: document.getElementById('cplayer-app'),
    width: '99VW',
    playlist: [
      <?php
      $queryPlayList = mysqli_query($dbcon, "SELECT audio_name, audio_file, audio_pic, tagged_artist, artist_name,
		album_name FROM audio INNER JOIN artist USING (artist_id) LEFT JOIN album USING (album_id) WHERE hit_track='yes'");
      // Check the result:
      if (mysqli_num_rows($queryPlayList) > 0) {
        // fetch the records
        while ($fetch_playlist = mysqli_fetch_assoc($queryPlayList)) {
          // Audio Details
          $audio_name = $purifier->purify($fetch_playlist['audio_name']);
          $audio_file = $purifier->purify($fetch_playlist['audio_file']);
          $audio_pic = $purifier->purify($fetch_playlist['audio_pic']);
          $tagged_artist = $purifier->purify($fetch_playlist['tagged_artist']);
          // $lyrics = $purifier->purify($fetch_playlist['lyrics']);
          $artist_name = $purifier->purify($fetch_playlist['artist_name']);
          $album_name = $purifier->purify($fetch_playlist['album_name']);
          $audio_file = "$audio_file";
          $audio_pic = "$audio_pic";
          $tagged_artist = (empty($tagged_artist)) ? "" : "ft $tagged_artist";
          $lyrics = "Lyrics for this song is not available at the moment...";
          $album_name = (empty($album_name)) ? "" : $album_name;

          echo "{
					src: '$audio_file',
		      poster: '$audio_pic',
		      name: '$artist_name $tagged_artist',
		      artist: '$audio_name',
		      lyric: '$lyrics',
		      sublyric: '$lyrics',
		      album: '$album_name'
				},";
        }
      }
      ?>
    ]
  });

  // init controller
  var controller = new ScrollMagic.Controller();

  $(window).on("load resize", function() {
    // create a scene for controller plugin
    if (this.matchMedia("(min-width: 1027px) and (min-height: 755px)").matches) {
      new ScrollMagic.Scene({ // Desktop
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 630 // start this scene after scrolling for 50px
        }).setPin('.stickyScrollMagic') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(min-width: 1026px) and (max-height: 754px)").matches) {
      new ScrollMagic.Scene({ // Desktop
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 630 // start this scene after scrolling for 50px
        }).setPin('.stickyScrollMagic') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 1025px) and (min-width: 771px) and (min-height: 810px)").matches) {
      new ScrollMagic.Scene({ // iPad pro
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 630 // start this scene after scrolling for 50px
        }).setPin('.stickyScrollMagic') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 1025px) and (min-width: 770px) and (max-height: 809px)").matches) {
      new ScrollMagic.Scene({ // iPad pro
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 630 // start this scene after scrolling for 50px
        }).setPin('.stickyScrollMagic') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 770px) and (min-width: 768px) and (min-height: 766px)").matches) {
      new ScrollMagic.Scene({ // iPad
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 630 // start this scene after scrolling for 50px
        }).setPin('.stickyScrollMagic') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 770px) and (min-width: 768px) and (max-height: 765px)").matches) {
      new ScrollMagic.Scene({ // iPad
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 630 // start this scene after scrolling for 50px
        }).setPin('.stickyScrollMagic') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 767px)").matches) {
      //   new ScrollMagic.Scene({ // iPad
      //   	duration: 0, // the scene should last for a scroll distance of 100px
      //   	offset: 565 // start this scene after scrolling for 50px
      //   }).setPin('.sidebar__inner') // pins the element for the the scene's duration
      //   	.addTo(controller); // assign the scene to the controller
    }
  });
</script>
</body>

</html>