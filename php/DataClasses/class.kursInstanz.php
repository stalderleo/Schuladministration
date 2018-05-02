<?php

class kursInstanz {
    private $lehrer = null;
    private $klasse = null;
    private $kurs = null;
    
    public function __construct(lehrer $lehrer, klasse $klasse, kurs $kurs = null) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        basic::assertInstanceOf($klasse, klasse, true);
        basic::assertInstanceOf($kurs, kurs, false);
        $this->lehrer = $lehrer;
        $this->klasse = $klasse;
        $this->kurs = $kurs;
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
