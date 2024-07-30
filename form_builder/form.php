<?php 
    include "./Include/style.php"; 
    // include "./Include/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Form List</title>
 
</head>

<body class="hold-transition layout-fixed">
    <div class="wrapper">
        <!-- header -->
        <?php include "./Include/header.php"; ?>

        <!-- sidebar -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <?php
                    // Example URL: routes.php?action=displayForm&form_id=1
                    if (isset($_GET['form_id'])) {
                        require 'routes.php';
                    } else {
                        echo "Form ID not provided.";
                    }
                ?>
                    <!-- <div class="col-md-4 col-lg-5 formlist" id="form-area">
                         Form fields will be dropped here 
                    </div> -->

                </div>
            </div>
        </section>
        <!-- footer -->
        <div class="text-center p-2 foot ">
        Copyright &copy; <strong>DD Form Builder</strong> 2024-25.
        All rights reserved.
        </div>
    </div>

</body>

</html>