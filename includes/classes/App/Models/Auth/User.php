<?php

/*
 * bacePHP - Bace Framework that poweres siddeshrocks.in
 * By Siddeshwar NavinKumar
 *
 * Visit our official website
 */

class User extends Module {
      public static function login($id) {
            $cstrong = True;
            $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
            
            DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$id));
            
            setcookie(Config::get('auth')['token'], $token, time() + 60 * 60 * 24 * 7, BASEDIR, NULL, NULL, TRUE);
            setcookie(Config::get('auth')['token'] . "_", '1', time() + 60 * 60 * 24 * 3, BASEDIR, NULL, NULL, TRUE);
      }

      public static function update($params) 
      {
            $userid = self::isLoggedin();

            DB::query('UPDATE users SET username = :username, email = :email WHERE id = ' . $userid, $params);
      }

      public static function getProfile() {
            // if(self::isLoggedin()) {
                  $userid = self::isLoggedin();

                  return DB::query('SELECT * FROM users WHERE id = :id', ['id' => $userid])[0];
            // }
      }

      public static function isLoggedin() {
            if (isset($_COOKIE[Config::get('auth')['token']])) {
                  if (DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE[Config::get('auth')['token']])))) {
                        $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE[Config::get('auth')['token']])))[0]['user_id'];

                        if (isset($_COOKIE[Config::get('auth')['token'] . '_'])) {
                              return $userid;
                        } else {
                              DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE[Config::get('auth')['token']])));
                              Login::login($userid);
                        }
                  }
            }
      }

      public static function create($username, $email, $password) {
            DB::query("INSERT INTO users (username, password, email, verified) VALUES (:username, :password, :email, 0)", [':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT), ':email' => $email]);
      }

      public static function logout()
      {
            DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE[Config::get('auth')['token']])));

            setcookie(Config::get('auth')['token'], '1', time() - 3600);
            setcookie(Config::get('auth')['token'] . '_', '1', time() - 3600);
      }
}

?>