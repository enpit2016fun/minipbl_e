<?php
require_once('common.php');
require_once('password.php');
session_start();
//ログイン済じゃなければ
if(empty($_SESSION["USERID"])){

	//ログインボタンが押されていれば
	if(isset($_POST["login"])){
		try{
			//入力があれば開始
			if (!empty($_POST['user_id']) && !empty($_POST['pw'])){
				$user_id = htmlspecialchars($_POST['user_id']); //入力されたユーザID
				$pw = htmlspecialchars($_POST['pw']); //入力されたパスワード

				//データベースに接続する
				$pdo = connectPDO();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

				$query = "select * from t_staff where user_id=:user_id";
				$stmt = $pdo ->prepare($query);
				$stmt -> bindParam('user_id', $user_id, PDO::PARAM_STR);
				$stmt->execute();

				$pass = ""; //初期化
				while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
					$pass = $row['pw'];
				}

				//パスワードが一致していたらセッションIDを発行して、社員一覧に移動
				if($pass != ""){
					if($pass == $pw){
						$_SESSION["USERID"] = $user_id;
						$a = session_name();
						// echo $a;
						header("Location:List.php");
						//パスワードが不一致だったらエラーメッセージを表示
					}else{
						echo "ユーザID　または　パスワードが間違っています。";
					}
					$pdo = null;
				}else{
					echo "ユーザID　または　パスワードが間違っています。";
				}
				//ユーザID、パスワードが入力されていなかったらエラーメッセージを表示
			}else {
				echo "ユーザID　または　パスワードが未入力です。";
			}
			//エラーが出たときの処理
		}catch(PDOException $e){
			echo "ERROR";
		}
	}
	else{
	}
}else{
	header("Location:List.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ログイン-社員一覧システム</title>
<link rel="STYLESHEET" href="login.css" type="text/css">
</head>
<body>
	<div id=site-box>
		<div id=head>
			<h2>ログイン</h2>
		</div>
		<div id=main>
			<form action='Login.php' method='POST'>
				<br /> ユーザID <br /> <br />
				<input type="text" name="user_id" size=60 />
				<br /> <br /> <br /> パスワード <br /> <br />
				<input type="password" name="pw" size=60 /> <br /> <br /> <br />
				<input type="submit" name="login" value="ログイン" style="margin: 10px; float: right;" />
				<input type="submit" value = "リセット" style="margin: 10px; float:right;" />
			</form>
		</div>
	</div>
</body>
</html>
