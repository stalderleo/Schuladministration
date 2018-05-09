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
<?php $test = array(1,2,3); //replace with get_kontakte()
        foreach ( $test as $kontakt ):?>
            <tr>
                <td data-label="Löschen"><a href="<?php /*echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()*/?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                <td data-label="Name"><a href="#">f</a><?php /*echo $kontakt->getName()*/?></td>
                <td data-label="Vorname">f<?php /*echo $kontakt->getVorname()*/?></td>
                <td data-label="Strasse">f<?php /*echo $kontakt->getStrasse()*/?></td>
                <td data-label="PLZ">f<?php /*if(empty($kontakt->getPlz())) echo ""; else echo $kontakt->getPlz()*/?></td>
                <td data-label="Ort">f<?php /*echo $kontakt->getOrt()*/?></td>
                <td data-label="Email">f<?php /*echo $kontakt->getEmail()*/?></td>
                <td data-label="Telefon privat">f<?php /*echo $kontakt->getTpriv()*/?></td>
                <td data-label="Telefon gesch.">f<?php /*echo $kontakt->getTgesch()*/?></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>
    <div class="btn-container">
        <button title="Neuer Lehrer" data-toggle="modal" data-target="#teacher_modal" class="add"><i class="fas fa-plus"></i></button>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="teacher_modal" tabindex="-1" role="dialog" aria-labelledby="Teacher Modal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Teacher-Modal">Neuer Lehrer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form method="post" id="modal-form" >
                  <input type="text" placeholder="Name" name="t_name">
                  <input type="text" placeholder="E-mail" name="t_mail">

                  <?php //loop threw all fächer ?>
                  <?php //loop threw all classes ?>
              </form>
          </div>
          <div class="modal-footer">
            <button title="Neue Klasse" data-toggle="modal" data-target="#class_modal" class="add"><i class="fas fa-plus"></i></button>
            <button title="Neues Fach" data-toggle="modal" data-target="#subject_modal" class="add"><i class="fas fa-plus"></i></button>
            <span class="seperator"></span>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input form="modal-form" type="submit" class="btn btn-primary" value="Save changes">
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="class_modal" tabindex="-1" role="dialog" aria-labelledby="Class-Modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Class-Modal">Neue Klasse</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="post" id="modal-form-class" >
              <input type="text" placeholder="Name" name="class">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input form="modal-form-class" type="submit" class="btn btn-primary" value="Save changes">
      </div>
    </div>
  </div>
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