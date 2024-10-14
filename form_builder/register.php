<?php
  $a=array();
  session_start();

  include "../DB/config.php";
  if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $mobile = mysqli_real_escape_string($con, $_POST['mobile']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);

    if($name == NULL){
        $a["name_null"] = true;
    }
    if($mobile == NULL){
        $a["mobile_null"] = true;
    }
    if($email == NULL){
      $a["email_null"] = true;
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $a["email_format"] = true;
    }
    if($password == NULL){
      $a["password_null"] = true;
    }

    if(count($a) == 0){
      $sql="INSERT INTO user_master (name, number, email, password)VALUES('$name', '$mobile', '$email', '$password')";
      $result = mysqli_query($con,$sql);

      if ($result == 1) {
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
    <title>Sign Up Page</title>
    <link rel="icon" type="image/jpg" href="dist/img/navicon.png">
    <link rel="stylesheet" href="style.css">

    <?php include "Include/style.php"; ?>

</head>

<body class="hold-transition login-page">
    <div class="bg-image">
        <div class="login-box" id="login">
            <div class="login-logo">
                <b>Register Form</b>
            </div>

            <div class="card card-outline card-primary">
                <div class="card-body login-card-body">
                    <!-- <p class="login-box-msg">Login Your Account</p> -->

                    <form method="post" action="">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                value="<?php if(isset($_POST['register'])){ echo $name; }  ?>">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <?php 
                                    if(array_key_exists("name_null",$a)){
                                    echo '<span style="color:red">Please enter your name.';
                                    }
                                ?>
                        </div>
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" placeholder="Enter Mobile no." name="mobile"
                                pattern="[1-9]{1}[0-9]{9}" title="Enter 10 digit mobile number">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fa fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <?php 
                                if(array_key_exists("mobile_null",$a)){
                                echo '<span style="color:red">Please enter your mobile number.';
                                }
                            ?>
                        </div>
                        <div class="input-group mb-2">
                            <input type="email" class="form-control" placeholder="Enter Email" name="email"
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
                            <input type="password" class="form-control" placeholder="Enter Password" name="password"
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
                                <button type="submit" class="btn btn-primary btn-block" name="register">Sign Up</button>
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
                        <a href="login.php" class="text-center">I have already Registeration</a>
                    </p>
                    <!-- <p class="mb-0">
        <a href="registration.php" class="text-center">Register a new membership</a>
      </p> -->
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