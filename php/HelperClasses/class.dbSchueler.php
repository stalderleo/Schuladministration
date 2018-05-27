<?php

class dbSchueler extends dbPerson {
    
    static private $class = 'schueler';
    
    public function selectSchueler($sid) { 
        $sql = "SELECT * FROM schueler " 
                . "LEFT JOIN person ON schueler.sid = person.pid " 
                . "WHERE schueler.sid = ?"; 
        $params = array($sid); 
        return $this->selectOnePerson($sql, $params, self::$class); 
    }
    
    public function selectAllSchueler() {
        $sql = "SELECT * FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid WHERE person.status = true "
                . "order by pid";
        return $this->selectAll($sql, self::$class);
    }
    
    public function checkUser($username, $password) {
        $sql = "SELECT *  FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid "
                . "WHERE person.username = ? ";
        return $this->checkUserPerson($sql, $username, $password);
    }
    
    public function modifySchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        
        if ($this->checkWritePermission()) {
            $this->preparedStatementQuery($sql, $this->objToArray($schueler, true, false));
        }
        else {
            echo "Diese Funktion darf nur als Administrator ausgeführt werden!"; 
        }
    }
    
    public function insertSchueler(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $sqlPersonType = "INSERT INTO schueler (sid) VALUES (?)";
        return $this->insertPerson($schueler, self::$class, $sqlPersonType, false);
    }
    
    public function insertSchuelerAI(schueler $schueler) {
        basic::assertInstanceOf($schueler, schueler, true);
        $sqlPersonType = "INSERT INTO schueler (sid) VALUES (?)";
        return $this->insertPerson($schueler, self::$class, $sqlPersonType, true);
    }
    
    public function deleteSchueler(schueler $schueler) {
        $this->deletePerson($schueler);
    }
}
