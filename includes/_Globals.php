<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

// Up running controller`s object
$current_controller = null;

// Up running template
$current_template = 'bace';

// Routeing list
$Routes = array();

// Bace DIR
define('BASEDIR', '/basePHP/');

// Redirect function
function Redirect($url)
{
      echo '<meta http-equiv="refresh" content="0;url='. BASEDIR.$url .'" />';
}

function getError($name) {
      global $current_controller;
      if($current_controller->errorHandler != NULL)
            return '<br><span class="error">' . $current_controller->getErrorHandler()->first($name) . '</span>';
}

function getValue($name) {
      if(isset($_POST[$name]))
            return $_POST[$name];
}

?>