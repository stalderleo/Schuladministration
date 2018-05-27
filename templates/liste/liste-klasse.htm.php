<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="flex">
	<div class="table-container dragscroll mobile">
		<table id="klasseList" class="table tstacked">
	        <thead>
	            <tr>
	                <th>Bezeichnung</th><th>Kürzel</th><th></th><th></th>
	            </tr>
	        </thead>
	        
	        <tbody>
				<?php foreach ($v->klassen as $klasse) : ?>
				<tr>
					<td><?= $klasse->getBezeichnung() ?></td>
					<td><?= $klasse->getKuerzel() ?></td>
					<td><form class="edit" method="post"><i class="fas fa-edit"></i><input type="submit" name="kid" value='<?php echo $klasse->getKid() ?>'></form></td>
					<td><form class="delete" method="post"><i class="fas fa-trash"></i><input type="submit" name="kid_del" value='<?php echo $klasse->getKid() ?>'></form></td>
				</tr>
				<?php endforeach; ?>
		   </tbody>
		</table>
	</div>
	<div class="btn-container">
		<button title="Neue Klasse" data-toggle="modal" data-target="#class_modal" class="add"><i class="fas fa-users"></i></button>
	</div>
</div>

<?php include $this->template_path.'/modals/modal-klasse.php'; ?>
