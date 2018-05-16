<?php
require_once("interface.subcontroller.php");

/**
 * Gibt das aktuelle Datum aus
 */
class importData implements subcontroller {
    
    // Assoziativer Array mit Parametern (Ueblicherweise $_REQUEST)
    private $params = NULL;
    
    //DB-Klassen
    private $dbLehrer = NULL; 
    private $dbKurs = NULL;
    private $dbKursinstanz = NULL;
    private $dbSchueler = NULL;
    private $dbKlasse = NULL;
    private $dbKlassenBesuch = NULL;
    private $dbAngestellte = NULL;
	
    // Pfad zum Template-Verzeichnis
    private $template_path = "";
    
    public function __construct( $template_path ) {
        $this->params = $_REQUEST;
        $this->template_path = $template_path;
        $this-> dbLehrer = new dbLehrperson();
        $this-> dbKurs = new dbKurs();
        $this-> dbKursinstanz = new dbKursInstanz();
        $this-> dbSchueler = new dbSchueler();
        $this-> dbKlasse = new dbKlasse();
        $this-> dbKlassenBesuch = new dbKlassenBesuch();
        $this-> dbAngestellte = new dbAngestellter();
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
        $logstr = date('m.d.Y h:i:s a', time()). ": Import started"."<hr>\n";
        $xml = simplexml_load_file($target);
        foreach ($xml->lehrer as $lp) {   
            $lehrer = $this->dbLehrer->insertLehrer(new lehrer(str_replace('gibsso','',$lp->id), $lp->username, $lp->initpw, $lp->name, $lp->vorname, convertStringToDate($lp->geburtsdatum), $lp->geschlecht, $lp->kuerzel, $lp->mail, $lp->status));
            if (!empty($lehrer)) {
                $logstr .= date('m.d.Y h:i:s a', time()). ": Lehrer (".$lehrer->getPid().") inserted"."<hr>\n";
            } else {
                $logstr .= date('m.d.Y h:i:s a', time()). ": Lehrer ($lp->id) insert failed"."<hr>\n";
            }
            
            //Klassen des Lehrers einfügen
            foreach ($lp->regelklassen->klasse as $klasse) {
                $klasse = $this->dbKlasse->insertKlasse(new klasse($klasse->klasse_kuerzel, $klasse->klasse_bezeichnung));
                if (!empty($klasse)) {
                    $logstr .= date('m.d.Y h:i:s a', time()). ": Klasse (".$lehrer->getKid().") inserted"."<hr>\n";
                } else {
                    $logstr .= date('m.d.Y h:i:s a', time()). ": Klasse ($klasse->klasse_kuerzel) insert failed"."<hr>\n";
                }
            }
            
            foreach ($lp->kurse->kurs as $kurs) {
                if (strpos($kurs->kurs_kuerzel, ',') !== false) { 
                    $kuerzelstr = explode('-', $kurs->kurs_kuerzel)[1]; //Mittlerer Teil nehmen
                    
                    $klassenkuerzelarr = explode(',', $kuerzelstr);
                    foreach ($klassenkuerzelarr as $klassenkuerzel) {
                        $klasse = $dbKlasse->selectKlasseByKuerzel($klassenkuerzel);
                        if (empty($klasse)) {
                            $logstr .= date('m.d.Y h:i:s a', time()). ": failed finding klass (".$klassenkuerzel.")"."<hr>\n";
                        }
                        
                        $kurs = $this->dbKurs->insertKurs(new kurs($kurs->kurs_kuerzel, $kurs->kurs_bezeichnung));
                        if (!empty($kurs)) {
                            $logstr .= date('m.d.Y h:i:s a', time()). ": Kurs (".$kurs->getFid().") inserted"."<hr>\n";
                        } else {
                            $logstr .= date('m.d.Y h:i:s a', time()). ": Kurs ($kurs->kurs_kuerzel) insert failed"."<hr>\n";
                        }
                                
                        $kursinstanz = $this->dbKursinstanz->insertInstanz(new kursInstanz($lehrer, $klasse, $kurs));
                        
                        if (!empty($kursinstanz)) {
                            $logstr .= date('m.d.Y h:i:s a', time()). ": Kursinstanz (".$kursinstanz->getLehrer()->getPid().", ".$kursinstanz->getKlasse()->getKid().", ".$kursinstanz->getKurs()->getFid().") inserted"."<hr>\n";
                        } else {
                            $logstr .= date('m.d.Y h:i:s a', time()). ": Kursinstanz ($klasse->klasse_kuerzel) insert failed"."<hr>\n";
                        }
                    }
                }
            } 
        }
        
        foreach ($xml->schueler as $sl) {
            $schueler = $this->dbSchueler->insertsl(new schueler(str_replace('gibsso','',$sl->id), $sl->username, $sl->initpw, $sl->name, $sl->vorname, convertStringToDate($sl->geburtsdatum), $sl->geschlecht, $sl->kuerzel, $sl->mail, $sl->status));
            
            if (!empty($schueler)) {
                $logstr .= date('m.d.Y h:i:s a', time()). ": Schueler (".$schueler->getPid().", ".$kursinstanz->getKlasse()->getKid().", ".$kursinstanz->getKurs()->getFid().") inserted"."<hr>\n";
            } else {
                $logstr .= date('m.d.Y h:i:s a', time()). ": Schueler ($sl->id) insert failed"."<hr>\n";
            }
            
            $klasse = $this->dbKlasse->selectKlasseByKuerzel($sl->profile->profil->ausbildung_kuerzel);
            if (empty($klasse)) {
                $logstr .= date('m.d.Y h:i:s a', time()). ": failed finding klass (".$sl->profile->profil->ausbildung_kuerzel.")"."<hr>\n";
            }
            $this->dbKlassenBesuch->insertBesuch(new klassenBesuch($schueler, $klasse, false));
            
            if (isset($sl->profile->profil->zweitausbildung_kuerzel)) {
                $klasse = $this->dbKlasse->selectKlasseByKuerzel($sl->profile->profil->zweitausbildung_kuerzel);
                if (empty($klasse)) {
                    $logstr .= date('m.d.Y h:i:s a', time()). ": failed finding zweitausbildungklass (".$sl->profile->profil->zweitausbildung_kuerzel.")"."<hr>\n";
                }
                $this->dbKlassenBesuch->insertBesuch(new klassenBesuch($schueler, $klasse, true));
            }
        }
        
        foreach ($xml->angestellte as $ag) {
            $angestellter = $this->dbAngestellte->insertAngestellter(new angestellter(str_replace('gibsso','',$ag->id), $ag->username, $ag->initpw, $ag->name, $ag->vorname, convertStringToDate($ag->geburtsdatum), $ag->geschlecht, $ag->kuerzel, $ag->mail, $ag->status));
            if (!empty($angestellter)) {
                $logstr .= date('m.d.Y h:i:s a', time()). ": Angestellter (".$angestellter->getPid().") inserted"."<hr>\n";
            } else {
                $logstr .= date('m.d.Y h:i:s a', time()). ": Angestellter ($ag->id) insert failed"."<hr>\n";
            }
        }
        
        //Logfile schreiben
        $handle = fopen ( "../res/data/log.txt", "a" );
        fwrite ( $handle, $logstr );
        fclose ( $handle );
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
