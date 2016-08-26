<html>
<head>
<meta charset="UTF-8">
<title>送信完了</title>
<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" href="css/style.css" media="screen"
	type="text/css" />

</head>
<body>

	<form name="js"
		style="position: absolute; text-align: center; width: 100%; top: 10%;">
		<?php
$mailto = $_GET ['address'];
$subject = $_GET ['title'];
$content = $_GET ['honbun'];
;
$mailfrom = "From:testtarofun@yahoo.co.jp";

mb_language ( "ja" );
mb_internal_encoding ( "UTF-8" );

if (mb_send_mail ( $mailto, $subject, $content, $mailfrom )) {
	echo "送信が完了しました";
} else {
	echo "送信できませんでした";
}
?>
		<p name="kanryo"></p>
		<p>送信アドレス</p>
		<input type="text" name="address"
			value="<?php echo $_GET['address']; ?>" readonly />
		<p>タイトル</p>
		<input type="text" name="title" value="<?php echo $_GET['title']; ?>"
			readonly />
		<p>本文</p>
		<textarea name="honbun" cols="50" rows="10" style="width: 50%;"
			readonly /><?php echo $_GET['honbun']; ?></textarea>

	</form>

</body>
</html>