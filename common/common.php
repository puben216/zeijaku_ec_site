<?php

	function connect_db() {
		$dsn = 'mysql:dbname=ec_test_php;host=localhost;';
		$user = 'an';
		$password = 'password';
		return new PDO($dsn, $user, $password);
	}

	function h($value) {
		return htmlspecialchars($value);
	}


	function sanitize($before) {
		$after = [];
		foreach ($before as $key => $value) {
			$after[$key] = htmlspecialchars($value);
		}
		return $after;
	}

	function createCsrftoken() {
		$TOKEN_LENGTH = 16;
		$token_byte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
		return bin2hex($token_byte);
	}

	function pull_year() {
		$min = 2017;
		$max = 2019;
		print '<select name="year">';
		for ($i = $min; $i <= $max; $i++) {
			print '<option value="' . $i . '">' . $i . '</option>';
		}
		print '</select>';
	}

	function pull_month() {
		print '<select name="month">';
		for ($i = 1; $i <= 12; $i++) {
			$val = sprintf('%02s', $i);
			print '<option value="' . $i . '">' . $i . '</option>';
		}
		print '</select>';
	}

	function pull_day() {
		$max = 31;
		print '<select name="day">';
		for ($i = 1; $i <= $max; $i++) {
			$val = sprintf('%02s', $i);
			print '<option value="' . $i . '">' . $i . '</option>';
		}
		print '</select>';	
	}

	function make_bread($curent_file) {
		$path_list = [
			0 => ['/ec_php/kaiin_top.php' => ['name' => 'トップページ', 'parent' => '']],
			1 => ['/ec_php/kaiin/kaiin_list.php' => ['name' => '会員一覧', 'parent' => '/ec_php/kaiin_top.php']],
			2 => ['/ec_php/kaiin/kaiin_edit.php' => ['name' => '会員編集', 'parent' => '/ec_php/kaiin/kaiin_list.php'],
				  '/ec_php/kaiin/kaiin_add.php' => ['name' => '会員追加', 'parent' => '/ec_php/kaiin/kaiin_list.php']],
			3 => ['/ec_php/kaiin/kaiin_edit_check.php' => ['name' => '会員編集確認', 'parent' => '/ec_php/kaiin/kaiin_edit.php'],
				  '/ec_php/kaiin/kaiin_add_check.php' => ['name' => '会員追加確認', 'parent' => '/ec_php/kaiin/kaiin_add.php']],
			4 => ['/ec_php/kaiin/kaiin_edit_done.php' => ['name' => '会員編集完了', 'parent' => '/ec_php/kaiin/kaiin_edit_check.php']],
		];

		$breads = [];
		// $curent_file = $_SERVER['SCRIPT_PATH'];
		$point = 0;

		foreach ($path_list as $i => $list) {
			if (isset($list[$curent_file])) {
				$point = $i;
				break;
			}
		}

		$file = $curent_file;
		for ($i = $point; $i >= 0; $i--) {
			if (isset($path_list[$i][$file])) {
				$tmp_path = getDomainName() . $file;
				$tmp_name = $path_list[$i][$file]['name'];
				$breads[$i] = [$tmp_path, $tmp_name];
				$file = $path_list[$i][$file]['parent'];
			} else {
				break;
			}
		}

		return array_reverse($breads);
	}

	function getDomainName() {
		return (empty($_SERVER["HTTPS"]) ? "http://" : "https://") . $_SERVER["HTTP_HOST"];
	}

	function getKanrikubun() {
		return [
			'0' => '0', // 一般
			'1' => '1'	// 管理者
		];
	}

	function getUpFileDir($kino) {
		switch ($kino) {
			case 'kaiin':
				return '../up_img/';			
			default:
				# code...
				break;
		}
	}




























?>