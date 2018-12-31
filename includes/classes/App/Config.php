<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class Config extends Module {
      public static function get($name) {
            global $config;
            
            return (isset($config[$name]) ? $config[$name] : 0);
      }
}

?>