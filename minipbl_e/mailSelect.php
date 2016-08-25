<html>
<head>
<meta charset="UTF-8">
<title>送信者一覧</title>
<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" href="css/style.css" media="screen"
	type="text/css" />

</head>
<script>
// onclick="console.log(document.js.honbun.value);"
</script>
<body>

	<form name="chtable" action="mail.php" method="GET0">

	<table border="1" cellspacing="0">
<?php
require_once ('common.php');
$pdo = connectPDO ();

try {
	$pdo = connectPDO ();
	$stmt = $pdo->query ( "select * from member" );
	$m_element = array (
			"チェック",
			"メールアドレス",
			"保護者",
			"子供",
			"卒園年",
			"配信希望" 
	);
	$m_email = array ();
	$m_p_name = array ();
	$m_c_name = array ();
	$m_graduation_year = array ();
	$m_issend = array ();
	$checkSwitch = array();
	$i = 0;
	
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		$m_email [$i] = $row ['email'];
		$m_p_name [$i] = $row ['p_name'];
		$m_c_name [$i] = $row ['c_name'];
		$m_graduation_year [$i] = $row ['graduation_year'];
		$m_issend [$i] = $row ['issend'];

		if($m_issend[$i] == 1){
			$checkSwitch[$i] = "checked";
		} else {
			$checkSwitch[$i] =	"";
		}
		
		$i ++;
	}
	$event_info = array (
			$m_email,
			$m_p_name,
			$m_c_name,
			$m_graduation_year,
			$m_issend 
	);
} catch ( PDOException $e ) {
	echo "ERROR" . $e->getMessage ();
}
echo '<tr>';
for($tr = 0; $tr <= 5; $tr ++) {
	echo '<th>' . $m_element [$tr] . '</th>';
}
echo '</tr>';
for($i = 0; $i <= 4; $i ++) {
	echo '<tr>';
	
	// echo '<td><input type="checkbox" name="ck1" value="1" checked></td>';
	echo "<td><li class='tg-list-item'>
<input class='tgl tgl-flip' id='cb".$i."' name='ckc[]' type='checkbox' value='1' ".$checkSwitch[$i]."> <label
	class='tgl-btn' data-tg-off='しない' data-tg-on='送信' for='cb".$i."'></label>
	</li></td>";
	
	for($j = 0; $j <= 4; $j ++) {
		echo '<td>' . $event_info [$j] [$i] . '</td>';
	}
	echo '</tr>';
}
?>
		</table>
		<input type="button" value="設定" onclick="javascript:window.close()">
		</p>
	</form>

</body>
</html>