<?php

class Signin extends Controller
{
      public $errorHandler;

      public function render()
      {
            View::make('Accounts/Signin');
      }

      public function getErrorHandler()
      {
            return $this->errorHandler;
      }

      public function action()
      {
            // Error Handler
            $this->errorHandler = new ErrorHandler;

            // Validator
            $validator = new Validator($this->errorHandler);

            // Checks 
            $validator->check([
                  'Email' => $_POST['txtmail'],
                  'Password' => $_POST['txtpwd']
            ], [
                  'Email' => [
                        'required' => true,
                        'ununique' => [
                              'table' => 'users',
                              'col' => 'email'
                        ]
                  ],
                  'Password' => [
                        'required' => true
                  ]
            ]);

            if(!$this->errorHandler->hasErrors()) {
                  $email = $_POST['txtmail'];
                  $password = $_POST['txtpwd'];

                  $user = DB::query('SELECT * FROM users WHERE email = :email', [':email' => $email])[0];

                  $hash_password = $user['password'];
                  $id = $user['id'];

                  if(password_verify($password, $hash_password)) {
                        User::login($id);

                        echo "<script>alert('Loggedin Successfully!');</script>";

                        Redirect('');
                  } else {
                        echo "<script>alert('Invalid password');</script>";

                        Redirect('user/sign-in');
                  }
            }
      }
}

?>