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
        <?php include "./Include/header.php"; ?>
        </nav>

        <!-- sidebar -->
        <?php include "./Include/sidebar.php"; ?>

        <div class="content-wrapper">

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- <form id="dynamic-form" action="routes.php?action=saveForm" method="POST"> -->
                        <div class="col-12 justify-content-center">
                            <input type="text" name="formName" id="formName" class="form-control"
                                placeholder="Enter Form Name">
                        </div>
                        <div class="col-5 box" id="form-area">
                            <!-- Form fields will be dropped here -->
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <form id="dynamic-form" action="" method="POST">
                                    <input type="hidden" name="form_data" id="form_data">
                                    <button type="submit" class="createform" onclick="createForm()">Create
                                        Form</button>
                                </form>
                            </div>
                        </div>
                        <!-- </form> -->
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

    <!-- script -->

    
</body>
<?php include "./Include/script.php"; ?>

</html>