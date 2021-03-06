<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
date_default_timezone_set("Asia/Bangkok");

require __DIR__ . '/../vendor/autoload.php';
spl_autoload_register(function ($classname) {
    require __DIR__ . "/../src/classes/" . $classname . ".php";
});
require __DIR__ . '/config.php';
require __DIR__ . '/../src/settings.php';
require __DIR__ . '/../src/App/Mail/Mailer.php';
require __DIR__ . '/../src/App/Mail/Message.php';

$app = new \Slim\App($config);
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
require __DIR__ . '/../src/routes.php';
$app->run();