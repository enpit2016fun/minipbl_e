<?php
require_once ('common.php');
session_start ();
?>

<html>
<head>
<meta charset="UTF-8">
<title>送信者一覧</title>
<link rel="stylesheet" href="css/normalize.css">

<link rel="stylesheet" href="css/style.css" media="screen"
	type="text/css" />

</head>
<script>
window.onload = function(){
	ttt();
	}

function ttt(){
	var adstring = "";
	var t = 0;
while(document.getElementById("cb"+t) != null){
	if(document.getElementById("cb"+t).checked == true){
		if(adstring != ""){adstring += ","}
		adstring += document.getElementById("cb"+t).value;
	}
	t++;
}
window.opener.document.js.address.value=adstring;
}


</script>
<body>

	<form name="chtable" method="GET0" style="position:absolute; width: 100%;text-align:center;">

		<table border="1" cellspacing="0" style="width:100%;text-align:center;">
<?php
$pdo = connectPDO ();

try {
	$pdo = connectPDO ();
	$stmt = $pdo->query ( "select * from member" );
	$m_element = array (
			"チェック",
			"メールアドレス",
			"保護者",
			"子供",
			"卒園年度",
			"配信希望" 
	);
	$m_email = array ();
	$m_p_name = array ();
	$m_c_name = array ();
	$m_graduation_year = array ();
	$m_issend = array ();
	$checkSwitch = array ();
	$i = 0;
	$checkcount = 0;
	
	while ( $row = $stmt->fetch ( PDO::FETCH_ASSOC ) ) {
		$m_email [$i] = $row ['email'];
		$m_p_name [$i] = $row ['p_name'];
		$m_c_name [$i] = $row ['c_name'];
		$m_graduation_year [$i] = $row ['graduation_year'];
		$m_issend [$i] = $row ['issend'];
		
		if ($m_issend [$i] == 1) {
			$checkSwitch [$i] = "checked";
		} else {
			$checkSwitch [$i] = "";
		}
		
		$i ++;
	}
	$event_info = array (
			$checkSwitch,
			$m_email,
			$m_p_name,
			$m_c_name,
			$m_graduation_year,
			$m_issend 
	);
	$_SESSION ['m_email'] = $m_email; // $event_info;
} catch ( PDOException $e ) {
	echo "ERROR" . $e->getMessage ();
}
echo '<tr>';
for($tr = 0; $tr <= 5; $tr ++) {
	echo '<th>' . $m_element [$tr] . '</th>';
}
echo '</tr>';

for($i = 0; $i <= count ( $event_info ) + 1; $i ++) {
	for($j = 0; $j <= 5; $j ++) {
		if ($j == 0) {
			echo '<tr>';
			// echo '<td><input type="checkbox" name="ck1" value="1" checked></td>';
			echo "<td><li class='tg-list-item'><input class='tgl tgl-flip' id='cb" . $i . "' name='ckc" . $i . "' type='checkbox' onclick='ttt();' value='" . $m_email [$i] . "' " . $event_info [$j] [$i] . "><label class='tgl-btn' data-tg-off='しない' data-tg-on='送信' for='cb" . $i . "'></label></li></td>";
		} else if ($j == 4) {
			echo '<td>' . $event_info [$j] [$i] . '年度</td>';
		} else if ($j == 5) {
			if ($event_info [$j] [$i] == 1) {
				echo '<td>あり</td>';
			} else {
				echo '<td>なし</td>';
			}
		} else {
			echo '<td>' . $event_info [$j] [$i] . '</td>';
		}
	}
	echo '</tr>';
}
// <textarea name="mailform" cols="50" rows="10" ></textarea>
// window.opener.location.reload()
// window.opener.document.FORMA.RESULT.value=value
?>


		</table>
		<input type="button" name="setup" value="設定"
			onclick="javascript:window.open('about:blank','_self').close();">
		
		
	</form>

</body>
</html>