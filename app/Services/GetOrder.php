<?php namespace App\Services;

use App\Models\Order;
use App\Transactions\Paypal\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

class GetOrder
{
    
    public static function getOrder($orderId, $order, $debug = false)
    {
        $client = PayPalClient::client();

        $response = $client->execute(new OrdersGetRequest($orderId));

        //Track the order in system database
        $o = new Order;

        $o->update([
          'payment' => json_encode($response),
          'paypal_order_id' => $response->result->id,
          'id' => $order->id
        ]);

        if($debug){
          dd($response);
        }

        return $response;

    }
}
