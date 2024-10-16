<?php
  $a=array();
  session_start();

  include "Include/config.php";
  if(isset($_POST['login'])){
    // $id = $_POST['id'];
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    // $rememberme =mysqli_real_escape_string($conn, $_POST['rememberme']);

    if($email == NULL){
      $a["email_null"] = true;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $a["email_format"] = true;
    }

    if($password == NULL){
      $a["password_null"] = true;
    }
    
    // if($rememberme){
    //   $a["Remember_me"] = true;
    // }

    if(count($a) == 0){
      $sql="SELECT * FROM user_master where email = '$email' && password='$password' ";
      $result = mysqli_query($con,$sql);

      $rows = mysqli_num_rows($result);
      $id = mysqli_fetch_array($result);
      if ($rows == 1) {
        $_SESSION['id'] = $id[0];
        $_SESSION["login"] = true;
        $_SESSION["uemail"] = $email;
        header("Location: index.php");
      } else {
        $a["msg"] = true;
      }
    }    
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Log in</title>
    <link rel="icon" type="image/jpg" href="dist/img/navicon.png">
    <link rel="stylesheet" href="style.css">

    <?php include "Include/style.php"; ?>

</head>

<body class="hold-transition login-page">
    <div class="bg-image">
        <div class="login-box" id="login">
            <div class="login-logo">
                <b>Login Form</b>
            </div>

            <div class="card card-outline card-primary">
                <div class="card-body login-card-body">
                    <!-- <p class="login-box-msg">Login Your Account</p> -->

                    <form method="post" action="">
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" placeholder="Email" name="email"
                                value="<?php if(isset($_POST['login'])){ echo $email; }  ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <span style="color:red">
                                <?php 
            if(array_key_exists("email_null",$a)){
              echo 'Please enter your email.';
            }
            elseif(array_key_exists("email_format",$a)){
              echo "Please enter valid email.";
            }
            ?>
                            </span>
                        </div>
                        <div class="input-group mb-2" id="show_hide_password">
                            <input type="password" class="form-control" placeholder="Password" name="password"
                                value="<?php if(isset($_POST['login'])){ echo $password; }  ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <a href="" class="decoration-none text-secondary"><i class="fa fa-eye-slash"
                                            aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <?php 
            if(array_key_exists("password_null",$a)){
              echo '<span style="color:red">Please enter your password.';
            }
          ?>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember" name="rememberme">
                                    <label for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                            </div>

                        </div>
                    </form>
                    <div class="mb-2">
                        <?php 
            if(array_key_exists("msg",$a)){
              echo '<span style="color:red">Please enter valid Id/Password.';
            }
          ?>
                    </div>
                    <p class="mb-1">
                        <a href="forgetPass.php">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                        <a href="register.php" class="text-center">Register a new membership</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
    <!-- /.login-box -->

</body>
<?php include "Include/script.php"; ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('#show_hide_password a');
    const passwordField = document.querySelector('#show_hide_password input');
    const passwordIcon = document.querySelector('#show_hide_password i');

    togglePassword.addEventListener('click', function(event) {
        event.preventDefault();
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.classList.remove('fa-eye-slash');
            passwordIcon.classList.add('fa-eye');
        } else {
            passwordField.type = 'password';
            passwordIcon.classList.remove('fa-eye');
            passwordIcon.classList.add('fa-eye-slash');
        }
    });
});
</script>

</html>