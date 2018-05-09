<?php
require_once './DB.php';
require_once './DBTeacher.php';
DB::connect("schuladministration", "root", "");
$teacherDB = new DBTeacher();
echo "<script>console.log('Inside PHP')</script>";
foreach (simplexml_load_file("gibsso_AD-Export.xml")->lehrer as $lp) 
{
    echo $lp->username."<br>";

    $teacherDB->insertTeacher($lp->name, $lp->vorname, $lp->username, $lp->initpw, convertStringToDate( $lp->geburtsdatum ), $lp->geschlecht, $lp->kuerzel, $lp->mail, $lp->status);
}

function convertStringToDate( $string )
           {
               if( $string != null )
	               {
                   $time = strtotime($string);
                   return date('Y-m-d',$time);
               }

               return "";
           }

