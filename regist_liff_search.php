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
		<div class="container-fluid" style="background-color:#00ace6;">
			<div class="row row-center">
				<div class="col-lg-12">
				<h4>PEA SMART QUERY V.2</h4>
				</div>
			</div>
		</div>
		<div class= "container-fluid">
			<form action="regist_liff_2_sql.php" method="post">
				<div class="row">
					<label for="name">UID :</label>
					<?php $uid = $_GET[uid];?>
					<input class="form-control" type="text" readonly name="uid" id="uid" value="<?php echo $uid;?>">
				</div>
				<div class="row">
					<label for="name">การไฟฟ้า :</label>
					<select class="form-control" id="office" name="office">
						<?php
							require('connect-db.php');
							$sql_office = "SELECT * FROM tbl_office";
							$query_office = mysqli_query($conn,$sql_office);
							while($obj = mysqli_fetch_array($query_office))
							{
								echo "<option>".$obj["office_name"]."</option>";
							}
						?>
					</select>
				</div>
				<div class="row">
					<label for="name">แผนก :</label>
					<select class="form-control" id="sec" name="sec">
						<option>ก่อสร้าง</option>
						<option>ปฏิบัติการและบำรุงรักษา</option>
						<option>บริการลูกค้า</option>
					</select>
				</div>
				<div class="row">
					<label for="name">ชื่อ :</label>
					<input type="text" class="form-control" name="s_name" placeholder="ชื่อ" required>
				</div>
				<div class="row">
					<label for="name">นามสกุล :</label>
					<input type="text" class="form-control" name="l_name" placeholder="นามสกุล" required>
				</div>
				<div class="row">
					<label for="name">รหัสพนักงาน :</label>
					<input type="number" class="form-control" name="staff_id" placeholder="รหัสพนักงาน" required>
				</div>
				<div class="mt-2 row">
					<input type="submit" class="btn btn-success btn-block" value="บันทึก">
				</div>
			</form>
		</div>
		
	</body>
</html>