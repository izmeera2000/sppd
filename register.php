<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>

<body class="hold-transition ">
  <script>
    start_loader()
  </script>
  <style>
    html,
    body {
      height: calc(100%) !important;
      width: calc(100%) !important;
    }

    body {
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }

    .login-title {
      text-shadow: 2px 2px black
    }

    #login {
      flex-direction: column !important
    }

    #logo-img {
      height: 150px;
      width: 150px;
      object-fit: scale-down;
      object-position: center center;
      /* border-radius:100%; */
    }

    #login .col-7,
    #login .col-5 {
      width: 100% !important;
      max-width: unset !important
    }
  </style>
  <div class="h-100 d-flex align-items-center w-100" id="login">
    <div class="col-7 h-100 d-flex align-items-center justify-content-center">
      <div class="w-100">
        <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="" id="logo-img"></center>
        <h1 class="text-center py-5 login-title"><b><?php echo $_settings->info('name') ?></b></h1>
      </div>

    </div>
    <div class="col-5 h-100 bg-gradient">
      <div class="d-flex w-100 h-100 justify-content-center align-items-center">
        <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-red rounded-0 shadow">
          <div class="card-header rounded-0">
            <h4 class="text-purle text-center"><b>Register</b></h4>
          </div>
          <div class="card-body">
            <div class="container-fluid">
              <div id="msg"></div>
              <form action="" id="manage-user">
                <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">
                <div class="form-group ">
                  <label for="name">First Name</label>
                  <input type="text" name="firstname" id="firstname" class="form-control"
                    value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
                </div>
                <div class="form-group ">
                  <label for="name">Last Name</label>
                  <input type="text" name="lastname" id="lastname" class="form-control"
                    value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
                </div>

                <div class="form-group ">
                  <label for="name">Email</label>
                  <input type="text" name="email" id="email" class="form-control"
                    value="<?php echo isset($meta['email']) ? $meta['email'] : '' ?>" required>
                </div>
                <div class="form-group">
                  <label for="phone">Phone Number</label>
                  <input type="text" name="phone" id="phone" class="form-control"
                    value="<?php echo isset($meta['phone']) ? $meta['phone'] : '' ?>" required>
                </div>
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control"
                    value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required autocomplete="off">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password" class="form-control" value="" autocomplete="off"
                    <?php echo isset($meta['id']) ? "" : 'required' ?>>

                </div>

                <div class="form-group ">
                  <label for="" class="control-label">Avatar</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img"
                      onchange="displayImg(this,$(this))">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
                <div class="form-group  d-flex justify-content-center">
                  <img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] : '') ?>" alt=""
                    id="cimg" class="img-fluid img-thumbnail">
                </div>
              </form>
            </div>
          </div>
          <div class="card-footer">
 

            <div class="row">
              <div class="col-4">
                <a href="index">Already Have Account? Login</a>

              </div>
              <div class="col-4">
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button class="btn  #cimg btn-primary mr-2 " form="manage-user">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

  <script>
    $(document).ready(function () {
      end_loader();
    })
  </script>
  <style>
    img#cimg {
      height: 15vh;
      width: 15vh;
      object-fit: cover;
      border-radius: 100% 100%;
    }
  </style>
  <script>
    $(function () {
      $('.select2').select2({
        width: 'resolve'
      })
    })
    function displayImg(input, _this) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#cimg').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#manage-user').submit(function (e) {
      e.preventDefault();
      var _this = $(this)
      start_loader()
      $.ajax({
        url: _base_url_ + 'classes/Users.php?f=save',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
          if (resp == 1) {
            location.href = './?page=user/list';
          } else {
            $('#msg').html('<div class="alert alert-danger">Username already exist</div>')
            $("html, body").animate({ scrollTop: 0 }, "fast");
          }
          end_loader()
        }
      })
    })

  </script>
</body>

</html>