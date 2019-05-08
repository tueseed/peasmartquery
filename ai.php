<?php
require('connect-db.php');   
header("Content-Type: application/json");	
$method = $_SERVER["REQUEST_METHOD"];
if($method == "POST")
{
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);
	$keyword = $json->queryResult->parameters->text;
	$sql_std = "SELECT * FROM tbl_standard WHERE keyword LIKE '%".$keyword."%' OR doc_no LIKE '%".$keyword."%' OR discription LIKE '%".$keyword."%'";
    $result = mysqli_query($conn,$sql_std);  
	$num_row = mysqli_num_rows($result);
	$link1 = "https://nutt-i.com/psqv2/result.php?keyword=".$keyword;
	$txtresponse = "ค้นพบมาตรฐานเกี่ยวกับ  ".$keyword." จำนวน ".$num_row." รายการ";
	
	$buttonObject = array(
		    'title' => 'test',
		    'openUrlAction' => array(
			    'url' => 'https://nutt-i.com',
			)
	    );

	
	$response = new stdclass();
	$basicCard = array(
	   		'basicCard' => array(
			   'title' => 'test',
			   'subtitle' => 'test',
			   'formattedText' => 'test',
			   'image' => 'https://assistant.google.com/static/images/molecule/Molecule-Formation-stop.png',
			   'buttons' => array($buttonObject),
			   'imageDisplayOptions' => 'DEFAULT',
		   )
	   );
	$integrations = array(
		   'google' => array(
			   'expectUserResponse' => 'true',
			   'richResponse' => array(
				   'items' => array($basicCard)
			   )
		   )
	   );
	$fulfillmentMessages = array();
	$speech = array(
		   'simpleResponse' => array(
			   'textToSpeech' => 'HI THIS ...',
			   'displayText' => 'HI THIS .....'
			)
		);
	$response = array(
		   'fulfillmentText' => array($speech),	
			'fulfillmentMessages' => array($fulfillmentMessages),
		   'payload' => array($integrations),		   
	   );
	   //$response = array($integrations);
	header("Content-Type: application/json");
	echo json_encode($response);	
}else{
	echo "Method Not allow";
}



?>