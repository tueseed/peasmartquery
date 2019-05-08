<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
	<title>PSQ V.2</title>
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
		
	<style type="text/css">
		.embed-responsive-210by297 
		{
			padding-bottom: 141.42%;
		}
		body 
		{
			font-family: 'Kanit', sans-serif;
		}
	</style>
	</head>
	<body>
		<?php
		$link = $_GET["link"];
		require('connect-db.php');
		$sql_search ="SELECT * FROM tbl_standard WHERE id LIKE '%".$link."%'";
		$query_search = mysqli_query($conn,$sql_search);
		$objsearch = mysqli_fetch_array($query_search);
		$link1 = $objsearch["link"];
		//echo $link1;
		?>
		<div class="container">
			<div class="row">
				<?php echo "คำค้น ".$objsearch["keyword"];?>
			</div>
			<div class="row">
				<div class="embed-responsive embed-responsive-210by297">
					<iframe class="embed-responsive-item" src="<?php echo $link1;?>" height=100%></iframe>
				</div>
			</div>
		</div>
		<div class="mt-2 container">
			<div class="row">
				<div class="col-lg-4 offset-lg-4">
					<input type="button" class="btn btn-success btn-block" value="back" onclick="window.location.href='result.php?keyword=<?php echo base64_encode($_GET["keyword"]);?>'">
				</div>
			</div>
		</div>
	</body>
</html>