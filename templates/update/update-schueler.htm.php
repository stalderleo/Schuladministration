<?php 
?>

<form method="post">
    <label>Benutzername
        <input type="text" name="p_username" value="<?= $v->schueler->getUsername()?>"></label>
    <label>Passwort
        <input type="password" name="p_password" placeholder="***" value=""></label>
    <label>Name
        <input type="text" name="p_name" value="<?= $v->schueler->getName()?>"></label>
    <label>Vorname
        <input type="text" name="p_vorname" value="<?= $v->schueler->getVorname()?>"></label>
    <label>Geburtstag
      <input type="text" name="p_bday" value="<?= $v->schueler->getGeburtstag()?>"></label>
    <label>Gender
        <select required name="p_geschlecht">
          <option value="m">Männlich</option>
          <option value="w" <?php if($v->schueler->getGeschlecht() == "w"){echo "selected"; } ?>>Weiblich</option>
          <option value="u">Anderes</option>
        </select></label>
    <label>E-Mail
        <input type="mail" name="p_mail" value="<?= $v->schueler->getMail()?>"></label>
    <label>Kürzel
        <input type="text" name="p_kuerzel" value="<?= $v->schueler->getKuerzel()?>"></label>
    <label>Status
        <select name="p_status">
          <option value="1">Aktiv</option>
          <option value="0" <?php if($v->schueler->getStatus() == "0"){echo "selected"; } ?>>Inaktiv</option>
        </select>
    </label>
    <label>Klasse
        <select disabled name="class">
        <?php
          foreach($v->klassen as $klasse){
            ?>
            <option value=<?php echo '"'.$klasse->getKid().'"'; if($v->getKlassenBesuch()['kid'] == $klasse->getKid()){echo "selected";} ?>><?= $klasse->getBezeichnung() ?></option>
            <?php
          }
        ?>
        </select>
        <div class="hidden-button"><i class="fas fa-edit"></i><input form="edit_klasse" type="submit" name="kid" value="<?= $v->getKlassenBesuch()['kid'] ?>"></div>
    </label>
    <?php
    if($v->getKlassenBesuch()['isZweitklasse']){
        ?>
        <label>Zweitausbildung Klasse
            <select disabled name="z_class">
            <?php
              foreach($v->klassen as $klasse){
                ?>
                <option value=<?php echo '"'.$klasse->getKid().'"'; if($v->getKlassenBesuch()['z_kid'] == $klasse->getKid()){echo "selected";} ?>><?= $klasse->getBezeichnung() ?></option>
                <?php
              }
            ?>
            </select>
            <div class="hidden-button"><i class="fas fa-edit"></i><input form="edit_klasse" type="submit" name="kid" value="<?= $v->getKlassenBesuch()['z_kid'] ?>"></div>
        </label>
        <?php
    }?>
    <input type="hidden" name="pid" value="<?= $v->schueler->getPid() ?>">
    <input type="submit" class="btn" value="Speichern" name="setSchueler">
</form>

<form class="edit" id="edit_klasse" action="<?php echo $_SERVER['SCRIPT_NAME']."?id=klasseView" ?>" method="post"></form>
