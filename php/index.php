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
$c->registerSubcontroller("logout", "Logout", false);

$dbLehrer = new dbLehrperson();
$dbKlasse = new dbKlasse();
$dbKurs = new dbKurs();
$dbKursInstanz = new dbKursInstanz();
$lehrer = $dbLehrer->selectLehrer(1);
$klasse = $dbKlasse->selectKlasse(1);
$kurs = $dbKurs->selectKurs(1);
$kursInssanz = new kursInstanz($lehrer, $klasse, $kurs);
//$dbKursInstanz->insertInstanz($kursInssanz);

$kursInstanz = $dbKursInstanz->selectInstanzenByLehrer($lehrer);
//$kursInstanz = $dbKursInstanz->selectInstanzenByKlasse  ($klasse);
foreach ($kursInstanz as $instanz) {
    echo "Instanz (". $instanz->getLehrer()->getPid() ."-". $instanz->getKlasse()->getKid() ."-". $instanz->getKurs()->getFid() .")<br>&emsp;";
    echo "Lehrer: " . $instanz->getLehrer()->getName() . "<br>&emsp;";
    echo "Klasse: " . $instanz->getKlasse()->getKuerzel(). " <br>&emsp;";
    echo "Kurs: " . $instanz->getKurs()->getKuerzel(). "<br>";
}

//$c->registerSubcontroller("datum", "", true);

$c->dispatch();
$c->sendOutput();

?>