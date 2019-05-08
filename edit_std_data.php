<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
</head>
<body>
<?php
require('connect-db.php');
$id = $_GET["id"];
$catagory = $_GET["catagory"];
$doc_no = $_GET["doc_no"];
$discription = $_GET["discription"];
$link = $_GET["link"];
$keyword = $_GET["keyword"];
$sql_update = "UPDATE tbl_standard SET catagory='$catagory',doc_no='$doc_no',discription='$discription',link='$link',keyword='$keyword' WHERE id='".$id."'";
//$sql_insert = "INSERT INTO tbl_standard(catagory,doc_no,discription,link,keyword) VALUES('$catagory','$doc_no','$discription','$link','$keyword')";
$result = mysqli_query($conn, $sql_update) or trigger_error($conn->error."[$sql_insert]");





//echo $catagory." ".$doc_no." ".$discription." ".$link." ".$keyword;
echo '<script type="text/javascript">';
echo 'window.location.href="index.php";';
echo '</script>';
?>
</body>
</html>