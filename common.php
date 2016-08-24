<?php
require_once('const.php');
/**
 * PDOでデータベースに接続する
 * @return PDO
 */
function connectPDO(){

	//$pdo = new PDO("mysql:host=".DB.";
	//		dbname=".DBNAME."; charset=utf8",DBUSER,DBPASS);

	//return $pdo;

	$pdo;
	try {
		$pdo = new PDO('mysql:dbname='.DBNAME.';host='.DBHOST,DBUSER,DBPASS,
				array(
						PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`")
		);
	} catch (PDOException $e) {
		die($e->getMessage());
	}
	return $pdo;
}

/**
 * ログインしているかチェックする。
 * @return number
 */
function loginCheck(){
	session_start();
	if(isset($_SESSION["USERID"]) == TRUE){
		return 1;
	}else{
		return 0;
	}
}

/**
 * ログインしている人が管理者かどうかチェックする。
 * @return number
 */
function administratorCheck(){
	//session_start();
	try{
		$pdo = connectPDO();
		$query = "select * from t_staff where user_id = '" . $_SESSION["USERID"] . "';";
		$stmt = $pdo->query($query);

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			if($row['administrator'] == 1){
				return 1;
			}else{
				return 0;
			}
		}
	}catch(PDOException $e){
		echo "ERROR" . $e->getMessage();
	}
}

/**
 *
 * 新規追加において、入力にエラーがないかチェックして、
 * エラーメッセージを返す
 * @param unknown_type $user_id
 * @param unknown_type $pw
 * @param unknown_type $name
 * @param unknown_type $name_kana
 * @param unknown_type $group_cd
 * @param unknown_type $hobby
 * @return string
 */
function inputCheck($user_id,$pw,$name,$name_kana,$group_cd,$hobby){
	$errorMessage ="";
	$pdo = connectPDO();
	$query = "SELECT `user_id` FROM `t_staff`";
	$t_user = $pdo->query($query);
	while($row = $t_user->fetch(PDO::FETCH_ASSOC)){
		if($row['user_id'] == $user_id){
			$errorMessage = $errorMessage . "すでに使われているユーザIDです。<br/>";
		}
	}
	if(!preg_match("/[a-zA-z0-9]*/",$user_id,$result) ||$result[0] != $user_id){
		$errorMessage = $errorMessage . "ユーザIDの入力が正しくありません。(半角英数字のみで入力してください)<br/>";
	}
	if(!preg_match("/[a-zA-z0-9]*/",$pw,$result2) || $result2[0] != $pw){
		$errorMessage = $errorMessage ."パスワードの入力が正しくありません。(半角英数字のみで入力してください)<br/>";
	}
	if(!preg_match("/[^!-\/:-@≠\[-`{-~]+/u",$name,$result4) || $result4[0] != $name){
		$errorMessage = $errorMessage . "氏名の入力が正しくありません。<br/>";
	}
	if(!preg_match("/^[ｱ-ﾝﾞﾟ\s]+$/u",$name_kana,$result3) || $result3[0] != $name_kana){
		$errorMessage = $errorMessage . "ﾌﾘｶﾞﾅの入力が正しくありません。（半角ｶﾀｶﾅのみで入力してください）<br/>";
	}
	if(!is_numeric($group_cd)){
		$errorMessage = $errorMessage ."所属コードを書き換えないでください！<br/>";
	}
	if(!preg_match("/[^!-\/:-@≠\[-`{-~]+/u",$hobby,$result5) || $result5[0] != $hobby){
		$errorMessage = $errorMessage ."趣味の入力が正しくありません。<br/>";
	}

	return $errorMessage;
}

/**
 * 入力フォームに表示する値
 * @param unknown_type $i
 * @param unknown_type $ini
 */
function displayStr($i,$ini){
	if($ini == 1){
		return $_SESSION['iniarr'][$i];
	}else{
		return $_SESSION['arr'][$i];
	}
}

/**
 * 値をもったチェックボックスの生成
 * @param unknown_type $ini
 * @param unknown_type $i
 * @return string
 */
function displayCheck($ini,$i){
	if($ini == 1){
		$value = $_SESSION['iniarr'][$i];
	}else{
		$value = $_SESSION['arr'][$i];
	}

	$str = "<input name=\"issend\" type=\"hidden\" value=\"0\" />";
	$str = $str . "<input name=\"issend\" type=\"checkbox\" value=\"1\"";
	if($i == 5){
		$str = $str . " onchange = \"visibleByselect();\"";
	}
	if($value == 1){
	    $str = $str. " checked";
	}

	$str = $str. "/>";
	return $str;
}

/**
 *
 * セレクトボックスの生成
 * @param unknown_type $pdo
 * @param unknown_type $ini
 * @param unknown_type $i
 * @return string
 */
function selectboxCreate($pdo,$ini,$i){
	$stmt2 = $pdo -> query("select * from m_group");
	$str = "<select name = \"group\"";
	if($i == 3){
		$str = $str . " onchange = \"visibleByselect();\"";
	}
	 $str = $str .">";
	while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
		$grouplistname = $row['group_name'];
		$grouplistcd = $row['group_cd'];
		$str = $str . "<option value ='".$grouplistcd."'";
		if($grouplistcd == displayStr($i,$ini)){
			$str = $str. " selected";
		}

		$str = $str . ">".$grouplistname."</option>";
	}
	$str = $str . "</select>";
	return $str;
}

?>