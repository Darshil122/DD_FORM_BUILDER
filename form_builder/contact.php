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
        <nav class="main-header navbar navbar-expand navbar-white navbar-light p-0 ml-0 fixed-top">
            <?php include "./Include/header.php"; ?>
            </nav>

        <section id="content">
            <div class="content-wrap">
                <div class="container-fluid">
                    <div class="row mt-auto p-1 pt-5 justify-content-center bg-info">
                        <div class="col-lg-12 pt-4">
                            <h2 class="text-center">Contact Us</h2>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row mt-5">
                        <div class="col-lg-6 mt-5">
                            <div class="row ml-5">  
                                <div class="col-10">
                                    <h2 class="font-weight-bold"><i class="fas fa-map-pin"></i>&nbsp;&nbsp;Address</h2>
                                    <p class="ml-5">Harivandana College, <br>
                                        Near Saurashtra University campus, <br>Munjaka, Rajkot, Gujrat, 360005.</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-10 mt-4">
                                    <h2 class="font-weight-bold"><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Phone</h2>
                                    <p class="ml-5">&nbsp;&nbsp;+91 9499835771</p>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-10 mt-4">
                                    <h2 class="font-weight-bold"><i class="fas fa-envelope-open"></i>&nbsp;&nbsp;Email</h2>
                                    <p class="ml-5">ddformbuilder@gmail.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="opening-table p-3" style="background-color: #f5f5f5">
                                <form method="post" id="fbmsg">
                                    <div class="row">
                                        <h1 class="font-weight-bold mb-4">Send Message</h1>
                                        <div class="col-12 mb-3">
                                            <label for="name" class="form-label">Full Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Enter your full name">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                placeholder="abc@ex.com">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="msg">Type Your Message</label><br>
                                            <textarea name="msg" id="msg" class="form-control"></textarea>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="px-4 btn btn-info">Submit</button>
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
    <footer class="footer d-flex justify-content-center bg-secondary">
        Copyright &copy;&nbsp;<strong>DD Form Builder</strong>&nbsp;2024-25.
        All rights reserved.
    </footer>
</body>
<?php include "./Include/script.php"; ?>
<script>
    $(document).ready(function () {
        $("#fbmsg").validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                msg: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "<span class='text-danger'>Please enter your full name</span>"
                },
                email: {
                    required: "<span class='text-danger'>Please enter your email address</span>",
                    email: "<span class='text-danger'>Please enter a valid email address</span>"
                },
                msg: {
                    required: "<span class='text-danger'>Please enter a message</span>"
                }
            },
            submitHandler: function (form) {
                const feedbackData = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    msg: $("#msg").val()
                };

                fetch('Controller.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(feedbackData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Feedback submitted successfully!');
                        // Optionally clear the form
                        $("#fbmsg")[0].reset();
                    } else {
                        alert('Failed to submit feedback: ' + data.error);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    });
</script>


</html>