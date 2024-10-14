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
    <link rel="icon" type="image/jpg" href="./dist/img/navicon.png">
    <link rel="stylesheet" href="style.css">
    <?php include "./Include/style.php"; ?>

    <title>Form Builder</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light p-0 ml-0">
            <a href="./index.php">
                <img src="dist/img/logo.png" alt="FormBuilder" height="60px" width="200px">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item toggle">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto" style="margin-right:150px">
                <li class="nav-item d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a href="form.php" class="nav-link">Form</a>
                </li>
                <li class="nav-item d-sm-inline-block">
                    <a href="contact.php" class="nav-link">Contact</a>
                </li>
                <li class="nav-item dropdown d-sm-inline-block">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"> <?php
                            echo $_SESSION['uemail'];
                            ?></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- sidebar -->
        <?php include "./Include/sidebar.php"; ?>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 justify-content-center">
                            <input type="text" name="formName" id="formName" class="form-control"
                                placeholder="Enter Form Name">
                        </div>
                        <div class="col-5 box" id="form-area">
                            <!-- Form fields will be dropped here -->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <form id="dynamic-form" method="POST">
                                    <input type="hidden" name="form_data" id="form_data">
                                    <button type="submit" class="createform" onclick="createForm()">Create
                                        Form</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- footer -->
        <footer class="main-footer bg-secondary pt-3 pb-2">
            Copyright &copy; <strong>DD Form Builder</strong> 2024-25.
            All rights reserved.
        </footer>
    </div>

</body>
<!-- script -->
<?php include "./Include/script.php"; ?>

</html>