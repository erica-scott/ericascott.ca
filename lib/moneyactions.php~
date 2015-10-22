<?php
ob_start();
date_default_timezone_set("Canada/Pacific");
$host = 'ericascott.ca';
$username = 'escott';
$password = 'silas2727';
$con = mysql_connect($host, $username, $password);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('ericascott', $con);
$action = "none";
$vars = $_POST;
foreach ($vars as $key => $val) {
	$pos = strpos($key, "action");
	if (strpos($key, "action") === 0 || strpos($key, "action") != false) {
		$action_array = explode("_", $key);
		$action = $action_array[1];
	}
}
switch($action) {
	case "add":
		$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$years = array(date("Y"), date("Y")+1, date("Y")+2, date("Y")+3);
		
		$month = $vars['month'];
		$day = $vars['day'];
		$year = $vars['year'];
		if (isset($vars['monthly']) && $vars['monthly'] == 1) {
			$sql = "INSERT INTO money (description, price, paid, date, month_year) VALUES ";
			$flag = 0;
			$done = 0;
			while ($done == 0) {
				if ($month < 10) {
					$date = $year."-0".$month;
				} else {
					$date = $year."-".$month;
				}
				if ($day < 10) {
					$date .= "-0".$day;
				} else {
					$date .= "-".$day;
				}
				$first_day = $year."-".$month."-01";
				$month_year = $months[$month-1].", ".$year;
				if ($month == 12 && $year == $years[3]) {
					$sql .= sprintf("('%s', '%s', '%s', '%s', '%s')",
						$vars['description'], $vars['price'], $vars['paid'], $date, $month_year);
				} else {
					$sql .= sprintf("('%s', '%s', '%s', '%s', '%s'), ",
						$vars['description'], $vars['price'], $vars['paid'], $date, $month_year);
				}
				if ($month == 12) {
					$month = 1;
					$year++;
				} else {
					$month++;
				}
				if ($year == $years[3]+1) {
					$done = 1;
				}
			}
		} else {
			$sql = "INSERT INTO money (description, price, paid, date, month_year) VALUES ";
			if ($month < 10) {
				$month = "0".$month;
			}
			if ($day < 10) {
				$day = "0".$day;
			}
			$date = $year."-".$month."-".$day;
			$first_day = $year."-".$month."-01";
			$month_year = date("F, Y", strtotime($date));
			$sql .= sprintf("('%s', '%s', '%s', '%s', '%s')",
					$vars['description'], $vars['price'], $vars['paid'], $date, $month_year);
		}
		print $sql;
		mysql_query($sql, $con);
		
		header("Location: http://ericascott.ca/index.php");
	break;
	default:
	case "none":
		header("Location: http://ericascott.ca/index.php");
	break;
}
?>