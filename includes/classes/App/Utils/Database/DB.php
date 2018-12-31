<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class DB extends Module {
      private static function connect() {
            $pdo = new PDO(Config::get('db')['driver'] .':host='. Config::get('db')['host'] .';dbname='. Config::get('db')['database'] .';charset='. Config::get('db')['charset'], Config::get('db')['username'], Config::get('db')['password']);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
      }

      public static function query($query, $params = []) {
            $statement = self::connect()->prepare($query);
            $statement->execute($params);
            if (strtoupper(explode(' ', $query)[0]) == 'SELECT')
                  return $statement->fetchAll();
      }
}

?>