    <label>Bezeichnung
        <label type="text" name="k_bez" value=""><?= $v->klasse->getBezeichnung(); ?></label></label><br>
    <label>Kürzel
    <input type="text" name="k_kur" value="<?= $v->klasse->getKuerzel(); ?>"></label>
    <input type="hidden" name="kid" value="<?= $v->klasse->getKid() ?>">
    <input type="submit" class="btn" value="Speichern" name="setKurs">
</form>
<?php  ?>
<div class="row margin-50">
	<h2>Schueler</h2>
	<table id="" class="table tstacked">
		<thead>
			<tr>
				<th>Benutzername</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $v->schueler as $schueler ): ?>
			<tr>
				<td><?=  $schueler->getSchueler()->getUsername() ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table><br>

	<?php if(!empty($v->kurse)):?>

	<h2>Fächer / Lehrer</h2>
	<table id="" class="table tstacked">
		<thead>
			<tr>
				<th>Fach</th><th>Lehrer</th><th>Löschen</th><th>Detail (Lehrer)</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $v->kurse as $index=>$fach ):?>
			<tr>
				<td><?=  $fach->getBezeichnung(); ?></td>
				<td><?= $v->lehrer[$index]->getUsername(); ?></td>
				<td>
					<form class="delete" method="post">
						<i class="fas fa-trash"></i><input type="submit" name="del_kurs-klasse" value="<?= $index ?>">
						<input type="hidden" name="kid" value="<?= $v->klasse->getKid(); ?>">
					</form>
				</td>
				<td>
					<form class="edit" action="<?php echo $_SERVER['SCRIPT_NAME']."?id=lehrerView" ?>" method="post">
						<i class="fas fa-edit"></i><input type="submit" name="pid" value="<?= $v->lehrer[$index]->getPid(); ?>">
					</form>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table><br>

	<?php endif; ?>
</div>