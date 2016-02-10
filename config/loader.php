<?php
error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Postgresql as PdoPg;

// Use Loader() to autoload our model
$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/models/'
    )
)->register();

$di = new FactoryDefault();

// Set up the database service
$di->set('db', function () {
    return new PdoPg(
        array(
            "host"     => "pellefant-01.db.elephantsql.com",
            "username" => "qnqfntgv",
            "password" => "bgihhmXJiLYsupMT9uR-bTZf7M-jGaKL",
            "dbname"   => "qnqfntgv"
        )
    );
});

// Create and bind the DI to the application
$app = new Micro($di);