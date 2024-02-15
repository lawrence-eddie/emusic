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
// $dbcon->set_charset("utf8mb4");
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

require_once('include/header.php');
?>
<!-- <script type="text/javascript">
	window.setInterval(function() {
		if (localStorage["page_reload"] == "1") {
			localStorage["page_reload"] = "0";
			var url = localStorage.getItem("page_url");
			window.location.reload(true);
			window.location.href = url;
			// alert("yup");
			// window.location.reload(true);
			<?php
			// $user_id  = $_SESSION['user_id'];
			// header("Refresh:0");
			// header("Location: ".$_SERVER['PHP_SELF']);
			// header('Location: '.$_SERVER['REQUEST_URI']);
			?>
		}
	}, 1);
</script> -->
<div class="row container-fluid">
	<!-- Left empty space for xl devices -->
	<div class="col-xl-1 d-none d-xl-block">
	</div>
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
			<div class="col-md-6 border-0 bg-transparent mt-3 d-sm-block d-lg-none mb-1 sm-device-ad">
				<div class="text-white advertisement music_advert mx-auto">
					<img src="img/advert.jpg" class="card-img" alt="...">
				</div>
			</div>
			<div class="col-md-6 border-0 bg-transparent mt-3 d-sm-block d-lg-none mb-1 sm-device-ad">
				<div class="text-white advertisement music_advert mx-auto">
					<img src="img/advert.jpg" class="card-img" alt="...">
				</div>
			</div>
		</div>

		<!-- Main Page Details -->
		<div class="row mt-4 mt-sm-0">
			<section class="section-MainContent pt-lg-5">
				<div class="row">
					<!-- Popular songs -->
					<div class="col-lg-2 d-none d-lg-block">
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
												$audio_pic = "$audio_pic";
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
							  <img src="../img/advert.jpg" class="card-img" alt="...">
							  <div class="card-img-overlay">
							    <h6 class="card-title text-center">Advertisement</h6>
							  </div>
							</div>
						</div> -->
					</div>
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

							$result_count = mysqli_query($dbcon, "SELECT COUNT(blog_id) As total_records FROM `music_blog` WHERE display_track='yes'");
							$total_records = mysqli_fetch_array($result_count);
							$total_records = $total_records['total_records'];
							$total_no_of_pages = ceil($total_records / $total_records_per_page);
							$second_last = $total_no_of_pages - 1; // total page minus 1

							$queryMusicBlog = "SELECT * FROM music_blog WHERE display_track='yes' ORDER BY date_added DESC LIMIT ?, ?";
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
										$musicBadge = "<span class='badge bg-success position-absolute top-0 start-0'>Music</span>";
									} elseif ($mime_type == "video") {
										$link = "video.php?mid=$file_id&aid=$artist_id";
										$musicBadge = "<span class='badge bg-primary position-absolute top-0 start-0'>Video</span>";
									} elseif ($mime_type == "album") {
										$link = "album.php?mid=$file_id&aid=$artist_id";
										$musicBadge = "<span class='badge bg-info text-dark position-absolute top-0 start-0'>Album</span>";
									} else {
										$link = "contactUs.php";
									}

									echo "<div class='col-md-6 middle-cols'>
				            <a class='' href='$link'>
				              <div class='card bg-dark text-white mb-3 artist-card position-relative module'>
				                <img src='$file_pic' class='card-img' alt='$file_name'> $musicBadge
				                <div class='card-img-overlay'>
				                  <span class='h5-span'><h5 class='card-title App_name text-center my-auto'>$artist_name - $file_name";
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
						        There are currently no Music check back later!.
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
									echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $previous_page .
										'"aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
								}

								// Make all the numbered pages:
								if ($total_no_of_pages <= 10) {
									for ($i = 1; $i <= $total_no_of_pages; $i++) {
										if ($i != $page_no) {
											echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '">' . $i . '</a></li>';
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
												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '">' . $i . '</a></li>';
											}
										}
										echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $second_last . '">' . $second_last . '</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a></li>';
									} elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 1 . '">' . 1 . '</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 2 . '">' . 2 . '</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
										for ($i = $page_no - $adjacents; $i <= $page_no + $adjacents; $i++) {
											if ($i == $page_no) {
												echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
											} else {
												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '">' . $i . '</a></li>';
											}
										}
										echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $second_last . '">' . $second_last . '</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $total_no_of_pages . '">' . $total_no_of_pages . '</a></li>';
									} else {
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 1 . '">' . 1 . '</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 2 . '">' . 2 . '</a></li>';
										echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
										for ($i = $total_no_of_pages - 6; $i <= $total_no_of_pages; $i++) {
											if ($i == $page_no) {
												echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
											} else {
												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '">' . $i . '</a></li>';
											}
										}
									}
								}

								// Create next link
								if ($page_no < $total_no_of_pages) {
									echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $next_page .
										'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
								}
								// if ($page_no < $total_no_of_pages) {
								//   echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $total_no_of_pages .
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
						<div class="card mt-4">
							<div class="text-white advertisement music_advert mx-auto">
								<img src="img/advert.jpg" class="card-img" alt="...">
							</div>
						</div>
						<div class="card mt-4">
							<div class="text-white advertisement music_advert mx-auto">
								<img src="img/advert.jpg" class="card-img" alt="...">
							</div>
						</div>
						<div class="card mt-4">
							<div class="text-white advertisement music_advert mx-auto">
								<img src="img/advert.jpg" class="card-img" alt="...">
							</div>
						</div>
						<div class="card mt-4 mb-lg-5">
							<div class="text-white advertisement music_advert mx-auto">
								<img src="img/advert.jpg" class="card-img" alt="...">
							</div>
						</div>
					</div>
				</div>
			</section>
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
<!-- <script type="text/javascript" src="../js/calamansi.min.js"></script> -->
<!-- cplayer audio plugin JS-->
<script src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>
<!-- AOS JS-->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript">
	AOS.init();
	// Ellipsis/clamp plugin(line-cutter)
	// $(".spotlight-body_msg1").line(13,'...');
	$(".news_msgHeader").line(3, '...');

	$(function() {
		$('.pagiClickLinkDisable').click(function(e) {
			e.preventDefault();
		});
	});

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

	// $('#spotlight-writeUp').ellipsis();

	// new Calamansi(document.querySelector('#calamansi-player-1'), {
	//   skin: '../calamansi-audio-skins/calamansi-compact',
	// 	loadTrackInfoOnPlay: false,
	// 	loop: true,
	//   playlists: {
	// 	  'My List': [
	//       {
	//         source: 'music/1.mp3',
	//       },
	//       {
	//         source: 'music/2.mp3',
	//       },
	// 			{
	//         source: 'music/3.mp3',
	//       },
	// 			{
	//         source: 'music/1.mp3',
	//       },
	//       {
	//         source: 'music/2.mp3',
	//       },
	// 			{
	//         source: 'music/3.mp3',
	//       },
	// 			{
	//         source: 'music/1.mp3',
	//       },
	//       {
	//         source: 'music/2.mp3',
	//       },
	// 			{
	//         source: 'music/3.mp3',
	//       },
	//     ],
	//   },
	//   defaultAlbumCover: '../calamansi-audio-skins/default-album-cover.png'
	// });

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