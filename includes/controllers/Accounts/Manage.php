<?php

class Manage extends Controller
{
	public $errorHandler;

	public function render()
	{
        View::make('Accounts/Manage');
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

        $validator->check([
                  'Username' => $_POST['txtname'],
                  'Email' => $_POST['txtmail'],
            ], [
                  'Username' => [
                        'required' => true,
                        'maxlength' => 21,
                        'minlength' => 3,
                        'alnum' => true,
                        'unique' => [
                              'table' => 'users',
                              'col' => 'username',
                              'except' => [$_POST['txtname']]
                        ]
                  ],
                  'Email' => [
                        'required' => true,
                        'email' => true,
                        'unique' => [
                              'table' => 'users',
                              'col' => 'email',
                              'except' => [$_POST['txtmail']]
                        ]
                  ],
            ]);

        if(!$this->errorHandler->hasErrors()) {
        	$username = $_POST['txtname'];
            $email = $_POST['txtmail'];

            User::update([':email' => $email, ':username' => $username]);

            echo "<script>alert('Profile updated!');</script>";

            Redirect('user/manage');
        }
    }
}