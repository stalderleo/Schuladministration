<form method="post">
    <label>Bezeichnung
    <input type="text" name="k_bez" value="<?= $v->klasse->getBezeichnung(); ?>"></label>
    <label>Kürzel
    <input type="text" name="k_kur" value="<?= $v->klasse->getKuerzel(); ?>"></label>
    <input type="hidden" name="kid" value="<?= $v->klasse->getKid() ?>">
    <input type="submit" value="Speichern" name="setKurs">
</form>
<?php  ?>
<div class="row margin-50">
	<h2>Klasse-Fächer Beziehung</h2>
	<form method="post">
		<div class="class-selection col-sm-12">
			<input type="text" placeholder="Suche" class="search">
			<input type="hidden" name="kid" value="<?= $v->klasse->getKid() ?>">
			<?php
				$v->print_kurs_form();
			?>
		</div>
		<input type="submit" value="Speichern">
	</form>
</div>