<?php

class dbLehrperson extends dbPerson {
    
    static private $class = 'lehrer';
    
    public function selectAllLehrer() {
        $sql = "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.lid = person.pid WHERE person.status = true "
                . "order by pid";
        return $this->selectAll($sql, self::$class);
    }
    
    public function selectLehrer($lid) {
        $sql = "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.lid = person.pid "
                . "WHERE lehrperson.lid = ?";
        $params = array($lid);
        return $this->selectOnePerson($sql, $params, self::$class);
    }
    
    public function selectLehrerByUsername($username) {
        $sql = "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.id = person.id "
                . "WHERE lehrperson.username = ?";
        $params = array($username);
        return $this->selectOnePerson($sql, $params, self::$class);
    }
    
    public function checkUser($username, $password) {
        $sql = "SELECT * FROM lehrperson "
                . "LEFT JOIN person ON lehrperson.lid = person.pid "
                . "WHERE person.username = ? ";
        return $this->checkUserPerson($sql, $username, $password);
    }
    
    public function modifyLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        if ($this->checkWritePermission()) {
            $this->preparedStatementQuery($sql, $this->objToArray($lehrer, true, false));
        }
        else {
            echo "Diese Funktion darf nur als Administrator ausgeführt werden!"; 
        }
    }
    
    public function insertLehrer(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        $sqlPersonType = "INSERT INTO lehrperson (lid) VALUES (?)";
        return $this->insertPerson($lehrer, self::$class, $sqlPersonType, false);
    }
    
    public function insertLehrerAI(lehrer $lehrer) {
        basic::assertInstanceOf($lehrer, lehrer, true);
        $sqlPersonType = "INSERT INTO lehrperson (lid) VALUES (?)";
        return $this->insertPerson($lehrer, self::$class, $sqlPersonType, true);
    }
    
    public function deleteLehrer(lehrer $lehrer) {
        $this->deletePerson($lehrer);
    }
}
