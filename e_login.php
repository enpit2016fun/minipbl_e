<?php
require_once('common.php');
session_start();

$_SESSION["USERID"] = 1;
if(isset($_POST["new"]) || isset($_POST["change"])) header("Location:e_add.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<title>つくしの子幼稚園名簿登録</title>
    <link rel="STYLESHEET" href="add.css" type="text/css">
    <link rel="STYLESHEET" href="./css/all.css" type="text/css">
</head>
<body>
	<div id=site-box>
		<div id=main>
            <h1>イベント登録</h1>
			<form action='e_login.php' method='POST'>
				<input type="submit" name="new" id = "new" value="イベントを登録する" style="margin: 10px; float: right;" />
				<input type="submit" name="change" id="change" value = "メールを送信する" style="margin: 10px; float:right;" />

			</form>
		</div>
	</div>
</body>
</html>
