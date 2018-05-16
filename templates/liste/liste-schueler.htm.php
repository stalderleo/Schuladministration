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
                <th>Name</th><th>Vorname</th><th>Strasse</th><th>PLZ</th><th>Ort</th><th>Email</th><th>Telefon privat</th><th>Telefon gesch.</th>
            </tr>
        </thead>
        <tbody>
<?php $test = array(1,2,3,4,5); //replace with get_kontakte()
        foreach ( $test as $kontakt ):?>
            <tr>
                <td data-label="Name"><a href="#">f</a><?php /*echo $kontakt->getName()*/?></td>
                <td data-label="Vorname">f<?php /*echo $kontakt->getVorname()*/?></td>
                <td data-label="Strasse">f<?php /*echo $kontakt->getStrasse()*/?></td>
                <td data-label="PLZ">f<?php /*if(empty($kontakt->getPlz())) echo ""; else echo $kontakt->getPlz()*/?></td>
                <td data-label="Ort">f<?php /*echo $kontakt->getOrt()*/?></td>
                <td data-label="Email">f<?php /*echo $kontakt->getEmail()*/?></td>
                <td data-label="Telefon privat">f<?php /*echo $kontakt->getTpriv()*/?></td>
                <td data-label="Telefon gesch.">f<?php /*echo $kontakt->getTgesch()*/?></td>
                <td data-label="Löschen"><a title="Löschen" class="fullsize" href="<?php /*echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()*/?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a></td>
                <td data-label="Bearbeiten"><a title="Bearbeiten" class="fullsize" href="<?php /*echo $this->phpmodule?>&kid=<?php echo $kontakt->getKid()*/?>"><img src="<?php echo config::IMAGE_PATH?>/edit.svg" border=\"no\"></a></td>
            </tr>
<?php endforeach; ?>
        </tbody>
    </table>

    <div class="btn-container">
        <button title="Neuer Schüler" data-toggle="modal" data-target="#student_modal" class="add"><i class="fas fa-graduation-cap"></i></button>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="student_modal" tabindex="-1" role="dialog" aria-labelledby="Schüler-Modal" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="Schüler-Modal">Neuer Schüler</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form method="post" id="modal-form">
                  <input type="text" placeholder="Benutzername" name="s_username" value="">
                  <input type="text" placeholder="Passwort" name="s_pw" value="">
                  <input type="text" placeholder="Name" name="s_name" value="">
                  <input type="text" placeholder="Vorname" name="s_prename" value="">
                  <input type="text" placeholder="Geburtstag" name="s_birth" value="">
                  <select name="gender">
                      <option value="m">Männlich</option>
                      <option value="f">Weiblich</option>
                      <option value="u">Anderes</option>
                  </select>
                  <input type="text" placeholder="Kuerzel" name="" value="">
                  <input type="text" placeholder="Mail" name="" value="">
                  <select name="status">
                      <option value="LD">Ledig</option>
                      <option value=VH">Verheiratet</option>
                      <option value="VW">Verwitwet</option>
                      <option value="GS">Geschieden</option>
                      <option value="EA">Ehe aufgehoben</option>
                      <option value="LP">Eingetragene Partnerschaft</option>
                      <option value="NB">Nicht Bekannt</option>
                  </select>

                  <?php //loop threw all fächer ?>
              </form>
          </div>
          <div class="modal-footer">
            <button title="Neue Klasse" data-toggle="modal" data-target="#class_modal" class="add"><i class="fas fa-users"></i></button>
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
              <form method="post" name="class" id="modal-form-class" >
          
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input form="modal-form-class" type="submit" class="btn btn-primary" value="Save changes">
          </div>
        </div>
      </div>
    </div>