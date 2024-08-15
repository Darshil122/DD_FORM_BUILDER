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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var formIdToDelete = null;

    // When a delete button is clicked, set the formIdToDelete
    $('.delete-form').on('click', function() {
        formIdToDelete = $(this).data('id');
    });

    // When the confirm delete button is clicked in the modal
    $('#confirmDeleteBtn').on('click', function() {
        if (formIdToDelete !== null) {
            $.ajax({
                url: 'FormCOntroller.php', // Adjust this path
                type: 'DELETE',
                data: { id: formIdToDelete },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.success) {
                        // Optionally, remove the form from the page or reload the list
                        location.reload(); // or remove the form element manually
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