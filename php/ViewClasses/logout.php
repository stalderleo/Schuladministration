<?php

/**
 * Klasse für die Logout Funktion
 * 
 * @autor Aaron Studer
 * @date 23. May 2018
 */
require_once("interface.subcontroller.php");

class logout implements subcontroller {
    //put your code here
    private $template_path;
    public $title;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Schüler";
    }

    public function run() {
    }
    
    public function getOutput(){
        session_destroy();
        include($this->template_path."/logout.htm.php");
    }
}
