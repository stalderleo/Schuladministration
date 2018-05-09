<?php

class dbKlassenBesuch extends db {
    
    private $dbSchueler = null;
    private $dbKlasse = null;
    
    public function __construct() {
        parent::__construct();
        $this->dbSchueler = new dbSchueler();
        $this->dbKlasse = new dbKlasse();
    }

    private function newObjKursInstanz($schueler, $klasse, $isZweitausbildung) {
        basic::assertInstanceOf($schueler, schueler, true);
        basic::assertInstanceOf($klasse, klasse, true);
        return new klassenBesuch($schueler, $klasse, $isZweitausbildung);
    }
    
    private function objToArray($klassenBesuch) {
        basic::assertInstanceOf($klassenBesuch, klassenBesuch, true);
        return array($klassenBesuch->getSchueler()->getPid(), $klassenBesuch->getKlasse()->getKid(), $klassenBesuch->getIsZweitausbildung());
    }
    
    public function resultToArray($result) {
        $liste = array();
        if (count($result)) {
            foreach ($result as $row ) {
                $schueler = $this->dbSchueler->selectLehrer($row->lid);
                $klasse = $this->dbKlasse->selectKlasse($row->kid);
                array_push($liste, $this->newObjKursInstanz($schueler, $klasse, $row->isZweitausbildung));
            }
        }
        return $liste;
    }
    
    public function selectAllBesuche() {
        $sql = "SELECT * FROM schueler_has_klasse";
        $result = $this->select($sql);
        return $this->resultToArray($result);
    }
    
    public function selectBesucheBySchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $sql = "SELECT * FROM schueler_has_klasse "
                . "WHERE sid = ?";
        $result = $this->preparedStatementSelect($sql, array($schueler->getPid()));
        return $this->resultToArray($result);
    }
    
    public function selectBesucheByKlasse(klasse $klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $sql = "SELECT * FROM schueler_has_klasse "
                . "WHERE kid = ?";
        $result = $this->preparedStatementSelect($sql, array($klasse->getKid()));
        return $this->resultToArray($result);
    }
    
    public function insertBesuch(klassenBesuch $klassenBesuch) {
        basic::assertInstanceOf($klassenBesuch, klassenBesuch, true);
        $sql = "INSERT INTO schueler_has_klasse "
                . "(`sid`, `kid`, `isZweitausbildung`) "
                . "VALUES (?, ?, ?)";
        $this->preparedStatementQuery($sql, $this->objToArray($kursInstanz));       // Insert Data into table schueler_has_klasse
    }
    
    public function modifyKlassenBesuch(klassenBesuch $klassenBesuch) {
        basic::assertInstanceOf($klassenBesuch, klassenBesuch, true);
        $this->startTransaction();
        try {
            $this->deleteBesuch($klassenBesuch);
            $this->insertBesuch($klassenBesuch);
            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Modifiziern der Zwischentabelle schueler_has_klasse: ' . $ex->getMessage());
        }
    }
    
    public function deleteBesuch(klassenBesuch $klassenBesuch) {
        basic::assertInstanceOf($klassenBesuch, klassenBesuch, true);
        $sql = "DELETE FROM schueler_has_klasse "
                . "WHERE sid = ? AND kid = ? AND isZweitausbildung = ?";
        $this->preparedStatementQuery($sql, $klassenBesuch->getOldKeys());
    }
}
