<html>
<head>
<meta charset="UTF-8">
<title>メール作成</title>
<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" href="css/style.css" media="screen"
	type="text/css" />

</head>
<script>
// onclick="console.log(document.js.honbun.value);"
</script>
<body>

	<form name="js" action="mail-2.php" method="GET"
		style="position: absolute; text-align: center; width: 800px;">
		<p>送信アドレス</p>
		<input type="text" value="testtarofun@gmail.com" name="address">
		<p>タイトル</p>
		<input type="text" value="お花見しませんか" name="title">
		<p>本文</p>
		<textarea name="honbun" cols="50" rows="10" style="width: 50%;">お花見しませんね</textarea>
		<p>
			<input type="submit" value="確認">
		</p>
	</form>

</body>
</html>