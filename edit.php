<?php
require_once('common.php');

if(loginCheck() == 1){
	if(administratorCheck() == 0){
		header("Location:logout.php");
	}else{
		//データが選択されてなければ
		if(!isset($_SESSION['edituid'])){
			header("Location:List.php");
		}else{
		$pdo = connectPDO();

		if(!isset($_POST["edit"])){
			$ini = 1;
			$_SESSION['arr'] = array("","","","","","","");
			$equery = "select * from t_staff where user_id = :user_id";
			$estmt = $pdo->prepare($equery);
			$estmt -> bindParam('user_id', $_SESSION['edituid'], PDO::PARAM_STR);
			$estmt->execute();
			while($row = $estmt->fetch(PDO::FETCH_ASSOC)){
				$_SESSION['iniarr'] = array($row['pw'],$row['name'],$row['name_kana'],$row['group_cd'],$row['hobby'],$row['administrator']);
			}
		}else{
			try{
				$ini = 0;
				$user_id = "";
				$pw = htmlspecialchars($_POST['pw']);
				$name = htmlspecialchars($_POST['name']);
				$name_kana = htmlspecialchars($_POST['name_kana']);
				$group_cd = $_POST['group'];
				$hobby = htmlspecialchars($_POST['hobby']);
				$administrator = $_POST['administrator'];
				$infoarr = array($pw,$name,$name_kana,$group_cd,$hobby,$administrator);
				$errorCheck = inputCheck($user_id,$pw,$name,$name_kana,$group_cd,$hobby);

					$_SESSION['arr'] = $infoarr;

				if($errorCheck == ""){
					$query = "UPDATE `staffsystem`.`t_staff` SET `pw` = ?,`name` = ? ,`name_kana` = ?,`group_cd` = ?,`hobby` = ?,`administrator` = ? WHERE `t_staff`.`user_id` = ?;";

					$stmt = $pdo -> prepare($query);
					$stmt -> bindParam(1, $pw, PDO::PARAM_STR);
					$stmt -> bindParam(2, $name, PDO::PARAM_STR);
					$stmt -> bindParam(3, $name_kana, PDO::PARAM_STR);
					$stmt -> bindParam(4, $group_cd, PDO::PARAM_INT);
					$stmt -> bindParam(5, $hobby, PDO::PARAM_STR);
					$stmt -> bindParam(6, $administrator, PDO::PARAM_INT);
					$stmt -> bindParam(7, $_SESSION['edituid'], PDO::PARAM_STR);
					$stmt -> execute();

					//編集系のセッションの初期化
					if(isset($_SESSION['iniarr'])){
					    unset($_SESSION['edituid']);
						unset($_SESSION['iniarr']);
					}
					header("Location:List.php");
				}else{
					echo $errorCheck;
				}
			}catch(PDOException $e){
				echo "ERROR:" . $e->getMessage();
			}
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
<title>編集-社員一覧システム</title>
<link rel="STYLESHEET" href="add.css" type="text/css">
</head>
<body>
	<div id="site-box">
		<div id="head">
			<h2>編集</h2>
		</div>
		<!-- #head -->
		<div id="main">
			<br />
			<form action='edit.php' method='POST'>
				<table cellpadding="15">
					<tr>
						<th></th>
						<th>ユーザIDは変更できません。</th>
					</tr>
					<tr>
						<th>パスワード</th>
						<th><input type="password" name="pw" id="pw" size=60
							value="<?php echo displayStr(0,$ini);?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>氏名</th>
						<th><input type="text" name="name" id="name" size=60
							value="<?php echo displayStr(1,$ini);?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>ﾌﾘｶﾞﾅ</th>
						<th><input type="text" name="name_kana" id="name_kana" size=60
							value="<?php echo displayStr(2,$ini);?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>所属</th>
						<th align="left"><?php
						echo selectboxCreate($pdo,$ini,3);
						?>
						</th>
					</tr>
					<tr>
						<th>趣味</th>
						<th><input type="text" name="hobby" id="hobby" size=60
							value="<?php echo displayStr(4,$ini);?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>管理者</th>
						<th align="left">
						<?php echo displayCheck($ini,5);?>
						 </th>
					</tr>
				</table>
				<div id = "foot">
					<input type="submit" name="edit" id="edit" value="更新 " style=" margin: 10px;" disabled />
					<input type="reset" value ="リセット" style=" margin: 10px;" />
					<input type="button" value="戻る" onclick="tolistback()" style=" margin: 10px;">
			</div>
			</form>


	</div>
	<!-- #main -->
	</div>
	<script>
	//ボタンの有効、無効判定
function visible(){
var pw = getField("pw");
var name = getField("name");
var namekana = getField("name_kana");
var hobby = getField("hobby");
var disabled = true;

	if(pw.value.length > 0 && name.value.length > 0 && namekana.value.length > 0 && hobby.value.length > 0){
	 disabled = false;
	}
	 var edit = getField("edit");
	    if (disabled) {
	        edit.setAttribute("disabled", "disabled");
	    }
	    else {
	        edit.removeAttribute("disabled");
	    }
}

//セレクトボックスの変化によるボタンの有効、無効判定
function visibleByselect(){
    var disabled = false;
    var edit = getField("edit");
    if (disabled) {
        edit.setAttribute("disabled", "disabled");
    }
    else {
        edit.removeAttribute("disabled");
    }
}

	//値の取得
function getField(fieldName){
    var field = document.getElementById(fieldName);
    if (field == undefined) {
        throw new Error("要素が見つかりません: " + fieldName);
    }
    return field;
}

	//社員一覧画面への遷移
function tolistback(){
		location.href = "List.php";
}
</script>
</body>
</html>
<?php
$pdo = null;
?>