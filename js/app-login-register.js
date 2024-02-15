/*
 *
 * login-register modal
 * Autor: Creative Tim
 * Web-autor: creative.tim
 * Web script: http://creative-tim.com
 *
 */
function showRegisterForm() {
  $(".loginBox").fadeOut("fast", function () {
    $(".registerBox").fadeIn("fast");
    $(".login-footer").fadeOut("fast", function () {
      $(".register-footer").fadeIn("fast");
    });
    $(".modal-title").html("Register with");
  });
  $(".error").removeClass("alert alert-danger").html("");
}

function showLoginForm() {
  $("#loginModal .registerBox").fadeOut("fast", function () {
    $(".loginBox").fadeIn("fast");
    $(".register-footer").fadeOut("fast", function () {
      $(".login-footer").fadeIn("fast");
    });

    // $('.modal-title').html('Login with');
    $(".modal-title").html("Login");
  });
  $(".error").removeClass("alert alert-danger").html("");
}

function openLoginModal() {
  showLoginForm();
  setTimeout(function () {
    $("#loginModal").modal("show");
  }, 230);
}
function openRegisterModal() {
  showRegisterForm();
  setTimeout(function () {
    $("#loginModal").modal("show");
  }, 230);
}

// Submit login form if enter button is pressed
$("input#ajaxModalLogin_email, input#ajaxModalLogin_password").keypress(
  function (e) {
    if (e.which == 13 && !e.shiftKey) {
      $("#loginAjaxButton").click();
    }
  }
);

function loginAjax() {
  // e.preventDefault();
  var user_login = $("#ajaxModalLogin_email").val().trim();
  var password_login = $("#ajaxModalLogin_password").val().trim();
  var rememberme = $("#ajaxModalLogin_rememberme").val();

  if (user_login != "" && password_login != "") {
    $.ajax({
      type: "post",
      url: "include/ajax_app_login.php",
      data: {
        user_login: user_login,
        password_login: password_login,
        rememberme: rememberme,
      },
      success: function (response) {
        if (response == "success") {
          if (localStorage["page_reload"]) {
            localStorage.removeItem("page_reload");
          }
          location.reload();
        } else if (response == "admin") {
          if (localStorage["page_reload"]) {
            localStorage.removeItem("page_reload");
          }
          location.replace("admin/index.php");
        } else {
          shakeModal(response);
        }
      },
    });
  } else {
    // alert("Please Fill All The Details");
    $(".error")
      .addClass("alert alert-danger")
      .html("Both fields are required!");
  }

  return false;
}

function shakeModal(response) {
  $("#loginModal .modal-dialog").addClass("shake");
  $(".error").addClass("alert alert-danger").html(response);
  $('input[type="password"]').val("");
  setTimeout(function () {
    $("#loginModal .modal-dialog").removeClass("shake");
  }, 1000);
}
