<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," data-ajax="false" charset="utf-8">
<title>Find-Out!:ค้นพบ</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
<style type="text/css">
@media print{
.print_text {
	font-size:26px;
	font-family:"Angsana New";
}
}
#container-fluid{
margin-bottom: 10px;
}
</style>
</head>
<body>
<div class="w3-container w3-lime">
    <div class="w3-row">
        <div class="w3-col w3-container m10 l11 w3-center">  
            <h1>PEA SMART QUERY V.2</h1>
        </div>
    </div>
</div>   
<div class="container-fluid">
<div class="col-lg-4 offset-lg-4">
	<form name="form1" action="desk_check_login.php" method="post">
		<div class="form-group">
			<label for="username">ชื่อผู้ใช้งาน</label>
			<input class="form-control" type="text" name="textuser" id="textuser" value="" />
		</div>
		<div class="form-group">
			<label for="password">รหัสผ่าน</label>
			<input class="form-control" type="password" name="textpass" id="textpass" value="" />
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success btn-block" value="เข้าสู่ระบบ" />
		</div>
	</form>
</div>
</div> 	
</body>
</html>