<?php


require_once("interface.subcontroller.php");

/**
 * Klasse für das Login der Web App, dabei werden
 * verschiedene Parameter gesetzt, die verfizieren was deine
 * Rolle ist.
 * 
 * @autor Aaron Studer
 * @date 23. May 2018
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
            
            if($schuler != -1 || $lehrer != -1)
            {
                if( $schuler != -1 ) $_SESSION["role"] = "benutzer";                
                if( $lehrer != -1 ) $_SESSION["role"] = "admin";
                
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
            
            if($schuler != -1 || $lehrer != -1)
            {
                if( $schuler != -1 ) $_SESSION["role"] = "Benutzer";
                if( $lehrer != -1 ) $_SESSION["role"] = "Admin";
                
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
