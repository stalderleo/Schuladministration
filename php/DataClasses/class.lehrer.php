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
class lehrer extends person {
    public function __construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) {
        parent::__construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status);
    }
    
    public function __constructOI($username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) {
        parent::__constructOI($username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status);
    }
    
    public function getOutput() {
        parent::getOutput();
    }
    
    public function run() {
        parent::run();
    }
    
    public function getGeburtstag() {
        return parent::getGeburtstag();
    }

    public function getGeschlecht() {
        return parent::getGeschlecht();
    }

    public function getKuerzel() {
        return parent::getKuerzel();
    }

    public function getMail() {
        return parent::getMail();
    }

    public function getName() {
        return parent::getName();
    }

    public function getPassword() {
        return parent::getPassword();
    }

    public function getPid() {
        return parent::getPid();
    }

    public function getStatus() {
        return parent::getStatus();
    }

    public function getUsername() {
        return parent::getUsername();
    }

    public function getVorname() {
        return parent::getVorname();
    }

    public function setGeburtstag($geburtstag) {
        parent::setGeburtstag($geburtstag);
    }

    public function setGeschlecht($geschlecht) {
        parent::setGeschlecht($geschlecht);
    }

    public function setKuerzel($kuerzel) {
        parent::setKuerzel($kuerzel);
    }

    public function setMail($mail) {
        parent::setMail($mail);
    }

    public function setName($name) {
        parent::setName($name);
    }

    public function setPassword($password) {
        parent::setPassword($password);
    }

    public function setPid($pid) {
        parent::setPid($pid);
    }

    public function setStatus($status) {
        parent::setStatus($status);
    }

    public function setUsername($username) {
        parent::setUsername($username);
    }

    public function setVorname($vorname) {
        parent::setVorname($vorname);
    }

}
