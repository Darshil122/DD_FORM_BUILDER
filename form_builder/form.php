<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="./dist/img/navicon.png">
    <link rel="stylesheet" href="style.css">
    <?php include "./Include/style.php"; ?>
    <title>Form List</title>
</head>

<body class="hold-transition layout-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- header -->
        <?php include "./Include/header.php"; ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                  <?php
                            $formId = $_SESSION['id']; 

                        if ($formId) {
                            require 'FormController.php'; 
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer class="footer fixed-bootom">
            Copyright &copy;&nbsp;<strong>DD Form Builder</strong>&nbsp;2024-25.
            All rights reserved.
        </footer>
    </div>
</body>
<?php include "./Include/script.php"; ?>

</html>