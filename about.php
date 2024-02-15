<?php
// Turn off all error reporting
error_reporting(0);
// This is the about page for this site
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
<!-- <div class="container">
  <div class="row">
    <p class="">eMusic is an online music and news blog developed by <a class='card-link' id='' data-toggle='modal' data-target="#appDev-modal">Lawrence Eddie</a>.</p>
  </div>
</div> -->

<!-- App -->
<?php
$apps = mysqli_query($dbcon, "SELECT app_dev_id FROM apps WHERE app_id=$app_id");
// Check the result:
if (mysqli_num_rows($apps) == 1) {
  $fetch_apps = mysqli_fetch_assoc($apps);
  // fetch the records
  $app_dev_id   = $purifier->purify($fetch_apps['app_dev_id']);

  // Select app developer details
  $app_dev = mysqli_query($dbcon, "SELECT * FROM app_dev WHERE app_dev_id=$app_dev_id");
  // Check the result:
  if (mysqli_num_rows($app_dev) == 1) {
    echo "<div class='container mt-5'>
      <div class='row justify-content-center'>";
    // fetch the records
    $fetch_app_dev = mysqli_fetch_assoc($app_dev);
    $app_dev_first_name = $purifier->purify($fetch_app_dev['app_dev_first_name']);
    $app_dev_last_name = $purifier->purify($fetch_app_dev['app_dev_last_name']);
    $app_dev_desc = $purifier->purify($fetch_app_dev['description']);
    $app_dev_lang = $purifier->purify($fetch_app_dev['prog_lang']);
    $app_dev_framework = $purifier->purify($fetch_app_dev['frame_work']);
    $app_dev_pic   = $purifier->purify($fetch_app_dev['app_dev_pic']);
    $app_dev_mobile   = $purifier->purify($fetch_app_dev['mobile']);
    $app_dev_email = $purifier->purify($fetch_app_dev['email']);
    $app_dev_twitter = $purifier->purify($fetch_app_dev['twitter']);
    $app_dev_facebook = $purifier->purify($fetch_app_dev['facebook']);
    $app_dev_whatsapp = $purifier->purify($fetch_app_dev['whatsapp']);
    $app_dev_name = $app_dev_first_name . " " . $app_dev_last_name;
    $app_dev_lang = strtoupper(trim($app_dev_lang)); // trim method added just incase there are space characters!
    $app_dev_framework = $app_dev_framework == NULL || '' ? '' : strtoupper(trim($app_dev_framework)); // trim method added just incase there are space characters!
    if (!empty($app_dev_pic)) $app_dev_pic = "$app_dev_pic";
    else $app_dev_pic = $adminPicture;
    //mysqli_free_result($app_dev);
    echo "<h3 class='text-center text-font-border' style='text-shadow: 0px 0px 3px #000000; cursor:pointer; margin-bottom:200px;'>
    <a class='card-link  text-white' id='' data-toggle='modal' data-target='#appDev-modal'>
    eMusic is an online music and news app developed by $app_dev_name.<br><br><br>
    <div class='card mx-auto bg-transparent border-0' id='about_profile_pic'>
      <img src='$app_dev_pic' class='card-img rounded-circle mx-auto bg-transparent' alt='$app_dev_name'>
    </div>
    </a></h3>";
?>
    <!--App developer modal -->
    <div class="modal fade" id="appDev-modal" tabindex="-1" aria-labelledby="appDev-modalLabel" aria-hidden="true" role="dialog">
      <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content appDev-modal">
          <!-- <div class=""> -->
          <div class="appDevImage" style="text-align:center; max-height:300px!important;">
            <img src="<?php echo $app_dev_pic; ?>" class="card-img" alt="<?php echo $app_dev_name; ?>">
            <button type="button" class="close position-absolute" data-dismiss="modal" aria-label="Close" style="top:3px; right:6px; color:blue;">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- <div class=""> -->
          <div class="modal-body">
            <h5 class="card-title text-primary" id="appDev-modalLabel"><?php echo $app_dev_name; ?></h5>
            <p class="card-text appSm-Txt"><?php echo $app_dev_desc; ?></p>
            <p class="card-text appSm-Txt link-a">Tel: <a href="tel:<?php if (!empty($app_dev_mobile)) echo $app_dev_mobile; ?>"><?php if (!empty($app_dev_mobile)) echo $app_dev_mobile; ?></a></p>
            <p class="card-text appSm-Txt link-a">Email: <a href="mailto:<?php if (!empty($app_dev_email)) echo $app_dev_email; ?>"><?php if (!empty($app_dev_email)) echo $app_dev_email; ?></a></p>
            <p class="">
              <?php
              if (!empty($app_dev_facebook)) {
                // code...
              }
              if (!empty($app_dev_whatsapp)) {
                echo "<a href='$app_dev_whatsapp' style='color:green;font-size:22px;margin-right:5px;'><i class='fab fa-whatsapp'></i></a>";
              }
              if (!empty($app_dev_twitter)) {
                echo "$app_dev_twitter<script async src='https://platform.twitter.com/widgets.js' charset='utf-8'></script>";
                //<a href="https://twitter.com/messages/compose?recipient_id=1233455&ref_src=twsrc%5Etfw" style='font-size:22px;' class="twitter-dm-button d-inline" data-text="Hello! GeeverEddie" data-show-screen-name="GeeverEddie" data-screen-name="GeeverEddie" data-show-count="true"><i class="fab fa-twitter"></i></a><script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
              }
              ?>
            </p>
            <h6 class="text-muted">COMPUTER/PROGRAMMING LANGUAGE(S)</h6>
            <?php
            $app_dev_lang = explode(",", $app_dev_lang);
            echo "<p class='dev_badges'>";
            foreach ($app_dev_lang as $lang) {
              echo "<span class='badge badge-pill badge-primary' style='margin:2px 3px 0px;'>$lang</span>";
            }
            echo "</p>";

            if (!empty($app_dev_framework)) {
              echo '<h6 class="text-muted">CMS/FRAMEWORK/LIBRARY</h6>';
              $app_dev_framework = explode(",", $app_dev_framework);
              echo "<p class='dev_badges'>";
              foreach ($app_dev_framework as $framework) {
                echo "<span class='badge badge-pill badge-secondary' style='margin:2px 3px 0px;'>$framework</span>";
              }
              echo "</p>";
            }
            ?>
          </div>
          <!-- </div> -->
          <!-- </div> -->
        </div>
      </div>
      <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
          // Center app developer image
          const $img = $(".appDevImage img");
          const $imgCon = $(".appDevImage");
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
    </div>
<?php echo "</div>
  </div>";
  }
}
?>

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
  <!-- <div class="" id="cplayer-app"></div> -->
</footer>

<?php require('include/footerJS.php'); ?>
<!-- Font Awesome -->
<script src="js/fontawesome.min.js"></script>
<!-- Video background plug in -->
<script src="js/video.background.min.js"></script>

<script type="text/javascript">
  // Video badkground plug in
  // $('#player').ContainerPlayer({
  //   youTube: {
  //     videoId: 'VIDEO ID',
  //     poster: 'poster.jpg',
  //   },
  // });

  // or html5 video
  $('body').ContainerPlayer({
    <?php
    $queryBackground = mysqli_query($dbcon, "SELECT app_pic, app_demo FROM apps WHERE app_id=$app_id");
    // Check the result:
    if (mysqli_num_rows($queryBackground) == 1) {
      $fetch_apps = mysqli_fetch_assoc($queryBackground);
      // fetch the records
      $app_pic  = $purifier->purify($fetch_apps['app_pic']);
      $app_demo = $purifier->purify($fetch_apps['app_demo']);
      if (!empty($app_pic)) $app_pic = "$app_pic";
      else $app_pic = $adminPicture;
      if (!empty($app_demo)) $app_demo = "$app_demo";
      else $app_demo = $app_pic;

      echo "
      html5: {
        src: '$app_demo',
        poster: '$app_pic',
      }";
    }
    ?>
    // html5: {
    //   src: 'music/Mama.mp4',
    //   poster: 'music/Ckay.jpg',
    // }
    // Config the plugin with the following settings.
    // autoplay: true,
    // loop: true,
    // muted: true,
    // controls: false,
    // ratio: 16 / 9,
    // fitContainer: true,
    // forceAspect: false,
  });

  // Events
  // $('#player').ContainerPlayer({
  //   // options here
  // })
  // .on('video.playing video.paused video.loaded video.ended player.resized', function() {
  //   // do something
  // });
</script>
</body>

</html>