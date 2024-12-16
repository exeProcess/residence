<?php
  if(isset($_GET['return'])){
    $returnPage = (isset($_GET['return']))?$_GET['return'].'.php':'index.php';
    $id = $_GET['id'];
    $amount = (isset($_GET['amount']))?$_GET['amount']: "";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>American Residence | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  

  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">American Residence</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form>
        <div class="input-group mb-3">
        <input type="hidden" name="" id="prodId" value="<?= $id?>">
        <input type="hidden" name="" id="amount" value="<?= $amount?>">
          <input type="email" class="form-control" placeholder="Email" id="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4 tab-loading">
            <button type="submit" class="btn btn-primary btn-block" id="login">
              Sign in
            </button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
      <?php
        if(isset($_GET['return'])):
      ?>
        <?php if(isset($_GET['amount'])):?>
            <a href="register.php?return=<?= urlencode($returnPage) ?>&id=<?= urlencode($id) ?>&amount=<?= $amount?>" class="text-center">Register a new membership</a>
          <?php else:?>
            <a href="register.php?return=<?= urlencode($returnPage) ?>&id=<?= urlencode($id) ?>" class="text-center">Register a new membership</a>
          <?php endif; ?>  
            <?php else:?>
          <a href="register.php" class="text-center">Register a new membership</a>
        <?php endif;?>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../plugins/toastr/toastr.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
  
        $("#login").click((e) => {
    e.preventDefault()
    $("#login").html('<i class="fa fa-sync fa-spin">')
    // $("#loader").removeClass("d-none").addClass("d-block")
    let data = {
                password: $("#password").val(),
                email: $("#email").val(),
                login: true
            }
            $.ajax({
                url: "../../../Controller/requestHandler.php",
                method: "POST",
                data: data,
                success: (res) => {
                  let result = JSON.parse(res)
                  if(result.status == 200){
                    toastr.success('Successful login')
                    setTimeout(() => {
                      $("#login").html('Sign in')
                    }, 10);
                    // location.href = "../../../index.php"
                    if($("#prodId").val() != ""){
                      if($('#amount').val() != ""){
                        var params = {
                          id: '<?= $id ?>',
                          amount: '<?= $amount?>' // Escaping PHP output
                        };

                        let returnPage = '<?= '../../../'.$returnPage ?>'; // Enclose PHP value in quotes
                        let uri = `${returnPage}?` + $.param(params); // Build URL
                        window.location.href = uri;
                      }else{
                        var params = {
                          id: '<?= $id ?>', // Escaping PHP output
                        };

                        let returnPage = '<?= '../../../'.$returnPage ?>'; // Enclose PHP value in quotes
                        let uri = `${returnPage}?` + $.param(params); // Build URL
                        window.location.href = uri;
                      }
                    }else{
                      window.location.href = "index.php";
                    }
                  }else{
                    $("#login").html('Signin')
                    toastr.error(result.text)
                  }
                  // console.log(res);
                  
                }
            })
  })
  
</script>
</body>
</html>
