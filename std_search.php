<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
<title>PSQ V.2</title>
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
     session_start();
        if(!$_SESSION["USER"])
        {
            echo '<script type="text/javascript">';
            echo 'window.location.href="desk_login.php";';
            echo '</script>';
            break;
        }
        $keyword = $_GET['keyword'];
        if(isset($keyword))
        {
            $sql_std = "SELECT * FROM tbl_standard WHERE keyword LIKE '%".$keyword."%' OR doc_no LIKE '%".$keyword."%' OR discription LIKE '%".$keyword."%'";
            $result = mysqli_query($conn,$sql_std);  
        }
    ?>
<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-border-right w3-dark-grey" style="display:none" id="mySidebar">
    <button onclick="w3_close()" class="w3-bar-item w3-large w3-dark-grey">Close &times;</button>
    <?php
       echo "  ".$_SESSION["USER"]."<br><br>";
    ?>
    <a href="index.php" class="w3-bar-item w3-button">เพิ่มข้อมูลมาตรฐาน</a>
    <a href="std_search.php" class="w3-bar-item w3-button">ค้นหามาตรฐาน</a>
    <a href="admin_group_regis.php" class="w3-bar-item w3-button">ลงทะเบียนผู้ดูแลกลุ่ม</a>
    <a href="http://nutt-i.com/psqv2/desk_logout.php" class="w3-bar-item w3-button">ออกจากระบบ</a>
</div>
<div class="w3-container w3-lime">
    <div class="w3-row">
        <div class="w3-col w3-container m2 l1 w3-left">
            <button class="w3-button w3-lime w3-xlarge" onclick="w3_open()">☰</button>
        </div>
        <div class="w3-col w3-container m10 l11 w3-center">  
            <h1>PEA SMART QUERY V.2</h1>
        </div>
    </div>
</div>
<div class="container-fluid">
<h1>ค้นหามาตรฐาน</h1>
    <div class="row">
        <div class="col-lg-2">
            <form action="std_search.php" name="std-form" id="std-form" method="get">
                <div class="form-group">
                    <label>คำค้นหา</label>       
                    <input class="form-control" type="text" name="keyword" id="keyword" placeholder="เลขที่แบบ,บันทึก etc.."/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="ค้นหา"/>
                </div>
            </form> 
        </div>
        <div class="col-lg-10">
            <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">หมวดหมู่</th>
                                <th scope="col">เลขที่เอกสาร</th>
                                <th scope="col">รายละเอียด</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $a = 1 ;
				                while($objectresult = mysqli_fetch_array($result))
				                    {
                                        echo "<tr>";
                                        echo "<td>".$a."</td>";
                                        echo "<td>".$objectresult["catagory"]."</td>";
                                        echo "<td>".$objectresult["doc_no"]."</td>";
                                        echo "<td>".$objectresult["discription"]."</td>";
                                       ?>
                                       <td><input type='button' class='btn btn-info' value='Link' onclick='window.location.href="<?php echo $objectresult["link"];?>"' /></td>
                                        <td><input type='button' class='btn btn-success' value='แก้ไข' onclick='window.location.href="edit.php?id=<?php echo $objectresult["id"];?>"' /></td>
                                     <?php  
                                        echo "</tr>";
					                    $a = $a+1;
					                }			
				                    $a = 0;
                            ?>                            
                        </tbody>
                    </table>
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