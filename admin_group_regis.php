<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
<title>PSQ V.2</title>
<!-- css -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="dist/clipboard.min.js"></script>
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
    function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
     require('connect-db.php');
     $sql_std = "SELECT * FROM tbl_staff_psq";
     $result = mysqli_query($conn,$sql_std);
     session_start();
        if(!$_SESSION["USER"])
        {
            echo '<script type="text/javascript">';
            echo 'window.location.href="desk_login.php";';
            echo '</script>';
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
<h1>ลงทะเบียนผู้ดูแลกลุ่ม</h1>
    <div class="row">
        <div class="col-lg-3">
            <form action="add_admin_group.php" name="std-form" id="std-form" method="get">
                <div class="form-group">
                    <label>ชื่อ</label>       
                    <input class="form-control" type="text" name="name" id="name"/>
                </div>
                <div class="form-group">
                    <label>นามสกุล</label>       
                    <input class="form-control" type="text" name="lastname" id="lastname"/>
                </div>
                <div class="form-group">
                    <label>ตำแหน่ง</label>       
                    <input class="form-control" type="text" name="position" id="position"/>
                </div>
                <div class="form-group">
                    <label>สังกัด</label>       
                    <input class="form-control" type="text" name="office" id="office"/>
                </div>
                <div class="form-group">
                    <label>Regis Code</label>       
                    <input class="form-control" type="text" name="code" id="code" value="<?php echo '$'.generateRandomString();?>" readonly/>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="เพิ่ม"/>
                </div>
            </form> 
        </div>
        <div class="col-lg-9">
            <div class="table-responsive">
                    <table class="table table-hover ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อ</th>
                                <th scope="col">นามสกุล</th>
                                <th scope="col">ตำแหน่ง</th>
                                <th scope="col">สังกัด</th>
                                <th scope="col">รหัสลงทะเบียน</th>
                                
                                                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $a = 1 ;
				                while($objectresult = mysqli_fetch_array($result))
				                    {
                                        echo "<tr>";
                                        echo "<td>".$a."</td>";
                                        echo "<td>".$objectresult["name"]."</td>";
                                        echo "<td>".$objectresult["lastname"]."</td>";
                                        echo "<td>".$objectresult["position"]."</td>";
                                        echo "<td>".$objectresult["office"]."</td>";
                                        echo "<td>".$objectresult["code"]."</td>";
                                       ?>
                                       <td><button type='button' class='btn btn-info' data-clipboard-text='<?php echo $objectresult["code"];?>'>
                                       Copy Code
                                       </button>
                                       </td>
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
var clipboard = new ClipboardJS('.btn');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });
</script>
</body>
</html>