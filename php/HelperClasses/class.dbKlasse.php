<?php

class dbKlasse extends db {
    private function newObjKlasse($row) {
        return new klasse($row->kuerzel, $row->bezeichnung, $row->kid);
    }
    
    private function objToArray(klasse $klasse, $kidLast) {
        basic::assertInstanceOf($klasse, klasse, true);
        if (!$kidLast) {
            return array($klasse->getKid(), $klasse->getKuerzel(), $klasse->getBezeichnung());
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
    
    public function selectKlasseByKuerzel($kuerzel) {
        $klasse = null;
        $sql = "SELECT * FROM klasse "
                . "WHERE klasse.kuerzel = ?";
        $params = array($kuerzel);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $klasse = $this->newObjKlasse($row);
        }
        return $klasse;
    }
    
    public function selectKlasseByBezeichnung($bezeichnung) {
        $klasse = null;
        $sql = "SELECT * FROM klasse "
                . "WHERE klasse.bezeichnung = ?";
        $params = array($bezeichnung);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $klasse = $this->newObjKlasse($row);
        }
        return $klasse;
    }
    
    public function insertKlasse(klasse $klasse) {
        $newKlasse = null;
        basic::assertInstanceOf($klasse, klasse, true);
        $sql = "INSERT INTO `klasse`"
                . "(`kid`, `kuerzel`, `bezeichnung`) "
                . "VALUES (?, ?, ?)";
        $this->preparedStatementQuery($sql, $this->objToArray($klasse, false));       // Insert Data into table klasse
        $newKlasse = $this->selectKlasse($this->getIdfromDBorObj($klasse));
        return $newKlasse;
    }
    
    public function insertKlasseAI(klasse $klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $klasseCheck = $this->selectKlasseByBezeichnung($klasse->getBezeichnung());
        
        if($klasseCheck != null) return $klasseCheck;
        
        $sql = "INSERT INTO `klasse`"
                . "(`kuerzel`, `bezeichnung`) "
                . "VALUES (?, ?)";
        $this->preparedStatementQuery($sql, array($klasse->getKuerzel(), $klasse->getBezeichnung()));       // Insert Data into table klasse
    
        $newKlasse = $this->selectKlasseByBezeichnung($klasse->getBezeichnung());
        
        return $newKlasse;
    }
    
    public function modifyKlasse(klasse $klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $sql = "UPDATE klasse "
                . "SET kuerzel = ?, bezeichnung = ? "
                . "WHERE kid = ?";
        $this->preparedStatementQuery($sql, $this->objToArray($klasse, true));
    }
    
    public function deleteKlasse(klasse $klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $sql = "DELETE FROM klasse WHERE klasse.kid = ?";
        
        if ($klasse->getKid() != null or $klasse->getKid() != 0) {
            $params = array($klasse->getKid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
