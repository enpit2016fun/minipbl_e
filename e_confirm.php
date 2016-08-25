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
					header("Location:e_finished.php");
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
<link rel="STYLESHEET" href="./css/confirm.css" type="text/css">
</head>
<body>
	<div id=site-box>

<div id="cform-main">
<div id="cform-div">
<form class="cform" id="cform">

<div class="sub">

<h2 align="center">登録内容を確認してください⭐︎</h2>
</div>
<p class="e_name">
<input type="text" name="e_name" id="e_name"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder=$p_name
id="e_name"　size=20
value="<?php echo $e_name;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>

<p class="e_date">
<input type="text" name="e_date" id="e_date"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="お子さんの名前"
id="e_date"　size=20
value="<?php echo $e_date;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>

<p class="e_text">
<input type="text" name="e_text" id="e_text"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="メールアドレス"
id="e_text"　size=20
value="<?php echo $e_text;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>
</form>
</form>
		<div id=main>


			<form action='e_confirm.php' method='POST'>
				<input type="submit" name="confirm" id="confirm" value="完了"  />
			</form>
            <form action='e_add.php' method='POST'>
				<input type="submit" name="revise" id="revise" value="修正"  />
			</form>
		</div>
	</div>
</body>
</html>