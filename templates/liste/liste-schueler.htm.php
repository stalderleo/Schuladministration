<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
    <table class="tstacked">
        <thead>
            <tr>
                <th></th><th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Email</th><th>Telefon privat</th><th>Telefon gesch.</th>
            </tr>
        </thead>
        <tbody>
<?php $test = array(1,2,3,4,5); //replace with get_kontakte()
        foreach ( $test as $kontakt ):?>
            <tr>
                <td data-label="Löschen"><a href="<?php /*echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()*/?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                <td data-label="Name"><a href="#">f</a><?php /*echo $kontakt->getName()*/?></td>
                <td data-label="Vorname">f<?php /*echo $kontakt->getVorname()*/?></td>
                <td data-label="Strasse">f<?php /*echo $kontakt->getStrasse()*/?></td>
                <td data-label="PLZ">f<?php /*if(empty($kontakt->getPlz())) echo ""; else echo $kontakt->getPlz()*/?></td>
                <td data-label="Ort">f<?php /*echo $kontakt->getOrt()*/?></td>
                <td data-label="Email">f<?php /*echo $kontakt->getEmail()*/?></td>
                <td data-label="Telefon privat">f<?php /*echo $kontakt->getTpriv()*/?></td>
                <td data-label="Telefon gesch.">f<?php /*echo $kontakt->getTgesch()*/?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>