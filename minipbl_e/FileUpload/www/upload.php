<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<p><?php

$updir = "./files";
$tmp_file = @$_FILES['upfile']['tmp_name'];
@list($file_name,$file_type) = explode(".",@$_FILES['upfile']['name']);
$copy_file = date("Ymd-His") . "." . $file_type;
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
	if (move_uploaded_file($tmp_file,"$updir/$copy_file")) {
		chmod("upload_files/" . $_FILES["upfile"]["name"], 0644);
		echo $_FILES["upfile"]["name"] . "をアップロードしました。<br />";
		echo "（※アップロードしたファイルは <a href=\"" . $updir . "/" . $copy_file . "\" target=\"_blank\">こちら</a> から確認できます。）";
	} else {
		echo "ファイルをアップロード出来ませんでした。";
	}
} else {
	echo "ファイルが選択されていません。";
}
/*@list($file_name,$file_type) = explode(".",@$_FILES["upfile"]["name"]);
$copy_file = date("Ymd-His") . "." . $file_type;
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/$copy_file" ])) {
    chmod("files/" . $_FILES["upfile"]["name"], 0644);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。";
    echo "ファイルパス："."files/$copy_file"
  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}
*/
?></p>
</body>
</html>