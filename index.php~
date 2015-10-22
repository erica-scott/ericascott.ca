<?php
session_start();
?>
<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
$(document).ready(function() {
		$('#button_money').click(function() {
				$.post("ajax/money.php", function(data) {
					document.getElementById("money").innerHTML = data;
				});
				$('#money').show();
				$('#schedule').hide();
				$('#gradesplanning').hide();
				$('#gradesplanning_extra').hide();
				$('#grocerylist').hide();
				$('#changepassword').hide();
				$('#addgrades').hide();
		});
		$('#button_schedule').click(function() {
				$.post("ajax/schedule.php", function(data) {
					document.getElementById("schedule").innerHTML = data;
				});
				$('#money').hide();
				$('#schedule').show();
				$('#gradesplanning').hide();
				$('#gradesplanning_extra').hide();
				$('#grocerylist').hide();
				$('#changepassword').hide();
				$('#addgrades').hide();
		});
		$('#button_gradesplanning').click(function() {
				$.post("ajax/gradesplanning.php", function(data) {
					document.getElementById("gradesplanning").innerHTML = data;
				});
				$('#money').hide();
				$('#schedule').hide();
				$('#gradesplanning').show();
				$('#gradesplanning_extra').show();
				$('#grocerylist').hide();
				$('#changepassword').hide();
				$('#addgrades').hide();
		});
		$('#button_grocerylist').click(function() {
				$.post("ajax/grocerylist.php", function(data) {
					document.getElementById("grocerylist").innerHTML = data;
				});
				$('#money').hide();
				$('#schedule').hide();
				$('#gradesplanning').hide();
				$('#gradesplanning_extra').hide();
				$('#grocerylist').show();
				$('#changepassword').hide();
				$('#addgrades').hide();
		});
		$('#button_changepassword').click(function() {
				$.post("ajax/changepassword.php", function(data) {
					alert(data);
					document.getElementById("changepassword").innerHTML = data;
				});
				$('#money').hide();
				$('#schedule').hide();
				$('#gradesplanning').hide();
				$('#gradesplanning_extra').hide();
				$('#grocerylist').hide();
				$('#changepassword').show();
				$('#addgrades').hide();
		});
		$('#action_add').click(function() {
				$.post("ajax/addgrades.php", function(data) {
					document.getElementById("addgrades").innerHTML = data;
				});
				$('#money').hide();
				$('#schedule').hide();
				$('#gradesplanning').hide();
				$('#gradesplanning_extra').hide();
				$('#grocerylist').hide();
				$('#changepassword').hide();
				$('#addgrades').show();
		});
});
</script>
<?php
if ((isset($_POST['submit']) && $_POST['submit'] == 'Login') || (isset($_GET['username']) && isset($_GET['password']))) {
	$host = 'ericascott.ca';
	$username = 'escott';
	$password = 'silas2727';
	$con = mysql_connect($host, $username, $password);
	if (!$con) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('ericascott', $con);
	
	$sql = "SELECT * FROM password";
	$res = mysql_query($sql, $con);
	$row = mysql_fetch_assoc($res);
	if ($_POST['username'] == $row['username'] && $_POST['password'] = $row['password']) {
		$_SESSION["logged_in"] = true;
	} else if ($_SESSION["logged_in"] != true) {
		$_SESSION["logged_in"] = false;
	}
} else if (isset($_POST['logout'])) {
	$_SESSION["logged_in"] = false;
}
?>
<style>
.body {
	position:relative;
	top:100px;
	left:100px;
}
.submit_button {
	background-color:#3D3D99;
	color:white;
	width:135px;
	height:30px;
	box-shadow: 5px 5px 5px #888888;
	-moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
}
.submit_button:hover {
	background-color:white;
	color:#3D3D99;
}
h1 {
	color:#3D3D99;
	font-size:50px;
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
include("templates/header.php");
?>
<div class="body">
<?php
	if ($_SESSION["logged_in"] == true) { ?>
		<input class="submit_button" type="submit" id="button_money" name="button_money" value="Money">
		<input class="submit_button" type="submit" id="button_schedule" name="button_schedule" value="Schedule">
		<input class="submit_button" type="submit" id="button_gradesplanning" name="button_gradesplanning" value="Grades & Planning">
		<input class="submit_button" type="submit" id="button_grocerylist" name="button_grocerylist" value="Grocery List">
		<input class="submit_button" type="submit" id="button_changepassword" name="button_changepassword" value="Change Password">
		<div id="money" style="display:none;"></div>
		<div id="schedule" style="display:none;"></div>
		<div id="gradesplanning_extra" style="display:none;">
			<form action="lib/actions.php" method="post">
			<input style="position:relative; left:365px; top:20px;" class="class_buttons" type="submit" name="action_addgrades" value="Add Class">
			<input style="position:relative; left:365px; top:20px;" class="class_buttons" type="submit" name="action_removegrades" value="Remove Class">
			</form>
		</div>
		<div id="gradesplanning" style="display:none;">
		<div id="grocerylist" style="display:none;"></div>
		<div id="changepassword" style="display:none;"></div>
	<?php } else { ?>
		<h1>Welcome!</h1>
	<?php }
?>
</div>
</body>
</html>