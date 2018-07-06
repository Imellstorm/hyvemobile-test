<?php

require '../boot.php';

$exampleClass = new \HyveMobileTest\ContactClass();

header( 'Content-Type: application/json' );

echo json_encode( $exampleClass->getContacts() );