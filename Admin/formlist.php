<?php
session_start();
$email = $_SESSION["login"]; 
if($email == NULL){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Builder</title>
    <link rel="icon" type="image/jpg" href="dist/img/icon.png">
    <!-- style -->
    <?php include "inc/style.php";?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php 
        include "Controller.php";
        include "inc/header.php";
        include "inc/sidebar.php"; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Form List</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">

                </div>
            </section>
        </div>
        <!-- footer-->
        <?php include "inc/footer.php"; ?>
    </div>
</body>
<!--script-->
<?php include "inc/script.php"; ?>

</html>