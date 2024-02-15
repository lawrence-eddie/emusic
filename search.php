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

if (isset($_GET["search"])) {
  $search_url = $purifier->purify($_GET["search"]);
  $search_string = urldecode($search_url);
  // $search_str = remove_stop_words($search_string);
  // $searchWords = explode(" ", $search_str);
  // $searchWords = array_filter($searchWords);
}
// Redirect user if page refarer wasn't through account search form
if (!isset($search_string)) redirect_user("index.php");

require_once('include/header.php');
?>
<div class="searchPage">
  <div class="row container-fluid">
    <!-- Left empty space for xl devices -->
    <div class="col-xl-1 d-none d-xl-block"></div>
    <!-- Middle column (Main column) -->
    <div class="col-xl-10">
      <!-- Spotlight Carousel -->
      <div class="mt-3" id="spotlight-cover">
        <p class="ml-3 mt-1 mb-0 font-weight-bold text-info">ARTIST SPOTLIGHT</p>
        <div class="row mx-auto justify-content-center" data-aos="zoom-in" data-aos-duration="1000">
          <?php
          $queryArtistSpotlight = mysqli_query($dbcon, "SELECT * FROM artist_spotlight");
          // Check the result:
          if (mysqli_num_rows($queryArtistSpotlight) == 1) {
            // fetch the records
            $fetch_ArtistDetails = mysqli_fetch_assoc($queryArtistSpotlight);
            $artistSpotlight_id = $purifier->purify($fetch_ArtistDetails['artist_id']);
            $artist_name = $purifier->purify($fetch_ArtistDetails['artist_name']);
            $artist_pic1 = $purifier->purify($fetch_ArtistDetails['artist_pic_1']);
            $artist_pic2 = $purifier->purify($fetch_ArtistDetails['artist_pic_2']);
            $artist_pic3 = $purifier->purify($fetch_ArtistDetails['artist_pic_3']);
            $description1 = $purifier->purify($fetch_ArtistDetails['description_1']);
            $description2 = $purifier->purify($fetch_ArtistDetails['description_2']);
            $description3 = $purifier->purify($fetch_ArtistDetails['description_3']);
            $artist_pic_1 = "$artist_pic1";
            $artist_pic_2 = "$artist_pic2";
            $artist_pic_3 = "$artist_pic3";
            $description_1 = "$description1";
            $description_2 = "$description2";
            $description_3 = "$description3";
            $artistSpotlightLink = "spotlight.php?aid=$artistSpotlight_id";

            echo "
  					<div class='col-8'>
  						<a href='$artistSpotlightLink'>
  						<div class='' id='spotlight-carousel'>
  							<div><img src='$artist_pic_1'alt='$artist_name' class='round-img'></div>
  							<div><img src='$artist_pic_2' alt='$artist_name' class='round-img'></div>
  							<div><img src='$artist_pic_3' alt='$artist_name' class='round-img'></div>
  						</div></a>
  					</div>


  					<div class='col-4' id='spotlight-writeUp'>
  						<a href='$artistSpotlightLink' class='text-decoration-none'>
  						<h5 class='font-weight-bolder'>$artist_name</h5>
  						<p class='spotlight-body_msg spotlight-body_msg1' id='spotlight-body_msg1'>$description_1</p>
  						<p class='spotlight-body_msg'>$description_2</p>
  						<p class='spotlight-body_msg'>$description_3</p></a>
  					</div>";
          }
          ?>
        </div>
      </div>
      <!-- Small device ADVERTISEMENT -->
      <div class="row">
        <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-3 sm-device-ad">
          <div class="text-white advertisement music_advert mx-auto">
            <img src="img/advert.jpg" class="card-img" alt="...">
          </div>
        </div>
        <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-3 sm-device-ad">
          <div class="text-white advertisement music_advert mx-auto">
            <img src="img/advert.jpg" class="card-img" alt="...">
          </div>
        </div>
      </div>

      <!-- Main Page Details -->
      <section class="section-MainContent pt-lg-5">
        <div class="row">
          <!-- Popular songs -->
          <div class="col-lg-2 d-none d-lg-block" id="popular-songs">
            <div class="position-relative">
              <div class="card popularSongs_inner">
                <h6 class="card-header text-info">Popular Songs</h6>
                <div class="card-block">
                  <div class='' id='popular-songsCarousel'>
                    <?php
                    $queryPopularSongs = mysqli_query($dbcon, "SELECT audio_id, artist_id, audio_pic, tagged_artist, artist_name FROM audio
  										INNER JOIN artist USING (artist_id) WHERE hit_track='yes'");
                    // Check the result:
                    if (mysqli_num_rows($queryPopularSongs) >= 5) {
                      // fetch the records
                      while ($fetch_popularSongs = mysqli_fetch_assoc($queryPopularSongs)) {
                        // Audio Details
                        $audio_id = $purifier->purify($fetch_popularSongs['audio_id']);
                        $artist_id = $purifier->purify($fetch_popularSongs['artist_id']);
                        $audio_pic = $purifier->purify($fetch_popularSongs['audio_pic']);
                        $popTagged_artist = $purifier->purify($fetch_popularSongs['tagged_artist']);
                        $popArtist_name = $purifier->purify($fetch_popularSongs['artist_name']);
                        $audio_pic = "$audio_pic";
                        $popTagged_artist = (empty($popTagged_artist)) ? "" : "ft $popTagged_artist";
                        $popArtist_name = "$popArtist_name $popTagged_artist";
                        $hit_link = "music.php?mid=$audio_id&aid=$artist_id";

                        echo "<div class='popularSong_items'><a class='' href='$hit_link'><img src='$audio_pic' alt='$popArtist_name' class='round-img'/></a></div>";
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

          <!-- Search result column -->
          <div class="col-lg-8 all-songs mb-3 mb-lg-5 search-column">
            <?php
            // Search for audio base on user search query
            $queryAudio = "SELECT audio.audio_id, audio.artist_id, audio.audio_name, audio.audio_pic,
                audio.tagged_artist, artist.artist_name FROM audio INNER JOIN artist ON audio.artist_id=artist.artist_id
                WHERE (MATCH(audio.audio_name) AGAINST(?) AND MATCH(audio.tagged_artist) AGAINST(?) AND
                 MATCH(audio.lyrics) AGAINST(?) AND MATCH(artist.artist_name) AGAINST(?)) OR
                (MATCH(audio.audio_name) AGAINST(?) AND MATCH(audio.lyrics) AGAINST(?) AND MATCH(artist.artist_name) AGAINST(?)) OR
                (MATCH(artist.artist_name) AGAINST(?) AND MATCH(audio.audio_name) AGAINST(?)) OR
                (MATCH(artist.artist_name) AGAINST(?) AND MATCH(audio.lyrics) AGAINST(?)) OR
                (MATCH(audio.audio_name) AGAINST(?) AND MATCH(audio.lyrics) AGAINST(?)) OR
                (MATCH(audio.tagged_artist) AGAINST(?) OR MATCH(audio.lyrics) AGAINST(?) OR
                 MATCH(artist.artist_name) AGAINST(?) OR MATCH(audio.audio_name) AGAINST(?))";
            // Check the result:
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryAudio);
            // bind $id to SQL statement
            mysqli_stmt_bind_param(
              $q,
              'sssssssssssssssss',
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_strings
            );
            // execute query
            mysqli_stmt_execute($q);
            $queryAudio = mysqli_stmt_get_result($q);
            $queryAudio_result = mysqli_num_rows($queryAudio); ////////////////////RESULT
            if ($queryAudio_result > 0) {
              echo '<div class="audio_result mb-3">
                      <h6 class="text-info">Audio Search</h6>';
              while ($fetch_audio = mysqli_fetch_assoc($queryAudio)) {
                // fetch the records
                $audio_id = $purifier->purify($fetch_audio['audio_id']);
                $artist_id = $purifier->purify($fetch_audio['artist_id']);
                $audio_name = $purifier->purify($fetch_audio['audio_name']);
                $audio_pic  = $purifier->purify($fetch_audio['audio_pic']);
                $tagged_artist = $purifier->purify($fetch_audio['tagged_artist']);
                $artist_name = $purifier->purify($fetch_audio['artist_name']);

                $audio_link = "music.php?mid=$audio_id&aid=$artist_id";
                $audio_pic = (empty($audio_pic)) ? $adminPicture : "$audio_pic";
                $tagged_artist = (empty($tagged_artist)) ? "" : trim($tagged_artist);

                echo "<a class='text-primary' href='$audio_link'>
                  <div class='card audio_result_items mb-2 rounded search_card text-truncate' style='max-width:100%;'>
                    <div class='row no-gutters'>
                      <div class='col-2'>
                        <img src='$audio_pic' alt='$audio_name' class='rounded w-100 search_img'>
                      </div>
                      <div class='col-10' id='' style='overflow-y:hidden;'>
                        <div class='card-body text-wrap p-1 p-md-2'>
                          <p class='card-title font-weight-bold'>$artist_name - $audio_name";
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
                echo "</p>";
                echo "
                        </div>
                      </div>
                    </div>
                  </div></a>";
              }
              echo "</div>";
              // Free result set
              mysqli_free_result($queryAudio);
            }

            // Search for video base on user search query
            // $queryVideo = "SELECT video_id, artist_id, video_name, video_pic,
            // tagged_artist, artist_name FROM video INNER JOIN artist USING(artist_id)
            // WHERE (MATCH(video_name) AGAINST('$search_string') OR MATCH(tagged_artist) AGAINST('$search_string'))";
            $queryVideo = "SELECT video.video_id, video.artist_id, video.video_name, video.video_pic,
                video.tagged_artist, artist.artist_name FROM video INNER JOIN artist ON video.artist_id=artist.artist_id
                WHERE (artist.artist_name LIKE CONCAT('%', ?, '%') AND video.video_name LIKE CONCAT('%', ?, '%') AND video.tagged_artist LIKE CONCAT('%', ?, '%')) OR
                (artist.artist_name LIKE CONCAT('%', ?, '%') AND video.video_name LIKE CONCAT('%', ?, '%')) OR
                (artist.artist_name LIKE CONCAT('%', ?, '%') AND video.tagged_artist LIKE CONCAT('%', ?, '%')) OR
                (artist.artist_name LIKE CONCAT('%', ?, '%') OR video.video_name LIKE CONCAT('%', ?, '%') OR video.tagged_artist LIKE CONCAT('%', ?, '%'))";
            // Check the result:
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryVideo);
            // bind $id to SQL statement
            mysqli_stmt_bind_param(
              $q,
              'ssssssssss',
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string,
              $search_string
            );
            // execute query
            mysqli_stmt_execute($q);
            $queryVideo = mysqli_stmt_get_result($q);
            $queryVideo_result = mysqli_num_rows($queryVideo); ////////////////////RESULT
            if ($queryVideo_result > 0) {
              echo '<div class="video_result mb-3">
                <h6 class="text-info mt-2">Video Search</h6>';
              while ($fetch_video = mysqli_fetch_assoc($queryVideo)) {
                // fetch the records
                $video_id = $purifier->purify($fetch_video['video_id']);
                $artist_id = $purifier->purify($fetch_video['artist_id']);
                $video_name = $purifier->purify($fetch_video['video_name']);
                $video_pic  = $purifier->purify($fetch_video['video_pic']);
                $tagged_artist = $purifier->purify($fetch_video['tagged_artist']);
                $artist_name = $purifier->purify($fetch_video['artist_name']);

                $video_link = "video.php?mid=$video_id&aid=$artist_id";
                $video_pic = (empty($video_pic)) ? $adminPicture : "$video_pic";
                $tagged_artist = (empty($tagged_artist)) ? "" : trim($tagged_artist);

                echo "<a class='text-primary' href='$video_link'>
                  <div class='card video_result_items mb-2 rounded search_card text-truncate' style='max-width:100%;'>
                    <div class='row no-gutters'>
                      <div class='col-2'>
                        <img src='$video_pic' alt='$video_name' class='rounded w-100 search_img'>
                      </div>
                      <div class='col-10' id='' style='overflow-y:hidden;'>
                        <div class='card-body text-wrap p-1 p-md-2'>
                          <p class='card-title font-weight-bold'>$artist_name - $video_name";
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
                echo "</p>";
                echo "
                        </div>
                      </div>
                    </div>
                  </div><a/>";
              }
              echo "</div>";
            }

            // Search for album base on user search query
            $queryAlbum = "SELECT album.album_id, album.artist_id, album.album_name,  album.album_pic,
              artist.artist_name FROM album INNER JOIN artist ON album.artist_id=artist.artist_id
              WHERE (album.album_name LIKE CONCAT('%', ?, '%') AND artist.artist_name LIKE CONCAT('%', ?, '%')) OR
                    (album.album_name LIKE CONCAT('%', ?, '%') OR artist.artist_name LIKE CONCAT('%', ?, '%'))";
            // Check the result:
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryAlbum);
            // bind $id to SQL statement
            mysqli_stmt_bind_param($q, 'ssss', $search_string, $search_string, $search_string, $search_string);
            // execute query
            mysqli_stmt_execute($q);
            $queryAlbum = mysqli_stmt_get_result($q);
            $queryAlbum_result = mysqli_num_rows($queryAlbum); ////////////////////RESULT
            if ($queryAlbum_result > 0) {
              echo '<div class="post_result mb-3">
                <h6 class="text-info mt-2">Album Search</h6>';
              while ($fetch_album = mysqli_fetch_assoc($queryAlbum)) {
                // fetch the records
                $album_id  = $purifier->purify($fetch_album['album_id']);
                $artist_id  = $purifier->purify($fetch_album['artist_id']);
                $album_name  = $purifier->purify($fetch_album['album_name']);
                $album_pic  = $purifier->purify($fetch_album['album_pic']);
                $artist_name  = $purifier->purify($fetch_album['artist_name']);
                $album_pic = (empty($album_pic)) ? $adminPicture : "$album_pic";
                $album_link = "album.php?mid=$album_id&aid=$artist_id";

                echo "<a class='post_result_items' href='$album_link' id=''>
                  <div class='card mb-2 rounded search_card text-truncate' style='max-width: 100%;'>
                    <div class='row no-gutters'>
                      <div class='col-2'>
                        <img src='$album_pic' alt='$album_name' class='rounded w-100 search_img'>
                      </div>
                      <div class='col-10' id='' style='overflow-y:hidden;'>
                        <div class='card-body text-wrap p-1 p-md-2'>
                          <p class='card-title text-primary font-weight-bold'>$artist_name- $album_name</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>";
              }
              echo "</div>";
            }

            // Search for News base on user search query
            $queryPost = "SELECT post.post_id, post.msg_header, post.post_pic
              FROM post WHERE post.admin_post_dir IS NOT NULL
              AND (MATCH(post.msg_header) AGAINST(?) AND MATCH(post.post_msg) AGAINST(?)) OR
                  (MATCH(post.msg_header) AGAINST(?) OR MATCH(post.post_msg) AGAINST(?))";
            // Check the result:
            $q = mysqli_stmt_init($dbcon);
            mysqli_stmt_prepare($q, $queryPost);
            // bind $id to SQL statement
            mysqli_stmt_bind_param($q, 'ssss', $search_string, $search_string, $search_string, $search_string);
            // execute query
            mysqli_stmt_execute($q);
            $queryPost = mysqli_stmt_get_result($q);
            $queryPost_result = mysqli_num_rows($queryPost); ////////////////////RESULT
            if ($queryPost_result > 0) {
              echo '<div class="post_result mb-3">
                      <h6 class="text-info mt-2">Post Search</h6>';
              while ($fetch_post = mysqli_fetch_assoc($queryPost)) {
                // fetch the records
                $post_id  = $purifier->purify($fetch_post['post_id']);
                $msgHeader  = $purifier->purify($fetch_post['msg_header']);
                $post_pic  = $purifier->purify($fetch_post['post_pic']);
                $post_pic = (empty($post_pic)) ? $adminPicture : "$post_pic";
                $post_link = "post.php?pid=$post_id&uid=''";

                echo "<a class='post_result_items' href='$post_link' id=''>
                  <div class='card mb-2 rounded search_card text-truncate' style='max-width: 100%;'>
                    <div class='row no-gutters'>
                      <div class='col-2'>
                        <img src='$post_pic' alt='$msgHeader' class='rounded w-100 search_img'>
                      </div>
                      <div class='col-10' id='' style='overflow-y:hidden;'>
                        <div class='card-body text-wrap p-1 p-md-2'>
                          <p class='card-title text-primary font-weight-bold'>$msgHeader</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  </a>";
              }
              echo "</div>";
            }

            if (empty($queryAudio_result) and empty($queryVideo_result) and empty($queryAlbum_result) and empty($queryPost_result)) {
              echo "<p class='mb-0 text-muted p-3'>Your search - $search_string - did not match any documents.<br><br>
                Suggestions:<br>
                Make sure all words are spelled corectly.<br>
                Try different keywords.<br>
                Try more general keywords.<br><br>
                <strong>Tip:</strong> Try using words that might appear on the page you’re looking for. For example,
                \"beyonce\" instead of \"how to download beyonce songs.\"
                </p>";
            } else echo "<p class='mb-0 text-muted text-center'><i>End of searched records</i></p>";
            ?>
          </div>

          <!-- Ad & News Post -->
          <div class="col-lg-2 d-none d-lg-block ad-news_col" id="news-ads">
            <!-- ADVERTISEMENT -->
            <div class="mb-4">
              <div class="text-white advertisement music_advert mx-auto">
                <img src="img/advert.jpg" class="card-img" alt="...">
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
                            $link = "post.php?pid=$post_id&uid=''";

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
                <div class="card-footer"></div>
              </div>
            </div>
            <!-- ADVERTISEMENT -->
            <div class="mt-4">
              <div class="text-white advertisement music_advert mx-auto">
                <img src="img/advert.jpg" class="card-img" alt="...">
              </div>
            </div>
            <div class="mt-4">
              <div class="text-white advertisement music_advert mx-auto">
                <img src="img/advert.jpg" class="card-img" alt="...">
              </div>
            </div>
            <div class="mt-4">
              <div class="text-white advertisement music_advert mx-auto">
                <img src="img/advert.jpg" class="card-img" alt="...">
              </div>
            </div>
            <div class="mt-4 mb-lg-5">
              <div class="text-white advertisement music_advert mx-auto">
                <img src="img/advert.jpg" class="card-img" alt="...">
              </div>
            </div>
      </section>
    </div>
  </div>

  <!-- Small device ADVERTISEMENT -->
  <div class="row">
    <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-3 sm-device-ad">
      <div class="text-white advertisement music_advert mx-auto">
        <img src="img/advert.jpg" class="card-img" alt="...">
      </div>
    </div>
    <div class="col-md-6 border-0 bg-transparent mt-2 d-sm-block d-lg-none mb-sm-5 mb-3 sm-device-ad">
      <div class="text-white advertisement music_advert mx-auto">
        <img src="img/advert.jpg" class="card-img" alt="...">
      </div>
    </div>
  </div>
</div>
<!-- Right empty space for xl devices -->
<div class="col-xl-1 d-none d-xl-block">

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
  <div class="" id="cplayerSearch-app"></div>
</footer>
<!-- </div> -->

<?php require('include/footerJS.php'); ?>
<!-- Font Awesome -->
<script src="js/fontawesome.min.js"></script>
<!-- ScrollMagic Plugin for freezing element to a page -->
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/ScrollMagic.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.7/plugins/debug.addIndicators.min.js"></script>
<!-- News box plugin for news feed -->
<script src="js/jquery.bootstrap.newsbox.min.js"></script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<script src="js/line-cutter.js" type="text/javascript"></script>
<script src="js/dotdotdot.js" type="text/javascript"></script>
<!-- SLick JS-->
<script type="text/javascript" src="slick/slick.min.js"></script>
<!-- Calamansi audio plugin JS-->
<!-- <script type="text/javascript" src="js/calamansi.min.js"></script> -->
<!-- cplayer audio plugin JS-->
<script src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>
<!-- AOS JS-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="js/apps.js"></script>
<script type="text/javascript">
  AOS.init();
  // Ellipsis/clamp plugin(line-cutter)
  // $(".spotlight-body_msg1").line(13,'...');
  $(".news_msgHeader").line(3, '...');

  $(function() {
    $('#spotlight-carousel').slick({
      dots: false,
      infinite: true,
      speed: 500,
      fade: true,
      autoplay: true,
      arrows: false,
      cssEase: 'linear'
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
</script>
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> -->
<!-- <script src="js/lc_text_shortener.min.js"></script> -->
<script type="text/javascript">
  document.addEventListener("DOMContentLoaded", () => {
    let wrapper = document.querySelector("#spotlight-writeUp");
    let options = {
      // Options go here
      // after: 'a.more',
      // 'ellipsis':' [Show more...] '
    };
    new Dotdotdot(wrapper, options);
  });

  // <!-- 加载 cplayer 脚本 -->
  let player = new cplayer({
    element: document.getElementById('cplayerSearch-app'),
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

  // init controller
  var controller = new ScrollMagic.Controller();

  $(window).on("load resize", function() {
    // create a scene for controller plugin
    if (this.matchMedia("(min-width: 1027px) and (min-height: 755px)").matches) {
      new ScrollMagic.Scene({ // Desktop
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 505 // start this scene after scrolling for 50px
        }).setPin('.popularSongs_inner') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(min-width: 1026px) and (max-height: 754px)").matches) {
      new ScrollMagic.Scene({ // Desktop
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 505 // start this scene after scrolling for 50px
        }).setPin('.popularSongs_inner') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 1025px) and (min-width: 771px) and (min-height: 810px)").matches) {
      new ScrollMagic.Scene({ // iPad pro
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 505 // start this scene after scrolling for 50px
        }).setPin('.popularSongs_inner') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 1025px) and (min-width: 770px) and (max-height: 809px)").matches) {
      new ScrollMagic.Scene({ // iPad pro
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 505 // start this scene after scrolling for 50px
        }).setPin('.popularSongs_inner') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 770px) and (min-width: 768px) and (min-height: 766px)").matches) {
      new ScrollMagic.Scene({ // iPad
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 505 // start this scene after scrolling for 50px
        }).setPin('.popularSongs_inner') // pins the element for the the scene's duration
        .addTo(controller); // assign the scene to the controller
    }
    if (this.matchMedia("(max-width: 770px) and (min-width: 768px) and (max-height: 765px)").matches) {
      new ScrollMagic.Scene({ // iPad
          duration: 0, // the scene should last for a scroll distance of 100px
          offset: 505 // start this scene after scrolling for 50px
        }).setPin('.popularSongs_inner') // pins the element for the the scene's duration
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