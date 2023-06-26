 <!-- <!DOCTYPE html>
<html>
<head>
<title>Test site for sii.ddns.net!</title>
<style>
    body {
        width: 35em;
        margin: 0 auto;
        font-family: Tahoma, Verdana, Arial, sans-serif;
    }
</style>
</head>
<body>
<h1>Welcome to sii.ddns.net</h1>
<p>If you see this page You try https://sii.ddns.net @ rpi4_1</p>

<p>To check icln.ddns.net: 
<a href="https://icln.ddns.net/">icln.ddns.net</a>.<br/>
To check wsii.ddns.net
<a href="https://wsii.ddns.net/">wsii.ddns.net</a>.</p>

<p><em>Thank you.</em></p>  -->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__.'/../vendor/autoload.php';

use app\controllers\SiteController;
use app\controllers\AuthController;
use app\core\Application;

// echo '<pre>';
// var_dump(__DIR__);
// echo '</pre>';

$app = new Application(dirname(__DIR__));
$app->router->get('/',  [SiteController::class, 'home']);
$app->router->get('/contact',  [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login',  [AuthController::class, 'login']);
$app->router->post('/login',  [AuthController::class, 'login']);
$app->router->get('/register',  [AuthController::class, 'register']);
$app->router->post('/register',  [AuthController::class, 'register']);

$app->run();
// $app->run();
?>

<!-- </body>
</html> -->

