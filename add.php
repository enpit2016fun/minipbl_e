<?php
require_once('common.php');
session_start();


//追加ボタンが押されていれば
if(isset($_POST["add"])){
        
    //初期化直後ならば
    if(!empty($_SESSION["USERID"])){
			//入力があれば開始
			if (!empty($_POST['email']) && !empty($_POST['p_name']) && !empty($_POST['c_name']) && !empty($_POST['graduation_year'])){
				$p_name = htmlspecialchars($_POST['p_name']);
				$c_name = htmlspecialchars($_POST['c_name']);
                $email = htmlspecialchars($_POST['email']);
				$graduation_year = $_POST['graduation_year'];
				$issend = $_POST['issend'];
				$infoarr = array($email,$p_name,$c_name,$graduation_year,$issend);
				$_SESSION['arr'] = $infoarr;
				$pdo = null;
				//ユーザID、パスワードが入力されていなかったらエラーメッセージを表示
			}else {
				echo "未入力の項目があります。";
			}                                     
    }else{
              $_SESSION['arr'] = array("","","","","");
	}
    header("Location:confirm.php");
}else{
     $_SESSION['arr'] = array("","","","","");
}                                                                      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<<<<<<< HEAD
<title>イベント管理システム-新規登録-</title>
<link rel="STYLESHEET" href="add.css" type="text/css">
</head>
<body>
	<div id="site-box">
		<div id="head">
			<h2>新規登録</h2>

		</div>
		<!-- #head -->
		<div id="main">
			<br />
			<form action='add.php' method='POST'>
				<table cellpadding="15">
					<tr>
						<th>親御さん氏名</th>
						<th><input type="text" name="p_name" id="p_name" size=60
							value="<?php echo $_SESSION['arr'][2];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>お子様氏名</th>
						<th><input type="text" name="c_name" id="c_name" size=60
							value="<?php echo $_SESSION['arr'][3];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
                    <tr>
						<th>メールアドレス</th>
						<th><input type="text" name="email" id="email" size=60
							value="<?php echo $_SESSION['arr'][0];?>" onkeyup="visible();"
							onchange="visible();" /></th>
					</tr>
					<tr>
						<th>卒業年度</th>
						<th align="left">
                        <select name = "graduation_year"  onchange = "visibleByselect();">
                        <option value = "2016" selected>2016年度</option>
                        <option value = "2015">2015年度</option>
                        <option value = "2014">2014年度</option>
                        <option value = "2013">2013年度</option>
                        <option value = "2012">2012年度</option>
                        <option value = "2011">2011年度</option>
                        <option value = "2010">2010年度</option>
                        <option value = "2009">2009年度</option>
                        <option value = "2008">2008年度</option>
                        <option value = "2007">2007年度</option>
                        </select>
						</th>
					</tr>
					<tr>
						<th>配信希望</th>
						<th align="left">
                        <input name="issend" type="hidden" value="0" />
                        <input name="issend" type="checkbox" value="1"　onchange = "visibleByselect()"; checked/>
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
var email = getField("email");
var p_name = getField("p_name");
var c_name = getField("c_name");
var disabled = true;

	if(email.value.length > 0 && p_name.value.length > 0 && c_name.value.length > 0){
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
		location.href = "Login.php";
}
</script>
</body>
</html>
<?php
$pdo = null;
?>