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
          <form action="<?php echo $_SERVER['SCRIPT_NAME']."?id=klasseView" ?>" id="modal-form-class" method="post">
              <input type="text" placeholder="Bezeichnung" name="k_bez">
              <input type="text" placeholder="Kürzel" name="k_ku">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input form="modal-form-class" type="submit" name="safe" class="btn btn-primary" value="Save changes">
      </div>
    </div>
  </div>
</div>