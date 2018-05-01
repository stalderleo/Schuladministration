<?php
/**
 * @author      Daniel Mosimann
 * @date        1. April 2018
 *
 * Datenbankschnittstelle GIBS Solothurn.
 * Stellt grundlegende Datenbankfunktionen zur Verfügung.
 * In dieser Version wurde die MDB2-Schnittstelle (Pear) durch die PDO-Schnittstelle ersetzt. 
 *
 */
class db {
        private static $dbhandle = Null;              // DB-Handle

        /**
         * Konstruktor
         */
        public function __construct() {
        }

	/**
	 * Datenbankverbinndung herstellen
         * @param String $database Bezeichnung der Datenbank
         * @param String $username Benutzername für den Zugriff auf die Datenbank
         * @param String $password Kennwort für den Zugriff auf die Datenbank
	 */
	public static function connect( $database, $username, $password ) {   
            if (self::$dbhandle == Null) {
                try {
                    self::$dbhandle = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
                    self::$dbhandle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    throw new Exception (get_class($this).': Connection failed: ' . $e->getMessage());
                }
            }
	}

	/**
	 * Escaped einen String, Wildcards werden nicht escaped
	 * @param String $value, wert der Escaped wird (Referenz)
	 */
	public function escape( $value ) {
            return htmlspecialchars(self::$dbhandle->quote($value));
	}
        
        public function escapeAll($params) {
            foreach ($params as $param) {
                $param = $this->escape($param);
            }
            return $params;
        }
        
	/**
	 * Übergebenen Select ausführen und Resultat im assoziativen Array speichern
         * @param String $sql SQL-Select, welcher ausfgeführt werden soll
	 */
	public function select( $sql ) {
            try {
                $sth = self::$dbhandle->query($sql);
                return $sth->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                throw new Exception (get_class($this).': Fehler in Select: '.$e->getMessage());
            }
	}

	/**
	 * Query ( insert, update, delete )auf der Datenbank ausführen
         * @param String $sql SQL-Anweisung, welche ausfgeführt werden soll
	 */
	public function query( $sql ) {
            try {
                self::$dbhandle->query($sql);
            } catch (PDOException $e) {
                throw new Exception(get_class($this).': Fehler in Query: ' . $e->getMessage()."<pre>".$sql."</pre>");
            }        
            return self::$dbhandle->lastInsertId();
	}
        
        public function preparedStatementQuery($sql, $params) {
            try {
                $params = $this->escapeAll($params);
                $statement = self::$dbhandle->prepare($sql);
                $statement->execute($params);
                return $statement;
            } catch (PDOException $ex) {
                throw new Exception(get_class($this).': Fehler in Prepared Statement Query: ' . $ex->getMessage()."<pre>".$sql."</pre>");
            }
        }
        
        public function preparedStatementSelect($sql, $params) {
            try {
                $statement = $this->preparedStatementQuery($sql, $params);
                if ($statement) {
                    return $statement->fetchAll(PDO::FETCH_OBJ);
                }
            } catch (PDOException $ex) {
                throw new Exception(get_class($this).': Fehler in Prepared Statement Select: ' . $e->getMessage()."<pre>".$sql."</pre>");
            }
        }
        
        public function lastId() {
            return self::$dbhandle->lastInsertId();
        }
        
        public function startTransaction() {
            return self::$dbhandle->beginTransaction();
        }
        
        public function commit() {
            return self::$dbhandle->commit();
        }
        
        public function rollback() {
            self::$dbhandle->rollBack();
        }
}

