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

header('Content-Type: text/html; charset=iso-8859-1');
require_once ("class.kontaktData.php");
require_once ("class.kontaktListe.php");
session_start();
require_once("class.controller.php");
require_once("../config/config.php");
require_once("class.basic.php");
require_once("HelperClasses/class.db.php");
require_once './DataClasses/class.person.php';
require_once("HelperClasses/class.dbKontakte.php");
require_once("./DataClasses/class.schueler.php");
require_once("HelperClasses/class.dbSchueler.php");

$c = new controller("index.htm.php", config::TEMPLATE_PATH );
$c->registerSubcontroller("kontakt", "Kontaktformular", false);
$c->registerSubcontroller("liste", "Kontaktliste", false);
$c->registerSubcontroller("datum", "", true);
$c->dispatch();
$c->sendOutput();

/*
 * 
 * TEST DB Aufrufe
$schueler1 = new schueler(1, "test1", "test1", "test", "test", date ("Y-m-d H:i:s", mktime(0, 0, 0, 7, 1, 2000)), "TEst", "TEst", "TEst", 1);
$schueler2 = new schueler(2, "test2", "test2", "test", "test", date ("Y-m-d H:i:s", mktime(0, 0, 0, 7, 1, 2000)), "TEst", "TEst", "TEst", 1);
$schueler3 = new schueler(3, "test3", "test3", "test", "test", date ("Y-m-d H:i:s", mktime(0, 0, 0, 7, 1, 2000)), "TEst", "TEst", "TEst", 1);

$dbSchueler = new dbSchueler();
$dbSchueler->insertSchueler($schueler1);
$dbSchueler->insertSchueler($schueler2);
$dbSchueler->insertSchueler($schueler3);

$schuelerSelect = $dbSchueler->selectSchueler(1);
echo "Selektierter Schüler: name: ".$schuelerSelect->getName() . " " . $schuelerSelect->getVorname() ."<br><br>";

foreach ($dbSchueler->selectAllSchueler() as $schueler) {
    echo "Schueler " . $schueler->getName() . " " . $schueler->getVorname()."<br>";
}

$schueler2->setName("TTTTTTTT");
$dbSchueler->modifySchueler($schueler2);
$schueler2 = $dbSchueler->selectSchueler($schueler2->getPid());
echo "Schueler (mod): " . $schueler2->getName() ."  ". $schueler2->getVorname(). "<br>";

$dbSchueler->deleteSchueler($schueler1);
$dbSchueler->deleteSchueler($schueler2);
$dbSchueler->deleteSchueler($schueler3);

echo "Schüler löschen<br>";
$selectAll = $dbSchueler->selectAllSchueler() ;
echo "Count " . sizeof($selectAll);
foreach ($selectAll as $schueler) {
    echo "Schueler " . $schueler->getName() . " " . $schueler->getVorname()."<br>";
}
*/
?>