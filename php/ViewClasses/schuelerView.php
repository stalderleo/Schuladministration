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
    public $title;
    public $editEntry;
    public function __construct( $template_path ) {
        $this->template_path = $template_path;
        $this->title = "Schüler";
        $this->editEntry = 
            '<td data-label="Löschen"><a title="Löschen" class="fullsize" href=""><img src="'.config::IMAGE_PATH.'/delete.png" border=\"no\"></a></td>
            <td data-label="Bearbeiten"><a title="Bearbeiten" class="fullsize" href="<?php /*echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()*/?>"><img src="'.config::IMAGE_PATH.'/edit.svg" border=\"no\"></a></td>';
    }

    public function run() {
        $db = new dbSchueler();
        
        $this->schuelers = $db->selectAllSchueler();
    }
    
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/liste/liste-schueler.htm.php");
    }
}
