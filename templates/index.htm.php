<?php header('Content-Type: text/html; charset=utf-8'); ?>
<!doctype html>
<html lang="en">
<head>
	<title>Schuladministration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
	<script src="../lib/pagination/pagination.js"></script>
	<script src="../js/dragscroll.js"></script>
	<script src="../js/UI.js"></script>


</head>

<body>
	<div class="container">
		<div class="row">
			<div class="text-left col-sm-12">
				<div class="row align-items-center">
					<h1 class="page-title"><?php echo $this->active_objects[array_keys($this->active_objects)[0]]->title ?></h1>
				</div>
			</div>
			<div class="search-container col-sm-12 no-padding">
				<input data-table-search=".tstacked" type="text" id="searchList" class="col-sm-3" style="margin-bottom: 20px" placeholder="Suche">
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-12">
			<?php echo $this->menu_bootstrap(config::MENU_TEMPLATE);?>
			</div>
			<div class="col-md-9 col-sm-12">
				<div class="col-12 content" style="overflow: visible">
					<?php $this->content(); ?>
				</div>
			</div>
		</div>
		<div class="text-center bg-light absolute-bottom">
			<span class="small">&copy; Copyright GIBS Solothurn</span>
		</div>
	</div>
</body>
</html>
