<?php

db::connect( config::SQL_DATABASE, config::SQL_USER, config::SQL_PASSWORD );
// __construct($pid, $username, $password, $name, $vorname, $geburtstag, $geschlecht, $kuerzel, $mail, $status) 
class dbSchueler extends db {
    public function selectAllSchueler() {
        $liste = array();
        $result = $this->select( "SELECT * FROM schueler "
                . "LEFT JOIN person ON schueler.sid = person.pid "
                . "order by pid");
        if (count($result)) {
            foreach ($result as $data ) {
                array_push($liste, new schueler($data->pid));
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
        if (count($this->preparedStatementSelect($sql, $params))) {
            $schueler = new schueler();
        }
        return $schueler;
    }
    
    public function modifySchueler($schueler) {
        basic::assertInstanceOf($schueler, schueler);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
        $params = array($schueler->username, $schueler->password, $schueler->name, 
            $schueler->vorname, $schuler->geburtsdatum, $schueler->geschlecht, $schueler->kuerzel, $schueler->mail,
            $schueler->status, $schueler->pid);
        $this->preparedStatementQuery($sql, $params);
    }
    
    public function insertSchueler($schueler) {
        basic::assertInstanceOf($schueler, schueler);
        echo $schueler->pid;
        $sql = "INSERT INTO `person` "
                . "(`pid`, `username`, `password`, `name`, `vorname`, `geburtsdatum`, `geschlecht`, `kuerzel`, `mail`, `status`) "
                . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $params = array($schueler->getPid(), $schueler->getUsername(), $schueler->getPassword(), $schueler->getName(), 
            $schueler->getVorname(), $schuler->getGeburtstag(), $schueler->getGeschlecht(), $schueler->getKuerzel(), $schueler->getMail(),
            $schueler->getStatus());
        var_dump($params);
        $this->preparedStatementQuery($sql, $params);
    }
    
    public function deleteSchueler($sid) {
        $sid = $this->escape($sid);
        $sql = "DELETE FROM schueler WHERE schueler.sid = ?";
        $params = array($sid);
        $this->preparedStatementQuery($sql, $params);
    }
}
