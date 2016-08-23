<?php
require_once('common.php');
require_once('password.php');

if(loginCheck() == 1){
	if(administratorCheck() == 0){
		header("Location:logout.php");
	}else{
		$pdo = connectPDO();

		if(!isset($_POST["add"])){
			$_SESSION['arr'] = array("","","","","","","");
		}else{
			try{
				$user_id = htmlspecialchars($_POST['user_id']);
				$pw = htmlspecialchars($_POST['pw']);
				$name = htmlspecialchars($_POST['name']);
				$name_kana = htmlspecialchars($_POST['name_kana']);
				$group_cd = $_POST['group'];
				$hobby = htmlspecialchars($_POST['hobby']);
				$administrator = $_POST['administrator'];
				$infoarr = array($user_id,$pw,$name,$name_kana,$group_cd,$hobby,$administrator);
				$errorCheck = inputCheck($user_id,$pw,$name,$name_kana,$group_cd,$hobby);


					$_SESSION['arr'] = $infoarr;

				if($errorCheck == ""){
					$query = "INSERT INTO `staffsystem`.`t_staff`
					(`user_id`,`pw`,`name`,`name_kana`,`group_cd`,`hobby`,`administrator`)"
					. " VALUES(?,?,?,?,?,?,?)";

					$stmt = $pdo -> prepare($query);
					$stmt -> bindParam(1, $user_id, PDO::PARAM_STR);
					$stmt -> bindParam(2, $pw, PDO::PARAM_STR);
					$stmt -> bindParam(3, $name, PDO::PARAM_STR);
					$stmt -> bindParam(4, $name_kana, PDO::PARAM_STR);
					$stmt -> bindParam(5, $group_cd, PDO::PARAM_INT);
					$stmt -> bindParam(6, $hobby, PDO::PARAM_STR);
					$stmt -> bindParam(7, $administrator, PDO::PARAM_INT);
					$stmt -> execute();
					header("Location:List.php");
				}else{
					echo $errorCheck;
				}
			}catch(PDOException $e){
				echo "ERROR:" . $e->getMessage();
			}
		}

	}
}else{
	header("Location:Login.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>新規作成-社員一覧システム</title>
<link rel="STYLESHEET" href="add.css" type="text/css">
</head>
<body>
	<div id="site-box">
		<div id="head">
			<h2>新規作成</h2>
		</div>
		<!-- #head -->
		<div id="main">
			<br />
			<form action='add.php' method='POST'>
				<table cellpadding="15">
					<tr>
						<th>ユーザID</th>
						<th><input type="text" name="user_id" id="user_id" size=60
							value="<?php echo $_SESSION['arr'][0];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>パスワード</th>
						<th><input type="password" name="pw" id="pw" size=60
							value="<?php echo $_SESSION['arr'][1];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>氏名</th>
						<th><input type="text" name="name" id="name" size=60
							value="<?php echo $_SESSION['arr'][2];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>ﾌﾘｶﾞﾅ</th>
						<th><input type="text" name="name_kana" id="name_kana" size=60
							value="<?php echo $_SESSION['arr'][3];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>所属</th>
						<th align="left"><?php
						$ini = 0;
						echo selectboxCreate($pdo,$ini,4);
						?>
						</th>
					</tr>
					<tr>
						<th>趣味</th>
						<th><input type="text" name="hobby" id="hobby" size=60
							value="<?php echo $_SESSION['arr'][5];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>管理者</th>
						<th align="left">
						<?php
						echo displayCheck($ini,6);
						?>
						 </th>
					</tr>
				</table>
				<div id = "foot">
					<input type="submit" name="add" id="add" value="追加する" style=" margin: 10px;" disabled />
					<input type="reset" value ="リセット" style=" margin: 10px;" />
					<input type="button" value="戻る" onclick="tolistback()" style=" margin: 10px;">
			</div>
			</form>


	</div>
	<!-- #main -->
	</div>
	<script>
function visible(){
var userid = getField("user_id");
var pw = getField("pw");
var name = getField("name");
var namekana = getField("name_kana");
var hobby = getField("hobby");
var disabled = true;

	if(userid.value.length > 0 && pw.value.length > 0 && name.value.length > 0 && namekana.value.length > 0 && hobby.value.length > 0){
	 disabled = false;
	}
	 var add = getField("add");
	    if (disabled) {
	        add.setAttribute("disabled", "disabled");
	    }
	    else {
	        add.removeAttribute("disabled");
	    }
}

function getField(fieldName){
    var field = document.getElementById(fieldName);
    if (field == undefined) {
        throw new Error("要素が見つかりません: " + fieldName);
    }
    return field;
}

function tolistback(){
		location.href = "List.php";
}
</script>
</body>
</html>
<?php
$pdo = null;
?>