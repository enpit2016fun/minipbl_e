<html>
<head>
<title>このページの最終更新日時</title>
</head>
<script>

function mailsend(){
	var mailto = document.js.toMail.value;
	var title = document.js.title.value;
	var mainSentence = document.js.mainSentence.value;
	location.href = "mailto:" + mailto + "?subject=" + title + "&body=" + mainSentence;
}

		</script>

<body>
<?php
echo "Hello, World!";
?> 
		<form name="js" style="position:absolute;text-align:center;width:800px;">
		<p>送信アドレス<p/>
			<input type="text" name="fromMail">
		<p>受信アドレス</p>
			<input type="text" value="testtarofun@gmail.com" name="toMail">
		<p>タイトル</p>
			<input type="text" name="title">
		<p>本文</p>
			 <textarea name="mainSentence" cols="50" rows="10" style="width:50%;"></textarea>
		<p><input type="button" value="確認" onclick="mailsend();"></p>
	</form>

</body>
</html>