<!-- Modal -->
<form action="<?php echo $_SERVER['SCRIPT_NAME']."?id=lehrerView" ?>" method="post">
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
              </form>
          </div>
          <div class="modal-footer">
            <span class="seperator"></span>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input form="modal-form" type="submit" name="safe" class="btn btn-primary" value="Save changes">
          </div>
        </div>
      </div>
    </div>
</form>