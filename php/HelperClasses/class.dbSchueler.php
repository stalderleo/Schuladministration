<?php

db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );
// __construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) 
class dbSchueler extends db {
    
    public function newObjSchueler($row) {
        return new schueler($row->pid, $row->username, $row->password, $row->name, $row->vorname, $row->geburtstag, $row->geschlecht, $row->kuerzel, $row->mail, $row->status);
    }
    
    // If id is set on Object --> get Id from Object | else get last inserted id from DB!
    public function getIdfromDBorObj($obj) {
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
    
    public function modifySchueler($schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        $params = array($schueler->getUsername(), $schueler->getPassword(), $schueler->getName(), 
            $schueler->getVorname(), $schueler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
            $schueler->getStatus(), $schueler->getPid());
        $this->preparedStatementQuery($sql, $params);
    }
    
    public function insertSchueler($schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql3 = "INSERT INTO schueler (sid) VALUES (?)";
        $params = array($schueler->getPid(), $schueler->getUsername(), $schueler->getPassword(), $schueler->getName(), 
            $schueler->getVorname(), $schueler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
            $schueler->getStatus());
        
        $this->startTransaction();
        try {
            $this->preparedStatementQuery($sql, $params);       // Insert Data into table person
            $this->preparedStatementQuery($sql3, array($this->getIdfromDBorObj($schueler)));   // Create entry on table schueler linked by foreign key
            $this->commit();
        } catch (Exception $ex) {
            $this->rollback();
            throw new Exception(get_class($this).': Fehler beim Erstellen eines Schuelers: ' . $ex->getMessage());
        }    
    }
    
    public function deleteSchueler($schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "DELETE FROM schueler WHERE schueler.sid = ?";
        $sql2 = "DELETE FROM person WHERE person.pid = ?";
        // TODO FOREIGN KEY DELETE Action DEFINIEREN!!!
        
        if ($schueler->getPid() != null or $schueler->getPid() != 0) {
            $params = array($schueler->getPid());
            $this->preparedStatementQuery($sql, $params);
        }   
    }
}
