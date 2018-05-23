<?php

/**
 * Klasse für die Darstellung aller Schüler in einer Liste.
 * 
 * @autor Aaron Studer
 * @date 23. May 2018
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
            '<td data-label="Löschen"><a title="Löschen" class="fullsize" href="<?php echo $this->phpmodule?>&pid=<?php echo $s->getPid()?>"><img src="'.config::IMAGE_PATH.'/delete.png" border=\"no\"></a></td>
            <td data-label="Bearbeiten"><a title="Bearbeiten" class="fullsize" href="<?php echo $this->phpmodule?>&pid=<?php echo $s->getPid()?>"><img src="'.config::IMAGE_PATH.'/edit.svg" border=\"no\"></a></td>';
    }

    public function run() {
        $db = new dbSchueler();
        
        $this->schuelers = $db->selectAllSchueler();
        
        if(isset($_POST["safe"]))
        {
            $db->insertSchuelerAI(new schueler(null, $_POST["s_username"], $_POST["s_pw"], $_POST["s_name"], $_POST["s_prename"], $_POST["s_birth"], $_POST["gender"], $_POST["Kuerzel"], $_POST["Mail"], $_POST["status"]));
        }
    }
    
    public function getOutput(){
        $v =& $this;
        include($this->template_path."/liste/liste-schueler.htm.php");
    }
}
