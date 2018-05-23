<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="table-container">
<table class="table tstacked">
        <thead>
            <tr>
                <th>Bezeichnung</th><th>Kürzel</th><th></th><th></th>
            </tr>
        </thead>
        
        <tbody>
<?php foreach ( $v->klassen as $klasse ): ?>
            <tr>
                <td><a href="#<?php echo $klasse->getKid() ?>"><?= $klasse->getBezeichnung() ?></td>
                <td><?= $klasse->getKuerzel() ?></td>
                <?php echo $v->editEntry; ?>
            </tr>
<?php endforeach; ?>
       </tbody>
</table>
</div>
<div class="btn-container">
    <button title="Neue Klasse" data-toggle="modal" data-target="#class_modal" class="add"><i class="fas fa-users"></i></button>
</div>

<?php include $this->template_path.'/modals/modal-klasse.html'; ?>