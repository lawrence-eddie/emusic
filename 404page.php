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
require_once('include/config.inc.php');

$page_title = "404";
require_once('include/header.php');
?>

<div class="container-xl">
    <div class="row">
        <div class="card text-center w-100 mt-5">
            <div class="card-header">
                Sorry😞!!!
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                    <p>The web page you're looking for do not exists</p>
                    <footer class=""><a href="index.php">Take me back to Home Page</a></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>

<?php require('include/footerJS.php'); ?>

</body>

</html>