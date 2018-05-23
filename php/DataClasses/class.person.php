<?php
require_once("interface.subcontroller.php");

class person {
    private $pid;
    private $username;
    private $password;
    private $name;
    private $vorname;
    private $geburtstag;
    private $geschlecht;
    private $kuerzel;
    private $mail;
    private $status;
    
    function __construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) {
        $this->pid = $pid;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->vorname = $vorname;
        $this->geburtstag = $geburtstag;
        $this->geschlecht = $geschlecht;
        $this->kuerzel = $kuerzel;
        $this->mail = $mail;
        $this->status = $status;
    }
    
    function __constructOI($username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) {
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->vorname = $vorname;
        $this->geburtstag = $geburtstag;
        $this->geschlecht = $geschlecht;
        $this->kuerzel = $kuerzel;
        $this->mail = $mail;
        $this->status = $status;
    }

    public function getOutput() {
        
    }

    public function run() {
        
    }
    
    function getPid() {
        return $this->pid;
    }

    function getUsername() {
        return $this->username;
    }

    function getPassword() {
        return $this->password;
    }

    function getName() {
        return $this->name;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getGeburtstag() {
        return $this->geburtstag;
    }

    function getGeschlecht() {
        return $this->geschlecht;
    }

    function getKuerzel() {
        return $this->kuerzel;
    }

    function getMail() {
        return $this->mail;
    }

    function getStatus() {
        return $this->status;
    }

    function setPid($pid) {
        $this->pid = $pid;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setVorname($vorname) {
        $this->vorname = $vorname;
    }

    function setGeburtstag($geburtstag) {
        $this->geburtstag = $geburtstag;
    }

    function setGeschlecht($geschlecht) {
        $this->geschlecht = $geschlecht;
    }

    function setKuerzel($kuerzel) {
        $this->kuerzel = $kuerzel;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}

?>