<?php 

// Helper functions for our ecomm site
// =========================================
// |----------------------------------------
// sets a message for user login
function set_message($msg) {
	if (!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}
// |----------------------------------------
// display message function
function display_message() {
	if (isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}
// |----------------------------------------
// redirect functionality when we need it
function redirect($location) {
	header("location: $location ");
}
// =========================================
// db query function
// |----------------------------------------
function query($sql) {
	global $connection;
	return mysqli_query($connection, $sql);
}
// =========================================
// checks if there are results 
// |----------------------------------------
function confirm($result) {
	if (!$result) {
		die("QUERY FAILED " . mysqli_error($connection));
	}
}
// =========================================
// escape string to prevent SQL injections
// |----------------------------------------
function escape_string($string) {
	global $connection;
	return mysqli_real_escape_string($connection, $string);
}
// =========================================
// mysqli fetch array 
// |----------------------------------------
function fetch_array($result) {
	return mysqli_fetch_array($result);
}
// ================================ FRONT END FUNCTIONS ====================================
// LETS GET OUR PRODUCTS
// |----------------------------------------
function get_products() {
	$query = query(" SELECT * FROM products");
	// makes sure the query is good
	confirm($query);
	while ($row = fetch_array($query)) {
// =========================================
// Herodoc - allows big string of text with " " and ' '
// has to be to the far left of editor for some reason...
// |----------------------------------------
$product = <<<DELIMETER
		<div class="col-sm-4 col-lg-4 col-md-4">
		    <div class="thumbnail">
		    	<a href="item.php?id={$row['product_id']}">
		        	<img src="{$row['product_image']}" alt="">
		        </a>
		        <div class="caption">
		            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
		            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
		            </h4>
		            <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
		            <a class="btn btn-primary" href="cart.php?add={$row['product_id']}">Add to cart</a>
		        </div>
		    </div>
		</div>
DELIMETER;

echo $product;
	} // end of while loop
} // end of get_products()
// =========================================
// GET CATEGORIES Function
// |----------------------------------------
function get_categories() {
	$query = query("SELECT * FROM categories");
	confirm($query);

	while ($row = fetch_array($query)) {
		$category_links = <<<DELIMETER
		<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
DELIMETER;

echo $category_links;
		
	}
}
// ================================ BACK END FUNCTIONS ====================================
// =========================================
// LETS GET OUR CATEGORIES
// |----------------------------------------
function get_products_in_cat_page() {
	$query = query(" SELECT * FROM products WHERE product_category_id =" . escape_string($_GET['id']). " ");
	// makes sure the query is good
	confirm($query);
	while ($row = fetch_array($query)) {
		echo $row['product_price'];
// =========================================
// Herodoc - allows big string of text with " " and ' '
// has to be to the far left of editor for some reason...
// |----------------------------------------
$product = <<<DELIMETER
		<div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="{$row['product_image']}" alt="">
                <div class="caption">
                    <h3>{$row['product_title']}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
DELIMETER;

echo $product;
	} // end of while loop
} // end of get_products()


// =========================================
// LETS GET OUR PRODUCTS IN SHOP PAGE
// |----------------------------------------
function get_products_in_shop_page() {
	$query = query(" SELECT * FROM products");
	// makes sure the query is good
	confirm($query);
	while ($row = fetch_array($query)) {
		// echo $row['product_price'];
// =========================================
// Herodoc - allows big string of text with " " and ' '
// has to be to the far left of editor for some reason...
// |----------------------------------------
$product = <<<DELIMETER
		<div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="{$row['product_image']}" alt="">
                <div class="caption">
                    <h3>{$row['product_title']}</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    <p>
                        <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
DELIMETER;

echo $product;
	} // end of while loop
} // end of get_products()
// =========================================
// LOGIN FUNCTIONALITY
// |----------------------------------------
function login_user() {
	if (isset($_POST['submit'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);

		$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
		confirm($query);
		// returns count of rows
		if (mysqli_num_rows($query) == 0) {
			set_message("Your Password or Username are incorrect");
			redirect("login.php");
		} else {
			// set_message("Welcome to Admin {$username}");
			redirect("admin");
		}
	}

}
// =========================================
// SEND MESSAGE
// |----------------------------------------

function send_message() {
		if (isset($_POST['submit'])) {

			$to 		= "someEmailAddress@gmail.com";
			$from_name 	= isset($_POST['name']) ? $_POST['name'] : '';
			$subject 	= isset($_POST['subject']) ? $_POST['subject'] : '';
			$email 		= isset($_POST['email']) ? $_POST['email'] : '';
			$message 	= isset($_POST['nessage']) ? $_POST['nessage'] : '';


			$headers = "From: {$from_name} {$email}";
			// mail function is not really relable, 
			// email usually goes to junk mail...
			// devs usually use 3rd party mail functions
			$result = mail($to, $subject, $message, $headers);

			if (!$result) {
				redirect("contact.php");
				set_message("Sorry we could not send your message");
			} else {
				set_message("Your Message has been sent");
				redirect("contact.php");
			}
		}
}

?>