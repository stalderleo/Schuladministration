<!--
 * @author Leo Stalder
 * @date 2. Mai 2018
 *
 * Template für den Datenimport
 *
-->
<form enctype="multipart/form-data" action="<?php echo $_SERVER['SCRIPT_NAME']."?id=importView" ?>" method="post" id="importDataForm">
    <div class="form-group">
        <label for="dataExport">Laden Sie ein File hoch:</label>
        <input type="file" class="form-control-file" name="dataExport" id="dataExport">
        <input name="submit" type="submit" value="Hochladen">
    </div>
</form>
