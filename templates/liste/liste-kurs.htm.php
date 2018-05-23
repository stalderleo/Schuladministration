<!--
 * @author Daniel Mosimann
 * @date 1. April 2018
 *
 * Template Kontaktliste. Stil Stacked Table.
 *
-->

<ul id="kursList" class="">
<?php foreach ( $v->kurse as $fach ): ?>
    <li><a href="#<?php $fach->getFid() ?>"><?= $fach->getBezeichnung() ?></a></li>
<?php endforeach; ?>
</ul>
<div class="btn-container">
    <button title="Neues Fach" data-toggle="modal" data-target="#subject_modal" class="add"><i class="fas fa-notes-medical"></i></button>
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