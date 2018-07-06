<?php

require '../boot.php';

$exampleClass = new \HyveMobileTest\TimeZoneClass();

header( 'Content-Type: application/json' );

echo json_encode( $exampleClass->getContacts() );