<?php
/**
 * @author      Daniel Mosimann
 * @date        1. April 2018
 *
 * Datenbankschnittstelle GIBS Solothurn.
 * Stellt grundlegende Datenbankfunktionen zur Verf�gung.
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
         * @param String $username Benutzername f�r den Zugriff auf die Datenbank
         * @param String $password Kennwort f�r den Zugriff auf die Datenbank
	 */
	public static function connect( $database, $username, $password ) {   
            if (self::$dbhandle == Null) {
                try {
                    self::$dbhandle = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
                    self::$dbhandle->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $e) {
                    throw new Exception (get_class.': Connection failed: ' . $e->getMessage());
                }
            }
	}

	/**
	 * Escaped einen String, Wildcards werden nicht escaped
	 * @param String $value, wert der Escaped wird (Referenz)
	 */
	public function escape( $value ) {
            return self::$dbhandle->quote($value);
	}

	/**
	 * �bergebenen Select ausf�hren und Resultat im assoziativen Array speichern
         * @param String $sql SQL-Select, welcher ausfgef�hrt werden soll
	 */
	public function select( $sql ) {
            try {
                $sth = self::$dbhandle->query($sql);
                return $sth->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                throw new Exception (get_class.': Fehler in Select: '.$e->getMessage());
            }
	}

	/**
	 * Query ( insert, update, delete )auf der Datenbank ausf�hren
         * @param String $sql SQL-Anweisung, welche ausfgef�hrt werden soll
	 */
	public function query( $sql ) {
            try {
                self::$dbhandle->query($sql);
            } catch (PDOException $e) {
                throw new Exception(get_class.': Fehler in Query: ' . $e->getMessage()."<pre>".$sql."</pre>");
            }        
            return self::$dbhandle->lastInsertId();
	}
}

