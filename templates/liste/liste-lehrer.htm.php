<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="table-container dragscroll">
<table class="table tstacked">
    <thead>
        <tr>
            <th>Name</th><th>Vorname</th><th>Email<i title="Vergrössern/Verkleinern" data-extend class="fas fa-expand"></th><th>Kürzel</th><th></th><th></th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach ( $v->lehrers as $l ): ?>
            
            <tr>
                <td data-label="Name"><a href="#"></a><?php echo $l->getName()?></td>
                <td data-label="Vorname"><?php echo $l->getVorname()?></td>
                <td data-label="Email" class="downsize"><?php echo $l->getMail()?></td>
                <td data-label="Kuerzel"><?php echo $l->getKuerzel() ?></td>
            <?php echo $v->editEntry; ?>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="btn-container">
    <button title="Neuer Lehrer" data-toggle="modal" data-target="#teacher_modal" class="add"><i class="fas fa-chalkboard-teacher"></i></button>
</div>

<?php include $this->template_path.'/modals/modal-lehrer.html'; ?>
<?php include $this->template_path.'/modals/modal-fach.html'; ?>
<?php include $this->template_path.'/modals/modal-klasse.html'; ?>