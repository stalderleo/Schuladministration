<?php
/**
 * @author Daniel Mosimann.
 * @date 1. April 2018
 *
 * Modul index.php.
 * Instanziert den Controller und registriert die Subcontroller.
 *
 */
header('Content-Type: text/html; charset=UTF-8');
require_once ("class.kontaktData.php");
require_once ("/class.kontaktListe.php");
session_start();
require_once("class.controller.php");
require_once("../config/config.php");
require_once("class.basic.php");
require_once("HelperClasses/class.db.php");
require_once("HelperClasses/class.dbKontakte.php");

$c = new controller("index.htm.php", config::TEMPLATE_PATH );
$c->registerSubcontroller("lehrerView", "Lehrer", false);
$c->registerSubcontroller("schuelerView", "Schüler", false);
$c->registerSubcontroller("faecherView", "Fächer", false);
$c->registerSubcontroller("importView", "Import", false);
$c->registerSubcontroller("logout", "Logout", false);

//$c->registerSubcontroller("datum", "", true);

$c->dispatch();
$c->sendOutput();

?>