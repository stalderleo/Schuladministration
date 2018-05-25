<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="table-container">
<table id="klasseList" class="table tstacked">
        <thead>
            <tr>
                <th>Bezeichnung</th><th>Kürzel</th><th></th><th></th>
            </tr>
        </thead>
        
        <tbody>
<?php foreach ($v->klassen as $klasse) : ?>
			<tr>
				<td><a href="#<?php echo $klasse->getKid() ?>"><?= $klasse->getBezeichnung() ?></td>
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

<?php include $this->template_path.'/modals/modal-klasse.php'; ?>

<script>
	function filterTable(event) {
		var filter = event.target.value.toUpperCase();
		var rows = document.querySelector("#klasseList tbody").rows;

		for (var i = 0; i < rows.length; i++) {
			var firstCol = rows[i].cells[0].textContent.toUpperCase();
			var secondCol = rows[i].cells[1].textContent.toUpperCase();
			if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
				rows[i].style.display = "";
			} else {
				rows[i].style.display = "none";
			}      
		}
	}

	document.querySelector('#searchList').addEventListener('keyup', filterTable, false);
</script>
