<?php

class klassenBesuch {
    
    private $schueler;
    private $klasse;
    private $isZweitausbildung;
    
    // Um Zwischentabelle zu modifizieren --> final Werte im Konstruktor schreiben
    private $old_sid = 0;
    private $old_kid = 0;
    
    public function __construct(schueler $schueler, klasse $klasse, $isZweitausbildung) {
        basic::assertInstanceOf($schueler, schueler, true);
        basic::assertInstanceOf($klasse, klasse, true);
        $this->schueler = $schueler;
        $this->klasse = $klasse; 
        $this->isZweitausbildung = $isZweitausbildung;
        
        $this->old_sid = $this->schueler->getPid();
        $this->old_kid = $this->klasse->getKid();
    }
    
    function getOldKeys() {
        return array($this->old_sid, $this->old_kid);
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
