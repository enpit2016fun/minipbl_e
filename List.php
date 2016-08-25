<?php
require_once('common.php');

header("Content-Type: text/html; charset=utf-8");
if(loginCheck() == 1){
	$pdo = connectPDO();
}else{
	header("Location:Login.php");
}

/**
 * 社員一覧の表作成、管理者の場合は新規作成ボタンと削除ボタンと編集ボタンを表示する。
 * @param unknown_type $pdo
 */
function tableCreate($pdo){
	if(administratorCheck() == 0){
		echo "<br/><br/><br/>";
	}else{
		echo "<form action = 'add.php' method = 'POST'>";
		echo "<input type = \"submit\" name = \"newid\" value = \"新規作成\" style=\"margin:10px; float:left;\">";
		echo "</form>";
		echo "<form name = \"submitForm\" action = 'List.php' method = 'POST'>";
		echo "<input type = \"submit\" name=\"delete\" id =\"delete\" value = \"削除\" style=\"margin: 10px; float: left;\" />";
		echo "<input type = \"submit\" name = \"edit\" id =\"edit\" value = \"編集\" style=\"margin:10px; float:left;\" />";
		echo "<br/><br/><br/>";
	}
	echo "<div id = \"table\"><table border=1 align = \"center\">";
	echo "<tr>";
	if(administratorCheck() == 1){
	echo "<th bgcolor=\"#a3ff99\"></th>";
	}
	echo "<th nowrap bgcolor=\"#a3ff99\">ユーザーID</th><th bgcolor=\"#a3ff99\">名前</th><th bgcolor=\"#a3ff99\">ﾌﾘｶﾞﾅ</th><th bgcolor=\"#a3ff99\">所属</th><th bgcolor=\"#a3ff99\">趣味</th><th nowrap bgcolor=\"#a3ff99\">管理者</th></tr>";

	try{
		$pdo = connectPDO();
		$stmt = $pdo->query("select * from t_staff left join m_group on m_group.group_cd = t_staff.group_cd;");
        $count = 0;
        $_SESSION['uidlist'] = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			echo "<tr>";
			if(administratorCheck() == 1){
			echo "<td><input type = \"hidden\" name = \"check".$count."\" value = 0/>";
			echo "<input type = \"checkbox\" name = \"check".$count."\" value = 1/></td>";
			}
			echo "<td nowrap>" . $row['user_id'] . "</td>";
			echo "<td nowrap>" . $row['name'] . "</td>";
			echo "<td nowrap>" . $row['name_kana'] . "</td>";
			echo "<td nowrap>" . $row['group_name'] . "</td>";
			echo "<td nowrap>" . $row['hobby'] . "</td>";
			$count++;
			array_push($_SESSION['uidlist'],$row['user_id']);

			if($row['administrator'] == 1){
				echo "<td>○</td>" ;
			}else{
				echo "<td>×</td>" ;
			}
			echo "</tr>";
		}
		echo "</table></div>";
	}catch (PDOException $e){
		echo "ERROR" . $e->getMessage();
	}
}

//編集画面ボタンが押されたとき、画面遷移までの処理
if(isset($_POST['edit'])){
	$count = 0;
	for($i=0;$i<count($_SESSION['uidlist']);$i++){
		$dcheck = $_POST['check'.$i];
		if($dcheck == 1){
			$_SESSION['edituid'] = $_SESSION['uidlist'][$i];
			$count++;
		}
		if($count > 1){
			unset($_SESSION['edituid']);
			break;
		}
	}
	if($count == 1){
		header("Location:edit.php");
	}
}

    //削除処理
	if(isset($_POST['delete'])){
	for($i=0;$i<count($_SESSION['uidlist']);$i++){
		$dcheck = $_POST['check'.$i];
		if($dcheck == 1){
			$query ="DELETE FROM `staffsystem`.`t_staff` WHERE `t_staff`.`user_id` = ?";
			$stmt = $pdo->prepare($query);
			$stmt -> bindParam(1, $_SESSION['uidlist'][$i], PDO::PARAM_STR);
			$stmt->execute();
		}
	}
	}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>社員一覧-社員一覧システム</title>
<link rel="STYLESHEET" href="list.css" type="text/css">
</head>
<body>
	<div id="site-box">
		<div id="head">
			<h2>社員一覧</h2>
		</div>
		<!-- #head -->
		<div id="main">

			<button name="logout" onclick="logoutAlert();"
				style="margin: 10px; float: left;">ログアウト</button>
				<?php tableCreate($pdo);?>
				</form>
				</div>
				</div>
			<script>
//ログアウトアラートの処理
function logoutAlert(){
	if (confirm("ログアウトしますか？")  == true) {
		location.href = "logout.php";
	}
}

      //削除ボタンが押されたときの処理
	  document.getElementById("delete").onclick = function(){
		   ckCnt = 0;
		  for(i=2;i<document.submitForm.length;i++){
			  if ( document.submitForm.elements[i].checked == true ){
				  ckCnt++;
				  }
		  }
          if(ckCnt != 0 && ckCnt != ckNum){
	          if(confirm("削除しますか？") == true){
			     var obj = document.forms[submitForm];
			     obj.submit();
		      }else{
			    return false;
		     }
		  }else{
            alert("選択してください");
		  }
	    };

	     //編集ボタンが押された時の処理
	    document.getElementById("edit").onclick = function(){

			   ckCnt = 0;
				  for(i=2;i<document.submitForm.length;i++){
					  if ( document.submitForm.elements[i].checked == true ){
						  ckCnt++;
						  }
				  }
				  if(ckCnt == 1){
					  var obj = document.forms[submitForm];
				    	obj.submit();
				  }else if(ckCnt > 1){
					alert("一つずつ編集してください");
				  }else {
		            alert("選択してください");
				  }
		    };
//}
</script>

</body>
</html>
<?php
$pdo = null;
?>
