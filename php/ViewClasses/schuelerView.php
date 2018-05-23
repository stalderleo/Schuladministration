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
    public $title;
    
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Schüler";
    }

    public function run() {
        $db = new dbSchueler();
        
        $this->schuelers = $db->selectAllSchueler();
        
        if(isset($_POST['pid'])){
            $this->schueler = $db->selectSchueler($_POST['pid']);
        }
        
        if(isset($_POST['setSchueler']) && $this->schueler instanceof schueler && $this->schueler != NULL){
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
        }
        
        if(isset($_POST['pid_del']) && $_POST['pid_del'] != null){
            $db->deleteSchueler($db->selectSchueler($_POST['pid_del']));
            header('Location: '.$_SERVER['PHP_SELF']);
            die;
        }
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
