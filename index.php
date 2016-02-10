<?php
error_reporting(E_ALL);

use Phalcon\Loader;
use Phalcon\Mvc\Micro;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Postgresql as PdoPg;


try {
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

// Retrieves all robots
	$app->get('/api/robots', function () use ($app) {

		$phql = "
		SELECT * 
		FROM Robots 
		ORDER BY name";

		$robots = $app->modelsManager->executeQuery($phql);

		$data = array();
		foreach ($robots as $robot) {
			$data[] = array(
				'id'   => $robot->id,
				'name' => $robot->name
				);
		}

		echo json_encode($data);
	});

/*
// Searches for robots with $name in their name
	$app->get('/api/robots/search/{name}', function ($name) {

	});

// Retrieves robots based on primary key
	$app->get('/api/robots/{id:[0-9]+}', function ($id) {

	});

// Adds a new robot
	$app->post('/api/robots', function () {

	});

// Updates robots based on primary key
	$app->put('/api/robots/{id:[0-9]+}', function () {

	});

// Deletes robots based on primary key
	$app->delete('/api/robots/{id:[0-9]+}', function () {

	});*/

$app->handle();

} catch (Exception $e){
	echo $e->getMessage() . '<br>';
	echo '<pre>' . $e->getTraceAsString() . '</pre>';
}