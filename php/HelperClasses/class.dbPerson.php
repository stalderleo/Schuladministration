<?php

class dbPerson extends db {
    
    /**
     * Füllt die Daten aus der DB in ein von Person erbendes Objekt
     * @param type $row
     * @param type $class
     * @return \person
     */
    public function newObjPerson($row, $class) {
        return new $class($row->pid, $row->username, $row->password, $row->name, $row->vorname, $row->geburtsdatum, $row->geschlecht, $row->kuerzel, $row->mail, $row->status);
    }
    
    /**
     * Fills data of an object into an array (used for prepared statements)
     * @param type $person - object from type person
     * @return type - returns array
     */
    public function objToArray(person $person, $pidLast, $withoutPid) {
        basic::assertInstanceOf($person, person, true);
        $passwordHandler = new passwordHandler($person->getUsername());
        $password = $passwordHandler->hashPW($person->getPassword());
        $params = array($person->getPid(), $person->getUsername(), $password, $person->getName(), 
                $person->getVorname(), $person->getGeburtstagDB(), $person->getGeschlecht(), $person->getKuerzel(), $person->getMail(),
                $person->getStatus());
        if ($pidLast) {
            array_shift($params);
            array_push($params, $person->getPid());
        }
        if ($withoutPid && $pidLast) {
            array_pop($params);
        }
        else if ($withoutPid && !$pidLast) {
            array_shift($params);
        }
        return $params;
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    public function getIdfromDBorObj(person $obj) {
        basic::assertInstanceOf($obj, person, true);
        if ($obj->getPid() == null or $obj->getPid() == 0) {
            return $this->lastId();
        }
        else {
            return $obj->getPid(); 
        }
    }
    
    public function selectAll($sql, $class) {
        $liste = array();
        $result = $this->select($sql);
        if (count($result)) {
            foreach ($result as $row ) {
                array_push($liste, $this->newObjPerson($row, $class));
            }
        }
        return $liste;
    }
    
    public function selectOnePerson($sql, $params, $class) {
        $person = null;
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $person = $this->newObjPerson($row, $class);
        }
        return $person;
    }
    
    public function selectPerson($class, $id) {
        $person = null;
        $sql = "SELECT * FROM person WHERE pid = ?";
        $params = array($id);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $person = $this->newObjPerson($row, $class);
        }
        return $person;
    }
    
    public function checkUserPerson($sql, $username, $password) {
        $params = array($username);
        $result = $this->preparedStatementSelect($sql, $params);
        if (sizeof($result) == 1) {
            $row = reset($result);
            $passwordHandler = new passwordHandler($row->username);
            if ($passwordHandler->isPWCorrect($password, $row->password)) {
                return $row->lid;
            }
        }
        return -1;
    }
    
    public function insertPerson(person $person, $class, $sqlPersonType, $withoutId) {
        basic::assertInstanceOf($person, person, true);
        $newPerson = null;
        $sqlCheck = "SELECT username FROM person WHERE username = ?";
        $sqlInsertPerson1 = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sqlInsertPerson2 = "INSERT INTO `person` "
                . "(`username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        if ($this->checkWritePermission()) {
            $this->startTransaction();
            try {
                $result = $this->preparedStatementSelect($sqlCheck, array($person->getUsername()));
                if (count($result) == 0) {
                    if (!$withoutId) {
                        $this->preparedStatementQuery($sqlInsertPerson1, $this->objToArray($person, false, false));       // Insert Data into table person
                    }
                    else {
                        $this->preparedStatementQuery($sqlInsertPerson2, $this->objToArray($person, false, $withoutId));       // Insert Data into table person
                    }
                    $this->preparedStatementQuery($sqlPersonType, array($this->getIdfromDBorObj($person)));   // Create entry on table schueler/leherer/angestellter linked by foreign key
                    $newPerson = $this->selectPerson($class, $this->getIdfromDBorObj($person));
                    $this->commit();
                }
                else {
                    $this->rollback();
                    echo "Username schon vorhanden Person wird nicht erstellt.";
                }
            } catch (Exception $ex) {
                $this->rollback();
                throw new Exception(get_class($this).': Fehler beim Erstellen eines '.$class.': ' . $ex->getMessage());
            }    
        }
        else {
            echo "Diese Funktion darf nur als Administrator ausgeführt werden!"; 
        }
        return $newPerson;
    }
    
    public function deletePerson(person $person) {
        basic::assertInstanceOf($person, person, true);
        $sql = "DELETE FROM person WHERE person.pid = ?";
        if ($person->getPid() != null or $person->getPid() != 0) {
            $params = array($person->getPid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
    
    public function checkWritePermission() { 
        $givePermission = false; 
        if (isset($_SESSION['role']) && isset($_SESSION['username'])) { 
            $role = $_SESSION['role']; 
            $username = $_SESSION['username']; 
            if ($role == "admin") { 
                $sql = "SELECT * FROM lehrperson " 
                        . "INNER JOIN person ON lehrperson.lid = person.pid " 
                        . "WHERE person.username = ?"; 
                $result = self::preparedStatementSelect($sql, array($username)); 
                if (count($result) == 1) { 
                    $givePermission = true; 
                } 
            } 
        }
        return $givePermission; 
    }
}
