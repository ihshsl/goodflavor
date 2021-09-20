<?php
require_once "includes/inc.session.php";
include 'includes/inc.config.php';
include 'includes/class/cls.Menu.php';
include 'includes/class/cls.Cart.php';
include 'includes/class/cls.Option.php';
include 'includes/class/cls.Common.php';

if(!isset($_SESSION['CartCustomer']['CustomerMobile']) || empty($_SESSION['CartCustomer']['CustomerMobile'])){
   //header("location:member-login.php");
}

$cart = new Cart();
$menu_type = !empty($_GET['m']) ? $_GET['m'] : null;
$menu = new Menu();
$menu_data = $menu->getMenuByType($menu_type);
$common = new Common();
$reward = (isset($_GET['reward']) && $_GET['reward'] == true) ? true : false;
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
<style type="text/css">
  /* !important is needed sometimes */
 ::-webkit-scrollbar {
    width: 12px !important;
    -webkit-appearance: none;
    display: block !important;
 }

 /* Track */
::-webkit-scrollbar-track {
   -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3) !important;
   -webkit-border-radius: 10px !important;
   border-radius: 10px !important;
   display: block !important;
 }

 /* Handle */
 ::-webkit-scrollbar-thumb {
   -webkit-border-radius: 10px !important;
   border-radius: 10px !important;
   background: #41617D !important; 
   -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5) !important; 

 }
 ::-webkit-scrollbar-thumb:window-inactive {
   background: #41617D !important; 
 }
</style>
<body class="container-fluid d-flex flex-column min-vh-100">
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
                    <a class="nav-link" href="home.php?reward=<?= $reward; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=breakfast&reward=<?= $reward; ?>">Breakfast</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=lunch&reward=<?= $reward; ?>">Lunch</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=meals&reward=<?= $reward; ?>">Meals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=drinks&reward=<?= $reward; ?>">Drinks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php?m=cake&reward=<?= $reward; ?>">Cake</a>
                </li>
            </ul>
            <ul class="nav navbar-nav ml-auto w-100 justify-content-end">

            </ul>
        </div>
    </nav>
    <!-- End Header -->
    <?php include 'includes/inc.logged.php' ?>
    <div class="container-fluid">
        <h1 class="heading-1 heading_text" ><span><?= ucwords($menu_type); ?></span></h1>
    </div>

    <main id="main" class="container-fluid">
        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">

            <div class="row container-fluid" style="margin:0px">
                <?php foreach ($menu_data as $menu) {
                    if($reward == 1 && $menu['menu_price'] > 10.00) continue;
                    if (!file_exists("assets/platos/" . $menu['menu_image']) || empty($menu['menu_image'])) continue;
                    $menu_image = file_exists("assets/platos/" . $menu['menu_image']) ? $menu['menu_image'] : "no_image_icon.png";
                    $menu_name = $menu['menu_name'];
                    $menu_id = $menu['id'];
                    $menu_price = number_format($menu['menu_price'], 2);
                ?>
                <div class="col-lg-3 col-md-4 col-6" style="padding-right: 0px;padding-left: 0px;">
                    <div class="">
                        <div class="Portfolio div_meal" style="cursor:pointer;" data-menu_name="<?= $menu_name; ?>"
                            data-menu_id="<?= $menu_id; ?>" data-menu_price="<?= $menu_price; ?>"
                            data-is_reward="<?= ($reward == true) ? 1 : 0; ?>">
                            <img class="card-img img-fluid" src="assets/platos/<?= $menu_image; ?>" alt="">
                            <div class="item_id"><?= $menu['item_id']; ?></div>
                            <div class="desc">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <p class="font-weight-bold text-left menu-text">
                                            <?= (strlen($menu_name) > 20) ? substr($menu_name, 0, 20) . '...' : $menu_name; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <p class="font-weight-bold text-left menu-price"><?= "$" . $menu_price; ?></p>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <button type="button" class="btn btn-outline-dark btn-sm">Options&nbsp;<i
                                                class="fas fa-angle-double-down"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </section><!-- End Gallery Section -->

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">

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

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include 'includes/inc.footer.php' ?>

    <!-- End Footer -->

    <!-- <div id="preloader"></div> -->
    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

    <?php include 'includes/inc.scripts.php' ?>
    <!-- Vendor JS Files -->

    <script type="text/javascript">
    $(function() {

        $('.div_meal').off().on('click', function() {
            var menuName = $(this).attr('data-menu_name');
            var menuId = $(this).attr('data-menu_id');
            is_reward = $(this).attr('data-is_reward');
            $('.modal-title').html(menuName);
            $('.modal-body').load('ajax/get-menu-details.php?id=' + menuId, function() {
                $('.count').prop('disabled', true);

                $('#myModal').modal({
                    show: true,
                    keyboard: false,
                    backdrop: 'static'
                });
            });
            $('#myModal').on('shown.bs.modal', function(e) {
                rebindEvents();
            })
        });

        $('#submit-form').off().on('click', function() {
            submitForm(is_reward);
            return false;
        });
    });

    function rebindEvents() {
        $("#myModal").on('hidden.bs.modal', function() {
            $('#myModal').modal('dispose');
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
            $('.cardRemove' + (minus_count + 1)).remove();
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

    function submitForm(is_reward) {
        $.ajax({
            type: "POST",
            url: "ajax/save-checkout-form.php?is_reward=" + is_reward,
            cache: false,
            data: $('form#checkout-form').serialize(),
            success: function(response) {
                $("#contact").html(response)
                $("#myModal").modal('hide');
                $("#cart-icon-div").load("ajax/update-total-cart.php");
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