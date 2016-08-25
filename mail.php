<?php
session_start ();
?>

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

	<form name="js" action="mail-2.php" method="GET"
		style="position: absolute; text-align: center; width: 800px;">
		
		<?php
		$url = "mailSelect.php";
		?>
		<p>送信アドレス</p>
		<input type="button" value="送信グループ選択" name="addressSelect"
			onclick="javascript:window.open('<?php echo $url;?>' ,'subwindow' , 'Width:300px;height:300px;');">
		<input type="text"
			value="<?php
			// echo "g2116028@fun.ac.jp";
			// if(!empty($_SESSION['m_email'])){
			// for($m = 0; $m <= 4; $m ++) {
			// if ($m <= 3) {
			// echo $_SESSION['m_email'][$m] . ",";
			// } else {
			// echo $_SESSION['m_email'][$m];
			// }
			//
			// }
			// }
			?>"
			name="address">
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