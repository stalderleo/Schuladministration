<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="flex">
	<div class="table-container dragscroll">
		<table id="lehrerList" class="table tstacked">
			<thead>
				<tr>
					<th>Name</th><th>Vorname</th><th>Email<i title="Vergrössern/Verkleinern" data-extend class="fas fa-expand"></i></th><th>Kürzel</th><th></th><th></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($v->lehrers as $l) : ?>
				<tr>
                                        <td data-label="Name"><form method="post"><a href="index.php?id=lehrerView&pid=<?php echo $l->getPid(); ?>"><?php echo $l->getName(); ?></a></form></td>
					<td data-label="Vorname"><?php echo $l->getVorname()?></td>
					<td data-label="Email" class="downsize"><?php echo $l->getMail()?></td>
					<td data-label="Kuerzel"><?php echo $l->getKuerzel() ?></td>
					<td><form method="post" class="edit"><i class="fas fa-edit"></i><input type="submit" name="pid" value='<?php echo $l->getPid() ?>'></form></td>
					<td><form method="post" class="delete"><i class="fas fa-trash"></i><input type="submit" name="pid_del" value='<?php echo $l->getPid() ?>'></form></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<div class="btn-container">
		<button title="Neuer Lehrer" data-toggle="modal" data-target="#teacher_modal" class="add"><i class="fas fa-chalkboard-teacher"></i></button>
	</div>
</div>
<?php include $this->template_path.'/modals/modal-lehrer.php'; ?>
<?php include $this->template_path.'/modals/modal-fach.php'; ?>
<?php include $this->template_path.'/modals/modal-klasse.php';?>