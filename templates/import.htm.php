<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div class="col-sm-12 offset-sm-0 card upload-card">
    <p class="upload-card__text">Import Datei Wählen</p>
    <form method="post" id="import-form" enctype="multipart/form-data">
    <input type="file" name="import">
    </form>
</div>
<input form="import-form" class="btn" value="Importieren" type="submit">