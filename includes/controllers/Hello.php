<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class Hello extends Controller {
      var $name;

      public function __construct($params = []) {
            $this->name = (isset($params[0]) && $params[0] != "" ? $params[0] : "User");
      }

      public function render() {
            View::make('hello');
      }

      public function getName() {
            return $this->name;
      }
}


?>