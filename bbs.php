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

	//ひとことが正しく入力されているかチェック
	$comment = null;
	if(!isset($_POST['comment']) || !strlen($_POST['comment'])){
		$errors['comment'] = 'ひとこと入力して下さい。';
	} else if (strlen($_POST['comment']) > 200){
		$errors['comment'] = 'ひとことは200文字以内で入力して下さい';
	} else {
		$comment = $_POST['comment'];
	}

	//エラーがなければ保存
	if(count($errors) === 0){
		//保存するためのSQL文を作成
		$sql = "INSERT INTO `post` (`name` , `comment` , `created_at`) VALUES ('" 
			. mysql_real_escape_string($name) . "' , '"
			. mysql_real_escape_string($comment) . "' , '"
			. date('Y-m-d H:i:s') . "')";
		//保存する
		mysql_query($sql , $link);
	}

}

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