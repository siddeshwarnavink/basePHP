<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class View extends Module {
      // Loads the view
      public static function make($view, $template = 'bace') {
            global $current_template;
            
            $current_template = $template;
            // Get the vew content
            $body = self::loadView( './includes/views/' . $view . '.php' );
            // Attach it to the template
            require_once( './includes/template/' . $current_template . '/index.php' );
      }

      // Load the view content
      private static function loadView($path) {
            ob_start();

            if(!is_readable($path) && $path)
                  return 0;

            require_once( $path );
            
            return ob_get_clean();
      }
}

?>