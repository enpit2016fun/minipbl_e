<!--php 初期設定：データベースから変数へ格納する-->
<?php
require_once('common.php');
$pdo = connectPDO();

	try{
		$pdo = connectPDO();
		$stmt = $pdo->query("select * from event");
        $e_name = array();
        $e_date = array();
        $e_img = array();
        $e_text = array();
        $e_number = array();
        $i = 0;
    

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		    $e_name[$i]   = $row['event_name'];
			$e_date[$i]   = $row['event_date'];
			$e_img[$i]    = $row['event_img'];
			$e_text[$i]   = $row['event_text'];
            $e_number[$i] = $row['event_number'];
            $i++;
        }
        $event_info = array($e_name,$e_date,$e_img,$e_text,$e_number);
	}catch (PDOException $e){
		echo "ERROR" . $e->getMessage();
	}

//動作確認用テスト
//echo "event_info.size:" .count($event_info)."<br>";
//echo "colum_info.size:" .count($e_name)."<br>";
//for ($i = 0; $i<count($event_info); $i++){
//for ($j = 0; $j<count($e_name); $j++){
//    echo $event_info[$i][$j].",";
//}
//    echo "<br>";
//}

?>

<!--初期設定-->
<!DOCTYPE html>
<html lang = "ja">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>つくしっ子保育園の年間行事</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        <link rel="stylesheet" href="./css/event.css">
        <link rel="stylesheet" href="./css/add.css">
    </head>
    
    
    <!--ヘッダー-->
    <body>
    <div id = "site-box"  style = "background: url(./images/flower.png);">
    <header id = "event_top">            
    <h1>年間行事</h1>
        <!--img src= "./images/mojimoji.png" width="100" height="100" style= "position:absolute; left:680px; top: 10px;"-->
    </header>
        
    <!--イベントリスト見出し-->
        <div id = "main">
            <h2>年間行事一覧</h2>
        <?php        
            echo "<h4>";
            echo "<ul>";
            
            for ($i = count($e_name)-1; $i > -1; $i--){

            echo "<li>";
            if($i == count($e_name)-1){
            echo "<img src= \"./images/new017_06.gif\"align=\"top\">";
            }
            echo "<a href = '#" .$event_info[4][$i]. "'>".$event_info[0][$i]."</a></li>";
            echo "<br>";
            }
            echo "</ul>";
            echo "</h4>";
            ?>
            
            
        <!--イベントリスト本文-->    
        <?php
        for ($i = count($e_name)-1; $i > -1; $i--){
        //イベント名
        echo "<div class = \"contents\">";
        echo "<strong><h2 id = \"" .$event_info[4][$i]."\">".$event_info[0][$i]."</h2></strong>";
            
        //日時
        list($year,$month,$date) = split('-',$event_info[1][$i]);
        echo "<strong>";
        echo "<p>日時：";
        echo $year ."年 ".$month."月 ".$date."日";
        echo "</p>";
        echo "</strong>";
            
        //詳細
        echo "<p>";
        echo    $event_info[3][$i];
        echo "</p>";
        
        echo "<a href = '#event_top'>イベントトップへ</a>";
            
        //画像
        //test用   forest.jpg
        //echo "<img src= \"./images/forest.jpg\" alt=\"森林イメージ\">";
        
        //echo "image_name:" . $event_info[2][$i];
        echo "<img src= \"".$event_info[2][$i]."\">";
        //echo "<img src= \"./images/".$event_info[2][$i]."\" alt=\"森林イメージ\">";
        
        echo "</div>";
        }
        echo "</div></div></div>";
        ?>
    </body>
</html>

<?php
$pdo = null;
?>