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

class importView implements subcontroller {
    //put your code here
    private $template_path;
    public $title;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Import";
    }

    public function run() {
    }
    
    public function getOutput(){
        include($this->template_path."/"."import.htm.php");
    }
}
