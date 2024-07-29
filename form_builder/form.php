<?php 
    include "./Include/style.php"; 
    // include "./Include/header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form List</title>
    <style>
    .formlist {
        position: relative;
        top: 60px;
        left: 30%;
        width: 110px;
        height: 100px;
        border: 1px solid black;
    }
    .foot{
        position: absolute;
        top: 94.5%;
        background-color: rgba(0, 0, 0, 0.2);
        width: 100%;
    }
    </style>
</head>

<body class="hold-transition layout-fixed">
    <div class="wrapper">
        <!-- header -->
        <?php include "./Include/header.php"; ?>

        <!-- sidebar -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-5 formlist" id="form-area">
                        <!-- Form fields will be dropped here -->
                    </div>

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