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
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

$container['db'] = function ($c) {
    return new PDO('mysql:host=' . getenv('DATABASE_SERVER') . ';port=' .getenv('DATABASE_PORT') . ';dbname=' . getenv('DATABASE_NAME'),
        getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'));
};

