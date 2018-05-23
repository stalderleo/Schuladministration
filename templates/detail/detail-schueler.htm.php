<?php 
?>

<form method="post">
    <label>Name
    <input type="text" name="p_name" value="<?= $v->schueler->getName()?>"></label>
    <label>Vorname
    <input type="text" name="p_vorname" value="<?= $v->schueler->getVorname()?>"></label>
    <label>Geburtstag
    <input type="text" name="p_bday" value="<?= $v->schueler->getGeburtstag()?>"></label>
    <label>Gender
    <input type="text" name="p_geschlecht" value="<?= $v->schueler->getGeschlecht()?>"></label>
    <label>E-Mail
    <input type="text" name="p_mail" value="<?= $v->schueler->getMail()?>"></label>
    <label>Kürzel
    <input type="text" name="p_kuerzel" value="<?= $v->schueler->getKuerzel()?>"></label>
    <label>Status
    <input type="text" name="p_status" value="<?= $v->schueler->getStatus()?>"></label>
    <input type="hidden" name="pid" value="<?= $v->schueler->getPid() ?>">
    <input type="submit" value="Speichern" name="setSchueler">
</form>