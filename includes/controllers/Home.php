<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class Home extends Controller {
      public function __construct() {
      }

      public function render() {
            View::make('Home');
      }
}