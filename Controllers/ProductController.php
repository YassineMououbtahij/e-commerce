<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    // Home Products
    public function index()
    {
        $products = null;

        if (isset($this->request->params["get"]["search"])) {
            $search = $this->request->params["get"]["search"];
            $products = Product::where([["name", "LIKE", "%{$search}%"]])->limit(6)->get();
        } else {
            $products = Product::limit(6);
        }

        $this->view("products", ["products" => $products ?? []]);
    }

    // Show Product
    public function show()
    {
        $id = (int)$this->request->params["params"]["id"];
        $product = Product::find($id);
        $this->view("product", ["product" => $product]);
    }


    public function dash_index()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }

        $products = Product::all();
        $this->view("Dashboard/products", [
            "products" => $products ?? []
        ]);
    }


    public function create()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }

        $this->view("Dashboard/create");
    }


    private function getRandomCode(): string
    {
        // Create an array of all uppercase letters, lowercase letters, and numbers
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));

        // Shuffle the array to randomize the order of the characters
        shuffle($characters);

        // Take the first 20 characters from the shuffled array
        $code = array_slice($characters, 0, 20);

        // Convert the array to a string and return it
        return implode('', $code);
    }

    public function store()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }

        $errors = [];

        $values = [
            "name" => $this->request->params["post"]["name"],
            "price" => $this->request->params["post"]["price"],
            // "available" => $this->request->params["post"]["available"],
            "description" => $this->request->params["post"]["description"],
            "image" => $_FILES["image"] ?? null,
        ];

        foreach ($values as $key => $value) {
            if ($value === "" or is_null($value)) {
                $errors[$key] = "This field is required";
            }
        }

        if (empty($errors)) {
            $path = "./assets/uploaded_images/" . $this->getRandomCode() . $values["image"]["name"];

            move_uploaded_file($values["image"]["tmp_name"], $path);

            $values["image"] = $path;

            if (Product::create($values)) {
                header("LOCATION: /dashboard");
                return;
            } else {
                $errors["issue"] = "Product Not Created";
            }
        }

        $this->view("Dashboard/create", [
            "errors" => $errors,
        ]);
    }

    public function update()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }

        $id = (int)$this->request->params["params"]["id"];

        $values = [
            "name" => $this->request->params["post"]["name"],
            "price" => $this->request->params["post"]["price"],
            // "available" => $this->request->params["post"]["available"],
            "description" => $this->request->params["post"]["description"],
            "image" => $_FILES["image"] ?? null,
        ];

        foreach ($values as $key => $value) {
            if ($value === "") {
                $errors[$key] = "This field is required";
            }
        }

        if (empty($errors)) {

            $path = "./assets/uploaded_images/" . $this->getRandomCode() . $values["image"]["name"];

            move_uploaded_file($values["image"]["tmp_name"], $path);

            $values["image"] = $path;

            $product = Product::find($id);

            if ($product->image) {
                unlink($product->image);
            }

            if (Product::update($id, $values)) {
                header("LOCATION: /dashboard");
                return;
            } else {
                $errors["issue"] = "An error occured";
            }
        }

        $this->view("Dashboard/update", [
            "errors" => $errors,
            "product" =>  Product::find((int)$this->request->params["params"]["id"])
        ]);
    }


    public function edit()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }

        $id = (int)$this->request->params["params"]["id"];
        $product = Product::find($id);
        $this->view("Dashboard/update", ["product" => $product]);
    }


    public function delete()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }

        $id = (int)$this->request->params["params"]["id"];

        $product = Product::where([["id", "=", $id]])->first();

        unlink($product->image);

        Product::delete($id);

        header("LOCATION: /dashboard");
    }
}
