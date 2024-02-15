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
session_start();
require_once('obaEddie_connect.php');
define('ERROR_LOG', 'logs/errors.log');
require_once('include/config.inc.php');

// Purify plugin
//$dbcon->set_charset("utf8mb4");
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

require_once('include/header.php');
?>
<div class="container-xl mt-3">
  <div class="row">
    <?php
    $queryPopularSongs = mysqli_query($dbcon, "SELECT album_id, artist_id, album_name, album_pic, artist_name
    FROM album INNER JOIN artist USING(artist_id) ORDER BY album_id DESC LIMIT 10");
    // Check the result:
    $queryPopularSongsNum = mysqli_num_rows($queryPopularSongs);
    if ($queryPopularSongsNum >= 3) {
      // Popular song carousel
      echo "<div id='carouselExampleCaptions' class='carousel slide w-100' data-ride='carousel'>
      <div class='carousel-inner w-100' role='listbox'>";
      // $indicator = 0;
      // fetch the records
      while ($fetch_popularSongs = mysqli_fetch_assoc($queryPopularSongs)) {
        // Audio Details
        $album_id = $purifier->purify($fetch_popularSongs['album_id']);
        $artist_id = $purifier->purify($fetch_popularSongs['artist_id']);
        $album_name = $purifier->purify($fetch_popularSongs['album_name']);
        $album_pic = $purifier->purify($fetch_popularSongs['album_pic']);
        $artist_name = $purifier->purify($fetch_popularSongs['artist_name']);
        $album_pic = "$album_pic";
        $hit_link = "album.php?mid=$album_id&aid=$artist_id";
        $queryPopularSongsNum = $queryPopularSongsNum == (int)$queryPopularSongsNum ? "active" : "";

        echo "<div class='carousel-item allSongsCaro-item w-100 $queryPopularSongsNum'>
          <a class='' href='$hit_link'>
          <img src='$album_pic' class='d-block w-100 img-fluid' alt='$album_name'>
          <div class='carousel-caption'>
            <h5>$artist_name</h5>
            <h6>$album_name</h6>
          </div></a>
        </div>
        <a class='carousel-control-prev' href='#carouselExampleCaptions' role='button' data-slide='prev'>
          <span class='carousel-control-prev-icon' aria-hidden='true'></span>
          <span class='sr-only'>Previous</span>
        </a>
        <a class='carousel-control-next' href='#carouselExampleCaptions' role='button' data-slide='next'>
          <span class='carousel-control-next-icon' aria-hidden='true'></span>
          <span class='sr-only'>Next</span>
        </a>";
        // $indicator++;
      }
      echo "</div></div>";
    } else {
      echo "<div class='col-md-6 d-none d-md-block'>
        <div class='large-rectangle-advert mx-auto'>
            <img src='img/advert.jpg' class='advertisement' alt='...'>
        </div>
      </div>
      <div class='col-md-6 d-none d-md-block'>
        <div class='large-rectangle-advert mx-auto'>
            <img src='img/advert.jpg' class='advertisement' alt='...'>
        </div>
      </div>";
    }
    ?>
  </div>

  <!-- Small device ADVERTISEMENT -->
  <div class="row">
    <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-3 sm-device-ad">
      <div class='large-rectangle-advert mx-auto'>
        <img src='img/advert.jpg' class='advertisement' alt='...'>
      </div>
    </div>
    <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-3 sm-device-ad">
      <div class='large-rectangle-advert mx-auto'>
        <img src='img/advert.jpg' class='advertisement' alt='...'>
      </div>
    </div>
  </div>

  <div class="row">
    <section class="section-MainContent pt-lg-5">
      <div class="row">
        <!-- All Songs -->
        <div class="col-lg-8 all-songs mb-3 mb-lg-5">
          <?php
          try {
            // set the number of rows per display page
            $total_records_per_page = 20;
            // Has the totla number of pages already been calculated?
            if (isset($_GET['page_no'])) {
              $page_no = filter_var($_GET['page_no'], FILTER_SANITIZE_NUMBER_INT);
            } else { // use the next block of code to calculate the number of pages
              $page_no = 1;
            } // page check finished
            $offset = ($page_no - 1) * $total_records_per_page;
            $previous_page = $page_no - 1;
            $next_page = $page_no + 1;
            $adjacents = 2;

            $result_count = mysqli_query($dbcon, "SELECT COUNT(album_id) As total_records FROM `album`");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total page minus 1

            $queryMusicBlog = "SELECT album_id, artist_id, album_name, album_pic, artist_name
            FROM album INNER JOIN artist USING(artist_id) ORDER BY release_date DESC LIMIT ?, ?";
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryMusicBlog);
            // use prepared statement to ensure that only text is inserted
            // bind fields to SQL statement
            mysqli_stmt_bind_param($q, 'ii', $offset, $total_records_per_page);
            // execute the query
            mysqli_stmt_execute($q);
            $queryBlog_result = mysqli_stmt_get_result($q);
            // Check the result:
            if (mysqli_num_rows($queryBlog_result) > 0) {
              echo "<div class='row'>";
              // fetch the records
              while ($fetch_MusicBlog = mysqli_fetch_assoc($queryBlog_result)) {
                // Audio Details
                $album_id = $purifier->purify($fetch_MusicBlog['album_id']);
                $artist_id = $purifier->purify($fetch_MusicBlog['artist_id']);
                $album_name = $purifier->purify($fetch_MusicBlog['album_name']);
                $album_pic = $purifier->purify($fetch_MusicBlog['album_pic']);
                $artist_name = $purifier->purify($fetch_MusicBlog['artist_name']);
                $album_pic = "$album_pic";
                $link = "album.php?mid=$album_id&aid=$artist_id";

                echo "<div class='col-md-6 middle-cols'>
                  <a class='' href='$link'>
                    <div class='card bg-dark text-white mb-3 artist-card position-relative module'>
                      <img src='$album_pic' class='card-img' alt='$album_name'>
                      <div class='card-img-overlay'>
                        <span class='h5-span'><h5 class='card-title App_name text-center my-auto'>$artist_name- $album_name</h5></span>
                      </div>
                    </div>
                  </a>
                </div>";
              }
              echo "</div>";
            } else {
              echo '<div class="card">
                <div class="card-body">
                  There are currently no Album check back later!.
                </div>
              </div>';
            }

            // Make the links to other pages, if necessary.
            if ($total_no_of_pages > 1) {
              echo "<nav aria-label='Page navigation' class='mt-4'>
              <ul class='text-center justify-content-center pagination pagination-sm'>";
              // What number is the current page?
              // $current_page = ($offset/$total_records_per_page) + 1;
              // if the page is not the first page then create a Previous link
              if ($page_no > 1) {
                echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $previous_page .
                  '"aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
              }

              // Make all the numbered pages:
              if ($total_no_of_pages <= 10) {
                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                  if ($i != $page_no) {
                    echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $i . '">' . $i . '</a></li>';
                  } else {
                    echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
                  }
                }
              } elseif ($total_no_of_pages > 10) {
                if ($page_no <= 4) {
                  for ($i = 1; $i < 8; $i++) {
                    if ($i == $page_no) {
                      echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $i . '">' . $i . '</a></li>';
                    }
                  }
                  echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $second_last . '">' . $second_last . '</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a></li>';
                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . 1 . '">' . 1 . '</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . 2 . '">' . 2 . '</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
                  for ($i = $page_no - $adjacents; $i <= $page_no + $adjacents; $i++) {
                    if ($i == $page_no) {
                      echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $i . '">' . $i . '</a></li>';
                    }
                  }
                  echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $second_last . '">' . $second_last . '</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a></li>';
                } else {
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . 1 . '">' . 1 . '</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . 2 . '">' . 2 . '</a></li>';
                  echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
                  for ($i = $total_no_of_pages - 6; $i <= $total_no_of_pages; $i++) {
                    if ($i == $page_no) {
                      echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $i . '">' . $i . '</a></li>';
                    }
                  }
                }
              }

              // Create next link
              if ($page_no < $total_no_of_pages) {
                echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $next_page .
                  '" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
              }
              // if ($page_no < $total_no_of_pages) {
              //   echo '<li class="page-item"><a class="page-link pagiClickLink" href="allSongs.php?page_no=' . $total_no_of_pages .
              //   '" aria-label="Last">Last &rsaquo;&rsaquo;</a></li>';
              // }
              echo "</ul></nav>";
            }
          } catch (Exception $e) {
            // print "An Exception occured message: " . $e->getMessage();
            print "The system is busy please try later";
            $date = date('m.d.y h:i:s');
            $errormessage = $e->getMessage();
            $eMessage = $date . " | Exception Error | " . $errormessage . "\r\n";
            error_log($eMessage, 3, ERROR_LOG);
            // e-mail support person to alert there is a problem
            // error_log("Date/Time: $date - Exception Error, Check error log for
            //details", 1, noone@helpme.com, "Subject: Exception Error \nFrom: Error
            //Log <errorlog@helpme.com>" . "\r\n");
          } catch (Error $e) {
            // print "An Error occured message: " . $e->getMessage();
            print "The system is busy please try later";
            $date = date('m.d.y h:i:s');
            $errormessage = $e->getMessage();
            $eMessage = $date . " | Error | " . $errormessage . "\r\n";
            error_log($eMessage, 3, ERROR_LOG);
            // e-mail support person to alert there is a problem
            // error_log("Date/Time: $date - Error, Check error log for
            //details", 1, noone@helpme.com, "Subject: Error \nFrom: Error
            //Log <errorlog@helpme.com>" . "\r\n");
          }
          ?>
        </div>

        <!-- Free space padding-->
        <div class="col-lg-1 d-none d-xl-block ad-news_col"></div>

        <!-- Ad & News Post -->
        <div class="col-lg-3 d-none d-lg-block ad-news_col" id="news-ads">
          <!-- ADVERTISEMENT -->
          <div class="mb-4">
            <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
          </div>
          <!-- Popular songs -->
          <div class="" id="popular-songs">
            <div class="position-relative">
              <div class="card popularSongs_inner">
                <h6 class="card-header text-info">Popular Songs</h6>
                <div class="card-block">
                  <div class='' id='popular-songsCarousel'>
                    <?php
                    $queryPopularSongs = mysqli_query($dbcon, "SELECT audio_id, audio_name, artist_id, audio_pic, tagged_artist, artist_name FROM audio
										INNER JOIN artist USING (artist_id) WHERE hit_track='yes'");
                    // Check the result:
                    if (mysqli_num_rows($queryPopularSongs) >= 5) {
                      // fetch the records
                      while ($fetch_popularSongs = mysqli_fetch_assoc($queryPopularSongs)) {
                        // Audio Details
                        $audio_id = $purifier->purify($fetch_popularSongs['audio_id']);
                        $audio_name = $purifier->purify($fetch_popularSongs['audio_name']);
                        $artist_id = $purifier->purify($fetch_popularSongs['artist_id']);
                        $audio_pic = $purifier->purify($fetch_popularSongs['audio_pic']);
                        $popTagged_artist = $purifier->purify($fetch_popularSongs['tagged_artist']);
                        $popArtist_name = $purifier->purify($fetch_popularSongs['artist_name']);
                        $audio_pic = (empty($audio_pic)) ? $adminPicture : "$audio_pic";
                        $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                        $popArtist_name = "$popArtist_name $popTagged_artist";
                        $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                        echo "<div class='popularSong_items position-relative'><a class='' href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='round-img'/>
												  <p class='text-wrap text-center text-white popSong_img_overlay'><small>$popArtist_name - $audio_name</small></p></a></div>";
                      }
                    } else {
                      echo "<div class='popularSong_items><img src='$adminPicture' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='img/dev.jpg' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='$adminPicture' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='img/fancy.jpg' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='$adminPicture' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='img/inner-col.jpg' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='$adminPicture' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='img/keyboard1.jpg' alt='' class='round-img'/></div>
							        <div class='popularSong_items><img src='$adminPicture' alt='' class='round-img'/></div>";
                    }
                    ?>
                  </div>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            <!-- ADVERTISEMENT -->
            <!-- <div class="card mt-4">
							<div class="card bg-dark text-white">
							  <img src="img/fixed.jpg" class="card-img" alt="...">
							  <div class="card-img-overlay">
							    <h6 class="card-title text-center">Advertisement</h6>
							  </div>
							</div>
						</div> -->
          </div>
          <!-- ADVERTISEMENT -->
          <div class="mt-4">
            <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
          </div>
          <div class="mt-4">
            <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
          </div>
          <div class="mt-4">
            <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
          </div>
          <div class="mt-4 mb-lg-5">
            <div class='large-rectangle-advert mx-auto'>
              <img src='img/advert.jpg' class='advertisement' alt='...'>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Small device ADVERTISEMENT -->
  <div class="row">
    <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-3 sm-device-ad">
      <div class='large-rectangle-advert mx-auto'>
        <img src='img/advert.jpg' class='advertisement' alt='...'>
      </div>
    </div>
    <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-sm-5 mb-3 sm-device-ad">
      <div class='large-rectangle-advert mx-auto'>
        <img src='img/advert.jpg' class='advertisement' alt='...'>
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
<!-- Line cutter plugin for news feed -->
<script src="js/line-cutter.js" type="text/javascript"></script>
<!-- SLick JS-->
<script type="text/javascript" src="slick/slick.min.js"></script>
<!-- cplayer audio plugin JS-->
<script src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>
<script type="text/javascript" src="js/apps.js"></script>
<script type="text/javascript">
  // Ellipsis/clamp plugin(line-cutter)
  // $(".spotlight-body_msg1").line(13,'...');
  $(".news_msgHeader").line(3, '...');

  $(function() {
    $('.pagiClickLinkDisable').click(function(e) {
      e.preventDefault();
    });

    $('#popular-songsCarousel').slick({
      dots: false,
      infinite: true,
      speed: 6000,
      slidesToShow: 3,
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
            slidesToShow: 3,
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
            slidesToShow: 2,
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
  });

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
</body>

</html>