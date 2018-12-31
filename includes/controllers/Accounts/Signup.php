<?php

class Signup extends Controller
{
      public $errorHandler;

      public function render()
      {
            View::make('Accounts/Signup');
      }

      public function getErrorHandler()
      {
            return $this->errorHandler;
      }

      public function action()
      {
            // ErrorHandler
            $this->errorHandler = new ErrorHandler;

            // Validator
            $validator = new Validator($this->errorHandler);

            // Checks 
            $validator->check([
                  'Username' => $_POST['txtname'],
                  'Email' => $_POST['txtmail'],
                  'Password' => $_POST['txtpwd'],
                  'Confirm Password' => $_POST['txtpwd2']
            ], [
                  'Username' => [
                        'required' => true,
                        'maxlength' => 21,
                        'minlength' => 3,
                        'alnum' => true,
                        'unique' => [
                              'table' => 'users',
                              'col' => 'username'
                        ]
                  ],
                  'Email' => [
                        'required' => true,
                        'email' => true,
                        'unique' => [
                              'table' => 'users',
                              'col' => 'email'
                        ]
                  ],
                  'Password' => [
                        'required' => true,
                        'maxlength' => 60,
                        'minlength' => 3
                  ],
                  'Confirm Password' => [
                        'match' => 'Password'
                  ]
            ]);


            if(!$this->errorHandler->hasErrors()) {
                  $username = $_POST['txtname'];
                  $email = $_POST['txtmail'];
                  $password = $_POST['txtpwd'];

                  User::create($username, $email, $password);

                  echo "<script>alert('Account Created now Sing in!');</script>";

                  Redirect('user/sign-in');
            }
      }
}



?>