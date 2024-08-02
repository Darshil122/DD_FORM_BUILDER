<?php
    session_start();

    $email = $_SESSION["login"]; 
    if($email == NULL){
        header("Location: login.php");
    }
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light p-0" style="margin-left:0px;">
    <a href="./index.php">
        <img src="dist/img/logo.png" alt="FormBuilder" height="60px" width="200px">
    </a>
    <ul class="navbar-nav">
        <li class="nav-item toggle">
            <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto" style="margin-right:150px">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="form.php" class="nav-link">Form</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="contact.php" class="nav-link">Contact</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
            <a href="logout.php" class="nav-link">Logout</a>
        </li> -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fa-solid fa-user"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#"> <?php
                            echo $_SESSION['email'];
                            ?></a></li>
            </ul>
        </li>
    </ul>
</nav>