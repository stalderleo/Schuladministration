<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<ul class="">
<?php foreach ( $v->kurse as $fach ): ?>
                <li><a href="#<?php $fach->getFid() ?>"><?= $fach->getBezeichnung() ?></a></li>
<?php endforeach; ?>
</ul>