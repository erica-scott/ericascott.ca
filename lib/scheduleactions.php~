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
		if ($_POST['month'] < 10) {
			$month = "0".$_POST['month'];
		} else {
			$month = $_POST['month'];
		}
		
		if ($_POST['day'] < 10) {
			$day = "0".$_POST['day'];
		} else {
			$day = $_POST['day'];
		}
		$day_stamp = $_POST['year']."-".$month."-".$day;
		$time_period = $_POST['from']."-".$_POST['to'];
		if ((strpos($_POST['from'], "PM") != false || strpos($_POST['from'], "PM") === 0) && ($_POST['from'] != "12PM") && ($_POST['from'] != "12:30PM")) {
			$start_time = str_replace("PM", "", $_POST['from']);
			$start_time = $start_time + 12;
		} else if ($_POST['from'] == '12PM' || $_POST['from'] == '12:30PM') {
			$start_time = str_replace("PM", "", $_POST['from']);
		} else {
			$start_time = str_replace("AM", "", $_POST['from']);
		}
		if ($_POST['recurring'] == 'yes') {
			$recurring_type = $_POST['recurring_type'];
			$sql = "INSERT INTO schedule (task, day, time_period, start_time, group_id) VALUES ";
			$end_date = $_POST['recurring_end_date'];
			$i = 0;
			while (strtotime($day_stamp) <= strtotime($end_date)) {
				if ($i == 0) {
					$sql .= sprintf("('%s', '%s', '%s', '%s', '%s')", $_POST['task'], $day_stamp, $time_period, $start_time, $_POST['group_id']);
					$i = 1;
				} else {
					$sql .= sprintf(", ('%s', '%s', '%s', '%s', '%s')", $_POST['task'], $day_stamp, $time_period, $start_time, $_POST['group_id']);
				}
				$temp_date = new DateTime($day_stamp);
				if ($recurring_type == 'weekly') {
					$temp_date->modify("+1 week");
				} else if ($recurring_type = 'daily') {
					$temp_date->modify("+1 day");
				}
				$day_stamp = $temp_date->format("Y-m-d");
			}
		} else {
			$sql = sprintf("INSERT INTO schedule (task, day, time_period, start_time, group_id) VALUES ('%s', '%s', '%s', '%s', '%s')",
				    	$_POST['task'], $day_stamp, $time_period, $start_time, $_POST['group_id']);
		}
		$sql = trim($sql, ",");
		mysql_query($sql, $con);
		header("Location: http://ericascott.ca/index.php");
	break;
	case "edit":
		if ($_POST['month'] < 10) {
			$month = "0".$_POST['month'];
		} else {
			$month = $_POST['month'];
		}
		
		if ($_POST['day'] < 10) {
			$day = "0".$_POST['day'];
		} else {
			$day = $_POST['day'];
		}
		$day_stamp = $_POST['year']."-".$month."-".$day;
		$time_period = $_POST['from']."-".$_POST['to'];
		if ((strpos($_POST['from'], "PM") != false || strpos($_POST['from'], "PM") === 0) && ($_POST['from'] != "12PM") && ($_POST['from'] != "12:30PM")) {
			$start_time = str_replace("PM", "", $_POST['from']);
			$start_time = $start_time + 12;
		} else if ($_POST['from'] == '12PM' || $_POST['from'] == '12:30PM') {
			$start_time = str_replace("PM", "", $_POST['from']);
		} else {
			$start_time = str_replace("AM", "", $_POST['from']);
		}
		$sql = sprintf("UPDATE schedule SET task = '%s', day = '%s', time_period = '%s', start_time = '%s', group_id = '%s' WHERE id = '%s'",
				    $_POST['task'], $day_stamp, $time_period, $start_time, $_POST['group_id'], $_POST['id']);
		mysql_query($sql, $con);
		header("Location: http://ericascott.ca/index.php");
	break;
	case "delete":
		$id = $_POST['id'];
		$sql = "DELETE FROM schedule WHERE id = '$id'";
		$res = mysql_query($sql, $con);
		header("Location: http://ericascott.ca/index.php");
	break;
	default:
	case "none":
		header("Location: http://ericascott.ca/index.php");
	break;
	
}
?>