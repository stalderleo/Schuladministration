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
class kurs {
    private $fid;
    private $kuerzel;
    private $bezeichnung;
    
    function __construct($kuerzel, $bezeichnung, $fid=NULL) {
        $this->fid = $fid;
        $this->kuerzel = (String) $kuerzel;
        $this->bezeichnung = (String) $bezeichnung;
    }
    
    function getFid() {
        return $this->fid;
    }

    function getKuerzel() {
        return $this->kuerzel;
    }

    function getBezeichnung() {
        return $this->bezeichnung;
    }

    function setFid($fid) {
        $this->fid = $fid;
    }

    function setKuerzel($kuerzel) {
        $this->kuerzel = $kuerzel;
    }

    function setBezeichnung($bezeichnung) {
        $this->bezeichnung = $bezeichnung;
    }



}
