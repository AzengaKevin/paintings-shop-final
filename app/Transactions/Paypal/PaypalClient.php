<?php namespace App\Transactions\Paypal;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class PayPalClient
{
    
    /**
     * 
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     * 
     * @return PayPalHttpClient instance
     * 
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use ProductionEnvironment.
     * 
     * @return SandboxEnvironment|ProductionEnvironment the current paypal environment
     */
    public static function environment()
    {
        $clientId = \PAYPAL_CLIENT_ID;
        $clientSecret = \PAYPAL_CLIENT_SECRET;

        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
