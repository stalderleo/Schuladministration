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
                <th></th><th>Bezeichnung</th><th>Kürzel</th>
            </tr>
        </thead>
        
        <tbody>
<?php foreach ( $v->klassen as $klasse ): ?>
            <tr>
                <td><a href="#<?php echo $klasse->getKid() ?>"><?= $klasse->getBezeichnung() ?></td>
                <td><?= $klasse->getKuerzel() ?></td>
            </tr>
<?php endforeach; ?>
       </tbody>
</table>