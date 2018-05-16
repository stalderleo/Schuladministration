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
<div class="btn-container">
    <button title="Neues Fach" data-toggle="modal" data-target="#subject_modal" class="add"><i class="fas fa-notes-medical"></i></button>
</div>

<?php include $this->template_path.'/modals/modal-fach.html'; ?>