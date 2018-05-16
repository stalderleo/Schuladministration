<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of importView
 *
 * @author larschristian.berg
 */
require_once("interface.subcontroller.php");
require_once("HelperClasses/class.dbKurs.php");

class faecherView implements subcontroller {
    //put your code here
    private $template_path;
    private $kurse;
    public $title;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Fächer";
    }

    public function run() {
        $db = new dbKurs();
        
        $this->kurse =  $db->selectAllKurse();
    }
    
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/liste/liste-kurs.htm.php");
    }
}
