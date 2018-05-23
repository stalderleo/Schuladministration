<!--
 * @author Leo Stalder
 * @date 2. Mai 2018
 *
 * Template für den Datenimport
 *
-->

<div class="col-sm-12 offset-sm-0 card upload-card">
    <p class="upload-card__text">Import Datei Wählen</p>
    <form method="post" id="import-form" enctype="multipart/form-data">
        <input type="file" name="import">
        <input form="import-form" class="btn" value="Importieren" type="submit">
    </form>
</div>
