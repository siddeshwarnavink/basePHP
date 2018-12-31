<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

session_start();

// Project Configurations
require_once( './includes/_Config.php' );

// Autoloading of global Modules
require_once( './includes/_Autoload.php' );

// Global functions, modules and variables
require_once( './includes/_Globals.php' );

// List of routes
require_once( './includes/routes/Routes.php' );

// Starting the app & services
$app = new App();
$app->run();

?>