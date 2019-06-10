<html>
<head>
	<title>PSQ V.2</title>
</head>
<body>
<?php
	require('connect-db.php');
	$uid = $_POST["useridfield"];
	$sql_chk_uid = "SELECT * FROM tbl_psq_search_staff WHERE uid ='".$uid."'";
	$query_uid = mysqli_query($conn,$sql_chk_uid);
	$nums = mysqli_num_rows($query_uid);
	if($nums == 0)
	{
		echo '<script type="text/javascript">';
		echo 'window.location.href="https://nutt-i.com/psqv2/regist_liff_search.php?uid='.$uid.'";';
		echo '</script>';
		break;
	}
	else if ($nums <> 0)
	{
		echo '<script type="text/javascript">';
		echo 'window.location.href="https://nutt-i.com/psqv2/psq_liff_search.php";';
		echo '</script>';
		break;
	}
?>
</body>
</html>