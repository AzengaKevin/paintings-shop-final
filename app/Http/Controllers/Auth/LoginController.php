<?php namespace App\Http\Controllers\Auth;

use App\Http\Router;
use App\Models\User;

class LoginController {

    public function show(Router $router)
    {
        if(isLoggedIn()) header('Location: /');

        $router->render("auth/login");
    }

    public function store()
    {
        if(isLoggedIn()) header('Location: /');

        $errors = array();
        $input = array();

        $input['login'] = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $input['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
        $_SESSION['input'] = $input;

        foreach ($input as $key => $value) {

            if(empty($value)){
                $errors[$key] = ucfirst($key) . ' is required';
            }           

        }

        if(empty($errors)){

            $user = new User;

            $maybeUser = $user->findByUsernameOrEmail($input);

            if($maybeUser){

                if (password_verify($input['password'], $maybeUser->password)) {
            
                    $_SESSION['user'] = (array) $maybeUser;
                    $_SESSION['message']['content'] = 'You have successfully logged in';
                    $_SESSION['message']['type'] = 'success';

                    header('Location: /');

                }else{

                    $errors['login'] = 'Invalid User Credentials';

                    $_SESSION['errors'] = $errors;
        
                    header('Location: /login');

                }

            }else{

                $errors['login'] = 'No user with such credentials';

                $_SESSION['errors'] = $errors;
    
                header('Location: /login');
            }


        }else{

            $_SESSION['errors'] = $errors;

            header('Location: /login');
        }
    }

    public function destroy()
    {
        session_destroy();
        
        header("Location: /login");
    }
}