<form method="post">
    <label>Bezeichnung
    <input type="text" name="f_bez" value="<?= $v->kurs->getBezeichnung(); ?>"></label>
    <label>Kürzel
    <input type="text" name="f_kur" value="<?= $v->kurs->getKuerzel(); ?>"></label>
    <input type="hidden" name="fid" value="<?= $v->kurs->getFid() ?>">
    <input type="submit" class="btn"value="Speichern" name="setKurs">
</form>
