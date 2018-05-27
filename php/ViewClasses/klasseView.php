<?php

/**
 * Darstellung einer Liste voller Lehrer.
 * Dabei hat man ein paar weitere Buttons für die Verwaltung
 * der Daten.
 *
 * @autor Aaron Studer
 * @date 23. May 2018
 */
require_once("interface.subcontroller.php");
require_once("./HelperClasses/class.dbKlasse.php");

class klasseView implements subcontroller
{
	//put your code here
	private $template_path;
	private $klassen = array();
	private $klasse;
	private $schueler;
	private $lehrer;
	private $kurse;
	public $title;

	public function __construct($template_path)
	{
		$this->template_path = $template_path;
		$this->title = "Klasse";
	}
	
	public function run()
	{
		$db = new dbKlasse();
		$dbKlassenBesuche = new dbKlassenBesuch();

		if (isset($_POST['kid'])) {
			$this->klasse = $db->selectKlasse($_POST['kid']);
			$this->schueler = $dbKlassenBesuche->selectBesucheByKlasse($this->klasse);

			$dbKursInstanz = new dbKursInstanz();
			$klassenInstanz = $dbKursInstanz->selectInstanzenByKlasse($this->klasse);
			foreach( $klassenInstanz as $klasse){
				$this->lehrer[] = $klasse->getLehrer();
				$this->kurse[] = $klasse->getKurs();
			}
		}
		
		if (isset($_POST['del_schueler-klasse'])){
			foreach($this->schueler as $index=>$besuch){
				if($_POST['del_schueler-klasse'] == $besuch->getSchueler()->getPid()){
					$dbKlassenBesuche->deleteBesuch($besuch);
					unset($this->schueler[$index]);
				}
			}
			
		}

		
		if (isset($_POST["safe"]) && !empty($_POST["k_kur"]) && !empty($_POST["k_bez"])) {
			$db->insertKlasse(new klasse($_POST["k_kur"], $_POST["k_bez"]));
		}

		$this->klassen = $db->selectAllKlassen();

		//add the selected fach/er to this klasse
		if (isset($_POST['kurs_id'])) {
			if (is_array($_POST['kurs_id'])) {
				foreach ($_POST['kurs_id'] as $kurs_id) {
					//
				}
			} else {
				$kurs_id = $_POST['kurs_id'];
			}
		}
	}
	
	public function getOutput()
	{
		$v =& $this;
		if (isset($this->klasse)) {
			include($this->template_path."/detail/detail-klasse.htm.php");
		} else {
			include($this->template_path."/liste/liste-klasse.htm.php");
		}
	}

	private function print_relations()
	{
		if (isset($this->relationships) && !empty($this->relationships)) {
			echo "<h2>Aktuelle Beziehungen</h2>";
			foreach ($this->relationships as $key => $rel) {
				if ($rel instanceof kursInstanz) {
					echo "<div class='fullwidth'>".$rel->klasse->getBezeichnung()." / ".$rel->kurs->getBezeichnung()."<form class='delete same-line' method='post'><i class='fas fa-trash'></i><input type='hidden' name='pid' value='".$this->lehrer->getPid()."'><input type='submit' name='del_instanz' value='".$key."'></form></div>";
				}
			}
		}
	}

	private function print_kurs_form()
	{
		$dbKurse = new dbKurs();
		$kurse = $dbKurse->selectAllKurse();

		foreach ($kurse as $kurs) {
			echo '<label>'.$kurs->getBezeichnung().'
                <input type="checkbox" reguired name="kurs_id[]" value="'.$kurs->getFid().'"></label>';
		}
	}
}
