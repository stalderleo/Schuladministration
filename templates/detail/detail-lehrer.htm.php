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
<?php  ?>
<div class="row margin-50">
    <form method="post">
        <div class="class-selection col-sm-6">
            <input type="text" placeholder="Suche" class="search">
            <?php
            $dbKlassen = new dbKlasse();
            $klassen = $dbKlassen->selectAllKlassen();
            $dbKurs = new dbKurs();

            foreach($klassen as $klasse){
            ?>
                <label><?= $klasse->getBezeichnung() ?>
                    <input type="radio" reguired name="kid" value="<?= $klasse->getKid() ?>"></label>
            <?php
            }
            ?>
        </div>
        <div class="kurs-creation col-sm-6">
            <input type="hidden" reguired name="lid" value="<?= $v->lehrer->getPid() ?>">
            <input type="submit" value="Speichern">
            <?php /*

                       <select name="class" style="position:absolute;top:0px;left:0px;width:200px; height:25px;line-height:20px;margin:0;padding:0;" onchange="document.getElementById('displayValue').value=this.options[this.selectedIndex].text; document.getElementById('idValue').value=this.options[this.selectedIndex].value;">
               <option></option>
               <?php
               foreach($dbKurs->selectAllKurse() as $kurs){
                   ?>
                    <option value="<?= $kurs->getKid()?>"><?= $kurs->getBezeichnung() ?></option>
                   <?php
               }

               ?>
            </select> 
           */ ?>
        </div>
    </form>
</div>