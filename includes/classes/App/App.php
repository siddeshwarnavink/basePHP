<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class App {
      private static function _404_Listener() {
            if (!Route::isRouteValid()) {
                  http_response_code(404);

                  View::make('NotFound');
                  exit();
            }
      }

      public function run() {
            // Checks for 404 Errors
            self::_404_Listener();
      }
}

?>