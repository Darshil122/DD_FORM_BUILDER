<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="./dist/img/logo.png">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="style.css">

    <title>Form Builder</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- header -->
        <?php include "./Include/header.php"; ?>

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

        <footer class="main-footer" style="color:black; background-color: rgba(0, 0, 0, 0.2); padding-bottom:12px;">
            Copyright &copy; <strong>DD Form Builder</strong> 2024-25.
            All rights reserved.
        </footer>
    </div>

    <!-- script -->

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
    <script src="./script.js"></script>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
</body>

</html>