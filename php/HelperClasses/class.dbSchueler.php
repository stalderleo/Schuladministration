<?php

class dbSchueler extends db {
    
    /**
     * Serializes DB Data to a 'schueler' object.
     * @param type $row - Data from DB (single row)
     * @return \schueler - returns object from type schueler
     */
    public function newObjSchueler($row) {
        return new schueler($row->pid, $row->username, $row->password, $row->name, $row->vorname, $row->geburtstag, $row->geschlecht, $row->kuerzel, $row->mail, $row->status);
    }
    
    /**
     * Fills data of an object into an array (used for prepared statements)
     * @param type $schueler - object from type schueler
     * @return type - returns array
     */
    public function objToArray(schueler $schueler, $pidLast) {
        basic::assertInstanceOf($schueler, schueler);
        if (!$pidLast) {
            return array($schueler->getPid(), $schueler->getUsername(), $schueler->getPassword(), $schueler->getName(), 
                $schueler->getVorname(), $schueler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
                $schueler->getStatus());
        }
        else {
            return array($schueler->getUsername(), $schueler->getPassword(), $schueler->getName(), 
                $schueler->getVorname(), $schueler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
                $schueler->getStatus(), $schueler->getPid());
        }
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    public function getIdfromDBorObj(person $obj) {
        basic::assertInstanceOf($obj, person);
        if ($obj->getPid() == null or $obj->getPid() == 0) {
            return $this->lastId();
        }
        else {
            return $obj->getPid(); 
        }
    }
    
    public function selectAllSchueler() {
        $liste = array();
        $result = $this->select( "SELECT * FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid "
                . "order by pid");
        if (count($result)) {
            foreach ($result as $row ) {
                array_push($liste, $this->newObjSchueler($row));
            }
        }
        return $liste;
    }
    
    public function selectSchueler($sid) {
        $schueler = null;
        $sql = "SELECT * FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid "
                . "WHERE schueler.sid = ?";
        $params = array($sid);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $schueler = $this->newObjSchueler($row);
        }
        return $schueler;
    }
    
    public function checkUser($username, $password) {
        $schueler = null;
        $sql = "SELECT *  FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid "
                . "WHERE person.username = ? "
                . "AND person.password = ?";
        $params = array($username, $password);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $schueler = $this->newObjSchueler($row);
        }
        return $schueler;
    }
    
    public function modifySchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        $this->preparedStatementQuery($sql, $this->objToArray($schueler, true));
    }
    
    public function insertSchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql2 = "INSERT INTO schueler (sid) VALUES (?)";
        
        $this->startTransaction();
        try {
            $this->preparedStatementQuery($sql, $this->objToArray($schueler, false));       // Insert Data into table person
            $this->preparedStatementQuery($sql2, array($this->getIdfromDBorObj($schueler)));   // Create entry on table schueler linked by foreign key
            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Erstellen eines Schuelers: ' . $ex->getMessage());
        }    
    }
    
    public function deleteSchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "DELETE FROM person WHERE person.pid = ?";
        
        if ($schueler->getPid() != null or $schueler->getPid() != 0) {
            $params = array($schueler->getPid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
