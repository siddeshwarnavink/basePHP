<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

require_once( 'Default.php' );

// Home Route
Route::set('', function() {
      Controller::make('home');
});

// An example of dynamic routing
Route::set('hello/', function($params = []) {
      Controller::make('Hello');
});

// Authendication System
Route::set('user/', function($params = []) {
      Controller::make('Accounts');
});


?>