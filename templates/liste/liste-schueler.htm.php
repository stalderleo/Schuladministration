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
<?php
        foreach ( $v->schuelers as $s ): ?>
            
            <tr>
                <td data-label="Löschen"><a href="<?php echo $this->phpmodule?>&kid=<?php echo $s->getPid()?>"><img src="<?php echo config::IMAGE_PATH?>/delete.png" border=\"no\"></a>
                <td data-label="Name"><a href="#"></a><?php echo $s->getName()?></td>
                <td data-label="Vorname"><?php echo $s->getVorname()?></td>
                <td data-label="Strasse"><?php echo $s->getStrasse()?></td>
                <td data-label="PLZ"><?php if(empty($s->getPlz())) echo ""; else echo $s->getPlz()?></td>
                <td data-label="Ort"><?php echo $s->getOrt()?></td>
                <td data-label="Email"><?php echo $s->getEmail()?></td>
                <td data-label="Telefon privat"><?php echo $s->getTpriv()?></td>
                <td data-label="Telefon gesch."><?php echo $s->getTgesch()?></td>
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