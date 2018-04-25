<?php
/**
 * @author Daniel Mosimann.
 * @date 21. November 2016
 *
 * Konfigurationsdatei.
 */
class config {
	// Pfad zu Stylesheet-Datei
	const CSS_PATH =  '../css';
	
	// Pfad zum Template-Verzeichnis
	const TEMPLATE_PATH =  '../templates';
        
        // Bildpfad
        const IMAGE_PATH =  '../images';
	
	// Benutzername f�r den Datenbankzugriff
	const SQL_USER = 'root';
	
	// Passwort f�r den Datenbankzugriff
	const SQL_PASSWORD = '';
	
	// Datenbankname
	const SQL_DATABASE = 'mvcgibs';	
	
	// Default-Klasse der Input-Felder 
	const INPUT_CLASS_N = '';
	
	// Klasse der Input-Felder im Falle einer Falscheingabe
	const INPUT_CLASS_E = 'is-invalid';
        
        // Menu-Template
        const MENU_TEMPLATE = "../templates/menuTabs.htm.php";
}
?>