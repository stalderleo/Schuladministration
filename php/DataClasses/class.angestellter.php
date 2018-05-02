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
class angestellter extends person {
    public function __construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) {
        parent::__construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status);
    }
    
    public function getOutput() {
        parent::getOutput();
    }
    
    public function run() {
        parent::run();
    }
    
    
}
