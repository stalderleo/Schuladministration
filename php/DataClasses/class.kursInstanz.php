<?php

class kursInstanz {
    private $lehrer = null;
    private $klasse = null;
    private $kurs = null;
    
    // Um Zwischentabelle zu modifizieren --> final Werte im Konstruktor schreiben
    private $old_lid = 0;
    private $old_kid = 0;
    private $old_fid = 0;
    
    public function __construct(lehrer $lehrer, klasse $klasse, kurs $kurs) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        basic::assertInstanceOf($klasse, klasse, true);
        basic::assertInstanceOf($kurs, kurs, true);
        $this->lehrer = $lehrer;
        $this->klasse = $klasse;
        $this->kurs = $kurs;
        
        $this->old_lid = $this->lehrer->getPid();
        $this->old_kid = $this->klasse->getKid();
        $this->old_fid = $this->kurs->getFid();
    }
    
    public function __constructOI(lehrer $lehrer, klasse $klasse) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        basic::assertInstanceOf($klasse, klasse, true);
        $this->lehrer = $lehrer;
        $this->klasse = $klasse;
        $this->kurs = $this;
        
        $this->old_lid = $this->lehrer->getPid();
        $this->old_kid = $this->klasse->getKid();
    }
    
    function getOldKeys() {
        return array($this->old_lid, $this->old_kid, $this->old_fid);
    }
    
    function getLehrer() {
        return $this->lehrer;
    }

    function getKlasse() {
        return $this->klasse;
    }

    function getKurs() {
        return $this->kurs;
    }

    function setLehrer($lehrer) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        $this->lehrer = $lehrer;
    }

    function setKlasse($klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $this->klasse = $klasse;
    }

    function setKurs($kurs) {
        basic::assertInstanceOf($kurs, kurs, true);
        $this->kurs = $kurs;
    }

    
}
