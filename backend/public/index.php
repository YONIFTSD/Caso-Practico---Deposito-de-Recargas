<?php
// header('Access-Control-Allow-Origin: *'); 
// header("Access-Control-Allow-Credentials: true");
// header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

// header('Access-Control-Max-Age: 1000');
// header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| First we need to get an application instance. This creates an instance
| of the application / container and bootstraps the application so it
| is ready to receive HTTP / Console requests from the environment.
|
*/

$app = require __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->run();
