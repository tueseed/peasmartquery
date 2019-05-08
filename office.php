<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
<title>PEA OFFICE SEARCH</title>
<!-- css -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="tagsinput.css" rel="stylesheet" type="text/css">
<script src="tagsinput.js"></script>
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
.table-responsive{
  display: block;
  max-height: 500px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
}

</style>
</head>
<body>
    <?php
     require('connect-db.php');
     $keyword = $_GET['keyword'];
    if(isset($keyword))
    {
        $sql_std = "SELECT * FROM tbl_front WHERE office_name LIKE '%".$keyword."%'";
        $result = mysqli_query($conn,$sql_std);  
    }
    ?>
<div class="w3-container w3-indigo">
        <div class="w3-row">
            <div class="w3-col w3-container l12 w3-center">  
                <h4>PEA OFFICE SEARCH</h4>
            </div>
        </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <form action="office.php" name="std-form" id="std-form" method="get">
                <div class="form-group">
                    <label>คำค้นหา</label>       
                    <input class="form-control" type="text" name="keyword" id="keyword" placeholder="ชื่อการไฟฟ้า"/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-block" value="ค้นหา"/>
                </div>
            </form> 
            <div class="list-group">
                <ul class="list-group">
                    <?php
                    $a=1;
                    while($objsearch = mysqli_fetch_array($result))
                    {
                        
                        echo "<li class='list-group-item'>";
                        echo $a.".<br>";
                        echo "การไฟฟ้า ".$objsearch["office_name"]."<br>";
                        echo "รหัส ".$objsearch["office_id"]."<br>"; 
                        echo "</li>";                       
                        $a=$a+1;
                    }
                    $a=0;
                    ?>
                </ul>    
            </div>
        </div>
    </div>   
</div>
<script>
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>
</body>
</html>