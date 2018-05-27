<?php 
?>
    <label class="detail-row">Name
        <label type="text" class="detail-row-float" name="p_name" value=""><?= $v->schueler->getName()?></label></label><br>
    <label class="detail-row">Vorname
        <label type="text" name="p_vorname" class="detail-row-float" value=""><?= $v->schueler->getVorname()?></label></label><br>
    <label class="detail-row">Geburtstag
      <label type="text" class="detail-row-float" name="p_bday" value=""><?= $v->schueler->getGeburtstag()?></label></label><br>
    <label class="detail-row">Gender
      <label type="text" class="detail-row-float" name="p_bday" value=""><?= $v->schueler->getGeschlecht()?></label></label><br>
    <label class="detail-row">E-Mail
        <label type="mail"class="detail-row-float" name="p_mail" value=""><?= $v->schueler->getMail()?></label></label><br>
    <label class="detail-row">Kürzel
        <label type="text"class="detail-row-float" name="p_kuerzel" value=""><?= $v->schueler->getKuerzel()?></label></label><br>
    <label class="detail-row">Status
        <label type="text"class="detail-row-float" name="p_kuerzel" value=""><?php if($v->schueler->getStatus() == 0){echo "InAktiv"; } else { echo "Aktiv"; } ?></label></label><br>
   
    <label  class="detail-row">Klasse
        <select class="detail-row-float" disabled name="class">
        <?php
          foreach($v->klassen as $klasse){
            ?>
            <option value=<?php echo '"'.$klasse->getKid().'"'; if($v->getKlassenBesuch()['kid'] == $klasse->getKid()){echo "selected";} ?>><?= $klasse->getBezeichnung() ?></option>
            <?php
          }
        ?>
        </select>
    </label>
    <?php
    if($v->getKlassenBesuch()['isZweitklasse']){
        ?>
        <label class="detail-row">Zweitausbildung Klasse
            <select class="detail-row-float" name="class">
            <?php
              foreach($v->klassen as $klasse){
                ?>
                <option value=<?php echo '"'.$klasse->getKid().'"'; if($v->getKlassenBesuch()['z_kid'] == $klasse->getKid()){echo "selected";} ?>><?= $klasse->getBezeichnung() ?></option>
                <?php
              }
            ?>
            </select>
        </label>
        <?php
    }?>
</form>

<form class="edit" id="edit_klasse" action="<?php echo $_SERVER['SCRIPT_NAME']."?id=klasseView" ?>" method="post"></form>
