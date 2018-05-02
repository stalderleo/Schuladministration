<?php

class dbKlasse extends db {
    private function newObjKlasse($row) {
        return new klasse($row->kid, $row->kuerzel, $row->bezeichnung);
    }
    
    private function objToArray(klasse $klasse, $kidLast) {
        basic::assertInstanceOf($klasse, klasse, true);
        if (!$kidLast) {
            
        }
        else {
            return array($klasse->getKuerzel(), $klasse->getBezeichnung(), $klasse->getKid());
        }
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    private function getIdfromDBorObj(klasse $obj) {
        basic::assertInstanceOf($obj, klasse, true);
        if ($obj->getKid() == null or $obj->getKid() == 0) {
            return $this->lastId();
        }
        else {
            return $obj->getKid(); 
        }
    }
    
    public function selectAllKlassen() {
        $liste = array();
        $sql = "SELECT * FROM klasse "
                . "ORDER BY klasse.kid";
        $result = $this->select($sql);
        if (count($result)) {
            foreach ($result as $row ) {
                array_push($liste, $this->newObjKlasse($row));
            }
        }
        return $liste;
    }
    
    public function selectKlassenFromLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        $liste = array();
        $sql = "SELECT lkf.kid FROM lehrperson_klasse_fach lkf "
                . "WHERE lkf.lid = ?";
        $params = array($lehrer->getPid());
        $result = $this->preparedStatementSelect($sql, $params);
        if (count($result)) {
            foreach ($result as $row) {
                array_push($liste, new kursInstanz($lehrer, $this->selectKlasse($row->kid), null));
            }
        }
        return $liste;
    }
    
    
    public function selectKlasse($kid) {
        $klasse = null;
        $sql = "SELECT * FROM klasse "
                . "WHERE klasse.kid = ?";
        $params = array($kid);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $klasse = $this->newObjKlasse($row);
        }
        return $klasse;
    }
    
    
}
