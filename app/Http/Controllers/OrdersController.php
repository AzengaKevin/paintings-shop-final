<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Order;
use App\Models\Product;

class OrdersController
{
    /**
     * Display the current user orders
     */
    public function index(Router $router)
    {
        $userId = $_SESSION['user']['id'] ?? null;

        if($userId){
            $o = new Order;

            $router->render("orders/index", [
                'orders' => $o->findUserOrders($userId)
            ]);

        }else{
            
            $_SESSION['message']['content'] = 'A fatal error occured';

            $_SESSION['message']['type'] = 'danger';

            header('Location: /');

        }
    }


    /**
     * Show a single order
     */
    public function show()
    {
        
    }

    /**
     * Show order create page
     */
    public function create(Router $router)
    {

        $product = new Product;
        
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $products = array();
        $total = 0.00;

        if(!empty($cartItems)){

            $products = $product->findIn(array_keys($cartItems));

            foreach ($products as $product) {
                $total += floatval($product->price) * intval($cartItems[$product->id]);
            }

            //dd($products);
        }

        $router->render("orders/create", [
            'cartItems' => $cartItems,
            'products' => $products,
            'total' => $total
        ]);
        
    }

    /**
     * Persist an order to the database
     */
    public function store()
    {
        if(!isLoggedIn()){
            header('Location: /login');
            return;
        }

        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        $userId = $_SESSION['user']['id'];


        if (!empty($cartItems)) {

            $o = new Order;

            $order = $o->create([
                'userId' => $userId,
                'cartItems' => $cartItems
            ]);

            if($order){

                unset($_SESSION['cart']);
            
                $_SESSION['message']['content'] = 'Order Created Successfully';
    
                $_SESSION['message']['type'] = 'success';
    
                header("Location: /checkout/create?order_id=$order");

            }else{
            
                $_SESSION['message']['content'] = 'A fatal error occured';
    
                $_SESSION['message']['type'] = 'danger';
    
                header('Location: /orders/create');

            }

        }
    }

    /**
     * Update a database order
     */
    public function update()
    {
        
    }

    /**
     * Delete an order from the database
     */
    public function delete()
    {
        # code...
    }


}