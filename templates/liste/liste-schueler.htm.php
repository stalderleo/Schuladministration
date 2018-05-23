<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="table-container dragscroll">


<table id="schuelerList" class="table tstacked">
    <thead>
        <tr>
            <th>Name</th><th>Vorname</th><th>Email<i title="Vergrössern/Verkleinern" data-extend class="fas fa-expand"></th><th>Kürzel</th><th></th><th></th>
        </tr>
    </thead>
    <tbody>
<?php
        foreach ( $v->schuelers as $s ): ?>
            
        <tr>
                <td data-label="Name"><a href="#"></a><?php echo $s->getName()?></td>
                <td data-label="Vorname"><?php echo $s->getVorname()?></td>
                <td data-label="Email" class="downsize"><?php echo $s->getMail()?></td>
                <td data-label="Kuerzel"><?php echo $s->getKuerzel() ?></td>
                <td><form method="post"><input type="submit" name="pid" class="edit" value='<?php echo $s->getPid() ?>'></form></td>
                <td><form method="post"><input type="submit" name="pid_del" class="delete" value='<?php echo $s->getPid() ?>'></form></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
</div>

<div class="btn-container">
    <button title="Neuer Schüler" data-toggle="modal" data-target="#student_modal" class="add"><i class="fas fa-graduation-cap"></i></button>
</button>

</div>


<?php include $this->template_path.'/modals/modal-schueler.php'; ?>
<?php include $this->template_path.'/modals/modal-klasse.php'; ?>

<script>
    function filterTable(event) {
        var filter = event.target.value.toUpperCase();
        var rows = document.querySelector("#schuelerList tbody").rows;

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