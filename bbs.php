<?php

//データベースに接続
$link = mysql_connect('localhost' , 'root' , 'camp2015');
if(!$link) {
	die('データベースに接続出来ません：' . mysql_error());
}

//データベースを選択する
mysql_select_db('online_bbs' , $link);
$errors = array();

//POSTなら保存処理実行
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	//名前が正しく入力されているかチェック
	$name = null;
	if(!isset($_POST['name']) || !strlen($_POST['name'])){
		$errors['name'] = '名前を入力して下さい。';
	} else if(strlen($_POST['name']) > 40) {
		$errors['name'] = '名前は40文字以内で入力して下さい。';
	} else {
		$name = $_POST['name'];
	}
}

//







?>
<!DOCTYPE HTML PUBLIC"-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <meta http-equive="Content-Type" content="text/html;charset=UTF-8" >
  <title>ひとこと掲示板</title>
</head>
<body>
	<h1>ひとこと掲示板</h1>

	<form action="bbs.php" method="post">
		名前：<input type="text" name="name" /><br>
		ひとこと：<input type="text" name="comment" size="60" /><br />
		<input type="submit" name="submit" value="送信" />
	</form>

</body>
</html>