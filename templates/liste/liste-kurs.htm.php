<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<div class="flex">
    <div class="table-container dragscroll mobile">
        <table id="kursListe" class="table tstacked">
            <thead>
                <tr>
                    <th>Bezeichnung</th><th>Kuerzel</th><th>Detail</th><th>Löschen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $v->kurse as $fach ): ?>
                    <tr>
                        <td><form method="post"><a href="index.php?id=faecherView&fid=<?php echo $fach->getFid()?>"><?= $fach->getBezeichnung() ?></a></form></td><td> <?= $fach->getKuerzel(); ?></td>
                        <td><form class="edit" method="post"><i class="fas fa-edit"></i><input type="submit" name="fid" value='<?php echo $fach->getFid() ?>'></form></td>
                        <td><form class="delete" method="post"><i class="fas fa-trash"></i><input type="submit" name="fid_del" value='<?php echo $fach->getFid() ?>'></form></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="btn-container">
        <button title="Neues Fach" data-toggle="modal" data-target="#subject_modal" class="add"><i class="fas fa-notes-medical"></i></button>
    </div>
</div>

<?php include $this->template_path.'/modals/modal-fach.php'; ?>

<script>
    function filterList() {
        
    var input, filter, ul, li, a, i;
    
    filter = event.target.value.toUpperCase();
    ul = document.getElementById("kursList");
    li = ul.getElementsByTagName('li');

    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}

    document.querySelector('#searchList').addEventListener('keyup', filterList, false);
</script>