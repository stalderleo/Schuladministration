    <label>Bezeichnung
        <label type="text" name="k_bez" value=""><?= $v->klasse->getBezeichnung(); ?></label></label><br>
    <label>Kürzel
        <label type="text" name="k_kur" value=""><?= $v->klasse->getKuerzel(); ?></label></label>
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

	<?php if(!empty($v->lehrer)):?>

	<h2>Lehrer</h2>
	<table id="" class="table tstacked">
		<thead>
			<tr>
				<th>Benutzername</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $v->lehrer as $lehrer ): ?>
			<tr>
				<td><?= $lehrer->getUsername(); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table><br>

	<?php endif; ?>
	<?php if(!empty($v->kurse)):?>

	<h2>Fächer</h2>
	<table id="" class="table tstacked">
		<thead>
			<tr>
				<th>Bezeichnung</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach ( $v->kurse as $fach ): ?>
			<tr>
				<td><?=  $fach->getBezeichnung(); ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

	<?php endif; ?>
</div>