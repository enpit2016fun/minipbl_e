<?php
require_once('common.php');
session_start();


//追加ボタンが押されていれば
if(isset($_POST["add"])){
        
    //初期化直後ならば
    if(!empty($_SESSION["USERID"])){
			//入力があれば開始
			if (!empty($_POST['e_name']) && !empty($_POST['e_date']) && !empty($_POST['e_text'])){
                
                //ファイルのアップロード＆パスの取得
                $updir = "./files";
                $tmp_file = @$_FILES['upfile']['tmp_name'];
                $_SESSION['tmp_file'] = $tmp_file; 
                @list($file_name,$file_type) = explode(".",@$_FILES['upfile']['name']);
                $copy_file = date("Ymd-His") . "." . $file_type;
                if (is_uploaded_file($_FILES["upfile"]["tmp_name"])){
              if (move_uploaded_file($tmp_file,"$updir/$copy_file")) {
                  chmod("upload_files/" . $_FILES["upfile"]["name"], 0644);
                  $e_img = $updir."/" . $copy_file;
              } else {
                  $e_img = 'null';
              }
          } else {
              $e_img = 'null';
          }

                try{
                $pdo = connectPDO(); 
                $sql = 'SELECT * FROM event ';
                $stmt = $pdo->query($sql);
                $stmt->execute();
                $count=$stmt->rowCount();
			}catch(PDOException $e){
				echo "ERROR:" . $e->getMessage();
			}
                
                
				$e_name = htmlspecialchars($_POST['e_name']);
				$e_date = htmlspecialchars($_POST['e_date']);
                $e_text = htmlspecialchars($_POST['e_text']);
				$e_number = $count+1;
				$infoarr = array($e_name,$e_date,$e_img,$e_text,$e_number);
				$_SESSION['e_arr'] = $infoarr;
				$pdo = null;
				//ユーザID、パスワードが入力されていなかったらエラーメッセージを表示
			}else {
				echo "未入力の項目があります。";
			}                                     
    }else{
              $_SESSION['e_arr'] = array("","","","","");
	}
    header("Location:e_confirm.php");
}else{
     $_SESSION['e_arr'] = array("","","","","");
}                                                                      
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>イベント管理システム-イベント登録-</title>
<script type="text/javascript" src="./js/jquery.js"></script>
<script type="text/javascript" src="./js/jquery-ui.js"></script>
<link rel="STYLESHEET" href="./js/jquery-ui.css" type="text/css">

<link rel="STYLESHEET" href="./css/add.css" type="text/css">
         <script language="javascript">
             
             $(function() {          
               // File API が使用できない場合は諦めます.
               if(!window.FileReader) {
               alert("File API がサポートされていません。");
               return false;
               }
               
               // イベントをキャンセルするハンドラです.
               var cancelEvent = function(event) {
               event.preventDefault();
               event.stopPropagation();
               return false;
               }
               
               // ファイルの内容は FileReader で読み込みます.
               var fileReader = new FileReader();
               fileReader.onload = function(event) {
               // event.target.result に読み込んだファイルの内容が入っています.
               // ドラッグ＆ドロップでファイルアップロードする場合は result の内容を Ajax でサーバに送信しましょう!
               $("#droppable").text("[" + file.name + "]" + event.target.result);
               }
               fileReader.readAsText(file);
               
               // デフォルトの処理をキャンセルします.
               cancelEvent(event);
               return false;
               }
               
               </script>
</head>
<body>
	<div id="site-box">
		<div id="head">
	

		</div>
		<!-- #head -->
		<div id="main">
			<br />
			
               <div id="form-main">
               <div id="form-div">
               <form class="form" id="form" form action='e_add.php' method='POST' enctype="multipart/form-data">
               
               <div class="su">
               
               <h2 align="center">イベント登録</h2>
               </div>
               
               <p class="e_name">
               <input type="text" name="e_name" id="e_name"
               class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="イベント名"
               id="e_name"　size=20
               value="<?php echo $_SESSION['e_arr'][0];?>" onkeyup="visible();"
               onchange="visible();" />
               </p>
               
               <p class="datepicker">
               <input type="text" name="e_date" id="datepicker"
               class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="開催日時"
               id="datepicker"　size=20
                onkeyup="visible();"
               onchange="visible();" />
               </p>
               
               <p class="e_text">
               <input type="text" name="e_text" id="e_text"
               class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="詳細"
               id="e_text"　size=20
               
               value="<?php echo $_SESSION['e_arr'][3];?>" onkeyup="visible();"
               onchange="visible();" />
               </p>

    <input type="file" name="upfile" size="30" />

				<div id = "foot">
                    <!--入力なしだったら押せなくする機能どっかにいったかなしい-->
					<input type="submit" name="add" id="add" value="追加する" style=" margin: 8px;"/>
					<input type="reset" value ="リセット"  style=" margin: 8px;"/>
					<input type="button" value="戻る" onclick="tolistback()" style=" margin: 8px;"/>
               </form>
			</div>


	</div>
	<!-- #main -->
	</div>
	<script>

     
        $(function () {
    var dateFormat = 'yy-mm-dd';
    $('#datepicker').datepicker({
        dateFormat: dateFormat
    });
});
function visible(){
var e_name = getField("e_name");
var e_date = getField("e_date");
var e_text = getField("e_text");
var disabled = true;

	if($e_name.value.length > 0 && $e_date.value.length > 0 && $e_text.value.length > 0){
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
		location.href = "e_login.php";
}
        
        var app = {
    // Application Constructor
    initialize: function() {
        this.bindEvents();
    },
    // Bind Event Listeners
    //
    // Bind any events that are required on startup. Common events are:
    // 'load', 'deviceready', 'offline', and 'online'.
    bindEvents: function() {
        document.addEventListener('deviceready', this.onDeviceReady, false);
    },
    // deviceready Event Handler
    //
    // The scope of 'this' is the event. In order to call the 'receivedEvent'
    // function, we must explicitly call 'app.receivedEvent(...);'
    onDeviceReady: function() {
        app.receivedEvent('deviceready');
    },
    // Update DOM on a Received Event
    receivedEvent: function(id) {
        var parentElement = document.getElementById(id);
        var listeningElement = parentElement.querySelector('.listening');
        var receivedElement = parentElement.querySelector('.received');

        listeningElement.setAttribute('style', 'display:none;');
        receivedElement.setAttribute('style', 'display:block;');

        console.log('Received Event: ' + id);
    }
};

app.initialize();
</script>
</body>
</html>
<?php
$pdo = null;
?>