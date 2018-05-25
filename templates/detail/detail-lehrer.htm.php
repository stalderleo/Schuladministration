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
	<h2>Lehrer-Klasse-Kurs Bezeiehung</h2>
	<form method="post">
		<div class="class-selection col-sm-6">
			<input type="text" placeholder="Suche" class="search">
			<?php
				$v->print_klassen_form();
			?>
		</div>
		<div class="kurs-creation col-sm-6">
			<div class="select-search">
			  <input class="ss_input" type="text" data-select-search="kurse">
			  <select name="fach-id" id="kurse">
				<?php
					$v->print_kurs_form();
				?>
			  </select>
			</div>
			<input type="submit" value="Speichern">
		</div>
	</form>
</div>