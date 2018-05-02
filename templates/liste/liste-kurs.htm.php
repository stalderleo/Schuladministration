<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<ul class="">
<?php $faecher = array('Math', 'Englisch', 'Physik', 'Französisch');//replace with real fächer (name/url)?>
<?php foreach ( /*$this->data->getKontaktListe() --> getFaecher*/$faecher as $fach ): ?>
                <li><a href="#"><?= $fach ?></a></li>
<?php endforeach; ?>
</ul>