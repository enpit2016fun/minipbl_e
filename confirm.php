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
                    echo $issend_flag;
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
    if($issend == 1)  $issend_flag = "許可";
    else  $issend_flag = "不可";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>イベント管理システム-確認-</title>
<link rel="STYLESHEET" href="confirm.css" type="text/css">
</head>
<body>
	<div id="site-box">
		<div id="head">

		</div>
            <div id="cform-main">
            <div id="cform-div">
            <form class="cform" id="cform">

<div class="sub">

<h2 align="center">登録内容を確認してください⭐︎</h2>
</div>
<p class="cp_name">
<input type="text" name="cp_name" id="cp_name"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder=$p_name
id="cp_name"　size=20
value="<?php echo $p_name;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>

<p class="cc_name">
<input type="text" name="cc_name" id="cc_name"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="お子さんの名前"
id="cc_name"　size=20
value="<?php echo $c_name;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>

<p class="cemail">
<input type="text" name="cemail" id="cemail"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="メールアドレス"
id="cemail"　size=20
value="<?php echo $email;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>

<p class="graduate">
<input type="text" name="graduate" id="graduate"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="お子さんの名前"
id="graduate"　size=20
value="<?php echo $graduation_year;?>" onkeyup="visible();"
onchange="visible();" readonly/>
</p>

<p class="deli">
<input type="text" name="deli" id="deli"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="メールアドレス"
id="deli"　size=20
value="<?php echo $issend_flag;?>" onkeyup="visible();"
onchange="visible();" readonly/>

</p>
 </form>
</form>			<form action='confirm.php' method='POST'>
				<input type="submit" name="confirm" id="confirm" value="完了"  />
			</form>
            <form action='add.php' method='POST'>
				<input type="submit" name="revise" id="revise" value="修正"  />
			</form>

		</div>
	</div>
</body>
</html>