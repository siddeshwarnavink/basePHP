<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

$path = NULL;

function __autoload($class_name)
{     
      global $path;
      search_and_require('./includes/classes/', $class_name . ".php");
}

function search_and_require($dir, $file_to_search)
{

      global $path;

      $files = scandir($dir);

      foreach($files as $key => $value){

            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);

            if(!is_dir($path)) {
                  if($file_to_search == $value) {
                        $slice_key = 0;

                        $dir_arr = explode("\\", $dir);

                        foreach ($dir_arr as $key => $value) {
                              if($value == "includes") {
                                    $slice_key = $key;
                                    break;
                              }
                        }

                        $path_arr = explode("\\", $path);

                        $path = "./" . implode("/", array_slice($path_arr, $slice_key));

                        require_once($path);
                  }

            } else if($value != "." && $value != "..") {
                  search_and_require($path, $file_to_search);
            }  
      } 
}

// $route = new Route();

?>