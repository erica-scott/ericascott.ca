<?php
ob_start();
$action = "none";
$vars = $_POST;
foreach ($vars as $key => $val) {
	$pos = strpos($key, "action");
	if (strpos($key, "action") === 0 || strpos($key, "action") != false) {
		$action_array = explode("_", $key);
		$action = $action_array[1];
	}
}
print $action;
switch($action) {
	case "add":
		$host = 'ericascott.ca';
		$username = 'escott';
		$password = 'silas2727';
		$con = mysql_connect($host, $username, $password);
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('ericascott', $con);
		$earned = (str_replace("%", "", $_POST['percentage'])/100)*$_POST['total_credits'];
		$sql = sprintf("INSERT INTO grades (class_name, class_group, percentage, percentage_set, total_credits, earned_credits, year, uni_year, semester, work_term_flag, work_term) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', (select year from year_map where uni_year = '%s'), '%s', '%s', '%s', '%s')",
						$_POST['class_name'], $_POST['class_group'], $_POST['percentage'], $_POST['percentage_set'], $_POST['total_credits'], $earned, $_POST['uni_year'], $_POST['uni_year'], $_POST['semester'], $_POST['work_term_flag'], $_POST['work_term']);
		$res = mysql_query($sql, $con); 
		header("Location: http://ericascott.ca/index.php");
	break;
	case "remove":
		$host = 'ericascott.ca';
		$username = 'escott';
		$password = 'silas2727';
		$con = mysql_connect($host, $username, $password);
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('ericascott', $con);
		foreach ($_POST as $key => $val) {
			if (strpos($key, 'value') != false || strpos($key, 'value') === 0) {
				$id = str_replace("values_", "", $key);
				$sql = "DELETE FROM grades WHERE id = '$id'";
				mysql_query($sql, $con);
			}
		}
		header("Location: http://ericascott.ca/index.php");
	break;
	default:
	case "none":
		//header("Location: http://ericascott.ca/index.php");
	break;
}
?>