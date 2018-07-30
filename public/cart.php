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
    redirect("checkout.php");
}
// ============================================================
// function resposible displaying items to display in checkout.php
// ------------------------------------------------------------
function cart() {

    foreach ($_SESSION as $product => $value) {
        echo "<pre>";
        var_dump($product);
        echo "</pre>";

        if ($value > 0 ) {
            if (substr($product, 0, 8) == "product_") {

            $length = strlen($product - 8);
            // id of session
            $id = substr($product, 8, $length);

            $query = query("SELECT * FROM products WHERE product_id = " . escape_string($id) . " ");
            confirm($query);
            // lets loop through the stuff to get the information from the db
            while ($row = fetch_array($query)) {
                // multiply price with value 
                // of session products for subtotal
                $sub = $row['product_price']*$value;
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
DELIMETER;
            // echo the product variable
            echo $product;
            } // end of while
        } // end of if
        }
    } // end of foreach
} // end of cart()
// ============================================================
// function resposible displaying items to display in checkout.php
// ------------------------------------------------------------



?>