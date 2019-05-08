<?php
require('connect-db.php');require('render_msg.php');
date_default_timezone_set("Asia/Bangkok");
function say_hi()
{
    $time = date("H");
    $timezone = date("e");
    if ($time < "12") {
        $say = "Good morning";
    } else
    if ($time >= "12" && $time < "17") {
        $say = "สวัสดียามบ่ายคร้าบบบ";
    } else
    if ($time >= "17" && $time < "19") {
        $say = "สายัณห์สวัสดิ์";
    } else
    if ($time >= "19") {
        $say = "สวัสดีตอนดึกจ้า ยังไม่นอนอีกรึ";
    }
    return $say;
}
function reply_msg($keyword,$replyToken)
{
    $access_token = 'ZP+VUHsKMsZL45YWEXAeX7xIuij8//+W38Hqee/U2nyYzCF+v1fbJx78yNrsKAVFJJ7BcZfl1+0fkL66TzZV0FtBf/PpBbuqGmilCwK5+NE1TjEeHwV90c7SsIV6TfMlNlaGIcIzhIVkeRnBUrwygwdB04t89/1O/w1cDnyilFU=';	$messages = ['type' => 'text','text' => $keyword];
    // Make a POST Request to Messaging API to reply to sender
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
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
    echo $result . "\r\n";
}
function reply_flex_msg($keyword,$replyToken)
{
    $access_token = 'ZP+VUHsKMsZL45YWEXAeX7xIuij8//+W38Hqee/U2nyYzCF+v1fbJx78yNrsKAVFJJ7BcZfl1+0fkL66TzZV0FtBf/PpBbuqGmilCwK5+NE1TjEeHwV90c7SsIV6TfMlNlaGIcIzhIVkeRnBUrwygwdB04t89/1O/w1cDnyilFU=';
    $keyword1 = $keyword;
	$messages = flex_msg($keyword1);
    // Make a POST Request to Messaging API to reply to sender
    $url = 'https://api.line.me/v2/bot/message/reply';
    $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages],
            ];
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
    echo $result . "\r\n";
}
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) 
{
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text' && $event['source']['type'] == 'group')
        {
            $replyToken = $event['replyToken']; //เก็บ reply token เอาไว้ตอบกลับ
            $txtin = $event['message']['text'];
            $lineid = $event['source']['userId'];
            $sql_idsearch = "SELECT * FROM tbl_staff_psq WHERE line ='".$lineid."'";
            $idsearch_query = mysqli_query($conn,$sql_idsearch);
            $idfetch = mysqli_fetch_array($idsearch_query);
            $objid = mysqli_num_rows($idsearch_query);
            $check_search = substr($txtin,0,1);
            if($objid <> 0)
            {
                $hibot = substr($txtin,0,7);
                $source_type = $event['source']['type'];
                /*เปิดใช้งานกลุ่ม*/
                if($hibot == "/hibot:" AND $idfetch["status"] == "A")
                {
                    $group_id = $event['source']['groupId'];
                    $group_name = substr($txtin,7,strlen($txtin));
                    $fetch_existing_group = "SELECT * FROM tbl_psq_group WHERE group_id = '$group_id'";
					$group_result = mysqli_query($conn, $fetch_existing_group);
                    if(mysqli_num_rows($group_result) > 0) 
                    {
                        $obj_group = mysqli_fetch_array($group_result);
                        $send = "กลุ่มนี้ได้มีการลงทะเบียนใช้งาน PSQ V.2 เรียบร้อยแล้ว";
                        reply_msg($send,$replyToken);
						break;
                    }
                    $insert_group = "INSERT INTO tbl_psq_group(group_name,group_id,status) VALUES('$group_name','$group_id','A')";
                    mysqli_query($conn, $insert_group);
                    $send = "ลงทะเบียนกลุ่มและเปิดใช้งานเรียบร้อยแล้วเรียบร้อยแล้ว";
                    reply_msg($send,$replyToken);
                }
                /*คำสั่งบอท*/
                $sleepbot = substr($txtin,0,6);
                if($sleepbot == "/sleep" AND $idfetch["status"] == "A")
                {
                    $group_id = $event['source']['groupId'];
                    $group_sleep = "UPDATE tbl_psq_group SET status='I' WHERE group_id ='$group_id'";
                    mysqli_query($conn, $group_sleep);
                    $send = "ฝันดีจ้า";
                    reply_msg($send,$replyToken);
                }
                $weakup = substr($txtin,0,7);
                if($weakup == "/wakeup" AND $source_type == "group" AND $idfetch["status"] == "A")
                {
                    $group_id = $event['source']['groupId'];
                    $group_sleep = "UPDATE tbl_psq_group SET status='A' WHERE group_id ='$group_id'";
                    mysqli_query($conn, $group_sleep);
                    $send = say_hi();
                    reply_msg($send,$replyToken);
                }
            }
			/*เอาฮา*/
			if($txtin == "โคโยตี้")
			{
				$send = "อ่อเรื่องนี้ถามไผ่เลยครับ เค้าชำนาญมากๆๆ...";
				reply_msg($send,$replyToken);
				break;
			}
			/*เอาฮา*/
            /*ค้นหาทั่วไป*/
            if($check_search == "#" /*AND $source_type == "group"*/)
            {
                //เชคสถานะ group
				require('connect-db.php');
                $group_id = $event['source']['groupId'];
                $sql_group_status = "SELECT * FROM tbl_psq_group WHERE group_id = '$group_id'";
                $group_result = mysqli_query($conn, $sql_group_status);
				$nums = mysqli_num_rows($group_result);
                //$objGroupstatus = mysqli_fetch_array($group_result);
				if($objGroupstatus["status"] == "I" )
                {
                    $send ="Zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";
                    reply_msg($send,$replyToken);
                    break;
                }
				if($nums == 0)
				{
					$send ="กลุ่มนี้ยังไม่ได้ลงทะเบียน ";
                    reply_msg($send,$replyToken);
                    break;
				}
					$keyword = trim(substr($txtin,1,strlen($txtin)));
					reply_flex_msg($keyword,$replyToken);
            }
            /*ลงทะเบียนผู้ดูแลกลุ่ม*/
            $regis_check = substr($txtin,0,1);
            if($regis_check == "$")
            {
                $regis_code = $txtin;
                $sql_regis = "SELECT * FROM tbl_staff_psq WHERE code ='".$regis_code."'";
                $query_regis = mysqli_query($conn,$sql_regis);
                if(mysqli_num_rows($query_regis)>0)
                {
                    $obj_regis = mysqli_fetch_array($query_regis);
                    if($obj_regis["status"] == "A")
                    {
                        $send = "รหัสยืนยันนี้ได้มีการลงทะเบียนแล้วในชื่อ ".$obj_regis["name"]." ".$obj_regis["lastname"];
                        reply_msg($send,$replyToken);
                        break;
                    }
                    if($obj_regis["status"] == "I")
                    {
                        $sql_update = "UPDATE tbl_staff_psq SET line ='$lineid',status='A' WHERE code ='".$regis_code."'";
                        mysqli_query($conn,$sql_update);
                        $send = "สวัสดี ".$obj_regis["name"]." ".$obj_regis["lastname"]." ลงทะเบียนเรียบร้อยแล้ว";
                        reply_msg($send,$replyToken);
                        break;
                    }
                }
            }     
        }
    }
}
echo "OKJAA";