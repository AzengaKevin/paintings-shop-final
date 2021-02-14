<?php namespace App\Http\Controllers\Auth;

use App\Http\Router;
use App\Models\User;

class RegisterController{

    public function show(Router $router)
    {
        if(isLoggedIn()) header('Location: /');

        $router->render("auth/register");
    }

    public function store()
    {
        if(isLoggedIn()) header('Location: /');
        
        $input = array();
        $errors = array();

        $input['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $input['username'] = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $input['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
        $input['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $input['confirm_password'] = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

        $_SESSION['input'] = $input;

        foreach ($input as $key => $value) {
            if(empty($value)){

                if($key === 'confirm_password'){

                    if(empty($errors['password']))
                        $errors['password'] = 'Password confirmation is required';
                }else{

                    $errors[$key] = ucfirst($key) . ' is required';

                }
            }           
        }

        
        //Check whether password match
        if($input['password'] !== $input['confirm_password']){

            if(!isset($errors['password'])) $errors['password'] = 'Passwords do not match';
            
        }
        
        //Check email format
        if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
            
            if(!isset($errors['email'])) $errors['email'] = 'Invalid email format';

        }

        if(empty($errors)){

            $user = new User;

            $maybeUser = $user->findByEmail($input['email']);
                    
            if($maybeUser){
                
                $errors['email'] = 'Email already taken';

                $_SESSION['errors'] = $errors;

                header('Location: /register');

            }else{

                $createdUser = $user->create($input);
            
                $_SESSION['user'] = (array) $createdUser;
                $_SESSION['message']['content'] = 'You have successfully created account and logged in';
                $_SESSION['message']['type'] = 'success';

                header('Location: /');

            }

        }else{

            $_SESSION['errors'] = $errors;

            header('Location: /register');

        }
        
    }
}