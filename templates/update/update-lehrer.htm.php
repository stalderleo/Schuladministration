<form method="post">
    <label>Benutzername
        <input required type="text" name="p_username" value="<?= $v->lehrer->getUsername()?>"></label>
    <label>Passwort
        <input type="password" name="p_password" placeholder="***" value=""></label>
    <label>Name
        <input required type="text" name="p_name" value="<?= $v->lehrer->getName()?>"></label>
    <label>Vorname
        <input required type="text" name="p_vorname" value="<?= $v->lehrer->getVorname()?>"></label>
    <label>Geburtstag
      <input required type="text" name="p_bday" value="<?= $v->lehrer->getGeburtstag()?>"></label>
    <label>Gender
        <select required name="p_geschlecht">
          <option value="m" <?php if($v->lehrer->getGeschlecht() == m){ echo "selected"; } ?>>Männlich</option>
          <option value="w" <?php if($v->lehrer->getGeschlecht() == w){ echo "selected"; } ?>>Weiblich</option>
          <option value="u" <?php if($v->lehrer->getGeschlecht() == u){ echo "selected"; } ?>>Anderes</option>
        </select></label>
    <label>E-Mail
        <input required type="mail" name="p_mail" value="<?= $v->lehrer->getMail()?>"></label>
    <label>Kürzel
        <input required type="text" name="p_kuerzel" value="<?= $v->lehrer->getKuerzel()?>"></label>
    <label>Status
        <select required name="p_status">
          <option value="1">Aktiv</option>
          <option value="0" <?php if($v->lehrer->getStatus() == 0){echo "selected"; } ?>>Inaktiv</option>
        </select>
    </label>
    <input type="hidden" name="pid" value="<?= $v->lehrer->getPid() ?>">
    <input type="submit" class="btn" value="Speichern" name="setLehrer">
</form>

<div class="row margin-50">
	<?php if(!empty($v->relations)):?>
	<h2>Klassen / Fächer</h2>
	<table id="" class="table tstacked">
		<thead>
			<tr>
				<th>Klasse</th><th>Fach</th><th>Löschen</th><th>Detail (Klasse)</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $v->relations as $index=>$rel ): ?>
			<tr>
				<td><?= $rel->getKlasse()->getBezeichnung(); ?></td>
				<td><?= $rel->getKurs()->getBezeichnung(); ?></td>
				<td>
					<form class="delete" method="post">
						<i class="fas fa-trash"></i><input type="submit" name="del_instanz" value="<?= $index ?>">
						<input type="hidden" name="pid" value="<?= $v->lehrer->getPid(); ?>">
					</form>
				</td>
				<td>
					<form class="edit" action="<?php echo $_SERVER['SCRIPT_NAME']."?id=klasseView" ?>" method="post">
						<i class="fas fa-edit"></i><input type="submit" name="kid" value="<?= $rel->getKlasse()->getKid(); ?>">
					</form>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php endif; ?>

	<h2>Neue Klasse mit Kurs</h2>
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
			  <select name="fach_id" id="kurse">
				<?php
					$v->print_kurs_form();
				?>
			  </select>
			</div>
			<input type="hidden" name="pid" value="<?= $v->lehrer->getPid() ?>">
			<input type="submit" class="btn" value="Speichern">
		</div>
	</form>
</div>