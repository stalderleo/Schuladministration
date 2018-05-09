<?php

class dbKursInstanz extends db {
    
    private $dbLehrer = null;
    private $dbKlasse = null;
    private $dbKurs = null;
    
    public function __construct() {
        parent::__construct();
        $this->dbLehrer = new dbLehrperson();
        $this->dbKlasse = new dbKlasse();
        $this->dbKurs = new dbKurs();
    }

    private function newObjKursInstanz($lehrer, $klasse, $kurs) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        basic::assertInstanceOf($klasse, klasse, true);
        basic::assertInstanceOf($kurs, kurs, false);
        return new kursInstanz($lehrer, $klasse, $kurs);
    }
    
    private function objToArray($kursInstanz) {
        basic::assertInstanceOf($kursInstanz, kursInstanz, true);
        return array($kursInstanz->getLehrer()->getPid(), $kursInstanz->getKlasse()->getKid(), $kursInstanz->getKurs()->getFid());
    }
    
    public function resultToArray($result) {
        $liste = array();
        if (count($result)) {
            foreach ($result as $row ) {
                $lehrer = $this->dbLehrer->selectLehrer($row->lid);
                $klasse = $this->dbKlasse->selectKlasse($row->kid);
                $kurs = $this->dbKurs->selectKurs($row->fid);
                array_push($liste, $this->newObjKursInstanz($lehrer, $klasse, $kurs));
            }
        }
        return $liste;
    }
    
    public function selectAllKursInstanzen() {
        $sql = "SELECT * FROM lehrperson_klasse_fach";
        $result = $this->select($sql);
        return $this->resultToArray($result);
    }
    
    public function selectInstanzenByLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        $sql = "SELECT * FROM lehrperson_klasse_fach "
                . "WHERE lid = ?";
        $result = $this->preparedStatementSelect($sql, array($lehrer->getPid()));
        return $this->resultToArray($result);
    }
    
    public function selectInstanzenByKlasse(klasse $klasse) {
        basic::assertInstanceOf($klasse, klasse, true);
        $sql = "SELECT * FROM lehrperson_klasse_fach "
                . "WHERE kid = ?";
        $result = $this->preparedStatementSelect($sql, array($klasse->getKid()));
        return $this->resultToArray($result);
    }
    
    public function selectInstanzenByKurs(kurs $kurs) {
        basic::assertInstanceOf($kurs, kurs, true);
        $sql = "SELECT * FROM lehrperson_klasse_fach "
                . "WHERE fid = ?";
        $result = $this->preparedStatementSelect($sql, array($kurs->getFid()));
        return $this->resultToArray($result);
    }
    
    public function insertInstanz(kursInstanz $kursInstanz) {
        basic::assertInstanceOf($kursInstanz, kursInstanz, true);
        $sql = "INSERT INTO `lehrperson_klasse_fach`"
                . "(`lid`, `kid`, `fid`) "
                . "VALUES (?, ?, ?)";
        $this->preparedStatementQuery($sql, $this->objToArray($kursInstanz));       // Insert Data into table KursInstanz
    }
    
    public function modifyKursInstanz(kursInstanz $kursInstanz) {
        basic::assertInstanceOf($kursInstanz, kursInstanz, true);
        $this->startTransaction();
        try {
            $this->deleteInstanz($kursInstanz);
            $this->insertInstanz($kursInstanz);
            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Modifiziern der Zwischentabelle lehrperson_klasse_fach: ' . $ex->getMessage());
        }
    }
    
    public function deleteInstanz(kursInstanz $kursInstanz) {
        basic::assertInstanceOf($kursInstanz, kursInstanz, true);
        $sql = "DELETE FROM lehrperson_klasse_fach "
                . "WHERE lid = ? AND kid = ? AND fid = ?";
        $this->preparedStatementQuery($sql, $kursInstanz->getOldKeys());
    }
}
