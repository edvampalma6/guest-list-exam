<?php
require 'vendor/autoload.php';
require 'dataBase/ConnectionFactor.php';
require 'GuestS/guestService.php';
$app = new \Slim\Slim();
$app->get('/guests', function() use ($app) 
{
    $guests = guestService::listGuests();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($guests);
});
