<html>
<head>
<style>
.body {
	position:relative;
	top:100px;
	left:100px;
}
.submit_button {
	background-color:#3D3D99;
	color:white;
	width:60px;
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
.container {
        width: 150px;
        clear: both;
    }
    .container input {
        width: 100%;
        clear: both;
    }
</style>
</head>
<body>
<?php
include("header.php");
?>
<div class="body">
	<form method="post" action="../index.php">
	<div class="container">
		  <b>Username:</b><input type="text" name="username"> <br>
		  <b>Password:</b><input type="password" name="password"> <br><br>
		  <input class="submit_button" type="submit" name="submit" value="Login">
	</div>
	</form>
</div>
</body>
</html>