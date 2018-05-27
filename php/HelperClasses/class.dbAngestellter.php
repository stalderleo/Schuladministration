<?php

/**
 * Db-Klasse für das Handling der CRUD-Funktionen für
 * die Angestellter Tabelle.
 * 
 * @date 23. May 2018
 */
class dbAngestellter extends dbPerson {
    
    static private $class = 'angestellter';
    
    public function selectAllAngestellte() {
        $result = $this->select( "SELECT * FROM angestellte "
                . "LEFT JOIN person ON angestellte.aid = person.pid "
                . "order by pid");
        return $this->selectAll($sql, self::$class);
    }
    
    /**
     * Selektiert ein Angestellter mit der ID der Person.
     * 
     * @param type $aid
     * @return type
     */
    public function selectAngestellte($aid) {
        $sql = "SELECT * FROM angestellte "
                . "LEFT JOIN person ON angestellte.aid = person.pid "
                . "WHERE angestellte.aid = ?";
        $params = array($aid);
        return $this->selectOnePerson($sql, $params, self::$class);
    }
    
    public function modifyAngestellter(angestellter $angestellte) {
        basic::assertInstanceOf($angestellte, angestellter, true);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        if ($this->checkWritePermission()) {
            $this->preparedStatementQuery($sql, $this->objToArray($angestellte, true, false));
        }
        else {
            echo "Diese Funktion darf nur als Administrator ausgeführt werden!"; 
        }
    }
    
    public function insertAngestellter(angestellter $angestellte) {
        basic::assertInstanceOf($angestellte, angestellter, true);
        $sqlPersonType = "INSERT INTO angestellte (aid) VALUES (?)";
        return $this->insertPerson($angestellte, self::$class, $sqlPersonType, false);
    }
    
    public function insertAngestellterAI(angestellter $angestellte) {
        basic::assertInstanceOf($angestellte, angestellter, true);
        $sqlPersonType = "INSERT INTO angestellte (aid) VALUES (?)";
        return $this->insertPerson($angestellte, self::$class, $sqlPersonType, true);
    }
    
    public function deleteAngestellter(angestellter $angestellte) {
        $this->deletePerson($angestellte);
    }
}
