<?php
if(!isset($_SESSION)) {
	session_start();
}
include 'includes/inc.config.php';
include 'includes/class/cls.Menu.php';
include 'includes/class/cls.Cart.php';
include 'includes/class/cls.Option.php';
include 'includes/class/cls.Common.php';

$cart = new Cart();
$menu = new Menu();
$option = new Option();
$common = new Common();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Good Flavor Latin Restaurant</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <?php include 'includes/inc.head.php' ?>

</head>
<style>
.navbar-toggler {
    background-color: white;
}

.card {
    border: 0px
}
</style>

<body class="container-fluid  d-flex flex-column min-vh-100" style="background-color: tomato;">
    <!-- ======= Header ======= -->
    <?php include("includes/inc.logo_header.php"); ?>

    <!-- End Header -->
    <main id="main" class="container-fluid">
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container-fluid " data-aos-delay="100">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-12 d-flex justify-content-center">
                        <div class="card" style="background-color: rgba(245, 245, 245, 0);" data-toggle="modal"
                            data-target="#contact-modal" data-keyboard="false" data-backdrop="static">
                            <img class="imgd" src="assets/img/new-customer-icon.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="text-white">10% OFF +1 POINT REWARD</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-12 d-flex justify-content-center">
                        <div class="card" style="background-color: rgba(245, 245, 245, 0);" data-toggle="modal"
                            data-target="#login-modal" data-keyboard="false" data-backdrop="static">
                            <img class="imgd" src="assets/img/Accept-Male-User-icon.png" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="text-white"> +1 POINT REWARD</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-12 d-flex justify-content-center">
                        <div class="card" style="background-color: rgba(245, 245, 245, 0);" data-toggle="modal"
                            data-target="#guest-login-modal" data-keyboard="false" data-backdrop="static">
                            <img class="imgd" src="assets/img/guest-icon.png" alt="Card image cap">
                            <div class="card-body">
                                <h3 class="text-white">NO REWARDS</h3>
                            </div>
                        </div>
                    </div>



                    <!-- <div class="col-md-3" data-toggle="modal" data-target="#contact-modal" data-keyboard="false"
                        data-backdrop="static">
                        <img class="img-fluid" src="assets/img/new-customer-icon.jpg">
                        <p>New Coustomer</p>
                    </div> -->
                    <!-- <div class="col-md-3" data-toggle="modal" data-target="#login-modal" data-keyboard="false"
                        data-backdrop="static"><img class="img-fluid" src="assets/img/Accept-Male-User-icon.png">
                        <p>Existing Member</p>
                    </div> -->
                    <!-- <div class="col-md-3" data-toggle="modal" data-target="#guest-login-modal" data-keyboard="false"
                        data-backdrop="static"><img class="img-fluid" src="assets/img/guest-icon.png">
                        <p>Guest</p>
                    </div> -->
                </div>

            </div>
        </section><!-- End Gallery Section -->
    </main><!-- End #main -->

    <div id="contact-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Member Registration</h3>
                    <a class="close" data-dismiss="modal">×</a>
                </div>
                <form id="contactForm" name="contact" role="form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" name="first_name" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="email">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required autocomplete="off">
                        </div>
                        <label for="mobile">Mobile</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+1</span>
                            </div>
                            <input type="tel" name="mobile" class="form-control" pattern="[1-9]{1}[0-9]{9}" required
                                autocomplete="off">
                        </div>
                        <label for="mobile" generated="true" class="error"></label><br/>
                        <div class="form-group">
                            <label for="message">Email</label>
                            <input type="email" name="email" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" id="contactFormBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="login-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Member Login</h3>
                    <a class="close" data-dismiss="modal">×</a>
                </div>
                <form id="loginForm" name="loginForm" role="form">
                    <div class="modal-body">
                        <label for="mobile">Mobile</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+1</span>
                            </div>
                            <input type="tel" name="mobile" class="form-control" pattern="[1-9]{1}[0-9]{9}" required
                                autocomplete="off">
                        </div>
                        <label for="mobile" generated="true" class="error"></label><br/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" id="loginFormBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="guest-login-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Guest Login</h3>
                    <a class="close" data-dismiss="modal">×</a>
                </div>
                <form id="guestLoginForm" name="guestLoginForm" role="form">
                    <div class="modal-body">
                        <label for="mobile">Mobile</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+1</span>
                            </div>
                            <input type="text" name="mobile" class="form-control" pattern="[1-9]{1}[0-9]{9}" required
                                autocomplete="off">
                        </div>
                        <label for="mobile" generated="true" class="error"></label><br/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" id="guestLoginFormBtn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ======= Footer ======= -->
    <?php include 'includes/inc.footer.php' ?>

    <!-- End Footer -->

    <!-- <div id="preloader"></div> -->
    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

    <?php include 'includes/inc.scripts.php' ?>
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
    $(function() {

        $(".navbar-toggler").click(function() {
            $("nav").toggleClass("bg-light");
        })
        $("#contactFormBtn").on('click', function(e) {
            if ($('#contactForm').valid()) {
                e.preventDefault();
                submitForm();
            }
            return false;
        });
        $("#loginFormBtn").on('click', function(e) {
            if ($('#loginForm').valid()) {
                e.preventDefault();
                submitLoginForm();
            }
            return false;
        });
        $("#guestLoginFormBtn").on('click', function(e) {
            if ($('#guestLoginForm').valid()) {
                e.preventDefault();
                submitGuestLoginForm();
            }
            return false;
        });
    });

    function submitForm() {
        $.ajax({
            type: "POST",
            url: "ajax/member-signup.php",
            cache: false,
            data: $('form#contactForm').serialize(),
            success: function(response) {
                if (response == "mobile_exist") {
                    alert("Mobile number exist in our database.");
                } else if (response == "success") {
                    $('form#contactForm').trigger("reset");
                    $("#contact-modal").modal('hide');
                    alert("Successfully registered.Please signin as member.");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    }

    function submitLoginForm() {
        $.ajax({
            type: "POST",
            url: "ajax/member-signin.php",
            cache: false,
            data: $('form#loginForm').serialize(),
            success: function(response) {
                if (response == "not_found") {
                    alert("Mobile number not found.");
                } else if (response == "success") {
                    $('form#loginForm').trigger("reset");
                    $("#contact-modal").modal('hide');
                    window.location.href = "home.php";
                } else if (response == "not_member") {
                    alert("Member mobile number not found.");
                }
            },
            error: function() {
                alert("Error");
            }
        });
    }

    function submitGuestLoginForm() {
        $.ajax({
            type: "POST",
            url: "ajax/guest-signin.php",
            cache: false,
            data: $('form#guestLoginForm').serialize(),
            success: function(response) {
                if (response == "not_found") {
                    alert("Mobile number not found.");
                } else if (response == "success") {
                    $('form#loginForm').trigger("reset");
                    $("#contact-modal").modal('hide');
                    window.location.href = "home.php";
                } else if (response == "member_cred") {
                    alert("Please logged in as member.")
                }
            },
            error: function() {
                alert("Error");
            }
        });
    }
    </script>
</body>

</html>