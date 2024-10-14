<?php
    session_start();

    $email = $_SESSION["login"]; 
    if($email == NULL){
        header("Location: login.php");
    }
?>

<a href="./index.php">
    <img src="dist/img/logo.png" alt="FormBuilder" height="60px" width="200px">
</a>

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
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
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