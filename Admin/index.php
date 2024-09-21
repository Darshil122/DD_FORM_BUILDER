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
    <?php include "inc/style.php"; ?>
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
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        echo $userCount;
                                     ?></h3>

                                    <p>User</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <a href="user.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        echo $formCount;
                                     ?></h3>

                                    <p>Form</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-table"></i>
                                </div>
                                <a href="formlist.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>
                                        <?php
                                        echo $feedbackCount;
                                     ?></h3>

                                    <p>Feedback</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <a href="feedback.php" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- footer -->
        <?php include "inc/footer.php"; ?>

    </div>

</body>

<!-- script -->
<?php include "inc/script.php"; ?>

</html>