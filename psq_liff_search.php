<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
		<title>PSQ V.2</title>
		<!-- css -->
		<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link href="tagsinput.css" rel="stylesheet" type="text/css">
		<script src="tagsinput.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
		<style type="text/css">
		#container-fluid{
		margin-bottom: 10px;
		}
		body 
					{
						font-family: 'Kanit', sans-serif;
					}
		.row-center
			{
				text-align:center;
			}
		</style>
	</head>
	<body>
		<?php
			require('connect-db.php');
			$keyword = $_GET["keyword"];
			if(isset($keyword))
			{
				$sql_search ="SELECT * FROM tbl_standard WHERE keyword LIKE '%".$keyword."%' OR doc_no LIKE '%".$keyword."%' OR discription LIKE '%".$keyword."%'";
				$query_search = mysqli_query($conn,$sql_search);
				$nums = mysqli_num_rows($query_search);
				$txtresult = "ค้นพบ  ".$nums." รายการ";
			}
		?>
		<div class="container-fluid" style="background-color:#00ace6;">
			<div class="row row-center">
				<div class="col-lg-12">
					<h4>PEA SMART QUERY V.2</h4>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="col-xs-10">
				<form action="https://peasmartquery.herokuapp.com/psq_liff_search.php" method="get">
					<div class="row">
						<label for="keyword">คำค้นหา :</label>
						<input type="text" class="form-control" name="keyword" placeholder="เช่น เสา สาย ยึดโยง ฯลฯ">
					</div>
					<div class="mt-2 row">
						<input type="submit" class="btn btn-success btn-block" value="ค้นหา">
					</div>
				</form>	
			</div>
		</div>
		<div class="container-fluid">
			<h2><?php echo $txtresult;?></h2>
			<div class="row">
				<div class="col-lg-12">
					<div class="list-group">
						<?php
						$a=1;
						while($objsearch = mysqli_fetch_array($query_search))
						{
							echo '<a href="pdf.php?link='.$objsearch["id"].'&keyword='.$keyword.'" class="list-group-item list-group-item-action">';
							echo $a.".<br>";
							echo "หมวดหมู่ ".$objsearch["catagory"]."<br>";
							echo "เลขที่เอกสาร ".$objsearch["doc_no"]."<br>";
							echo "คำอธิบาย ".$objsearch["discription"]."<br>";
							echo "คำค้น ".$objsearch["keyword"];
							echo '</a>';
							$a=$a+1;
						}
						$a=0;
						?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

