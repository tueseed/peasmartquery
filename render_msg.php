<?php

function similar($keyword)

{

	require('connect-db.php');

	$sql_text = "SELECT * FROM tbl_standard";

	$query_text = mysqli_query($conn,$sql_text);

	$similar_ar = array();

	while($obj_text = mysqli_fetch_array($query_text))

	{

		$keyword_explode = explode(",",$obj_text["keyword"]);

		foreach($keyword_explode as $key)

		{

			if($key <> "")

			{

				$compare = similar_text($keyword,$key,$per);

				$similar_ar[$key] = $per;

			}

		}

	}

	arsort($similar_ar);

	$quick_key = array();

	$i = 1;

	foreach($similar_ar as $k => $v)

	{

		if($v < 100)

		{

			if($i <= 13 )

			{

				array_push($quick_key,$k);

				//echo $i.".".$k."-----".$v."<br>";

			}

		$i = $i+1;

		}

		 

	}

	return $quick_key;

}

function flex_msg($keyword)

{

	require('connect-db.php');

	$quick_key = similar($keyword);

	$keyword_en = base64_encode($keyword);

	$sql_key_search = "SELECT * FROM tbl_standard WHERE keyword LIKE '%".$keyword."%' OR doc_no LIKE '%".$keyword."%' OR discription LIKE '%".$keyword."%'";

	$key_query = mysqli_query($conn,$sql_key_search);

    $numrows = mysqli_num_rows($key_query);

	$objsearch = mysqli_fetch_array($key_query);

	

	if($numrows > 1)

	{

		$url = "line://app/1544181630-JP9L0Xmj?keyword=".$keyword_en;

		$url1 = "https://peasmartquery.herokuapp.com/result.php?keyword=".$keyword_en;

		$txtresult = "จำนวน ".$numrows." รายการ";

		$btn_txt = "รายละเอียดเพิ่มเติม(MOBILE)";

		$btn_txt1 = "รายละเอียดเพิ่มเติม(PC)";

	}

	else if($numrows == 1)

	{

		$url = "line://app/1544181630-l71VdJ0m?link=".$objsearch["id"];

		$url1 = $objsearch["link"];

		$txtresult = "จำนวน ".$numrows." รายการ";

		$btn_txt = "รายละเอียดเพิ่มเติม(MOBILE)";

		$btn_txt1 = "รายละเอียดเพิ่มเติม(PC)";

	}

	else if ($numrows < 1)

	{

		$url = "line://ti/p/tueseed";

		$url1 = "line://ti/p/tueseed";

		$txtresult = "ไม่พบข้อมูล";

		$btn_txt = "ติดต่อผู้ดูแล(โทร)";

		$btn_txt1 = "ติดต่อผู้ดูแล(ไลน์)";

	}

	$json1 = '{

				"type":"flex",

				"altText":"PSQ V.2",

				"contents":{

								"type": "bubble",

								"hero": {

											"type": "image",

											"url": "https://peasmartquery.herokuapp.com/PSQV2.png",

											"size": "full",

											"aspectRatio": "20:13",

											"aspectMode": "cover",

											"action": {

														"type": "uri",

														"uri": "https://peasmartquery.herokuapp.com/PSQV2.png"

														}

										},

								"body": {

											"type": "box",

											"layout": "vertical",

											"contents": [{

															"type": "text",

															"text": "ผลการค้นหา",

															"weight": "bold",

															"align":"center",

															"size": "md"

														},

														{

															"type": "text",

															"text": "คำว่า '.$keyword.'",

															"weight": "bold",

															"align":"center",

															"size": "sm"

														},

														{

															"type": "text",

															"text": "'.$txtresult.' ",

															"weight": "bold",

															"align":"center",

															"size": "sm"

														},

														{

															"type": "separator",

															"margin": "xxl"

														}]

										},

								"footer": {

											"type": "box",

											"layout": "vertical",

											"spacing": "sm",

											"contents": [

												{

													"type": "button",

													"style": "primary",

													"height": "sm",

													"action": {

																"type": "uri",

																"label": "'.$btn_txt.'",

																"uri": "'.$url.'"

															}

												},

												{

													"type": "button",

													"style": "primary",

													"height": "sm",

													"action": {

																"type": "uri",

																"label": "'.$btn_txt1.'",

																"uri": "'.$url1.'"

															}

												},

												{

													"type": "button",

													"style": "primary",

													"height": "sm",

													"action": {

																"type": "uri",

																"label": "ค้นหาแบบส่วนตัว(ทดลองใช้)",

																"uri": "line://app/1544181630-9YeX5qxR"

															}

												},

												{

													"type": "spacer",

													"size": "sm"

												}

												],

									"flex": 0

									}

									

				},

				"quickReply": {

													"items": [

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[0],0,30).'",

																				"text": "#'.$quick_key[0].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[1],0,30).'",

																				"text": "#'.$quick_key[1].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[2],0,30).'",

																				"text": "#'.$quick_key[2].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[3],0,30).'",

																				"text": "#'.$quick_key[3].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[4],0,30).'",

																				"text": "#'.$quick_key[4].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[5],0,30).'",

																				"text": "#'.$quick_key[5].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[6],0,30).'",

																				"text": "#'.$quick_key[6].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[7],0,30).'",

																				"text": "#'.$quick_key[7].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[8],0,30).'",

																				"text": "#'.$quick_key[8].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[9],0,30).'",

																				"text": "#'.$quick_key[9].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[10],0,30).'",

																				"text": "#'.$quick_key[10].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[11],0,30).'",

																				"text": "#'.$quick_key[11].'"

																			}

																},

																{

																	"type": "action",

																	"action": {

																				"type": "message",

																				"label": "'.substr($quick_key[12],0,30).'",

																				"text": "#'.$quick_key[12].'"

																			}

																}

															]

												}

	}';

	$result = json_decode($json1);

	return $result;

}

?>