<?php
	session_start();
	session_regenerate_id(true);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link href="../common/css/font-awesome/css/all.css" rel="stylesheet"> 
	<link rel="stylesheet" href="../css/normalize.css">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="../common/css/kaiin_header.css">
	<link rel="stylesheet" href="../common/css/footer.css">
	<link rel="stylesheet" href="../common/css/kaiin_navi.css">
	<link rel="stylesheet" href="../common/css/kaiin_side.css">
	<title>会員追加確認</title>
</head>
<body>

<?php
	require_once('../common/html/kaiin_header.php');
	require_once('../common/html/kaiin_navi.php');
	require_once('../common/common.php');

	$kaiin_name = $_POST['name'];
	$kaiin_pass1 = $_POST['password1'];
	$kaiin_pass2 = $_POST['password2'];
	$kanri = $_POST['kanri'];
	$tmp_file = $_FILES['prof_file']['tmp_name'];
	$file_name = $_FILES['prof_file']['name'];
	$img_dir = getUpFileDir('kaiin');

	$kaiin_name = htmlspecialchars($kaiin_name);
	$kaiin_pass1 = htmlspecialchars($kaiin_pass1);
	$kaiin_pass2 = htmlspecialchars($kaiin_pass2);
	$kanri = htmlspecialchars($kanri);
	// file_nameもエスケープが必要　linuxから<img ～>のファイル名をアップできるため
	$file_name = htmlspecialchars($file_name);


	$ok_flag = true;

	// 名前のチェック
	if ($kaiin_name == '') {
		print '会員名が入力されていません<br>';
		$ok_flag = false;
	} else {
		print '会員名：　' . $kaiin_name . '<br>';
	}

	// パスワードのチェック
	if ($kaiin_pass1 == '') {
		print 'パスワードが入力されていません<br>';
		$ok_flag = false;
	} else if ($kaiin_pass1 !== $kaiin_pass2) {
		print 'パスワードが一致しません<br>';
		$ok_flag = false;
	}

	// 管理者区分選択のチェック
	$kanri_kubuns = getKanrikubun();
	if (!isset($kanri_kubuns[$kanri])) {
		print '管理区分に不正な値が入力されました。';
		$ok_flag = false;
	}

	// アップロードファイルの処理
	if (is_uploaded_file($tmp_file)) {
		$file_flag = true;
	}

	var_dump($tmp_file);
	var_dump($img_dir . $file_name);
	//if ($file_flag && !move_uploaded_file($tmp_file, $img_dir . basename($file_name))) {
	if ($file_flag && !move_uploaded_file($tmp_file, $img_dir . $file_name)) {
		print 'ファイルのアップロードに失敗しました。<br>';
		$ok_flag = false;
	}

	if (!$ok_flag) {
		print '<form>';
		print '<input type="button" onclick="history.back()" value="戻る">';
		print '</form>';
	} else {
		// csrfの脆弱性を作るため、トークンを飛ばさない
		$kaiin_pass = md5($kaiin_pass1);
		$inputs = [];
		$inputs['name'] = $kaiin_name;
		$inputs['password'] = $kaiin_pass;
		$inputs['kanri'] = $kanri;
		$inputs['file_name'] = $file_name;
		print 'この内容で登録しますか？';
		print '<form method="post" action="kaiin_add_done.php">';
		print '<input type="button" onclick="history.back()" value="戻る" class="btn">';
		print '<input type="submit" value="OK" class="btn">';
		print '</form>';
	}

?>
</body>
</html>

