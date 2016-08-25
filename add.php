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
<title>イベント管理システム-新規登録-</title>
<link rel="STYLESHEET" href="./css/add.css" type="text/css">
</head>
<body>
<form action='add.php' method='POST'>

	<div id="site-box">
		<div id="head">

		</div>
		<!-- #head -->
<div id="form-main">
<div id="form-div">
<form class="form" id="form">

<div class="sub">

<h2 align="center">新規登録</h2>
</div>

<p class="p_name">
<input type="text" name="p_name" id="p_name"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="親御さんのお名前"
id="p_name"　size=20
value="<?php echo $_SESSION['arr'][2];?>" onkeyup="visible();"
onchange="visible();" />
</p>

<p class="c_name">
<input type="text" name="c_name" id="c_name"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="お子さんの名前"
id="c_name"　size=20
value="<?php echo $_SESSION['arr'][3];?>" onkeyup="visible();"
onchange="visible();" />
</p>
<p class="email">
<input type="text" name="email" id="email"
class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="メールアドレス"
id="email"　size=20
value="<?php echo $_SESSION['arr'][1];?>" onkeyup="visible();"
onchange="visible();" />
</p>
<div class="style-select slate">
						<th align="left">
                        <div id="mainselection1">
                        <select name = "graduation_year"  onchange = "visibleByselect();">
                        <option value = "" selected>卒業年度</option>
                        <option value = "2016">2016年度</option>
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
                        </div>
						</th>
					</tr>

                        <th align="left">
                        <div id="mainselection2">
                        <select name = "issend"  onchange = "visibleByselect();">
                        <option value = "" selected>配信希望</option>
                        <option value = "1">許可</option>
                        <option value = "0">不可</option>

                    </select>
                    </div>
                    </th>

</div>

</font>
<div id = "foot">
<input type="submit" name="add" id="add" value="追加する" style=" margin: 9px;" disabled />
<input type="reset" value ="リセット" style=" margin: 9px;" />
<input type="button" value="戻る" onclick="tolistback()" style=" margin: 9px;">
</div>

</form>
</form>

</div>
</div>
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