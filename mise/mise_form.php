<?php
	require_once '../common/common.php';

	session_start();
	session_regenerate_id(true);
	if (isset($_SESSION['member_login']) == false) {
		print 'ようこそゲスト様';
		print '<br>';
	} else {
		print 'ようこそ';
		print $_SESSION['member_name'];
		print '様';
		print '<a href="member_logout.php">ログアウト</a><br>';
		print '<br>';
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>konyu</title>
	<link rel="stylesheet" href="../css/common.css">
	<script>
		function init() {
			addEventListener('change', disp_change, false);

			function disp_change() {
				var div = document.getElementById('hidden-area');
				var radio = document.getElementsByName('chumon');
				console.log(document.getElementsByName('chumon'))
				if (radio[1].checked) {
					div.style.display = 'block';
				} else {
					div.style.display = 'none';
				}
			}
		}
	</script>
</head>
<body onload="init()">
	お客さま情報を入力してください<br><br>
	<form action="mise_form_check.php" method="post">

<?php
	require_once '../common/common.php';

	$onamae = '';
	$email = '';
	$postal1 = '';
	$postal2 = '';
	$address = '';
	$tel = '';

	$is_login = isset($_SESSION['member_login']) && $_SESSION['member_login'] == 1;
var_dump($is_login);
var_dump($_SESSION);
	if ($is_login) {
		$db = connect_db();
		$db->query('set names utf8');

		$sql = 'select name, email, postal1, postal2, address, tel from order_tbl where code = ?';
		$stmt = $db->prepare($sql);
		$data = [$_SESSION['member_code']];
		$stmt->execute($data);

		$rec = $stmt->fetch(PDO::FETCH_ASSOC);	
		$onamae = $rec['name'];
		$email = $rec['email'];
		$postal1 = $rec['postal1'];
		$postal2 = $rec['postal2'];
		$address = $rec['address'];
		$tel = $rec['tel'];
var_dump($rec);
		$db = null;
	}


	print 'お名前<br>		';
	print '<input type="text" name="onamae" class="lg-input-box" value="' . $onamae . '"><br>';
	print 'メールアドレス<br>';
	print '<input type="text" name="email" class="lg-input-box" value="' . $email . '"><br>';
	print '郵便番号<br>';
	print '<input type="text" name="postal1" class="sm-input-box" value="' . $postal1 . '">-';
	print '<input type="text" name="postal2" class="sm-input-box" value="' . $postal2 . '"><br>';
	print '住所<br>';
	print '<input type="text" name="address" class="lg-input-box" value="' . $address . '"><br>';
	print '電話番号<br>';
	print '<input type="text" name="tel" class="lg-input-box" value="' . $tel . '"><br>';
	print '<br><br>';		
		
	if (!$is_login) {
		print '<label><input type="radio" name="chumon" value="chumonkonkai" checked>今回だけの注文</label><br>';
		print '<label><input type="radio" name="chumon" value="chumontouroku">会員登録して注文</label><br>';
	}

?>
	<div id="hidden-area" style="display: none">
		<br><br>
		会員登録する方は以下の項目も入力してください。
		<br><br>
		パスワードを入力してください<br>
		<input type="password" name="pass" class="md-input-box"><br>
		パスワードをもう一度入力してください<br>
		<input type="password" name="pass2" class="md-input-box"><br>
		性別<br>
		<input type="radio" name="danjo" value="man" checked>男性
		<input type="radio" name="danjo" value="woman" checked>女性<br>
		生まれ年<br>
		<select name="birth">
		<option value="1910">1910年代</option>
		<option value="1920">1920年代</option>
		<option value="1930">1930年代</option>
		<option value="1940">1940年代</option>
		<option value="1950">1950年代</option>
		<option value="1960">1960年代</option>
		<option value="1970">1970年代</option>
		<option value="1980" selected>1980年代</option>
		<option value="1990">1990年代</option>
		<option value="2000">2000年代</option>
		<option value="2100">2100年代</option>
		</select>	
	</div>
		<br><br>
		<input type="button" onclick="history.back()" value="戻る">
		<input type="submit" value="OK"><br>
		
	</form>
</body>
</html>