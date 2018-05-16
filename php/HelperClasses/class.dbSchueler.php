<?php

class dbSchueler extends db {
    
    /**
     * Serializes DB Data to a 'schueler' object.
     * @param type $row - Data from DB (single row)
     * @return \schueler - returns object from type schueler
     */
    private function newObjSchueler($row) {
        return new schueler($row->pid, $row->username, $row->password, $row->name, $row->vorname, $row->geburtstag, $row->geschlecht, $row->kuerzel, $row->mail, $row->status);
    }
    
    /**
     * Fills data of an object into an array (used for prepared statements)
     * @param type $schueler - object from type schueler
     * @return type - returns array
     */
    private function objToArray(schueler $schueler, $pidLast) {
        basic::assertInstanceOf($schueler, schueler, true);
        $passwordHandler = new passwordHandler($schueler->getUsername());
        $password = $passwordHandler->hashPW($schueler->getPassword());
        
        if (!$pidLast) {
            return array($schueler->getPid(), $schueler->getUsername(), $password, $schueler->getName(), 
                $schueler->getVorname(), $schueler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
                $schueler->getStatus());
        }
        else {
            return array($schueler->getUsername(), $password, $schueler->getName(), 
                $schueler->getVorname(), $schueler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
                $schueler->getStatus(), $schueler->getPid());
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
        $sql = "SELECT *  FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid "
                . "WHERE person.username = ? ";
        $params = array($username);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $passwordHandler = new passwordHandler($row->username);
            if ($passwordHandler->isPWCorrect($password, $row->password)) {
                return $row->sid;
            }
        }
        return -1;
    }
    
    public function modifySchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        $this->preparedStatementQuery($sql, $this->objToArray($schueler, true));
    }
    
    public function insertSchueler(schueler $schueler) {
        $newSchueler = null;
        basic::assertInstanceOf($schueler, schueler, true);
        $sqlCheck = "SELECT username FROM person WHERE username = ?";
        $sql = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql2 = "INSERT INTO schueler (sid) VALUES (?)";
        
        $this->startTransaction();
        try {
            $result = $this->preparedStatementSelect($sqlCheck, array($schueler->getUsername()));
            if (count($result) == 0) {
                $this->preparedStatementQuery($sql, $this->objToArray($schueler, false));       // Insert Data into table person
                $this->preparedStatementQuery($sql2, array($this->getIdfromDBorObj($schueler)));   // Create entry on table schueler linked by foreign key
                $newSchueler = $this->getIdfromDBorObj($schueler);
                $this->commit();
            }
            else {
                $this->rollback();
                echo "Username schon vorhanden Person wird nicht erstellt.";
            }
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Erstellen eines Schuelers: ' . $ex->getMessage());
        }    
        return $newSchueler;
    }
    
    public function insertSchuelerAI(schueler $schueler) {
        $newSchueler = null;
        basic::assertInstanceOf($schueler, schueler, true);
        $sqlCheck = "SELECT username FROM person WHERE username = ?";
        $sql = "INSERT INTO `person` "
                . "(`username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql2 = "INSERT INTO angestellte (aid) VALUES (?)";
        
        $this->startTransaction();
        try {
            $result = $this->preparedStatementSelect($sqlCheck, array($schueler->getUsername()));
            if (count($result) == 0) {
                $this->preparedStatementQuery($sql, $this->objToArray($schueler, false));       // Insert Data into table person
                $this->preparedStatementQuery($sql2, array($this->getIdfromDBorObj($schueler)));   // Create entry on table schueler linked by foreign key
                $newSchueler = $this->getIdfromDBorObj($schueler);
                $this->commit();
            }
            else {
                $this->rollback();
                echo "Username schon vorhanden Person wird nicht erstellt.";
            }
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Erstellen eines Angestellten: ' . $ex->getMessage());
        }   
        return $newSchueler;
    }
    
    public function deleteSchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $sql = "DELETE FROM person WHERE person.pid = ?";
        
        if ($schueler->getPid() != null or $schueler->getPid() != 0) {
            $params = array($schueler->getPid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
