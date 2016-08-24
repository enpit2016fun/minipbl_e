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
?>
<!DOCTYPE html>
<html lang = "ja">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>イベント一覧表</title>
        <meta name="description" content="An interactive getting started guide for Brackets.">
        
        <link rel="stylesheet" href="main.css">
    </head>
    <!--イベントリスト本文-->
    <body>
        <header id = "event_top">
          <h1>イベント一覧表</h1>  
        </header>
        <div>
        <h2>
            <?php
            echo "<ul>";
            echo    "<li><a href = '#" .$event_info[0][4]. "'>".$event_info[0][0]."</a></li><br>";
            echo    "<li><a href = '#baza'>バザー</a></li><br>";
            echo    "<li><a href = '#fever'>お祭り</a></li><br>";
            echo    "<li><a href = '#brossom'>花見</a></li><br>";
            echo    "<li><a href = '#graduation'>入園式・卒園式</a></li><br>";
            echo    "<li><a href = '#other'>その他</a></li><br>";
            echo "</ul>";
    
        echo "</h2>";
        echo "<h3 id = \"" .$event_info[0][4]."\">運動会</h3>";
            ?>
            
        <strong><h4><?php
           // echo $event_info[0][0];
            ?>
            </h4></strong>
        <strong>
        <p>
            日時
        </p>
        </strong>
        <img src="images/forest.jpg" alt="森林イメージ">
        <p>
            詳細
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
        
        <a href = '#event_top'>イベントトップへ</a>
        <h3 id = "baza">バザー</h3>
        <strong><h4>イベント名前</h4></strong>
        <strong>
        <p>
            日時
        </p>
        <img src="images/forest.jpg" alt="森林イメージ">
        </strong>
        <p>
            詳細
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
        
        <a href = '#event_top'>イベントトップへ</a>
        <h3 id = "fever">お祭り</h3>
        <strong><h4>イベント名前</h4></strong>
        <strong>
        <p>
            日時
        </p>
        <img src="images/forest.jpg" alt="森林イメージ">
        </strong>
        <p>
            詳細
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
        <a href = '#event_top'>イベントトップへ</a>    
        <h3 id = "brossom">花見</h3>
        <strong><h4>イベント名前</h4></strong>
        <strong>
        <p>
            日時
        </p>
        <img src="images/forest.jpg" alt="森林イメージ">
        </strong>
        <p>
            詳細
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
        <a href = '#event_top'>イベントトップへ</a>    
        <h3 id = "graduation">入園式・卒園式</h3>
        <strong><h4>イベント名前</h4></strong>
        <strong>
        <p>
            日時
        </p>
        <img src="images/forest.jpg" alt="森林イメージ">
        </strong>
        <p>
            詳細
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
            <a href = '#event_top'>イベントトップへ</a>
            
        <h3 id = "other">その他</h3>
        <strong><h4>イベント名前</h4></strong>
        <strong>
        <p>
            日時
        </p>
        <img src="images/forest.jpg" alt="森林イメージ">
        </strong>
        <p>
            詳細
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </p>
            <a href = '#event_top'>イベントトップへ</a>
        </div>
    </body>
</html>

<?php
$pdo = null;
?>