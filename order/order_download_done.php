<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login']) == false) {
	print 'ログインされていません。';
	print '<a href="../kaiin_login/kaiin_login.html">ログイン画面へ</a>';
	exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>order download done</title>
</head>
<body>

<?php

	// yearに脆弱性
	$year = $_POST['year'];
	$month = sprintf('%02d', intval($_POST['month']));
	$day = sprintf('%02d', intval($_POST['day']));

	$sql = '
	select 
		ot.code,
		ot.date,
		ot.code_member,
		ot.name as ot_name,
		ot.email,
		ot.postal1,
		ot.postal2,
		ot.address,
		ot.tel,
		mp.name as mst_name,
		opt.code_product,
		opt.price,
		opt.quantity
	from
		order_tbl ot,
		order_product_tbl opt,
		mst_product mp
	where
		ot.code = opt.code and
		opt.code_product = mp.code and 
		substr(ot.date, 1, 4) = ' . $year . ' and 
		substr(ot.date, 6, 2) = ' . $month . ' and 
		substr(ot.date, 9, 2) = ' . $day .
	' order by ot.date';

var_dump($sql);
	$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
	$user = 'an';
	$password = 'password';
	$db = new PDO($dsn, $user, $password);
	$db->query('set names utf8');

	$stmt = $db->query($sql);
	
	/* 脆弱性をつくるためプリペアードステートメントは使わない
	$stmt = $db->prepare($sql);
	$data[] = $year;
	$data[] = $month;
	$data[] = $day;
	$stmt->execute($data);
	*/

	$dbh = null;

	$csv = '注文コード,日付,会員番号,お名前,メール,郵便番号,住所,TEL,商品コード,商品名,価格,数量';
	$csv .= "\n";

	while (true) {
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($rec == false) {
			break;
		}
		$csv .= $rec['code'];
		$csv .= ',';
		$csv .= $rec['date'];
		$csv .= ',';
		$csv .= $rec['code_member'];
		$csv .= ',';
		$csv .= $rec['ot_name'];
		$csv .= ',';
		$csv .= $rec['email'];
		$csv .= ',';
		$csv .= $rec['postal1'] . '-' . $rec['postal2'];
		$csv .= ',';
		$csv .= $rec['address'];
		$csv .= ',';
		$csv .= $rec['tel'];
		$csv .= ',';
		$csv .= $rec['code_product'];
		$csv .= ',';
		$csv .= $rec['mst_name'];
		$csv .= ',';
		$csv .= $rec['price'];
		$csv .= ',';
		$csv .= $rec['quantity'];
		$csv .= "\n";
	}

	$file = fopen('./order.csv', 'w');
	$csv = mb_convert_encoding($csv, 'SJIS', 'UTF-8');
	print nl2br($csv);
	var_dump($file);
	fputs($file, $csv);
	fclose($file);

?>

<a href="order.csv">注文データのダウンロード</a>
<br>
<a href="order_download.php">日付選択へ</a>
<br>
<a href="../kaiin_top.php">トップページへ</a><br>