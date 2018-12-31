<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class Route extends Module {
      // Check if the routes in valid
      public static function isRouteValid() {
            global $Routes;
            $uri = $_SERVER['REQUEST_URI'];

            if (!in_array(explode('?',$uri)[0], $Routes)) {
                  return 0;
            }

            return 1;
      }

      // Registers the route
      private static function registerRoute($route) {
            global $Routes;
            $Routes[] = BASEDIR.$route;
      }

      // Sets and displayes the current route
      public static function set($route, $closure) {
            self::registerRoute($route);

            if ($_SERVER['REQUEST_URI'] == BASEDIR.$route) {
                  self::run($closure);
                  return 1;
            }

            else if (explode('?', $_SERVER['REQUEST_URI'])[0] == BASEDIR.$route) {
                  self::run($closure);
                  return 1;
            }

            else if ($_GET['url'] == explode('/', $route)[0]) {
                  self::run($closure);
                  return 1;
            }
      }

      private static function run($closure) {
            if(Params::isParam()) {
                  $closure->__invoke(Params::getParams());
                  return 1;
            }
            
            $closure->__invoke();
      }
}

?>