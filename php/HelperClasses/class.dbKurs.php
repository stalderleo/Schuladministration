<?php

class dbKurs extends db {
    private function newObjKurs($row) {
        return new kurs($row->kuerzel, $row->bezeichnung, $row->fid);
    }
    
    private function objToArray(kurs $kurs, $fidLast) {
        basic::assertInstanceOf($kurs, kurs, true);
        if (!$fidLast) {
            return ($kurs->getFid() == NULL) ? array($kurs->getKuerzel(), $kurs->getBezeichnung()) : array($kurs->getFid(), $kurs->getKuerzel(), $kurs->getBezeichnung());
        }
        else {
            return array($kurs->getKuerzel(), $kurs->getBezeichnung(), $kurs->getFid());
        }
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    private function getIdfromDBorObj(kurs $obj) {
        basic::assertInstanceOf($obj, kurs, true);
        if ($obj->getFid() == null or $obj->getFid() == 0) {
            return $this->lastId();
        }
        else {
            return $obj->getFid(); 
        }
    }
    
    public function selectAllKurse() {
        $liste = array();
        $sql = "SELECT * FROM kurs "
                . "ORDER BY kurs.fid";
        $result = $this->select($sql);
        if (count($result)) {
            foreach ($result as $row ) {
                array_push($liste, $this->newObjKurs($row));
            }
        }
        return $liste;
    }
    
    public function selectKurs($fid) {
        $kurs = null;
        $sql = "SELECT * FROM fach "
                . "WHERE fach.fid = ?";
        $params = array($fid);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $klasse = $this->newObjKurs($row);
        }
        return $klasse;
    }
    
    public function selectKursByKuerzel($kuerzel) {
        $kurs = null;
        $sql = "SELECT * FROM fach "
                . "WHERE fach.kuerzel = ?";
        $params = array($kuerzel);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $klasse = $this->newObjKurs($row);
        }
        return $klasse;
    }
    
    public function insertKurs(kurs $kurs) {
        $newKurs = null;
        basic::assertInstanceOf($kurs, kurs, true);
        $sql = "INSERT INTO `fach`"
                . "(`fid`, `kuerzel`, `bezeichnung`) "
                . "VALUES (?, ?, ?)";
        $this->preparedStatementQuery($sql, $this->objToArray($kurs, false));       // Insert Data into table klasse
        $newKurs = $this->selectKurs($this->getIdfromDBorObj($kurs));
        return $kurs;
    }
    
    public function insertKursAI(kurs $kurs) {
        basic::assertInstanceOf($kurs, kurs, true);
        $kursCheck = $this->selectKursByKuerzel($kurs->getKuerzel());
        
        if($kursCheck != null) return $kursCheck;
        
        $sql = "INSERT INTO `fach`"
                . "(`kuerzel`, `bezeichnung`) "
                . "VALUES (?, ?)";
        $this->preparedStatementQuery($sql, $this->objToArray($kurs, false));       // Insert Data into table klasse
    
        return $this->selectKursByKuerzel($kurs->getKuerzel());
    }
    
    public function modifyKurs(kurs $kurs) {
        basic::assertInstanceOf($klasse, klasse, true);
        $sql = "UPDATE fach "
                . "SET kuerzel = ?, bezeichnung = ? "
                . "WHERE kid = ?";
        $this->preparedStatementQuery($sql, $this->objToArray($klasse, true));
    }
    
    public function deleteKurs(kurs $kurs) {
        basic::assertInstanceOf($kurs, kurs, true);
        $sql = "DELETE FROM fach WHERE kurs.fid = ?";
        
        if ($klasse->getFid() != null or $klasse->getFid() != 0) {
            $params = array($klasse->getFid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
