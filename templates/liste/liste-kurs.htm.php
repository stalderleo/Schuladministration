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
<div class="btn-container">
    <button title="Neues Fach" data-toggle="modal" data-target="#subject_modal" class="add"><i class="fas fa-plus"></i></button>
</div>
<!-- Modal -->
<div class="modal fade" id="subject_modal" tabindex="-1" role="dialog" aria-labelledby="Subject-Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Subject-Modal">Neues Fach</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="modal-form-subject" >
            <input type="text" placeholder="Fach" name="subject">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input form="modal-form-subject" type="submit" class="btn btn-primary" value="Save changes">
      </div>
    </div>
  </div>
</div>