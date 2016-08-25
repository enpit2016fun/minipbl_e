<?php
require_once('common.php');
session_start();
		$pdo = connectPDO();
                $e_name = $_SESSION['e_arr'][0];
				$e_date = $_SESSION['e_arr'][1];
				$e_img = $_SESSION['e_arr'][2];
				$e_text = $_SESSION['e_arr'][3];
				$e_number = $_SESSION['e_arr'][4];
             if(!empty($_SESSION['tmp_file']))
		if(isset($_POST["confirm"])){
			try{
                 $query = "INSERT INTO `event` (`event_name`, `event_date`, `event_img`, `event_text`, `event_number`)" . "VALUES (:e_name, :e_date, :e_img, :e_text, :e_number);";
                
                    echo $email;
					$stmt = $pdo -> prepare($query);
					$stmt -> bindParam(':e_name', $e_name, PDO::PARAM_STR);
					$stmt -> bindParam(':e_date', $e_date, PDO::PARAM_STR);
					$stmt -> bindParam(':e_img', $e_img, PDO::PARAM_STR);
					$stmt -> bindValue(':e_text', $e_text, PDO::PARAM_INT);
					$stmt -> bindValue(':e_number', $e_number, PDO::PARAM_INT);
					$stmt -> execute();
					header("Location:finished.php");
			}catch(PDOException $e){
				echo "ERROR:" . $e->getMessage();
			}
		}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>イベント管理システム-確認-</title>
<link rel="STYLESHEET" href="./css/add.css" type="text/css">
</head>
<body>
	<div id=site-box>
		<div id=head>
			<h2>登録内容を確認してください☆</h2>
		</div>
		<div id=main>
           <?php 
             echo "<table>"; 
             echo "<tr><th>イベントタイトル</th><th>".$e_name."</th></tr>";
             echo "<tr><th>開催日時</th><th>".$e_date."</th></tr>"; 
             echo "<tr><th>イベント詳細</th><th>".$e_text."</th></tr>"; 
             echo "</table>";
            ?>
			<form action='e_confirm.php' method='POST'>
				<input type="submit" name="confirm" id="confirm" value="完了" style="margin: 10px; float: right;" />
			</form>
            <form action='e_add.php' method='POST'>
				<input type="submit" name="revise" id="revise" value="修正" style="margin: 10px; float: right;" />
			</form>
		</div>
	</div>
</body>
</html>