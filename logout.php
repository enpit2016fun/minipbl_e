<?php

logout();
/**
 * ログアウト処理
 */
function logout(){
	session_start();
	if(isset($_SESSION["USERID"])){
		echo "ログアウトしました";
}else{
	echo "セッションがタイムアウトしました";
}
$_SESSION = array();
@session_destroy();
header("Location:Login.php");
}
?>