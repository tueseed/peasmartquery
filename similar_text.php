<hmtl>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0," charset="utf-8">
</head>
<body>
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
	$quick_key = similar("หม้อแปลง");
	//echo $quick_key[0];
	foreach($quick_key as $a)
	{
		$b = trim($a);
		echo $b." (".strlen($b).") ".substr($b,0,30)."<br>";
	}
?>
</body>
</html>