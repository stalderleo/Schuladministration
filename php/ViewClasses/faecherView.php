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
        
        $this->kurse =  $db->selectAllKurse();
        
        if(isset($_POST["safe"]))
        {
            //$db->insertKursAI(new kurs($kuerzel, $bezeichnung))
        }
    }
    
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/liste/liste-kurs.htm.php");
    }
}
