<!--
 * @author Leo Stalder
 * @date 2. Mai 2018
 *
 * Template für den Datenimport
 *
-->
<?php if (true) ://(isset($_FILES['dataExport'])) : ?>
    <script type="text/javascript">
        if(typeof(EventSource) !== "undefined") {
            var source = new EventSource("import_progress.php");
            source.addEventListener('message', function(e) {
                if (!(e.data.includes("Import abgeschlossen"))) {
                    if (e.data.includes("inserted")) { 
                        document.getElementById("log").innerHTML += "<span class=\"inserted\">"+e.data+"</span>";
                    } 
                    else if (e.data.includes("Warning")) {
                        document.getElementById("log").innerHTML += "<span class=\"warning\">"+e.data+"</span>";
                    } else if (e.data.includes("failed")) {
                        document.getElementById("log").innerHTML += "<span class=\"failed\">"+e.data+"</span>";
                    }
                } else {
                    document.getElementById("log").innerHTML += "<span><strong>Import completet</strong></span>";
                }
            }, false);
        } else {
            document.getElementById("progress_bar").innerHTML = "Ihr Browser unterstützt keine Server-Sent Events...";
        }
        
        function updateScroll(){
            var element = document.getElementById("log");
            element.scrollTop = element.scrollHeight;
        }
        
        var scrolled = false;
        
        //once a second
        setInterval(function() {
            if (!scrolled) updateScroll();
        },50);
        
    </script>
<?php endif ?>
<form enctype="multipart/form-data" action="<?php echo $_SERVER['SCRIPT_NAME']."?id=importView" ?>" method="post" id="importDataForm">
    <div class="form-group">
        <label for="dataExport">Laden Sie ein File hoch:</label>
        <input type="file" class="form-control-file" name="dataExport" id="dataExport">
        <input name="submit" type="submit" value="Hochladen">
    </div>
</form>
<div id="log" onscroll="scrolled = true"></div>
