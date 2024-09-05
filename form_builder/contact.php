<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpg" href="./dist/img/navicon.png">
    <link rel="stylesheet" href="style.css">
    <?php include "./Include/style.php"; ?>
    <title>Contact</title>
</head>

<body>
    <div class="wrapper">
        <!-- header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light p-0 ml-0">
            <?php include "./Include/header.php"; ?>
            </nav>

        <section id="content">
            <div class="content-wrap">
                <div class="container-fluid">
                    <div class="row mt-auto p-2 justify-content-center bg-info">
                        <div class="col-lg-12">
                            <h2 class="text-center">Contact Us</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-lg-7">
                            <div class="row ml-5">
                                <div class="col-10">
                                    <h2 class="font-weight-bold"><i class="fas fa-map-pin"></i>&nbsp;&nbsp;Address</h2>
                                    <p class="ml-5">Harivandana College, <br>
                                        Near Saurashtra University campus, <br>Munjaka, Rajkot, Gujrat, 360005.</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-10 mt-3">
                                    <h2 class="font-weight-bold"><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Phone</h2>
                                    <p class="ml-5">&nbsp;&nbsp;+91 9499835771</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-10 mt-3">
                                    <h2 class="font-weight-bold"><i class="fas fa-envelope-open"></i>&nbsp;&nbsp;Email</h2>
                                    <p class="ml-5">ddformbuilder@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="opening-table p-4 mt-1" style="background-color: #f5f5f5">
                                <form method="post">
                                    <div class="row">
                                        <h1 class="font-weight-bold mb-4">Send Message</h1>
                                        <div class="col-12 mb-4">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Enter your full name">
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                placeholder="abc@ex.com">
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label for="msg">Type Your Message</label><br>
                                            <textarea name="msg" id="msg" class="form-control"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="px-4 btn btn-info" onclick = "feedback()">Submit</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- #content end -->

        <!-- footer -->
    </div>
    <footer class="p-3 mt-5 fs-large d-flex justify-content-center bg-secondary">
        Copyright &copy;&nbsp;<strong>DD Form Builder</strong>&nbsp;2024-25.
        All rights reserved.
    </footer>
</body>
<?php include "./Include/script.php"; ?>

</html>