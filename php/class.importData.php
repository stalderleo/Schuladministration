<?php
require_once("interface.subcontroller.php");

/**
 * Gibt das aktuelle Datum aus
 */
class importData implements subcontroller {
    
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
	
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    public function __construct( $template_path ) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
    }

    public function run() {
        if (isset($this->params['submit'])) {
            $target="../res/data/".$_FILES['dataExport']['name'];
            
            // Check if file already exists
            if (file_exists($_FILES['dataExport']['tmp_name'])) {
                die("Sorry, File exestiert bereits.");
            }
            
            // Allow certain file formats
            if(strtolower(pathinfo($_FILES['dataExport']['tmp_name'],PATHINFO_EXTENSION)) != "xml") {
                die ("Sorry, Nur XML-Datei sind zugelassen");
            }
            
            //File hochladen
            if (!move_uploaded_file($_FILES['dataExport']['tmp_name'], $target) ) die("copy nicht erfolgreich in upload.php!");
            else {
                insertIntoDB($target);
            }
        }
        
    }

    public function getOutput(){
        $v =& $this;
        include($this->template_path."/"."dataimport.htm.php");
    }
    
    private function insertIntoDB($target) {
        $xml = simplexml_load_file($target);
        foreach ($xml->lehrer as $lp) 
        {
            echo $lp->username."<br>";
            $teacherDB->insertTeacher($lp->name, $lp->vorname, $lp->username, $lp->initpw, convertStringToDate( $lp->geburtsdatum ), $lp->geschlecht, $lp->kuerzel, $lp->mail, $lp->status);
        }
    }
    
    function convertStringToDate( $string )
    {
        if( $string != null ) {
            $time = strtotime($string);
            return date('Y-m-d',$time);
        }

        return "";
    }
}
