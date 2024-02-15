<?php
error_reporting(0);
// Start output buffering:
ob_start();

// Initialize a session:
session_start();
require_once('obaEddie_connect.php');
require_once('include/config.inc.php');

if (isset($_SESSION['user_id']) & isset($_SESSION['browser']) || isset($_COOKIE['user_id'])) {
  ob_end_clean(); // Delete the buffer.
  redirect_user();
  exit(); // Quit the script
}

require_once 'HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

$page_title = 'Emusic || Login/Register';
require('include/index_header.php');
?>
<div class="login_reg_bground jumbotron">

  <div class="login container-lg py-3 my-3">
    <div class="row">
      <div class="col-md-3 col-lg-4 pb-3">
        <?php
        require('process_login_reg.php');
        // DIsplay any error messsage if present.
        if (isset($errors) && !empty($errors)) {
          echo '<p id="err_msg" class="errors" style="color:red;">A problem occured:<br>';
          foreach ($errors as $msg) {
            echo "$msg<br>";
          }
          // echo 'Please try again or <a href="login_register.php?signUp=#signUp">sign up</a></p>';
        } elseif (isset($errorstring) && !empty($errorstring)) {
          echo '<p id="err_msg" class="errors" style="color:red;">' . $errorstring . '</p>';
        } else {
          if (isset($_COOKIE['user_name'])) {
            $UserName = $_COOKIE['user_name'];
            $queryName = mysqli_query($dbcon, "SELECT CONCAT_WS(' ', users.first_name, users.last_name) as name, users.gender, user_info.profile_pic
            FROM users LEFT JOIN user_info ON users.user_id=user_info.user_id WHERE users.user_name='$UserName'");
            // Check the result:
            if (mysqli_num_rows($queryName) == 1) {
              $fetch_Name = mysqli_fetch_assoc($queryName);
              $Name = $purifier->purify($fetch_Name['name']);
              $gender = $purifier->purify($fetch_Name['gender']);
              $default_pic = $gender == 'male' ? 'img/male.jpg' : 'img/female.jpg';
              $profile_pic = $purifier->purify($fetch_Name['profile_pic']);
              $profile_pic = empty($profile_pic) ? $default_pic : $profile_pic;
              echo "<div id='profile_pic_card' class='card w-100'>
                <div class=''>
                  <img src='$profile_pic' class='card-img-top w-100 mx-auto'
                  alt='$Name' title='$Name'/>
                </div>
                <div class='card-block' style='padding:10px 10px 0px 10px; background-color:#d9d9d9;'>
                  <div class='card-title font-weight-bold text-primary mb-1'>$Name</div>
                  <form class='form-inline' action='login_register.php' method='post' name='' id='' accept-charset='UTF-8'>
                    <input type='hidden' id='' class='' placeholder='' value='$UserName' name='user_login' required>
                    <div class='form-label-group mb-1'>
                      <input type='password' id='' class='form-control profile_pic_passw bg-transparent shadow-none border-left border-bottom
                      border-top-0 border-right-0' placeholder='Password' autofocus required name='password_login' minlength='8'
                      pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' maxlength'40' autocomplete='current-password'>
                      <label for='inputPassword' class='text-muted'>Password</label>
                    </div>

                    <div class='checkbox mb-1'>
                      <label class='text-primary' style='cursor:pointer;'>
                        <input id='' type='checkbox' class='' name='rememberme' checked style='margin-right:5px; color:green'> Keep me logged in
                      </label>
                    </div>
                    <button class='btn-sm btn-primary btn-block rounded-pill tex-info' name='sign_in' type='submit' style='outline:none;'>Log in</button>
                  </form>
                  <div class='foot-lnk'>
                    <a href='notme_logout.php'>Not me!</a>
                  </div>
                </div>
              </div>";
            }
          }
        }
        if (isset($confirm_text)) {
          echo "<div>" . $confirm_text . "</div>";
          header("refresh:10; url= " . $_SERVER['PHP_SELF']);
        }
        ?>
        <!-- <p class="" id="signup_text">One-Time <strong class="text-primary">Sign Up!</strong><br />
        Register and gain access to all our web applications.</p> -->
      </div>

      <div class="col-md-9 col-lg-8" id="loginReg_colWrapper">
        <div class="login-wrap">
          <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Log In</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
            <div class="login-form">
              <form class="" action="login_register.php" method="post" name="signin_form" id="signin_form" accept-charset="UTF-8">
                <div class="sign-in-htm">
                  <div class="group form-group row">
                    <label for="user_login" class="label">Username or Email</label>
                    <input id="user_login" name="user_login" type="text" class="input" required maxlength="40" autocomplete="email" autocomplete="username" title="Enter your username or email" placeholder="username007" value="<?php if (isset($_POST['user_login'])) echo htmlspecialchars($_POST['user_login'], ENT_QUOTES); ?>">
                  </div>
                  <div class="group input-group row">
                    <label for="password_login" class="label">Password</label>
                    <input id="password_login" name="password_login" type="password" class="input" data-type="password" required maxlength="40" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" spellcheck="false" autocorrect="off" autocapitalize="off" title="Enter your password" autocomplete="current-password">
                    <button id="toggle-password" type="button" class="d-none" aria-label="Show password as plain text. Warning: this will display your password on the screen.">
                    </button>
                  </div>
                  <div class="group form-group row">
                    <input id="rememberme" type="checkbox" class="check" name="rememberme" checked>
                    <label for="rememberme"><span class="icon"></span> Keep me logged in</label>
                  </div>
                  <div class="group form-group row">
                    <input type="submit" class="button" id="sign_in" name="sign_in" value="Log In">
                  </div>
                  <div class="hr"></div>
                  <div class="foot-lnk">
                  </div>
                </div>
              </form>
              <form class="" action="login_register.php" method="post" name="signup_form" id="signup_form" accept-charset="UTF-8">
                <div class="sign-up-htm">
                  <div class="group form-group row">
                    <label for="first_name" class="label">First Name</label>
                    <input id="first_name" type="text" class="input" name="first_name" pattern="[a-zA-Z][a-zA-Z\s\']*" required autocomplete="given-name" title="Enter your first name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
                  </div>
                  <div class="group form-group row">
                    <label for="last_name" class="label">Last Name</label>
                    <input id="last_name" type="text" class="input" name="last_name" pattern="[a-zA-Z][a-zA-Z\s\-\']*" required autocomplete="family-name" title="Enter your last name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
                  </div>
                  <div class="group form-group row">
                    <label for="user_name" class="label">Username</label>
                    <input id="user_name" type="text" class="input username" name="user_name" pattern="[a-zA-Z][a-zA-Z0-9\-\_.]*" required autocomplete="username" placeholder="username007" title="Enter your user name" value="<?php if (isset($_POST['user_name'])) echo htmlspecialchars($_POST['user_name'], ENT_QUOTES); ?>" onblur="checkUser(this)">
                    <span id="used"></span>
                  </div>
                  <div class="group form-group row">
                    <label for="email" class="label">Email</label>
                    <input id="email" type="email" class="input" name="email" required value="<?php if (isset($_POST['email']))
                                                                                                echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>" title="Enter your email address" autocomplete="email" placeholder="you@example.com">
                  </div>
                  <div class="group form-group row">
                    <label for="sign_password" class="label">Password <span class="float-right show_pass" id="show_pass" style="padding-right:10px;" onclick="showPassword()"><b id="eye-slash"><i class="far fa-eye-slash"></i></b> show/hide password</span></label>
                    <input id="sign_password" type="password" class="input" name="sign_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" spellcheck="false" autocorrect="off" autocapitalize="off" title="Enter your password" autocomplete="new-password">
                    <span class="text-light"><small id="psw-message" class="" style="padding-left:5px;">
                        8 or more characters. At least one upper, one lower, one number.</small></span>
                  </div>
                  <div class="group form-group row">
                    <label for="confirm_password" class="label">Confirm Password</label>
                    <input id="confirm_password" type="password" class="input" data-type="password" name="confirm_password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8" title="Confirm your password"><span class=""><small id="con-psw-message"></small></span>
                  </div>
                  <div class="group form-group row">
                    <label for="" class="label">Gender</label>
                    <input id="Male" name="gender" type="radio" class="check" value="male" checked>
                    <label for="Male"><span class="icon"></span> Male</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input id="Female" name="gender" type="radio" class="check" value="female">
                    <label for="Female"><span class="icon"></span> Female</label>
                  </div>
                  <div class="group form-group row">
                    <input type="submit" name="sign_up" id="sign_up" class="button" value="Sign Up">
                  </div>
                  <div class="hr"></div>
                  <div class="foot-lnk">
                    <label for="tab-1" style="cursor:pointer;" class="text-light">Already a member?</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Start Socket -->
<div class="socket text-light text-center py-4">
  <p>&copy; Emusic 2021</p>
</div>

<!-- End Socket -->

<?php require('include/footerJS.php') ?>
<?php
// Display sign up tab on link
if (isset($_GET['signUp'])) {
  echo "<script type='text/javascript'>";
  echo "$(function () {
    $('#tab-2').click();
  });";
  echo "</script>";
}
?>

<script type='text/javascript'>
  function checkUser(user) {
    if (user.value == '') {
      $('#used').html("");
      return
    } else {
      $.post(
        'checkusername.php', {
          'user': user.value
        },
        function(data) {
          $('#used').html(data);
        }
      );
    }
  }

  const username = document.querySelector('input.username');
  username.addEventListener('keyup', function() {
    this.value = this.value.replace(/[^a-zA-Z0-9\-\_.]/g, '');
  });

  const password_login = document.querySelector('input#password_login');
  password_login.addEventListener('keyup', function() {
    this.value = this.value.replace(/\s/g, '');
  });
  const sign_password = document.querySelector('input#sign_password');
  sign_password.addEventListener('keyup', function() {
    this.value = this.value.replace(/\s/g, '');
  });

  function showPassword() {
    var x = document.getElementById("sign_password");
    var y = document.getElementById("show_pass");
    var z = document.getElementById("eye-slash");
    try {
      if (x.type === "password") {
        x.type = "text";
        z.innerHTML = '<i class="far fa-eye"></i>';
      } else {
        x.type = "password";
        z.innerHTML = '<i class="far fa-eye-slash"></i>';
      }
    } catch (e) {
      y.innerHTML = "";
    }
  }
</script>

</body>

</html>