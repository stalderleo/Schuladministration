<?php

class klassenBesuch {
    
    private $schueler;
    private $klasse;
    private $isZweitausbildung;
    
    public function __construct(schueler $schueler, klasse $klasse, $isZweitausbildung) {
        basic::assertInstanceOf($schueler, schueler, true);
        basic::assertInstanceOf($klasse, klasse, true);
        $this->schueler = $schueler;
        $this->klasse = $klasse; 
        $this->isZweitausbildung = $isZweitausbildung;
    }
    
    function getSchueler() {
        return $this->schueler;
    }

    function getKlasse() {
        return $this->klasse;
    }

    function getIsZweitausbildung() {
        return $this->isZweitausbildung;
    }

    function setSchueler($schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $this->schueler = $schueler;
    }

    function setKlasse($klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $this->klasse = $klasse;
    }

    function setIsZweitausbildung($isZweitausbildung) {
        $this->isZweitausbildung = $isZweitausbildung;
    }


}
