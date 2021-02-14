<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Order;
use App\Services\GetOrder;
use App\Services\CreateOrder;
use App\Services\CaptureOrder;

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

    public function show(Router $router)
    {
        $token = $_GET['token'];
        //$payerId = $_GET['PayerID'];
        $orderId = $_GET['order_id'];

        //Capture transaction order
        CaptureOrder::captureOrder($token);

        $o = new Order;

        //Set order paid to true
        if($o->setPaid($orderId)){
            
            $_SESSION['message']['content'] = 'Thank your for shopping with us will delive your paiting within 14 days';
    
            $_SESSION['message']['type'] = 'success';

            $order = $o->find($orderId);

            $router->render("checkout/show", [
                'order' => $order
            ]);

        }
        
    }

    public function store()
    {
        
        $orderId = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_NUMBER_INT) ?? null;

        if($orderId){

            $o = new Order;

            $order = $o->find($orderId);
            
            $createOrderResponse = CreateOrder::createOrder($order);

            GetOrder::getOrder($createOrderResponse->result->id, $order);

            return header('Location: ' . $createOrderResponse->result->links[1]->href);

        }else{
            
            $_SESSION['message']['content'] = 'Create An Order First';
    
            $_SESSION['message']['type'] = 'warning';

            header("Location: /cart");
        }
        
    }

    public function update()
    {
        
    }
    
}