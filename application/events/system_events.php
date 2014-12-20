<?php

class System_events {
    public function __construct() {
        Events::register('button_click', array($this, 'buttonClick'));
    }
    
    public function buttonClick(){
        log_message('debug', 'Call function "buttonClick"! Oh, finally...');
        return 'Cake is a lie';
    }
}
?>