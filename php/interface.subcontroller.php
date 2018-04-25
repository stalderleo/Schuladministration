<?php
/**
 * @author Daniel Mosimann
 * @date 21. November 2016
 *
 *  Schnittstelle für die "Subcontroller". Diese Schnittstelle
 *  muss von den Klassen implementiert werden, welche beim 
 *  Controller (Klasse controller) registriert werden.
 *	
 */
interface subcontroller {
	/**
	 * Die DB-Connection wird als Parameter dem Konsstruktoren übergeben.
	 */	
	function __construct( $template_path );

	/**
	 * Führt den Subcontroller aus.
	 */
	function run();
	
	/**
	 * Gibt den vom Subcontroller produzierten Output (HTML) zurück.
	 */
	function getOutput();
}

?>