<?php

namespace App\Controllers;

use App\Core\Controller as CoreController;
use App\Models\Product;
use App\Models\User;

class Controller extends CoreController
{
    /**
     * Represent the home page
     * 
     */
    public function index()
    {
        $products = Product::limit(3) ?? [];

        

        $this->view("index", ["products" => $products]);
    }
}
