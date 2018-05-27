<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of schuelerView
 *
 * @author larschristian.berg
 */
require_once("interface.subcontroller.php");
require_once("HelperClasses/class.dbSchueler.php");

class schuelerView implements subcontroller {
    //put your code here
    private $template_path;
    private $schuelers = array();
    private $schueler;
    private $klassen;
    private $KlassenBesuch = array();
    public $title;
    
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Schüler";
    }

    public function run() {
        $db = new dbSchueler();
        $dbKlasse = new dbKlasse();

        $this->klassen = $dbKlasse->selectAllKlassen();
        
        if(isset($_POST['pid'])){
            $this->schueler = $db->selectSchueler($_POST['pid']);
            $dbKlassenBesuch = new dbKlassenBesuch();
            if(count($dbKlassenBesuch->selectBesucheBySchueler( $this->schueler)) == 1){
                $this->KlassenBesuch['isZweitklasse'] = false;
                $this->KlassenBesuch['kid'] = $dbKlassenBesuch->selectBesucheBySchueler( $this->schueler)[0]->getKlasse()->getKid();
            }else{
                $this->KlassenBesuch['isZweitklasse'] = true;
                $this->KlassenBesuch['kid'] = $dbKlassenBesuch->selectBesucheBySchueler( $this->schueler)[0]->getKlasse()->getKid();
                $this->KlassenBesuch['z_kid'] = $dbKlassenBesuch->selectBesucheBySchueler( $this->schueler)[1]->getKlasse()->getKid();
            }
        }
        
        if(isset($_POST['setSchueler']) && $this->schueler instanceof schueler && $this->schueler != NULL){

            if(!empty($_POST['p_usename'])){
                $this->schueler->setUsername($_POST['p_username']);
            }
            if(!empty($_POST['p_password'])){
                $this->schueler->setPassword($_POST['p_password']);
            }
            if(!empty($_POST['p_name'])){
                $this->schueler->setName($_POST['p_name']);
            }
            if(!empty($_POST['p_vorname'])){
                $this->schueler->setVorname($_POST['p_vorname']);
            }
            if(!empty($_POST['p_bday'])){
                $this->schueler->setGeburtstag($_POST['p_bday']);
            }
            if(!empty($_POST['p_geschlecht'])){
                $this->schueler->setGeschlecht($_POST['p_geschlecht']);
            }
            if(!empty($_POST['p_mail'])){
                $this->schueler->setMail($_POST['p_mail']);
            }
            if(!empty($_POST['p_kuerzel'])){
                $this->schueler->setKuerzel($_POST['p_kuerzel']);
            }
            if(!empty($_POST['p_status'])){
                $this->schueler->setStatus($_POST['p_status']);
            }

            $db->modifySchueler($this->schueler);
        }
        
        if(isset($_POST["safe"])){
            $db->insertSchuelerAI(new schueler(null, $_POST["s_username"], $_POST["s_pw"], $_POST["s_name"], $_POST["s_prename"], $_POST["s_birth"], $_POST["s_gender"], $_POST["s_kuerzel"], $_POST["s_mail"], $_POST["s_status"]));
        }

        
        if(isset($_POST['pid_del']) && $db->selectSchueler($_POST['pid_del']) instanceof schueler){
            $db->deleteSchueler($db->selectSchueler($_POST['pid_del']));
            header('Location: '.$_SERVER['PHP_SELF'].'?id=schuelerView');
            die;
        }

        $this->schuelers = $db->selectAllSchueler();

    }
    
    private function getKlassenBesuch(){
        return $this->KlassenBesuch;
    }

    public function getOutput(){
        $v =& $this;
        if(isset($_POST['pid'])){
            include($this->template_path."/detail/detail-schueler.htm.php");
        }else{
            include($this->template_path."/liste/liste-schueler.htm.php");
        }
        
    }
}