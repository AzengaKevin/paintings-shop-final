<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Order;

class CheckoutController
{

    public function create(Router $router)
    {
        $orderId = $_GET['order_id'] ?? null;

        if($orderId){

            $o = new Order;

            $order = $o->find($orderId);

            $router->render("checkout/create", [
                'order' => $order
            ]);

        }else{
            
            $_SESSION['message']['content'] = 'Create An Order First';
    
            $_SESSION['message']['type'] = 'warning';

            header("Location: /cart");
        }
    }

    public function show()
    {
        
    }

    public function store()
    {
        
    }

    public function update()
    {
        
    }
    
}