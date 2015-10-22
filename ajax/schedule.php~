<html>
<head>
<style>
.class_buttons {
	background-color:#3D3D99;
	color:white;
	width:135px;
	height:30px;
	-moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
}
.class_buttons:hover {
	background-color:white;
	color:#3D3D99;
}

</style>
<script>
</script>
</head>
<body>
<?php
date_default_timezone_set("Canada/Pacific");
$day_array = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");

$host = 'ericascott.ca';
$username = 'escott';
$password = 'silas2727';
$con = mysql_connect($host, $username, $password);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('ericascott', $con);
$sql = "SELECT * from schedule order by day, start_time";
$res = mysql_query($sql, $con);
$months = array();
$data = array();
$ids = array();
while ($row = mysql_fetch_assoc($res)) {
	$month = date("F", strtotime($row['day']));
	if (!in_array($month, $months)) {
		$month_num = date_parse($month);
		if ($month_num['month'] >= date('n')) {
			array_push($months, $month);
		}
	}
	if (isset($data[$row['day']])) {
		$data[$row['day']][$row['id']] = $row['task']." ".$row['time_period'];
	} else {
		$data[$row['day']][$row['id']] = $row['task']." ".$row['time_period'];
	}
}
?>
<br>
<form method="post" action="../lib/actions.php">
<input class="class_buttons" type="submit" id="action_addschedule" name="action_addschedule" value="Add">
<?php
for ($m = 0; $m < sizeof($months); $m++) {
	$month_time = strtotime($months[$m]);
	$year = date("Y", $month_time);
	$num_days = date("t", $month_time);
	$mon = date("n", $month_time);
	$start_day = date("01-$mon-$year");
	$start_day = date("D", strtotime($start_day));
?>
<br>
<b><?php echo $months[$m]; ?></b>
<table border="1" width="85%" style="border-collapse:collapse;">
<col width="12">
<col width="12">
<col width="12">
<col width="12">
<col width="12">
<col width="12">
<col width="12">
<tr>
	<td><b><center>Sun</center></b></td>
	<td><b><center>Mon</center></b></td>
	<td><b><center>Tue</center></b></td>
	<td><b><center>Wed</center></b></td>
	<td><b><center>Thu</center></b></td>
	<td><b><center>Fri</center></b></td>
	<td><b><center>Sat</center></b></td>
</tr>
<tr>
<?php
	for ($i = 1; $i <= $num_days; $i++) {
		if ($i == 1) {
			$j = array_search($start_day, $day_array);
			$k = $j;
			while ($k > 0) { 
				?>
				<td>&nbsp;</td>
				<?php
				$k--;
			}
			?>
			<td <?php if (strtotime("$year-$mon-$i") < strtotime(date("Y-m-d"))) { ?> style="background-color:#BBBBBB;" <?php } ?>><?php print "<b>".$i."</b><br/>"; ?>
			<?php
			if ($mon < 10) {
				if (isset($data["$year-0$mon-0$i"])) {
					foreach ($data["$year-0$mon-0$i"] as $key => $val) {
						if (is_numeric($key)) {
							print "- ".$val; 
							if (strtotime("$year-$mon-0$i") >= strtotime(date("Y-m-d"))) {
							?>
							<input type="image" src="../images/editbutton.jpg" id="action_editschedule_<?php echo $key; ?>" name="action_editschedule_<?php echo $key; ?>" alt="Submit Form" style="width:15px;height:15px;">
							<input type="image" src="../images/deletebutton.jpg" id="action_deleteschedule_<?php echo $key; ?>" name="action_deleteschedule_<?php echo $key; ?>" alt="Submit Form" style="width:15px;height:15px;">
							<?php } ?>
							<?php print "<br/>";
						}
					}
				}
			} else {
				if (isset($data["$year-$mon-0$i"])) {
					foreach ($data["$year-$mon-0$i"] as $key => $val) {
						if (is_numeric($key)) {
							print "- ".$val; 
							if (strtotime("$year-$mon-0$i") >= strtotime(date("Y-m-d"))) {
							?>
							<input type="image" src="../images/editbutton.jpg" id="action_editschedule_<?php echo $key; ?>" name="action_editschedule_<?php echo $key; ?>" alt="Submit Form" style="width:15px;height:15px;">
							<input type="image" src="../images/deletebutton.jpg" id="action_deleteschedule_<?php echo $key; ?>" name="action_deleteschedule_<?php echo $key; ?>" alt="Submit Form" style="width:15px;height:15px;">
							<?php } ?>
							<?php print "<br/>";
						}
					}
				}
			}
			?>
			</td>
			<?php
		} else {
			if ($j == 6) {
				$j = 0;
				?>
				</tr>
				<tr>
				<?php
			} else {
				$j++;
			}
			?>
			<td <?php if (strtotime("$year-$mon-$i") < strtotime(date("Y-m-d"))) { ?> style="background-color:#BBBBBB;" <?php } ?>> <?php print "<b>".$i."</b><br/>"; ?>
			<?php
			if ($i < 10 && $mon < 10) {
				$check_date = "$year-0$mon-0$i";
			} else if ($i < 10 && $mon >= 10) {
				$check_date = "$year-$mon-0$i";
			} else if ($i >= 10 && $mon < 10) {
				$check_date = "$year-0$mon-$i";
			} else {
				$check_date = "$year-$mon-$i";
			}
			if (isset($data[$check_date])) {
				foreach ($data[$check_date] as $key => $val) {
					if (is_numeric($key)) {
						print "- ".$val; ?>
						<?php if (strtotime($check_date) >= strtotime(date("Y-m-d"))) { ?>
						<input type="image" src="../images/editbutton.jpg" id="action_editschedule_<?php echo $key; ?>" name="action_editschedule_<?php echo $key; ?>" alt="Submit Form" style="width:15px;height:15px;">
						<input type="image" src="../images/deletebutton.jpg" id="action_deleteschedule_<?php echo $key; ?>" name="action_deleteschedule_<?php echo $key; ?>" alt="Submit Form" style="width:15px;height:15px;">
						<?php } ?>
						<?php print "<br/>";
					}
				}
			}
			?>
			</td>
			<?php
		}
	}
?>
</tr>
</table>
<br><br>
<?php } ?>
</form>
</body>
</html>