<?php
require('connect-db.php');   
header("Content-Type: application/json");	
$method = $_SERVER["REQUEST_METHOD"];
if($method == "POST")
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$keyword = $json->result->parameters->text;
	$sql_std = "SELECT * FROM tbl_standard WHERE keyword LIKE '%".$keyword."%' OR doc_no LIKE '%".$keyword."%' OR discription LIKE '%".$keyword."%'";
    $result = mysqli_query($conn,$sql_std);  
	$num_row = mysqli_num_rows($result);
	$link1 = "https://nutt-i.com/psqv2/result.php?keyword=".$keyword;
	$txtresponse = "ฉันค้นพบมาตรฐานเกี่ยวกับ  ".$keyword." จำนวน ".$num_row." รายการ";
	

	$messages = [];
	 // Adding simple response (mandatory)
  array_push($messages, array(
     "type"=> "simple_response",
     "platform"=> "google",
     "textToSpeech"=> $txtresponse
    )
  );
// Building Card
 array_push($messages, array(
    "type"=> "basic_card",
    "platform"=> "google",
    "title"=> "ผลการค้นหา",
    "subtitle"=> "ผลการค้นหามาตรฐานที่มีคำว่า ".$keyword,
    "image"=>[
      "url"=>'https://nutt-i.com/psqv2/mr-std.png',
      "accessibilityText"=>'PICTURE Text'
      ],
      "formattedText"=> 'คำตอบโดย คุณมาตรฐาน',
      "buttons"=> [
        [
          "title"=> "ดูรายละเอียด",
          "openUrlAction"=> [
            "url"=> $link1
            ]
          ]
        ]
      )
   );
 
  $response=array(
          "source" => $request["result"]["source"],
          "speech" => "Speech for response",
          "messages" => $messages,
          "contextOut" => array()
      );
	header("Content-Type: application/json");
	echo json_encode($response);	
}else{
	echo "Method Not allow";
}



?>