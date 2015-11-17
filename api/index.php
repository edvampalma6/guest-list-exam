<?php
require 'vendor/autoload.php';
require 'dataBase/ConnectionFactor.php';
require 'GuestS/guestService.php';
$app = new \Slim\Slim();

//get method
$app->get('/guests', function() use ($app) 
{
    $guests = guestService::listGuests();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($guests);
});

//post method
$app->post('/guests', function() use ($app)
{
    $guestJson = $app->request()->getBody();
    $newGuest = json_decode($guestJson, true);
    if($newGuest) 
    {
        $guest = guestService::add($newGuest);
        $result = array('name'=>'This is a test','email'=>'test@gmail.com','id'=>'1');
        
        $app->response()->header('Content-Type','application/json');
        echo json_encode($result);
    }
    else 
    {
        $app->response->setStatus(400);
        echo "Not possible save :(";
    }
});

//delete method
$app->delete('/guests/:id', function($id) use ($app)
{
    $app->response()->header('Content-Type','application/json');
    $result;
    
    if(guestService::delete($id)) 
    {
      $result = array('status'=>'true','message'=>'Guest deleted!');
    }
    else
    {
      $app->response->setStatus('404');
      $result = array('status'=>'false','message'=>'Guest with ' .$id .' does not exit');
    }
    
    echo json_encode($result);
});
$app->run();
?>