<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class
 *
 * @author aaron.studer
 */
class login implements subcontroller {
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    private $username;
    private $password;
    private $login;
    
    public function __construct($template_path) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
    }

    public function getOutput() {
        $v =& $this;
        include($this->template_path."/"."login.htm.php");
    }

    public function run() {
        if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
            $this->username = htmlspecialchars($_REQUEST['username']);
            $this->username = htmlspecialchars($_REQUEST['password']);
        }
    }

}
