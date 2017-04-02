<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    //$settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger('my_logger');
    //$logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler("../logs/app.log"));
    return $logger;
};

$container['mailer'] = function ($container) {
	$mailer = new PHPMailer;

	$mailer->Host = 'localhost';  // your email host, to test I use localhost and check emails using test mail server application (catches all  sent mails)
	$mailer->SMTPAuth = false;                 // I set false for localhost
	$mailer->SMTPSecure = '';              // set blank for localhost
	$mailer->Port = 25;                           // 25 for local host
	$mailer->Username = 'your@email.address';    // I set sender email in my mailer call
	$mailer->Password = 'yourPassword';
	$mailer->isHTML(true);

	return $mailer;
	//new \App\Mail\Mailer($container->view, $mailer);
};
// $container['db'] = function ($container) {
//     $capsule = new \Illuminate\Database\Capsule\Manager;
//     $capsule->addConnection($container['settings']['db']);

//     $capsule->setAsGlobal();
//     $capsule->bootEloquent();

//     return $capsule;
// };

// $container[App\WidgetController::class] = function ($c) {
//     $view = $c->get('view');
//     $logger = $c->get('logger');
//     $table = $c->get('db')->table('table_name');
//     return new \App\WidgetController($view, $logger, $table);
// };