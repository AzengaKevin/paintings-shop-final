<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Product;

class CartController{


    public function show(Router $router)
    {
        $action = @$_REQUEST['action'];
        $productId = @$_REQUEST['product_id'];
        $quantity = intval(@$_REQUEST['quantity']);

        $product = new Product;

        switch ($action) {
            case 'add':

                $p = $product->find($productId);

                if(($p) && ($quantity > 0)){

                    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                        
                        if (array_key_exists("$productId", $_SESSION['cart'])) {
                            // Product exists in cart so just update the quanity
                            $_SESSION['cart']["$productId"] = $quantity;
                        } else {
                            // Product is not in cart so add it
                            $_SESSION['cart']["$productId"] = $quantity;
                        }
                    } else {
                        // There are no products in cart, this will add the first product to cart
                        $_SESSION['cart'] = array("$productId" => $quantity);
                    }

                }
                
                break;
            case 'update':

                if (isset($_REQUEST['cart'])) {

                    foreach ($_REQUEST['cart'] as $item) {

                        if (isset($_SESSION['cart']) && isset($_SESSION['cart'][$item['product_id']])) {
                            // Product exists in cart so just update the quanity
                            $_SESSION['cart'][$item['product_id']] = $item['quantity'];
                        }
                        
                    }

                }

                break;
            case 'remove':

                if (isset($_SESSION['cart']) && isset($_SESSION['cart']["$productId"])) {
                    // Remove the product from the shopping cart
                    unset($_SESSION['cart']["$productId"]);

                    header('Location: /cart');
                }
                break;
        }

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

        $router->render("cart", [
            'cartItems' => $cartItems,
            'products' => $products,
            'total' => $total
        ]);

    }
}