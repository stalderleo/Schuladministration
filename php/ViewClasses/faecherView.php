<?php

/**
 * Class: facherView
 * 
 * UI Klasse für die Darstellung inform einer Liste von den Fächern.
 *
 * @author larschristian.berg
 */
require_once("interface.subcontroller.php");
require_once("HelperClasses/class.dbKurs.php");

class faecherView implements subcontroller {
    private $template_path;
    private $kurse;
    private $kurs;
    public $title;
    
    /**
     * Constructor
     * 
     * @param type $template_path Standort des Templates
     */
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Fächer";
    }

    public function run() {
        $db = new dbKurs();
        
        if(isset($_POST["safe"]) && !empty($_POST['f_kur']) && !empty($_POST['f_bez'])){
            $db->insertKursAI(new kurs($_POST['f_kur'], $_POST['f_bez']));
        }

        if(isset($_POST["fid_del"]) && $db->selectKurs($_POST["fid_del"]) instanceof kurs){
            $db->deleteKurs($db->selectKurs($_POST["fid_del"]));
        }

        if(isset($_POST["fid"])){
            $this->kurs = $db->selectKurs($_POST["fid"]);
        }
        
        if(isset($_GET["fid"])){
            $this->kurs = $db->selectKurs($_GET["fid"]);
        }
        
        if(isset($_POST["f_bez"]) && isset($_POST["f_kur"]) && $this->kurs instanceof kurs){
            $this->kurs->setBezeichnung($_POST["f_bez"]);
            $this->kurs->setKuerzel($_POST["f_kur"]);
            $db->modifyKurs($this->kurs);
        }

        $this->kurse = $db->selectAllKurse();

    }
    
    public function getOutput(){
        $v =& $this;
        if (isset($_POST["fid"])) {
            include($this->template_path."/update/update-kurs.htm.php");
        }else if(isset($_GET["fid"])){
            include($this->template_path."/detail/detail-kurs.htm.php");
        } else {
            include($this->template_path."/liste/liste-kurs.htm.php");
        }
    }
}
