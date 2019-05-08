<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
</head>
<body>
<?php
require('connect-db.php');
$name = $_GET["name"];
$lastname = $_GET["lastname"];
$position = $_GET["position"];
$office = $_GET["office"];
$code = $_GET["code"];
$sql_insert = "INSERT INTO tbl_staff_psq(name,lastname,position,office,code) VALUES('$name','$lastname','$position','$office','$code')";
$result = mysqli_query($conn, $sql_insert) or trigger_error($conn->error."[$sql_insert]");





//echo $catagory." ".$doc_no." ".$discription." ".$link." ".$keyword;
echo '<script type="text/javascript">';
echo 'window.location.href="admin_group_regis.php";';
echo '</script>';
?>
</body>
</html>