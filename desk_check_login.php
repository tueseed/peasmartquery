<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," data-ajax="false" charset="utf-8">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<title>Find Out!</title>
</head> 
<body>
<?php
	require('connect-db.php');
	$U = $_POST['textuser'];
	$P = $_POST['textpass'];
	$sql = "SELECT * FROM tbl_admin_psq WHERE user = '$U' and pass = '$P'";
	$result = mysqli_query($conn,$sql);
	$objResult = mysqli_fetch_array($result);
	echo $objResult["user"];
	if(!$objResult)
	{
		echo "ชื่อผู้ใช้ หรือรหัสผ่านไม่ถูกต้อง หรือไม่มีในระบบ " ;
		//echo '<br>กลับสู่หน้า  <a href = "http://nutt-i.com/psqv2/desk_login.php"> เข้าสู่ระบบ </a>';
		//break;
    }
	else
	{
		session_start();
		$_SESSION["USER"] = $objResult["user"];
		//echo '<script type="text/javascript">';
    //echo 'window.location.href="index.php";';
  	//echo '</script>';
	}
	/*ob_end_flush();*/
	
	?>
</body>
</html>