<?php
     require 'vendor/autoload.php';
     require 'dataBase/ConnectionFactor.php';
     require 'GuestS/guestService.php';
     $app = new \Slim\Slim();

/*get method
HTTP GET /api/guests
RESPONSE 200 OK 
[
  {
    "id": "1",
    "name": "Lidy Segura",
    "email": "lidyber@gmail.com"
  },
  {
    "id": "2",
    "name": "Edy Segura",
    "email": "edysegura@gmail.com"
  }
]*/

     $app->get('/guests', function() use ($app) 
{
     $guests = guestService::listGuests();
     $app->response()->header('Content-Type', 'application/json');
     echo json_encode($guests);
});

/*post method
HTTP POST /api/guests
REQUEST Body 
{
	"name": "Lidy Segura",
	"email": "lidyber@gmail.com"
}

RESPONSE 200 OK 
{
  "name": "This is a test",
  "email": "test@gmail.com",
  "id": "1"
}
*/

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
        $app->response->setStatus(200);
        echo "Not possible save :(";
     }
});

/*delete method
HTTP DELETE /api/guests/:id
RESPONSE 200 OK 
{
  "status": "true",
  "message": "Guest deleted!"
}

HTTP DELETE /api/guests/x
RESPONSE 404 NOT FOUND 
{
  "status": "false",
  "message": "Guest with x does not exit"
}
*/
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