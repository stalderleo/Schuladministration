<?php
/**
 * Darstellung einer Liste voller Klassen.
 *
 * @autor Aaron Studer
 * @date 23. May 2018
 */
require_once("interface.subcontroller.php");
require_once("./HelperClasses/class.dbLehrperson.php");

class lehrerView implements subcontroller
{
	//put your code here
	private $template_path;
	private $lehrers = array();
	private $lehrer;
	private $relations;
	public $title;
	
	public function __construct($template_path)
	{
		$this->template_path = $template_path;
		$this->title = "Lehrer";
	}

	
	public function run()
	{
            $db = new dbLehrperson();


            if (isset($_POST['pid'])) {
                    $this->lehrer = $db->selectLehrer($_POST['pid']);
            }
		
            if (isset($_POST['setLehrer']) && $this->lehrer instanceof lehrer && $this->lehrer != null) {
                if(!empty($_POST['p_usename'])){
                    $this->lehrer->setUsername($_POST['p_username']);
                }
                if(!empty($_POST['p_password'])){
                    $this->lehrer->setPassword($_POST['p_password']);
                }
                if (!empty($_POST['p_name'])) {
                        $this->lehrer->setName($_POST['p_name']);
                }
                if (!empty($_POST['p_vorname'])) {
                        $this->lehrer->setVorname($_POST['p_vorname']);
                }
                if (!empty($_POST['p_bday'])) {
                        $this->lehrer->setGeburtstag($_POST['p_bday']);
                }
                if (!empty($_POST['p_geschlecht'])) {
                        $this->lehrer->setGeschlecht($_POST['p_geschlecht']);
                }
                if (!empty($_POST['p_mail'])) {
                        $this->lehrer->setMail($_POST['p_mail']);
                }
                if (!empty($_POST['p_kuerzel'])) {
                        $this->lehrer->setKuerzel($_POST['p_kuerzel']);
                }
                if (!empty($_POST['p_status'])) {
                        $this->lehrer->setStatus($_POST['p_status']);
                }
            }
            
            if (isset($_GET['pid'])) {
                $this->lehrer = $db->selectLehrer($_GET['pid']);
            }
		
            if (isset($_POST["safe"])) {
                    $db->insertLehrerAI(new lehrer(null, $_POST["s_username"], $_POST["s_pw"], $_POST["s_name"], $_POST["s_prename"], $_POST["s_birth"], $_POST["s_gender"], $_POST["s_kuerzel"], $_POST["s_mail"], $_POST["s_status"]));
            }

            $this->lehrers = $db->selectAllLehrer();

            if (isset($_POST['pid_del']) && $_POST['pid_del'] != null) {
                    $db->deleteLehrer($db->selectLehrer($_POST['pid_del']));
                    header('Location: '.$_SERVER['PHP_SELF']);
                    die;
            }

            if (isset($_POST['klasse_id']) && isset($_POST['fach_id'])) {
                    //check if fach already exists
                    //create class, fach and get teacher by lid
                    $dbKurs = new dbKurs();
                    $dbKlasse = new dbKlasse();
                    $f_kurs = $dbKurs->selectKurs($_POST['fach_id']);
                    $f_klasse = $dbKlasse->selectKlasse($_POST['klasse_id']);

                    $dbKursInstanz = new dbKursInstanz();
                    $kursInstanz = new kursInstanz($this->lehrer, $f_klasse, $f_kurs);
                    $dbKursInstanz->insertInstanz($kursInstanz);
            }

            if (isset($this->lehrer)) {
                    $dbKursInstanz = new dbKursInstanz();
                    $this->relations = $dbKursInstanz->selectInstanzenByLehrer($this->lehrer);
            }

            if (isset($_POST['del_instanz'])) {
                    $dbKursInstanz = new dbKursInstanz();
                    $dbKursInstanz->deleteInstanz($this->relations[$_POST['del_instanz']]);
                    $this->relations[$_POST['del_instanz']] = null;
                    unset($_POST['del_instanz']);
            }
	}

	public function getOutput()
	{
		$v =& $this;
		if (isset($_POST['pid'])) {
			include($this->template_path."/update/update-lehrer.htm.php");
		} else if(isset($_GET["pid"])) { 
                        include($this->template_path."/detail/detail-lehrer.htm.php");
                } else {
			include($this->template_path."/liste/liste-lehrer.htm.php");
		}
	}

	private function print_klassen_form()
	{
		$dbKlassen = new dbKlasse();
		$klassen = $dbKlassen->selectAllKlassen();
		foreach ($klassen as $klasse) {
			echo '<label>'.$klasse->getBezeichnung().'
                <input type="radio" reguired name="klasse_id" value="'.$klasse->getKid().'"></label>';
		}
	}

	private function print_kurs_form()
	{
		$dbKurse = new dbKurs();
		$kurse = $dbKurse->selectAllKurse();
		
		foreach ($kurse as $kurs) {
			echo '<option value="'.$kurs->getFid().'">'.$kurs->getBezeichnung().'</option>';
		}
	}
}
