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
	public $title;

	public function __construct($template_path)
	{
		$this->template_path = $template_path;
		$this->title = "Klasse";
	}
	public function getKontaktListe()
	{
		//a person object should be returned here
	}
	
	public function run()
	{
		$db = new dbKlasse();
		
		$this->klassen = $db->selectAllKlassen();
		if (isset($_POST['kid'])) {
			$this->klasse = $db->selectKlasse($_POST['kid']);
		}
		
		if (isset($_POST["safe"])) {
			$db->insertKlasseAI(new klasse($_POST["k_ku"], $_POST["k_bez"]));
		}

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
