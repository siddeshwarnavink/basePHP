<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class Controller {
      public function __construct() {
      }

      public static function make($name) {
            global $current_controller;
            
            // Load the controller
            if(file_exists('./includes/controllers/' . $name . '.php'))
                  require_once( './includes/controllers/' . $name . '.php' );
            else
                  require_once( './includes/controllers/' . $name . '/index.php');

            // Run the controller & parse the params

            $array = explode("/", $name);
            $name = end($array);

            if(Params::isParam())
                  $current_controller = new $name(Params::getParams());
            else
                  $current_controller = new $name();

            if(!empty(array_slice($_REQUEST, 1)))
                  $current_controller->action();

            $current_controller->render();
      }

      public function render() {
            
      }

      public function action() {
            
      }
}

?>