<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Product;

class ProductsController{

    
    public function index(Router $router)
    {
        $product = new Product;

        $page = isset($_GET['p']) && is_numeric($_GET['p']) ? intval($_GET['p']) : 1;
        $needle = $_GET['s'] ?? null;

        $router->render("products/index", [
            'products' => $product->findAll(),
            'totalProducts' => $product->count(),
            'pageItems' => 8,
            'page' => $page,
            'needle' => $needle
        ]);
    }

    public function create(Router $router)
    {
        $router->render("products/create");
    }
    
    public function store()
    {
        
        $errors = array();
        $input = array();

        $input['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $input['description'] = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
        $input['price'] = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);
        $input['quantity'] = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);
        $input['image'] = $_FILES['image'];

        foreach ($input as $key => $value) {
            if(empty($value)){
                $errors[$key] = ucfirst($key) . ' is required';
            }           
        }

        //Check whether the file successfully uploaded
        if(is_uploaded_file($input['image']['tmp_name'])){

            //Create the uploads directory if abscent
            if(!is_dir(\UPLOADS_DIRECTORY)) mkdir(\UPLOADS_DIRECTORY);

            //Random filename
            $filename = randomString();

            //Get the extension
            $extension = pathinfo($input['image']['name'],PATHINFO_EXTENSION);

            $filename .= '.' . $extension;

            //Uploading the file
            move_uploaded_file($input['image']['tmp_name'], \UPLOADS_DIRECTORY . '/' . $filename);

        }else{

            switch ($input['image']['error']) {

                case 0:
                    $errors['image'] = 'Error with the file you tried to upload, try again later';
                    break;
                case 1:
                    $errors['image'] = 'The file you are trying to upload is too big, change upload_max_filesize in your settings';
                    break;
                case 2:
                    $errors['image'] = 'The file you are trying to upload is too big, change MAX_FILE_SIZE  in your settings';
                    break;
                case 3:
                    $errors['image'] = 'The file you are trying to upload was only partially uploaded, try again later';
                    break;
                case 4:
                    $errors['image'] = 'Your must select an image file to upload';
                    break;
                
                default:
                    $errors['image'] = 'There was a problem with your upload.';
                break;
            }
        }  
        
        unset($input['image']);

        $_SESSION['input'] = $input;

        $_SESSION['errors'] = $errors;

        if(empty($errors)){

            $input['img'] = $filename;

            $product = new Product;

            if($product->create($input)){

                $_SESSION['message']['content'] = 'Product Added Successfully';
                $_SESSION['message']['type'] = 'success';

                header('Location: /products');
    
            }else{
    
                $_SESSION['message']['content'] = 'A fatal error occured';
                $_SESSION['message']['type'] = 'danger';

                header('Location: /products/create');
            }

        }else{

            header('Location: /products/create');
        }
        
    }

    public function show(Router $router)
    {
        $product = new Product;

        $productId = $_GET['id'] ?? null;

        $router->render("products/show", [
            'product' => $product->find($productId)
        ]);
    }

    public function edit()
    {
        echo "Edit Page";
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }
}