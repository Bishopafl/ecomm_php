<?php require_once("../resources/config.php"); ?>

<?php 

// get request that get's the id
if (isset($_GET['add'])) {
    // increments all the time the add button is clicked
    // this is how we will keep track of products in shopping cart
    // $_SESSION['product_' . $_GET['add']] +=1;
    // // redirects back to index.php
    // redirect("index.php");

    // query the database 
    $query = query("SELECT * FROM products WHERE product_id=" .escape_string($_GET['add']). " ");
    // confirm that the query is returning correctly
    confirm($query);
    // getting information from query
    while ($row = fetch_array($query)) {
        // is not equal, increment to the shopping cart
        if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            $_SESSION['product_' . $_GET['add']] +=1;
            redirect("checkout.php");
        } else {
            // or if they keep on adding and they don't have it in the db
            set_message("We only have " . $row['product_quantity'] . " of " . $row['product_title'] . " available.");
            redirect("checkout.php");
        } 
    }
}
// ============================================================
// setting up remove items from the shopping cart
// ------------------------------------------------------------
if (isset($_GET['remove'])) {
    // if remove is clicked, remove the incremented quantity of the item
    $_SESSION['product_' . $_GET['remove']]--;
    // if they are removing an item we have zero so lets display a message to let the customer know
    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['item_total']);
        unset($_SESSION['item_quantity']);
        redirect("checkout.php");
    } else {
        redirect("checkout.php");
    }
}
// ============================================================
// setting up deleting items from the shopping cart
// ------------------------------------------------------------
if (isset($_GET['delete'])) {
    // if deleting an item for shopping cart, remove completely
    $_SESSION['product_' . $_GET['delete']] = '0';
    // after removing item, redirect back to checkout.php
    unset($_SESSION['item_total']);
    unset($_SESSION['item_quantity']);
    redirect("checkout.php");
}
// ============================================================
// function resposible displaying items to display in checkout.php
// ------------------------------------------------------------
function cart() {
    $total = 0;
    $item_quantity = 0;
    $item_name = 1; //default item name number and amount to 1, then make a loop to increment
    $item_number = 1;
    $amount = 1;
    $quantity = 1;

    foreach ($_SESSION as $product => $value) {
        if ($value > 0 ) {
            if (substr($product, 0, 8) == "product_") {
                $length = strlen($product - 8);
                // retrieves id for product in user session
                $id = substr($product, 8, $length);
                // queries db for products in $id variable
                $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
                // confirm the query using helper function
                confirm($query);
                // lets loop through the stuff to get the information from the db
                while ($row = fetch_array($query)) {
                    // multiply price with value 
                    // of session products for subtotal
                    $sub = $row['product_price']*$value;
                    $item_quantity += $value;
                    // echo $item_quantity;
                    // display products using a delimeter        
                    $product = <<<DELIMETER
                    <tr>
                        <td>{$row['product_title']}</td>
                        <td>&#36;{$row['product_price']}</td>
                        <td>{$value}</td>
                        <td>&#36;{$sub}</td>  
                        <td>
                            <a class='btn btn-warning' href="cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
                            <a class="btn btn-success" href='cart.php?add={$row['product_id']}'><span class='glyphicon glyphicon-plus'></span></a>
                            <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>
                        </td>
                        <td></td>
                    </tr>
                    <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
                    <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
                    <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
                    <input type="hidden" name="quantity_{$quantity}" value="{$value}">
DELIMETER;
            // echo the product variable
            echo $product;
            // increment the item name, number and amount in the cart!
            $item_name++;
            $item_number++;
            $amount++;
            $quantity++;
            } // end of while($row)
            // ================================
            // creating the total & quantity
            // to create display the total!
            // ================================
            // Lets set the session variables to use
            // information from this page on the checkout.php
            $_SESSION['item_total'] = $total += $sub;
            $_SESSION['item_quantity'] = $item_quantity;
            } // end of if(substr)
        } // end of if($value)
    } // end of foreach($_SESION)
} // end of cart()
// ============================================================
// display the paypal button when there is a quantity in the cart
// ------------------------------------------------------------
function show_paypal() {
    if (isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) {

    $paypal_button = <<<DELIMETER
    <input type="image" name="upload" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
DELIMETER;
    return $paypal_button;
    }
}


?>