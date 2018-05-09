<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 *
 * Modul index.php.
 * Instanziert den Controller und registriert die Subcontroller.
 *
 */
error_reporting(E_ALL & ~E_NOTICE);
header('Content-Type: text/html; charset=UTF-8');
session_start();
require_once("class.controller.php");
require_once("../config/config.php");
require_once("class.basic.php");

require_once './DataClasses/class.person.php';
require_once("./DataClasses/class.angestellter.php");
require_once("DataClasses/class.lehrer.php");
require_once("DataClasses/class.schueler.php");
require_once("DataClasses/class.klasse.php");
require_once("DataClasses/class.kursInstanz.php");
require_once("DataClasses/class.kurs.php");
require_once("DataClasses/class.klassenBesuch.php");

require_once("HelperClasses/class.db.php");
require_once("HelperClasses/class.dbSchueler.php");
require_once("HelperClasses/class.dbAngestellter.php");
require_once("HelperClasses/class.dbLehrperson.php");
require_once("HelperClasses/class.dbKurs.php");
require_once("HelperClasses/class.dbKlasse.php");
require_once("HelperClasses/class.dbKursInstanz.php");


$c = new controller("index.htm.php", config::TEMPLATE_PATH );
$c->registerSubcontroller("lehrerView", "Lehrer", false);
$c->registerSubcontroller("schuelerView", "Schüler", false);
$c->registerSubcontroller("faecherView", "Fächer", false);
$c->registerSubcontroller("importView", "Import", false);
if( isset($_SESSION["role"] ))
{
    $c->registerSubcontroller("logout", "Logout", false); 
}
else
{
    $c->registerSubcontroller("login", "Log In", false);
}

//$c->registerSubcontroller("datum", "", true);

$c->dispatch();
$c->sendOutput();

?>