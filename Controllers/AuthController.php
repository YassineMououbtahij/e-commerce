<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    // display login page
    public function login()
    {

        if (isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]) {
            header("LOCATION: /");
        }

        $this->view("Auth/login");
    }

    public function verify()
    {
        if (isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]) {
            header("LOCATION: /");
        }
        $email = $this->request->params["post"]["email"] ?? null;
        $password = $this->request->params["post"]["password"] ?? null;

        $errors = [
            "errors" => []
        ];

        if ($email && $password) {
            $user = User::where([["email", "=", $email]])->first();

            if (!is_null($user)) {
                if ($user->password === $password) {
                    $_SESSION["isAuth"] = TRUE;
                    header("LOCATION: /dashboard");
                } else {
                    $errors["errors"]["password"] = "password is not correct";
                }
            } else {
                $errors["errors"]["email"] = "Email Address not found";
            }
        } else {
            if (!$email) {
                $errors["errors"]["email"] = "Please insert email first";
            }

            if (!$password) {
                $errors["errors"]["password"] = "Please insert password first";
            }
        }

        $this->view("Auth/login", $errors);
    }

    // display register page
    public function register()
    {
        if (isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]) {
            header("LOCATION: /");
        }
        $this->view("Auth/register");
    }

    public function store()
    {
        if (isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]) {
            header("LOCATION: /");
        }

        $errors = [];
        $credentials = [
            "firstname" => $this->request->params["post"]["firstname"] ?? null,
            "lastname" => $this->request->params["post"]["lastname"] ?? null,
            "email" => $this->request->params["post"]["email"] ?? null,
            "password" => $this->request->params["post"]["password"] ?? null,
            "password_confirmation" => $this->request->params["post"]["password_confirmation"] ?? null
        ];

        foreach ($credentials as $key => $value) {
            if ($value === "" || is_null($value)) {
                $errors[$key] = "This field is required";
            }
        }

        if (!isset($errors["password"]) && $credentials["password"] !== $credentials["password_confirmation"]) {
            $errors["password"] = "Password and password confirmation does not match";
        }

        if (!empty($errors)) {
            $this->view("Auth/register", [
                "errors" => $errors
            ]);
        } else {
            var_dump($credentials);
            unset($credentials["password_confirmation"]);
            $credentials["role"] = "member";
            User::create($credentials);
            $_SESSION["isAuth"] = TRUE;
            header("LOCATION: /dashboard");
        }
    }

    public function logout()
    {
        if (!isset($_SESSION["isAuth"]) || !$_SESSION["isAuth"]) {
            header("LOCATION: /login");
        }
        unset($_SESSION["isAuth"]);

        header("LOCATION: /");
    }
}
