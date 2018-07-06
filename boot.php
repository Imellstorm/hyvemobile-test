<?php

require_once __DIR__ . '/vendor/autoload.php';

if (!ini_get("auto_detect_line_endings")) {
	ini_set("auto_detect_line_endings", '1');
}

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
	'driver'    => 'mysql',
	'host'      => 'localhost',
	'database'  => 'testDB',
	'username'  => 'root',
	'password'  => '',
	'charset'   => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'prefix'    => '',
]);

$capsule->setAsGlobal();
