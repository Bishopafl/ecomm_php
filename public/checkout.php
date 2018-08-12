<?php require_once("../resources/config.php"); ?>
<!-- HEADER INCLUDES -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
<!-- HEADER INCLUDES -->
<?php 

// if (isset($_SESSION['product_1'] || $_SESSION['product_2'])) {
    echo "<pre>";
    print_r($_SESSION['item_total']);
    echo "</pre>";
// }

?>

<!-- Page Content -->
<div class="container">
    <!-- /.row --> 
    <div class="row">
        <h4 class="text-center bg-danger"><?php display_message(); ?></h4>
        <!-- CHECKOUT FORM -->
        <!-- CHECKOUT FORM -->
        <h1>Checkout</h1>
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="business" value="business@adamlopez.co">
            <input type="hidden" name="currency_code" value="USD">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub-total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php cart(); ?>
                </tbody>
            </table>
            <?php echo show_paypal(); ?>
        </form>
        <!-- CHECKOUT FORM -->
        <!-- CHECKOUT FORM -->
        <!--  ***********CART TOTALS*************-->
        <!--  ***********CART TOTALS*************-->
        <div class="col-xs-4 pull-right ">
            <h2>Cart Totals</h2>
            <table class="table table-bordered" cellspacing="0">
                <tr class="cart-subtotal">
                    <th>Items:</th>
                    <td><span class="amount"><?php
                        // pulling the $_SESSION['item_quantity'] from cart.php in the cart()
                        echo isset($_SESSION['item_quantity']) ?  $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0";
                    ?></span></td>
                </tr>
                <tr class="shipping">
                    <th>Shipping and Handling</th>
                    <td>Free Shipping</td>
                </tr>
                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong><span class="amount">&#36;<?php 
                        // pulls the SESSION['item_total'] from cart.php in the cart()
                        echo isset($_SESSION['item_total']) ?  $_SESSION['item_total'] : $_SESSION['item_total'] = "0.00";
                    ?></span></strong></td>
                </tr>
            </table>
        </div>
        <!--  ***********CART TOTALS*************-->
        <!--  ***********CART TOTALS*************-->
    </div><!--Row Content-->    
</div>
<!-- Page Content -->
<!-- INCLUDE FOOTER -->
<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>
<!-- INCLUDE FOOTER -->