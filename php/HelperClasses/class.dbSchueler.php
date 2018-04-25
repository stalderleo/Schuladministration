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
        assertInstanceOf($schueler, schueler);
        $pid = $this->escape($schueler->pid);
        $sql = "UPDATE person "
                . "SET `username` = ?, `password` = ?, `name` = ?,`vorname` = ?, `geburtsdatum` = ?, "
                . "`geschlecht` = ?, `kuerzel` = ?, `mail` = ?, `status` = ? "
                . "WHERE person.pid = ?";
    }
}
