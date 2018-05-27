<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->
<input uype="tyext" placeholder="Suche" class="form-search mb-20" data-table-search="#kursListe">
<div class="flex">
    <div class="table-container dragscroll mobile">
        <table id="kursListe" class="table tstacked">
            <thead>
                <tr>
                    <th>Bezeichnung</th><th>Kuerzel</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $v->kurse as $fach ): ?>
                    <tr><td><?= $fach->getBezeichnung()."</td><td>". $fach->getKuerzel() ?></td></tr>
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