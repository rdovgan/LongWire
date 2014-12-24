<?php

class System_events {
    public function __construct() {
        Events::register('register_event', array($this, 'userRegister'));
    }
    
    public function userRegister(){
        $achId = 1;        
        if((!isset($this->achList))||(in_array($achId, $this->achList))){
            return;
        }
        return 'Cake is a lie';
    }
}
?>