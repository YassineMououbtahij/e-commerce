<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div style="min-height:100vh;display:flex;flex-direction:column;">

        <nav class="navbar navbar-expand-lg bg-success ">
            <div class="container">
                <a class="navbar-brand text-light fw-bold" href="/">Eshop-Coiffure</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/products">Products</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/login">Login</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/register">Register</a>
                        </li>
                        <?php if (isset($_SESSION["isAuth"]) && $_SESSION["isAuth"]) : ?>
                            <li class="nav-item ">
                                <a class="nav-link text-light " aria-current="page" href="/logout">Logout</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <div style="flex:1;" class="container">

            <?php



            require_once "../vendor/autoload.php";

            use App\Controllers\AuthController;
            use App\Controllers\Controller;
            use App\Controllers\DashboardController;
            use App\Controllers\ProductController;
            use App\Core\Application;

            $config = [
                "ROOT_DIR" => dirname(__DIR__)
            ];

            $app = new Application($config);

            // home
            $app->get("/", [Controller::class, "index"]);
            // display products
            $app->get("/products", [ProductController::class, "index"]);
            $app->get("/products/{id}", [ProductController::class, "show"]);
            // Auth login
            $app->get("/login", [AuthController::class, "login"]);
            $app->post("/login", [AuthController::class, "verify"]);
            // Auth Logout
            $app->get("/logout", [AuthController::class, "logout"]);
            // Auth Register
            $app->get("/register", [AuthController::class, "register"]);
            $app->post("/register", [AuthController::class, "store"]);
            // DASHBOARD GET products
            $app->get("/dashboard", [ProductController::class, "dash_index"]);
            // DASHBOARD CREATE NEW PRODUCT
            $app->get("/dashboard/create", [ProductController::class, "create"]);
            $app->post("/dashboard/create", [ProductController::class, "store"]);
            // EDIT PRODUCT
            $app->get("/dashboard/{id}/edit", [ProductController::class, "edit"]);
            $app->post("/dashboard/{id}/edit", [ProductController::class, "update"]);
            // DELETE PRODUCT
            $app->post("/dashboard/{id}/delete", [ProductController::class, "delete"]);

            $app->run();

            ?>

        </div>


        <nav class="navbar navbar-expand-lg bg-success ">
            <div class="container">
                <a class="navbar-brand text-light fw-bold" href="/">Eshop-Coiffure</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarNav">
                    <ul class="navbar-nav ">
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/products">Products</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/dashboard">Dashboard</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/login">Login</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light " aria-current="page" href="/register">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>