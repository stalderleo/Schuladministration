<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lehrerView
 *
 * @author larschristian.berg
 */
require_once("interface.subcontroller.php");
require_once("./HelperClasses/class.dbKlasse.php");

class klasseView implements subcontroller {
    //put your code here
    private $template_path;
    private $klassen = array();
    public $title;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Klasse";
    }
    public function getKontaktListe(){
        //a person object should be returned here
    }
    public function run() {
        $db = new dbKlasse();
        
        $this->klassen = $db->selectAllKlassen();
    }
    
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/liste/liste-klasse.htm.php");
    }
}
