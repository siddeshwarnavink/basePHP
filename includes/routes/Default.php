<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

Route::set('style.css', function() {
      global $current_template;

      header("Content-type: text/css");
      require_once( './includes/template/' . $current_template . '/style.css' );
});   

?>