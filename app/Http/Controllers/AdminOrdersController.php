<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Order;

class AdminOrdersController{

    public function index(Router $router)
    {

        $o = new Order;

        $router->render("/admin/orders/index", [
            'orders' => $o->findAll()
        ]);

    }

    /**
     * Initiate product deleting from the database
     */
    public function delete()
    {
        $orderId = $_POST['order_id'];

        $o = new Order;

        $o->delete($orderId);
            
        $_SESSION['message']['content'] = 'Product successfully deleted from the database';

        $_SESSION['message']['type'] = 'success';

        header('Location: /admin/orders');
        
    }
}