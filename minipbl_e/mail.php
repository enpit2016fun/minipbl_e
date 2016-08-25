<html>
<head>
<meta charset="UTF-8">
<title>メール作成</title>

</head>
<script>
// onclick="console.log(document.js.honbun.value);"
//<input type="text" value="testtarofun@gmail.com" name="address">
</script>
<body>
<?php 
$url="mailSelect.php";
$mailaddress = array ('','','','','','');
?>
	<form name="js" action="mail-2.php" method="GET"
		style="position: absolute; text-align: center; width: 800px;">
		<p>送信アドレス</p>
		<input type="button" value="送信グループ選択" name="address" onclick="javascript:window.open('<?php echo $url;?>' ,'subwindow' , 'Width:300px;height:300px;');">
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