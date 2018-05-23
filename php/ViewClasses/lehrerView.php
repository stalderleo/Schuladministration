<?php
/**
 * Darstellung einer Liste voller Klassen.
 * 
 * @autor Aaron Studer
 * @date 23. May 2018
 */
require_once("interface.subcontroller.php");
require_once("./HelperClasses/class.dbLehrperson.php");

class lehrerView implements subcontroller {
    //put your code here
    private $template_path;
    private $lehrers = array();
    private $lehrer;
    public $title;
    
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Lehrer";
    }
    
    public function run() {
        $db = new dbLehrperson();
        
        $this->lehrers = $db->selectAllLehrer();
        
         if(isset($_POST['pid'])){
            $this->lehrer = $db->selectLehrer($_POST['pid']);
        }
        
        if(isset($_POST['setLehrer']) && $this->lehrer instanceof lehrer && $this->lehrer != NULL){
            if(!empty($_POST['p_name'])){
                $this->lehrer->setName($_POST['p_name']);
            }
            if(!empty($_POST['p_vorname'])){
                $this->lehrer->setVorname($_POST['p_vorname']);
            }
            if(!empty($_POST['p_bday'])){
                $this->lehrer->setGeburtstag($_POST['p_bday']);
            }
            if(!empty($_POST['p_geschlecht'])){
                $this->lehrer->setGeschlecht($_POST['p_geschlecht']);
            }
            if(!empty($_POST['p_mail'])){
                $this->lehrer->setMail($_POST['p_mail']);
            }
            if(!empty($_POST['p_kuerzel'])){
                $this->lehrer->setKuerzel($_POST['p_kuerzel']);
            }
            if(!empty($_POST['p_status'])){
                $this->lehrer->setStatus($_POST['p_status']);
            }
        }
        
        if(isset($_POST["safe"])){
            $db->insertLehrerAI(new lehrer(null, $_POST["s_username"], $_POST["s_pw"], $_POST["s_name"], $_POST["s_prename"], $_POST["s_birth"], $_POST["gender"], $_POST["Kuerzel"], $_POST["Mail"], $_POST["status"]));
        }
        
        if(isset($_POST['pid_del']) && $_POST['pid_del'] != null){
            $db->deleteLehrer($db->selectLehrer($_POST['pid_del']));
            header('Location: '.$_SERVER['PHP_SELF']);
            die;
        }
        
        if(isset($_POST['class']) && isset($_POST['fach_bez']) && isset($_POST['fach_kur'])){
            //check if fach already exists
            //create class, fach and get teacher by lid
            $dbKurs = new dbKurs();
            $dbKlasse = new dbKlasse();
            $dbKursInstanz = new dbKursInstanz();
            $kurse = $dbKurs->selectAllKurse();
            $f_kurs;
            foreach($kurse as $kurs){
                if($kurs->getBezeichnung() == $_POST['fach_bez'] || $kurs->getKuerzel() == $_POST['fach_kur']){
                    $f_kurs = $kurs;
                }else{
                    $f_kurs = new kurs($_POST['fach_kur'], $_POST['fach_bez']);
                }
            }
            
            $f_klasse = $dbKlasse->selectKlasse($_POST['kid']);
            //$kursInstanz = new kursInstanz($this->lehrer, $f_klasse, $f_kurs);
            //$dbKursInstanz->insertInstanz($kursInstanz);
        }
    }
    
    public function getOutput(){
        $v =& $this;
        if(isset($_POST['pid'])){
            include($this->template_path."/detail/detail-lehrer.htm.php");
        }else{
            include($this->template_path."/liste/liste-lehrer.htm.php");
        }
    }
}
