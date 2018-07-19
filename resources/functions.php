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
function fetch_array() {
	return mysqli_fetch_array($result);
}
// =========================================
// 
// |----------------------------------------







?>