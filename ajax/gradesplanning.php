<html>
<head>
<style>
table {
	border-collapse: collapse;
}
.totals {
	position: absolute;
	top: 50px;
	left: 20px;
}
.Required {
	color: black;
}
.Science {
	color: blue;
}
.ComplimentaryStudies {
	color: pink;
}
.Advanced {
	color: orange;
}
.Technical {
	color: green;
}
.Breadth {
	color: red;
}
.Free {
	color: purple;
}
.Workterm {
	color:brown;
}
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
</head>
<body>
<?php
date_default_timezone_set("Canada/Pacific");

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
$years = array();
while ($row =  mysql_fetch_assoc($res)) {
	if (!in_array($row['uni_year']." ".$row['year'], $years)) {
		array_push($years, $row['uni_year']." ".$row['year']);
	}
}
?>
<br><br>
<form action="../lib/actions.php" method="post">
<table id="outside" cellpadding="5" cellspacing="5">
<?php for ($k = 0; $k < sizeof($years); $k++) {
	$sql = sprintf("SELECT * FROM grades WHERE concat(uni_year, ' ', year) = '%s' and semester = '1'", $years[$k]);
	$res = mysql_query($sql, $con);
	$sem1_data = array();
	$sem1_credits = array('earned_total' => 0, 'credits_total' => 0);
	$i = 0;
	while($row =  mysql_fetch_assoc($res)) {
		$sem1_data[$i] = $row;
		$sem1_credits['earned_total'] += $row['earned_credits'];
		$sem1_credits['credits_total'] += $row['total_credits'];
		$i++;
	}
	$sql = sprintf("SELECT * FROM grades WHERE concat(uni_year, ' ', year) = '%s' and semester = '2'", $years[$k]);
	$res = mysql_query($sql, $con);
	$sem2_data = array();
	$sem2_credits = array('earned_total' => 0, 'credits_total' => 0);
	$i = 0;
	while($row =  mysql_fetch_assoc($res)) {
		$sem2_data[$i] = $row;
		$sem2_credits['earned_total'] += $row['earned_credits'];
		$sem2_credits['credits_total'] += $row['total_credits'];
		$i++;
	}
	$sql = sprintf("SELECT * FROM grades WHERE concat(uni_year, ' ', year) = '%s' and semester = '3'", $years[$k]);
	$res = mysql_query($sql, $con);
	$sem3_data = array();
	$sem3_credits = array('earned_total' => 0, 'credits_total' => 0);
	$i = 0;
	while($row =  mysql_fetch_assoc($res)) {
		$sem3_data[$i] = $row;
		$sem3_credits['earned_total'] += $row['earned_credits'];
		$sem3_credits['credits_total'] += $row['total_credits'];
		$i++;
	}
	$percentage = $i + 64;
	$r = $k%3;
	if ($k != 0 && $r == 0) { ?>
		</tr>
		<tr>
	<?php }
	?>
	<td>
	<table width="100%" id="each_outside" border="3" cellpadding="5" cellspacing="5">
		<tr>
			<?php 
			$years_css = explode(" ", $years[$k]); 
			$years_css[0] = "<b>".$years_css[0]."</b>";
			$years_css[1] = "<b>".$years_css[1]."</b>";
			$years[$k] = implode(" ", $years_css);
			?>
			<td><?php echo $years[$k]; ?></td>
		</tr>
		<?php for ($j = 1; $j < 4; $j++) {  
			if ($j == 1) {
				$data = $sem1_data;
			} else if ($j == 2) {
				$data = $sem2_data;
			} else {
				$data = $sem3_data;
			}
			?>
			<tr>	
				<td><i>Semester <?php echo $j; ?></i></td>
			</tr>
			<tr>
				<td>
					<table width="100%" id="inside_<?php echo $i; ?>" border="1" >
					<?php 
					$count = 0;
					for ($i=0; $i < sizeof($data); $i++) { 
						$count++;
						?>
						<tr>
							<?php 
							$class = str_replace(" ", "", $data[$i]['class_group']); 
							?>
							<?php if ($data[$i]['percentage_set'] == 1) { 
								?>
								<td class="<?php echo $class; ?>"><?php echo $data[$i]['class_name']; ?></td>
								<td><?php echo $data[$i]['percentage']; ?></td>
								<td><?php echo $data[$i]['total_credits']; ?></td>
							<?php } else { ?>
								<input type="hidden" name="percentage_set_<?php echo $data[$i]['id']; ?>" value="0">
								<td><input class="<?php echo $class; ?>" style="width:90px;"type="text" id="class_name" name="class_name_<?php echo $data[$i]['id']; ?>" value="<?php echo $data[$i]['class_name']; ?>"></td>
								<td><input style="width:50px;"type="text" id="percentage" name="percentage_<?php echo $data[$i]['id']; ?>" value="<?php echo $data[$i]['percentage']; ?>"></td>
								<td><input style="width:20px;"type="text" id="total_credits" name="total_credits_<?php echo $data[$i]['id']; ?>" value="<?php echo $data[$i]['total_credits']; ?>"></td>
								<td><input type="checkbox" name="percentage_set_<?php echo $data[$i]['id']; ?>" value="1"></td>
							<?php }?>
							<td><?php echo $data[$i]['earned_credits']; ?></td>
						</tr>
					<?php } 
					if ($j == 1) {
						$total = $sem1_credits['credits_total'];
						$earned = $sem1_credits['earned_total'];
						$total_flag = 1;
					} else if ($j == 2) {
						$total = $sem2_credits['credits_total'];
						$earned = $sem2_credits['earned_total'];
						$total_flag = 1;
					} else {
						$total = $sem3_credits['credits_total'];
						$earned = $sem3_credits['earned_total'];
					}
					if ($total == 0 || $earned == 0) {
						$percentage = 0;
					} else {
						$percentage = round(($earned/$total)*100, 2);
					}
					
					if ($count > 0) {
					?> 
						<tr>
							<td><b>FINAL</b></td>
							<td><?php echo $percentage."%"; ?></td>
							<td><?php echo $total; ?></td>
							<td><?php echo $earned; ?></td>
						</tr>
					<?php } ?>
				</table>
				</td>
			</tr>
		<?php }
		$percentage_total = round((($sem1_credits['earned_total'] + $sem2_credits['earned_total'] + $sem3_credits['earned_total'])/($sem1_credits['credits_total'] + $sem2_credits['credits_total'] + $sem3_credits['credits_total']))*100, 2);
		$years_found = preg_replace("/[A-Z]{1}[a-z]{1,15} /", "", $years[$k]);
		$year_found = explode("-", $years_found);
		$year_true = date("Y");
		if ($year_found[1] <= $year_true) {
			$totals[$k]['earned_total'] = $sem1_credits['earned_total'] + $sem2_credits['earned_total'] + $sem3_credits['earned_total'];
			$totals[$k]['credits_total'] = $sem1_credits['credits_total'] + $sem2_credits['credits_total'] + $sem3_credits['credits_total'];
		}
		?>
		<tr>
		<td>
		<?php if ($k == '1') { ?>
			<br>
		<?php } else if ($k == '4') {?>
			<br><br><br>
		<?php } ?>
		<i>Total Percentage:</i> <?php echo $percentage_total."%"; ?></td>
		</tr>
	</table>
	</td>
<?php } ?>
</table>
<?php
$earned = 0;
$credits = 0;
$totals = array_values($totals);
for ($i = 0; $i < sizeof($totals); $i++) {
	$earned += $totals[$i]['earned_total'];
	$credits += $totals[$i]['credits_total'];
}
if ($earned == 0 || $credits == 0) {
	$percentage = "Error!!";
} else {
	$percentage = round(($earned/$credits)*100, 2);
}
?>
<div class="totals">
<b>Totals: <?php echo $earned; ?> / <?php echo $credits; ?> : <?php echo $percentage."%"; ?></b>&nbsp;|&nbsp;
<input class="class_buttons" type="submit" id="action_edit" name="action_editgrades" value="Save Values">
</form>
</div>
</body>
</html>