<?php

class dbAngestellter extends db {
    
    /**
     * Serializes DB Data to a object from type angestellter.
     * @param type $row - Data from DB (single row)
     * @return \schueler - returns object from type angestellter
     */
    private function newObjAngestellte($row) {
        return new angestellter($row->pid, $row->username, $row->password, $row->name, $row->vorname, $row->geburtstag, $row->geschlecht, $row->kuerzel, $row->mail, $row->status);
    }
    
    /**
     * Fills data of an object into an array (used for prepared statements)
     * @param type $lehrer - object from type angestellter
     * @return type - returns array
     */
    private function objToArray(angestellter $angestellter, $pidLast) {
        basic::assertInstanceOf($angestellter, angestellter, true);
        if (!$pidLast) {
            return array($angestellter->getPid(), $angestellter->getUsername(), $angestellter->getPassword(), $angestellter->getName(), 
                $angestellter->getVorname(), $angestellter->getGeburtstag(), $angestellter->getGeschlecht(), $angestellter->getKuerzel(), $angestellter->getMail(),
                $angestellter->getStatus());
        }
        else {
            return array($angestellter->getUsername(), $angestellter->getPassword(), $angestellter->getName(), 
                $angestellter->getVorname(), $angestellter->getGeburtstag(), $angestellter->getGeschlecht(), $angestellter->getKuerzel(), $angestellter->getMail(),
                $angestellter->getStatus(), $angestellter->getPid());
        }
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    private function getIdfromDBorObj(person $obj) {
        basic::assertInstanceOf($obj, person, true);
        if ($obj->getPid() == null or $obj->getPid() == 0) {
            return $this->lastId();
        }
        else {
            return $obj->getPid(); 
        }
    }
    
    public function selectAllAngestellte() {
        $liste = array();
        $result = $this->select( "SELECT * FROM angestellte "
                . "LEFT JOIN person ON angestellte.aid = person.pid "
                . "order by pid");
        if (count($result)) {
            foreach ($result as $row ) {
                array_push($liste, $this->newObjAngestellte($row));
            }
        }
        return $liste;
    }
    
    public function selectAngestellte($aid) {
        $angestellte = null;
        $sql = "SELECT * FROM angestellte "
                . "LEFT JOIN person ON angestellte.aid = person.pid "
                . "WHERE angestellte.aid = ?";
        $params = array($aid);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $angestellte = $this->newObjAngestellte($row);
        }
        return $angestellte;
    }
    
    public function checkUser($username, $password) {
        $angestellte = null;
        $sql = "SELECT * FROM angestellte "
                . "LEFT JOIN person ON angestellte.aid = person.pid "
                . "WHERE person.username = ? "
                . "AND person.password = ?";
        $params = array($username, $password);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $angestellte = $this->newObjAngestellte($row);
        }
        return $lehrer;
    }
    
    public function modifyAngestellter(angestellter $angestellte) {
        basic::assertInstanceOf($angestellte, angestellter, true);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        $this->preparedStatementQuery($sql, $this->objToArray($angestellte, true));
    }
    
    public function insertAngestellter(angestellter $angestellte) {
        basic::assertInstanceOf($angestellte, angestellter, true);
        $sql = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql2 = "INSERT INTO angestellte (aid) VALUES (?)";
        
        $this->startTransaction();
        try {
            $this->preparedStatementQuery($sql, $this->objToArray($angestellte, false));       // Insert Data into table person
            $this->preparedStatementQuery($sql2, array($this->getIdfromDBorObj($angestellte)));   // Create entry on table schueler linked by foreign key
            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Erstellen eines Angestellten: ' . $ex->getMessage());
        }    
    }
    
    public function deleteAngestellter(angestellter $angestellte) {
        basic::assertInstanceOf($angestellte, angestellter, true);
        $sql = "DELETE FROM person WHERE person.pid = ?";
        
        if ($angestellte->getPid() != null or $angestellte->getPid() != 0) {
            $params = array($angestellte->getPid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
