<?php
	require('connect-db.php');
	$uid = $_POST["uid"];
	$office = $_POST["office"];
	$sec = $_POST["sec"];
	$s_name = $_POST["s_name"];
	$l_name = $_POST["l_name"];
	$staff_id = $_POST["staff_id"];
	$sql_insert_staff = "INSERT INTO tbl_psq_search_staff(uid,office,sec,s_name,l_name,staff_id) VALUES('$uid','$office','$sec','$s_name','$l_name','$staff_id')";
	mysqli_query($conn,$sql_insert_staff);
	echo '<script type="text/javascript">';
		echo 'window.location.href="line://app/1544181630-9YeX5qxR";';
		echo '</script>';
?>