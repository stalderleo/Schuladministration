<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 * 
 * Liste (Tabelle) mit Kontakten ausgeben - einzelne Kontakte löschen
 */
require_once("interface.subcontroller.php");

class liste implements subcontroller {	
	private $template_path = "";        // Pfad zum Template-Verzeichnis
        private $db=NULL;
        private $data=null;
        private $phpmodule=null;
        private $params=null;

	/*
         * Konstruktor
         */
	public function __construct( $template_path ) {
		$this->template_path = $template_path;
                $this->phpmodule = $_SERVER['SCRIPT_NAME']."?id=".get_class($this);
                $this->params = $_REQUEST;
                
	}
	
	/*
         * Kontakte aus der DB auslesen - Einzelne Kontakte löschen
         */
	public function run() {
                $this->db = new dbKontakte();
                if ( isset($this->params['kid']) ) $this->db->deletekontakt($this->params['kid']);
                $this->data = $this->db->selectKontakte();
	}

        /*
         * Template ausführen, Kontaktliste ausgeben
         */
	public function getOutput(){
                if ( count($this->data->getKontaktListe()) ) include($this->template_path."/"."liste-stacked-table.htm.php");
                else echo "Keine Kontakte vorhanden...";
        }
}

?>