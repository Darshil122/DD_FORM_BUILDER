<?php
session_start();
$email = $_SESSION["login"]; 
if($email == NULL){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form Builder</title>
    <link rel="icon" type="image/jpg" href="./dist/img/icon.png">

<!-- style -->
    <?php include "inc/style.php"; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php 
        include "Controller.php";
        include "inc/header.php";
        include "inc/sidebar.php"; 
        ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Feedback</h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Feedback Table</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Message</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                       foreach($feedbacks as $feedback){
                                                          ?>
                                            <tr id="<?php echo $feedback['id']; ?>">
                                                <td><?php echo $no ?></td>
                                                <td data-target="email"><?php echo $feedback['name']; ?></td>
                                                <td data-target="email"><?php echo $feedback['email']; ?></td>
                                                <td data-target="email"><?php echo $feedback['message']; ?></td>
                                                <!-- <td>
                                                    <div style="display:flex;justify-content: center;">
                                                        <a href="#" data-role="update"
                                                            class="mx-2 btn btn-outline-success"
                                                            data-id="<?php echo $feedback['id']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" data-role="delete" class="btn btn-outline-danger"
                                                            data-id="<?php echo $feedback['id']; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td> -->
                                            </tr>
                                            <?php
                                                            $no++;
                                                              }
                                                              ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <!-- footer -->
        <?php include "inc/footer.php"; ?>
    </div>

</body>
<!-- script -->
<?php include "inc/script.php"; ?>

</html>