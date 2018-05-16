<?php

class passwordHandler {
    private $username = "";
    private $salt = "";
    
    public function __construct($username) {
        $this->username = $username;
        $this->generateSalt();
    }
    
    private function generateSalt() {
        $this->salt = base64_encode($username . "____10071998");
    }
    
    /**
    * Funktion hashed ein passwort
    * @param type $pw das pw das gehashed werden soll
    * @param type $salt der salt
    * @return type das gehashed passwort
    */
    function hashPW($pw) {
       return password_hash($pw . $this->salt, PASSWORD_BCRYPT);
    }


    /**
    * Funktion checkt ob ein Passwort korrekt ist
    * @param type $username        Der Username von dem Vermieter der sich einloggen möchte
    * @param type $userpassword    Das Passwort des Users der sich einloggen möchte
    * @return boolean              Wenn die Anmeldedaten korrekt wird true returnt sonst false
    */
    function isPWCorrect($pw, $dbpw) {
        if (password_verify($pw.$this->salt, $dbpw)) {
            return true;
        }
        return false;
    }
}
