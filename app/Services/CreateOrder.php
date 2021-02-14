<?php namespace App\Services;

use App\Models\Project;
use App\Transactions\Paypal\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class CreateOrder
{
    
    public static function createOrder($order, $debug = false)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = self::buildRequestBody($order);

        $client = PayPalClient::client();

        $response = $client->execute($request);

        if ($debug)
        {
            dd($response);
        }

        return $response;
    }  

    private static function buildRequestBody($order)
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
                array(
                    'return_url' => \BASE_URL . "/checkout/show?order_id=" . $order->id,
                    'cancel_url' => \BASE_URL . "/checkout/create?order_id=" . $order->id,
                    'brand_name' => \APP_NAME,
                    'locale' => 'en-US',
                    'landing_page' => 'BILLING',
                    'shipping_preferences' => 'SET_PROVIDED_ADDRESS',
                    'user_action' => 'PAY_NOW',
                ),
            'purchase_units' =>
                array(
                    0 =>
                        array(
                            'amount' =>
                                array(
                                    'currency_code' => 'USD',
                                    'value' => $order->amount
                                )
                        )
                )
        );
    }
}
