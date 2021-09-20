<?php
require_once "../includes/inc.session.php";
include '../includes/inc.config.php';
include '../includes/class/cls.Menu.php';
include '../includes/class/cls.Option.php';
include '../includes/class/cls.Cart.php';

$id = !empty($_GET['id']) ? $_GET['id'] : null;
$menu = new Menu();
$cart = new Cart();
$option = new Option();
$menu_data = $menu->getMenuById($id);
$array_options = explode(",", $menu_data['options']);
$menu_image = file_exists("../assets/platos/" . $menu_data['menu_image']) ? $menu_data['menu_image'] : "no_image_icon.png";
$cartItems = $_SESSION['cart_contents'];
?>

<div class="container-fluid">
    <form id="checkout-form">
        <div class="row">
            <div class="col-md-6 col-6"> <img src="assets/platos/<?= $menu_image; ?>" width="150"></div>
            <div class="col-md-6 col-6 ml-auto">
                <h4 class="h4-responsive">
                    $
                    <span class="green-text <?= ' m' . $id; ?>">
                        <strong><?= number_format($menu_data['menu_price'], 2); ?>x<?= count($cartItems[$id]); ?></strong>
                    </span>
                </h4>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--Accordion wrapper-->
                <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">
                    <?php
                   
                    foreach ($cartItems[$id] as  $index => $item) {
                      
                        $optionArray = $cart->getOption($item['option_id']);
                  
                        $optionQtyArray = $cart->getOptionQty($item['option_qty']);
                        $option_total = 0.00;
                        $subTotal = 0.00;

                        $subTotal += $item["price"] + $option_total;
                    ?>
                        <!-- Accordion card -->
                        <div class="card">

                            <!-- Card header -->
                            <div class="card-header" role="tab" id="headingOne<?= $index; ?>">
                                <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne<?= $index; ?>" aria-expanded="true" aria-controls="collapseOne<?= $index; ?>">
                                    <div class="row">
                                        <div class="col-6"> Options <i class="fas fa-angle-down rotate-icon"></i></div>
                                        <div class="col-6"><i class="fas fa-plus"></i><i class="fas fa-user" style="vertical-align: middle;"></i></div>
                                    </div>
                                </a>
                            </div>

                            <!-- Card body -->
                            <div id="collapseOne<?= $index; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne<?= $index; ?>" data-parent="#accordionEx">
                                <div class="card-body">
                                <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Qty</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                    <?php
                                    foreach ($optionArray as $key => $row) {
                                        if (empty($optionArray) || $optionArray[0] == 0) {
                                            continue;
                                        }

                                        $option_qty = $optionQtyArray[$key];
                                        $option_tile = $option->getOptionNameFromArray($row)['title'];
                                        $option_price = $option->getOptionNameFromArray($row)['price'];
                                        $option_total += $option_price * $option_qty;
                                    ?>
                                     
                                                <tr>
                                                    <td> <?= $option_tile; ?></td>
                                                    <td> <?= number_format($option_price, 2); ?></td>
                                                    <td><?= $option_qty; ?></td>
                                                </tr>
                                    <?php } ?>
                                    </tbody>
                                        </table>
                                </div>

                            </div>
                            <!-- Accordion card -->
                        </div>
                    <?php } ?>
                    <!-- Accordion wrapper -->
                </div>
            </div>
        </div>
    </form>