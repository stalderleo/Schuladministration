<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html>
<html lang="en">
<head>
    <title>Schuladministration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    
    <div class="container">
        <div class="card text-left bg-light">
            <div class="row align-items-center">
                <div class="col">
                    <h1><?php echo $this->active_objects[array_keys($this->active_objects)[0]]->title ?></h1>
                </div>
                <div class="col">
                    <p class="text-right"><?php //$this->content('datum'); ?></p>
                </div>
            </div>
        </div>
        <div class="card text-left">
            <?php echo $this->menu_bootstrap(config::MENU_TEMPLATE);?>
            <div class="row m-3">
                <div class="col-12" style="overflow: auto">
                    <?php $this->content('login'); ?>
                </div>
            </div>
        </div>
        <div class="card text-center bg-light">
            <span class="small">&copy; Copyright GIBS Solothurn</span>
        </div>
    </div>
</body>
</html>