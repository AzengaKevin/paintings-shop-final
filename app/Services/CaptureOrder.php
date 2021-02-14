<?php namespace App\Services;

use App\Transactions\Paypal\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;

class CaptureOrder
{
    
    public static function captureOrder($orderId, $debug=false)
    {
        $request = new OrdersCaptureRequest($orderId);

        // 3. Call PayPal to capture an authorization
        $client = PayPalClient::client();

        $response = $client->execute($request);
        // 4. Save the capture ID to your database. Implement logic to save capture to your database for future reference.
        
        if ($debug)
        {
          dd($response);
        }
    
        return $response;
    }
}
