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
            <th>Name</th><th>Vorname</th><th>Email<i class="fal fa-expand-alt"></i></th><th>Kürzel</th><th></th><th></th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach ( $v->schuelers as $s ): ?>
            
        <tr>
                <td data-label="Name"><a href="#"></a><?php echo $s->getName()?></td>
                <td data-label="Vorname"><?php echo $s->getVorname()?></td>
                <td data-label="Email"><?php echo $s->getMail()?></td>
                <td data-label="Kuerzel"><?php echo $s->getKuerzel() ?></td>
            <?php echo $v->editEntry; ?>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="btn-container">
    <button title="Neuer Schüler" data-toggle="modal" data-target="#student_modal" class="add"><i class="fas fa-graduation-cap"></i></button>
</div>

<?php include $this->template_path.'/modals/modal-schueler.html'; ?>
<?php include $this->template_path.'/modals/modal-klasse.html'; ?>