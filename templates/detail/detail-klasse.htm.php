    <label class="detail-row">Bezeichnung
        <label type="text" name="k_bez" class="detail-row-float" value=""><?= $v->klasse->getBezeichnung(); ?></label></label><br>
    <label class="detail-row">Kürzel
        <label type="text" name="k_kur" class="detail-row-float" value=""><?= $v->klasse->getKuerzel(); ?></label></label><br>
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
				<th>Fach</th><th>Lehrer</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $v->kurse as $index=>$fach ):?>
			<tr>
				<td><?=  $fach->getBezeichnung(); ?></td>
				<td><?= $v->lehrer[$index]->getUsername(); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table><br>

	<?php endif; ?>
</div>