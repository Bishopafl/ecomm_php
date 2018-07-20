<?php 

// Helper functions for our ecomm site
// =========================================
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
		echo $row['product_price'];
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
		            <a class="btn btn-primary" target="_blank" href="item.php?id={$row['product_id']}">Add to cart</a>
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


?>