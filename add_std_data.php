<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
</head>
<body>
<?php
require('connect-db.php');
session_start();
$catagory = $_GET["catagory"];
$doc_no = $_GET["doc_no"];
$discription = $_GET["discription"];
$notice =$_GET["notice"];
$link = $_GET["link"];
$keyword = $_GET["keyword"];
$sql_insert = "INSERT INTO tbl_standard(catagory,doc_no,discription,link,keyword) VALUES('$catagory','$doc_no','$discription','$link','$keyword')";
$result = mysqli_query($conn, $sql_insert) or trigger_error($conn->error."[$sql_insert]");
if(isset($notice))
{
    if($notice == "y")
    {
        $sql_group_id = "SELECT * FROM tbl_psq_group";
        $query_group_id = mysqli_query($conn,$sql_group_id);
        while($obj_group = mysqli_fetch_array($query_group_id))
        {
            $access_token = 'ZP+VUHsKMsZL45YWEXAeX7xIuij8//+W38Hqee/U2nyYzCF+v1fbJx78yNrsKAVFJJ7BcZfl1+0fkL66TzZV0FtBf/PpBbuqGmilCwK5+NE1TjEeHwV90c7SsIV6TfMlNlaGIcIzhIVkeRnBUrwygwdB04t89/1O/w1cDnyilFU=';
            $messages = [ 'type' => 'text', 
                        'text' => "แจ้งเตือน... มีการเพิ่มข้อมูลใหม่ในระบบ PSQV2 โดย ".$_SESSION['USER']."\nเลขที่เอกสาร :".$doc_no."\nรายละเอียด :".$discription."\nขออภัยหากเป็นการรบกวน\n".$link
                        ];
            $url = 'https://api.line.me/v2/bot/message/push';
            $data = ['to' => $obj_group['group_id'],'messages' => [$messages]];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch); 
        }
    }
}




//echo $catagory." ".$doc_no." ".$discription." ".$link." ".$keyword;
echo '<script type="text/javascript">';
echo 'window.location.href="index.php";';
echo '</script>';
?>
</body>
</html>