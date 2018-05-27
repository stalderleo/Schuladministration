<?php 
?>
    <label class="detail-row">Name
        <label type="text" class="detail-row-float" name="p_name" value=""><?= $v->lehrer->getName()?></label></label><br>
    <label class="detail-row">Vorname
        <label type="text" name="p_vorname" class="detail-row-float" value=""><?= $v->lehrer->getVorname()?></label></label><br>
    <label class="detail-row">Geburtstag
      <label type="text" class="detail-row-float" name="p_bday" value=""><?= $v->lehrer->getGeburtstag()?></label></label><br>
    <label class="detail-row">Gender
      <label type="text" class="detail-row-float" name="p_bday" value=""><?= $v->lehrer->getGeschlecht()?></label></label><br>
    <label class="detail-row">E-Mail
        <label type="mail"class="detail-row-float" name="p_mail" value=""><?= $v->lehrer->getMail()?></label></label><br>
    <label class="detail-row">Kürzel
        <label type="text"class="detail-row-float" name="p_kuerzel" value=""><?= $v->lehrer->getKuerzel()?></label></label><br>
    <label class="detail-row">Status
        <label type="text"class="detail-row-float" name="p_kuerzel" value=""><?php if($v->lehrer->getStatus() == 0){echo "InAktiv"; } else { echo "Aktiv"; } ?></label></label><br>
   