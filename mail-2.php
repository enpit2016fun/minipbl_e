<html>
<head>
<meta charset="UTF-8">
<title>メール確認</title>
<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" href="css/style.css" media="screen"
	type="text/css" />

</head>

<body>
	<form name="js" action="mail-3.php" method="GET"
		style="position: absolute; text-align: center; width: 100%;">
		<p>送信アドレス</p>
		<input type="text" name="address"
			value="<?php echo $_GET['address']; ?>" readonly />
		<p>タイトル</p>
		<input type="text" name="title" value="<?php echo $_GET['title']; ?>"
			readonly />
		<p>本文</p>
		<textarea name="honbun" cols="50" rows="10" style="width: 50%;"
			readonly /><?php echo $_GET['honbun']; ?></textarea>
		<p></p>
			<?php echo "この内容でよろしいですか？"?>
			<p>
			<input type="submit" value="送信"> <input type="button" value="戻る"
				onclick="history.go(-1)">
		</p>
	</form>

</body>
</html>