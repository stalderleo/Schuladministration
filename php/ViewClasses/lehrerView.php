<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lehrerView
 *
 * @author larschristian.berg
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
    public function getKontaktListe(){
        //a person object should be returned here
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
        
        if(isset($_POST['pid_del']) && $_POST['pid_del'] != null){
            $db->deleteLehrer($db->selectLehrer($_POST['pid_del']));
            header('Location: '.$_SERVER['PHP_SELF']);
            die;
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
