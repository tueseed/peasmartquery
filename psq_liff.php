<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSQ V.2</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<script src="https://d.line-scdn.net/liff/1.0/sdk.js"></script>
    <script src="liff-starter.js"></script>
	<div class="container">
		<form action = "check_uid.php" id = "formcheck" name = "formcheck" method = "post">
		<input type="hidden" name="useridfield" id="useridfield" name="useridfield">
		<!--<p type ="id="useridfield" name="useridfield"" id="useridfield" name="useridfield"></p>-->
		</form>
	</div>
</body>
<script type="text/javascript">
	setTimeout(function(){formAutoSubmit()}, 3000);
	function formAutoSubmit () 
	{
		var frm = document.getElementById("formcheck");
		frm.submit();
	}
</script>
</html>