<?php
require_once('common.php');

header("Content-Type: text/html; charset=utf-8");

	try{
		$pdo = connectPDO();
		$stmt = $pdo->query("select * from event");
        $count = 0;
        //$_SESSION['uidlist'] = array();
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			echo  . $row['event_name'] . ;
			echo  . $row['event_date'] . ;
			echo  . $row['event_img'] . ;
			echo  . $row['event_txt'] . ;
			$count++;

	}catch (PDOException $e){
		echo "ERROR" . $e->getMessage();
	}
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
            <ul>
                <li><a href = '#undoukai'>運動会</a></li><br>
                <li><a href = '#baza'>バザー</a></li><br>
                <li><a href = '#fever'>お祭り</a></li><br>
                <li><a href = '#brossom'>花見</a></li><br>
                <li><a href = '#graduation'>卒園式</a></li><br>
            </ul>
        </h2>
        <h3 id = "undoukai">運動会</h3>
        <strong><h4>イベント名前</h4></strong>
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
        <h3 id = "graduation">卒業式</h3>
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
