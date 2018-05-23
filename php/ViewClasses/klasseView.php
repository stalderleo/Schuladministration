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

class klasseView implements subcontroller {
    //put your code here
    private $template_path;
    private $klassen = array();
    public $title;
    public $editEntry;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Klasse";
        $this->editEntry = 
            '<td data-label="Löschen"><a title="Löschen" class="fullsize" href="'.$this->phpmodule.'&kid="><img src="'.config::IMAGE_PATH.'/delete.png" border=\"no\"></a></td>
            <td data-label="Bearbeiten"><a title="Bearbeiten" class="fullsize" href="'.$this->phpmodule.'&kid="><img src="'.config::IMAGE_PATH.'/edit.svg" border=\"no\"></a></td>';
    }
    
    public function run() {
        $db = new dbKlasse();
        
        $this->klassen = $db->selectAllKlassen();
        
        if(isset($_POST["safe"]))
        {
            $db->insertKlasseAI(new klasse($_POST["k_ku"], $_POST["k_bez"]));
        }
    }
    
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/liste/liste-klasse.htm.php");
    }
}
