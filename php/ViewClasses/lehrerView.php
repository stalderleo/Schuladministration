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

class lehrerView implements subcontroller {
    //put your code here
    private $template_path;
    public $title;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Lehrer";
    }
    public function getKontaktListe(){
        //a person object should be returned here
    }
    public function run() {
    }
    
    public function getOutput(){
        include($this->template_path."/liste/liste-lehrer.htm.php");
    }
}
