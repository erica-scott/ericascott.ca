<?php
ob_start();
?>
<html>
<head>
<style>
.body {
	position: absolute;
	top:100px;
	left:100px;
}
.container {
        width: 300px;
        clear: both;
    }
    .container input[type=text] {
        width: 100%;
        clear: both;
    }
    .container select {
        width: 100%;
        clear: both;
    }
h1 {
	font-size:20px;
	color:#3D3D99;
}
.class_buttons {
	background-color:#3D3D99;
	color:white;
	width:115px;
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	$('#recurring_no').click(function() {
		$("#recurring_end_date").attr("disabled", "disabled");
		$("#recurring_type_daily").attr("disabled", "disabled");
		$("#recurring_type_weekly").attr("disabled", "disabled");
	});
	$('#recurring_yes').click(function() {
		$("#recurring_end_date").removeAttr("disabled");
		$("#recurring_type_daily").removeAttr("disabled");
		$("#recurring_type_weekly").removeAttr("disabled");
	});
});
</script>
</head>
<body>
<?php
date_default_timezone_set("Canada/Pacific");
include("../templates/header.php");
$action = "none";
$vars = $_POST;
foreach ($vars as $key => $val) {
	$pos = strpos($key, "action");
	if (strpos($key, "action") === 0 || strpos($key, "action") != false) {
		$action_array = explode("_", $key);
		$action = $action_array[1];
		if (isset($action_array[2])) {
			$id = $action_array[2];
		}
	}
}
switch($action) {

	case "addgrades":
	?>
		<form action="gradesactions.php" method="post">
		<div class="body">
			<h1>Add Grades</h1>
			<table class="container">
				<tr>
					<td><b>Class Name</b></td>
					<td><input type="text" name="class_name"></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Class Group</b></td>
					<td><select name="class_group">
						<option value="required">Required</option>
						<option value="complimentary_studies">Complimentary Studies</option>
						<option value="science">Science</option>
						<option value="technical">Technical</option>
						<option value="breadth">Breadth</option>
						<option value="free">Free</option>
						<option value="advanced">Advanced</option>
					</select></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Percentage</b></td>
					<td><input type="text" name="percentage"></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Set Percentage</b></td>
					<td>Yes<input type="radio" name="percentage_set" value="0">
					No<input type="radio" name="percentage_set" value="1"></td>
				</tr>
				<tr>
					<td><b>Credits</b></td>
					<td><input type="text" name="total_credits"></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Year</b></td>
					<td><select name="uni_year">
						<option value="First Year">First Year</option>
						<option value="Second Year">Second Year</option>
						<option value="Third Year">Third Year</option>
						<option value="Fourth Year">Fourth Year</option>
						<option value="Fifth Year">Fifth Year</option>
						<option value="Sixth Year">Sixth Year</option>
					</select></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Semester</b></td>
					<td>1<input type="radio" name="semester" value="1">
					2<input type="radio" name="semester" value="2">
					3<input type="radio" name="semester" value="3"></td>
				</tr>
				<tr>
					<td><b>Work Term</b></td>
					<td>No<input type="radio" name="work_term_flag" value="0">
					Yes<input type="radio" name="work_term_flag" value="1"></td>
				</tr>
				<tr>
					<td><b>Work Term</b></td>
					<td><select name="work_term">
						<option value="0">NULL</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select></td>
					<td></td>
				</tr>
			</table>
			<br>
			<input class="class_buttons" type="submit" name="action_add" value="Add Grade">
		</div>
		</form>
	<?php 
	break;
	case "removegrades":
		?>
		<div class="body">
			<form action="gradesactions.php" method="post">
			<h1>Remove Grades</h1>
			<?php
			$host = 'ericascott.ca';
			$username = 'escott';
			$password = 'silas2727';
			$con = mysql_connect($host, $username, $password);
			if (!$con) {
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db('ericascott', $con);
			$sql = "SELECT * FROM grades order by year";
			$res = mysql_query($sql, $con); ?>
			<?php
			$remember = array(); ?>
			<table>
			<?php
			while ($row = mysql_fetch_assoc($res)) { 
				if (!isset($remember[$row['year']])) { ?>
					<b><?php echo $row['year']; ?></b><br>
					<?php 
					$remember[$row['year']] = 1;
					?>
				<?php } 
				?>
				<input type="checkbox" name="values_<?php echo $row['id']; ?>" value="1"><?php echo $row['class_name']; ?><br>
			<?php } ?>
			<input class="class_buttons" type="submit" name="action_remove" value="Remove Grades">
			</form>
		</div>
		<?php
	break;
	case "editgrades":
		?>
		<?php
			$data = array();
			foreach ($_POST as $key => $val) {
				$temp = explode("_", $key);
				$size = sizeof($temp)-1;
				$id = $temp[$size];
				if (is_numeric($id)) {
					$k = str_replace("_".$id, "", $key);
					$data[$id][$k] = $val;
				}
			}
			$host = 'ericascott.ca';
			$username = 'escott';
			$password = 'silas2727';
			$con = mysql_connect($host, $username, $password);
			if (!$con) {
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db('ericascott', $con);
			$sql = "SELECT * FROM grades";
			$res = mysql_query($sql, $con); 
			while ($row = mysql_fetch_assoc($res)) {
				$id = $row['id'];
				if (array_key_exists($id, $data)) {
					$temp_arr = array('percentage_set' => $row['percentage_set'],
									  'class_name' => $row['class_name'], 
								      'percentage' => $row['percentage'],
								      'total_credits' => $row['total_credits']);
					if ($temp_arr != $data[$id]) {
						$earned = (str_replace("%", "", $data[$id]['percentage'])/100)*$data[$id]['total_credits'];
						$sql = sprintf("UPDATE grades SET class_name = '%s', percentage = '%s', total_credits = '%s', earned_credits = '%s', percentage_set = '%s' WHERE id = '%s'",
										$data[$id]['class_name'], $data[$id]['percentage'], $data[$id]['total_credits'], $earned, $data[$id]['percentage_set'], $id);
						mysql_query($sql, $con);
					}
				}
			}
			header("Location: http://ericascott.ca/index.php");
		?>
		<?php
	break;
	case "addschedule":
		$host = 'ericascott.ca';
		$username = 'escott';
		$password = 'silas2727';
		$con = mysql_connect($host, $username, $password);
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('ericascott', $con);
		?>
		<form action="scheduleactions.php" method="post">
			<div class="body">
			<h1>Add Scheduling</h1>
			<table class="container">
				<tr>
					<td><b>Task:</b></td><td><input type="text" name="task"></td>
				</tr>
				<tr>
					<td><b>Time Period:</b></td>
					<td>
						<select name="from">
							<?php
							for ($i = 1; $i < 24; $i++) {
								if ($i > 11) {
									if ($i == 12) {
										$time = $i."PM";
										$time_30 = $i.":30PM";
									} else {
										$time = ($i - 12)."PM";
										$time_30 = ($i - 12).":30PM";
									}
								} else {
									$time = $i."AM";
									$time_30 = $i.":30AM";
								}
								?>
								<option value="<?php echo $time; ?>"><?php echo $time; ?></option>
								<option value="<?php echo $time_30; ?>"><?php echo $time_30; ?></option>
								<?php
							}
							?>
						</select>
						<center><b>to</b></center>
						<select name="to">
							<?php
							for ($i = 1; $i < 24; $i++) {
								if ($i > 11) {
									if ($i == 12) {
										$time = $i."PM";
										$time_30 = $i.":30PM";
									} else {
										$time = ($i - 12)."PM";
										$time_30 = ($i - 12).":30PM";
									}
								} else {
									$time = $i."AM";
									$time_30 = $i.":30AM";
								}
								?>
								<option value="<?php echo $time; ?>"><?php echo $time; ?></option>
								<option value="<?php echo $time_30; ?>"><?php echo $time_30; ?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Day:</b></td>
					<td>
						<select name="year">
							<option value="<?php echo date("Y"); ?>"><?php echo date("Y"); ?></option>
							<option value="<?php echo (date("Y")+1); ?>"><?php echo (date("Y")+1); ?></option>
						</select>
						<select name="month">
							<?php
							for ($i = 1; $i <= 12; $i++) {
								$month = date("Y-$i-01");
								?>
								<option value="<?php echo $i; ?>"><?php echo date("F", strtotime($month)); ?></option>
								<?php
							}
							?>
						</select>
						<select name="day">
							<?php
							for ($i = 1; $i <= 31; $i++) {
								?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Group:</b></td>
					<td>
						<select name="group_id">
							<?php
							$sql = "SELECT * FROM group_name_map";
							$res = mysql_query($sql, $con);
							while ($row = mysql_fetch_assoc($res)) {
								?>
								<option value="<?php echo $row['id']; ?>"><?php echo $row['description'];?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Recurring:</b></td>
					<td>
						Yes<input type="radio" id="recurring_yes" name="recurring" value="yes">&nbsp;
						No<input type="radio" id="recurring_no" name="recurring" value="no" checked>
					</td>
				</tr>
					<tr>
						<td><b>How Often?:</b></td>
						<td>
							Daily<input type="radio" id="recurring_type_daily" name="recurring_type" value="daily" disabled>&nbsp;
							Weekly<input type="radio" id="recurring_type_weekly" name="recurring_type" value="weekly" disabled>
						</td>
					</tr>
					<tr>
						<td><b>End Date:</b></td>
						<td><input type="text" id="recurring_end_date" name="recurring_end_date" disabled><td>
					</tr>
			</table>
			<br>
			<input class="class_buttons" type="submit" name="action_add" value="Add">
			</div>
		</form>
		<?php
	break;
	case "editschedule":
		?>
		<br><br><br><br>
		<?php
		$host = 'ericascott.ca';
		$username = 'escott';
		$password = 'silas2727';
		$con = mysql_connect($host, $username, $password);
		if (!$con) {
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('ericascott', $con);
		
		$sql = "SELECT * FROM schedule WHERE id = '$id'";
		$res = mysql_query($sql, $con);
		$data = mysql_fetch_array($res);
		
		$time_period = explode("-", $data['time_period']);
		$from = $time_period[0];
		$to = $time_period[1];
		
		$day_stamp = explode("-", $data['day']);
		$year = $day_stamp[0];
		$month = $day_stamp[1];
		$day = $day_stamp[2];
		?>
		<form action="scheduleactions.php" method="post">
			<div class="body">
			<h1>Edit Schedule</h1>
			<table class="container">
				<tr>
					<td><b>Task:</b></td><td><input type="text" name="task" value="<?php echo $data['task']; ?>"></td>
				</tr>
				<tr>
					<td><b>Time Period:</b></td>
					<td>
						<select name="from">
							<?php
							for ($i = 1; $i < 24; $i++) {
								if ($i > 11) {
									if ($i == 12) {
										$time = $i."PM";
										$time_30 = $i.":30PM";
									} else {
										$time = ($i - 12)."PM";
										$time_30 = ($i - 12).":30PM";
									}
								} else {
									$time = $i."AM";
									$time_30 = $i.":30AM";
								}
								?>
								<option value="<?php echo $time; ?>" <?php if ($from == $time) { ?> selected <?php } ?> ><?php echo $time; ?></option>
								<option value="<?php echo $time_30; ?>" <?php if ($from == $time_30) { ?> selected <?php } ?> ><?php echo $time_30; ?></option>
								<?php
							}
							?>
						</select>
						<center><b>to</b></center>
						<select name="to">
							<?php
							for ($i = 1; $i < 24; $i++) {
								if ($i > 11) {
									if ($i == 12) {
										$time = $i."PM";
										$time_30 = $i.":30PM";
									} else {
										$time = ($i - 12)."PM";
										$time_30 = ($i - 12).":30PM";
									}
								} else {
									$time = $i."AM";
									$time_30 = $i.":30AM";
								}
								?>
								<option value="<?php echo $time; ?>" <?php if ($to == $time) { ?> selected <?php } ?> ><?php echo $time; ?></option>
								<option value="<?php echo $time_30; ?>" <?php if ($to == $time_30) { ?> selected <?php } ?> ><?php echo $time_30; ?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Day:</b></td>
					<td>
						<select name="year">
							<option value="<?php echo date("Y"); ?>" <?php if (date("Y") == $year) { ?> selected <?php } ?> ><?php echo date("Y"); ?></option>
							<option value="<?php echo (date("Y")+1); ?>" <?php if (date("Y")+1 == $year) { ?> selected <?php } ?> ><?php echo (date("Y")+1); ?></option>
						</select>
						<select name="month">
							<?php
							for ($i = 1; $i <= 12; $i++) {
								$month_name = date("Y-$i-01");
								?>
								<option value="<?php echo $i; ?>" <?php if ("0".$i == $month || $i == $month) { ?> selected <?php } ?> ><?php echo date("F", strtotime($month_name)); ?></option>
								<?php
							}
							?>
						</select>
						<select name="day">
							<?php
							for ($i = 1; $i <= 31; $i++) {
								?>
								<option value="<?php echo $i; ?>" <?php if ("0".$i == $day || $i == $day) { ?> selected <?php } ?>><?php echo $i; ?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td><b>Group:</b></td>
					<td>
						<select name="group_id">
							<?php
							$sql = "SELECT * FROM group_name_map";
							$res = mysql_query($sql, $con);
							while ($row = mysql_fetch_assoc($res)) {
								?>
								<option value="<?php echo $row['id']; ?>" <?php if ($row['id'] == $data['group_id']) { ?> selected <?php } ?> ><?php echo $row['description'];?></option>
								<?php
							}
							?>
						</select>
					</td>
				</tr>
			</table>
			<br>
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<input class="class_buttons" type="submit" name="action_edit" value="Edit">
		</form>
	<?php
	break;
	case "deleteschedule":
		?>
		<form action="scheduleactions.php" method="post">
			<div class="body">
			<h1>Remove Schedule</h1>
			<table class="container">
				<tr>
					<td>Are you sure you want to delete this?</td>
				</tr>
			</table>
			<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
			<input class="class_buttons" type="submit" name="action_delete" value="Delete">
		</form>
		<form action="../index.php" method="post">
		<input class="class_buttons" type="submit" name="return" value="Cancel">
		</form>
	<?php
	break;
	case "addmoney";
		$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$years = array(date("Y"), date("Y")+1, date("Y")+2, date("Y")+3);
		?>
		<form action="moneyactions.php" method="post">
			<div class="body">
			<h1>Add Money</h1>
			<table class="container">
				<tr>
					<td>Description</td>
					<td><input type="text" name="description"></td>
				</tr>
				<tr>
					<td>Total</td>
					<td><input type="text" name="price" value="$"></td>
				</tr>
				<tr>
					<td>Spent</td>
					<td><input type="text" name="paid" value="$"></td>
				</tr>
				<tr>
					<td>Date</td>
					<td>
						<select name="year">
							<?php for ($y = 0; $y < sizeof($years); $y++) { ?>
								<option value="<?php echo $years[$y]; ?>"><?php echo $years[$y]; ?></option>
							<?php } ?>
						</select>
						
						<select name="month">
							<?php for ($y = 0; $y < sizeof($months); $y++) { ?>
								<option value="<?php echo $y+1; ?>"><?php echo $months[$y]; ?></option>
							<?php } ?>
						</select>
						
						<select name="day">
							<?php for ($y = 1; $y < 32; $y++) { ?>
								<option value="<?php echo $y; ?>"><?php echo $y; ?></option>
							<?php } ?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Monthly</td>
					<td><input type="checkbox" name="monthly" value="1"></td>
				</tr>
			</table>

			<input class="class_buttons" type="submit" name="action_add" value="Add">
			</div>
		</form>
		<?php
	break;
	default:
	case "none":
		print "None";
	break;
}
?>
</body>
</html>