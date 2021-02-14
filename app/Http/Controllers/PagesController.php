<?php namespace App\Http\Controllers;

use App\Http\Router;
use App\Models\Product;

class PagesController{

    /**
     * Serves the home page
     */
    public function index(Router $router)
    {
        $product = new Product;

        $router->render("pages/index", [
            'products' => $product->findAll(4)
        ]);
    }

    /**
     * Renders the about page
     */
    public function about(Router $router)
    {
        $router->render("pages/about");
    }

    /**
     * Renders the contact page
     */
    public function contact(Router $router)
    {
        $router->render("pages/contact");
    }
    
}