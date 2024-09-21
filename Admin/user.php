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


    <?php include "inc/style.php";?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php 
        include "Controller.php";
        include "inc/header.php";
        include "inc/sidebar.php"; ?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">User</h1>
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
                                    <h3 class="card-title">Users Table</h3>
                                </div>
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Email</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $no = 1;
                                                       foreach($users as $user){
                                                          ?>
                                            <tr id="<?php echo $user['id']; ?>">
                                                <td><?php echo $no ?></td>
                                                <td data-target="email"><?php echo $user['email']; ?></td>
                                                <td>
                                                    <div style="display:flex;justify-content: center;">
                                                        <a href="#" data-role="update"
                                                            class="mx-2 btn btn-outline-success"
                                                            data-id="<?php echo $user['id']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" data-role="delete" class="btn btn-outline-danger"
                                                            data-id="<?php echo $user['id']; ?>">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                            $no++;
                                                              }
                                                              ?>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- update Modal start -->
                                <div class="modal fade" id="myModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Details</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form id="" name="register-form" class="row mb-0"
                                                    action="Controller/update.php" method="post">

                                                    <div class="col-12 form-group">
                                                        <label for="name">Name:</label>
                                                        <input type="hidden" name="id" id="userid">
                                                        <input type="text" id="name" name="name" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <label for="gender">Gender: &nbsp;</label>
                                                        <input type="radio" name="gender" value="Male" id="gender"
                                                            checked>Male
                                                        &nbsp;
                                                        <input type="radio" name="gender" value="Female"
                                                            id="gender">Female
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <label for="register-form-email">Email Address:</label>
                                                        <input type="text" id="email" name="email" class="form-control"
                                                            required>
                                                    </div>

                                                    <div class="col-12 form-group">
                                                        <label for="register-form-phone">Phone:</label>
                                                        <input type="text" id="phone" name="no" class="form-control"
                                                            pattern="[1-9]{1}[0-9]{9}"
                                                            title="Enter 10 digit mobile number" required>
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <button type="submit" class="btn btn-primary btn-block"
                                                            id="Edit" name="update_user" value="">Update</button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- update model end -->

                                <!-- delete modal start-->
                                <div class="modal fade" id="delModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="Controller/delete_user.php" method="post">
                                                    <p>Are you sure delete this record?</p>
                                                    <input type="hidden" name="id" value="" id="userid" />
                                                    <div class="row">
                                                        <div class="col-3 model-footer">
                                                            <button type="submit" class="btn btn-danger btn-block"
                                                                id="delete" name="delete">delete</button>
                                                        </div>
                                                        <!-- /.col -->
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- delete modal end -->
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