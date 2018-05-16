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
class klasse {
    private $kid;
    private $kuerzel;
    private $bezeichnung;
    
    function __construct($kid, $kuerzel, $bezeichnung) {
        $this->kid = $kid;
        $this->kuerzel = $kuerzel;
        $this->bezeichnung = $bezeichnung;
    }

    function getKid() {
        return $this->kid;
    }

    function getKuerzel() {
        return $this->kuerzel;
    }

    function getBezeichnung() {
        return $this->bezeichnung;
    }

    function setKid($kid) {
        $this->kid = $kid;
    }

    function setKuerzel($kuerzel) {
        $this->kuerzel = $kuerzel;
    }

    function setBezeichnung($bezeichnung) {
        $this->bezeichnung = $bezeichnung;
    }


}
