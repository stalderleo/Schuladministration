<?php

class dbLehrperson extends db {
    
    /**
     * Serializes DB Data to a 'lehrer' object.
     * @param type $row - Data from DB (single row)
     * @return \schueler - returns object from type lehrer
     */
    private function newObjLehrer($row) {
        return new lehrer($row->pid, $row->username, $row->password, $row->name, $row->vorname, $row->geburtstag, $row->geschlecht, $row->kuerzel, $row->mail, $row->status);
    }
    
    /**
     * Fills data of an object into an array (used for prepared statements)
     * @param type $lehrer - object from type lehrer
     * @return type - returns array
     */
    private function objToArray(lehrer $lehrer, $pidLast) {
        basic::assertInstanceOf($lehrer, lehrer);
        if (!$pidLast) {
            return array($lehrer->getPid(), $lehrer->getUsername(), $lehrer->getPassword(), $lehrer->getName(), 
                $lehrer->getVorname(), $lehrer->getGeburtstag(), $lehrer->getGeschlecht(), $lehrer->getKuerzel(), $lehrer->getMail(),
                $lehrer->getStatus());
        }
        else {
            return array($lehrer->getUsername(), $lehrer->getPassword(), $lehrer->getName(), 
                $lehrer->getVorname(), $lehrer->getGeburtstag(), $lehrer->getGeschlecht(), $lehrer->getKuerzel(), $lehrer->getMail(),
                $lehrer->getStatus(), $lehrer->getPid());
        }
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    private function getIdfromDBorObj(person $obj) {
        basic::assertInstanceOf($obj, person);
        if ($obj->getPid() == null or $obj->getPid() == 0) {
            return $this->lastId();
        }
        else {
            return $obj->getPid(); 
        }
    }
    
    public function selectAllLehrer() {
        $liste = array();
        $result = $this->select( "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.lid = person.pid "
                . "order by pid");
        if (count($result)) {
            foreach ($result as $row ) {
                array_push($liste, $this->newObjLehrer($row));
            }
        }
        return $liste;
    }
    
    public function selectLehrer($lid) {
        $lehrer = null;
        $sql = "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.lid = person.pid "
                . "WHERE lehrperson.lid = ?";
        $params = array($lid);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $lehrer = $this->newObjLehrer($row);
        }
        return $lehrer;
    }
    
    public function checkUser($username, $password) {
        $lehrer = null;
        $sql = "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.lid = person.pid "
                . "WHERE person.username = ? "
                . "AND person.password = ?";
        $params = array($username, $password);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $lehrer = $this->newObjLehrer($row);
        }
        return $lehrer;
    }
    
    public function modifyLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        $this->preparedStatementQuery($sql, $this->objToArray($lehrer, true));
    }
    
    public function insertLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer);
        $sql = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql2 = "INSERT INTO lehrperson (lid) VALUES (?)";
        
        $this->startTransaction();
        try {
            $this->preparedStatementQuery($sql, $this->objToArray($lehrer, false));       // Insert Data into table person
            $this->preparedStatementQuery($sql2, array($this->getIdfromDBorObj($lehrer)));   // Create entry on table schueler linked by foreign key
            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Erstellen eines Lehrers: ' . $ex->getMessage());
        }    
    }
    
    public function deleteLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer);
        $sql = "DELETE FROM person WHERE person.pid = ?";
        
        if ($lehrer->getPid() != null or $lehrer->getPid() != 0) {
            $params = array($lehrer->getPid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
