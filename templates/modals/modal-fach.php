<!-- Modal -->
<form action="<?php echo $_SERVER['SCRIPT_NAME']."?id=faecherView" ?>" method="post">
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
            <input form="modal-form-subject" type="submit" name="safe" class="btn btn-primary" value="Save changes">
          </div>
        </div>
      </div>
    </div>
</form>