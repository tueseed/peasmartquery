<?php
require('./db/connect-db.php');
$catagory = $_POST["catagory"];
$doc_no = $_POST["doc_no"];
$discription = $_POST["discription"];
$link = $_POST["link"];
$keyword = $_POST["keyword"];
$sql_insert = "INSERT INTO tbl_standard(catagory,doc_no,discription,link,keyword) VALUES('$catagory','$doc_no','$discription','$link','$keyword')";
$result = mysqli_query($conn, $sql_insert) or trigger_error($conn->error."[$sql_insert]");





echo 'ลงทะเบียนเรียบร้อย กรุณาติดต่อผู้ดูแลระบบ เพื่อยืนยันการใช้งาน';
?>