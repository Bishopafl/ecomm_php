<?php
// redirection helper 
ob_start();
// turns on the session in the browser
session_start();

// Defines DS as the directory separator
// |------------------------------------------
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

// |========================================
// magic constants
// |------------------------------------------
// displays current directory
// echo __DIR__;
// |------------------------------------------
// displays file path
// echo __FILE__;
// |------------------------------------------

// using the magic constant directory, 
// we define the routes for front and back end directories
// |------------------------------------------
defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates/front");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . "templates/back");

// setting up the database information constants so we 
// can use them through-out our website
// |------------------------------------------
defined("DB_HOST") ? null : define("localhost");
defined("DB_USER") ? null : define("root");
defined("DB_PASS") ? null : define("");
defined("DB_NAME") ? null : define("ecomm_db");

// connection to the database
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
// functions can be available anywhere with this requirement
require_once("functions.php");



?>