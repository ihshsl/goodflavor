<?php
require_once "includes/inc.session.php";
include 'includes/inc.config.php';
include 'includes/class/cls.Cart.php';
include 'includes/class/cls.Option.php';
include 'includes/class/cls.Menu.php';
include 'includes/class/cls.Common.php';

if (!isset($_SESSION['CartCustomer']['CustomerMobile']) || empty($_SESSION['CartCustomer']['CustomerMobile'])) {
    header("location:member-login.php");
}

$menu = new Menu();
$common = new Common();
$cart = new Cart();
$option = new Option();
if (@$_REQUEST['mode'] == 'reset') {
    $cart->destroy();
    $cart = new Cart();
}
if (isset($_GET['action']) &&  $_GET['action'] == "removeCartItem") {
    $itemId = isset($_GET['id']) ? $_GET['id'] : null;
    unset($_SESSION['cart_contents'][$itemId]);
    $cart = new Cart();
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
    <style>
    .btn-tips .active {
        background-color: yellow !important;
    }
    </style>
</head>

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
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=cake">Cake</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">

            </ul>
        </div>
    </nav>
    <!-- End Header -->
    <?php include 'includes/inc.logged.php' ?>
    <br>
    <?php if (isset($_SESSION['CartCustomer']['isRewardExist']) && $_SESSION['CartCustomer']['isRewardExist'] == true && empty($_SESSION['rewardMenuId'])) { ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Congratulations!</h4>
        <p> <?= $_SESSION['CartCustomer']['CustomerFirstname'] . " " . $_SESSION['CartCustomer']['CustomerLastname'] ?>,
            You have
            a reward of $10 for your loyalty with our restaurant. </p>
        <hr>
        <p class="mb-0">You can choose any <b>ONE</b> item under $10.
            Go to this <a href="home.php?reward=true" class="alert-link">link</a></p>
    </div>
    <?php } ?>

    <main id="main">
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <button class="btn btn-primary div_split_new">Split</button>
                                <h5 class="card-title">Cart Summary</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th width="45%">Menu</th>
                                                <th width="5%">Price</th>
                                                <th width="8%">Quantity</th>
                                                <th class="text-right" width="10%">Total</th>
                                                <th width="5%"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($cart->total_items() > 0) {
                                                // Get cart items from session
                                                $cartItems = $_SESSION['cart_contents'];
                                                $subTotal = "0.00";
                                                foreach ($cartItems as $key => $items) {

                                                    $menu_data = $menu->getMenuById($key);

                                                    $option_total = "0.00";

                                                    foreach ($items as $item) {

                                                        $optionArray = $cart->getOption($item['option_id']);
                                                        $optionQtyArray = $cart->getOptionQty($item['option_qty']);
                                                        foreach ($optionArray as $key2 => $row) {
                                                            if (empty($optionArray) || $optionArray[0] == 0) {
                                                                continue;
                                                            }

                                                            $option_qty = --$optionQtyArray[$key2];
                                                            $option_tile = $option->getOptionNameFromArray($row)['title'];
                                                            $option_price = $option->getOptionNameFromArray($row)['price'];
                                                            $option_total += $option_price * ($option_qty <= 0 ? 0 : $option_qty);
                                                        }
                                                    }
                                                    $subTotal += ($menu_data["menu_price"] * count($items)) + $option_total;
                                                  ?>
                                            <tr>
                                                <td>

                                                    <?php echo $menu_data["menu_name"]; ?>

                                                    <span class="badge badge-info div_meal"
                                                        data-menu_name="<?= $menu_data["menu_name"]; ?>"
                                                        data-menu_id="<?= $key; ?>">Options</span>
                                                    <!-- <span class="badge badge-primary div_split"
                                                        data-menu_name="" data-menu_id="">Split</span> -->
                                                    <input value="<?= $key; ?>" name="split_select[]" type="checkbox"
                                                        data-menu_id="<?= $key; ?>" class="cls_checkbox_split">
                                                    <?php if(isset($_SESSION['split'][$key])) { echo '<a href="#" class="badge badge-warning float-right mt-2">'.$_SESSION['split'][$key]['name'].'</a>';}
                                                            ?>
                                                </td>
                                                <td><?php echo '$' . ($common->formatCurrency($menu_data["menu_price"])); ?>
                                                </td>
                                                <td><input class="form-control" type="number"
                                                        value="<?php echo count($items); ?>"
                                                        onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"
                                                        readonly /></td>
                                                <td class="text-right">
                                                    <?php echo '$' . ($common->formatCurrency(($item["price"] * count($items)) + $option_total)); ?>
                                                </td>

                                                <td class="text-right">
                                                    <div class="btn-group">
                                                        <button class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure?')? window.location.href='view-cart.php?action=removeCartItem&id=<?php echo $key; ?>':false;"><i
                                                                class="fa fa-trash"></i> </button>
                                                        &nbsp;
                                                        <button class="btn btn-primary btn-sm div_menu"
                                                            data-menu_name="<?= $menu_data["menu_name"]; ?>"
                                                            data-menu_id="<?= $key; ?>"><i class="fa fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php if(isset($_SESSION['rewardMenuId'])) {
                                                      $rewardDetails = $menu->getMenuById($_SESSION['rewardMenuId']);
                                                      ?>
                                            <tr>
                                                <td><?= $rewardDetails['menu_name']." ***Reward Item ***"; ?></td>
                                                <td><?= "$".$common->formatCurrency($rewardDetails['menu_price']); ?>
                                                </td>
                                                <td>1</td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                            <?php } else { ?>
                                            <tr>
                                                <td colspan="5">
                                                    <p>Your cart is empty.....</p>
                                                </td>
                                                <?php } ?>
                                                <?php if ($cart->total_items() > 0) { ?>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><strong>Subtotal</strong></td>
                                                <td class="text-right"><strong><span
                                                            class="subTotal_block"><?= $common->formatCurrency($subTotal); ?></span></strong>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><strong>Tips</strong></td>
                                                <td class="text-right"><strong><span
                                                            class="tips_block"><?= $tip = $common->calculateTip(); ?></span></strong>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><strong>Tech Fee</strong></td>
                                                <td class="text-right"><strong><span
                                                            class="tech_block"><?php echo $techTotal = $cart->getTechTotal(); ?></span></strong>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><strong>Tax(7%)</strong></td>
                                                <td class="text-right"><strong><span
                                                            class="tax_block"><?php echo $taxTotal = number_format(0.07 * $subTotal, 2); ?></span></strong>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td><strong>Cart Total</strong></td>
                                                <td class="text-right"><strong>$<span
                                                            class="grandTotal_block"><?php echo number_format((float) $subTotal + (float) $techTotal + (float) $taxTotal + (float) $tip, 2); ?></span></strong>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col mb-2">
                        <br>
                        <div class="btn-group">

                            <a href="view-cart.php?mode=reset" class="btn btn-danger">Reset Cart</a>
                            <a href="home.php" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Continue
                                Shopping</a>

                            <!-- <div class="col-sm-12 col-md-4 text-right">
                                <?php if ($cart->total_items() > 0) { ?>
                                    <a href="checkout.php" class="btn btn-lg btn-block btn-primary">Checkout</a>
                                <?php } ?>
                            </div> -->
                        </div>
                    </div>

                </div>
                <br>
                <?php if ($cart->total_items() > 0) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="jumbotron" style="background-color: white;">
                            <h5 class="display-6">Payment Option</h5>
                            <img class="img-fluid" src="assets/img/cash_icon_2.png" width="300px"
                                onclick="location.href = 'checkout-cash.php';">
                            <img class="img-fluid" src="assets/img/card_icon.jpg" width="300px"
                                onclick="location.href = 'checkout2.php?method=card';">
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section><!-- End Gallery Section -->
    </main><!-- End #main -->
    <div class="modal fade" id="myModal3" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="submit-form">Add to cart
                        <i class="fa fa-cart-plus ml-2" aria-hidden="true"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="myModal2" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title2">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body2">

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="modalSplit" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title-split">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-split">

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade" id="modalSplitNew" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title-split-new">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body-split-new">

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="submit-form-split">Save
                        <i class="fa fa-cart-plus ml-2" aria-hidden="true"></i>
                    </button>
                </div>
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

        $('.div_menu').off().on('click', function() {
            var menuName = $(this).attr('data-menu_name');
            var menuId = $(this).attr('data-menu_id');
            $('.modal-title2').html(menuName);
            $('.modal-body2').load('ajax/view-menu-details.php?id=' + menuId, function() {

                $('#myModal2').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
            $('#myModal2').on('shown.bs.modal', function(e) {

            })
        });
    });

    function int_price(menuId) {

        var menu_price = parseFloat($("#menu_price_" + menuId).val());
        var menu_count = parseFloat($(".count").val());
        var menu_total = menu_price * menu_count;
        var sum = 0;

        $('.sub_total_option').each(function() {
            sum += parseFloat(this.value);
        });
        $(".m" + menuId).html(parseFloat(menu_total + sum).toFixed(2));
    }

    $(function() {

        $('.div_meal').off().on('click', function(e) {
            e.preventDefault();
            var menuName = $(this).attr('data-menu_name');
            var menuId = $(this).attr('data-menu_id');

            $('.modal-title').html(menuName);
            $('.modal-body').load('ajax/edit-cart.php?id=' + menuId, function() {
                $('.count').prop('disabled', true);

                $('#myModal3').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
            $('#myModal3').on('shown.bs.modal', function(e) {
                e.preventDefault();
                rebindEvents();
                int_price(menuId);
            })
        });

        $('#submit-form').off().on('click', function() {
            submitForm();
            return false;
        });

        $('.div_split').off().on('click', function(e) {
            e.preventDefault();
            var menuName = $(this).attr('data-menu_name');
            var menuId = $(this).attr('data-menu_id');

            $('.modal-title-split').html(menuName);
            $('.modal-body-split').load('ajax/split-cart.php?id=' + menuId, function() {
                $('.count').prop('disabled', true);

                $('#modalSplit').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
            $('#modalSplit').on('shown.bs.modal', function(e) {
                e.preventDefault();
                // rebindEvents();
                // int_price(menuId);
            })
        });

        $('.div_split_new').off().on('click', function(e) {
            e.preventDefault();
            var checkbox_value = "";
            $(":checkbox").each(function() {
                var ischecked = $(this).is(":checked");
                if (ischecked) {
                    checkbox_value += $(this).val() + "|";
                }
            });

            if (checkbox_value == "") {
                return false;
            }

            // var menuName = $(this).attr('data-menu_name');
            var menuId = $(this).attr('data-menu_id');

            $('.modal-title-split-new').html("Split Payment");
            $('.modal-body-split-new').load('ajax/split-cart-new.php?id=' + checkbox_value, function() {
                $('.count').prop('disabled', true);

                $('#modalSplitNew').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
            $('#modalSplitNew').on('shown.bs.modal', function(e) {
                e.preventDefault();
                $('#modalSplitNew').on('hidden.bs.modal', function() {
                    $('.cls_checkbox_split').prop('checked', false);
                })
                // rebindEvents();
                // int_price(menuId);
            })
        });

        $('#submit-form-split').off().on('click', function(e) {
            if ($('#split-form').valid()) {
                e.preventDefault();
                submitFormSplit();
            }
            return false;
        });

    });

    function rebindEvents() {
        $("#myModal3").on('hidden.bs.modal', function() {
            $('#myModal3').modal('dispose');
        });

        $('.plus').off().on('click', function() {

            var signId = $(this).attr('data-sign_id');
            var signPrice = $(this).attr('data-sign_price');
            var plus_count = parseInt($('.count').val()) + 1;
            $('.count').val(plus_count);
            calculatePrice(signId, plus_count, signPrice);
            getAcc(signId, plus_count);
        });

        $('.minus').off().on('click', function() {

            var signId = $(this).attr('data-sign_id');
            var signPrice = $(this).attr('data-sign_price');
            var minus_count = parseInt($('.count').val()) - 1;
            if (minus_count != 0) {
                $('.cardRemove' + (minus_count + 1)).remove();
            }

            var sum = 0;

            if (minus_count >= 1) {
                $('.count').val(minus_count);
                menu_total = parseFloat(signPrice) * (minus_count);
                $('.sub_total_option').each(function() {
                    sum += parseFloat(this.value);
                });
                $(".m" + signId).html(parseFloat(menu_total + sum).toFixed(2));
            }
        });

        $('.option-plus').off().on('click', function() {

            var sign_option_id = $(this).attr('data-sign_option_id');
            var sign_menu_id = $(this).attr('data-sign_menu_id');
            var signPrice = $(this).attr('data-sign_option_price');
            var signTab = $(this).attr('data-sign_option_tab');
            var unique_id = sign_menu_id + "_" + signTab + "_" + sign_option_id;

            var plus_count = parseInt($('.option_count_' + unique_id).val()) + 1;

            var menu_price = parseFloat($("#menu_price_" + sign_menu_id).val());
            var menu_count = parseFloat($(".count").val());
            var menu_total = menu_price * menu_count;

            $('.option_count_' + unique_id).val(plus_count);
            if (plus_count == 1) {
                $('#sub_total_option_' + unique_id).val(parseFloat(0));
            } else {
                $('#sub_total_option_' + unique_id).val(parseFloat(signPrice) * (plus_count - 1));
            }


            var sum = 0;
            $('.sub_total_option').each(function() {
                sum += parseFloat(this.value);
            });

            $(".m" + sign_menu_id).html(parseFloat(menu_total + sum).toFixed(2));
        });

        $('.option-minus').off().on('click', function() {

            var sign_option_id = $(this).attr('data-sign_option_id');
            var sign_menu_id = $(this).attr('data-sign_menu_id');
            var signPrice = $(this).attr('data-sign_option_price');
            var signTab = $(this).attr('data-sign_option_tab');
            var unique_id = sign_menu_id + "_" + signTab + "_" + sign_option_id;

            var minus_count = parseInt($('.option_count_' + unique_id).val());
            var menu_price = parseFloat($("#menu_price_" + sign_menu_id).val());
            var menu_count = parseFloat($(".count").val());
            var menu_total = menu_price * menu_count;
            var sum = 0;

            if (minus_count > 0) {
                $('.option_count_' + unique_id).val(minus_count - 1);
                console.log(minus_count);
                if (minus_count == 1) {
                    $('#sub_total_option_' + unique_id).val(parseFloat(0));
                } else {
                    $('#sub_total_option_' + unique_id).val(parseFloat(signPrice) * (minus_count - 2));
                }

                $('.sub_total_option').each(function() {
                    sum += parseFloat(this.value);
                });

                $(".m" + sign_menu_id).html(parseFloat(menu_total + sum).toFixed(2));
            }
        });
    }

    function submitForm() {
        $.ajax({
            type: "POST",
            url: "ajax/update-checkout-form.php",
            cache: false,
            data: $('form#checkout-form').serialize(),
            success: function(response) {
                $("#contact").html(response)
                $("#myModal3").modal('hide');
                $("#cart-icon-div").load("ajax/update-total-cart.php");
                location.reload();
            },
            error: function() {
                alert("Error");
            }
        });
    }

    function submitFormSplit() {
        $.ajax({
            type: "POST",
            url: "ajax/update-split-form.php",
            cache: false,
            data: $('form#split-form').serialize(),
            success: function(response) {
                if(response == "error"){
                    alert("invalid mobile number");
                }else{
                    $("#modalSplitNew").modal('hide');
                location.reload();
                }

            },
            error: function() {
                alert("Error");
            }
        });
    }

    function calculatePrice(signId, count, signPrice) {
        var menu_price = parseFloat($(".m" + signId).text());
        var price_str = parseFloat(signPrice).toFixed(2);

        var sum = 0;
        $('.sub_total_option').each(function() {
            sum += parseFloat(this.value);
        });

        $(".m" + signId).html(parseFloat(sum + (count * price_str)).toFixed(2));
    }

    function getAcc(signId, plus_count) {
        $(".plus").attr('disabled', true);
        $(".minus").attr('disabled', true);
        $.ajax({
            url: "ajax/get-accordion-options.php?id=" + signId + "&count=" + plus_count,
            success: function(result) {
                $(".accordion").append(result);
                rebindEvents();
                $(".plus").attr('disabled', false);
                $(".minus").attr('disabled', false);
            }
        });
    }
    </script>
</body>

</html>