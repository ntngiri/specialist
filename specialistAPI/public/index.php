<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
date_default_timezone_set("Asia/Bangkok");

require_once($_SERVER["DOCUMENT_ROOT"].'/specialistAPI/vendor/autoload.php');

spl_autoload_register(function ($classname) {
  require_once($_SERVER["DOCUMENT_ROOT"]."/specialistAPI/src/classes/" . $classname . ".php");
});

require __DIR__ . '/config.php';
require_once($_SERVER["DOCUMENT_ROOT"].'/specialistAPI/src/settings.php');

$app = new \Slim\App($config);
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");
    return $response;
});
require_once($_SERVER["DOCUMENT_ROOT"].'/specialistAPI/src/routes.php');
$app->run();