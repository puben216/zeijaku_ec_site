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

?>