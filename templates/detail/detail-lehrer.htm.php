<?php 
?>

<form method="post">
    <label>Name
    <input type="text" name="p_name" value="<?= $v->lehrer->getName()?>"></label>
    <label>Vorname
    <input type="text" name="p_vorname" value="<?= $v->lehrer->getVorname()?>"></label>
    <label>Geburtstag
    <input type="text" name="p_bday" value="<?= $v->lehrer->getGeburtstag()?>"></label>
    <label>Gender
    <input type="text" name="p_geschlecht" value="<?= $v->lehrer->getGeschlecht()?>"></label>
    <label>E-Mail
    <input type="text" name="p_mail" value="<?= $v->lehrer->getMail()?>"></label>
    <label>Kürzel
    <input type="text" name="p_kuerzel" value="<?= $v->lehrer->getKuerzel()?>"></label>
    <label>Status
    <input type="text" name="p_status" value="<?= $v->lehrer->getStatus()?>"></label>
    <input type="hidden" name="pid" value="<?= $v->lehrer->getPid() ?>">
    <input type="submit" value="Speichern" name="setLehrer">
</form>

<div class="">
    <?php
    $dbKlasse = new dbKlasse();
    var_dump($dbKlasse);
    $klassen = $dbKlasse->selectAllKlassen();
    foreach($klassen as $klasse){
        var_dump($klasse);
    }
    ?>
</div>