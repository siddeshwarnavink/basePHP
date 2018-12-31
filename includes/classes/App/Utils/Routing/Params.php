<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class Params extends Module {
      public static function getParams() {
            // Split the URI on '/', i.e user/siddeshwar
            $uri_components = explode('/', substr($_SERVER['REQUEST_URI'], strlen(BASEDIR)-1));

            // Removing the first to array values
            $params = array_slice($uri_components, 2);
            return $params;
      }

      public static function isParam() {
            if(isset(self::getParams()[0]) && self::getParams()[0] != "") {
                  return 1;
            }

            return 0;
      }
}

?>