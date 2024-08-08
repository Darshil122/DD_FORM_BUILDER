<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <?php include "./Include/style.php"; ?>
    <title>Form List</title>
</head>

<body class="hold-transition layout-fixed">
    <div class="wrapper">
        <!-- header -->
        <?php include "./Include/header.php"; ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                  <?php
                        // require "../DB/config.php";
                        // $userId = $_SESSION['id'];
                        // $sql="SELECT * FROM forms_master where user_id = '$userId'";

                            // $result = mysqli_query($con,$sql);

                            // $rows = mysqli_num_rows($result);
                            // $id = mysqli_fetch_assoc($result);
                            // Get the form ID from the URL

                            // if ($id>0) {
                            $formId = $_SESSION['id']; 
                            // $formId = $_SESSION['id']; // Sanitize input
                            // echo $formId;
                            // }

                        // Debug output for formID
                        if ($formId) {
                            require 'FormController.php'; // Ensure this file handles the form display based on formID
                            // echo "Form ID is not set or invalid.";
                        }
                    ?>
                </div>
            </div>
        </section>

        <!-- footer -->
        <footer class="footer">
            Copyright &copy; <strong>DD Form Builder</strong> 2024-25.
            All rights reserved.
        </footer>
    </div>
</body>
<?php include "./Include/script.php"; ?>

</html>