<?php
class GuestService 
{
    public static function listGuests() 
    {
        $db     = ConnectionFactor::getDB();
        $guests = array();
        
        foreach($db->guests() as $guest) 
        {
             $guests[] = array (
              'id'      => $guest ['id'],
              'name'    => $guest ['name'],
              'email'   => $guest ['email']
           ); 
        }
        
        return $guests;
}}
    