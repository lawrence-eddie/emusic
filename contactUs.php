<?php // This is the contact form.
error_reporting(0);
// Start output buffering:
ob_start();

// Initialize a session:
session_start();
require_once('obaEddie_connect.php');

require('include/config.inc.php');

// Purify plugin
//$dbcon->set_charset("utf8mb4");
require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

// If no user_id session variable exists, redirect the user:
// if (isset($_SESSION['user_id'])) {
//   redirect_user("accountmsg.php?cad=cad");
// }

$page_title = 'Contact us';
require_once('include/userTZ.php');
require_once('include/index_header.php');
?>
<style media="all">
  .col-lg-6 {
    padding-left: 0px !important;
    padding-right: 0px !important;
  }

  .social-btn {
    width: 80%;

  }

  span a {
    margin: 5px;
  }

  /*--- Buttons ---*/
  .emc_btn:focus {
    border-color: rgb(153, 153, 255) !important;
    box-shadow: 0 0 0 0.2rem rgba(153, 153, 255, 0.25) !important;
  }

  .emc_btn {
    border-color: rgb(153, 153, 255);
    color: rgb(128, 128, 255);
  }

  .emc_btn:hover {
    background: rgb(153, 153, 255);
    color: white;
  }

  /* Devices above 768px (md) */
  @media (min-width: 770px) {
    .lg-shift-left {
      padding-right: 5px !important;
    }

    .lg-shift-right {
      padding-left: 5px !important;
    }
  }

  @media (min-width: 767px) {
    .contact_us_wrap {
      -moz-box-shadow: -1px -3px 5px 9px #cccccc;
      -webkit-box-shadow: -1px -3px 5px 9px #cccccc;
      box-shadow: -1px -3px 5px 9px #cccccc;
      padding: 20px;
    }

    h3 {
      padding: 0px auto 20px !important;
    }
  }

  @media (max-width: 767px) {
    h3 {
      margin: 30px auto 0px !important;
      padding-bottom: 0px !important;
    }
  }
</style>
<div class="contact_us_bground jumbotron">
  <h3 class="text-muted text-center">CONTACT US</h3>
  <div class="container-lg py-3 my-3">
    <div class="row">
      <div class="col-md-4 pb-3">
        <?php
        require('process_contactUs.php');
        if (isset($errorstring) && !empty($errorstring)) {
          echo '<p id="err_msg" class="errors text-danger mb-2">' . $errorstring . '</p>';
        } else {
          if (isset($message_sent)) {
            echo "<div class='text-success mb-2'>" . $message_sent . "</div>";
          }
        }
        ?>
        <a href="mailto:lawrenceeddie555@gmail.com" role="button" class="btn btn-outline-danger mb-3 rounded-pill d-none d-md-block social-btn" style="display:block;"><i class="fas fa-envelope"></i> Email</a>
        <a href="#" role="button" class="btn btn-outline-primary mb-3 rounded-pill d-none d-md-block social-btn" style="display:block;"><i class="fab fa-facebook"></i> Facebook</a>
        <a href="#" role="button" class="btn btn-outline-success mb-3 rounded-pill d-none d-md-block social-btn" style="display:block;"><i class="fab fa-whatsapp"></i> WhatsApp</a>
        <a href="#" role="button" class="btn btn-outline-info mb-3 rounded-pill d-none d-md-block social-btn" style="display:block;"><i class="fab fa-twitter"></i> Twitter</a>
      </div>
      <div class="col-md-8">
        <div class="contact_us_wrap">
          <form class="" action="" method="post">

            <div class='form-label-group mb-3'>
              <input type='text' id='contact_name' class='form-control contact_name bg-transparent shadow-none rounded-pill' placeholder='Full name' autofocus required name='contact_name' autocomplete="name">
              <label for='contact_name' class="text-muted">Full name<span class="text-danger">*</span> </label>
            </div>

            <div class="row">
              <div class="col-lg-6 lg-shift-left">
                <div class='form-label-group mb-3'>
                  <input type='email' id='email' class='form-control email bg-transparent shadow-none rounded-pill' placeholder='Email' required name='email' autocomplete="email">
                  <label for='email' class="text-muted">Email<span class="text-danger">*</span> </label>
                </div>
              </div>
              <div class="col-lg-6 lg-shift-right">
                <div class='form-label-group mb-3'>
                  <input type='text' id='phone' class='form-control phone bg-transparent shadow-none rounded-pill' placeholder='Phone' name='phone' autocomplete="mobile">
                  <label for='phone' class="text-muted">Phone</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 lg-shift-left">
                <div class="form-group mb-3">
                  <label for="service" class="text-muted">Service</label>
                  <select name="service" class="form-control bg-transparent shadow-none rounded-pill" id="service" style="cursor:pointer;">
                    <option value="Web Development">Web Development</option>
                    <option value="Mobile Aplication Development">Mobile Aplication Development</option>
                    <option value="Search Engine Optimization">Search Engine Optimization</option>
                    <option value="Customized Open Source Product">Customized Open Source Product</option>
                    <option value="Consulting - Cloud and DevOps">Consulting - Cloud and DevOps</option>
                    <option value="UI/UX Design">UI/UX Design</option>
                    <option value="QA Service">QA Service</option>
                    <option value="Other">Other...</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 lg-shift-right">
                <div class="form-group mb-3">
                  <label for="requirement" class="text-muted">Requirement</label>
                  <select name="requirement" class="form-control bg-transparent shadow-none rounded-pill" id="requirement" style="cursor:pointer;">
                    <option value="Hire Dedicated Team">Hire Dedicated Team</option>
                    <option value="New Project">New Project</option>
                    <option value="Existing Project">Existing Project</option>
                    <option value="Support/Maintenance">Support/Maintenance</option>
                    <option value="Other">Other...</option>
                  </select>
                </div>
              </div>
            </div>

            <div class='form-group mb-3'>
              <label for='message' class="text-muted">Message<span class="text-danger">*</span> </label>
              <textarea class='form-control bg-transparent shadow-none' spellcheck='true' required name='message' placeholder='Message' rows='3' id="message"></textarea>
            </div>

            <div class="form-group form-check">
              <input type="checkbox" name="news_letter" class="form-check-input" id="newsLetter" checked>
              <label class="form-check-label text-info" for="newsLetter">Subscribe to our news letter</label>
            </div>

            <button type="submit" name="contact_us" class="btn emc_btn rounded-pill btn-block">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Start Footer -->
<footer>
  <div class="container py-5">
    <div class="row text-light text-center">

      <div class="col-md">
        <hr class="bg-light">
        <h5>Contact Info</h5>
        <hr class="bg-light">
        <p>+234-807-89689</p>
        <p>lawrence.eddie@hotmail.com</p>
        <p>Benin City, Edo State</p>
        <p>Nigeria</p>
      </div>

      <div class="col-md">
        <hr class="bg-light">
        <h5>Our Hours</h5>
        <hr class="bg-light">
        <p>Monday - Friday: 9am - 5pm</p>
        <p>Saturday: 10am - 4pm</p>
        <p>Sunday: Closed</p>
      </div>

      <div class="col-md">
        <hr class="bg-light">
        <h5>Service Area</h5>
        <hr class="bg-light">
        <p>World Wild</p>
      </div>

    </div>
  </div>
</footer>
<!-- End Footer -->
<!-- Start Socket -->
<div class="socket text-light text-center py-4">
  <p>&copy; Emusic 2021</p>
  <span><a href="#"><i class="fas fa-envelope"></i></a> <a href="#"><i class="fab fa-facebook"></i></a>
    <a href="#"><i class="fab fa-whatsapp"></i></a> <a href="#"><i class="fab fa-twitter"></i></a></span>
</div>
<!-- End Socket -->
<?php require('include/footerJS.php') ?>
<script type="text/javascript" src="js/jquery.autoresize.min.js"></script>
<!-- <script type="text/javascript" src="js/apps.js"></script> -->
<script type="text/javascript">
  $('textarea').autoResize({
    'minRows': 3,
    'maxRows': 0
  });
</script>
</body>

</html>