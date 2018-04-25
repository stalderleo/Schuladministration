<?php

/*
 * @autor Daniel Mosimann.
 * @date 21. November 2016
 * 
 * Stellt grundlegende Funktionen zur Verf�gung.
 */
class basic {
   /**
    * Pr�ft ob eine Emailadresse korrekt ist oder nicht.
    *
    * @param   $value      Eingabewert
    * @param   $empty      Die Email-Adresse kann leer sein ('Y') oder nicht ('N')
    * @return              true: Die Pr�fung war erfolgreich - false: Die Pr�fung war nicht erfolgreich
    */
    public static function CheckEmail( $value, $empty='N' ) {
        $pattern_email = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';
        if ($empty=='Y' && empty($value)) return true;
        if ( preg_match($pattern_email, $value) ) return true;
        else return false;
    }
    
    /**
    * Pr�ft ob eine Name (Nachname, Vorname) korrekt ist oder nicht.
    * Erlaubt sind die Zeichen in den eckigen Klammern, mit einer L�nge
    * von mindestens 2 Zeichen.
    *
    * @param   $value      Eingabewert
    * @param   $empty      Der Name kann leer sein ('Y') oder nicht ('N')
    * @return              true: Die Pr�fung war erfolgreich - false: Die Pr�fung war nicht erfolgreich
    */
    public static function CheckName( $value, $empty='N' ) {
        $pattern_name = '/^[a-zA-Z������ \-]{2,}$/';
        if ($empty=='Y' && empty($value)) return true;
        if ( preg_match($pattern_name, $value) ) return true;
        else return false;
    }
    
}

?>
