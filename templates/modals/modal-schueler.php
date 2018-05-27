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
              <form action="<?php echo $_SERVER['SCRIPT_NAME']."?id=schuelerView" ?>" method="post" id="modal-form">
                  <input required type="text" placeholder="Benutzername" name="s_username" value="">
                  <input required type="password" placeholder="Passwort" name="s_pw" value="">
                  <input required type="text" placeholder="Name" name="s_name" value="">
                  <input required type="text" placeholder="Vorname" name="s_prename" value="">
                  <input required type="text" placeholder="Geburtstag" name="s_birth" value="">
                  <select required name="s_gender">
                      <option value="m">Männlich</option>
                      <option value="f">Weiblich</option>
                      <option value="u">Anderes</option>
                  </select>
                  <input required type="text" placeholder="Kuerzel" name="s_kuerzel" value="">
                  <input required type="email" placeholder="Mail" name="s_mail" value="">
                  <select required name="s_status">
                      <option value="1">Aktiv</option>
                      <option value="0">Inaktiv</option>
                  </select>

                  <select required name="s_class">
                    <?php
                      foreach($v->klassen as $klasse){
                        ?>
                        <option value="<?= $klasse->getKid() ?>"><?= $klasse->getBezeichnung() ?></option>
                        <?php
                      }
                    ?>
                  </select>
              </form>
          </div>
          <div class="modal-footer">
            <span class="seperator"></span>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input form="modal-form-schueler" type="submit" name="safe" class="btn btn-primary" value="Save changes">
          </div>
        </div>
      </div>
    </div>
