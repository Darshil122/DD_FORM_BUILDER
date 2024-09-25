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
        <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top p-0 ml-0">
        <?php include "./Include/header.php"; ?>
        </nav>

        <section class="content">
            <div class="container">
                <div class="row">
                  <?php
                        $formId = $_SESSION['id'];

                        if ($formId) {
                            require 'Controller.php'; 
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer class="p-3 fs-large d-flex justify-content-center bg-secondary fixed-bottom" style="margin-top:0vh;">
        Copyright &copy;<strong>DD Form Builder</strong>2024-25.
        All rights reserved.
    </footer>
    </div>
</body>
<?php include "./Include/script.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    var formIdToDelete = null;

    $('.delete-form').on('click', function() {
        formIdToDelete = $(this).data('id');
    });

    $('#confirmDeleteBtn').on('click', function() {
        if (formIdToDelete !== null) {
            $.ajax({
                url: 'Controller.php',
                type: 'DELETE',
                data: { id: formIdToDelete },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete form: ' + result.error);
                    }
                },
                error: function() {
                    alert('Error deleting form.');
                }
            });
        }
    });
});
</script>

</html>