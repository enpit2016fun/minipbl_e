<?php
require_once('common.php');
session_start();
		$pdo = connectPDO();
                $email = $_SESSION['arr'][0];
				$p_name = $_SESSION['arr'][1];
				$c_name = $_SESSION['arr'][2];
				$graduation_year = $_SESSION['arr'][3];
				$issend = $_SESSION['arr'][4];
		if(isset($_POST["confirm"])){
			try{
                 $query = "INSERT INTO `member` (`email`, `p_name`, `c_name`, `graduation_year`, `issend`)" . "VALUES (:email, :p_name, :c_name, :graduation_year, :issend);";
                
                    echo $email;
					$stmt = $pdo -> prepare($query);
					$stmt -> bindParam(':email', $email, PDO::PARAM_STR);
					$stmt -> bindParam(':p_name', $p_name, PDO::PARAM_STR);
					$stmt -> bindParam(':c_name', $c_name, PDO::PARAM_STR);
					$stmt -> bindValue(':graduation_year', $graduation_year, PDO::PARAM_INT);
					$stmt -> bindValue(':issend', $issend, PDO::PARAM_INT);
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
<link rel="STYLESHEET" href="list.css" type="text/css">
</head>
<body>
	<div id=site-box>
		<div id=head>
			<h2>登録内容を確認してください☆</h2>
		</div>
		<div id=main>
           <?php 
             echo "<table>"; 
             echo "<tr><th>氏名</th><th>".$p_name."</th></tr>";
             echo "<tr><th>お子さんの氏名</th><th>".$c_name."</th></tr>"; 
             echo "<tr><th>メールアドレス</th><th>".$email."</th></tr>"; 
             echo "<tr><th>卒業年度</th><th>".$graduation_year."年度</th></tr>"; 
             if($issend == 1) echo "<tr><th>配信希望</th><th>あり</th></tr>";
             else echo "<tr><th>配信希望</th><th>".$p_name."</th></tr>"; 
             echo "</table>";
            ?>
			<form action='confirm.php' method='POST'>
				<input type="submit" name="confirm" id="confirm" value="完了" style="margin: 10px; float: right;" />
			</form>
            <form action='add.php' method='POST'>
				<input type="submit" name="revise" id="revise" value="修正" style="margin: 10px; float: right;" />
			</form>
		</div>
	</div>
</body>
</html>