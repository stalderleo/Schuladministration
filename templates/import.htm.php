<!--
 * @author Leo Stalder
 * @date 2. Mai 2018
 *
 * Template für den Datenimport
 *
-->

<div class="col-sm-12 offset-sm-0 card upload-card">
    <form enctype="multipart/form-data" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>?id=importView" method="post" id="importDataForm">
        <div class="form-group">
            <label for="dataExport">Laden Sie ein File hoch:</label>
            <input type="file" class="form-control-file" name="dataExport" id="dataExport">
        </div>
    </form>
</div> 
<input name="submit" form="importDataForm" type="submit" value="Hochladen">