<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="table-container dragscroll">
<table id="lehrerList" class="table tstacked">
    <thead>
        <tr>
            <th>Name</th><th>Vorname</th><th>Email<i title="Vergrössern/Verkleinern" data-extend class="fas fa-expand"></th><th>Kürzel</th><th></th><th></th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach ( $v->lehrers as $l ): ?>
            
            <tr>
                <td data-label="Name"><a href="#"></a><?php echo $l->getName()?></td>
                <td data-label="Vorname"><?php echo $l->getVorname()?></td>
                <td data-label="Email" class="downsize"><?php echo $l->getMail()?></td>
                <td data-label="Kuerzel"><?php echo $l->getKuerzel() ?></td>
            <?php echo $v->editEntry; ?>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="btn-container">
    <button title="Neuer Lehrer" data-toggle="modal" data-target="#teacher_modal" class="add"><i class="fas fa-chalkboard-teacher"></i></button>
</div>

<?php include $this->template_path.'/modals/modal-lehrer.php'; ?>
<?php include $this->template_path.'/modals/modal-fach.php'; ?>
<?php include $this->template_path.'/modals/modal-klasse.php'; ?>


<script>
    function filterTable(event) {
        var filter = event.target.value.toUpperCase();
        var rows = document.querySelector("#lehrerList tbody").rows;

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