<?php

require 'boot.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->dropAllTables();

Capsule::schema()->create('contacts', function ($table) {
	$table->increments('id');

	$table->string('email')->unique();
	$table->string('email_ip')->nullable();

	$table->string('title')->nullable();
	$table->string('first_name');
	$table->string('last_name');

	$table->string('timezone');
	$table->string('date');
	$table->string('time');

	$table->string('image');

	$table->string('notes')->nullable();

	$table->timestamps();
});