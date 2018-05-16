<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once("interface.subcontroller.php");

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
    
    public $css_Classes = array("failed" => 'is-invalid', "correct" => 'is-valid');
    
    private $validation = "";
    private $username;
    private $password;
    private $login = false;
    
    public $title;
    
    public function __construct($template_path) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
        $this->title = "Log In";
        $this->username = $this->params["username"];
        $this->password = $this->params["password"];    
        
        
        if(isset( $this->params["remember_me"] )){
            $_SESSION["username"] = $this->params["username"];
            $_SESSION["password"] = $this->params["password"];
        }
    }

    public function getOutput() {
        $v =& $this;
        $this->login instanceof boolean;
        if($this->login){
            header("location: ". $_REQUEST["PHP_SELF"] . "?id=schuelerView");
        }else
        {
            include($this->template_path."/"."login.htm.php");
        }
    }

    public function run() {
        $dbschueler = new dbSchueler();
        $dblehrer = new dbLehrperson();
        
        if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
        {
            $this->username = htmlspecialchars($_REQUEST['username']);
            $this->password = htmlspecialchars($_REQUEST['password']);
            
            //Abfrage Schuler
            $schuler = $dbschueler->checkUser($this->username, $this->password);
                    
            //Abfrage Lehrer
            $lehrer = $dblehrer->checkUser($this->username, $this->password);
            
            if($schuler != null || $lehrer != null)
            {
                if( $schuler != null ) $_SESSION["role"] = "benutzer";                
                if( $lehrer != null ) $_SESSION["role"] = "admin";
                
                $_SESSION["username"] = $this->username;
                $_SESSION["password"] = $this->password;
                
                $this->login = true;
            }
            else
            {
                $this->validation = "failed";
                $this->login = false;
            }
        }
        else if (isset( $_SESSION["username"] ) && isset( $_SESSION["password"] ))
        {
            $this->username = htmlspecialchars($_SESSION['username']);
            $this->password = htmlspecialchars($_SESSION['password']);
            
            //Abfrage Schuler
            $schuler = $dbschueler->checkUser($this->username, $this->password);
                    
            //Abfrage Lehrer
            $lehrer = $dblehrer->checkUser($this->username, $this->password);
            
            if($schuler != null || $lehrer != null)
            {
                if( $schuler != null ) $_SESSION["role"] = "Benutzer";
                if( $lehrer != null ) $_SESSION["role"] = "Admin";
                
                $this->login = true;
            }
            else
            {
                $this->validation = "failed";
                $this->login = false;
            }
        }
    }

}
