<?php
require_once("interface.subcontroller.php");

/**
 * Klasse: importView
 *
 * Die Klasse sorgt für das Funktionieren des XML - Import.
 * Dabei wird der DatenTyp überprüft und die Daten in die DB
 * gespeichert.
 *
 */

class importView implements subcontroller
{
	
	// Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
	private $params = null;
	
	//DB-Klassen
	private $dbLehrer = null;
	private $dbKurs = null;
	private $dbKursinstanz = null;
	private $dbSchueler = null;
	private $dbKlasse = null;
	private $dbKlassenBesuch = null;
	private $dbAngestellte = null;
	public $title = "Import";
	
	// Pfad zum Template-Verzeichnis
	private $template_path = "";
	
	// Datei
	private $target = null;
	
	public function __construct($template_path)
	{
		$this->params = $_REQUEST;
		$this->template_path = $template_path;
		$this-> dbLehrer = new dbLehrperson();
		$this-> dbKurs = new dbKurs();
		$this-> dbKursinstanz = new dbKursInstanz();
		$this-> dbSchueler = new dbSchueler();
		$this-> dbKlasse = new dbKlasse();
		$this-> dbKlassenBesuch = new dbKlassenBesuch();
		$this-> dbAngestellte = new dbAngestellter();
	}

	public function run()
	{
		if (isset($this->params['submit'])) {
			// Allow certain file formats
			if (strtolower(pathinfo($_FILES['dataExport']['name'], PATHINFO_EXTENSION)) != "xml") {
				die("Sorry, Nur XML-Datei sind zugelassen");
			}
			
			$this->target = $_FILES['dataExport']['tmp_name'];
		}
	}

	public function getOutput()
	{
		$v =& $this;
		include($this->template_path."/"."dataimport.htm.php");
		ob_flush();
		flush();
		if (isset($this->target)) {
			$this->insertIntoDB($this->target);
		}
	}
	
	/**
	 * Funktion zur Speicherung der Daten in die DB.
	 *
	 * @param type $target
	 */
	private function insertIntoDB($target)
	{
		//try {
			ini_set('max_execution_time', 600);
			//$this->dbKlasse->startTransaction();
			
			$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Import started"."<hr>\n");
			$xml = simplexml_load_file($target);
		foreach ($xml->lehrer as $lp) {
			$lehrer = $this->dbLehrer->insertLehrer(new lehrer(str_replace('gibsso', '', $lp->id), $lp->username, $lp->initpw, $lp->name, $lp->vorname, $this->convertStringToDate($lp->geburtsdatum), $lp->geschlecht, $lp->kuerzel, $lp->mail, $lp->status));
			if (!empty($lehrer)) {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Lehrer (".$lehrer->getPid().") inserted"."<hr>\n");
			} else {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Lehrer ($lp->id) insert failed"."<hr>\n");
			}

			//Klassen des Lehrers einfügen
			foreach ($lp->regelklassen->klasse as $klasse) {
				$klasse = $this->dbKlasse->insertKlasseAI(new klasse($klasse->klasse_kuerzel, $klasse->klasse_bezeichnung));
				if (!empty($klasse)) {
					$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Klasse (".$lehrer->getPid().") inserted"."<hr>\n");
				} else {
					$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Klasse ($klasse->klasse_kuerzel) insert failed"."<hr>\n");
				}
			}

			foreach ($lp->kurse->kurs as $ks) {
				if (strpos($ks->kurs_kuerzel, ',') !== false) {
					$kuerzelstr = explode('-', $ks->kurs_kuerzel)[1]; //Mittlerer Teil nehmen

					$klassenkuerzelarr = explode(',', $kuerzelstr);
					foreach ($klassenkuerzelarr as $klassenkuerzel) {
						$klasse = $this->dbKlasse->selectKlasseByKuerzel($klassenkuerzel);
						if (empty($klasse)) {
							$this->writeToLog(date('m.d.Y h:i:s a', time()). ": failed finding klass (".$klassenkuerzel.")"."<hr>\n");
						}
						$kurs = $this->dbKurs->insertKursAI(new kurs($ks->kurs_kuerzel, $ks->kurs_bezeichnung));
						if (!empty($kurs)) {
							$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Kurs (".$kurs->getFid().", " .$lp->username .") inserted"."<hr>\n");
						} else {
							$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Kurs ($kurs->kurs_kuerzel) insert failed"."<hr>\n");
						}

						$kursinstanz = $this->dbKursinstanz->insertInstanz(new kursInstanz($lehrer, $klasse, $kurs));

						if (!empty($kursinstanz)) {
							$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Kursinstanz (".$kursinstanz->getLehrer()->getPid().", ".$kursinstanz->getKlasse()->getKid().", ".$kursinstanz->getKurs()->getFid().") inserted"."<hr>\n");
						} else {
							$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Kursinstanz ($klasse->klasse_kuerzel) insert failed"."<hr>\n") ;
						}
					}
				}
			}
		}

		foreach ($xml->schueler as $sl) {
			$schueler = $this->dbSchueler->insertSchueler(new schueler(str_replace('gibsso', '', $sl->id), $sl->username, $sl->initpw, $sl->name, $sl->vorname, $this->convertStringToDate($sl->geburtsdatum), $sl->geschlecht, $sl->kuerzel, $sl->mail, $sl->status));

			if (!empty($schueler)) {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Schueler (".$schueler->getPid().") inserted"."<hr>\n");
			} else {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Schueler ($sl->id) insert failed"."<hr>\n");
			}

			$klasse = $this->dbKlasse->selectKlasseByBezeichnung($sl->profile->profil->stammklasse);
			if (empty($klasse)) {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Warning couldn't find klass (".$sl->profile->profil->ausbildung_kuerzel.")"."<hr>\n");
			} else {
				$this->dbKlassenBesuch->insertBesuch(new klassenBesuch($schueler, $klasse, false));
			}
				

			if (isset($sl->profile->profil->zweitausbildung_kuerzel)) {
				$klasse = $this->dbKlasse->selectKlasseByBezeichnung($sl->profile->profil->zweitausbildung_stammklasse);
				if (empty($klasse)) {
					$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Warning couldn't find zweitausbildungklass (".$sl->profile->profil->zweitausbildung_kuerzel.")"."<hr>\n");
				} else {
					$this->dbKlassenBesuch->insertBesuch(new klassenBesuch($schueler, $klasse, true));
				}
			}
		}

		foreach ($xml->angestellte as $ag) {
			$angestellter = $this->dbAngestellte->insertAngestellter(new angestellter(str_replace('gibsso', '', $ag->id), $ag->username, $ag->initpw, $ag->name, $ag->vorname, $this->convertStringToDate($ag->geburtsdatum), $ag->geschlecht, $ag->kuerzel, $ag->mail, $ag->status));
			if (!empty($angestellter)) {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Angestellter (".$angestellter->getPid().") inserted"."<hr>\n");
			} else {
				$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Angestellter ($ag->id) insert failed"."<hr>\n");
			}
		}

			$this->writeToLog(date('m.d.Y h:i:s a', time()). ": Import abgeschlossen"."<hr>\n");
			unlink("../res/data/log.txt"); //Logfile nach import löschen
			//$this->dbKlasse->commit();
		//} catch (Exception $ex) {
			//echo $ex;
			//$this->dbKlasse->rollback();
		//}
	}
	
	function convertStringToDate($string)
	{
		if ($string != null) {
			$time = strtotime($string);
			return date('Y-m-d', $time);
		}

		return "";
	}
	
	private function writeToLog($str)
	{
		$handle = fopen("../res/data/log.txt", "a");
		fwrite($handle, $str);
		fclose($handle);
	}
}
