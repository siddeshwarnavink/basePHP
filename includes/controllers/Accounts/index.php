<?php

class Accounts extends Controller {
      function __construct($params = []) {
            $uri = (isset($params[0]) ? $params[0] : '');

            switch ($uri) {
                  case 'sign-in':
                        Controller::make('Accounts/Signin');
                        break;
                  case 'sign-up':
                        Controller::make('Accounts/Signup');
                        break;
                  case 'manage':
                        Controller::make('Accounts/Manage');
                        break;
                  case 'logout':
                        User::logout();
                        echo "<script>alert('Logout Successfully');</script>";
                        Redirect('');
                        break;
            }
      }
}

?>