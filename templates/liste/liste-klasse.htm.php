<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<ul class="">
<?php foreach ( $v->klassen as $klasse ): ?>
                <li><a href="#<?php echo $klasse->getKid() ?>"><?= $klasse->getBezeichnung() ?></a></li>
                <li><?= $klasse->getKuerzel() ?></li>
<?php endforeach; ?>
</ul>