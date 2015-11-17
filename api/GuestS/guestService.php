<?php
class guestService 
{
    public static function listGuests() 
    {
        $db     = ConnectionFactor::getDB();
        $guests = array();
        
        foreach($db->guests() as $guest) 
        {
             $guests[] = array (
              'id'      => $guest ['id'],       //variavel id
              'name'    => $guest ['name'],     //variavel name
              'email'   => $guest ['email']     //variavel email
           ); 
        }
        
        return $guests;
}
    
        public static function add($newGuest)  //from add method
    {
              $db = ConnectionFactor::getDB();
              $guest = $db->guests->insert($newGuest);
              return $guest;
    }
    
    
        public static function delete($id)    //from delete method
    {
              $db = ConnectionFactor::getDB();
              $guest = $db->guests[$id];
        
        if($guest)
         {
              $guest->delete();
              return true;
         }
              return false;
    }
}
?>

