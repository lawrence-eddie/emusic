<?php require_once('include/admin_header.php'); ?>

<div class="container-fluid">
	<div class="row">
		<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="min-height:100vh;">
			<div class="sidebar-sticky pt-3">
				<!-- Beginning of Apps display/Modification -->
				<div class="list-group" id="applist-tab" role="tablist">
					<a class="dropdown-toggle card-link" data-toggle="collapse" href="#collapseApplication" role="button" aria-expanded="false" aria-controls="collapseApplication">
						Applications
					</a>
					<div class="collapse" id="collapseApplication">
						<div class="card card-body">
							<div class="nav flex-column nav-pills" id="appTab" role="tablist" aria-orientation="vertical">
								<a class="nav-link" id="displayApps-tab" data-toggle="pill" href="#displayApps" role="tab" aria-controls="displayApps" aria-selected="true">Apps</a>
								<a class="nav-link" id="appDev-tab" data-toggle="pill" href="#appDev" role="tab" aria-controls="appDev" aria-selected="false">App Developers</a>
								<div class="dropdown-divider"></div>
								<h6 class="dropdown-header">Modify applications</h6>
								<a class="nav-link" id="addApp-tab" data-toggle="pill" href="#addApp" role="tab" aria-controls="addApp" aria-selected="false">Add App</a>
								<a class="nav-link" id="addDev-tab" data-toggle="pill" href="#addDev" role="tab" aria-controls="addDev" aria-selected="false">Add Developer</a>
								<a class="nav-link" id="editApp-tab" data-toggle="pill" href="#editApp" role="tab" aria-controls="editApp" aria-selected="false">Edit App</a>
								<a class="nav-link" id="editDev-tab" data-toggle="pill" href="#editDev" role="tab" aria-controls="editDev" aria-selected="false">Edit Developer</a>
								<div class="dropdown-divider"></div>
								<a class="nav-link" id="deleteApp-tab" data-toggle="pill" href="#deleteApp" role="tab" aria-controls="deleteApp" aria-selected="false">Delete App</a>
								<a class="nav-link" id="deleteDev-tab" data-toggle="pill" href="#deleteDev" role="tab" aria-controls="deleteDev" aria-selected="false">Delete Developer</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Apps display/Modification -->

				<!-- Beginning of Blog Contents display/Modification -->
				<div class="list-group" id="blogCon-tab" role="tablist">
					<a class="dropdown-toggle card-link" data-toggle="collapse" href="#blogContents" role="button" aria-expanded="false" aria-controls="blogContents">
						Blog Contents
					</a>
					<div class="collapse" id="blogContents">
						<div class="card card-body">
							<div class="nav flex-column nav-pills" id="blogCon" role="tablist" aria-orientation="vertical">
								<a class="nav-link" id="displayPost-tab" data-toggle="pill" href="#displayPost" role="tab" aria-controls="displayPost" aria-selected="false">Post</a>
								<a class="nav-link" id="displayArtist-tab" data-toggle="pill" href="#displayArtist" role="tab" aria-controls="displayArtist" aria-selected="false">Artist</a>
								<a class="nav-link" id="displayAlbum-tab" data-toggle="pill" href="#displayAlbum" role="tab" aria-controls="displayAlbum" aria-selected="false">Album</a>
								<a class="nav-link" id="displayAudio-tab" data-toggle="pill" href="#displayAudio" role="tab" aria-controls="displayAudio" aria-selected="false">Audio</a>
								<a class="nav-link" id="displayVideo-tab" data-toggle="pill" href="#displayVideo" role="tab" aria-controls="displayVideo" aria-selected="false">Video</a>
								<div class="dropdown-divider"></div>
								<h6 class="dropdown-header">Modify Blog Contents</h6>
								<a class="nav-link" id="insertPost-tab" data-toggle="pill" href="#insertPost" role="tab" aria-controls="insertPost" aria-selected="false">Add Post</a>
								<a class="nav-link" id="insertArtist-tab" data-toggle="pill" href="#insertArtist" role="tab" aria-controls="insertArtist" aria-selected="false">Add Artist</a>
								<a class="nav-link" id="insertArtist_spotlight-tab" data-toggle="pill" href="#insertArtist_spotlight" role="tab" aria-controls="insertArtist_spotlight" aria-selected="false">Add Artist Spotlight</a>
								<a class="nav-link" id="insertAlbum-tab" data-toggle="pill" href="#insertAlbum" role="tab" aria-controls="insertAlbum" aria-selected="false">Add Album</a>
								<a class="nav-link" id="insertAudio-tab" data-toggle="pill" href="#insertAudio" role="tab" aria-controls="insertAudio" aria-selected="false">Add Audio</a>
								<a class="nav-link" id="insertVideo-tab" data-toggle="pill" href="#insertVideo" role="tab" aria-controls="insertVideo" aria-selected="false">Add Video</a>
								<a class="nav-link" id="insertGenre-tab" data-toggle="pill" href="#insertGenre" role="tab" aria-controls="insertGenre" aria-selected="false">Add Genre</a>
								<div class="dropdown-divider"></div>
								<a class="nav-link" id="editPost-tab" data-toggle="pill" href="#editPost" role="tab" aria-controls="editPost" aria-selected="false">Edit Post</a>
								<a class="nav-link" id="editArtist-tab" data-toggle="pill" href="#editArtist" role="tab" aria-controls="editArtist" aria-selected="false">Edit Artist</a>
								<a class="nav-link" id="editAudio-tab" data-toggle="pill" href="#editAudio" role="tab" aria-controls="editAudio" aria-selected="false">Edit Audio</a>
								<a class="nav-link" id="editAlbum-tab" data-toggle="pill" href="#editAlbum" role="tab" aria-controls="editAlbum" aria-selected="false">Edit Album</a>
								<div class="dropdown-divider"></div>
								<a class="nav-link" id="deletePost-tab" data-toggle="pill" href="#deletePost" role="tab" aria-controls="deletePost" aria-selected="false">Delete Post</a>
								<a class="nav-link" id="deleteArtist-tab" data-toggle="pill" href="#deleteArtist" role="tab" aria-controls="deleteArtist" aria-selected="false">Delete Artist</a>
								<a class="nav-link" id="deleteAlbum-tab" data-toggle="pill" href="#deleteAlbum" role="tab" aria-controls="deleteAlbum" aria-selected="false">Delete Album</a>
								<a class="nav-link" id="deleteAudio-tab" data-toggle="pill" href="#deleteAudio" role="tab" aria-controls="deleteAudio" aria-selected="false">Delete Audio</a>
								<a class="nav-link" id="deleteVideo-tab" data-toggle="pill" href="#deleteVideo" role="tab" aria-controls="deleteVideo" aria-selected="false">Delete Video</a>
								<a class="nav-link" id="deleteGenre-tab" data-toggle="pill" href="#deleteGenre" role="tab" aria-controls="deleteGenre" aria-selected="false">Delete Genre</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Blog Contents display/Modification -->

				<!-- Beginning of Admin messages display/Modification -->
				<div class="list-group" id="msglist-tab" role="tablist">
					<a class="dropdown-toggle card-link" data-toggle="collapse" href="#collapseAdminMsg" role="button" aria-expanded="false" aria-controls="collapseAdminMsg">
						Messages
					</a>
					<div class="collapse" id="collapseAdminMsg">
						<div class="card card-body">
							<div class="nav flex-column nav-pills" id="msgTab" role="tablist" aria-orientation="vertical">
								<a class="nav-link" id="adminMsg-tab" data-toggle="pill" href="#adminMsg" role="tab" aria-controls="adminMsg" aria-selected="false">Messages</a>
								<div class="dropdown-divider"></div>
								<h6 class="dropdown-header">Modify Messages</h6>
								<a class="nav-link" id="wrtMsg-tab" data-toggle="pill" href="#wrtMsg" role="tab" aria-controls="wrtMsg" aria-selected="false">Write Message</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Admin messages display/Modification -->

				<!-- Beginning of Users display/Modification -->
				<div class="list-group" id="userslist-tab" role="tablist">
					<a class="dropdown-toggle card-link" data-toggle="collapse" href="#collapseUsers" role="button" aria-expanded="false" aria-controls="collapseUsers">
						Users
					</a>
					<div class="collapse" id="collapseUsers">
						<div class="card card-body">
							<div class="nav flex-column nav-pills" id="userTab" role="tablist" aria-orientation="vertical"><?php if (!empty($userNoti)) echo '
									<a class="nav-link" id="newUsers-tab" data-toggle="pill" href="#newUsers" role="tab" aria-controls="newUsers" aria-selected="false">New Users</a>'; ?>
								<a class="nav-link" id="displayUsers-tab" data-toggle="pill" href="#displayUsers" role="tab" aria-controls="displayUsers" aria-selected="false">All Users</a>
								<a class="nav-link" id="faultyUsers-tab" data-toggle="pill" href="#faultyUsers" role="tab" aria-controls="faultyUsers" aria-selected="false">Users Other Info</a>
								<a class="nav-link" id="searchUsers-tab" data-toggle="pill" href="#searchUsers" role="tab" aria-controls="searchUsers" aria-selected="false">Search Users</a>
								<div class="dropdown-divider"></div>
								<h6 class="dropdown-header">Modify users</h6>
								<a class="nav-link" id="insertUsers-tab" data-toggle="pill" href="#insertUsers" role="tab" aria-controls="insertUsers" aria-selected="false">Insert Users</a>
								<a class="nav-link" id="editUsers-tab" data-toggle="pill" href="#editUsers" role="tab" aria-controls="editUsers" aria-selected="false">Edit Users</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Users display/Modification -->

				<!-- Beginning of Users testimonies display/Modification -->
				<div class="list-group" id="testimonylist-tab" role="tablist">
					<a class="dropdown-toggle card-link" data-toggle="collapse" href="#usersTestimonies" role="button" aria-expanded="false" aria-controls="usersTestimonies">
						Users Testimonies
					</a>
					<div class="collapse" id="usersTestimonies">
						<div class="card card-body">
							<div class="nav flex-column nav-pills" id="userTesTab" role="tablist" aria-orientation="vertical">
								<a class="nav-link" id="testimony-tab" data-toggle="pill" href="#testimony" role="tab" aria-controls="testimony" aria-selected="false">Testimonies</a>
								<a class="nav-link" id="unselectTestimony-tab" data-toggle="pill" href="#unselectTestimony" role="tab" aria-controls="unselectTestimony" aria-selected="false">----------</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End of Users testimonies display/Modification -->
			</div>
		</nav>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
			<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
				<div class="tab-content" id="tabContent">
					<!-- Beginning of Apps display/Modification -->
					<!-- /////////////////////////// DISPLAY APP TAB ///////////////////////////// -->
					<div class="tab-pane fade show active" id="displayApps" role="tabpanel" aria-labelledby="displayApps-tab">
						<?php
						try {
							// ERROR MESSAGES.......
							if (isset($errorstring)) {
								echo "<div class='alert alert-danger fade show' role='alert' id='errorstring'>$errorstring</div>";
								echo '<script type="text/javascript">
										window.setTimeout(function() {
											$("#errorstring").fadeTo(500, 0).slideUp(500, function(){
												$("#errorstring").alert("close");
											});
										}, 4000);
									</script>';
							} elseif (isset($sucstring)) { // SUCCESSFUL MESSAGES.......
								echo "<div class='alert alert-success fade show' role='alert' id='sucstring'>$sucstring</div>";
								echo '<script type="text/javascript">
										window.setTimeout(function() {
											$("#sucstring").fadeTo(500, 0).slideUp(500, function(){
												$("#sucstring").alert("close");
											});
										}, 4000);
									</script>';
							}

							$apps = mysqli_query($dbcon, "SELECT * FROM apps ORDER BY app_id");
							//$appNumber = mysqli_num_rows($apps);
							if (mysqli_num_rows($apps) > 0) {
						?>
								<div class='card shadow'>
									<table class="table table-responsive">
										<thead class="thead-light">
											<tr>
												<th scope="col">#</th>
												<th scope="col">App Image</th>
												<th scope="col">App Name</th>
												<th scope="col">App Rating(AVG)</th>
												<th scope="col">App Link</th>
											</tr>
										</thead>
								<?php
								$appRow = 1;
								while ($fetch_apps = mysqli_fetch_assoc($apps)) {
									// fetch the records
									$app_id   = $purifier->purify($fetch_apps['app_id']);
									$app_name = $purifier->purify($fetch_apps['app_name']);
									$app_pic  = $purifier->purify($fetch_apps['app_pic']);
									$app_url  = $purifier->purify($fetch_apps['app_url']);
									$app_pic = "../" . $app_pic;
									// $app_url = "../" . $app_url;
									$app_url = "../";

									// Get app rating average
									$queryapp_rating = mysqli_query($dbcon, "SELECT ROUND(AVG(rating),1) AS averageRating, COUNT(user_id) As totalRating FROM app_rating WHERE app_id=$app_id");
									if (mysqli_num_rows($queryapp_rating) > 0) {
										$fetchAverage = mysqli_fetch_assoc($queryapp_rating);
										$averageRating = $purifier->purify($fetchAverage['averageRating']);
										$totalRating = $purifier->purify($fetchAverage['totalRating']);
										$totalRating = (!empty($totalRating)) ? "<br><span class='text-info'><i class='far fa-user'></i> $totalRating</span>" : "totalrat";
									} else {
										$averageRating = "No rating for this app yet.";
										$totalRating = "";
									}

									echo '<tbody>
								    <tr>
								      <th scope="row">' . $appRow . '</th>
											<td><img src=' . $app_pic . ' alt=' . $app_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
								      <td><span class="text-primary">' . $app_name . '</span></td>
											<td>' . $averageRating . '' . $totalRating . '</td>
											<td><a href="' . $app_url . '" class="card-link">Visit app</a></td>
								    </tr>
								  </tbody>';
									$appRow++;
								}
								echo "</table>";
								echo "</div>";
							} else {
								echo '<div class="card">
									  <div class="card-body">
									    There are currently no apps.
									  </div>
									</div>';
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
								<!-- /////////////////////////// DISPLAY APP DEVELOPERS TAB ///////////////////////////// -->
								<div class="tab-pane fade" id="appDev" role="tabpanel" aria-labelledby="appDev-tab">
									<?php
									try {
										$app_dev = mysqli_query($dbcon, "SELECT app_dev_id, CONCAT_WS(' ', app_dev_first_name, app_dev_last_name) as app_dev_name, app_dev_pic, mobile, email FROM app_dev ORDER BY app_dev_id");
										if (mysqli_num_rows($app_dev) > 0) {
									?>
											<div class='card shadow'>
												<table class="table table-responsive">
													<thead class="thead-light">
														<tr>
															<th scope="col">#</th>
															<th scope="col">App Dev Name</th>
															<th scope="col">App Dev Image</th>
															<th scope="col">Mobile</th>
															<th scope="col">Email</th>
															<th scope="col"></th>
														</tr>
													</thead>
											<?php
											$TabNum = 1;
											while ($fetch_app_dev = mysqli_fetch_assoc($app_dev)) {
												// fetch the records
												$app_dev_id = $purifier->purify($fetch_app_dev['app_dev_id']);
												$app_dev_name = $purifier->purify($fetch_app_dev['app_dev_name']);
												$app_dev_pic   = $purifier->purify($fetch_app_dev['app_dev_pic']);
												$app_dev_mobile   = $purifier->purify($fetch_app_dev['mobile']);
												$app_dev_email = $purifier->purify($fetch_app_dev['email']);
												$app_dev_pic = "../" . $app_dev_pic;

												echo '<tbody>
								    <tr>
								      <th scope="row">' . $TabNum . '</th>
											<td>' . $app_dev_name . '</td>
											<td><img src=' . $app_dev_pic . ' alt=' . $app_dev_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
											<td>' . $app_dev_mobile . '</td>
											<td>' . $app_dev_email . '</td>
											<td>';

												// Select app image
												$apps = mysqli_query($dbcon, "SELECT app_name, app_pic, app_url FROM apps WHERE app_dev_id=$app_dev_id");
												// Check the result:
												if (mysqli_num_rows($apps) > 0) {
													echo '<tr>
											<th scope="col">App Image</th>
											<th scope="col">App Name</th>
											<th scope="col">App Link</th>
											</tr>';
													while ($fetch_apps = mysqli_fetch_assoc($apps)) {
														// Fetch the records
														$app_name = $purifier->purify($fetch_apps['app_name']);
														$app_pic  = $purifier->purify($fetch_apps['app_pic']);
														$app_url  = $purifier->purify($fetch_apps['app_url']);
														$app_pic = "../" . $app_pic;
														$app_url = "../" . $app_url;

														echo '<tr>
												<td><img src=' . $app_pic . ' alt=' . $app_name . ' class="img-thumbnail" style="height:64px; width:64px;"></td>
									      <td>' . $app_name . '</td>
												<td><a href="' . $app_url . '" class="card-link">Visit app</a></td>
												</tr>';
													}
												}
												echo '</td>
								    </tr>
								  </tbody>';
												$TabNum++;
											}
											echo "</table>";
											echo "</div>";
										} else {
											echo '<div class="card">
									  <div class="card-body">
									    There are currently no app developer.
									  </div>
									</div>';
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
											<!-- /////////////////////////// ADD APP TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="addApp" role="tabpanel" aria-labelledby="addApp-tab">
												<?php
												try {
												?>
													<div class='card shadow'>
														<div class="card-header">
															<h5 class="card-title text-center font-weight-bolder text-primary">ADD APP</h5>
														</div>
														<form class="" action="" method="post" enctype='multipart/form-data'>
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Select Developer:</label>
																		<?php // Select app developer details
																		$app_dev = mysqli_query($dbcon, "SELECT app_dev_id, CONCAT_WS(' ', app_dev_first_name, app_dev_last_name) as app_dev_name FROM app_dev ORDER BY app_dev_id");
																		// Check the result:
																		if (mysqli_num_rows($app_dev) > 0) {
																			echo "<select class='form-control' name='select_app_dev' required>";
																			// echo "<option value=''>Select Developer</option>";
																			// fetch the records
																			while ($fetch_app_dev = mysqli_fetch_assoc($app_dev)) {
																				$app_dev_id = $purifier->purify($fetch_app_dev['app_dev_id']);
																				$app_dev_name = $purifier->purify($fetch_app_dev['app_dev_name']);

																				echo "<option value='$app_dev_id'>$app_dev_name</option>";
																			}
																			echo "</select>";
																		} else {
																			echo '<select class="form-control">
            										<option>No developer</option>
            									</select>';
																		}
																		?>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="app_name" class="font-weight-bolder">App Name:</label>
																		<input type="text" class="form-control" id="app_name" name="app_name" placeholder="App name" autocomplete="on" required>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">App Image (Required):</label>
																		<div class="custom-file">
																			<input type="file" class="custom-file-input" id="app_image" name="app_image" required>
																			<label class="custom-file-label" for="app_image">Upload image...</label>
																		</div>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">App Video Demo?:</label>
																		<div class="custom-file">
																			<input type="file" class="custom-file-input" id="app_demo" name="app_demo">
																			<label class="custom-file-label" for="app_demo">Upload video...</label>
																		</div>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-3"></div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Preview Image:</label>
																		<div class="card bg-dark text-white post_pic_prevCon">
																			<img src="" class="card-img" alt="Preview image" id="image_prev">
																		</div>
																	</div>
																	<div class="form-group col-md-3"></div>
																</div>
															</div>
															<div class="card-footer">
																<input type='submit' class='btn emc_btn btn-sm btn-block add_app rounded-pill' id='add_app' name='add_app' value='Add App'>
															</div>
														</form>
													</div>
													<script type="text/javascript">
														document.addEventListener('DOMContentLoaded', function() {
															function readURL(input) {
																if (input.files && input.files[0]) {
																	var reader = new FileReader();

																	reader.onload = function(e) {
																		$('#image_prev').attr('src', e.target.result);
																	}

																	reader.readAsDataURL(input.files[0]); // convert to base64 string
																}
															}

															$("#app_image").change(function() {
																readURL(this);
															});
														});
													</script>
												<?php
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
											<!-- /////////////////////////// EDIT APP TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="editApp" role="tabpanel" aria-labelledby="editApp-tab">
												<?php
												try {
												?>
													<div class='card shadow'>
														<div class="card-header">
															<h5 class="card-title text-center font-weight-bolder text-primary">EDIT APP</h5>
														</div>
														<form class="" action="" method="post" enctype="multipart/form-data">
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Select App:</label>
																		<?php // Select app details
																		$apps = mysqli_query($dbcon, "SELECT * FROM apps ORDER BY app_id");
																		// Check the result:
																		if (mysqli_num_rows($apps) > 0) {
																			echo "<select class='form-control' name='select_app' required>";
																			// fetch the records
																			while ($fetch_apps = mysqli_fetch_assoc($apps)) {
																				// fetch the records
																				$app_id   = $purifier->purify($fetch_apps['app_id']);
																				$app_name = $purifier->purify($fetch_apps['app_name']);

																				echo "<option value='$app_id'>$app_name</option>";
																			}
																			echo "</select>";
																		} else {
																			echo '<select class="form-control">
              								<option>No app</option>
              							</select>';
																		}
																		?>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="edit_app_name" class="font-weight-bolder">Edit App Name?:</label>
																		<input type="text" class="form-control" id="edit_app_name" name="edit_app_name" placeholder="App name" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Change App Image?:</label>
																		<div class="custom-file">
																			<input type="file" class="custom-file-input" id="edit_app_image" name="edit_app_image" required>
																			<label class="custom-file-label" for="edit_app_image">Upload image...</label>
																		</div>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Change App Demo?:</label>
																		<div class="custom-file">
																			<input type="file" class="custom-file-input" id="edit_app_demo" name="edit_app_demo">
																			<label class="custom-file-label" for="edit_app_demo">Upload video...</label>
																		</div>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-3"></div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Preview Image:</label>
																		<div class="card bg-dark text-white post_pic_prevCon">
																			<img src="" class="card-img" alt="Preview image" id="edit_image_prev">
																		</div>
																	</div>
																	<div class="form-group col-md-3"></div>
																</div>
															</div>
															<div class="card-footer">
																<input type='submit' class='btn emc_btn btn-sm btn-block edit_app rounded-pill' id='edit_app' name='edit_app' value='Edit App'>
															</div>
														</form>
													</div>
													<script type="text/javascript">
														document.addEventListener('DOMContentLoaded', function() {
															function readURL(input) {
																if (input.files && input.files[0]) {
																	var reader = new FileReader();

																	reader.onload = function(e) {
																		$('#edit_image_prev').attr('src', e.target.result);
																	}

																	reader.readAsDataURL(input.files[0]); // convert to base64 string
																}
															}

															$("#edit_app_image").change(function() {
																readURL(this);
															});
														});
													</script>
												<?php
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
											<!-- /////////////////////////// DELETE APP TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="deleteApp" role="tabpanel" aria-labelledby="deleteApp-tab">
												<?php
												try {
												?>
													<div class='card shadow'>
														<div class="card-header">
															<h5 class="card-title text-center font-weight-bolder text-primary">DELETE APP</h5>
														</div>
														<form class="" action="index.php" method="post">
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="deleteAppSelect" class="font-weight-bolder">Select App:</label>
																		<?php // Select app details
																		$apps = mysqli_query($dbcon, "SELECT * FROM apps ORDER BY app_id");
																		// Check the result:
																		if (mysqli_num_rows($apps) > 0) {
																			echo "<select class='form-control' id='deleteAppSelect' name='select_app' required>
            											<option value=''>Select App</option>";
																			while ($fetch_apps = mysqli_fetch_assoc($apps)) {
																				// fetch the records
																				$app_id   = $purifier->purify($fetch_apps['app_id']);
																				$app_name = $purifier->purify($fetch_apps['app_name']);

																				echo "<option value='$app_id' data-appName='$app_name'>$app_name</option>";
																			}
																			echo "</select>";
																		}
																		?>
																	</div>
																	<div class="form-group col-md-6">
																		<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																		<p class='text-muted'>Deleting this app will remove everything affiliated with the app both from the database and its directiory!</p>
																	</div>
																</div>
															</div>
															<div class="card-footer">
																<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteAppModalButton' data-toggle='modal' data-target=''>Delete App</button>
															</div>
															<div class="modal fade deleteApp-modal" id="" tabindex="-1" aria-labelledby="deleteApp-modalLabel" aria-hidden="true" role="dialog">
																<div class="modal-dialog" role="document">
																	<div class="modal-content card border-danger">
																		<div class="modal-header">
																			<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																			<h6 class="modal-title" id="deleteApp-modalLabel">Are you sure you want to delete <b class="appNameInject" style="color:blue;"></b> app.
																				<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																			</h6>
																		</div>
																		<div class="modal-body content-justify-center text-center">
																			<input type='submit' class='btn emc_btn btn-sm delete_app rounded-pill' id='delete_app' name='delete_app' value='Proceed'>
																			<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																		</div>
																	</div>
																</div>
															</div>
															<script type="text/javascript">
																document.addEventListener('DOMContentLoaded', function() {
																	$("#deleteAppSelect").change(function() {
																		var selectedVal = $("#deleteAppSelect option:selected").val();
																		if (selectedVal == "") {
																			$("#deleteAppModalButton").attr("data-target", "");
																		} else {
																			var appName = $("#deleteAppSelect option:selected").attr("data-appName");
																			$("#deleteAppModalButton").attr("data-target", "#deleteApp-modal_" + selectedVal);
																			$(".deleteApp-modal").attr("id", "deleteApp-modal_" + selectedVal);
																			$("#deleteApp-modalLabel b.appNameInject").text(appName);
																		}
																	});
																});
															</script>
														</form>
													</div>
												<?php
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
											<!-- /////////////////////////// ADD APP DEVELOPER TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="addDev" role="tabpanel" aria-labelledby="addDev-tab">
												<?php
												try {
												?>
													<div class='card shadow'>
														<div class="card-header">
															<h5 class="card-title text-center font-weight-bolder text-primary">ADD DEVELOPER</h5>
														</div>
														<form class="" action="" method="post" enctype="multipart/form-data">
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="app_dev_first_name" class="font-weight-bolder">Developer's First Name:</label>
																		<input type="text" class="form-control" id="app_dev_first_name" name="app_dev_first_name" placeholder="First name" autocomplete="on" required>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="app_dev_last_name" class="font-weight-bolder">Developer's Last Name:</label>
																		<input type="text" class="form-control" id="app_dev_last_name" name="app_dev_last_name" placeholder="Last name" autocomplete="on" required>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="app_dev_desc" class="font-weight-bolder">Developer's Description:</label>
																		<textarea class='expanding form-control app_dev_desc' spellcheck='true' name='app_dev_desc' id="app_dev_desc" maxlength='200' placeholder='Describe developer!' rows='1' required></textarea>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="app_dev_lang" class="font-weight-bolder">Computer/Programming language(s):</label>
																		<input class="form-control" id="app_dev_lang" name="app_dev_lang" type="text" value="" spellcheck="true" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="app_dev_framework" class="font-weight-bolder">CMS/Framework/Library?:</label>
																		<input class="form-control" id="app_dev_framework" name="app_dev_framework" type="text" value="" spellcheck="true" autocomplete="on">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="app_dev_mobile" class="font-weight-bolder">Developers Mobile:</label>
																		<input type="tel" class="form-control" id="app_dev_mobile" name="app_dev_mobile" placeholder="Mobile" autocomplete="on" required>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="app_dev_email" class="font-weight-bolder">Developers Email:</label>
																		<input type="email" class="form-control" id="app_dev_email" name="app_dev_email" placeholder="Email" autocomplete="on" required>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="app_dev_twitter_un" class="font-weight-bolder">Twitter <small>Exclude @ from username</small>?:</label>
																		<input type="text" class="form-control" id="app_dev_twitter_un" name="app_dev_twitter_un" placeholder="Twitter username" autocomplete="on">
																		<input type="text" class="form-control" id="app_dev_twitter_id" name="app_dev_twitter_id" placeholder="Twitter user ID" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="app_dev_facebook" class="font-weight-bolder">Facebook?:</label><br><br>
																		<input type="text" class="form-control" id="app_dev_facebook" name="app_dev_facebook" placeholder="Facebook account" autocomplete="on">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="app_dev_whatsapp" class="font-weight-bolder">Whatsapp <small class="textnowrap">Use:1XXXXXXXXXX. Don't use: +001-(XXX)XXXXXXX</small>:</label>
																		<input type="text" class="form-control" id="app_dev_whatsapp" name="app_dev_whatsapp" placeholder="Whatsapp number" autocomplete="on">
																	</div>
																</div>
																<div class="form-group">
																	<label for="" class="font-weight-bolder">Developer's Image:</label>
																	<div class="custom-file">
																		<input type="file" class="custom-file-input" id="app_dev_image" name="app_dev_image" required>
																		<label class="custom-file-label" for="app_dev_image">Upload image...</label>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-3"></div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Preview Image:</label>
																		<div class="card bg-dark text-white post_pic_prevCon">
																			<img src="" class="card-img" alt="Preview image" id="app_dev_image_prev">
																		</div>
																	</div>
																	<div class="form-group col-md-3"></div>
																</div>
															</div>
															<div class="card-footer">
																<input type='submit' class='btn emc_btn btn-sm btn-block add_app_dev rounded-pill' id='add_app_dev' name='add_app_dev' value='Add Developer'>
															</div>
														</form>
													</div>
													<script type="text/javascript">
														document.addEventListener('DOMContentLoaded', function() {
															function readURL(input) {
																if (input.files && input.files[0]) {
																	var reader = new FileReader();

																	reader.onload = function(e) {
																		$('#app_dev_image_prev').attr('src', e.target.result);
																	}

																	reader.readAsDataURL(input.files[0]); // convert to base64 string
																}
															}

															$("#app_dev_image").change(function() {
																readURL(this);
															});

															$('#app_dev_lang').tagsInput({
																// custom placeholder
																placeholder: 'Programming language(s)',
																// width:'250px',
																'autocomplete': {
																	source: [
																		'PHP',
																		'PYTHON',
																		'C',
																		'C++',
																		'C#',
																		'RUBY',
																		'JAVASCRIPT',
																		'JAVA',
																		'MYSQL'
																	]
																}
															});
															$('#app_dev_framework').tagsInput({
																// custom placeholder
																placeholder: 'CMS/Framework/Library',
																// width:'250px',
																'autocomplete': {
																	source: [
																		'BOOTSTRAP',
																		'RUBY ON RAILS',
																		'WORDPRESS',
																		'DJANGO',
																		'JQUERY',
																		'VUE.JS',
																		'REACT',
																		'REACTNATIVE'
																	]
																}
															});
														});
													</script>
												<?php
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
											<!-- /////////////////////////// EDIT APP DEVELOPER TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="editDev" role="tabpanel" aria-labelledby="editDev-tab">
												<?php
												try {
												?>
													<div class='card shadow'>
														<div class="card-header">
															<h5 class="card-title text-center font-weight-bolder text-primary">EDIT APP DEVELOPER</h5>
														</div>
														<form class="" action="" method="post" enctype="multipart/form-data">
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Select Developer:</label>
																		<?php // Select app developer details
																		$app_dev = mysqli_query($dbcon, "SELECT app_dev_id, CONCAT_WS(' ', app_dev_first_name, app_dev_last_name) as app_dev_name FROM app_dev ORDER BY app_dev_id");
																		// Check the result:
																		if (mysqli_num_rows($app_dev) > 0) {
																			echo "<select class='form-control' name='select_app_dev' required>";
																			// fetch the records
																			while ($fetch_app_dev = mysqli_fetch_assoc($app_dev)) {
																				$app_dev_id = $purifier->purify($fetch_app_dev['app_dev_id']);
																				$app_dev_name = $purifier->purify($fetch_app_dev['app_dev_name']);

																				echo "<option value='$app_dev_id'>$app_dev_name</option>";
																			}
																			echo "</select>";
																		} else {
																			echo '<select class="form-control">
            									<option>No developer</option>
            								</select>';
																		}
																		?>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_first_name" class="font-weight-bolder">Edit First Name?:</label>
																		<input type="text" class="form-control" id="edit_app_dev_first_name" name="edit_app_dev_first_name" placeholder="Change First name" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_last_name" class="font-weight-bolder">Edit Last Name?:</label>
																		<input type="text" class="form-control" id="edit_app_dev_last_name" name="edit_app_dev_last_name" placeholder="Change Last name" autocomplete="on">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_desc" class="font-weight-bolder">Edit Description?:</label>
																		<textarea class='expanding form-control edit_app_dev_desc' spellcheck='true' name='edit_app_dev_desc' id="edit_app_dev_desc" maxlength='200' placeholder='Describe developer!' rows='1'></textarea>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_lang" class="font-weight-bolder">Computer/Programming language(s)?:</label>
																		<input class="form-control" id="edit_app_dev_lang" name="edit_app_dev_lang" type="text" value="" spellcheck="true" autocomplete="on">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_framework" class="font-weight-bolder">CMS/Framework/Library?:</label>
																		<input class="form-control" id="edit_app_dev_framework" name="edit_app_dev_framework" type="text" value="" spellcheck="true" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_mobile" class="font-weight-bolder">Change Mobile?:</label>
																		<input type="tel" class="form-control" id="edit_app_dev_mobile" name="edit_app_dev_mobile" placeholder="Edit mobile" autocomplete="on">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_email" class="font-weight-bolder">Change Email?:</label>
																		<input type="email" class="form-control" id="edit_app_dev_email" name="edit_app_dev_email" placeholder="Edit email" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_twitter_un" class="font-weight-bolder">Twitter <small>Exclude @ from username</small>?:</label>
																		<input type="text" class="form-control" id="edit_app_dev_twitter_un" name="edit_app_dev_twitter_un" placeholder="Twitter username" autocomplete="on">
																		<input type="text" class="form-control" id="edit_app_dev_twitter_id" name="edit_app_dev_twitter_id" placeholder="Twitter user ID" autocomplete="off"></td>
																	</div>
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_facebook" class="font-weight-bolder">Facebook?:</label>
																		<input type="text" class="form-control" id="edit_app_dev_facebook" name="edit_app_dev_facebook" placeholder="Facebook account" autocomplete="on">
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="edit_app_dev_whatsapp" class="font-weight-bolder">Whatsapp <small>Use:1XXXXXXXXXX. Don't use: +001-(XXX)XXXXXXX</small>?:</label>
																		<input type="text" class="form-control" id="edit_app_dev_whatsapp" name="edit_app_dev_whatsapp" placeholder="Whatsapp number" autocomplete="on">
																	</div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Change Developer's Image(Required):</label>
																		<div class="custom-file">
																			<input type="file" class="custom-file-input" id="edit_app_dev_image" name="edit_app_dev_image" required>
																			<label class="custom-file-label" for="edit_app_dev_image">Upload image...</label>
																		</div>
																	</div>
																</div>
																<div class="form-row">
																	<div class="form-group col-md-3"></div>
																	<div class="form-group col-md-6">
																		<label for="" class="font-weight-bolder">Preview Image:</label>
																		<div class="card bg-dark text-white post_pic_prevCon">
																			<img src="" class="card-img" alt="Preview image" id="edit_app_dev_image_prev">
																		</div>
																	</div>
																	<div class="form-group col-md-3"></div>
																</div>
															</div>
															<div class="card-footer">
																<input type='submit' class='btn emc_btn btn-sm btn-block edit_app_dev rounded-pill' id='edit_app_dev' name='edit_app_dev' value='Edit App Dev'>
															</div>
														</form>
													</div>
													<script type="text/javascript">
														document.addEventListener('DOMContentLoaded', function() {
															function readURL(input) {
																if (input.files && input.files[0]) {
																	var reader = new FileReader();

																	reader.onload = function(e) {
																		$('#edit_app_dev_image_prev').attr('src', e.target.result);
																	}

																	reader.readAsDataURL(input.files[0]); // convert to base64 string
																}
															}

															$("#edit_app_dev_image").change(function() {
																readURL(this);
															});

															$('#edit_app_dev_lang').tagsInput({
																// custom placeholder
																placeholder: 'Programming language(s)',
																// width:'250px',
																'autocomplete': {
																	source: [
																		'PHP',
																		'PYTHON',
																		'C',
																		'C++',
																		'C#',
																		'RUBY',
																		'JAVASCRIPT',
																		'JAVA',
																		'MYSQL'
																	]
																}
															});
															$('#edit_app_dev_framework').tagsInput({
																// custom placeholder
																placeholder: 'CMS/Framework/Library',
																// width:'250px',
																'autocomplete': {
																	source: [
																		'BOOTSTRAP',
																		'RUBY ON RAILS',
																		'WORD PRESS',
																		'DJANGO',
																		'JQUERY',
																		'VUE.JS',
																		'REACT'
																	]
																}
															});
														});
													</script>
												<?php
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
											<!-- /////////////////////////// DELETE APP DEVELOPER TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="deleteDev" role="tabpanel" aria-labelledby="deleteDev-tab">
												<?php
												try {
												?>
													<div class='card shadow'>
														<div class="card-header">
															<h5 class="card-title text-center font-weight-bolder text-primary">DELETE DEVELOPER</h5>
														</div>
														<form class="" action="index.php" method="post" enctype='multipart/form-data'>
															<div class="card-body">
																<div class="form-row">
																	<div class="form-group col-md-6">
																		<label for="deleteAppDevSelect" class="font-weight-bolder">Select Developer:</label>
																		<?php // Select app developer
																		$queryDelAppDev = mysqli_query($dbcon, "SELECT app_dev_id, CONCAT_WS(' ', app_dev_first_name, app_dev_last_name) as app_dev_name FROM app_dev");
																		// Check the result:
																		if (mysqli_num_rows($queryDelAppDev) > 0) {
																			echo "<select class='form-control' id='deleteAppDevSelect' name='select_app_dev' required>
  																<option value=''>Select Developer</option>";
																			while ($fetch_app_dev = mysqli_fetch_assoc($queryDelAppDev)) {
																				// fetch the records
																				$app_dev_id   = $purifier->purify($fetch_app_dev['app_dev_id']);
																				$app_dev_name = $purifier->purify($fetch_app_dev['app_dev_name']);

																				echo "<option value='$app_dev_id' data-appDevName='$app_dev_name'>$app_dev_name</option>";
																			}
																			echo "</select>";
																		} else echo "<div class='card-text'>There are no developers yet!</div>";
																		?>
																	</div>
																	<div class="form-group col-md-6">
																		<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																		<p class='text-muted'>Deleting this developer will remove everything affiliated with the developer both from the database and its directiory!</p>
																	</div>
																</div>
															</div>
															<div class="card-footer">
																<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteAppDevModalButton' data-toggle='modal' data-target=''>Delete Developer</button>
															</div>
															<div class="modal fade deleteAppDev-modal" id="" tabindex="-1" aria-labelledby="deleteAppDev-modalLabel" aria-hidden="true" role="dialog">
																<div class="modal-dialog" role="document">
																	<div class="modal-content card border-danger">
																		<div class="modal-header">
																			<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																			<h6 class="modal-title" id="deleteAppDev-modalLabel">Are you sure you want to delete <b class="appDevNameInject" style="color:blue;"></b>.
																				<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																			</h6>
																		</div>
																		<div class="modal-body content-justify-center text-center">
																			<input type='submit' class='btn emc_btn btn-sm delete_appDev rounded-pill' id='delete_appDev' name='delete_appDev' value='Proceed'>
																			<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																		</div>
																	</div>
																</div>
															</div>
															<script type="text/javascript">
																document.addEventListener('DOMContentLoaded', function() {
																	$("#deleteAppDevSelect").change(function() {
																		var selectedVal = $("#deleteAppDevSelect option:selected").val();
																		if (selectedVal == "") {
																			$("#deleteAppDevModalButton").attr("data-target", "");
																		} else {
																			var appDevName = $("#deleteAppDevSelect option:selected").attr("data-appDevName");
																			$("#deleteAppDevModalButton").attr("data-target", "#deleteAppDev-modal_" + selectedVal);
																			$(".deleteAppDev-modal").attr("id", "deleteAppDev-modal_" + selectedVal);
																			$("#deleteAppDev-modalLabel b.appDevNameInject").text(appDevName);
																		}
																	});
																});
															</script>
														</form>
													</div>
												<?php
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
											<!-- End of Apps Modification -->


											<!-- Beginning of Post, Artist, Album, Audio, Video, Genre display/Modification -->
											<!-- /////////////////////////// DISPLAY POST TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="displayPost" role="tabpanel" aria-labelledby="displayPost-tab">
												<?php
												try { // Count number of post for display in form
													$countAdminPostNum = mysqli_query($dbcon, "SELECT admin_post_num FROM post WHERE admin_post_num IS NOT NULL");
													$countAdminPostNum_result = mysqli_num_rows($countAdminPostNum);
													if ($countAdminPostNum_result > 0) {
														echo "<div class='card mb-1'>
															<div class='card-header'>Total Posts: $countAdminPostNum_result</div>
															</div>";
													}

													// set the number of rows per display page
													$AdminPostpagerows = 5;
													// Has the totla number of pages already been calculated?
													if (isset($_GET['Ap'])) {
														$AdminPostPages = filter_var($_GET['Ap'], FILTER_SANITIZE_NUMBER_INT);
													} else { // use the next block of code to calculate the number of pages
														// First, check for the total number of records
														$countAdminPost = "SELECT COUNT(admin_post_num) FROM post WHERE admin_post_num IS NOT NULL";
														$countAdminPost_result = mysqli_query($dbcon, $countAdminPost);
														$fetch_countAdminPost = mysqli_fetch_array($countAdminPost_result, MYSQLI_NUM);
														$Adminrecords = htmlspecialchars($fetch_countAdminPost[0], ENT_QUOTES);
														// Now calculate the number of pages
														if ($Adminrecords > $AdminPostpagerows) {
															// If the number of records will fill more than one page
															// calculate the number of pages and round the result up to the nearest integer
															$AdminPostPages = ceil($Adminrecords / $AdminPostpagerows);
														} else {
															$AdminPostPages = 1;
														}
													} // page check finished

													// Declare which record to start with
													if ((isset($_GET['As']))) {
														$AdminPostStart = filter_var($_GET['As'], FILTER_SANITIZE_NUMBER_INT);
														// Make sure it is not executable XSS
													} else {
														$AdminPostStart = 0;
													}

													// Make the query
													$queryPost = "SELECT post.admin_post_num, post.admin_post_dir, post.msg_header, post.post_msg, post.post_msg_2,
													post.post_msg_3, post.post_pic, post.post_audio, post.post_video, post.youtube_url, post.tag_users, DATE_FORMAT(post.date_time, '%d %M, %Y %r') AS date_time,
													post_pic.post_pic_1, post_pic.post_pic_2, post_pic.post_pic_3, post_pic.post_pic_4, post_pic.post_pic_5, post_pic.post_pic_6, post_pic.post_pic_7,
													post_pic.post_pic_8, post_pic.post_pic_9, post_pic.post_pic_10, post_pic.post_pic_11, post_pic.post_pic_12, post_pic.post_pic_13, post_pic.post_pic_14,
													post_pic.post_pic_15 FROM post LEFT JOIN post_pic ON post.post_id=post_pic.post_id WHERE post.admin_post_dir IS NOT NULL ORDER BY post.post_id DESC LIMIT ?, ?";
													$q = mysqli_stmt_init($dbcon);
													mysqli_stmt_prepare($q, $queryPost);
													// use prepared statement to ensure that only text is inserted
													// bind fields to SQL statement
													mysqli_stmt_bind_param($q, 'ii', $AdminPostStart, $AdminPostpagerows);
													// execute the query
													mysqli_stmt_execute($q);
													$queryAdminPost_result = mysqli_stmt_get_result($q);

													// check for result
													if (mysqli_num_rows($queryAdminPost_result) > 0) { ?>
														<div class='card shadow'>
															<table class="table table-responsive">
																<thead class="thead-light">
																	<tr>
																		<th scope="col">#</th>
																		<th scope="col">Message Article</th>
																		<th scope="col" style='min-width:150px;'>Main Image</th>
																		<th scope="col">Audio</th>
																		<th scope="col">Video</th>
																		<th scope="col">Youtube Url</th>
																		<th scope="col">Tagged Posts</th>
																		<th scope="col">Date/Time_Sent</th>
																		<th scope="col">Post Directiory</th>
																		<th style="width:100%"></th>
																	</tr>
																</thead>
																<?php
																$AdminPostRow = $AdminPostStart = 1;
																while ($fetch_AdminPost = mysqli_fetch_assoc($queryAdminPost_result)) {
																	// fetch the records
																	$adminPostDir  = $purifier->purify($fetch_AdminPost['admin_post_dir']);
																	$msgHeader  = $purifier->purify($fetch_AdminPost['msg_header']);
																	$post_msg  = $purifier->purify($fetch_AdminPost['post_msg']);
																	$post_msg_2  = $purifier->purify($fetch_AdminPost['post_msg_2']);
																	$post_msg_3  = $purifier->purify($fetch_AdminPost['post_msg_3']);
																	$post_pic  = $purifier->purify($fetch_AdminPost['post_pic']);
																	$post_audio  = $purifier->purify($fetch_AdminPost['post_audio']);
																	$post_video  = $purifier->purify($fetch_AdminPost['post_video']);
																	$youtube_url  = $purifier->purify($fetch_AdminPost['youtube_url']);
																	$tagged_post  = $purifier->purify($fetch_AdminPost['tag_users']);
																	$date_time  = $purifier->purify($fetch_AdminPost['date_time']);
																	$post_pic_1  = $purifier->purify($fetch_AdminPost['post_pic_1']);
																	$post_pic_2  = $purifier->purify($fetch_AdminPost['post_pic_2']);
																	$post_pic_3  = $purifier->purify($fetch_AdminPost['post_pic_3']);
																	$post_pic_4  = $purifier->purify($fetch_AdminPost['post_pic_4']);
																	$post_pic_5  = $purifier->purify($fetch_AdminPost['post_pic_5']);
																	$post_pic_6  = $purifier->purify($fetch_AdminPost['post_pic_6']);
																	$post_pic_7  = $purifier->purify($fetch_AdminPost['post_pic_7']);
																	$post_pic_8  = $purifier->purify($fetch_AdminPost['post_pic_8']);
																	$post_pic_9  = $purifier->purify($fetch_AdminPost['post_pic_9']);
																	$post_pic_10  = $purifier->purify($fetch_AdminPost['post_pic_10']);
																	$post_pic_11  = $purifier->purify($fetch_AdminPost['post_pic_11']);
																	$post_pic_12  = $purifier->purify($fetch_AdminPost['post_pic_12']);
																	$post_pic_13  = $purifier->purify($fetch_AdminPost['post_pic_13']);
																	$post_pic_14  = $purifier->purify($fetch_AdminPost['post_pic_14']);
																	$post_pic_15  = $purifier->purify($fetch_AdminPost['post_pic_15']);

																	if ((empty($post_msg_2)) and (empty($post_msg_3))) {
																		$message = "<h6 class=''><b>$msgHeader</b></h6><br>$post_msg";
																	}
																	if ((!empty($post_msg_2)) and (empty($post_msg_3))) {
																		$message = "<h6 class=''><b>$msgHeader</b></h6><br>$post_msg<br><br>$post_msg_2";
																	}
																	if ((!empty($post_msg_2)) and (!empty($post_msg_3))) {
																		$message = "<h6 class=''><b>$msgHeader</b></h6><br>$post_msg<br><br>$post_msg_2<br><br>$post_msg_3";
																	}
																	if ((empty($post_msg_2)) and (!empty($post_msg_3))) {
																		$message = "<h6 class=''><b>$msgHeader</b></h6><br>$post_msg<br><br>$post_msg_3";
																	}
																	$post_pic = (empty($post_pic)) ? "No main picture for this post" : "<img src='../$post_pic' alt='' class='img-thumbnail' style='height:120px; width:120px;'>";
																	$post_audio = (empty($post_audio)) ? "No audio file" : "This post has an audio file";
																	$post_video = (empty($post_video)) ? "No video file" : "This post has a video file";
																	$youtube_url = (empty($youtube_url)) ? "No youtube file" : $youtube_url;
																	$tagged_post = (empty($tagged_post)) ? "No tagged post" : $tagged_post;
																	$post_pic_1 = (empty($post_pic_1)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_1' style='height:120px; width:120px;'></a></li>";
																	$post_pic_2 = (empty($post_pic_2)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_2' style='height:120px; width:120px;'></a></li>";
																	$post_pic_3 = (empty($post_pic_3)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_3' style='height:120px; width:120px;'></a></li>";
																	$post_pic_4 = (empty($post_pic_4)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_4' style='height:120px; width:120px;'></a></li>";
																	$post_pic_5 = (empty($post_pic_5)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_5' style='height:120px; width:120px;'></a></li>";
																	$post_pic_6 = (empty($post_pic_6)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_6' style='height:120px; width:120px;'></a></li>";
																	$post_pic_7 = (empty($post_pic_7)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_7' style='height:120px; width:120px;'></a></li>";
																	$post_pic_8 = (empty($post_pic_8)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_8' style='height:120px; width:120px;'></a></li>";
																	$post_pic_9 = (empty($post_pic_9)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_9' style='height:120px; width:120px;'></a></li>";
																	$post_pic_10 = (empty($post_pic_10)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_10' style='height:120px; width:120px;'></a></li>";
																	$post_pic_11 = (empty($post_pic_11)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_11' style='height:120px; width:120px;'></a></li>";
																	$post_pic_12 = (empty($post_pic_12)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_12' style='height:120px; width:120px;'></a></li>";
																	$post_pic_13 = (empty($post_pic_13)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_13' style='height:120px; width:120px;'></a></li>";
																	$post_pic_14 = (empty($post_pic_14)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_14' style='height:120px; width:120px;'></a></li>";
																	$post_pic_15 = (empty($post_pic_15)) ? "" : "<li><a href='' class='img-thumbnail float-left'><img class='img-fluid' src='../$post_pic_15' style='height:120px; width:120px;'></a></li>";

																	echo "
												<tbody>
												<tr>
													<th scope='row'>$AdminPostRow</th>
													<td style='min-width:150px;'>$message</td>
													<td style='min-width:150px;'>$post_pic</td>
													<td style='min-width:150px;'>$post_audio</td>
													<td style='min-width:150px;'>$post_video</td>
													<td style='min-width:150px;'>$youtube_url</td>
													<td style='min-width:150px;'>$tagged_post</td>
													<td>$date_time</td>
													<td>$adminPostDir</td>
													<td><div id='post-more-photo' class='card' style='min-width:150px;'>
								            <div class='card-header'>More Photos</div>
								            <div class='card-body'>
								              <ul class='list-inline list-unstyled' style='display:table;'>
																$post_pic_1
																$post_pic_2
																$post_pic_3
																$post_pic_4
																$post_pic_5
																$post_pic_6
																$post_pic_7
																$post_pic_8
																$post_pic_9
																$post_pic_10
																$post_pic_11
																$post_pic_12
																$post_pic_13
																$post_pic_14
																$post_pic_15
								              </ul>
								            </div>
								          </div></td>
												</tr>
											</tbody>";
																	$AdminPostRow++;
																}
																?>
															</table>
														</div>
												<?php
													} else {
														echo '<div class="card">
									  <div class="card-body">
									    There are currently no Post!.
									  </div>
									</div>';
													}

													// Make the links to other pages, if necessary.
													if ($AdminPostPages > 1) {
														echo "<div class='card mt-3 shadow'>
									<div class='card-body text-center justify-content-center'>";
														// What number is the current page?
														$AdminPostcurrent_page = ($AdminPostStart / $AdminPostpagerows) + 1;
														// if the page is not the first page then create a Previous link
														if ($AdminPostcurrent_page != 1) {
															echo '<a class="pagiClickLink" href="index.php?As=' . ($AdminPostStart - $AdminPostpagerows) .
																'&Ap=' . $AdminPostPages . '">Prev </a>';
														}

														// Make all the numbered pages:
														for ($i = 1; $i <= $AdminPostPages; $i++) {
															if ($i != $AdminPostcurrent_page) {
																echo '<a class="pagiClickLink" href="index.php?As=' . (($AdminPostpagerows * ($i - 1))) . '&Ap=' . $AdminPostPages . '">' . $i . ' </a> ';
															} else {
																echo $i . ' ';
															}
														}

														// Create next link
														if ($AdminPostcurrent_page != $AdminPostPages) {
															echo '<a class="pagiClickLink" href="index.php?As=' . ($AdminPostStart + $AdminPostpagerows) . '&Ap=' . $AdminPostPages . '">Next </a>';
														}
														echo "</div></div>";
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
											<!-- /////////////////////////// DISPLAY ARTIST TAB ///////////////////////////// -->
											<div class="tab-pane fade" id="displayArtist" role="tabpanel" aria-labelledby="displayArtist-tab">
												<?php
												try {
													// Count number of artist for display in form
													$countArtist_id = mysqli_query($dbcon, "SELECT artist_id FROM artist");
													$countArtist_id_result = mysqli_num_rows($countArtist_id);
													if ($countArtist_id_result > 0) {
														echo "<div class='card mb-1'>
									<div class='card-header'>Total Artists: $countArtist_id_result</div>
									</div>";
													}

													// set the number of rows per display page
													$Artistpagerows = 20;
													// Has the totla number of pages already been calculated?
													if (isset($_GET['App'])) {
														$ArtistPages = filter_var($_GET['App'], FILTER_SANITIZE_NUMBER_INT);
													} else { // use the next block of code to calculate the number of pages
														// First, check for the total number of records
														$countArtist = "SELECT COUNT(artist_id) FROM artist WHERE artist_id IS NOT NULL";
														$countArtist_result = mysqli_query($dbcon, $countArtist);
														$fetch_countArtist = mysqli_fetch_array($countArtist_result, MYSQLI_NUM);
														$Artistrecords = htmlspecialchars($fetch_countArtist[0], ENT_QUOTES);
														// Now calculate the number of pages
														if ($Artistrecords > $Artistpagerows) {
															// If the number of records will fill more than one page
															// calculate the number of pages and round the result up to the nearest integer
															$ArtistPages = ceil($Artistrecords / $Artistpagerows);
														} else {
															$ArtistPages = 1;
														}
													} // page check finished

													// Declare which record to start with
													if ((isset($_GET['Ass']))) {
														$ArtistDisplayStart = filter_var($_GET['Ass'], FILTER_SANITIZE_NUMBER_INT);
														// Make sure it is not executable XSS
													} else {
														$ArtistDisplayStart = 0;
													}

													$query_ArtistDetails = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name ASC LIMIT $ArtistDisplayStart, $Artistpagerows");
													if (mysqli_num_rows($query_ArtistDetails) > 0) {
												?>
														<div class='card shadow'>
															<table class="table table-responsive">
																<thead class="thead-light">
																	<tr>
																		<th scope="col">#</th>
																		<th scope="col">Artist Image</th>
																		<th scope="col">Artist Name</th>
																		<th scope="col">Description</th>
																	</tr>
																</thead>
														<?php
														$artistRow = $ArtistDisplayStart + 1;
														while ($fetch_artists = mysqli_fetch_assoc($query_ArtistDetails)) {
															// fetch the records
															//$artist_id   = $purifier->purify($fetch_artists['artist_id']);
															$artist_name = $purifier->purify($fetch_artists['artist_name']);
															$artist_pic  = $purifier->purify($fetch_artists['artist_pic']);
															$artist_desc  = $purifier->purify($fetch_artists['description']);
															$artist_pic = "../" . $artist_pic;
															$artist_desc = (empty($artist_desc)) ? "" : $artist_desc;

															echo '<tbody>
								    <tr>
								      <th scope="row">' . $artistRow . '</th>
											<td><img src=' . $artist_pic . ' alt=' . $artist_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
								      <td>' . $artist_name . '</td>
											<td>' . $artist_desc . '</td>
								    </tr>
								  </tbody>';
															$artistRow++;
														}
														echo "</table>";
														echo "</div>";
													} else {
														echo '<div class="card">
									  <div class="card-body">
									    There are currently no artist.
									  </div>
									</div>';
													}

													// Make the links to other pages, if necessary.
													if ($ArtistPages > 1) {
														echo "<div class='card mt-3 shadow'>
									<div class='card-body text-center justify-content-center'>";
														// What number is the current page?
														$ArtistDisplaycurrent_page = ($ArtistDisplayStart / $Artistpagerows) + 1;
														// if the page is not the first page then create a Previous link
														if ($ArtistDisplaycurrent_page != 1) {
															echo '<a class="pagiClickLink" href="index.php?Ass=' . ($ArtistDisplayStart - $Artistpagerows) .
																'&App=' . $ArtistPages . '">Prev </a>';
														}

														// Make all the numbered pages:
														for ($i = 1; $i <= $ArtistPages; $i++) {
															if ($i != $ArtistDisplaycurrent_page) {
																echo '<a class="pagiClickLink" href="index.php?Ass=' . (($Artistpagerows * ($i - 1))) . '&App=' . $ArtistPages . '">' . $i . ' </a> ';
															} else {
																echo $i . ' ';
															}
														}

														// Create next link
														if ($ArtistDisplaycurrent_page != $ArtistPages) {
															echo '<a class="pagiClickLink" href="index.php?Ass=' . ($ArtistDisplayStart + $Artistpagerows) . '&App=' . $ArtistPages . '">Next</a>';
														}
														echo "</div></div>";
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
														<!-- /////////////////////////// DISPLAY ALBUM TAB ///////////////////////////// -->
														<div class="tab-pane fade" id="displayAlbum" role="tabpanel" aria-labelledby="displayAlbum-tab">
															<?php
															try {
																// Count number of users for display in form
																$countAlbum_id = mysqli_query($dbcon, "SELECT album_id FROM album");
																$countAlbum_id_result = mysqli_num_rows($countAlbum_id);
																if ($countAlbum_id_result > 0) {
																	echo "<div class='card mb-1'>
									<div class='card-header'>Total Album: $countAlbum_id_result</div>
									</div>";
																}

																// set the number of rows per display page
																$Albumpagerows = 20;
																// Has the totla number of pages already been calculated?
																if (isset($_GET['Alp'])) {
																	$AlbumPages = filter_var($_GET['Alp'], FILTER_SANITIZE_NUMBER_INT);
																} else { // use the next block of code to calculate the number of pages
																	// First, check for the total number of records
																	$countAlbum = "SELECT COUNT(album_id) FROM album WHERE album_id IS NOT NULL";
																	$countAlbum_result = mysqli_query($dbcon, $countAlbum);
																	$fetch_countAlbum = mysqli_fetch_array($countAlbum_result, MYSQLI_NUM);
																	$Albumrecords = htmlspecialchars($fetch_countAlbum[0], ENT_QUOTES);
																	// Now calculate the number of pages
																	if ($Albumrecords > $Albumpagerows) {
																		// If the number of records will fill more than one page
																		// calculate the number of pages and round the result up to the nearest integer
																		$AlbumPages = ceil($Albumrecords / $Albumpagerows);
																	} else {
																		$AlbumPages = 1;
																	}
																} // page check finished

																// Declare which record to start with
																if ((isset($_GET['Als']))) {
																	$AlbumDisplayStart = filter_var($_GET['Als'], FILTER_SANITIZE_NUMBER_INT);
																	// Make sure it is not executable XSS
																} else {
																	$AlbumDisplayStart = 0;
																}

																$queryAlbum = mysqli_query($dbcon, "SELECT album.album_id, album.album_name, album.album_pic, DATE_FORMAT(album.release_date, '%d %M, %Y') AS release_date,
								artist.artist_name, artist.artist_pic, genre.genre_name FROM album LEFT JOIN artist ON album.artist_id=artist.artist_id LEFT JOIN genre
								ON album.genre_id = genre.genre_id ORDER BY artist.artist_name LIMIT $AlbumDisplayStart, $Albumpagerows");
																if (mysqli_num_rows($queryAlbum) > 0) {
															?>
																	<div class='card shadow'>
																		<table class="table table-responsive">
																			<thead class="thead-light">
																				<tr>
																					<th scope="col">#</th>
																					<th scope="col">Artist Image</th>
																					<th scope="col">Artist Name</th>
																					<th scope="col">Album Name</th>
																					<th scope="col">Album Cover</th>
																					<th scope="col">Album Tracks</th>
																					<th scope="col">Genre</th>
																					<th scope="col">Release Date</th>
																				</tr>
																			</thead>
																	<?php
																	$albumRow = $AlbumDisplayStart + 1;
																	while ($fetch_album = mysqli_fetch_assoc($queryAlbum)) {
																		// fetch the records
																		$album_id   = $purifier->purify($fetch_album['album_id']);
																		$album_name = $purifier->purify($fetch_album['album_name']);
																		$album_pic  = $purifier->purify($fetch_album['album_pic']);
																		$release_date  = $purifier->purify($fetch_album['release_date']);
																		$artist_name = $purifier->purify($fetch_album['artist_name']);
																		$artist_pic  = $purifier->purify($fetch_album['artist_pic']);
																		$genre_name  = $purifier->purify($fetch_album['genre_name']);
																		$album_pic = "../" . $album_pic;
																		$artist_pic = "../" . $artist_pic;

																		echo '<tbody>
								    <tr>
								      <th scope="row">' . $albumRow . '</th>
											<td><img src=' . $artist_pic . ' alt=' . $artist_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
								      <td>' . $artist_name . '</td>
											<td>' . $album_name . '</td>
											<td><img src=' . $album_pic . ' alt=' . $album_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>';
																		$query_SongDetails = mysqli_query($dbcon, "SELECT audio_name, audio_number, tagged_artist FROM audio
											WHERE album_id=$album_id ORDER BY audio_number ASC");
																		if (mysqli_num_rows($query_SongDetails) > 0) {
																			echo "<td>";
																			while ($fetch_songs = mysqli_fetch_assoc($query_SongDetails)) {
																				// fetch the records
																				$audio_name = $purifier->purify($fetch_songs['audio_name']);
																				$audio_num  = $purifier->purify($fetch_songs['audio_number']);
																				$tagged_artist  = $purifier->purify($fetch_songs['tagged_artist']);
																				$audio_num = $audio_num == NULL ? "" : "(" . $audio_num . ")";
																				$tagged_artist = $tagged_artist == NULL ? "" : trim($tagged_artist);
																				echo "$audio_num $audio_name";
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
																				echo "<br>";
																			}
																			echo "</td>";
																		} else echo '<td>There are no songs in this album!</td>';
																		echo '
											<td>' . $genre_name . '</td>
											<td>' . $release_date . '</td>
								    </tr>
								  </tbody>';
																		$albumRow++;
																	}
																	echo "</table>";
																	echo "</div>";
																} else {
																	echo '<div class="card">
									  <div class="card-body">
									    There are currently no album.
									  </div>
									</div>';
																}

																// Make the links to other pages, if necessary.
																if ($AlbumPages > 1) {
																	echo "<div class='card mt-3 shadow'>
									<div class='card-body text-center justify-content-center'>";
																	// What number is the current page?
																	$AlbumDisplaycurrent_page = ($AlbumDisplayStart / $Albumpagerows) + 1;
																	// if the page is not the first page then create a Previous link
																	if ($AlbumDisplaycurrent_page != 1) {
																		echo '<a class="pagiClickLink" href="index.php?Als=' . ($AlbumDisplayStart - $Albumpagerows) .
																			'&Alp=' . $AlbumPages . '">Prev </a>';
																	}

																	// Make all the numbered pages:
																	for ($i = 1; $i <= $AlbumPages; $i++) {
																		if ($i != $AlbumDisplaycurrent_page) {
																			echo '<a class="pagiClickLink" href="index.php?Als=' . (($Albumpagerows * ($i - 1))) . '&Alp=' . $AlbumPages . '">' . $i . ' </a> ';
																		} else {
																			echo $i . ' ';
																		}
																	}

																	// Create next link
																	if ($AlbumDisplaycurrent_page != $AlbumPages) {
																		echo '<a class="pagiClickLink" href="index.php?Als=' . ($AlbumDisplayStart + $Albumpagerows) . '&Alp=' . $AlbumPages . '">Next</a>';
																	}
																	echo "</div></div>";
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
																	<!-- /////////////////////////// DISPLAY AUDIO TAB ///////////////////////////// -->
																	<div class="tab-pane fade" id="displayAudio" role="tabpanel" aria-labelledby="displayAudio-tab">
																		<?php
																		try {
																			// Count number of audio for display in form
																			$countAudio_id = mysqli_query($dbcon, "SELECT audio_id FROM audio");
																			$countAudio_id_result = mysqli_num_rows($countAudio_id);
																			if ($countAudio_id_result > 0) {
																				echo "<div class='card mb-1'>
									<div class='card-header'>Total Audio: $countAudio_id_result</div>
									</div>";
																			}

																			// set the number of rows per display page
																			$Audiopagerows = 20;
																			// Has the totla number of pages already been calculated?
																			if (isset($_GET['Aup'])) {
																				$AudioPages = filter_var($_GET['Aup'], FILTER_SANITIZE_NUMBER_INT);
																			} else { // use the next block of code to calculate the number of pages
																				// First, check for the total number of records
																				$countArtist = "SELECT COUNT(audio_id) FROM audio WHERE audio_id IS NOT NULL";
																				$countArtist_result = mysqli_query($dbcon, $countArtist);
																				$fetch_countArtist = mysqli_fetch_array($countArtist_result, MYSQLI_NUM);
																				$Artistrecords = htmlspecialchars($fetch_countArtist[0], ENT_QUOTES);
																				// Now calculate the number of pages
																				if ($Artistrecords > $Audiopagerows) {
																					// If the number of records will fill more than one page
																					// calculate the number of pages and round the result up to the nearest integer
																					$AudioPages = ceil($Artistrecords / $Audiopagerows);
																				} else {
																					$AudioPages = 1;
																				}
																			} // page check finished

																			// Declare which record to start with
																			if ((isset($_GET['Aus']))) {
																				$AudioDisplayStart = filter_var($_GET['Aus'], FILTER_SANITIZE_NUMBER_INT);
																				// Make sure it is not executable XSS
																			} else {
																				$AudioDisplayStart = 0;
																			}

																			$queryAudio = mysqli_query($dbcon, "SELECT audio.audio_name, audio.audio_file, audio.audio_pic, audio.tagged_artist, 
									-- audio.downloads,
								DATE_FORMAT(audio.date_added, '%d %M, %Y') AS date_added, artist.artist_name, artist.artist_pic FROM audio LEFT JOIN artist ON
								audio.artist_id=artist.artist_id ORDER BY artist.artist_name LIMIT $AudioDisplayStart, $Audiopagerows");
																			if (mysqli_num_rows($queryAudio) > 0) {
																		?>
																				<div class='card shadow'>
																					<table class="table table-responsive">
																						<thead class="thead-light">
																							<tr>
																								<th scope="col">#</th>
																								<th scope="col">Artist Image</th>
																								<th scope="col">Artist Name</th>
																								<th scope="col">Audio Name</th>
																								<th scope="col">Audio Cover</th>
																								<th scope="col">Audio URL</th>
																								<!-- <th scope="col">Number of Downloads</th> -->
																								<th scope="col">Date Added</th>
																							</tr>
																						</thead>
																				<?php
																				$audioRow = $AudioDisplayStart + 1;
																				while ($fetch_audio = mysqli_fetch_assoc($queryAudio)) {
																					// fetch the records
																					$audio_name = $purifier->purify($fetch_audio['audio_name']);
																					$audio_file = $purifier->purify($fetch_audio['audio_file']);
																					$audio_pic  = $purifier->purify($fetch_audio['audio_pic']);
																					$tagged_artist = $purifier->purify($fetch_audio['tagged_artist']);
																					// $downloads  = $purifier->purify($fetch_audio['downloads']);
																					$date_added  = $purifier->purify($fetch_audio['date_added']);
																					$artist_name = $purifier->purify($fetch_audio['artist_name']);
																					$artist_pic  = $purifier->purify($fetch_audio['artist_pic']);
																					$audio_pic = "../" . $audio_pic;
																					$artist_pic = "../" . $artist_pic;
																					$tagged_artist = $tagged_artist == NULL ? "" : trim($tagged_artist);

																					echo '<tbody>
								    <tr>
								      <th scope="row">' . $audioRow . '</th>
											<td><img src=' . $artist_pic . ' alt=' . $artist_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
								      <td>' . $artist_name . '</td>';
																					echo "<td>$audio_name";
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
																					echo '</td>
											<td><img src=' . $audio_pic . ' alt=' . $audio_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
											<th scope="row">' . $audio_file . '</th>
											<th scope="row">' . $date_added . '</th>
										</tr>
								  </tbody>';
																					$audioRow++;
																				}
																				echo "</table>";
																				echo "</div>";
																			} else {
																				echo '<div class="card">
									  <div class="card-body">
									    There are currently no audio.
									  </div>
									</div>';
																			}

																			// Make the links to other pages, if necessary.
																			if ($AudioPages > 1) {
																				echo "<div class='card mt-3 shadow'>
									<div class='card-body text-center justify-content-center'>";
																				// What number is the current page?
																				$AudioDisplaycurrent_page = ($AudioDisplayStart / $Audiopagerows) + 1;
																				// if the page is not the first page then create a Previous link
																				if ($AudioDisplaycurrent_page != 1) {
																					echo '<a class="pagiClickLink" href="index.php?Aus=' . ($AudioDisplayStart - $Audiopagerows) .
																						'&Aup=' . $AudioPages . '">Prev </a>';
																				}

																				// Make all the numbered pages:
																				for ($i = 1; $i <= $AudioPages; $i++) {
																					if ($i != $AudioDisplaycurrent_page) {
																						echo '<a class="pagiClickLink" href="index.php?Aus=' . (($Audiopagerows * ($i - 1))) . '&Aup=' . $AudioPages . '">' . $i . ' </a> ';
																					} else {
																						echo $i . ' ';
																					}
																				}

																				// Create next link
																				if ($AudioDisplaycurrent_page != $AudioPages) {
																					echo '<a class="pagiClickLink" href="index.php?Aus=' . ($AudioDisplayStart + $Audiopagerows) . '&Aup=' . $AudioPages . '">Next</a>';
																				}
																				echo "</div></div>";
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
																				<!-- /////////////////////////// DISPLAY VIDEO TAB ///////////////////////////// -->
																				<div class="tab-pane fade" id="displayVideo" role="tabpanel" aria-labelledby="displayVideo-tab">
																					<?php
																					try {
																						// Count number of users for display in form
																						$countVideo_id = mysqli_query($dbcon, "SELECT video_id FROM video");
																						$countVideo_id_result = mysqli_num_rows($countVideo_id);
																						if ($countVideo_id_result > 0) {
																							echo "<div class='card mb-1'>
									<div class='card-header'>Total Video: $countVideo_id_result</div>
									</div>";
																						}

																						// set the number of rows per display page
																						$Videopagerows = 20;
																						// Has the totla number of pages already been calculated?
																						if (isset($_GET['Vpp'])) {
																							$VideoPages = filter_var($_GET['Vpp'], FILTER_SANITIZE_NUMBER_INT);
																						} else { // use the next block of code to calculate the number of pages
																							// First, check for the total number of records
																							$countVideo = "SELECT COUNT(video_id) FROM video WHERE video_id IS NOT NULL";
																							$countVideo_result = mysqli_query($dbcon, $countVideo);
																							$fetch_countVideo = mysqli_fetch_array($countVideo_result, MYSQLI_NUM);
																							$Videorecords = htmlspecialchars($fetch_countVideo[0], ENT_QUOTES);
																							// Now calculate the number of pages
																							if ($Videorecords > $Videopagerows) {
																								// If the number of records will fill more than one page
																								// calculate the number of pages and round the result up to the nearest integer
																								$VideoPages = ceil($Videorecords / $Videopagerows);
																							} else {
																								$VideoPages = 1;
																							}
																						} // page check finished

																						// Declare which record to start with
																						if ((isset($_GET['Vss']))) {
																							$VideoDisplayStart = filter_var($_GET['Vss'], FILTER_SANITIZE_NUMBER_INT);
																							// Make sure it is not executable XSS
																						} else {
																							$VideoDisplayStart = 0;
																						}

																						$queryVideo = mysqli_query($dbcon, "SELECT video.video_name, video.video_file, video.youtube_url, video.video_pic, video.tagged_artist,
								DATE_FORMAT(video.date_added, '%d %M, %Y') AS date_added, artist.artist_name, artist.artist_pic FROM video LEFT JOIN artist ON
								video.artist_id=artist.artist_id ORDER BY artist.artist_name LIMIT $VideoDisplayStart, $Videopagerows");
																						if (mysqli_num_rows($queryVideo) > 0) {
																					?>
																							<div class='card shadow'>
																								<table class="table table-responsive">
																									<thead class="thead-light">
																										<tr>
																											<th scope="col">#</th>
																											<th scope="col">Artist Image</th>
																											<th scope="col">Artist Name</th>
																											<th scope="col">Video Name</th>
																											<th scope="col">Video Cover</th>
																											<th scope="col">Video URL</th>
																											<th scope="col">Date Added</th>
																										</tr>
																									</thead>
																							<?php
																							$videoRow = $VideoDisplayStart + 1;
																							while ($fetch_video = mysqli_fetch_assoc($queryVideo)) {
																								// fetch the records
																								$video_name = $purifier->purify($fetch_video['video_name']);
																								$video_file = $purifier->purify($fetch_video['video_file']);
																								$youtube_url = $purifier->purify($fetch_video['youtube_url']);
																								$video_pic  = $purifier->purify($fetch_video['video_pic']);
																								$tagged_artist = $purifier->purify($fetch_video['tagged_artist']);
																								$date_added  = $purifier->purify($fetch_video['date_added']);
																								$artist_name = $purifier->purify($fetch_video['artist_name']);
																								$artist_pic  = $purifier->purify($fetch_video['artist_pic']);
																								$video_file = $video_file == NULL ? $youtube_url : $video_file;
																								$video_pic = "../" . $video_pic;
																								$artist_pic = "../" . $artist_pic;
																								$tagged_artist = $tagged_artist == NULL ? "" : trim($tagged_artist);

																								echo '<tbody>
								    <tr>
								      <th scope="row">' . $videoRow . '</th>
											<td><img src=' . $artist_pic . ' alt=' . $artist_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
								      <td>' . $artist_name . '</td>';
																								echo "<td>$video_name";
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
																								echo '</td>
											<td><img src=' . $video_pic . ' alt=' . $video_name . ' class="img-thumbnail" style="height:120px; width:120px;"></td>
											<th scope="row">' . $video_file . '</th>
											<th scope="row">' . $date_added . '</th>
										</tr>
								  </tbody>';
																								$videoRow++;
																							}
																							echo "</table>";
																							echo "</div>";
																						} else {
																							echo '<div class="card">
									  <div class="card-body">
									    There are currently no video.
									  </div>
									</div>';
																						}

																						// Make the links to other pages, if necessary.
																						if ($VideoPages > 1) {
																							echo "<div class='card mt-3 shadow'>
									<div class='card-body text-center justify-content-center'>";
																							// What number is the current page?
																							$VideoDisplaycurrent_page = ($VideoDisplayStart / $Videopagerows) + 1;
																							// if the page is not the first page then create a Previous link
																							if ($VideoDisplaycurrent_page != 1) {
																								echo '<a class="pagiClickLink" href="index.php?Vss=' . ($VideoDisplayStart - $Videopagerows) .
																									'&Vpp=' . $VideoPages . '">Prev </a>';
																							}

																							// Make all the numbered pages:
																							for ($i = 1; $i <= $VideoPages; $i++) {
																								if ($i != $VideoDisplaycurrent_page) {
																									echo '<a class="pagiClickLink" href="index.php?Vss=' . (($Videopagerows * ($i - 1))) . '&Vpp=' . $VideoPages . '">' . $i . ' </a> ';
																								} else {
																									echo $i . ' ';
																								}
																							}

																							// Create next link
																							if ($VideoDisplaycurrent_page != $VideoPages) {
																								echo '<a class="pagiClickLink" href="index.php?Vss=' . ($VideoDisplayStart + $Videopagerows) . '&Vpp=' . $VideoPages . '">Next</a>';
																							}
																							echo "</div></div>";
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
																							<!-- /////////////////////////// ADD POST TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertPost" role="tabpanel" aria-labelledby="insertPost-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD POST</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="add-post-select-app" class="font-weight-bolder">Select App:</label>
																														<?php // Select app details
																														$apps = mysqli_query($dbcon, "SELECT * FROM apps ORDER BY app_id");
																														// Check the result:
																														if (mysqli_num_rows($apps) > 0) {
																															echo "<select class='form-control' name='select_app' id='add-post-select-app' required>";
																															// fetch the records
																															while ($fetch_apps = mysqli_fetch_assoc($apps)) {
																																// fetch the records
																																$app_id   = $purifier->purify($fetch_apps['app_id']);
																																$app_name = $purifier->purify($fetch_apps['app_name']);

																																echo "<option value='$app_id'>$app_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
                            <option>No app</option>
                          </select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Message Header:</label>
																														<textarea class='expanding form-control msg_header' spellcheck='true' name='msg_header' placeholder='Message Header' rows='1' required></textarea>
																													</div>
																												</div>
																												<div class="form-group">
																													<label for="add-post-post_msg" class="font-weight-bolder">Post Message (Required):</label>
																													<textarea name="post_msg" class="txtEditor txtEditor_required" id="add-post-post_msg"></textarea>
																												</div>
																												<div class="form-group">
																													<label for="add-post-post_msg_2" class="font-weight-bolder">Post Message (2<sup>nd</sup> paragraph)?:</label>
																													<textarea name="post_msg_2" class="txtEditor" id="add-post-post_msg_2"></textarea>
																												</div>
																												<div class="form-group">
																													<label for="add-post-post_msg_3" class="font-weight-bolder">Post Message (3<sup>rd</sup> paragraph)?:</label>
																													<textarea name="post_msg_3" class="txtEditor" id="add-post-post_msg_3"></textarea>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Post Image (Required):</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-post-post_pic" name="post_pic" required>
																															<label class="custom-file-label" for="add-post-post_pic">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Post Audio?:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-post-post_audio" name="post_audio">
																															<label class="custom-file-label" for="add-post-post_audio">Upload audio...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="post_youtube_url" class="font-weight-bolder">Youtube Url?:</label>
																														<textarea class='expanding form-control post_youtube_url' id="post_youtube_url" spellcheck='true' name='post_youtube_url' placeholder='Youtube url?' rows='1'></textarea>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Post Video?:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-post-post_video" name="post_video">
																															<label class="custom-file-label" for="add-post-post_video">Upload video...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Tag Post?:</label><br>
																														<select id="tag_post" name="tag_post[]" multiple="multiple" class="form-control">
																															<?php
																															$posts = mysqli_query($dbcon, "SELECT post_id, msg_header FROM post WHERE admin_post_num IS NOT NULL ORDER BY post_id");
																															// Check the result:
																															if (mysqli_num_rows($posts) > 0) {
																																// fetch the records
																																while ($fetch_posts = mysqli_fetch_assoc($posts)) {
																																	// fetch the records
																																	$post_id   = $purifier->purify($fetch_posts['post_id']);
																																	$msg_header = $purifier->purify($fetch_posts['msg_header']);

																																	echo "<option class='float-left' value='$post_id'>$msg_header</option>";
																																}
																															}
																															?>
																														</select>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="newsfeedshow" class="font-weight-bolder">Show on News Feed?(1):</label>
																														<div class="custom-file">
																															<input type="number" class="form-control" id="newsfeedshow" name="newsfeedshow" max="1" min="0" placeholder="News Feed?(1)">
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="post_pic_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																												<h6 class="font-weight-bolder text-center">Post More Picture?</h6>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_1 btn-sm rounded-pill">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_1" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_1" name="post_pic_1">
																															<label class="custom-file-label" for="add-post-post_pic_1">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_2 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_2" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_2" name="post_pic_2">
																															<label class="custom-file-label" for="add-post-post_pic_2">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_3 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_3" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_3" name="post_pic_3">
																															<label class="custom-file-label" for="add-post-post_pic_3">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_4 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_4" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_4" name="post_pic_4">
																															<label class="custom-file-label" for="add-post-post_pic_4">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_5 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_5" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_5" name="post_pic_5">
																															<label class="custom-file-label" for="add-post-post_pic_5">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_6 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_6" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_6" name="post_pic_6">
																															<label class="custom-file-label" for="add-post-post_pic_6">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_7 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_7" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_7" name="post_pic_7">
																															<label class="custom-file-label" for="add-post-post_pic_7">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_8 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_8" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_8" name="post_pic_8">
																															<label class="custom-file-label" for="add-post-post_pic_8">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_9 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_9" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_9" name="post_pic_9">
																															<label class="custom-file-label" for="add-post-post_pic_9">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_10 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_10" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_10" name="post_pic_10">
																															<label class="custom-file-label" for="add-post-post_pic_10">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_11 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_11" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_11" name="post_pic_11">
																															<label class="custom-file-label" for="add-post-post_pic_11">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_12 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_12" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_12" name="post_pic_12">
																															<label class="custom-file-label" for="add-post-post_pic_12">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_13 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_13" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_13" name="post_pic_13">
																															<label class="custom-file-label" for="add-post-post_pic_13">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_14 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_14" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_14" name="post_pic_14">
																															<label class="custom-file-label" for="add-post-post_pic_14">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<button type="button" class="btn btn-block btn-outline-secondary post_pic_15 btn-sm rounded-pill" style="display:none;">Post More Picture?</button>
																														<div class="custom-file" id="post_pic_15" style="display:none;">
																															<input type="file" class="custom-file-input" id="add-post-post_pic_15" name="post_pic_15">
																															<label class="custom-file-label" for="add-post-post_pic_15">Upload image...</label>
																														</div>
																													</div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block add_post rounded-pill' id='add_post' name='add_post' value='Add Post'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											// Preview post image
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#post_pic_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#add-post-post_pic").change(function() {
																												readURL(this);
																											});

																											$('#tag_post').multiselect({
																												// onDropdownShown: function(e) {
																												//   $("#tag_post").removeAttr("multiple");
																												//   this.$container.find(':radio').hide();
																												//   // if (this.options.multiple == false) {
																												//   //
																												//   // }
																												//
																												// },
																												disableIfEmpty: true,
																												disabledText: 'Post is empty...',
																												nonSelectedText: 'Select post...',
																												enableFiltering: true,
																												includeSelectAllOption: true,
																												maxHeight: 200,
																												enableCaseInsensitiveFiltering: true
																											});
																										});

																										$("#add-post-post_video").change(function() {
																											if ($(this).get(0).files.length != 0) {
																												$(".post_youtube_url").attr('disabled', 'disabled');
																											} else {
																												$(".post_youtube_url").removeAttr('disabled');
																											}
																										});
																										$(".post_youtube_url").keyup(function() {
																											if ($(this).val()) {
																												$("#add-post-post_video").attr('disabled', 'disabled');
																											} else {
																												$("#add-post-post_video").removeAttr('disabled');
																											}
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// ADD ARTIST TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertArtist" role="tabpanel" aria-labelledby="insertArtist-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD ARTIST</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="add-artist-artist_name" class="font-weight-bolder">Artist Name:</label>
																														<input type="text" class="form-control" id="add-artist-artist_name" name="artist_name" placeholder="Artist Name" required>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Artist Image (Required):</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-artist-post_pic" name="artist_image" required>
																															<label class="custom-file-label" for="add-artist-post_pic">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="add-artist-pic_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																												<div class="form-group">
																													<label for="add-artist-artist_desc" class="font-weight-bolder">Artist Description?:</label>
																													<textarea name="artist_desc" class="txtEditor txtEditor_required" id="add-artist-artist_desc" maxlength='250'></textarea>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block add_artist rounded-pill' id='add_artist' name='add_artist' value='Add Artist'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#add-artist-pic_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#add-artist-post_pic").change(function() {
																												readURL(this);
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// ADD ARTIST SPOTLIGHT TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertArtist_spotlight" role="tabpanel" aria-labelledby="insertArtist_spotlight-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD ARTIST SPOTLIGHT</h5>
																										</div>
																										<div class="card-body">
																											<form class="" action="" method="post" enctype="multipart/form-data" id="artist-spotlight-form">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="artist-spotligh-select-artist" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select artist details
																														$queryArtistDetails = mysqli_query($dbcon, "SELECT artist_id, artist_name FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($queryArtistDetails) > 0) {
																															echo "<select class='select_artist-single' name='select_artist' id='artist-spotligh-select-artist' required>";
																															echo "<option value=''></option>";
																															// fetch the records
																															while ($fetch_ArtistDetails = mysqli_fetch_assoc($queryArtistDetails)) {
																																$artist_id = $purifier->purify($fetch_ArtistDetails['artist_id']);
																																$artist_name = $purifier->purify($fetch_ArtistDetails['artist_name']);

																																echo "<option value='$artist_id'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" name="select_artist" id="artist-spotligh-select-artist" required>
                              <option value="">No artist</option>
                            </select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="add-spotlight-real_name" class="font-weight-bolder">Artist Real Name:</label>
																														<input type="text" class="form-control" id="add-spotlight-real_name" name="real_name" placeholder="Artist Real Name" required>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="add-spotlight-born" class="font-weight-bolder">Artist D.O.B:</label>
																														<input type="text" class="form-control" id="add-spotlight-born" name="born" placeholder="Artist D.O.B" required>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="add-spotlight-nationality" class="font-weight-bolder">Artist Nationality:</label>
																														<input type="text" class="form-control" id="add-spotlight-nationality" name="nationality" placeholder="Artist Nationality" required>
																													</div>
																												</div>
																												<div class="form-group">
																													<label for="" class="font-weight-bolder">Artist Image 1:</label>
																													<div class="custom-file">
																														<input type="file" class="custom-file-input" id="artist-spotligh-Artist-Pic_1" name="artist_pic_1" required>
																														<label class="custom-file-label" for="artist-spotligh-Artist-Pic_1">Upload artist image...</label>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Artist Image 2:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="artist-spotligh-Artist-Pic_2" name="artist_pic_2" required>
																															<label class="custom-file-label" for="artist-spotligh-Artist-Pic_2">Upload artist image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Artist Image 3:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="artist-spotligh-Artist-Pic_3" name="artist_pic_3" required>
																															<label class="custom-file-label" for="artist-spotligh-Artist-Pic_3">Upload artist image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-group">
																													<label for="artist-spotligh-Description" class="font-weight-bolder">Description (Required. <span class="text-danger">Not less than 150 words altogether!</span>):</label>
																													<textarea name="description_1" class="txtEditor txtEditor_required" id="artist-spotligh-Description"></textarea>
																												</div>
																												<div class="form-group">
																													<label for="artist-spotligh-Description_2" class="font-weight-bolder">Description (2<sup>nd</sup> paragraph)?:</label>
																													<textarea name="description_2" class="txtEditor" id="artist-spotligh-Description_2"></textarea>
																												</div>
																												<div class="form-group">
																													<label for="artist-spotligh-Description_3" class="font-weight-bolder">Description (3<sup>rd</sup> paragraph)?:</label>
																													<textarea name="description_3" class="txtEditor" id="artist-spotligh-Description_3"></textarea>
																												</div>
																												<div class="form-group">
																													<input type='submit' class='btn emc_btn btn-block add_artist_spotlight rounded-pill' id='add_artist_spotlight' name='add_artist_spotlight' value='Add Artist Spotlight'>
																												</div>
																											</form>
																										</div>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// ADD ALBUM TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertAlbum" role="tabpanel" aria-labelledby="insertAlbum-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow w-100'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD ALBUM</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="add-album-select-artist" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select artist details
																														$queryArtistDetails = mysqli_query($dbcon, "SELECT artist_id, artist_name FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($queryArtistDetails) > 0) {
																															echo "<select class='select_artist-single' name='select_artist' id='add-album-select-artist' required>";
																															echo "<option value=''></option>";
																															// fetch the records
																															while ($fetch_ArtistDetails = mysqli_fetch_assoc($queryArtistDetails)) {
																																$artist_id = $purifier->purify($fetch_ArtistDetails['artist_id']);
																																$artist_name = $purifier->purify($fetch_ArtistDetails['artist_name']);

																																echo "<option value='$artist_id'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" name="select_artist" id="artist-spotligh-select-artist" required>
                              <option value="">No artist</option>
                            </select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="add-album-select-genre" class="font-weight-bolder">Select Genre:</label>
																														<?php // Select genre details
																														$queryGenreDetails = mysqli_query($dbcon, "SELECT genre_id, genre_name FROM genre ORDER BY genre_name");
																														// Check the result:
																														if (mysqli_num_rows($queryGenreDetails) > 0) {
																															echo "<select class='form-control' name='select_genre' id='add-album-select-genre' required>";
																															// fetch the records
																															while ($fetch_GenreDetails = mysqli_fetch_assoc($queryGenreDetails)) {
																																$genre_id = $purifier->purify($fetch_GenreDetails['genre_id']);
																																$genre_name = $purifier->purify($fetch_GenreDetails['genre_name']);

																																echo "<option value='$genre_id'>$genre_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" name="select_genre" required>
          										<option value="">No genre</option>
          									</select>';
																														}
																														?>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="add-album-album_name" class="font-weight-bolder">Album Name:</label>
																														<input type="text" class="form-control w-100" id="add-album-album_name" name="album_name" placeholder="Album Name" required>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Album Image (Required):</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-album-post_pic" name="album_image" required>
																															<label class="custom-file-label" for="add-album-post_pic">Upload image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="add-album-pic_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																												<label for="" class="font-weight-bolder">Release Date:</label>
																												<div class="form-row">
																													<div class="albumday_select form-group col-md-4">
																														<select class="albumday-selectors form-control" name="selectday" required>
																															<?php for ($i = 1; $i <= 31; $i++) {
																																echo '<option value="' . $i . '">' . $i . '</option>';
																															} ?>
																														</select>
																													</div>
																													<div class="albumday_select form-group col-md-4">
																														<select class="albumday-selectors form-control" name="selectmonth" required>
																															<option value="1">January</option>
																															<option value="2">February</option>
																															<option value="3">March</option>
																															<option value="4">April</option>
																															<option value="5">May</option>
																															<option value="6">June</option>
																															<option value="7">July</option>
																															<option value="8">August</option>
																															<option value="9">September</option>
																															<option value="10">October</option>
																															<option value="11">Novemeber</option>
																															<option value="12">December</option>
																														</select>
																													</div>
																													<div class="albumday_select form-group col-md-4">
																														<select class="albumday-selectors form-control" name="selectyear" required>
																															<?php $currentYear = date("Y");
																															for ($i = $currentYear; $i >= 1990; $i--) {
																																echo '<option value="' . $i . '">' . $i . '</option>';
																															} ?>
																														</select>
																													</div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block add_album rounded-pill' id='add_album' name='add_album' value='Add Album'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#add-album-pic_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#add-album-post_pic").change(function() {
																												readURL(this);
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// ADD AUDIO TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertAudio" role="tabpanel" aria-labelledby="insertAudio-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow mb-3'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD AUDIO</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="select_artistAddAudio" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select artist details
																														$query_ArtistDetails = mysqli_query($dbcon, "SELECT artist_id, artist_name FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($query_ArtistDetails) > 0) {
																															echo "<select class='form-control select_artist-single' name='select_artist' id='select_artistAddAudio' required>
                                  <option value=''></option>";
																															// fetch the records
																															while ($fetch__ArtistDetails = mysqli_fetch_assoc($query_ArtistDetails)) {
																																$artist_id = $purifier->purify($fetch__ArtistDetails['artist_id']);
																																$artist_name = $purifier->purify($fetch__ArtistDetails['artist_name']);

																																echo "<option value='$artist_id'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" name="select_artist" required>
                              <option value="">No artist</option>
                            </select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="select_appAddAudio" class="font-weight-bolder">Select App For Link Purposes?:</label>
																														<?php // Select app details
																														$queryDelAppPost = mysqli_query($dbcon, "SELECT * FROM apps WHERE app_id != 1 ORDER BY app_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelAppPost) > 0) {
																															echo "<select class='form-control' id='select_appAddAudio' name='select_app'>
                                <option value='NULL'>Select App</option>";
																															while ($fetch_app = mysqli_fetch_assoc($queryDelAppPost)) {
																																// fetch the records
																																$app_id   = $purifier->purify($fetch_app['app_id']);
																																$app_name = $purifier->purify($fetch_app['app_name']);

																																echo "<option value='$app_id' data-appName='$app_name'>$app_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" name="select_app" required>
                               <option value="">No App</option>
                             </select>';
																														}
																														?>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="select_albumAddAudio" class="font-weight-bolder">Select Album?:</label>
																														<select class="form-control" name="select_album" id="select_albumAddAudio" disabled>
																															<option value="NULL">Select Album</option>
																														</select>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="add-artist-audio_name" class="font-weight-bolder">Audio Name:</label>
																														<input type="text" class="form-control" id="add-artist-audio_name" name="audio_name" placeholder="Audio Name" autocomplete="on" required>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Audio File:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-artist-audio_file" name="audio_file" required>
																															<label class="custom-file-label" for="add-artist-audio_file">Upload audio file...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="add-audio-audio_num" class="font-weight-bolder">Audio Number?:</label>
																														<input type="number" class="form-control" id="add-audio-audio_num" name="audio_num" min="0" placeholder="Audio No.?" autocomplete="on">
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="tag_artist" class="font-weight-bolder">Tag Artist(s)?:</label>
																														<input class="form-control w-100" id="tag_artist" name="tag_artist" type="text" value="" spellcheck="true" autocomplete="on">
																													</div>
																													<div class="form-group col-md-6">
																														<label for="hit_track" class="font-weight-bolder">Hit Track?:</label>
																														<select class="form-control" name="hit_track" id="hit_track">
																															<option value="no" selected>No</option>
																															<option value="yes">Yes</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Audio Image?:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="add-artist-audio_image" name="audio_image">
																															<label class="custom-file-label" for="add-artist-audio_image">Upload audio image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="display_track" class="font-weight-bolder">Display Track?:</label>
																														<select class="form-control" name="display_track" id="display_track">
																															<option value="yes" selected>YES</option>
																															<option value="no">NO</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="audio_image_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																												<div class="form-group">
																													<label for="add-audio-lyrics" class="font-weight-bolder">Lyrics?:</label>
																													<textarea name="lyrics" class="txtEditor txtEditor_required" id="add-audio-lyrics"></textarea>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block add_audio rounded-pill' id='add_audio' name='add_audio' value='Add Audio'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#audio_image_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#add-artist-audio_image").change(function() {
																												readURL(this);
																											});

																											$("#select_artistAddAudio").change(function() {
																												if ($(this).children(":selected").val() != "") {
																													var selectedVal = $("#select_artistAddAudio option:selected").val();
																													// AJAX Request
																													$.ajax({
																														url: 'ajax_select.php',
																														type: 'POST',
																														data: {
																															selectAudioAlbum_id: selectedVal
																														},
																														//contentType: "application/json",
																														dataType: "json",
																														success: function(response) {
																															var len = response.length;

																															$("#select_albumAddAudio").empty();
																															$("#select_albumAddAudio").append("<option value=''>Unknown Album</option>");
																															for (var i = 0; i < len; i++) {
																																var id = response[i]['id'];
																																var name = response[i]['name'];
																																$("#select_albumAddAudio").append("<option value='" + id + "'>" + name + "</option>");
																															}
																														}
																													});
																													$("#select_albumAddAudio").removeAttr("disabled");
																												} else {
																													$("#select_albumAddAudio").attr("disabled", "disabled");
																												}
																											});

																											$('#tag_artist').tagsInput({
																												// custom placeholder
																												placeholder: 'Tag other artists',
																												// width:'250px',
																												'autocomplete': {
																													source: [
																														<?php $artists = mysqli_query($dbcon, "SELECT artist_name FROM artist ORDER BY artist_name");
																														//$artistNumber = mysqli_num_rows($artists);
																														if (mysqli_num_rows($artists) > 0) {
																															while ($fetch_artists = mysqli_fetch_assoc($artists)) {
																																$artist_name = $purifier->purify($fetch_artists['artist_name']);
																																echo "'$artist_name',";
																															}
																														}
																														?>
																													]
																												}
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// ADD VIDEO TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertVideo" role="tabpanel" aria-labelledby="insertVideo-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow mb-3'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD VIDEO</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="select_artistAddVideo" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select artist details
																														$query_ArtistDetails = mysqli_query($dbcon, "SELECT artist_id, artist_name FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($query_ArtistDetails) > 0) {
																															echo "<select class='form-control select_artist-single' name='select_artist' required id='select_artistAddVideo'>
                                  <option value=''></option>";
																															// fetch the records
																															while ($fetch__ArtistDetails = mysqli_fetch_assoc($query_ArtistDetails)) {
																																$artist_id = $purifier->purify($fetch__ArtistDetails['artist_id']);
																																$artist_name = $purifier->purify($fetch__ArtistDetails['artist_name']);

																																echo "<option value='$artist_id'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" name="select_artist" required>
                              <option value="">No artist</option>
                            </select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="select_songAddVideo" class="font-weight-bolder">Select Audio?:</label>
																														<select class="form-control" name="select_song" id="select_songAddVideo" disabled>
																															<option value="NULL">Select Song</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="select_albumAddVideo" class="font-weight-bolder">Select ALbum?:</label>
																														<select class="form-control" name="select_album" id="select_albumAddVideo" disabled>
																															<option value="NULL">Select Album</option>
																														</select>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="video_name" class="font-weight-bolder">Video Name:</label>
																														<input type="text" class="form-control" id="video_name" name="video_name" placeholder="Video Name" autocomplete="on" required>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="video_file" class="font-weight-bolder">Video File: <span class="float-right">OR</span></label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="video_file" name="video_file">
																															<label class="custom-file-label" for="video_file">Upload video file...</label>
																														</div>
																													</div>
																													<!-- <div class="form-group col-md-2">
                          <label for="" class="font-weight-bolder">OR</label>
                        </div> -->
																													<div class="form-group col-md-6">
																														<label for="youtube_url" class="font-weight-bolder">Youtube Id:</label>
																														<textarea class='expanding form-control youtube_url' id="youtube_url" spellcheck='true' name='youtube_url' placeholder='Youtube Id?' rows='1'></textarea>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Hit Track?:</label>
																														<select class="form-control" name="hit_track" id="">
																															<option value="no" selected>No</option>
																															<option value="yes">Yes</option>
																														</select>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="video_tag_artist" class="font-weight-bolder">Tag Artist(s)?:</label>
																														<input class="form-control" id="video_tag_artist" name="tag_artist" type="text" value="" spellcheck="true" autocomplete="on">
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Video Image?:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="video_image" name="video_image">
																															<label class="custom-file-label" for="video_image">Upload video image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="display_trackVid" class="font-weight-bolder">Display Track?:</label>
																														<select class="form-control" name="display_track" id="display_trackVid">
																															<option value="yes" selected>YES</option>
																															<option value="no">NO</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="video_image_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block add_video rounded-pill' id='add_video' name='add_video' value='Add Video'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#video_image_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#video_image").change(function() {
																												readURL(this);
																											});

																											$("#select_artistAddVideo").change(function() {
																												if ($(this).children(":selected").val() != "") {
																													var selectedVal = $("#select_artistAddVideo option:selected").val();
																													// AJAX Request
																													$.ajax({
																														url: 'ajax_select.php',
																														type: 'post',
																														data: {
																															selectVideoAudio_id: selectedVal
																														},
																														dataType: 'json',
																														success: function(data) {
																															var len = data.length;

																															$("#select_songAddVideo").empty();
																															$("#select_songAddVideo").append("<option value='NULL'>Select Song</option>");
																															for (var i = 0; i < len; i++) {
																																var id = data[i]['id'];
																																var name = data[i]['name'];
																																$("#select_songAddVideo").append("<option value='" + id + "'>" + name + "</option>");
																															}
																														}
																													});
																													$("#select_songAddVideo").removeAttr("disabled");
																												} else {
																													$("#select_songAddVideo").attr("disabled", "disabled");
																												}
																											});

																											$("#select_artistAddVideo").change(function() {
																												if ($(this).children(":selected").val() != "") {
																													var selectedVal = $("#select_artistAddVideo option:selected").val();
																													// AJAX Request
																													$.ajax({
																														url: 'ajax_select.php',
																														type: 'post',
																														data: {
																															selectVideoAlbum_id: selectedVal
																														},
																														dataType: 'json',
																														success: function(data) {
																															var len = data.length;

																															$("#select_albumAddVideo").empty();
																															$("#select_albumAddVideo").append("<option value=''>Unknown Album</option>");
																															for (var i = 0; i < len; i++) {
																																var id = data[i]['id'];
																																var name = data[i]['name'];
																																$("#select_albumAddVideo").append("<option value='" + id + "'>" + name + "</option>");
																															}
																														}
																													});
																													$("#select_albumAddVideo").removeAttr("disabled");
																												} else {
																													$("#select_albumAddVideo").attr("disabled", "disabled");
																												}
																											});

																											$("#video_file").change(function() {
																												if ($(this).get(0).files.length != 0) {
																													$(".youtube_url").attr('disabled', 'disabled');
																												} else {
																													$(".youtube_url").removeAttr('disabled');
																												}
																											});
																											$(".youtube_url").keyup(function() {
																												if ($(this).val()) {
																													$("#video_file").attr('disabled', 'disabled');
																												} else {
																													$("#video_file").removeAttr('disabled');
																												}
																											});

																											$('#video_tag_artist').tagsInput({
																												// custom placeholder
																												placeholder: 'Tag other artists',
																												// width:'250px',
																												'autocomplete': {
																													source: [
																														<?php $artists = mysqli_query($dbcon, "SELECT artist_name FROM artist ORDER BY artist_name");
																														//$artistNumber = mysqli_num_rows($artists);
																														if (mysqli_num_rows($artists) > 0) {
																															while ($fetch_artists = mysqli_fetch_assoc($artists)) {
																																$artist_name = $purifier->purify($fetch_artists['artist_name']);
																																echo "'$artist_name',";
																															}
																														}
																														?>
																													]
																												}
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// ADD GENRE TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="insertGenre" role="tabpanel" aria-labelledby="insertGenre-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">ADD GENRE</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="genre_name" class="font-weight-bolder">Genre Name:</label>
																														<input type="text" class="form-control" id="genre_name" name="genre_name" placeholder="Genre Name" autocomplete="on" required>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="youtube_url" class="font-weight-bolder">Genre Description?:</label>
																														<textarea class='expanding form-control genre_desc' spellcheck='true' name='genre_desc' maxlength='250' placeholder='Genre description!' rows='1'></textarea>
																													</div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block add_genre rounded-pill' id='add_genre' name='add_genre' value='Add Genre'>
																											</div>
																										</form>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// EDIT POST TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="editPost" role="tabpanel" aria-labelledby="editPost-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">EDIT POST</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="editPost_select_app" class="font-weight-bolder">Select App:</label>
																														<?php // Select app details
																														$apps = mysqli_query($dbcon, "SELECT * FROM apps ORDER BY app_id");
																														// Check the result:
																														if (mysqli_num_rows($apps) > 0) {
																															echo "<select class='form-control' name='select_app' id='editPost_select_app' required>
              										<option value=''>Select App</option>";
																															// fetch the records
																															while ($fetch_apps = mysqli_fetch_assoc($apps)) {
																																// fetch the records
																																$app_id   = $purifier->purify($fetch_apps['app_id']);
																																$app_name = $purifier->purify($fetch_apps['app_name']);

																																echo "<option value='$app_id'>$app_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
              								<option>No app</option>
              							</select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="select_postNum" class="font-weight-bolder">Select Post:</label>
																														<select class="form-control" name="select_postNum" id="select_postNum" disabled required>
																															<option value="">Select Post</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-group">
																													<label for="" class="font-weight-bolder">Message Header:</label>
																													<textarea class='expanding form-control msg_header' spellcheck='true' name='msg_header' placeholder='Message Header' rows='1' required></textarea>
																												</div>
																												<div class="form-group">
																													<label for="edit-post-post_msg" class="font-weight-bolder">Post Message (Required):</label>
																													<textarea name="post_msg" class="txtEditor txtEditor_required" id="edit-post-post_msg"></textarea>
																												</div>
																												<div class="form-group">
																													<label for="edit-post-post_msg_2" class="font-weight-bolder">Post Message (2<sup>nd</sup> paragraph)?:</label>
																													<textarea name="post_msg_2" class="txtEditor" id="edit-post-post_msg_2"></textarea>
																												</div>
																												<div class="form-group">
																													<label for="edit-post-post_msg_3" class="font-weight-bolder">Post Message (3<sup>rd</sup> paragraph)?:</label>
																													<textarea name="post_msg_3" class="txtEditor" id="edit-post-post_msg_3"></textarea>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block edit_post rounded-pill' id='edit_post' name='edit_post' value='Edit Post'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											$("#editPost_select_app").change(function() {
																												if ($(this).children(":selected").val() != "") {
																													var selectedVal = $("#editPost_select_app option:selected").val();
																													// AJAX Request
																													$.ajax({
																														url: 'ajax_select.php',
																														type: 'post',
																														data: {
																															editPostApp_id: selectedVal
																														},
																														dataType: 'json',
																														success: function(data) {
																															var len = data.length;

																															$("#select_postNum").empty();
																															for (var i = 0; i < len; i++) {
																																var id = data[i]['id'];
																																var name = data[i]['name'];
																																$("#select_postNum").append("<option value='" + id + "'>" + name + "</option>");
																															}
																														}
																													});
																													$("#select_postNum").removeAttr("disabled");
																												} else {
																													$("#select_postNum").attr("disabled", "disabled");
																												}
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// EDIT ARTIST TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="editArtist" role="tabpanel" aria-labelledby="editArtist-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">EDIT ARTIST</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="edit-select-artist" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select app developer details
																														$artists = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($artists) > 0) {
																															echo "<select class='form-control select_artist-single' name='select_artist' id='edit-select-artist' required>";
																															echo "<option value=''></option>";
																															// fetch the records
																															while ($fetch_artists = mysqli_fetch_assoc($artists)) {
																																// fetch the records
																																$artist_id   = $purifier->purify($fetch_artists['artist_id']);
																																$artist_name = $purifier->purify($fetch_artists['artist_name']);

																																echo "<option value='$artist_id'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
            									<option>No artist</option>
            								</select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="edit_artist_name" class="font-weight-bolder">Edit Artist Name?:</label>
																														<input type="text" class="form-control" id="edit_artist_name" name="edit_artist_name" placeholder="Artist name" autocomplete="on">
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Change Artist Image?:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="edit_artist_image" name="edit_artist_image">
																															<label class="custom-file-label" for="edit_artist_image">Upload image...</label>
																														</div>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="edit_artist_desc" class="font-weight-bolder">Change Artist Description?:</label>
																														<textarea class='expanding form-control edit_artist_desc' spellcheck='true' name='edit_artist_desc' maxlength='250' placeholder='Describe Artist!' rows='1'></textarea>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="edit_artist_image_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block edit_artist rounded-pill' id='edit_artist' name='edit_artist' value='Edit Artist'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#edit_artist_image_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#edit_artist_image").change(function() {
																												readURL(this);
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// EDIT AUDIO TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="editAudio" role="tabpanel" aria-labelledby="editAudio-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">EDIT AUDIO</h5>
																										</div>
																										<form class="" action="index.php" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="editAudio_select_artist" class="font-weight-bolder">Select Audio:</label>
																														<?php // Select artist details
																														$audio = mysqli_query($dbcon, "SELECT audio_id, audio_name, tagged_artist, artist_id, artist_name FROM audio
                          INNER JOIN artist USING (artist_id) ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($audio) > 0) {
																															echo "<select class='form-control select2_plugin' name='select_audio' id='editAudio_select_artist' required>
                                  <option value=''>Select Audio</option>";
																															// fetch the records
																															while ($fetch_audio = mysqli_fetch_assoc($audio)) {
																																// fetch the records
																																$audio_id   = $purifier->purify($fetch_audio['audio_id']);
																																$audio_name = $purifier->purify($fetch_audio['audio_name']);
																																$tagged_artist = $purifier->purify($fetch_audio['tagged_artist']);
																																$artist_id   = $purifier->purify($fetch_audio['artist_id']);
																																$artist_name = $purifier->purify($fetch_audio['artist_name']);
																																$tagged_artist = (!empty($tagged_artist)) ? "ft $tagged_artist" : "";

																																echo "<option value='$audio_id' data-artistAudio_id='$artist_id'>$audio_name - $artist_name $tagged_artist</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
            									<option>No audio</option>
            								</select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="editAudio_select_album" class="font-weight-bolder">Edit Audio Album?:</label>
																														<select class="form-control" name="select_album" id="editAudio_select_album" disabled>
																															<option value="">Select Album</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="edit_audio_name" class="font-weight-bolder">Edit Audio Name?:</label>
																														<input type="text" class="form-control" id="edit_audio_name" name="edit_audio_name" placeholder="Audio name" autocomplete="on">
																													</div>
																													<div class="form-group col-md-6">
																														<label for="edit_audio_num" class="font-weight-bolder">Audio Number?:</label>
																														<input type="number" class="form-control" id="edit_audio_num" name="edit_audio_num" min="0" placeholder="Audio No.?" autocomplete="on">
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="edit_audio_playTime" class="font-weight-bolder">Edit Play Time?:</label>
																														<input type="number" class="form-control" id="edit_audio_playTime" name="edit_audio_playTime" min="0" placeholder="Audio Play Time?" autocomplete="off">
																													</div>
																													<div class="form-group col-md-6">
																														<label for="edit_hit_track" class="font-weight-bolder">Hit Track?:</label>
																														<select class="form-control" name="hit_track" id="edit_hit_track">
																															<option value="no" selected>No</option>
																															<option value="yes">Yes</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="hit_trackSongs" class="font-weight-bolder">List of Hit Songs <small>(Has no effect!)</small>:</label>
																														<?php
																														$queryHitSongs = mysqli_query($dbcon, "SELECT audio_name, tagged_artist, artist_name FROM audio INNER JOIN artist USING(artist_id) WHERE hit_track='yes'");
																														if (mysqli_num_rows($queryHitSongs) > 0) {
																															echo '<select class="form-control" name="" id="hit_trackSongs">';
																															// fetch the records
																															while ($fetch_hitSongs = mysqli_fetch_assoc($queryHitSongs)) {
																																$Hitaudio_name = $purifier->purify($fetch_hitSongs['audio_name']);
																																$Hittagged_artist = $purifier->purify($fetch_hitSongs['tagged_artist']);
																																$Hitartist_name = $purifier->purify($fetch_hitSongs['artist_name']);
																																$Hittagged_artist = (!empty($Hittagged_artist)) ? "ft $Hittagged_artist" : "";

																																echo "<option>$Hitaudio_name - $Hitartist_name $Hittagged_artist</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control" id="hit_trackSongs">
                              <option>No Hit Songs</option>
                            </select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Audio Image?:</label>
																														<div class="custom-file">
																															<input type="file" class="custom-file-input" id="edit-artist-audio_image" name="audio_image">
																															<label class="custom-file-label" for="edit-artist-audio_image">Upload audio image...</label>
																														</div>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="edit-audio_image_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																												<div class="form-group">
																													<label for="edit-audio-lyrics" class="font-weight-bolder">Lyrics?:</label>
																													<textarea name="edit_lyrics" class="txtEditor txtEditor_required" id="edit-audio-lyrics"></textarea>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block edit_audio rounded-pill' id='edit_audio' name='edit_audio' value='Edit Audio'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#edit-audio_image_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#edit-artist-audio_image").change(function() {
																												readURL(this);
																											});

																											$("#editAudio_select_artist").change(function() {
																												if ($('option:selected', this).attr('data-artistAudio_id')) {
																													var selectedVal = $('option:selected', this).attr('data-artistAudio_id');
																													// AJAX Request
																													$.ajax({
																														url: 'ajax_select.php',
																														type: 'post',
																														data: {
																															editAlbumArtist_id: selectedVal
																														},
																														dataType: 'json',
																														success: function(data) {
																															var len = data.length;

																															$("#editAudio_select_album").empty();
																															if (len) {
																																$("#editAudio_select_album").append("<option value=''>NULL</option>");
																															} else {
																																$("#editAudio_select_album").empty();
																															}
																															for (var i = 0; i < len; i++) {
																																var id = data[i]['id'];
																																var name = data[i]['name'];
																																$("#editAudio_select_album").append("<option value='" + id + "'>" + name + "</option>");
																															}
																														}
																													});
																													$("#editAudio_select_album").removeAttr("disabled");
																												} else {
																													$("#editAudio_select_album").attr("disabled", "disabled");
																												}
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// EDIT ALBUM TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="editAlbum" role="tabpanel" aria-labelledby="editAlbum-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">EDIT ALBUM</h5>
																										</div>
																										<form class="" action="index.php" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="editAlbum_select_artist" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select artist details
																														$artists = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($artists) > 0) {
																															echo "<select class='form-control select_artist-single' name='select_artist' required id='editAlbum_select_artist'>
            											<option value=''></option>";
																															// fetch the records
																															while ($fetch_artists = mysqli_fetch_assoc($artists)) {
																																// fetch the records
																																$artist_id   = $purifier->purify($fetch_artists['artist_id']);
																																$artist_name = $purifier->purify($fetch_artists['artist_name']);

																																echo "<option value='$artist_id' data-artist='$artist_name'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
            									<option>No artist</option>
            								</select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="edit_select_album" class="font-weight-bolder">Select Album:</label>
																														<select class="form-control" name="select_album" id="edit_select_album" disabled required>
																															<option value="">Select Album</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Select Genre:</label>
																														<?php // Select genre details
																														$queryGenreDetails = mysqli_query($dbcon, "SELECT genre_id, genre_name FROM genre ORDER BY genre_name");
																														// Check the result:
																														if (mysqli_num_rows($queryGenreDetails) > 0) {
																															echo "<select class='form-control' name='select_genre' required>";
																															// fetch the records
																															while ($fetch_GenreDetails = mysqli_fetch_assoc($queryGenreDetails)) {
																																$genre_id = $purifier->purify($fetch_GenreDetails['genre_id']);
																																$genre_name = $purifier->purify($fetch_GenreDetails['genre_name']);

																																echo "<option value='$genre_id'>$genre_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
          										<option>No genre</option>
          									</select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="edit_album_name" class="font-weight-bolder">Edit Album Name:</label>
																														<input type="text" class="form-control" id="edit_album_name" name="edit_album_name" placeholder="Album name" autocomplete="on" required>
																													</div>
																												</div>
																												<label for="" class="font-weight-bolder">Release Date:</label>
																												<div class="form-row">
																													<div class="albumday_select form-group col-md-4">
																														<select class="albumday-selectors form-control" name="selectday" required>
																															<?php for ($i = 1; $i <= 31; $i++) {
																																echo '<option value="' . $i . '">' . $i . '</option>';
																															} ?>
																														</select>
																													</div>
																													<div class="albumday_select form-group col-md-4">
																														<select class="albumday-selectors form-control" name="selectmonth" required>
																															<option value="1">January</option>
																															<option value="2">February</option>
																															<option value="3">March</option>
																															<option value="4">April</option>
																															<option value="5">May</option>
																															<option value="6">June</option>
																															<option value="7">July</option>
																															<option value="8">August</option>
																															<option value="9">September</option>
																															<option value="10">October</option>
																															<option value="11">Novemeber</option>
																															<option value="12">December</option>
																														</select>
																													</div>
																													<div class="albumday_select form-group col-md-4">
																														<select class="albumday-selectors form-control" name="selectyear" required>
																															<?php $currentYear = date("Y");
																															for ($i = $currentYear; $i >= 1990; $i--) {
																																echo '<option value="' . $i . '">' . $i . '</option>';
																															} ?>
																														</select>
																													</div>
																												</div>
																												<div class="form-group">
																													<label for="" class="font-weight-bolder">Change Album Image:</label>
																													<div class="custom-file">
																														<input type="file" class="custom-file-input" id="edit_album_image" name="edit_album_image" required>
																														<label class="custom-file-label" for="edit_album_image">Upload image...</label>
																													</div>
																												</div>
																												<div class="form-row">
																													<div class="form-group col-md-3"></div>
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Preview Image:</label>
																														<div class="card bg-dark text-white post_pic_prevCon">
																															<img src="" class="card-img" alt="Preview image" id="edit_album_image_prev">
																														</div>
																													</div>
																													<div class="form-group col-md-3"></div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block edit_album rounded-pill' id='edit_album' name='edit_album' value='Edit Album'>
																											</div>
																										</form>
																									</div>
																									<script type="text/javascript">
																										document.addEventListener('DOMContentLoaded', function() {
																											$("#editAlbum_select_artist").change(function() {
																												if ($(this).children(":selected").val() != "") {
																													var selectedVal = $("#editAlbum_select_artist option:selected").val();
																													// AJAX Request
																													$.ajax({
																														url: 'ajax_select.php',
																														type: 'post',
																														data: {
																															editAlbumArtist_id: selectedVal
																														},
																														dataType: 'json',
																														success: function(data) {
																															var len = data.length;

																															$("#edit_select_album").empty();
																															for (var i = 0; i < len; i++) {
																																var id = data[i]['id'];
																																var name = data[i]['name'];
																																$("#edit_select_album").append("<option value='" + id + "'>" + name + "</option>");
																															}
																														}
																													});
																													$("#edit_select_album").removeAttr("disabled");
																												} else {
																													$("#edit_select_album").attr("disabled", "disabled");
																												}
																											});

																											function readURL(input) {
																												if (input.files && input.files[0]) {
																													var reader = new FileReader();

																													reader.onload = function(e) {
																														$('#edit_album_image_prev').attr('src', e.target.result);
																													}

																													reader.readAsDataURL(input.files[0]); // convert to base64 string
																												}
																											}

																											$("#edit_album_image").change(function() {
																												readURL(this);
																											});
																										});
																									</script>
																								<?php
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
																							<!-- /////////////////////////// DELETE POST TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="deletePost" role="tabpanel" aria-labelledby="deletePost-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">DELETE POST</h5>
																										</div>
																										<form class="" action="" method="post">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="deleteAppPostSelect" class="font-weight-bolder">Select App:</label>
																														<?php
																														$queryDelAppPost = mysqli_query($dbcon, "SELECT * FROM apps ORDER BY app_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelAppPost) > 0) {
																															echo "<select class='form-control' id='deleteAppPostSelect' name='select_app' required>
																																<option value=''>Select App</option>";
																															while ($fetch_app = mysqli_fetch_assoc($queryDelAppPost)) {
																																// fetch the records
																																$app_id   = $purifier->purify($fetch_app['app_id']);
																																$app_name = $purifier->purify($fetch_app['app_name']);

																																echo "<option value='$app_id' data-appName='$app_name'>$app_name</option>";
																															}
																															echo "</select>";
																														} else echo "<div class='card-text'>There are no apps yet!</div>";
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="delete_select_post" class="font-weight-bolder">Select Post:</label>
																														<select class="form-control" name="select_post" id="delete_select_post" disabled required>
																															<option value="">Select Post</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-group">
																													<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																													<p class='text-muted'>Deleting this post will remove everything affiliated with the post both from the database and its directiory!</p>
																												</div>
																											</div>
																											<div class="card-footer">
																												<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deletePostModalButton' data-toggle='modal' data-target=''>Delete Post</button>
																											</div>
																											<div class="modal fade deletePost-modal" id="" tabindex="-1" aria-labelledby="deletePost-modalLabel" aria-hidden="true" role="dialog">
																												<div class="modal-dialog" role="document" id="deletePostModal">
																													<div class="modal-content card border-danger">
																														<div class="modal-header">
																															<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																															<h6 class="modal-title" id="deletePost-modalLabel">Are you sure you want to delete <b class="postNameInject" style="color:blue;"></b>.
																																<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																															</h6>
																														</div>
																														<div class="modal-body content-justify-center text-center">
																															<input type='submit' class='btn emc_btn btn-sm delete_post rounded-pill' id='delete_post' name='delete_post' value='Proceed'>
																															<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																														</div>
																													</div>
																												</div>
																											</div>
																											<script type="text/javascript">
																												document.addEventListener('DOMContentLoaded', function() {
																													$("#deleteAppPostSelect").change(function() {
																														if ($(this).children(":selected").val() != "") {
																															var selectedVal = $("#deleteAppPostSelect option:selected").val();
																															$("#deletePostModalButton").attr("data-target", "");
																															$("#deletePostModal").load(window.location.href + " #deletePostModal");
																															// AJAX Request
																															$.ajax({
																																url: 'ajax_select.php',
																																type: 'post',
																																data: {
																																	deletePostNum: selectedVal
																																},
																																dataType: 'json',
																																success: function(data) {
																																	var len = data.length;

																																	$("#delete_select_post").empty();
																																	if (len) {
																																		$("#delete_select_post").append("<option value='' data-postName=''>Select Post</option>");
																																	} else {
																																		$("#deletePostModalButton").attr("data-target", "");
																																	}
																																	for (var i = 0; i < len; i++) {
																																		var id = data[i]['id'];
																																		var name = data[i]['name'];
																																		$("#delete_select_post").append("<option value='" + id + "' data-postName='" + name + "'>" + name + "</option>");
																																	}
																																}
																															});
																															$("#delete_select_post").removeAttr("disabled");
																														} else {
																															$("#delete_select_post").attr("disabled", "disabled");
																														}
																													});
																													$("#delete_select_post").change(function() {
																														var selectedVal = $("#delete_select_post option:selected").val();
																														if (selectedVal == "") {
																															$("#deletePostModalButton").attr("data-target", "");
																														} else {
																															var postName = $("#delete_select_post option:selected").attr("data-postName");
																															$("#deletePostModalButton").attr("data-target", "#deletePost-modal_" + selectedVal);
																															$(".deletePost-modal").attr("id", "deletePost-modal_" + selectedVal);
																															$("#deletePost-modalLabel b.postNameInject").text(postName);
																														}
																													});
																												});
																											</script>
																										</form>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// DELETE ARTIST TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="deleteArtist" role="tabpanel" aria-labelledby="deleteArtist-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">DELETE ARTIST</h5>
																										</div>
																										<form class="" action="index.php" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="deleteArtistSelect" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select app details
																														$queryDelArtist = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelArtist) > 0) {
																															echo "<select class='form-control select_artist-single' id='deleteArtistSelect' name='select_artist' required>
              										<option value=''></option>";
																															while ($fetch_artist = mysqli_fetch_assoc($queryDelArtist)) {
																																// fetch the records
																																$artist_id   = $purifier->purify($fetch_artist['artist_id']);
																																$artist_name = $purifier->purify($fetch_artist['artist_name']);

																																echo "<option value='$artist_id' data-artistName='$artist_name'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else echo "<div class='card-text'>There are no artists yet!</div>";
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																														<p class='text-muted'>Deleting this artist will remove everything affiliated with the artist both from the database and its directiory!</p>
																													</div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteArtistModalButton' data-toggle='modal' data-target=''>Delete Artist</button>
																											</div>
																											<div class="modal fade deleteArtist-modal" id="" tabindex="-1" aria-labelledby="deleteArtist-modalLabel" aria-hidden="true" role="dialog">
																												<div class="modal-dialog" role="document">
																													<div class="modal-content card border-danger">
																														<div class="modal-header">
																															<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																															<h6 class="modal-title" id="deleteArtist-modalLabel">Are you sure you want to delete <b class="artistNameInject" style="color:blue;"></b>.
																																<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																															</h6>
																														</div>
																														<div class="modal-body content-justify-center text-center">
																															<input type='submit' class='btn emc_btn btn-sm delete_artist rounded-pill' id='delete_artist' name='delete_artist' value='Proceed'>
																															<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																														</div>
																													</div>
																												</div>
																											</div>
																											<script type="text/javascript">
																												document.addEventListener('DOMContentLoaded', function() {
																													$("#deleteArtistSelect").change(function() {
																														var selectedVal = $("#deleteArtistSelect option:selected").val();
																														var artistName = $("#deleteArtistSelect option:selected").attr("data-artistName");
																														$("#deleteArtistModalButton").attr("data-target", "#deleteArtist-modal_" + selectedVal);
																														$(".deleteArtist-modal").attr("id", "deleteArtist-modal_" + selectedVal);
																														$("#deleteArtist-modalLabel b.artistNameInject").text(artistName);
																													});
																												});
																											</script>
																										</form>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// DELETE ALBUM TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="deleteAlbum" role="tabpanel" aria-labelledby="deleteAlbum-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">DELETE ALBUM</h5>
																										</div>
																										<form class="" action="" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="deleteArtistAlbumSelect" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select app details
																														$queryDelArtist = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelArtist) > 0) {
																															echo "<select class='form-control select_artist-single' id='deleteArtistAlbumSelect' name='select_artist' required>
              										<option value=''></option>";
																															while ($fetch_artist = mysqli_fetch_assoc($queryDelArtist)) {
																																// fetch the records
																																$artist_id   = $purifier->purify($fetch_artist['artist_id']);
																																$artist_name = $purifier->purify($fetch_artist['artist_name']);

																																echo "<option value='$artist_id' data-artistName='$artist_name'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else echo "<div class='card-text'>There are no artists yet!</div>";
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="delete_select_album" class="font-weight-bolder">Select Album:</label>
																														<select class="form-control" name="select_album" id="delete_select_album" disabled required>
																															<option value="">Select Album</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-group">
																													<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																													<p class='text-muted'>Deleting this album will remove everything affiliated with the album both from the database and its directiory!</p>
																												</div>
																											</div>
																											<div class="card-footer">
																												<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteAlbumModalButton' data-toggle='modal' data-target=''>Delete Album</button>
																											</div>
																											<div class="modal fade deleteAlbum-modal" id="" tabindex="-1" aria-labelledby="deleteAlbum-modalLabel" aria-hidden="true" role="dialog">
																												<div class="modal-dialog" role="document" id="deleteAlbumModal">
																													<div class="modal-content card border-danger">
																														<div class="modal-header">
																															<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																															<h6 class="modal-title" id="deleteAlbum-modalLabel">Are you sure you want to delete <b class="albumNameInject" style="color:blue;"></b>.
																																<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																															</h6>
																														</div>
																														<div class="modal-body content-justify-center text-center">
																															<input type='submit' class='btn emc_btn btn-sm delete_album rounded-pill' id='delete_album' name='delete_album' value='Proceed'>
																															<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																														</div>
																													</div>
																												</div>
																											</div>
																											<script type="text/javascript">
																												document.addEventListener('DOMContentLoaded', function() {
																													$("#deleteArtistAlbumSelect").change(function() {
																														if ($(this).children(":selected").val() != "") {
																															var selectedVal = $("#deleteArtistAlbumSelect option:selected").val();
																															$("#deleteAlbumModalButton").attr("data-target", "");
																															$("#deleteAlbumModal").load(window.location.href + " #deleteAlbumModal");
																															// AJAX Request
																															$.ajax({
																																url: 'ajax_select.php',
																																type: 'post',
																																data: {
																																	deleteAlbumArtist_id: selectedVal
																																},
																																dataType: 'json',
																																success: function(data) {
																																	var len = data.length;

																																	$("#delete_select_album").empty();
																																	if (len) {
																																		$("#delete_select_album").append("<option value='' data-albumName=''>Select Album</option>");
																																	} else {
																																		$("#deleteAlbumModalButton").attr("data-target", "");
																																	}
																																	for (var i = 0; i < len; i++) {
																																		var id = data[i]['id'];
																																		var name = data[i]['name'];
																																		$("#delete_select_album").append("<option value='" + id + "' data-albumName='" + name + "'>" + name + "</option>");
																																	}
																																}
																															});
																															$("#delete_select_album").removeAttr("disabled");
																														} else {
																															$("#delete_select_album").attr("disabled", "disabled");
																														}
																													});
																													$("#delete_select_album").change(function() {
																														var selectedVal = $("#delete_select_album option:selected").val();
																														if (selectedVal == "") {
																															$("#deleteAlbumModalButton").attr("data-target", "");
																														} else {
																															var albumName = $("#delete_select_album option:selected").attr("data-albumName");
																															$("#deleteAlbumModalButton").attr("data-target", "#deleteAlbum-modal_" + selectedVal);
																															$(".deleteAlbum-modal").attr("id", "deleteAlbum-modal_" + selectedVal);
																															$("#deleteAlbum-modalLabel b.albumNameInject").text(albumName);
																														}
																													});
																												});
																											</script>
																										</form>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// DELETE AUDIO TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="deleteAudio" role="tabpanel" aria-labelledby="deleteAudio-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">DELETE AUDIO</h5>
																										</div>
																										<form class="" action="" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="deleteArtistSongSelect" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select app details
																														$queryDelArtist = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelArtist) > 0) {
																															echo "<select class='form-control select_artist-single' id='deleteArtistSongSelect' name='select_artist' required>
              										<option value=''></option>";
																															while ($fetch_artist = mysqli_fetch_assoc($queryDelArtist)) {
																																// fetch the records
																																$artist_id   = $purifier->purify($fetch_artist['artist_id']);
																																$artist_name = $purifier->purify($fetch_artist['artist_name']);

																																echo "<option value='$artist_id' data-artistName='$artist_name'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else echo "<div class='card-text'>There are no artists yet!</div>";
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="delete_select_song" class="font-weight-bolder">Select Song:</label>
																														<select class="form-control" name="select_song" id="delete_select_song" disabled required>
																															<option value="">Select Song</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-group">
																													<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																													<p class='text-muted'>Deleting this song will remove everything affiliated with the song both from the database and its directiory!</p>
																												</div>
																											</div>
																											<div class="card-footer">
																												<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteSongModalButton' data-toggle='modal' data-target=''>Delete Song</button>
																											</div>
																											<div class="modal fade deleteSong-modal" id="" tabindex="-1" aria-labelledby="deleteSong-modalLabel" aria-hidden="true" role="dialog">
																												<div class="modal-dialog" role="document" id="deleteSongModal">
																													<div class="modal-content card border-danger">
																														<div class="modal-header">
																															<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																															<h6 class="modal-title" id="deleteSong-modalLabel">Are you sure you want to delete <b class="songNameInject" style="color:blue;"></b>.
																																<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																															</h6>
																														</div>
																														<div class="modal-body content-justify-center text-center">
																															<input type='submit' class='btn emc_btn btn-sm delete_song rounded-pill' id='delete_song' name='delete_song' value='Proceed'>
																															<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																														</div>
																													</div>
																												</div>
																											</div>
																											<script type="text/javascript">
																												document.addEventListener('DOMContentLoaded', function() {
																													$("#deleteArtistSongSelect").change(function() {
																														if ($(this).children(":selected").val() != "") {
																															var selectedVal = $("#deleteArtistSongSelect option:selected").val();
																															$("#deleteSongModalButton").attr("data-target", "");
																															$("#deleteSongModal").load(window.location.href + " #deleteSongModal");
																															// AJAX Request
																															$.ajax({
																																url: 'ajax_select.php',
																																type: 'post',
																																data: {
																																	deleteSongArtist_id: selectedVal
																																},
																																dataType: 'json',
																																success: function(data) {
																																	var len = data.length;

																																	$("#delete_select_song").empty();
																																	if (len) {
																																		$("#delete_select_song").append("<option value='' data-songName=''>Select Song</option>");
																																	} else {
																																		$("#deleteSongModalButton").attr("data-target", "");
																																	}
																																	for (var i = 0; i < len; i++) {
																																		var id = data[i]['id'];
																																		var name = data[i]['name'];
																																		$("#delete_select_song").append("<option value='" + id + "' data-songName='" + name + "'>" + name + "</option>");
																																	}
																																}
																															});
																															$("#delete_select_song").removeAttr("disabled");
																														} else {
																															$("#delete_select_song").attr("disabled", "disabled");
																														}
																													});
																													$("#delete_select_song").change(function() {
																														var selectedVal = $("#delete_select_song option:selected").val();
																														if (selectedVal == "") {
																															$("#deleteSongModalButton").attr("data-target", "");
																														} else {
																															var songName = $("#delete_select_song option:selected").attr("data-songName");
																															$("#deleteSongModalButton").attr("data-target", "#deleteSong-modal_" + selectedVal);
																															$(".deleteSong-modal").attr("id", "deleteSong-modal_" + selectedVal);
																															$("#deleteSong-modalLabel b.songNameInject").text(songName);
																														}
																													});
																												});
																											</script>
																										</form>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// DELETE VIDEO TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="deleteVideo" role="tabpanel" aria-labelledby="deleteVideo-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">DELETE VIDEO</h5>
																										</div>
																										<form class="" action="" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="deleteArtistVideoSelect" class="font-weight-bolder">Select Artist:</label>
																														<?php // Select app details
																														$queryDelArtist = mysqli_query($dbcon, "SELECT * FROM artist ORDER BY artist_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelArtist) > 0) {
																															echo "<select class='form-control select_artist-single' id='deleteArtistVideoSelect' name='select_artist' required>
              										<option value=''></option>";
																															while ($fetch_artist = mysqli_fetch_assoc($queryDelArtist)) {
																																// fetch the records
																																$artist_id   = $purifier->purify($fetch_artist['artist_id']);
																																$artist_name = $purifier->purify($fetch_artist['artist_name']);

																																echo "<option value='$artist_id' data-artistName='$artist_name'>$artist_name</option>";
																															}
																															echo "</select>";
																														} else echo "<div class='card-text'>There are no artists yet!</div>";
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="delete_select_video" class="font-weight-bolder">Select Video:</label>
																														<select class="form-control" name="select_video" id="delete_select_video" disabled required>
																															<option value="">Select Video</option>
																														</select>
																													</div>
																												</div>
																												<div class="form-group">
																													<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																													<p class='text-muted'>Deleting this video will remove everything affiliated with the video both from the database and its directiory!</p>
																												</div>
																											</div>
																											<div class="card-footer">
																												<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteVideoModalButton' data-toggle='modal' data-target=''>Delete Video</button>
																											</div>
																											<div class="modal fade deleteVideo-modal" id="" tabindex="-1" aria-labelledby="deleteVideo-modalLabel" aria-hidden="true" role="dialog">
																												<div class="modal-dialog" role="document" id="deleteVideoModal">
																													<div class="modal-content card border-danger">
																														<div class="modal-header">
																															<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																															<h6 class="modal-title" id="deleteVideo-modalLabel">Are you sure you want to delete <b class="videoNameInject" style="color:blue;"></b>.
																																<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																															</h6>
																														</div>
																														<div class="modal-body content-justify-center text-center">
																															<input type='submit' class='btn emc_btn btn-sm delete_video rounded-pill' id='delete_video' name='delete_video' value='Proceed'>
																															<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																														</div>
																													</div>
																												</div>
																											</div>
																											<script type="text/javascript">
																												document.addEventListener('DOMContentLoaded', function() {
																													$("#deleteArtistVideoSelect").change(function() {
																														if ($(this).children(":selected").val() != "") {
																															var selectedVal = $("#deleteArtistVideoSelect option:selected").val();
																															$("#deleteVideoModalButton").attr("data-target", "");
																															$("#deleteVideoModal").load(window.location.href + " #deleteVideoModal");
																															// AJAX Request
																															$.ajax({
																																url: 'ajax_select.php',
																																type: 'post',
																																data: {
																																	deleteVideoArtist_id: selectedVal
																																},
																																dataType: 'json',
																																success: function(data) {
																																	var len = data.length;

																																	$("#delete_select_video").empty();
																																	if (len) {
																																		$("#delete_select_video").append("<option value='' data-videoName=''>Select Video</option>");
																																	} else {
																																		$("#deleteVideoModalButton").attr("data-target", "");
																																	}
																																	for (var i = 0; i < len; i++) {
																																		var id = data[i]['id'];
																																		var name = data[i]['name'];
																																		$("#delete_select_video").append("<option value='" + id + "' data-videoName='" + name + "'>" + name + "</option>");
																																	}
																																}
																															});
																															$("#delete_select_video").removeAttr("disabled");
																														} else {
																															$("#delete_select_video").attr("disabled", "disabled");
																														}
																													});
																													$("#delete_select_video").change(function() {
																														var selectedVal = $("#delete_select_video option:selected").val();
																														if (selectedVal == "") {
																															$("#deleteVideoModalButton").attr("data-target", "");
																														} else {
																															var videoName = $("#delete_select_video option:selected").attr("data-videoName");
																															$("#deleteVideoModalButton").attr("data-target", "#deleteVideo-modal_" + selectedVal);
																															$(".deleteVideo-modal").attr("id", "deleteVideo-modal_" + selectedVal);
																															$("#deleteVideo-modalLabel b.videoNameInject").text(videoName);
																														}
																													});
																												});
																											</script>
																										</form>
																									</div>
																								<?php
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
																							<!-- /////////////////////////// DELETE GENRE TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="deleteGenre" role="tabpanel" aria-labelledby="deleteGenre-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">DELETE GENRE</h5>
																										</div>
																										<form class="" action="index.php" method="post" enctype='multipart/form-data'>
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Select Genre:</label>
																														<?php // Select app details
																														$queryDelGenre = mysqli_query($dbcon, "SELECT * FROM genre ORDER BY genre_name");
																														// Check the result:
																														if (mysqli_num_rows($queryDelGenre) > 0) {
																															echo "<select class='form-control' id='deleteGenreSelect' name='select_genre' required>
              										<option value=''>Select Genre</option>";
																															while ($fetch_genre = mysqli_fetch_assoc($queryDelGenre)) {
																																// fetch the records
																																$genre_id   = $purifier->purify($fetch_genre['genre_id']);
																																$genre_name = $purifier->purify($fetch_genre['genre_name']);

																																echo "<option value='$genre_id' data-genreName='$genre_name'>$genre_name</option>";
																															}
																															echo "</select>";
																														} else echo "<div class='card-text'>There are no genre yet!</div>";
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<h6 class="font-weight-bolder text-center" style="color:red;">WARNING!</h6>
																														<p class='text-muted'>Deleting this genre will remove everything affiliated with the genre both from the database and its directiory!</p>
																													</div>
																												</div>
																											</div>
																											<div class="card-footer">
																												<button type='button' class='btn emc_btn btn-sm btn-block rounded-pill' name='' id='deleteGenreModalButton' data-toggle='modal' data-target=''>Delete Genre</button>
																											</div>
																											<div class="modal fade deleteGenre-modal" id="" tabindex="-1" aria-labelledby="deleteGenre-modalLabel" aria-hidden="true" role="dialog">
																												<div class="modal-dialog" role="document">
																													<div class="modal-content card border-danger">
																														<div class="modal-header">
																															<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																															<h6 class="modal-title" id="deleteGenre-modalLabel">Are you sure you want to delete <b class="genreNameInject" style="color:blue;"></b>.
																																<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																															</h6>
																														</div>
																														<div class="modal-body content-justify-center text-center">
																															<input type='submit' class='btn emc_btn btn-sm delete_genre rounded-pill' id='delete_genre' name='delete_genre' value='Proceed'>
																															<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																														</div>
																													</div>
																												</div>
																											</div>
																											<script type="text/javascript">
																												document.addEventListener('DOMContentLoaded', function() {
																													$("#deleteGenreSelect").change(function() {
																														var selectedVal = $("#deleteGenreSelect option:selected").val();
																														if (selectedVal == "") {
																															$("#deleteGenreModalButton").attr("data-target", "");
																														} else {
																															var genreName = $("#deleteGenreSelect option:selected").attr("data-genreName");
																															$("#deleteGenreModalButton").attr("data-target", "#deleteGenre-modal_" + selectedVal);
																															$(".deleteGenre-modal").attr("id", "deleteGenre-modal_" + selectedVal);
																															$("#deleteGenre-modalLabel b.genreNameInject").text(genreName);
																														}
																													});
																												});
																											</script>
																										</form>
																									</div>
																								<?php
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
																							<!-- End of Post, Artist, Album, Audio, Video, Genre display/Modification -->


																							<!-- Beginning of Messages display/Modification -->
																							<!-- /////////////////////////// DISPLAY MESSAGES TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="adminMsg" role="tabpanel" aria-labelledby="adminMsg-tab">
																								<ul class="nav nav-tabs nav-justified" id="messagesTab" role="tablist" style="white-space: nowrap;">
																									<li class="nav-item" role="presentation">
																										<a class="nav-link active" id="admin_users_msg-tab" data-toggle="tab" href="#admin_users_msg" role="tab" aria-controls="admin_users_msg" aria-selected="true">Admin-Users Messages
																											<?php if (!empty($unread_msgReply)) echo "<span class='badge badge-pill admin_msgReply'>$unread_msgReply</span>"; ?></a></a>
																									</li>
																									<li class="nav-item" role="presentation">
																										<a class="nav-link" id="contactForm_msg-tab" data-toggle="tab" href="#contactForm_msg" role="tab" aria-controls="contactForm_msg" aria-selected="false">Contact Form Messages
																											<?php if (!empty($unread_contactUsMsg)) echo "<span class='badge badge-pill contactUs_msg'>$unread_contactUsMsg</span>"; ?></a>
																									</li>
																								</ul>
																								<div class="tab-content" id="msgTabContent">
																									<!-- ADMIN TO USERS MESSAGES -->
																									<div class="tab-pane fade show active" id="admin_users_msg" role="tabpanel" aria-labelledby="admin_users_msg-tab">
																										<?php
																										try { // Count number of messages for display in form
																											$countAdminMsg_id = mysqli_query($dbcon, "SELECT admin_msg_id FROM admin_msg");
																											$countAdminMsg_id_result = mysqli_num_rows($countAdminMsg_id);
																											if ($countAdminMsg_id_result > 0) {
																												echo "<div class='card mb-1'>
											<div class='card-header'>Total Messages: $countAdminMsg_id_result</div>
											</div>";
																											}

																											// set the number of rows per display page
																											$Adminpagerows = 20;
																											// Has the totla number of pages already been calculated?
																											if (isset($_GET['Amp'])) {
																												$Adminpages = filter_var($_GET['Amp'], FILTER_SANITIZE_NUMBER_INT);
																											} else { // use the next block of code to calculate the number of pages
																												// First, check for the total number of records
																												$countAdminMsg = "SELECT COUNT(admin_msg_id) FROM admin_msg";
																												$countAdminMsg_result = mysqli_query($dbcon, $countAdminMsg);
																												$fetch_countAdminMsg = mysqli_fetch_array($countAdminMsg_result, MYSQLI_NUM);
																												$Adminrecords = htmlspecialchars($fetch_countAdminMsg[0], ENT_QUOTES);
																												// Now calculate the number of pages
																												if ($Adminrecords > $Adminpagerows) {
																													// If the number of records will fill more than one page
																													// calculate the number of pages and round the result up to the nearest integer
																													$Adminpages = ceil($Adminrecords / $Adminpagerows);
																												} else {
																													$Adminpages = 1;
																												}
																											} // page check finished

																											// Declare which record to start with
																											if ((isset($_GET['Ams']))) {
																												$Adminstart = filter_var($_GET['Ams'], FILTER_SANITIZE_NUMBER_INT);
																												// Make sure it is not executable XSS
																											} else {
																												$Adminstart = 0;
																											}

																											// Make the query
																											$queryAdminMsg = "SELECT admin_msg.admin_msg_id AS id, admin_msg.msg_header, admin_msg.message, admin_msg.user_level, admin_msg.user_id,
										admin_msg.opened, DATE_FORMAT(admin_msg.date_time, '%d %M, %Y %r') AS date_time, users.user_id, users.first_name, users.last_name,
										users.email, admin_msg_reply.admin_msg_id FROM admin_msg LEFT JOIN users ON admin_msg.user_id = users.user_id LEFT JOIN admin_msg_reply
										ON admin_msg.admin_msg_id=admin_msg_reply.admin_msg_id ORDER BY admin_msg_reply.admin_msg_reply_id DESC LIMIT ?, ?"; //WHERE admin_msg.user_from=2
																											$q = mysqli_stmt_init($dbcon);
																											mysqli_stmt_prepare($q, $queryAdminMsg);
																											// use prepared statement to ensure that only text is inserted
																											// bind fields to SQL statement
																											mysqli_stmt_bind_param($q, 'ii', $Adminstart, $Adminpagerows);
																											// execute the query
																											mysqli_stmt_execute($q);
																											$queryAdminMsg_result = mysqli_stmt_get_result($q);

																											// check for result
																											$query_AdminNum = mysqli_num_rows($queryAdminMsg_result);
																											if ($query_AdminNum > 0) { ?>
																												<div class='card shadow'>
																													<table class="table table-responsive">
																														<thead class="thead-light">
																															<tr>
																																<th scope="col">#</th>
																																<th scope="col">Delete_Message</th>
																																<th scope="col">Message</th>
																																<th scope="col">Message_From</th>
																																<th scope="col">Message_To</th>
																																<th scope="col">User_ID</th>
																																<th scope="col">Email</th>
																																<th scope="col">Seen?</th>
																																<th scope="col">Date/Time_Sent</th>
																																<th style="width:100%"></th>
																															</tr>
																														</thead>
																														<?php
																														$AdminMsgRow = $Adminstart + 1;
																														while ($fetch_AdminMsg = mysqli_fetch_assoc($queryAdminMsg_result)) {
																															// fetch the records
																															$admin_msg_id  = $purifier->purify($fetch_AdminMsg['id']);
																															$admin_msgHeader  = $purifier->purify($fetch_AdminMsg['msg_header']);
																															$admin_message  = $purifier->purify($fetch_AdminMsg['message']);
																															$user_from  = $purifier->purify($fetch_AdminMsg['user_level']);
																															$user_to  = $purifier->purify($fetch_AdminMsg['user_id']);
																															$opened  = $purifier->purify($fetch_AdminMsg['opened']);
																															$date_time  = $purifier->purify($fetch_AdminMsg['date_time']);
																															$user_id  = $purifier->purify($fetch_AdminMsg['user_id']);
																															$first_name   = $purifier->purify($fetch_AdminMsg['first_name']);
																															$last_name  = $purifier->purify($fetch_AdminMsg['last_name']);
																															$email  = $purifier->purify($fetch_AdminMsg['email']);

																															if (!empty($admin_msgHeader)) {
																																$admin_message = "<h6 class=''><b>$admin_msgHeader</b></h6><br>$admin_message";
																															}
																															$user_from = $user_from == 71 ? "Admin" : $user_from;
																															$user_to = $user_to == "" or NULL ? "Unknown" : $user_to;
																															$fullname = $first_name . " " . $last_name;

																															echo "
														<tbody>
														<tr>
															<th scope='row'>$AdminMsgRow</th>
															<td><button type='button' class='btn emc_btn btn-sm rounded-pill' name='' id='deleteAdminMsg_$admin_msg_id' data-id='$admin_msg_id' data-name='$fullname message(s)' data-toggle='modal' data-target=''>Delete_Message</button></td>
															<td style='min-width:300px;'>$admin_message</td>
															<td>$user_from</td>
															<td>$fullname</td>
															<td>$user_id</td>
															<td>$email</td>
															<td>$opened</td>
															<td>$date_time</td>
															<td>";
																															// Select reply messages
																															$replyMsg = mysqli_query($dbcon, "SELECT  admin_msg_reply.message, DATE_FORMAT(admin_msg_reply.date_time, '%d %M, %Y %r')
																AS date_time, users.user_id, users.first_name, users.last_name, users.email FROM admin_msg_reply LEFT JOIN users ON
																admin_msg_reply.user_id = users.user_id WHERE admin_msg_reply.admin_msg_id = $admin_msg_id ORDER BY admin_msg_reply.admin_msg_id DESC");
																															// Check the result:
																															if (mysqli_num_rows($replyMsg) > 0) {
																																echo '<tr class="thead-light">
																	<th scope="col">Reply_From</th>
																	<th scope="col">User ID</th>
																	<th scope="col" style="min-width:300px;">Message Reply</th>
																	<th scope="col">Email</th>
																	<th scope="col">Date/Time_Sent</th>
																	</tr>';
																																while ($fetch_replyMsg = mysqli_fetch_assoc($replyMsg)) {
																																	// Fetch the records
																																	$user_message = $purifier->purify($fetch_replyMsg['message']);
																																	$replyTime  = $purifier->purify($fetch_replyMsg['date_time']);
																																	$user_messageReplyID = $purifier->purify($fetch_replyMsg['user_id']);
																																	$user_messageReplyFirst_name = $purifier->purify($fetch_replyMsg['first_name']);
																																	$user_messageReplyLast_name = $purifier->purify($fetch_replyMsg['last_name']);
																																	$user_messageReplyEmail = $purifier->purify($fetch_replyMsg['email']);

																																	if (!empty($user_msgHeader)) {
																																		$user_message = "<h6 class=''><b>$user_msgHeader</b></h6><br>$user_message";
																																	}
																																	$user_messageReplyFullname = $user_messageReplyFirst_name . " " . $user_messageReplyLast_name;

																																	echo "<tr>
																		<td>$user_messageReplyFullname</td>
																		<td>$user_messageReplyID</td>
																		<td>$user_message</td>
																		<td>$user_messageReplyEmail</td>
																		<td>$replyTime</td>
																		</tr>";
																																}
																															}
																															echo "</td>"; ?>
																															<div class="modal fade deleteAdminMsg-modal" id="" tabindex="-1" aria-labelledby="deleteAdminMsg-modalLabel" aria-hidden="true" role="dialog">
																																<form class="" action="" method="post">
																																	<div class="modal-dialog" role="document">
																																		<div class="modal-content card border-danger">
																																			<div class="modal-header">
																																				<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																																				<h6 class="modal-title" id="deleteAdminMsg-modalLabel">Are you sure you want to delete <b class="userNameInject" style="color:blue;"></b>.
																																					<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																																				</h6>
																																			</div>
																																			<div class="modal-body content-justify-center text-center">
																																				<input type="hidden" id='deleteAdminMsg' name="deleteAdminMsgVal" value="">
																																				<input type='submit' class='btn emc_btn btn-sm deleteAdminMsg rounded-pill' id='' name='deleteAdminMsg' value='Proceed'>
																																				<!-- <a type='submit' class='btn emc_btn btn-sm deleteUser rounded-pill' id='deleteAdminMsg' href="">Proceed</a> -->
																																				<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																																			</div>
																																		</div>
																																	</div>
																																</form>
																															</div>
																															<script type="text/javascript">
																																document.addEventListener('DOMContentLoaded', function() {
																																	$("#deleteAdminMsg_<?php echo $admin_msg_id; ?>").click(function() {
																																		var adminMsg_id = $("#deleteAdminMsg_<?php echo $admin_msg_id; ?>").attr("data-id");
																																		var user_name = $("#deleteAdminMsg_<?php echo $admin_msg_id; ?>").attr("data-name");
																																		$("#deleteAdminMsg_<?php echo $admin_msg_id; ?>").attr("data-target", "#deleteAdminMsg-modal_" + adminMsg_id);
																																		$(".deleteAdminMsg-modal").attr("id", "deleteAdminMsg-modal_" + adminMsg_id);
																																		$(".deleteAdminMsg-modal b.userNameInject").text(user_name);
																																		$(".deleteAdminMsg-modal .modal-body input#deleteAdminMsg").attr("value", adminMsg_id);
																																	});
																																});
																															</script>
																															</tr>
																															</tbody>
																														<?php
																															$AdminMsgRow++;
																														}
																														?>
																													</table>
																												</div>
																										<?php
																											} else {
																												echo '<div class="card">
											  <div class="card-body">
											    There are currently no Messages!.
											  </div>
											</div>';
																											}

																											// Make the links to other pages, if necessary.
																											if ($Adminpages > 1) {
																												echo "<div class='card shadow'>
											<div class='card-body text-center justify-content-center'>";
																												// What number is the current page?
																												$AdminMsgcurrent_page = ($Adminstart / $Adminpagerows) + 1;
																												// if the page is not the first page then create a Previous link
																												if ($AdminMsgcurrent_page != 1) {
																													echo '<a class="pagiClickLink" href="index.php?Ams=' . ($Adminstart - $Adminpagerows) .
																														'&Amp=' . $Adminpages . '">Previous</a>';
																												}

																												// Make all the numbered pages:
																												for ($i = 1; $i <= $Adminpages; $i++) {
																													if ($i != $AdminMsgcurrent_page) {
																														echo '<a class="pagiClickLink" href="index.php?Ams=' . (($Adminpagerows * ($i - 1))) . '&Amp=' . $Adminpages . '">' . $i . '</a> ';
																													} else {
																														echo $i . ' ';
																													}
																												}

																												// Create next link
																												if ($AdminMsgcurrent_page != $Adminpages) {
																													echo '<a class="pagiClickLink" href="index.php?Ams=' . ($Adminstart + $Adminpagerows) . '&Amp=' . $Adminpages . '">Next</a>';
																												}
																												echo "</div></div>";
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
																									<!-- CONTACT FORM MESSAGES -->
																									<div class="tab-pane fade" id="contactForm_msg" role="tabpanel" aria-labelledby="contactForm_msg-tab" style="min-width:80vw;">
																										<?php
																										try { // Count number of messages for display in form
																											$countContactMsg_id = mysqli_query($dbcon, "SELECT contact_us_id FROM contact_us");
																											$countContactMsg_id_result = mysqli_num_rows($countContactMsg_id);
																											if ($countContactMsg_id_result > 0) {
																												echo "<div class='card mb-1'>
											<div class='card-header'>Total Messages: $countContactMsg_id_result</div>
											</div>";
																											}

																											// set the number of rows per display page
																											$Contactpagerows = 20;
																											// Has the totla number of pages already been calculated?
																											if (isset($_GET['Cap'])) {
																												$Contactpages = filter_var($_GET['Cap'], FILTER_SANITIZE_NUMBER_INT);
																											} else { // use the next block of code to calculate the number of pages
																												// First, check for the total number of records
																												$countContactMsg = "SELECT COUNT(admin_msg_id) FROM admin_msg";
																												$countContactMsg_result = mysqli_query($dbcon, $countContactMsg);
																												$fetch_countContactMsg = mysqli_fetch_array($countContactMsg_result, MYSQLI_NUM);
																												$Contactrecords = htmlspecialchars($fetch_countContactMsg[0], ENT_QUOTES);
																												// Now calculate the number of pages
																												if ($Contactrecords > $Contactpagerows) {
																													// If the number of records will fill more than one page
																													// calculate the number of pages and round the result up to the nearest integer
																													$Contactpages = ceil($Contactrecords / $Contactpagerows);
																												} else {
																													$Contactpages = 1;
																												}
																											} // page check finished

																											// Declare which record to start with
																											if ((isset($_GET['Cas']))) {
																												$Contactstart = filter_var($_GET['Cas'], FILTER_SANITIZE_NUMBER_INT);
																												// Make sure it is not executable XSS
																											} else {
																												$Contactstart = 0;
																											}

																											// Make the query
																											$queryContactAdminMsg = "SELECT contact_us_id, name, email, phone, service, requirement, message,
										DATE_FORMAT(date_added, '%d %M, %Y %r') AS date_added FROM contact_us ORDER BY contact_us_id DESC LIMIT ?, ?"; //WHERE admin_msg.user_from=2
																											$q = mysqli_stmt_init($dbcon);
																											mysqli_stmt_prepare($q, $queryContactAdminMsg);
																											// use prepared statement to ensure that only text is inserted
																											// bind fields to SQL statement
																											mysqli_stmt_bind_param($q, 'ii', $Contactstart, $Contactpagerows);
																											// execute the query
																											mysqli_stmt_execute($q);
																											$queryContactAdminMsg_result = mysqli_stmt_get_result($q);

																											// check for result
																											$query_ContactAdminNum = mysqli_num_rows($queryContactAdminMsg_result);
																											if ($query_ContactAdminNum > 0) { ?>
																												<div class='card shadow'>
																													<table class="table table-responsive">
																														<thead class="thead-light">
																															<tr>
																																<th scope="col">#</th>
																																<th scope="col">Delete_Message</th>
																																<th scope="col">Message_From</th>
																																<th scope="col">Email</th>
																																<th scope="col">Phone</th>
																																<th scope="col">Service</th>
																																<th scope="col">Requirement</th>
																																<th scope="col">Message</th>
																																<th scope="col">Date/Time_Sent</th>
																																<th style="width:100%"></th>
																															</tr>
																														</thead>
																														<?php
																														$ContactMsgRow = $Contactstart + 1;
																														while ($fetch_contactMsg = mysqli_fetch_assoc($queryContactAdminMsg_result)) {
																															// fetch the records
																															$contact_us_id  = $purifier->purify($fetch_contactMsg['contact_us_id']);
																															$name  = $purifier->purify($fetch_contactMsg['name']);
																															$email  = $purifier->purify($fetch_contactMsg['email']);
																															$phone  = $purifier->purify($fetch_contactMsg['phone']);
																															$service  = $purifier->purify($fetch_contactMsg['service']);
																															$requirement  = $purifier->purify($fetch_contactMsg['requirement']);
																															$message  = $purifier->purify($fetch_contactMsg['message']);
																															$date_added  = $purifier->purify($fetch_contactMsg['date_added']);

																															$phone = $phone == NULL ? "" : $phone;
																															echo "
														<tbody>
														<tr>
															<th scope='row'>$ContactMsgRow</th>
															<td><button type='button' class='btn emc_btn btn-sm rounded-pill' name='' id='deleteContactMsg_$contact_us_id' data-id='$contact_us_id' data-name='$name message' data-toggle='modal' data-target=''>Delete_Message</button></td>
															<td>$name</td>
															<td style='min-width:200px;'>$email</td>
															<td>$phone</td>
															<td style='min-width:150px;'>$service</td>
															<td style='min-width:250px;'>$requirement</td>
															<td style='min-width:300px;'>$message</td>
															<td>$date_added</td>
														<tr>"; ?>
																															<div class="modal fade deleteContactMsg-modal" id="" tabindex="-1" aria-labelledby="deleteContactMsg-modalLabel" aria-hidden="true" role="dialog">
																																<form class="" action="" method="post">
																																	<div class="modal-dialog" role="document">
																																		<div class="modal-content card border-danger">
																																			<div class="modal-header">
																																				<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																																				<h6 class="modal-title" id="deleteContactMsg-modalLabel">Are you sure you want to delete <b class="NameInject" style="color:blue;"></b>.
																																					<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																																				</h6>
																																			</div>
																																			<div class="modal-body content-justify-center text-center">
																																				<input type="hidden" id='deleteContactMsg' name="deleteContactMsgVal" value="">
																																				<input type='submit' class='btn emc_btn btn-sm deleteContactMsg rounded-pill' id='' name='deleteContactMsg' value='Proceed'>
																																				<!-- <a type='submit' class='btn emc_btn btn-sm deleteUser rounded-pill' id='deleteContactMsg' href="">Proceed</a> -->
																																				<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																																			</div>
																																		</div>
																																	</div>
																																</form>
																															</div>
																															<script type="text/javascript">
																																document.addEventListener('DOMContentLoaded', function() {
																																	$("#deleteContactMsg_<?php echo $contact_us_id; ?>").click(function() {
																																		var contact_us_id = $("#deleteContactMsg_<?php echo $contact_us_id; ?>").attr("data-id");
																																		var user_name = $("#deleteContactMsg_<?php echo $contact_us_id; ?>").attr("data-name");
																																		$("#deleteContactMsg_<?php echo $contact_us_id; ?>").attr("data-target", "#deleteContactMsg-modal_" + contact_us_id);
																																		$(".deleteContactMsg-modal").attr("id", "deleteContactMsg-modal_" + contact_us_id);
																																		$(".deleteContactMsg-modal b.NameInject").text(user_name);
																																		$(".deleteContactMsg-modal .modal-body input#deleteContactMsg").attr("value", contact_us_id);
																																	});
																																});
																															</script>
																															</tbody>
																														<?php
																															$ContactMsgRow++;
																														}
																														?>
																													</table>
																												</div>
																										<?php
																											} else {
																												echo '<div class="card">
												  <div class="card-body">
												    There are currently no Messages!.
												  </div>
												</div>';
																											}
																											// Make the links to other pages, if necessary.
																											if ($Contactpages > 1) {
																												echo "<div class='card shadow'>
												<div class='card-body text-center justify-content-center'>";
																												// What number is the current page?
																												$ContactMsgcurrent_page = ($Contactstart / $Contactpagerows) + 1;
																												// if the page is not the first page then create a Previous link
																												if ($ContactMsgcurrent_page != 1) {
																													echo '<a class="pagiClickLink" href="index.php?Cas=' . ($Contactstart - $Contactpagerows) .
																														'&Cap=' . $Contactpages . '">Previous</a>';
																												}

																												// Make all the numbered pages:
																												for ($i = 1; $i <= $Contactpages; $i++) {
																													if ($i != $ContactMsgcurrent_page) {
																														echo '<a class="pagiClickLink" href="index.php?Cas=' . (($Contactpagerows * ($i - 1))) . '&Cap=' . $Contactpages . '">' . $i . '</a> ';
																													} else {
																														echo $i . ' ';
																													}
																												}

																												// Create next link
																												if ($ContactMsgcurrent_page != $Contactpages) {
																													echo '<a class="pagiClickLink" href="index.php?Cas=' . ($Contactstart + $Contactpagerows) . '&Cap=' . $Contactpages . '">Next</a>';
																												}
																												echo "</div></div>";
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
																								</div>
																							</div>
																							<!-- /////////////////////////// WRITE/EDIT MESSAGES TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="wrtMsg" role="tabpanel" aria-labelledby="wrtMsg-tab">
																								<?php
																								try {
																								?>
																									<div class='card shadow'>
																										<div class="card-header">
																											<h5 class="card-title text-center font-weight-bolder text-primary">WRITE MESSAGE</h5>
																										</div>
																										<form class="" action="" method="post" enctype="multipart/form-data">
																											<div class="card-body">
																												<div class="form-row">
																													<div class="form-group col-md-6">
																														<label for="" class="font-weight-bolder">Select User:</label>
																														<?php // Select users
																														$queryMsgUsers = mysqli_query($dbcon, "SELECT user_id, CONCAT_WS(' ', first_name, middle_name, last_name) as select_user_name FROM users ORDER BY user_id");
																														// Check the result:
																														if (mysqli_num_rows($queryMsgUsers) > 0) {
																															echo "<select class='form-control select_artist-single' name='select_user' required>
																	<option value='allUsers'>All users</option>";
																															// fetch the records
																															while ($fetch_queryMsgUsers = mysqli_fetch_assoc($queryMsgUsers)) {
																																$Msguser_id = $purifier->purify($fetch_queryMsgUsers['user_id']);
																																$Msgselect_user_name = $purifier->purify($fetch_queryMsgUsers['select_user_name']);

																																echo "<option value='$Msguser_id'>#$Msguser_id $Msgselect_user_name</option>";
																															}
																															echo "</select>";
																														} else {
																															echo '<select class="form-control">
															<option>No users</option>
														</select>';
																														}
																														?>
																													</div>
																													<div class="form-group col-md-6">
																														<label for="admin_msgHeader" class="font-weight-bolder">Message Header?:</label>
																														<textarea class="expanding form-control" id="admin_msgHeader" spellcheck='true' name="admin_msgHeader" placeholder="Message Header" rows="1" maxlength="100" autocomplete="on"></textarea>
																													</div>
																												</div>
																												<div class="form-group">
																													<label for="adminMessage" class="font-weight-bolder">Message:</label>
																													<textarea name="adminMessage" class="txtEditor txtEditor_required" id="adminMessage"></textarea>
																												</div>
																											</div>
																											<div class="card-footer">
																												<input type='submit' class='btn emc_btn btn-sm btn-block send_adminMsg rounded-pill' id='send_adminMsg' name='send_adminMsg' value='Send'>
																											</div>
																										</form>
																									</div>
																								<?php
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
																							<!-- End of Messages display/Modification -->


																							<!-- Beginning of Users display/Modification -->
																							<!-- /////////////////////////// DISPLAY NEW USERS TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="newUsers" role="tabpanel" aria-labelledby="newUsers-tab">
																								<?php
																								try {
																									// Count number of users for display in form
																									$countNewUser_id = mysqli_query($dbcon, "SELECT user_id FROM users WHERE new_user='yes'");
																									$countNewUser_id_result = mysqli_num_rows($countNewUser_id);
																									if ($countNewUser_id_result > 0) {
																										echo "<div class='card mb-1'>
									<div class='card-header'>Total New Users: $countNewUser_id_result &nbsp;&nbsp;&nbsp;<b><button type='button' class='btn emc_btn btn-sm rounded-pill' name='' id='seenNewUser' style='width:50%;'>Seen All</button></b></div>
									</div>";
																									}

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

																									$result_count = mysqli_query($dbcon, "SELECT COUNT(user_id) As total_records FROM `users` WHERE new_user='yes'");
																									$total_records = mysqli_fetch_array($result_count);
																									$total_records = $total_records['total_records'];
																									$total_no_of_pages = ceil($total_records / $total_records_per_page);
																									$second_last = $total_no_of_pages - 1; // total page minus 1

																									$queryNewUsers = mysqli_query($dbcon, "SELECT users.user_id, users.first_name, users.middle_name, users.last_name, users.user_name, users.email,
								users.gender, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date, users.activated,  user_info.profile_pic, user_address.country,
								user_address.city, user_address.mobile FROM users LEFT JOIN user_info ON users.user_id=user_info.user_id LEFT JOIN user_address
								ON users.user_id = user_address.user_id WHERE users.new_user='yes' ORDER BY users.reg_date DESC LIMIT $offset, $total_records_per_page");

																									if (mysqli_num_rows($queryNewUsers) > 0) { ?>
																										<div class='card shadow'>
																											<table class="table table-responsive">
																												<thead class="thead-light">
																													<tr>
																														<th scope="col">#</th>
																														<th scope="col">Profile_picture</th>
																														<th scope="col">User_ID</th>
																														<th scope="col">First_Name</th>
																														<th scope="col">Middle_Name</th>
																														<th scope="col">Last_Name</th>
																														<th scope="col">@Username</th>
																														<th scope="col">Date_Registered</th>
																														<th scope="col">Email</th>
																														<th scope="col">Country</th>
																														<th scope="col">City</th>
																														<th scope="col">Mobile</th>
																														<th scope="col">Gender</th>
																														<th scope="col">Activated</th>
																													</tr>
																												</thead>
																												<?php
																												// $newUserRow = 1;
																												$newUserRow = $offset + 1;
																												while ($fetch_users = mysqli_fetch_assoc($queryNewUsers)) {
																													// fetch the records
																													$user_id  = $purifier->purify($fetch_users['user_id']);
																													$first_name   = $purifier->purify($fetch_users['first_name']);
																													$middle_name = $purifier->purify($fetch_users['middle_name']);
																													$last_name  = $purifier->purify($fetch_users['last_name']);
																													$user_name  = $purifier->purify($fetch_users['user_name']);
																													$email  = $purifier->purify($fetch_users['email']);
																													$gender  = $purifier->purify($fetch_users['gender']);
																													$reg_date  = $purifier->purify($fetch_users['reg_date']);
																													$activated  = $purifier->purify($fetch_users['activated']);
																													$profile_pic  = $purifier->purify($fetch_users['profile_pic']);
																													$country  = $purifier->purify($fetch_users['country']);
																													$city  = $purifier->purify($fetch_users['city']);
																													$mobile  = $purifier->purify($fetch_users['mobile']);

																													$middle_name = (!empty($middle_name)) ? $middle_name : "";
																													$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																													$country = (!empty($country)) ? $country : "";
																													$city = (!empty($city)) ? $city : "";
																													$mobile = (!empty($mobile)) ? $mobile : "";
																													$fullname = $first_name . " " . $middle_name . " " . $last_name;
																													$profile_pic = (!empty($profile_pic)) ? "../$profile_pic" : $adminPicture;

																													echo "
												<tbody>
												<tr>
													<th scope='row'>$newUserRow</th>
													<td><img src='$profile_pic' alt='$last_name' class='img-thumbnail' style='height:120px; width:120px;'></td>
													<td>$user_id</td>
													<td>$first_name</td>
													<td>$middle_name</td>
													<td>$last_name</td>
													<td>$user_name</td>
													<td>$reg_date</td>
													<td>$email</td>
													<td>$country</td>
													<td>$city</td>
													<td>$mobile</td>
													<td>$gender</td>
													<td>$activated</td>"; ?>
																													</tr>
																													</tbody>
																												<?php
																													$newUserRow++;
																												}
																												?>
																											</table>
																										</div>
																								<?php
																									} else {
																										echo '<div class="card">
									  <div class="card-body">
									    There are currently no new users.
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
																											echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $previous_page . '&NewU=' . $NewU .
																												'"aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
																										}

																										// Make all the numbered pages:
																										if ($total_no_of_pages <= 10) {
																											for ($i = 1; $i <= $total_no_of_pages; $i++) {
																												if ($i != $page_no) {
																													echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '&NewU=' . $NewU . '">' . $i . '</a></li>';
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
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '&NewU=' . $NewU . '">' . $i . '</a></li>';
																													}
																												}
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $second_last . '&NewU=' . $NewU . '">' . $second_last . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $total_no_of_pages . '&NewU=' . $NewU . '">' . $total_no_of_pages . '</a></li>';
																											} elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 1 . '&NewU=' . $NewU . '">' . 1 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 2 . '&NewU=' . $NewU . '">' . 2 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												for ($i = $page_no - $adjacents; $i <= $page_no + $adjacents; $i++) {
																													if ($i == $page_no) {
																														echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																													} else {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '&NewU=' . $NewU . '">' . $i . '</a></li>';
																													}
																												}
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $second_last . '&NewU=' . $NewU . '&NewU=' . $NewU . '">' . $second_last . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $total_no_of_pages . '&NewU=' . $NewU . '&NewU=' . $NewU . '">' . $total_no_of_pages . '</a></li>';
																											} else {
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 1 . '&NewU=' . $NewU . '">' . 1 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . 2 . '&NewU=' . $NewU . '">' . 2 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												for ($i = $total_no_of_pages - 6; $i <= $total_no_of_pages; $i++) {
																													if ($i == $page_no) {
																														echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																													} else {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $i . '&NewU=' . $NewU . '">' . $i . '</a></li>';
																													}
																												}
																											}
																										}

																										// Create next link
																										if ($page_no < $total_no_of_pages) {
																											echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_no=' . $next_page . '&NewU=' . $NewU .
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
																							<!-- /////////////////////////// DISPLAY USERS TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="displayUsers" role="tabpanel" aria-labelledby="displayUsers-tab">
																								<?php
																								try {
																									// Count number of users for display in form
																									$countUser_id = mysqli_query($dbcon, "SELECT user_id FROM users");
																									$countUser_id_result = mysqli_num_rows($countUser_id);
																									if ($countUser_id_result > 0) {
																										echo "<div class='card mb-1'>
									<div class='card-header'>Total Users: $countUser_id_result</div>
									</div>";
																									}

																									// set the number of rows per display page
																									$pagerows = 20;
																									// Has the totla number of pages already been calculated?
																									if (isset($_GET['page_num'])) {
																										$page_num = filter_var($_GET['page_num'], FILTER_SANITIZE_NUMBER_INT);
																									} else { // use the next block of code to calculate the number of pages
																										$page_num = 1;
																									} // page check finished
																									$off_set = ($page_num - 1) * $pagerows;
																									$prev_page = $page_num - 1;
																									$nextPage = $page_num + 1;
																									$adjacent = 2;

																									$result_counted = mysqli_query($dbcon, "SELECT COUNT(user_id) As total_records FROM `users`");
																									$total_record = mysqli_fetch_array($result_counted);
																									$total_record = $total_record['total_records'];
																									$total_no_of_page = ceil($total_record / $pagerows);
																									$secondLast = $total_no_of_page - 1; // total page minus 1

																									// Determine the sort...
																									// Default is by registration date.
																									$sort = (isset($_GET['srt'])) ? $_GET['srt'] : 'ud';

																									// Determine the sorting order:
																									switch ($sort) {
																										case 'ln':
																											$order_by = 'last_name ASC';
																											break;
																										case 'fn':
																											$order_by = 'first_name ASC';
																											break;
																										case 'rd':
																											$order_by = 'users.reg_date DESC';
																											break;
																										case 'ud':
																											$order_by = 'user_id ASC';
																											break;
																										default:
																											$order_by = 'user_id ASC';
																											$sort = 'ud';
																											break;
																									}

																									// Make the query
																									$queryUsers = "SELECT users.user_id, users.first_name, users.middle_name, users.last_name, users.user_name, users.email,
								users.gender, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date, users.activated,  user_info.profile_pic, user_address.country,
								user_address.city, user_address.mobile FROM users LEFT JOIN user_info ON users.user_id=user_info.user_id LEFT JOIN user_address
								ON users.user_id = user_address.user_id ORDER BY $order_by LIMIT ?, ?";
																									$q = mysqli_stmt_init($dbcon);
																									mysqli_stmt_prepare($q, $queryUsers);
																									// use prepared statement to ensure that only text is inserted
																									// bind fields to SQL statement
																									mysqli_stmt_bind_param($q, 'ii', $off_set, $pagerows);
																									// execute the query
																									mysqli_stmt_execute($q);
																									$queryUsers_result = mysqli_stmt_get_result($q);

																									if (mysqli_num_rows($queryUsers_result) > 0) { ?>
																										<div class='card shadow'>
																											<table class="table table-responsive">
																												<thead class="thead-light">
																													<tr>
																														<th scope="col">#</th>
																														<th scope="col">Delete_user</th>
																														<th scope="col">Profile_picture</th>
																														<th scope="col">User_ID</th>
																														<th scope="col"><strong><a class="usersClickLink" href="index.php?srt=fn">First_Name</a></strong></th>
																														<th scope="col">Middle_Name</th>
																														<th scope="col"><strong><a class="usersClickLink" href="index.php?srt=ln">Last_Name</a></strong></th>
																														<th scope="col">@Username</th>
																														<th scope="col"><strong><a class="usersClickLink" href="index.php?srt=rd">Date_Registered</a></strong></th>
																														<th scope="col">Email</th>
																														<th scope="col">Country</th>
																														<th scope="col">City</th>
																														<th scope="col">Mobile</th>
																														<th scope="col">Gender</th>
																														<th scope="col">Activated</th>
																													</tr>
																												</thead>
																												<?php
																												// $userRow = 1;
																												$userRow = $off_set + 1;
																												while ($fetch_users = mysqli_fetch_assoc($queryUsers_result)) {
																													// fetch the records
																													$user_id  = $purifier->purify($fetch_users['user_id']);
																													$first_name   = $purifier->purify($fetch_users['first_name']);
																													$middle_name = $purifier->purify($fetch_users['middle_name']);
																													$last_name  = $purifier->purify($fetch_users['last_name']);
																													$user_name  = $purifier->purify($fetch_users['user_name']);
																													$email  = $purifier->purify($fetch_users['email']);
																													$gender  = $purifier->purify($fetch_users['gender']);
																													$reg_date  = $purifier->purify($fetch_users['reg_date']);
																													$activated  = $purifier->purify($fetch_users['activated']);
																													$profile_pic  = $purifier->purify($fetch_users['profile_pic']);
																													$country  = $purifier->purify($fetch_users['country']);
																													$city  = $purifier->purify($fetch_users['city']);
																													$mobile  = $purifier->purify($fetch_users['mobile']);

																													$middle_name = (!empty($middle_name)) ? $middle_name : "";
																													$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																													$country = (!empty($country)) ? $country : "";
																													$city = (!empty($city)) ? $city : "";
																													$mobile = (!empty($mobile)) ? $mobile : "";
																													$fullname = $first_name . " " . $middle_name . " " . $last_name;
																													$profile_pic = (!empty($profile_pic)) ? "../$profile_pic" : $adminPicture;

																													echo "
												<tbody>
												<tr>
													<th scope='row'>$userRow</th>
													<td><button type='button' class='btn emc_btn btn-sm rounded-pill' name='' id='deleteUser_$user_id' data-id='$user_id' data-name='$fullname' data-toggle='modal' data-target=''>Delete_User</button></td>
													<td><img src='$profile_pic' alt='$last_name' class='img-thumbnail' style='height:120px; width:120px;'></td>
													<td>$user_id</td>
													<td>$first_name</td>
													<td>$middle_name</td>
													<td>$last_name</td>
													<td>$user_name</td>
													<td>$reg_date</td>
													<td>$email</td>
													<td>$country</td>
													<td>$city</td>
													<td>$mobile</td>
													<td>$gender</td>
													<td>$activated</td>"; ?>
																													<div class="modal fade deleteUser-modal" id="" tabindex="-1" aria-labelledby="deleteUser-modalLabel" aria-hidden="true" role="dialog">
																														<form class="" action="" method="post">
																															<div class="modal-dialog" role="document">
																																<div class="modal-content card border-danger">
																																	<div class="modal-header">
																																		<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																																		<h6 class="modal-title" id="deleteUser-modalLabel">Are you sure you want to delete <b class="userNameInject" style="color:blue;"></b>.
																																			<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																																		</h6>
																																	</div>
																																	<div class="modal-body content-justify-center text-center">
																																		<input type="hidden" id='deleteUser' name="deleteUserVal" value="">
																																		<input type='submit' class='btn emc_btn btn-sm deleteUser rounded-pill' name='deleteUser' value='Proceed'>
																																		<!-- <a type='submit' class='btn emc_btn btn-sm deleteUser rounded-pill' id='deleteUser' href="">Proceed</a> -->
																																		<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																																	</div>
																																</div>
																															</div>
																														</form>
																													</div>
																													<script type="text/javascript">
																														document.addEventListener('DOMContentLoaded', function() {
																															$("#deleteUser_<?php echo $user_id; ?>").click(function() {
																																var user_id = $("#deleteUser_<?php echo $user_id; ?>").attr("data-id");
																																var user_name = $("#deleteUser_<?php echo $user_id; ?>").attr("data-name");
																																$("#deleteUser_<?php echo $user_id; ?>").attr("data-target", "#deleteUser-modal_" + user_id);
																																$(".deleteUser-modal").attr("id", "deleteUser-modal_" + user_id);
																																$(".deleteUser-modal b.userNameInject").text(user_name);
																																$(".deleteUser-modal .modal-body input#deleteUser").attr("value", user_id);
																															});
																														});
																													</script>
																													</tr>
																													</tbody>
																												<?php
																													$userRow++;
																												}
																												?>
																											</table>
																										</div>
																								<?php
																									} else {
																										echo '<div class="card">
									  <div class="card-body">
									    There are currently no registered users.
									  </div>
									</div>';
																									}

																									// Make the links to other pages, if necessary.
																									if ($total_no_of_page > 1) {
																										echo "<nav aria-label='Page navigation' class='mt-4'>
  							  <ul class='text-center justify-content-center pagination pagination-sm'>";
																										// What number is the current page?
																										// $current_page = ($offset/$total_records_per_page) + 1;
																										// if the page is not the first page then create a Previous link
																										if ($page_num > 1) {
																											echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $prev_page  . '&srt=' . $sort .
																												'"aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
																										}

																										// Make all the numbered pages:
																										if ($total_no_of_page <= 10) {
																											for ($i = 1; $i <= $total_no_of_page; $i++) {
																												if ($i != $page_num) {
																													echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $i . '&srt=' . $sort . '">' . $i . '</a></li>';
																												} else {
																													echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																												}
																											}
																										} elseif ($total_no_of_page > 10) {
																											if ($page_num <= 4) {
																												for ($i = 1; $i < 8; $i++) {
																													if ($i == $page_num) {
																														echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																													} else {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $i . '&srt=' . $sort . '">' . $i . '</a></li>';
																													}
																												}
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $secondLast . '&srt=' . $sort . '">' . $secondLast . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $total_no_of_page . '&srt=' . $sort . '">' . $total_no_of_page . '</a></li>';
																											} elseif ($page_num > 4 && $page_num < $total_no_of_page - 4) {
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . 1 . '&srt=' . $sort . '">' . 1 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . 2 . '&srt=' . $sort . '">' . 2 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												for ($i = $page_num - $adjacent; $i <= $page_num + $adjacent; $i++) {
																													if ($i == $page_num) {
																														echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																													} else {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $i . '&srt=' . $sort . '">' . $i . '</a></li>';
																													}
																												}
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $secondLast . '&srt=' . $sort . '">' . $secondLast . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $total_no_of_page . '&srt=' . $sort . '">' . $total_no_of_page . '</a></li>';
																											} else {
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . 1 . '&srt=' . $sort . '">' . 1 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . 2 . '&srt=' . $sort . '">' . 2 . '</a></li>';
																												echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																												for ($i = $total_no_of_page - 6; $i <= $total_no_of_page; $i++) {
																													if ($i == $page_num) {
																														echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																													} else {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $i . '&srt=' . $sort . '">' . $i . '</a></li>';
																													}
																												}
																											}
																										}

																										// Create next link
																										if ($page_num < $total_no_of_page) {
																											echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_num=' . $nextPage . '&srt=' . $sort .
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
																							<!-- /////////////////////////// USERS OTHER INFO TAB ///////////////////////////// -->
																							<div class="tab-pane fade" id="faultyUsers" role="tabpanel" aria-labelledby="faultyUsers-tab">
																								<ul class="nav nav-tabs nav-justified" id="faultyTab" role="tablist" style="white-space: nowrap;">
																									<li class="nav-item" role="presentation">
																										<a class="nav-link active" id="onlineUsers-tab" data-toggle="tab" href="#onlineUsers" role="tab" aria-controls="onlineUsers" aria-selected="true">Online Users</a>
																									</li>
																									<li class="nav-item" role="presentation">
																										<a class="nav-link" id="activation-tab" data-toggle="tab" href="#activation" role="tab" aria-controls="activation" aria-selected="false">Unactivated Account</a>
																									</li>
																									<li class="nav-item" role="presentation">
																										<a class="nav-link" id="reportUsers-tab" data-toggle="tab" href="#reportUsers" role="tab" aria-controls="reportUsers" aria-selected="false">Reported Account</a>
																									</li>
																									<li class="nav-item" role="presentation">
																										<a class="nav-link" id="blockedUser-tab" data-toggle="tab" href="#blockedUser" role="tab" aria-controls="blockedUser" aria-selected="false">Blocked Account</a>
																									</li>
																								</ul>
																								<div class="tab-content" id="myTabContent">
																									<!-- ONLINE USERS -->
																									<div class="tab-pane fade show active" id="onlineUsers" role="tabpanel" aria-labelledby="onlineUsers-tab">
																										<?php
																										try {
																											// set the number of rows per display page
																											$num_records_per_page = 20;
																											// Has the totla number of pages already been calculated?
																											if (isset($_GET['page_number'])) {
																												$page_number = filter_var($_GET['page_number'], FILTER_SANITIZE_NUMBER_INT);
																											} else { // use the next block of code to calculate the number of pages
																												$page_number = 1;
																											} // page check finished
																											$start = ($page_number - 1) * $num_records_per_page;
																											$prev_P = $page_number - 1;
																											$next_P = $page_number + 1;
																											$interval = 2;

																											$resultCount = mysqli_query($dbcon, "SELECT COUNT(user_id) As total_records FROM `users` WHERE TIMESTAMPDIFF(MINUTE, online_time, NOW()) < 10");
																											$totalRecords = mysqli_fetch_array($resultCount);
																											$totalRecords = $totalRecords['total_records'];
																											$total_no_pages = ceil($totalRecords / $num_records_per_page);
																											$sec_last = $total_no_pages - 1; // total page minus 1

																											$onlineUsers = mysqli_query($dbcon, "SELECT users.user_id, users.first_name, users.middle_name, users.last_name, users.user_name, users.email, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date, users.online_time,
										user_address.country, user_address.city, user_address.mobile FROM users LEFT JOIN user_address ON users.user_id = user_address.user_id WHERE TIMESTAMPDIFF(MINUTE, users.online_time, NOW()) < 10 LIMIT $start, $num_records_per_page");
																											if (mysqli_num_rows($onlineUsers) > 0) {
																										?>
																												<div class='card shadow'>
																													<div class="card-header">
																														<?php // Count number of users for display in form
																														$countOnlineUser_id = mysqli_query($dbcon, "SELECT user_id, online_time FROM users WHERE TIMESTAMPDIFF(MINUTE, online_time, NOW()) < 10");
																														$countOnlineUser_id_result = mysqli_num_rows($countOnlineUser_id);
																														if ($countOnlineUser_id_result > 0) {
																															echo "Total online users: $countOnlineUser_id_result";
																														}
																														?>
																													</div>
																													<table class="table table-responsive">
																														<thead class="thead-light">
																															<tr>
																																<th scope="col">#</th>
																																<th scope="col">User ID</th>
																																<th scope="col">First Name</th>
																																<th scope="col">Middle Name</th>
																																<th scope="col">Last Name</th>
																																<th scope="col">@Username</th>
																																<th scope="col">Date Registered</th>
																																<th scope="col">Email</th>
																																<th scope="col">Country</th>
																																<th scope="col">City</th>
																																<th scope="col">Mobile</th>
																															</tr>
																														</thead>
																												<?php
																												// $userRow = 1;
																												$userRow = $start + 1;
																												while ($fetch_onlineUsers = mysqli_fetch_assoc($onlineUsers)) {
																													// fetch the records
																													$user_id  = $purifier->purify($fetch_onlineUsers['user_id']);
																													$first_name   = $purifier->purify($fetch_onlineUsers['first_name']);
																													$middle_name = $purifier->purify($fetch_onlineUsers['middle_name']);
																													$last_name  = $purifier->purify($fetch_onlineUsers['last_name']);
																													$user_name  = $purifier->purify($fetch_onlineUsers['user_name']);
																													$email  = $purifier->purify($fetch_onlineUsers['email']);
																													$reg_date  = $purifier->purify($fetch_onlineUsers['reg_date']);
																													$country  = $purifier->purify($fetch_onlineUsers['country']);
																													$city  = $purifier->purify($fetch_onlineUsers['city']);
																													$mobile  = $purifier->purify($fetch_onlineUsers['mobile']);

																													$middle_name = (!empty($middle_name)) ? $middle_name : "";
																													$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																													$country = (!empty($country)) ? $country : "";
																													$city = (!empty($city)) ? $city : "";
																													$mobile = (!empty($mobile)) ? $mobile : "";
																													$fullname = $first_name . " " . $middle_name . " " . $last_name;

																													echo "
														<tbody>
														<tr>
															<th scope='row'>$userRow</th>
															<td>$user_id</td>
															<td>$first_name</td>
															<td>$middle_name</td>
															<td>$last_name</td>
															<td>$user_name</td>
															<td>$reg_date</td>
															<td>$email</td>
															<td>$country</td>
															<td>$city</td>
															<td>$mobile</td>
														</tr>
													</tbody>";
																													$userRow++;
																												}
																												echo "
												</table>
											</div>";
																											} else {
																												echo '<div class="card">
											  <div class="card-body">
											    There are currently no online users!.
											  </div>
											</div>';
																											}

																											// Make the links to other pages, if necessary.
																											if ($total_no_pages > 1) {
																												echo "<nav aria-label='Page navigation' class='mt-4'>
      							  <ul class='text-center justify-content-center pagination pagination-sm'>";
																												// What number is the current page?
																												// $current_page = ($offset/$total_records_per_page) + 1;
																												// if the page is not the first page then create a Previous link
																												if ($page_number > 1) {
																													echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $prev_P . '&onlU=' . $onlU .
																														'"aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
																												}

																												// Make all the numbered pages:
																												if ($total_no_pages <= 10) {
																													for ($i = 1; $i <= $total_no_pages; $i++) {
																														if ($i != $page_number) {
																															echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $i . '&onlU=' . $onlU . '">' . $i . '</a></li>';
																														} else {
																															echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																														}
																													}
																												} elseif ($total_no_pages > 10) {
																													if ($page_number <= 4) {
																														for ($i = 1; $i < 8; $i++) {
																															if ($i == $page_number) {
																																echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																															} else {
																																echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $i . '&onlU=' . $onlU . '">' . $i . '</a></li>';
																															}
																														}
																														echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $sec_last . '&onlU=' . $onlU . '">' . $sec_last . '</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $total_no_pages . '&onlU=' . $onlU . '">' . $total_no_pages . '</a></li>';
																													} elseif ($page_number > 4 && $page_number < $total_no_pages - 4) {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . 1 . '&onlU=' . $onlU . '">' . 1 . '</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . 2 . '&onlU=' . $onlU . '">' . 2 . '</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																														for ($i = $page_number - $interval; $i <= $page_number + $interval; $i++) {
																															if ($i == $page_number) {
																																echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																															} else {
																																echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $i . '&onlU=' . $onlU . '">' . $i . '</a></li>';
																															}
																														}
																														echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $sec_last . '&onlU=' . $onlU . '">' . $sec_last . '</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $total_no_pages . '&onlU=' . $onlU . '">' . $total_no_pages . '</a></li>';
																													} else {
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . 1 . '&onlU=' . $onlU . '">' . 1 . '</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . 2 . '&onlU=' . $onlU . '">' . 2 . '</a></li>';
																														echo '<li class="page-item"><a class="page-link pagiClickLink">...</a></li>';
																														for ($i = $total_no_pages - 6; $i <= $total_no_pages; $i++) {
																															if ($i == $page_number) {
																																echo '<li class="page-item active" aria-current="page"><a class="page-link pagiClickLink pagiClickLinkDisable" href="">' . $i . '</a></li>';
																															} else {
																																echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $i . '&onlU=' . $onlU . '">' . $i . '</a></li>';
																															}
																														}
																													}
																												}

																												// Create next link
																												if ($page_number < $total_no_pages) {
																													echo '<li class="page-item"><a class="page-link pagiClickLink" href="index.php?page_number=' . $next_P . '&onlU=' . $onlU .
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
																												<!-- UNACTIVATED USERS -->
																												<div class="tab-pane fade" id="activation" role="tabpanel" aria-labelledby="activation-tab">
																													<?php
																													try {
																														$actUsers = mysqli_query($dbcon, "SELECT users.user_id, users.first_name, users.middle_name, users.last_name, users.user_name, users.email, users.activated, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date,
										user_address.country, user_address.city, user_address.mobile FROM users LEFT JOIN user_address ON users.user_id = user_address.user_id WHERE users.activated != NULL OR users.activated != ''");
																														if (mysqli_num_rows($actUsers) > 0) {
																													?>
																															<div class='card shadow'>
																																<table class="table table-responsive">
																																	<thead class="thead-light">
																																		<tr>
																																			<th scope="col">#</th>
																																			<th scope="col">User ID</th>
																																			<th scope="col">First Name</th>
																																			<th scope="col">Middle Name</th>
																																			<th scope="col">Last Name</th>
																																			<th scope="col">@Username</th>
																																			<th scope="col">Date Registered</th>
																																			<th scope="col">Email</th>
																																			<th scope="col">Country</th>
																																			<th scope="col">City</th>
																																			<th scope="col">Mobile</th>
																																			<th scope="col">Activated</th>
																																		</tr>
																																	</thead>
																															<?php
																															$userRow = 1;
																															while ($fetch_actUsers = mysqli_fetch_assoc($actUsers)) {
																																// fetch the records
																																$user_id  = $purifier->purify($fetch_actUsers['user_id']);
																																$first_name   = $purifier->purify($fetch_actUsers['first_name']);
																																$middle_name = $purifier->purify($fetch_actUsers['middle_name']);
																																$last_name  = $purifier->purify($fetch_actUsers['last_name']);
																																$user_name  = $purifier->purify($fetch_actUsers['user_name']);
																																$email  = $purifier->purify($fetch_actUsers['email']);
																																$activated  = $purifier->purify($fetch_actUsers['activated']);
																																$reg_date  = $purifier->purify($fetch_actUsers['reg_date']);
																																$country  = $purifier->purify($fetch_actUsers['country']);
																																$city  = $purifier->purify($fetch_actUsers['city']);
																																$mobile  = $purifier->purify($fetch_actUsers['mobile']);

																																$middle_name = (!empty($middle_name)) ? $middle_name : "";
																																$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																																$country = (!empty($country)) ? $country : "";
																																$city = (!empty($city)) ? $city : "";
																																$mobile = (!empty($mobile)) ? $mobile : "";
																																$fullname = $first_name . " " . $middle_name . " " . $last_name;

																																echo "
														<tbody>
														<tr>
															<th scope='row'>$userRow</th>
															<td>$user_id</td>
															<td>$first_name</td>
															<td>$middle_name</td>
															<td>$last_name</td>
															<td>$user_name</td>
															<td>$reg_date</td>
															<td>$email</td>
															<td>$country</td>
															<td>$city</td>
															<td>$mobile</td>
															<td>$activated</td>
														</tr>
													</tbody>";
																																$userRow++;
																															}
																															echo "
												</table>
											</div>";
																														} else {
																															echo '<div class="card">
											  <div class="card-body">
											    There are currently no unactivated account!.
											  </div>
											</div>';
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
																															<!-- REPORTED USERS -->
																															<div class="tab-pane fade" id="reportUsers" role="tabpanel" aria-labelledby="reportUsers-tab">
																																<?php
																																try {
																																	$reportedUsers = mysqli_query($dbcon, "SELECT users.user_id, users.first_name, users.middle_name, users.last_name, users.user_name, users.email, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date, users.report,
										user_address.country, user_address.city, user_address.mobile FROM users LEFT JOIN user_address ON users.user_id = user_address.user_id WHERE users.report != 0");
																																	if (mysqli_num_rows($reportedUsers) > 0) {
																																?>
																																		<div class='card shadow'>
																																			<table class="table table-responsive">
																																				<thead class="thead-light">
																																					<tr>
																																						<th scope="col">#</th>
																																						<th scope="col">User ID</th>
																																						<th scope="col">First Name</th>
																																						<th scope="col">Middle Name</th>
																																						<th scope="col">Last Name</th>
																																						<th scope="col">@Username</th>
																																						<th scope="col">Date Registered</th>
																																						<th scope="col">Email</th>
																																						<th scope="col">Country</th>
																																						<th scope="col">City</th>
																																						<th scope="col">Mobile</th>
																																					</tr>
																																				</thead>
																																		<?php
																																		$userRow = 1;
																																		while ($fetch_reportedUsers = mysqli_fetch_assoc($reportedUsers)) {
																																			// fetch the records
																																			$user_id  = $purifier->purify($fetch_reportedUsers['user_id']);
																																			$first_name   = $purifier->purify($fetch_reportedUsers['first_name']);
																																			$middle_name = $purifier->purify($fetch_reportedUsers['middle_name']);
																																			$last_name  = $purifier->purify($fetch_reportedUsers['last_name']);
																																			$user_name  = $purifier->purify($fetch_reportedUsers['user_name']);
																																			$email  = $purifier->purify($fetch_reportedUsers['email']);
																																			$reg_date  = $purifier->purify($fetch_reportedUsers['reg_date']);
																																			$country  = $purifier->purify($fetch_reportedUsers['country']);
																																			$city  = $purifier->purify($fetch_reportedUsers['city']);
																																			$mobile  = $purifier->purify($fetch_reportedUsers['mobile']);

																																			$middle_name = (!empty($middle_name)) ? $middle_name : "";
																																			$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																																			$country = (!empty($country)) ? $country : "";
																																			$city = (!empty($city)) ? $city : "";
																																			$mobile = (!empty($mobile)) ? $mobile : "";
																																			$fullname = $first_name . " " . $middle_name . " " . $last_name;

																																			echo "
														<tbody>
														<tr>
															<th scope='row'>$userRow</th>
															<td>$user_id</td>
															<td>$first_name</td>
															<td>$middle_name</td>
															<td>$last_name</td>
															<td>$user_name</td>
															<td>$reg_date</td>
															<td>$email</td>
															<td>$country</td>
															<td>$city</td>
															<td>$mobile</td>
														</tr>
													</tbody>";
																																			$userRow++;
																																		}
																																		echo "
												</table>
											</div>";
																																	} else {
																																		echo '<div class="card">
											  <div class="card-body">
											    There are currently no reported account!.
											  </div>
											</div>';
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
																																		<!-- BLOCKED USERS -->
																																		<div class="tab-pane fade" id="blockedUser" role="tabpanel" aria-labelledby="blockedUser-tab">
																																			<?php
																																			try {
																																				$blockedUsers = mysqli_query($dbcon, "SELECT users.user_id, users.first_name, users.middle_name, users.last_name, users.user_name, users.email, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date, users.blocked_user,
										DATE_FORMAT(users.online_time, '%d %M, %Y %r') AS last_seen, user_address.country, user_address.city, user_address.mobile FROM users LEFT JOIN user_address ON users.user_id = user_address.user_id WHERE users.blocked_user != '0'");
																																				if (mysqli_num_rows($blockedUsers) > 0) {
																																			?>
																																					<div class='card shadow'>
																																						<table class="table table-responsive">
																																							<thead class="thead-light">
																																								<tr>
																																									<th scope="col">#</th>
																																									<th scope="col">User ID</th>
																																									<th scope="col">First Name</th>
																																									<th scope="col">Middle Name</th>
																																									<th scope="col">Last Name</th>
																																									<th scope="col">@Username</th>
																																									<th scope="col">Date Registered</th>
																																									<th scope="col">Email</th>
																																									<th scope="col">Country</th>
																																									<th scope="col">City</th>
																																									<th scope="col">Mobile</th>
																																									<th scope="col">Last Seen</th>
																																								</tr>
																																							</thead>
																																					<?php
																																					$userRow = 1;
																																					while ($fetch_blockedUsers = mysqli_fetch_assoc($blockedUsers)) {
																																						// fetch the records
																																						$user_id  = $purifier->purify($fetch_blockedUsers['user_id']);
																																						$first_name   = $purifier->purify($fetch_blockedUsers['first_name']);
																																						$middle_name = $purifier->purify($fetch_blockedUsers['middle_name']);
																																						$last_name  = $purifier->purify($fetch_blockedUsers['last_name']);
																																						$user_name  = $purifier->purify($fetch_blockedUsers['user_name']);
																																						$email  = $purifier->purify($fetch_blockedUsers['email']);
																																						$reg_date  = $purifier->purify($fetch_blockedUsers['reg_date']);
																																						$last_seen  = $purifier->purify($fetch_blockedUsers['last_seen']);
																																						$country  = $purifier->purify($fetch_blockedUsers['country']);
																																						$city  = $purifier->purify($fetch_blockedUsers['city']);
																																						$mobile  = $purifier->purify($fetch_blockedUsers['mobile']);

																																						$middle_name = (!empty($middle_name)) ? $middle_name : "";
																																						$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																																						$country = (!empty($country)) ? $country : "";
																																						$city = (!empty($city)) ? $city : "";
																																						$mobile = (!empty($mobile)) ? $mobile : "";
																																						$fullname = $first_name . " " . $middle_name . " " . $last_name;

																																						echo "
														<tbody>
														<tr>
															<th scope='row'>$userRow</th>
															<td>$user_id</td>
															<td>$first_name</td>
															<td>$middle_name</td>
															<td>$last_name</td>
															<td>$user_name</td>
															<td>$reg_date</td>
															<td>$email</td>
															<td>$country</td>
															<td>$city</td>
															<td>$mobile</td>
															<td>$last_seen</td>
														</tr>
													</tbody>";
																																						$userRow++;
																																					}
																																					echo "
												</table>
											</div>";
																																				} else {
																																					echo '<div class="card">
											  <div class="card-body">
											    There are currently no blocked account!.
											  </div>
											</div>';
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
																																		</div>
																															</div>
																															<!-- /////////////////////////// SEARCH USERS TAB ///////////////////////////// -->
																															<div class="tab-pane fade" id="searchUsers" role="tabpanel" aria-labelledby="searchUsers-tab">
																																<?php
																																try {
																																?>
																																	<div class='card shadow mb-3'>
																																		<form class="form-inline" action="" method="post">
																																			<table class="table table-responsive">
																																				<thead class="thead-light">
																																					<tr>
																																						<th scope="col">Select user to search</th>
																																						<th scope="col">OR</th>
																																						<th scope="col">Search by user_id</th>
																																						<th scope="col" style="width:100%;"></th>
																																					</tr>
																																				</thead>
																																				<tbody>
																																					<tr>
																																						<td scope="row"><?php // Select app developer details
																																										$querySrchUsers = mysqli_query($dbcon, "SELECT user_id, CONCAT_WS(' ', first_name, middle_name, last_name) as select_user_name FROM users ORDER BY user_id");
																																										// Check the result:
																																										if (mysqli_num_rows($querySrchUsers) > 0) {
																																											echo "<select class='form-control search_userSelt' name='search_userSelt'>
																	<option value=''>Search users</option>";
																																											// fetch the records
																																											while ($fetch_querySrchUsers = mysqli_fetch_assoc($querySrchUsers)) {
																																												$Srchuser_id = $purifier->purify($fetch_querySrchUsers['user_id']);
																																												$Srchselect_user_name = $purifier->purify($fetch_querySrchUsers['select_user_name']);

																																												echo "<option value='$Srchuser_id'>#$Srchuser_id  $Srchselect_user_name</option>";
																																											}
																																											echo "</select><br><br><input type='submit' class='btn emc_btn btn-sm search_user rounded-pill' name='search_user' value='Search user'>";
																																										} else {
																																											echo "<select class='form-control'>
															<option>No users</option>
														</select>";
																																										}
																																										?></td>
																																						<td></td>
																																						<td><input type="number" class="form-control" id="search_userInput" name="search_user" placeholder="Search by ID" autocomplete="off"><br>
																																							<br><input type='submit' class='btn emc_btn btn-sm search_user rounded-pill' name='search_user' value='Search user'>
																																						</td>
																																						<input type='hidden' class='btn emc_btn btn-sm search_userVal rounded-pill' id='search_userVal' name="search_userVal" value="">
																																					</tr>
																																				</tbody>
																																				<script type="text/javascript">
																																					document.addEventListener('DOMContentLoaded', function() {
																																						$(".search_userSelt").change(function() {
																																							var search_userSeltVal = $(".search_userSelt").val();
																																							$("#search_userVal").attr("value", search_userSeltVal);
																																						});
																																						$("#search_userInput").on("blur keyup change", function() {
																																							var search_userIDVal = $("#search_userInput").val();
																																							$("#search_userVal").attr("value", search_userIDVal);
																																						});
																																					});
																																				</script>
																																			</table>
																																		</form>
																																	</div>
																																	<div class="card shadow">
																																		<?php
																																		// Check for search user submit button
																																		if (isset($_POST['search_user'])) {
																																			// --------------------check entries--------------
																																			$search_user = $purifier->purify($_POST['search_userVal']);
																																			if (empty($search_user)) {
																																				header('Location: ' . $_SERVER['PHP_SELF']);
																																			}

																																			$query_searchUsers = "SELECT users.user_id, users.first_name, users.middle_name, users.last_name,
										users.user_name, users.email, DATE_FORMAT(users.reg_date, '%d %M, %Y') AS reg_date, users.activated,  user_info.profile_pic,
										user_address.country, user_address.city, user_address.mobile FROM users LEFT JOIN user_info ON users.user_id = user_info.user_id
										LEFT JOIN user_address ON users.user_id = user_address.user_id WHERE users.user_id=?";

																																			$q = mysqli_stmt_init($dbcon);
																																			mysqli_stmt_prepare($q, $query_searchUsers);
																																			// bind values to SQL statement
																																			mysqli_stmt_bind_param($q, 'i', $search_user);
																																			// execute query
																																			mysqli_stmt_execute($q);
																																			$query_searchUsers = mysqli_stmt_get_result($q);

																																			if (mysqli_num_rows($query_searchUsers) > 0) { ?>
																																				<div class='card shadow'>
																																					<table class="table table-responsive">
																																						<thead class="thead-light">
																																							<tr>
																																								<th scope="col">Delete_user</th>
																																								<th scope="col">Profile_picture</th>
																																								<th scope="col">User_ID</th>
																																								<th scope="col">Full_Name</th>
																																								<th scope="col">@Username</th>
																																								<th scope="col">Date_Registered</th>
																																								<th scope="col">Email</th>
																																								<th scope="col">Country</th>
																																								<th scope="col">City</th>
																																								<th scope="col">Mobile</th>
																																								<th scope="col">Activated</th>
																																							</tr>
																																						</thead>
																																						<?php
																																						while ($fetch_users = mysqli_fetch_assoc($query_searchUsers)) {
																																							// fetch the records
																																							$user_id  = $purifier->purify($fetch_users['user_id']);
																																							$first_name   = $purifier->purify($fetch_users['first_name']);
																																							$middle_name = $purifier->purify($fetch_users['middle_name']);
																																							$last_name  = $purifier->purify($fetch_users['last_name']);
																																							$user_name  = $purifier->purify($fetch_users['user_name']);
																																							$email  = $purifier->purify($fetch_users['email']);
																																							$reg_date  = $purifier->purify($fetch_users['reg_date']);
																																							$activated  = $purifier->purify($fetch_users['activated']);
																																							$profile_pic  = $purifier->purify($fetch_users['profile_pic']);
																																							$country  = $purifier->purify($fetch_users['country']);
																																							$city  = $purifier->purify($fetch_users['city']);
																																							$mobile  = $purifier->purify($fetch_users['mobile']);

																																							$middle_name = (!empty($middle_name)) ? $middle_name : "";
																																							$activated = (empty($activated)) ? "Activated Account" : "Unactivated Account";
																																							$country = (!empty($country)) ? $country : "";
																																							$city = (!empty($city)) ? $city : "";
																																							$mobile = (!empty($mobile)) ? $mobile : "";
																																							$fullname = $first_name . " " . $middle_name . " " . $last_name;
																																							$profile_pic = "../$profile_pic";

																																							echo "
														<tbody>
														<tr>
															<td><button type='button' class='btn emc_btn btn-sm rounded-pill' name='' id='deleteSrchUser_$user_id' data-id='$user_id' data-name='$fullname' data-toggle='modal' data-target='#deleteSrchUser-modal'>Delete_User</button></td>
															<td><img src='$profile_pic' alt='$last_name' class='img-thumbnail' style='height:120px; width:120px;'></td>
															<td>$user_id</td>
															<td>$fullname</td>
															<td>$user_name</td>
															<td>$reg_date</td>
															<td>$email</td>
															<td>$country</td>
															<td>$city</td>
															<td>$mobile</td>
															<td>$activated</td>
														</tr>
													</tbody>";
																																						}
																																						?>
																																					</table>
																																					<div class="modal fade deleteSrchUser-modal" id="deleteSrchUser-modal" tabindex="-1" aria-labelledby="deleteSrchUser-modalLabel" aria-hidden="true" role="dialog">
																																						<form class="" action="" method="post">
																																							<div class="modal-dialog" role="document">
																																								<div class="modal-content card border-danger">
																																									<div class="modal-header">
																																										<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																																										<h6 class="modal-title" id="deleteSrchUser-modalLabel">Are you sure you want to delete <b class="userNameInject" style="color:blue;"><?php echo $fullname; ?></b>.
																																											<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																																										</h6>
																																									</div>
																																									<div class="modal-body content-justify-center text-center">
																																										<input type="hidden" name="deleteSrchUserVal" value="<?php echo $user_id; ?>">
																																										<input type='submit' class='btn emc_btn btn-sm deleteSrchUser rounded-pill' name='deleteSrchUser' value='Proceed'>
																																										<!-- <a type='submit' class='btn emc_btn btn-sm deleteSrchUser rounded-pill' id='deleteSrchUser' href="index.php?deleteSrchUser=<?php //echo $user_id; 
																																																																										?>">Proceed</a> -->
																																										<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																																									</div>
																																								</div>
																																							</div>
																																						</form>
																																					</div>
																																				</div>
																																		<?php
																																			} else {
																																				echo "<div class='card border-danger'>
											  <div class='card-body text-danger'>
											    Sorry! Can't find any user for your search query. Try other users or ID.
											  </div>
											</div>";
																																			}
																																		}
																																		?>
																																	</div>
																																<?php
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
																															<!-- /////////////////////////// INSERT USERS TAB ///////////////////////////// -->
																															<div class="tab-pane fade" id="insertUsers" role="tabpanel" aria-labelledby="insertUsers-tab">
																																<?php
																																try {
																																?>
																																	<div class='card shadow'>
																																		<div class="card-header">
																																			<h5 class="card-title text-center font-weight-bolder text-primary">ADD NEW USER</h5>
																																		</div>
																																		<form class="" action="" method="post" enctype="multipart/form-data">
																																			<div class="card-body">
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_first_name" class="font-weight-bolder">First Name:</label>
																																						<input type="text" class="form-control" id="insert_user_first_name" name="insert_user_first_name" placeholder="First Name" autocomplete="on" required>
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_middle_name" class="font-weight-bolder">Middle Name?:</label>
																																						<input type="text" class="form-control" id="insert_user_middle_name" name="insert_user_middle_name" placeholder="Middle Name" autocomplete="on">
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_last_name" class="font-weight-bolder">Last Name:</label>
																																						<input type="text" class="form-control" id="insert_user_last_name" name="insert_user_last_name" placeholder="Last Name" autocomplete="on" required>
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_nickname" class="font-weight-bolder">Nickname?:</label>
																																						<input type="text" class="form-control" id="insert_user_nickname" name="insert_user_nickname" placeholder="Nick Name" autocomplete="on">
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_name" class="font-weight-bolder">User Name:</label>
																																						<input type="text" class="form-control" id="insert_user_name" name="insert_user_name" placeholder="User Name" autocomplete="on" required>
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_email" class="font-weight-bolder">Email Name:</label>
																																						<input type="email" class="form-control" id="insert_user_email" name="insert_user_email" placeholder="Email" autocomplete="on" required>
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_password" class="font-weight-bolder">Password:</label>
																																						<input type="password" class="form-control" id="insert_user_password" name="insert_user_password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" autocomplete="on" required>
																																						<small id="" class="form-text text-muted">8 or more characters. At least one upper, one lower and one number.</small>
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_conpass" class="font-weight-bolder">Confirm Password:</label>
																																						<input type="password" class="form-control" id="insert_user_conpass" name="insert_user_conpass" placeholder="Comfirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" autocomplete="on" required>
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="" class="font-weight-bolder">Gender(male/female):</label><br>
																																						<input id="Male" name="insert_user_gender" type="radio" class="check" value="male" checked> <label for="Male"><span class="icon"></span> Male</label>&nbsp;&nbsp;
																																						<input id="Female" name="insert_user_gender" type="radio" class="check" value="female"> <label for="Female"><span class="icon"></span> Female</label>
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_level" class="font-weight-bolder">User Level:</label>
																																						<input type="number" class="form-control" id="insert_user_level" name="insert_user_level" placeholder="User Level?" min="0" max="71" step="71" autocomplete="on">
																																					</div>
																																				</div>
																																			</div>
																																			<div class="card-footer">
																																				<input type='submit' class='btn emc_btn btn-sm btn-block insert_user rounded-pill' id='insert_user' name='insert_user' value='Insert User'>
																																			</div>
																																		</form>
																																	</div>
																																<?php
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
																															<!-- /////////////////////////// EDIT USERS TAB ///////////////////////////// -->
																															<div class="tab-pane fade" id="editUsers" role="tabpanel" aria-labelledby="editUsers-tab">
																																<?php
																																try {
																																?>
																																	<div class='card shadow'>
																																		<div class="card-header">
																																			<h5 class="card-title text-center font-weight-bolder text-primary">EDIT USER</h5>
																																		</div>
																																		<form class="" action="" method="post" enctype="multipart/form-data">
																																			<div class="card-body">
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="" class="font-weight-bolder">Select User:</label>
																																						<?php // Select user
																																						$queryUsers = mysqli_query($dbcon, "SELECT user_id, CONCAT_WS(' ', first_name, middle_name, last_name) as select_user_name FROM users ORDER BY user_id");
																																						// Check the result:
																																						if (mysqli_num_rows($queryUsers) > 0) {
																																							echo "<select class='form-control select_artist-single' name='select_user' required>";
																																							echo "<option value=''>Select user</option>";
																																							// fetch the records
																																							while ($fetch_queryUsers = mysqli_fetch_assoc($queryUsers)) {
																																								$user_id = $purifier->purify($fetch_queryUsers['user_id']);
																																								$select_user_name = $purifier->purify($fetch_queryUsers['select_user_name']);

																																								echo "<option value='$user_id'>#$user_id  $select_user_name</option>";
																																							}
																																							echo "</select>";
																																						} else {
																																							echo '<select class="form-control">
            									<option>No users</option>
            								</select>';
																																						}
																																						?>
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_first_name" class="font-weight-bolder">Edit First Name?:</label>
																																						<input type="text" class="form-control" id="edit_user_first_name" name="edit_user_first_name" placeholder="Change First Name" autocomplete="on">
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="insert_user_first_name" class="font-weight-bolder">Edit Middle Name?:</label>
																																						<input type="text" class="form-control" id="edit_user_middle_name" name="edit_user_middle_name" placeholder="Change Middle Name" autocomplete="on">
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_last_name" class="font-weight-bolder">Edit Last Name?:</label>
																																						<input type="text" class="form-control" id="edit_user_last_name" name="edit_user_last_name" placeholder="Change Last Name" autocomplete="on">
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_nickname" class="font-weight-bolder">Edit Nickname?:</label>
																																						<input type="text" class="form-control" id="edit_user_nickname" name="edit_user_nickname" placeholder="Change Nick Name" autocomplete="on">
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_name" class="font-weight-bolder">Edit Userame?:</label>
																																						<input type="text" class="form-control" id="edit_user_name" name="edit_user_name" placeholder="Change User Name" autocomplete="on">
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_email" class="font-weight-bolder">Edit Edit?:</label>
																																						<input type="email" class="form-control" id="edit_user_email" name="edit_user_email" placeholder="Change Email" autocomplete="on">
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_gender" class="font-weight-bolder">Edit Gender?:</label>
																																						<select class="form-control" name="edit_user_gender" id="edit_user_gender">
																																							<option value="">Change User Gender?</option>
																																							<option value="male">Male</option>
																																							<option value="female">Female</option>
																																						</select>
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_level" class="font-weight-bolder">User Level?:</label>
																																						<input type="number" class="form-control" id="edit_user_level" name="edit_user_level" placeholder="Change User Level" min="0" max="71" step="71" autocomplete="on">
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="edit_user_activation" class="font-weight-bolder">Activate User?:</label>
																																						<!-- <input type="text" class="form-control" id="edit_user_activation" name="edit_user_activation" placeholder="Change User Activation" autocomplete="on"> -->
																																						<select class="form-control" name="edit_user_activation" id="edit_user_activation">
																																							<option value="">No</option>
																																							<option value="NULL">Yes</option>
																																						</select>
																																					</div>
																																				</div>
																																				<div class="form-row">
																																					<div class="form-group col-md-6">
																																						<label for="edit_report_user" class="font-weight-bolder">Report User?:</label>
																																						<input type="number" class="form-control" id="edit_report_user" name="edit_report_user" min="1" max="3" placeholder="Report user?(3)" autocomplete="on">
																																					</div>
																																					<div class="form-group col-md-6">
																																						<label for="edit_blocked_user" class="font-weight-bolder">Block User?:</label>
																																						<!-- <input type="text" class="form-control" id="edit_blocked_user" name="edit_blocked_user" placeholder="Block user?(1)" autocomplete="on"> -->
																																						<select class="form-control" id="edit_blocked_user" name="edit_blocked_user">
																																							<option value="">No</option>
																																							<option value="1">Yes</option>
																																						</select>
																																					</div>
																																				</div>
																																			</div>
																																			<div class="card-footer">
																																				<input type='submit' class='btn emc_btn btn-sm btn-block edit_user rounded-pill' id='edit_user' name='edit_user' value='Edit User'>
																																			</div>
																																		</form>
																																	</div>
																																<?php
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
																															<!-- End of Users display/Modification -->


																															<!-- Beginning of Users Testimonies display/Modification -->
																															<!-- /////////////////////////// DISPLAY USERS TESTIMONIES TAB ///////////////////////////// -->
																															<div class="tab-pane fade" id="testimony" role="tabpanel" aria-labelledby="testimony-tab">
																																<?php
																																try { // Count number of users for display in form
																																	$countTesti_id = mysqli_query($dbcon, "SELECT testimony_id FROM testimony");
																																	$countTesti_id_result = mysqli_num_rows($countTesti_id);
																																	if ($countTesti_id_result > 0) {
																																		echo "<div class='card mb-1'>
									<div class='card-header'>Total Testimony: $countTesti_id_result</div>
									</div>";
																																	}

																																	// set the number of rows per display page
																																	$Testipagerows = 20;
																																	// Has the totla number of pages already been calculated?
																																	if (isset($_GET['Tp'])) {
																																		$Testipages = filter_var($_GET['Tp'], FILTER_SANITIZE_NUMBER_INT);
																																	} else { // use the next block of code to calculate the number of pages
																																		// First, check for the total number of records
																																		$countTesti = "SELECT COUNT(testimony_id) FROM testimony";
																																		$countTesti_result = mysqli_query($dbcon, $countTesti);
																																		$fetch_countTesti = mysqli_fetch_array($countTesti_result, MYSQLI_NUM);
																																		$Testirecords = htmlspecialchars($fetch_countTesti[0], ENT_QUOTES);
																																		// Now calculate the number of pages
																																		if ($Testirecords > $Testipagerows) {
																																			// If the number of records will fill more than one page
																																			// calculate the number of pages and round the result up to the nearest integer
																																			$Testipages = ceil($Testirecords / $Testipagerows);
																																		} else {
																																			$Testipages = 1;
																																		}
																																	} // page check finished

																																	// Declare which record to start with
																																	if ((isset($_GET['Ts']))) {
																																		$Testistart = filter_var($_GET['Ts'], FILTER_SANITIZE_NUMBER_INT);
																																		// Make sure it is not executable XSS
																																	} else {
																																		$Testistart = 0;
																																	}

																																	// Make the query
																																	$query_testimony = "SELECT testimony.testimony_id, testimony.testimonies, users.user_id, users.first_name, users.last_name, users.user_name, users.email
								FROM testimony LEFT JOIN users ON testimony.user_id = users.user_id ORDER BY testimony.testimony_id DESC LIMIT ?, ?";
																																	$q = mysqli_stmt_init($dbcon);
																																	mysqli_stmt_prepare($q, $query_testimony);
																																	// use prepared statement to ensure that only text is inserted
																																	// bind fields to SQL statement
																																	mysqli_stmt_bind_param($q, 'ii', $Testistart, $Testipagerows);
																																	// execute the query
																																	mysqli_stmt_execute($q);
																																	$queryTesti_result = mysqli_stmt_get_result($q);

																																	// check for result
																																	$query_testiNum = mysqli_num_rows($queryTesti_result);
																																	if ($query_testiNum > 0) { ?>
																																		<div class='card shadow'>
																																			<table class="table table-responsive">
																																				<thead class="thead-light">
																																					<tr>
																																						<th scope="col">#</th>
																																						<th scope="col">Delete_Testimony</th>
																																						<th scope="col">Testimony_ID</th>
																																						<th scope="col">Testimonies</th>
																																						<th scope="col">User_ID</th>
																																						<th scope="col">First_Name</th>
																																						<th scope="col">Last_Name</th>
																																						<th scope="col">@Username</th>
																																						<th scope="col">Email</th>
																																					</tr>
																																				</thead>
																																				<?php
																																				$testiRow = $Testistart + 1;
																																				while ($fetch_testimony = mysqli_fetch_assoc($queryTesti_result)) {
																																					// fetch the records
																																					$testimony_id  = $purifier->purify($fetch_testimony['testimony_id']);
																																					$testimonies  = $purifier->purify($fetch_testimony['testimonies']);
																																					$user_id  = $purifier->purify($fetch_testimony['user_id']);
																																					$first_name   = $purifier->purify($fetch_testimony['first_name']);
																																					$last_name  = $purifier->purify($fetch_testimony['last_name']);
																																					$user_name  = $purifier->purify($fetch_testimony['user_name']);
																																					$email  = $purifier->purify($fetch_testimony['email']);

																																					$fullname = $first_name . " " . $last_name;

																																					echo "
												<tbody>
												<tr>
													<th scope='row'>$testiRow</th>
													<td><button type='button' class='btn emc_btn btn-sm rounded-pill' name='' id='deleteTesti_$testimony_id' data-id='$testimony_id' data-name='$fullname testimony' data-toggle='modal' data-target=''>Delete Testimony</button></td>
													<td>$testimony_id</td>
													<td>$testimonies</td>
													<td>$user_id</td>
													<td>$first_name</td>
													<td>$last_name</td>
													<td>$user_name</td>
													<td>$email</td>"; ?>
																																					<div class="modal fade deleteTesti-modal" id="" tabindex="-1" aria-labelledby="deleteTesti-modalLabel" aria-hidden="true" role="dialog">
																																						<form class="" action="" method="post">
																																							<div class="modal-dialog" role="document">
																																								<div class="modal-content card border-danger">
																																									<div class="modal-header">
																																										<h5 class="modal-title mr-3" style="color:red;">WARNING!</h5>
																																										<h6 class="modal-title" id="deleteTesti-modalLabel">Are you sure you want to delete <b class="userNameInject" style="color:blue;"></b>.
																																											<br><b><em style="color:red;">NOTE:</em></b> This action cannot be undone.
																																										</h6>
																																									</div>
																																									<div class="modal-body content-justify-center text-center">
																																										<input type="hidden" id="deleteTesti" name="deleteTestiVal" value="">
																																										<input type='submit' class='btn emc_btn btn-sm deleteTesti rounded-pill' name='deleteTesti' value='Proceed'>
																																										<!-- <a type='submit' class='btn emc_btn btn-sm deleteTesti rounded-pill' id='deleteTesti' href="">Proceed</a> -->
																																										<button type="button" class="btn btn-outline-secondary btn-sm rounded-pill" data-dismiss="modal">Cancel</button>
																																									</div>
																																								</div>
																																							</div>
																																						</form>
																																					</div>
																																					<script type="text/javascript">
																																						document.addEventListener('DOMContentLoaded', function() {
																																							$("#deleteTesti_<?php echo $testimony_id; ?>").click(function() {
																																								var testimony_id = $("#deleteTesti_<?php echo $testimony_id; ?>").attr("data-id");
																																								var user_name = $("#deleteTesti_<?php echo $testimony_id; ?>").attr("data-name");
																																								$("#deleteTesti_<?php echo $testimony_id; ?>").attr("data-target", "#deleteTesti-modal_" + testimony_id);
																																								$(".deleteTesti-modal").attr("id", "deleteTesti-modal_" + testimony_id);
																																								$(".deleteTesti-modal b.userNameInject").text(user_name);
																																								$(".deleteTesti-modal .modal-body input#deleteTesti").attr("value", testimony_id);
																																							});
																																						});
																																					</script>
																																					</tr>
																																					</tbody>
																																				<?php
																																					$testiRow++;
																																				}
																																				?>
																																			</table>
																																		</div>
																																<?php
																																	} else {
																																		echo '<div class="card">
									  <div class="card-body">
									    There are currently no Testimonies!.
									  </div>
									</div>';
																																	}

																																	// Make the links to other pages, if necessary.
																																	if ($Testipages > 1) {
																																		echo "<div class='card shadow'>
									<div class='card-body text-center justify-content-center'>";
																																		// What number is the current page?
																																		$Testicurrent_page = ($Testistart / $Testipagerows) + 1;
																																		// if the page is not the first page then create a Previous link
																																		if ($Testicurrent_page != 1) {
																																			echo '<a class="pagiClickLink" href="index.php?Ts=' . ($Testistart - $Testipagerows) .
																																				'&Tp=' . $Testipages . '">Previous</a>';
																																		}

																																		// Make all the numbered pages:
																																		for ($i = 1; $i <= $Testipages; $i++) {
																																			if ($i != $Testicurrent_page) {
																																				echo '<a class="pagiClickLink" href="index.php?Ts=' . (($Testipagerows * ($i - 1))) . '&Tp=' . $Testipages . '">' . $i . '</a> ';
																																			} else {
																																				echo $i . ' ';
																																			}
																																		}

																																		// Create next link
																																		if ($Testicurrent_page != $Testipages) {
																																			echo '<a class="pagiClickLink" href="index.php?Ts=' . ($Testistart + $Testipagerows) . '&Tp=' . $Testipages . '">Next</a>';
																																		}
																																		echo "</div></div>";
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
																															<!-- End of Users Testimonies display/Modification -->
																												</div>
																									</div>
		</main>
	</div>
</div>

<?php require('../include/footerJS.php'); ?>
<script type="text/javascript" src="../js/fontawesome.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/jquery.autoresize.min.js"></script>
<script src="../js/jquery.tagsinput-revisited.min.js"></script>
<script type="text/javascript" src="../js/perfect-scrollbar.min.js"></script>
<script src="../js/linceControlTextEditor.js"></script>
<script type="text/javascript" src="../js/bootstrap-multiselect.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript" src="../js/apps.js"></script>
<script type="text/javascript">
	// Line Control Text Editor Plugin
	$(document).ready(function() {
		// Add Post
		$("#add-post-post_msg").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$("#add-post-post_msg_2").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$("#add-post-post_msg_3").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		// Add Artist
		$("#add-artist-artist_desc").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$(".Editor-editor").on("keypress", function() { // Limit character length
			var chars = $("#add-artist-artist_desc").Editor("getCharCount");
			if (chars > 250) {
				alert('not allowed');
			}
		});
		// Artist Spotlight
		$("#artist-spotligh-Description").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$("#artist-spotligh-Description_2").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$("#artist-spotligh-Description_3").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		// Add Audio
		$("#add-audio-lyrics").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		// Edit Post
		$("#edit-post-post_msg").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$("#edit-post-post_msg_2").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		$("#edit-post-post_msg_3").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		// Edit Audio
		$("#edit-audio-lyrics").Editor({
			'insert_img': false,
			'togglescreen': false
		});
		// Write Admin Message
		$("#adminMessage").Editor({
			'insert_img': false,
			'togglescreen': false
		});
	});
	// Get text from lineControl Text editor
	$(document).submit(function() {
		// Add Post
		$("#add-post-post_msg").val($("#add-post-post_msg").Editor("getText"));
		$("#add-post-post_msg_2").val($("#add-post-post_msg_2").Editor("getText"));
		$("#add-post-post_msg_3").val($("#add-post-post_msg_3").Editor("getText"));
		// Add Artist
		$("#add-artist-artist_desc").val($("#add-artist-artist_desc").Editor("getText"));
		// Artist Spotlight
		$("#artist-spotligh-Description").val($("#artist-spotligh-Description").Editor("getText"));
		$("#artist-spotligh-Description_2").val($("#artist-spotligh-Description_2").Editor("getText"));
		$("#artist-spotligh-Description_3").val($("#artist-spotligh-Description_3").Editor("getText"));
		// Add Audio
		$("#add-audio-lyrics").val($("#add-audio-lyrics").Editor("getText"));
		// Edit Post
		$("#edit-post-post_msg").val($("#edit-post-post_msg").Editor("getText"));
		$("#edit-post-post_msg_2").val($("#edit-post-post_msg_2").Editor("getText"));
		$("#edit-post-post_msg_3").val($("#edit-post-post_msg_3").Editor("getText"));
		// Edit Audio
		$("#edit-audio-lyrics").val($("#edit-audio-lyrics").Editor("getText"));
		// Edit Admin Message
		$("#adminMessage").val($("#adminMessage").Editor("getText"));
	});
</script>
<?php
// Display Post tab on pagination
if (isset($_GET['Ap'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#displayPost-tab').tab('show');
  	});";
	echo "</script>";
}
// Display Artist tab on pagination
if (isset($_GET['App'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#displayArtist-tab').tab('show');
  	});";
	echo "</script>";
}
// Display Album tab on pagination
if (isset($_GET['Alp'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#displayAlbum-tab').tab('show');
  	});";
	echo "</script>";
}
// Display Audio tab on pagination
if (isset($_GET['Aup'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#displayAudio-tab').tab('show');
  	});";
	echo "</script>";
}
// Display Video tab on pagination
if (isset($_GET['vpp'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#displayVideo-tab').tab('show');
  	});";
	echo "</script>";
}
// Display online users tab on pagination
if (isset($_GET['NewU'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#newUsers-tab').tab('show');
  	});";
	echo "</script>";
}
// Display users tab on pagination
if (isset($_GET['srt'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#displayUsers-tab').tab('show');
  	});";
	echo "</script>";
}
// Display online users tab on pagination
if (isset($_GET['onlU'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#onlineUsers-tab').tab('show');
  	});";
	echo "</script>";
}
// Display testimony tab on pagination
if (isset($_GET['Tp'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#testimony-tab').tab('show');
  	});";
	echo "</script>";
}
// Display Admin message tab on pagination
if (isset($_GET['Amp'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#adminMsg-tab').tab('show');
  	});";
	echo "</script>";
}
if (isset($_GET['Cap'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#contactForm_msg-tab').tab('show');
  	});";
	echo "</script>";
}
// Display Search user tab after query
if (isset($_POST['search_user'])) {
	echo "<script type='text/javascript'>";
	echo "$(function () {
    	$('a#searchUsers-tab').tab('show');
  	});";
	echo "</script>";
}
?>
<script type="text/javascript">
	$('textarea').autoResize({
		'minRows': 1,
		'maxRows': 0
	});

	$(function() {
		//========Admin Message Notification==========//
		$("a.userNotiLink").click(function(e) {
			e.preventDefault();
			$("a.userNotiLink span").remove();
		});

		$("#seenNewUser").click(function(e) {
			$("a.userNotiLink span").remove();
			//ajax remove all notification button numbers
			// var user_id = <?php echo $user_id; ?>;
			$.ajax({
				url: 'ajax_select.php',
				type: 'post',
				data: {
					new_user: 1
				},
				success: function(response) {}
			});
		});

		$("a.msgNotiLink, #adminMsg-tab").click(function(e) {
			e.preventDefault();
			$("a.msgNotiLink span").remove();
			//ajax remove all notification button numbers
			// var user_id = <?php echo $user_id; ?>;
			// $.ajax({
			//     url: 'ajax_select.php',
			//     type: 'post',
			//     data: {msgerReply_id:1},
			//     success: function(response){
			//     }
			// });
		});

		$("#admin_users_msg-tab").click(function() {
			$("#admin_users_msg-tab span").remove();
			//ajax remove all notification button numbers
			// var user_id = <?php echo $user_id; ?>;
			$.ajax({
				url: 'ajax_select.php',
				type: 'post',
				data: {
					admin_users_msg: 1
				},
				success: function(response) {}
			});
		});

		$("#contactForm_msg-tab").click(function() {
			$("#contactForm_msg-tab span").remove();
			//ajax remove all notification button numbers
			// var user_id = <?php echo $user_id; ?>;
			$.ajax({
				url: 'ajax_select.php',
				type: 'post',
				data: {
					contactForm_msg: 1
				},
				success: function(response) {}
			});
		});

		// show approprate tab on notification icon click
		$('nav li a.msgNotiLink').on('click', function(event) {
			event.preventDefault();
			$('a#adminMsg-tab').tab('show');
		})
		$('nav li a.userNotiLink').on('click', function(event) {
			event.preventDefault();
			$('a#newUsers-tab').tab('show');
		})

		// Post more picture file upload buttons
		$("button.post_pic_1").click(function() {
			$("div#post_pic_1").css("display", "block");
			$("button.post_pic_1").css("display", "none");
			$("button.post_pic_2").css("display", "block");
		});
		$("button.post_pic_2").click(function() {
			$("div#post_pic_2").css("display", "block");
			$("button.post_pic_2").css("display", "none");
			$("button.post_pic_3").css("display", "block");
		});
		$("button.post_pic_3").click(function() {
			$("div#post_pic_3").css("display", "block");
			$("button.post_pic_3").css("display", "none");
			$("button.post_pic_4").css("display", "block");
		});
		$("button.post_pic_4").click(function() {
			$("div#post_pic_4").css("display", "block");
			$("button.post_pic_4").css("display", "none");
			$("button.post_pic_5").css("display", "block");
		});
		$("button.post_pic_5").click(function() {
			$("div#post_pic_5").css("display", "block");
			$("button.post_pic_5").css("display", "none");
			$("button.post_pic_6").css("display", "block");
		});
		$("button.post_pic_6").click(function() {
			$("div#post_pic_6").css("display", "block");
			$("button.post_pic_6").css("display", "none");
			$("button.post_pic_7").css("display", "block");
		});
		$("button.post_pic_7").click(function() {
			$("div#post_pic_7").css("display", "block");
			$("button.post_pic_7").css("display", "none");
			$("button.post_pic_8").css("display", "block");
		});
		$("button.post_pic_8").click(function() {
			$("div#post_pic_8").css("display", "block");
			$("button.post_pic_8").css("display", "none");
			$("button.post_pic_9").css("display", "block");
		});
		$("button.post_pic_9").click(function() {
			$("div#post_pic_9").css("display", "block");
			$("button.post_pic_9").css("display", "none");
			$("button.post_pic_10").css("display", "block");
		});
		$("button.post_pic_10").click(function() {
			$("div#post_pic_10").css("display", "block");
			$("button.post_pic_10").css("display", "none");
			$("button.post_pic_11").css("display", "block");
		});
		$("button.post_pic_11").click(function() {
			$("div#post_pic_11").css("display", "block");
			$("button.post_pic_11").css("display", "none");
			$("button.post_pic_12").css("display", "block");
		});
		$("button.post_pic_12").click(function() {
			$("div#post_pic_12").css("display", "block");
			$("button.post_pic_12").css("display", "none");
			$("button.post_pic_13").css("display", "block");
		});
		$("button.post_pic_13").click(function() {
			$("div#post_pic_13").css("display", "block");
			$("button.post_pic_13").css("display", "none");
			$("button.post_pic_14").css("display", "block");
		});
		$("button.post_pic_14").click(function() {
			$("div#post_pic_14").css("display", "block");
			$("button.post_pic_14").css("display", "none");
			$("button.post_pic_15").css("display", "block");
		});
		$("button.post_pic_15").click(function() {
			$("div#post_pic_15").css("display", "block");
			$("button.post_pic_15").css("display", "none");
		});

		// Scrollbar for side menu
		const ps = new PerfectScrollbar("#sidebarMenu", {
			wheelPropagation: false
		});

		// Select2 plugin
		$('.select_artist-single').select2({
			placeholder: 'Select Artist',
			allowClear: true,
			autocomplete: 'on',
			theme: 'bootstrap4'
		});
		$('.select2_plugin').select2({
			allowClear: true,
			autocomplete: 'on',
			theme: 'bootstrap4'
		});

		// Add the following code if you want the name of the file appear on upload image
		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});

		// Center add post preview image
		const $img = $(".post_pic_prevCon img");
		const $imgCon = $(".post_pic_prevCon");
		var $img_height = $img.prop("naturalHeight");
		var $img_width = $img.prop("naturalWidth");
		if ($img_height > $img_width) {
			$img.css({
				'max-height': '300px',
				'max-width': '60%',
				'margin': 'auto',
				'display': 'block'
			});
			$imgCon.css('background-color', '#0d0d0d');
		} else if ($img_height == $img_width) {
			$img.css({
				'max-height': '300px',
				'max-width': '80%',
				'margin': 'auto',
				'display': 'block'
			});
			$imgCon.css('background-color', '#0d0d0d');
		} else {
			$img.css({
				'max-height': '300px',
				'max-width': 'auto',
				'margin': 'auto',
				'display': 'block'
			});
		}
	});
</script>
</body>

</html>