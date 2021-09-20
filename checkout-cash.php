<?php
require_once "includes/inc.session.php";
include 'includes/inc.config.php';
include 'includes/class/cls.Cart.php';
include 'includes/class/cls.Option.php';
include 'includes/class/cls.Menu.php';
include 'includes/class/cls.Common.php';

$menu = new Menu();
$common = new Common();
$cart = new Cart();
$option = new Option();
if (!isset($_SESSION['CartCustomer']['CustomerMobile']) || empty($_SESSION['CartCustomer']['CustomerMobile'])) {
    header("location:member-login.php");
}
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
.center {

    border: 0;
    box-shadow: none;
}

  input {
        border-top-style: hidden;
        border-right-style: hidden;
        border-left-style: hidden;
        border-bottom-style: groove;
        background-color: #eee;
      }
      
         .no-outline:focus {
        outline: none;
      }
</style>

<body class="container-fluid  d-flex flex-column min-vh-100">

    <!-- ======= Header ======= -->
    <?php include("includes/inc.logo_header.php"); ?>

    <nav class="navbar navbar-light navbar-expand-md bg-faded justify-content-center">
        <?php include("includes/inc.cart.php"); ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbar3">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse w-100" id="collapsingNavbar3">
            <ul class="navbar-nav w-100 justify-content-center">
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=breakfast">Breakfast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=lunch">Lunch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=meals">Meals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=drinks">Drinks</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">

            </ul>
        </div>
    </nav>
    <!-- End Header -->
    <?php include 'includes/inc.logged.php' ?>
    <main id="main" class="container-fluid">
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container-fluid">

                <div class="py-5 text-center">
                    <h2>Checkout</h2>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-center">
                            <div class="card-header">
                               please select One Of This
                            </div>
                            <div class="card-body">
                                <div id="div-custom-tips" class="d-none">
                                    <h6>Enter the amount that you would like to give as tips</h6>
                                    <div class="row justify-content-center">
                                        <div class="card ">
                                            <div class="card-body  d-flex flex-column">

                                                <input id="custom-tips" class="no-outline" type="text" name="currency"
                                                    data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'">

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <br>
                                <div class="row tip_div d-none">
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="card text-center text-white bg-dark mb-3" style="max-width: 14rem;">
                                            <a data-value="15"
                                                class="card-block stretched-link text-decoration-none btn-tips" href="">
                                                <div class="card-body">
                                                    <h5 class="card-title">15%</h5>
                                                    <p class="card-text">Acceptable</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="card text-center text-white bg-dark mb-3" style="max-width: 14rem;">
                                            <a data-value="18"
                                                class="card-block stretched-link text-decoration-none btn-tips" href>
                                                <div class="card-body">
                                                    <h5 class="card-title">18%</h5>
                                                    <p class="card-text">Good</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="card text-center text-white bg-dark mb-3" style="max-width: 14rem;">
                                            <a data-value="20"
                                                class="card-block stretched-link text-decoration-none btn-tips" href>
                                                <div class="card-body">
                                                    <h5 class="card-title">20%</h5>
                                                    <p class="card-text">Great</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="card text-center text-white bg-dark mb-3" style="max-width: 14rem;">
                                            <a data-value="30"
                                                class="card-block stretched-link text-decoration-none btn-tips" href>
                                                <div class="card-body">
                                                    <h5 class="card-title">30%</h5>
                                                    <p class="card-text">Excellent</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="card text-center text-white bg-dark mb-3" style="max-width: 14rem;">
                                            <a data-value="no"
                                                class="card-block stretched-link text-decoration-none btn-tips" href>
                                                <div class="card-body">
                                                    <h5 class="card-title">No Tip</h5>
                                                    <p class="card-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-4 col-6">
                                        <div class="card text-center text-white bg-dark mb-3" style="max-width: 14rem;">
                                            <a data-value="custom"
                                                class="card-block stretched-link text-decoration-none btn-custom-tips"
                                                href>
                                                <div class="card-body">
                                                    <h5 class="card-title">Custom</h5>
                                                    <p class="card-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card text-center">
                            <div class="card-header">
                               please select One Of This
                            </div>
                            <div class="card-body">
                                <div class="row order_type_div">
                                    <div class="col-lg-2 col-md-2 col-6">
                                        <div class="card text-center text-white bg-dark mb-3">
                                            <a data-value="DI"
                                                class="card-block stretched-link text-decoration-none order-type"
                                                href="">
                                                <div class="card-body">
                                                    <img src="assets/img/dinner-icon.jpg" class="img-fluid">
                                                    <p class="card-text">Eat in</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-6">
                                        <div class="card text-center text-white bg-dark mb-3">
                                            <a data-value="TA"
                                                class="card-block stretched-link text-decoration-none order-type" href>
                                                <div class="card-body">
                                                    <img src="assets/img/take-out.png" class="img-fluid">
                                                    <p class="card-text">Take out</p>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4 order-md-2 mb-4" style="display: none;">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Your cart</span>
                            <span class="badge badge-secondary badge-pill"><?=  $cart->total_items(); ?></span>
                        </h4>
                        <ul class="list-group mb-3 sticky-top">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Subtotal</h6>
                                    <!-- <small class="text-muted">Brief description</small> -->
                                </div>
                                <span class="text-muted subTotal_block"><?= $cart->getCartSubTotal(); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Tip</h6>
                                    <!-- <small class="text-muted">Brief description</small> -->
                                </div>
                                <span class="text-muted tips_block"><?= $common->calculateTip(); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Tech Fee</h6>
                                    <!-- <small class="text-muted">Brief description</small> -->
                                </div>
                                <span class="text-muted tech_block"><?= $cart->getTechTotal(); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Tax</h6>
                                </div>
                                <span class="text-success tax_block"><?= $common->calculateTax(); ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong class="grandTotal_block"><?= $cart->getCartGrandTotal(); ?></strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <?php if(!isset($_SESSION['CartCustomer']['CustomerMobile'])) {?> <a href="home.php">
                                    Please login as member to checkout.</a><?php }else{?>
                                <button class="btn btn-warning"><a href="checkout.php">Checkout Now</a></button>
                                <?php } ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="container-fluid d-flex align-items-center">
                        <?php if(!isset($_SESSION['CartCustomer']['CustomerMobile'])) {?> <a href="home.php">
                            Please login as member to checkout.</a><?php }else{?>
                        <a href="checkout.php"> <button class="btn btn-warning btn-lg">Checkout Now</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section><!-- End Gallery Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'includes/inc.footer.php' ?>

    <!-- End Footer -->

    <!-- <div id="preloader"></div> -->
    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

    <?php include 'includes/inc.scripts.php' ?>
    <!-- Vendor JS Files -->
    <script src="https://cdn.jsdelivr.net/gh/RobinHerbots/jquery.inputmask@5.0.0-beta.87/dist/jquery.inputmask.min.js">
    </script>
    <script>
    $(document).ready(function() {
        $('input').inputmask();
        $('.tip_div').removeClass('d-none');
        $(document).on('click', '.btn-tips', function(e) {
            e.preventDefault();
            $('#div-custom-tips').addClass('d-none');
            var value = $(this).data('value');
            if (value > 0) {
                var subTotal = parseFloat($('.subTotal_block').text());
                tip_amount = parseFloat((value * subTotal) / 100).toFixed(2);
                $('.tips_block').text(tip_amount);
            } else {
                $('.tips_block').text(0.00);
            }
            updateTip(value, "P");
            calculateTotal();
        });

        $('.btn-custom-tips').on("click", function(e) {
            e.preventDefault();
            $('#div-custom-tips').removeClass('d-none');
            $('.tip_div').addClass('d-none');
        });

        $('#custom-tips').on("keyup", function() {
         
            var value = $(this).val().replace(/[$,]/g, ''); // remove characters
            if (value > 0) {
                var subTotal = parseFloat($('.subTotal_block').text());
                tip_amount = parseFloat((value * subTotal) / 100).toFixed(2);
                $('.tips_block').text(tip_amount);
            } else {
                $('.tips_block').text(0.00);
            }
            updateTip(value, "C");
            calculateTotal();
        });

        $(".btn-tips").click(function() {
            $('.btn-tips').addClass("bg-dark");
            $(this).removeClass("bg-dark");
            $(this).addClass("bg-light");
        })
        $(".order-type").click(function() {
            $('.order-type').addClass("bg-dark");
            $(this).removeClass("bg-dark");
            $(this).addClass("bg-light");
        })
    });

    function calculateTotal() {
        var subTotal = parseFloat($('.subTotal_block').text());
        var techFee = parseFloat($('.tech_block').text());
        var taxFee = parseFloat($('.tax_block').text());
        var tipTotal = parseFloat($('.tips_block').text());
        var grandTotal = parseFloat(subTotal + techFee + taxFee + tipTotal).toFixed(2);
        $('.grandTotal_block').text(grandTotal);
    }

    function updateTip(value, type) {
        $.ajax({
            url: "ajax/update-tip.php?value=" + value + "&type=" + type,
            cache: false,
            success: function(res) {

            }
        });
    }

    $(document).on('click', '.order-type', function(e) {
        e.preventDefault();
        $('#div-custom-tips').addClass('d-none');
        var value = $(this).data('value');

        updateOrderType(value);

    });

    function updateOrderType(value) {
        $.ajax({
            url: "ajax/update-order-type.php?value=" + value,
            cache: false,
            success: function(res) {

            }
        });
    }
    </script>
</body>

</html>