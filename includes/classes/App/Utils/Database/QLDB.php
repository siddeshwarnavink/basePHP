<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar <Dr.RoX>
 *
 * Visit our official website <https://www.siddeshrocks.in>
 */

class QLDB extends Module {
      public $pdo;

      protected $table, $stmt;

      public function __construct() {
            $this->pdo = new PDO(Config::get('db')['driver'] .':host='. Config::get('db')['host'] .';dbname='. Config::get('db')['database'] .';charset='. Config::get('db')['charset'], Config::get('db')['username'], Config::get('db')['password']);
      }

      public function table($table) {
            $this->table = $table;
            return $this;
      }

      public function exists($data) {
            $field = array_keys($data)[0];

            return $this->where($field, '=', $data[$field])->count() ? true : false;
      }

      public function where($field, $operator, $value) {
            $sql = "SELECT * FROM {$this->table} WHERE {$field} {$operator} ?";
            $this->stmt = $this->pdo->prepare($sql);
            $this->stmt->execute([$value]);

            return $this;
      }

      public function count() {
            return $this->stmt->rowCount();
      }
}

?>