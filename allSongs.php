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
    $queryPopularSongs = mysqli_query($dbcon, "SELECT audio_id, artist_id, audio_name, audio_pic, tagged_artist, artist_name FROM audio
    INNER JOIN artist USING (artist_id) WHERE hit_track='yes'");
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
        $audio_id = $purifier->purify($fetch_popularSongs['audio_id']);
        $artist_id = $purifier->purify($fetch_popularSongs['artist_id']);
        $audio_name = $purifier->purify($fetch_popularSongs['audio_name']);
        $audio_pic = $purifier->purify($fetch_popularSongs['audio_pic']);
        $popTagged_artist = $purifier->purify($fetch_popularSongs['tagged_artist']);
        $popArtist_name = $purifier->purify($fetch_popularSongs['artist_name']);
        $audio_pic = "$audio_pic";
        $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
        $popAudio_name = "$audio_name $popTagged_artist";
        $hit_link = "music.php?mid=$audio_id&aid=$artist_id";
        $queryPopularSongsNum = $queryPopularSongsNum == (int)$queryPopularSongsNum ? "active" : "";

        echo "<div class='carousel-item allSongsCaro-item w-100 $queryPopularSongsNum'>
          <a class='' href='$hit_link'>
          <img src='$audio_pic' class='d-block w-100 img-fluid' alt='$audio_name'>
          <div class='carousel-caption d-none d-md-block'>
            <h5>$popArtist_name</h5>
            <p>$popAudio_name</p>
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
        // echo "<ol class='carousel-indicators'>
        //   <li data-target='#carouselExampleCaptions' data-slide-to='0' class='active'></li>
        //   <li data-target='#carouselExampleCaptions' data-slide-to='1'></li>
        //   <li data-target='#carouselExampleCaptions' data-slide-to='2'></li>
        // </ol>";
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

            $result_count = mysqli_query($dbcon, "SELECT COUNT(blog_id) As total_records FROM music_blog WHERE mime_type='audio'");
            $total_records = mysqli_fetch_array($result_count);
            $total_records = $total_records['total_records'];
            $total_no_of_pages = ceil($total_records / $total_records_per_page);
            $second_last = $total_no_of_pages - 1; // total page minus 1

            $queryMusicBlog = "SELECT * FROM music_blog WHERE mime_type='audio' ORDER BY date_added DESC LIMIT ?, ?";
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
                $file_id = $purifier->purify($fetch_MusicBlog['file_id']);
                $artist_id = $purifier->purify($fetch_MusicBlog['artist_id']);
                $file_name = $purifier->purify($fetch_MusicBlog['file_name']);
                $file_pic = $purifier->purify($fetch_MusicBlog['file_pic']);
                $tagged_artist = $purifier->purify($fetch_MusicBlog['tagged_artist']);
                $mime_type = $purifier->purify($fetch_MusicBlog['mime_type']);
                $file_pic = (empty($file_pic)) ? $adminPicture : "$file_pic";
                // $link = ($mime_type == "audio" || "video") ? "music.php?mid=$file_id&aid=$artist_id" : "album.php?mid=$file_id&aid=$artist_id";
                $tagged_artist = (!empty($tagged_artist)) ? trim($tagged_artist) : "";
                $query_ArtistDetails = mysqli_query($dbcon, "SELECT artist_name FROM artist WHERE artist_id=$artist_id");
                if (mysqli_num_rows($query_ArtistDetails) == 1) {
                  $fetch_artists = mysqli_fetch_assoc($query_ArtistDetails);
                  $artist_name = $purifier->purify($fetch_artists['artist_name']);
                }
                if ($mime_type == "audio") {
                  $link = "music.php?mid=$file_id&aid=$artist_id";
                } else {
                  $link = "contactUs.php";
                }

                echo "<div class='col-md-6 middle-cols'>
                  <a class='' href='$link'>
                    <div class='card bg-dark text-white mb-3 artist-card position-relative module'>
                      <img src='$file_pic' class='card-img' alt='$file_name'>
                      <div class='card-img-overlay'>
                        <span class='h5-span'><h5 class='card-title App_name text-center my-auto'>$artist_name- $file_name";
                if (!empty($tagged_artist)) {
                  echo " Ft ";
                  $explodeTag = explode(',', $tagged_artist); // explode() returns array object
                  foreach ($explodeTag as $ft_Artist) {
                    if ($ft_Artist === end($explodeTag)) {
                      echo "$ft_Artist";
                    } else {
                      echo "$ft_Artist, ";
                    }
                  }
                }
                echo "</h5></span>
                      </div>
                    </div>
                  </a>
                </div>";
              }
              echo "</div>";
            } else {
              echo '<div class="card">
                <div class="card-body">
                  There are currently no Song check back later!.
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
          <!-- NEWS POST -->
          <div class="news-post">
            <div class="card">
              <div class="card-header text-info"><span class="glyphicon glyphicon-list-alt"></span><b><a href="news.php">News Feed</a></b></div>
              <div class="card-body">
                <div class="row">
                  <div class="col-xs-12">
                    <ul class="demo1">
                      <?php
                      $queryPost = mysqli_query($dbcon, "SELECT post_id, msg_header, post_pic FROM post WHERE admin_post_dir IS NOT NULL ORDER BY post_id DESC LIMIT 20");
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
                                  <td class='text-wrap news_msgHeader'>$post_msg_header</td>
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
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
                            </tr>
                          </table>
                        </li>
                        <li class="news-item">
                          <table cellpadding="4">
                            <tr>
                              <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
                            </tr>
                          </table>
                        </li>
                        <li class="news-item">
                          <table cellpadding="4">
                            <tr>
                              <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
                            </tr>
                          </table>
                        </li>
                        <li class="news-item">
                          <table cellpadding="4">
                            <tr>
                              <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
                            </tr>
                          </table>
                        </li>
                        <li class="news-item">
                          <table cellpadding="4">
                            <tr>
                              <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
                            </tr>
                          </table>
                        </li>
                        <li class="news-item">
                          <table cellpadding="4">
                            <tr>
                              <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
                            </tr>
                          </table>
                        </li>
                        <li class="news-item">
                          <table cellpadding="4">
                            <tr>
                              <td><img <?php echo "src='$adminPicture'"; ?> width="60" height='60' class="img-circle" /></td>
                              <td class="text-wrap">No Post/News to show yet... <a href="allSongs.php">Read more...</a></td>
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
<!-- News box plugin for news feed -->
<script src="js/jquery.bootstrap.newsbox.min.js"></script>
<script src="js/line-cutter.js" type="text/javascript"></script>
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