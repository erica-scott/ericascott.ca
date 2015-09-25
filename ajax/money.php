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

$months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
$years = array(date("Y"), date("Y")+1, date("Y")+2, date("Y")+3);
$start_date = 'September, 2015';

$host = 'ericascott.ca';
$username = 'escott';
$password = 'silas2727';
$con = mysql_connect($host, $username, $password);
if (!$con) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db('ericascott', $con);

$sql = "SELECT * FROM money ORDER BY date";
$res = mysql_query($sql, $con);
$data = array();
$i = 0;
while ($row = mysql_fetch_assoc($res)) {
	$data[$i] = $row;
	$i++;
}
?>
<br><br>
<form method="post" action="../lib/actions.php">
<input class="class_buttons" type="submit" id="action_addmoney" name="action_addmoney" value="Add">
<br><br>
<?php 
	$flag = 0;
	for ($j = 0; $j < sizeof($years); $j++) { ?>
	<?php for ($i = 0; $i < sizeof($months); $i++) { 
		if (($months[$i].", ".$years[$j]) == $start_date || $flag == 1) {
			$flag = 1; 
			$total_paid = 0;
			$total_price = 0; ?>
	<table border=1 style="border-collapse: collapse;" width="35%">
		<col width="33%">
		<col width="33%">
		<col width="33%">
		<tr>
			<td><b><?php echo $months[$i].", ".$years[$j]; ?></b></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<?php for ($k = 0; $k < sizeof($data); $k++) {
			if ($data[$k]['month_year'] == $months[$i].", ".$years[$j]) { ?>
		<tr>
			<td><input <?php if (str_replace("$", "", $data[$k]['paid']) < 0) { ?> style="color: red;" <?php } ?> type="text" name="<?php echo "paid_".$data[$k]['id']; ?>" value="<?php echo $data[$k]['paid']; ?>" ></td>
			<td <?php if (str_replace("$", "", $data[$k]['price']) < 0) { ?> style="color: red;" <?php } ?> ><?php echo $data[$k]['price'];?></td>
			<td><?php echo $data[$k]['description']; ?></td>
		</tr>
			<?php 
				$total_paid += str_replace("$", "", $data[$k]['paid']);
				$total_price += str_replace("$", "", $data[$k]['price']);
			}
		} ?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td <?php if ($total_paid < 0) { ?> style="color: red;" <?php } ?> ><?php echo "$".$total_paid; ?></td>
			<td <?php if ($total_price < 0) { ?> style="color: red;" <?php } ?> ><?php echo "$".$total_price; ?></td>
			<td>&nbsp;</td>
		</tr>
	</table>
	<br>
	<?php 
			if ($months[$i] == 'December') {
				$month_year = 'January, '.$years[$j+1];
			} else {
				$month_year = $months[$i+1].", ".$years[$j];
			}
			$sql = "SELECT * FROM money WHERE description = 'Leftover' and month_year = '$month_year'";
			$res = mysql_query($sql, $con);
			if ($row = mysql_fetch_assoc($res)) {
				$leftover = "UPDATE money SET price = '$total_price', paid = '$total_paid' WHERE description = 'Leftover' AND month_year = '$month_year'";
			} else {
				$leftover = "INSERT INTO money (price, paid, description, date, month_year) VALUES ('$total_price', '$total_paid', 'Leftover', '$first_day', '$month_year')";
			}
			mysql_query($leftover, $con);
		}
	}
} ?>
</form>
</body>
</html>