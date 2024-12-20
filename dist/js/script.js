function start_loader() {
  $("body").append(
    '<div id="preloader"><div class="loader-holder"><div></div><div></div><div></div><div></div>'
  );
}

function end_loader() {
  $("#preloader").fadeOut("fast", function () {
    $("#preloader").remove();
  });
}
// function
window.alert_toast = function ($msg = "TEST", $bg = "success", $pos = "") {
  var Toast = Swal.mixin({
    toast: true,
    position: $pos || "top",
    showConfirmButton: false,
    timer: 3500,
  });
  Toast.fire({
    icon: $bg,
    title: $msg,
  });
};

$(document).ready(function () {
  // Login
  $("#login-frm").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=login",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            console.log(resp);
            if (resp.login_type == 1) {
              location.href = _base_url_ + "admin";
            } else {
              location.href = _base_url_ + "user";
            }
          } else if (resp.status == "incorrect") {
            var _frm = $("#login-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          } else if (resp.status == "notverified") {
            var _frm = $("#login-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Your Account is not yet verified.</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });

  $("#forgot-frm").submit(function (e) {
    var _frm = $("#forgot-frm");
    var _msg =
      "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Email Sent</div>";
    _frm.prepend(_msg);

    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=forgot_password",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        console.log(resp);

        if (resp) {
            // console.log(resp);
          resp = JSON.parse(resp);

          if (resp.status == "success") {
            // if (resp.login_type == 1){
                // var _msg = "<div class='alert alert-sucess text-white err_msg'><i class='fa fa-exclamation-triangle'></i>Success</div>"

                location.href = _base_url_ + 'index';
            // }
            // else{
            //     location.href = _base_url_ + 'user';

            // }
          }
          // var _frm = $('#forgot-frm')
        //   var _msg = "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>"
          // _frm.prepend(_msg)
          // _frm.find('input').addClass('is-invalid')
          // $('[name="username"]').focus()
          end_loader();

         }
      },
    });
  });
  $("#elogin-frm").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=elogin",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
        alert_toast("An error occured", "danger");
        end_loader();
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            location.replace(_base_url_);
          } else if (!!resp.msg) {
            var _frm = $("#elogin-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> " +
              resp.msg +
              "</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="email"]').focus();
          } else {
            var _frm = $("#clogin-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> An error occurred.</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="email"]').focus();
          }
        }
        end_loader();
      },
    });
  });

  //user login
  $("#slogin-frm").submit(function (e) {
    e.preventDefault();
    start_loader();
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/Login.php?f=slogin",
      method: "POST",
      data: $(this).serialize(),
      error: (err) => {
        console.log(err);
      },
      success: function (resp) {
        if (resp) {
          resp = JSON.parse(resp);
          if (resp.status == "success") {
            location.replace(_base_url_ + "student");
          } else if (resp.status == "incorrect") {
            var _frm = $("#slogin-frm");
            var _msg =
              "<div class='alert alert-danger text-white err_msg'><i class='fa fa-exclamation-triangle'></i> Incorrect username or password</div>";
            _frm.prepend(_msg);
            _frm.find("input").addClass("is-invalid");
            $('[name="username"]').focus();
          }
          end_loader();
        }
      },
    });
  });
  // System Info
  $("#system-frm").submit(function (e) {
    e.preventDefault();
    // start_loader()
    if ($(".err_msg").length > 0) $(".err_msg").remove();
    $.ajax({
      url: _base_url_ + "classes/SystemSettings.php?f=update_settings",
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: "POST",
      type: "POST",
      success: function (resp) {
        if (resp == 1) {
          // alert_toast("Data successfully saved",'success')
          location.reload();
        } else {
          $("#msg").html(
            '<div class="alert alert-danger err_msg">An Error occured</div>'
          );
          end_load();
        }
      },
    });
  });
});
