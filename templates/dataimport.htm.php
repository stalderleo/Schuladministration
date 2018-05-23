<!--
 * @author Leo Stalder
 * @date 2. Mai 2018
 *
 * Template für den Datenimport
 *
-->
<?php if (isset($_FILES['dataExport'])) : ?>
    <script type="text/javascript">
        console.log("afs");
        if(typeof(EventSource) !== "undefined") {
            console.log("afs1");
            var source = new EventSource("import_progress.php").addEventListener('message', function(e) {
                console.log("afs2");
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
                    console.log("WTF");
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
<?php if (isset($v->errorimport)) { 
    echo "<div id=\"error\">"+$v->errorimport+"</div>"; 
} else { ?>
    <div id="log" ></div>
<?php } ?>
