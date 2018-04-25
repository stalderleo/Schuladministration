<?php
/**
 * @author Daniel Mosimann
 * @date 21. November 2016
 *
 *  Schnittstelle f�r die "Subcontroller". Diese Schnittstelle
 *  muss von den Klassen implementiert werden, welche beim 
 *  Controller (Klasse controller) registriert werden.
 *	
 */
interface subcontroller {
	/**
	 * Die DB-Connection wird als Parameter dem Konsstruktoren �bergeben.
	 */	
	function __construct( $template_path );

	/**
	 * F�hrt den Subcontroller aus.
	 */
	function run();
	
	/**
	 * Gibt den vom Subcontroller produzierten Output (HTML) zur�ck.
	 */
	function getOutput();
}

?>