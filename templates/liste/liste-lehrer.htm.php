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
<?php
        foreach ( $v->lehrers as $l ): ?>
            
            <tr>
                <td data-label="Löschen"><a href="<?php echo $this->phpmodule?>&kid=<?php echo $l->getPid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                <td data-label="Name"><a href="#">f</a><?php echo $l->getName()?></td>
                <td data-label="Vorname">f<?php echo $l->getVorname()?></td>
                <td data-label="Strasse">f<?php echo $l->getStrasse()?></td>
                <td data-label="PLZ">f<?php if(empty($l->getPlz())) echo ""; else echo $l->getPlz()?></td>
                <td data-label="Ort">f<?php echo $l->getOrt()?></td>
                <td data-label="Email">f<?php echo $l->getEmail()?></td>
                <td data-label="Telefon privat">f<?php echo $l->getTpriv()?></td>
                <td data-label="Telefon gesch.">f<?php echo $l->getTgesch()?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>