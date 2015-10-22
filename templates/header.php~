<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
	$("#li_tab1").click(function() {
			window.location.assign("/index.php");
	});
	$("#li_tab2").click(function() {
			window.location.assign("/templates/aboutme.php");
	});
	$("#li_tab3").click(function() {
			window.location.assign("/templates/contact.php");
	});
});
</script>
<style>
.header {
    background-color:#FFC285;
    position:fixed;
    width:100%;
    height:10%;
    top:0px;
    left:0px;
    z-index:1000;
}
.title_left {
	position:fixed;
	left:40px;
	font-size: 50px;
	color: #3D3D99;
	font-family: "Georgia", Georgia, serif;
	font-weight: bold;
	text-shadow: 2px 1px black;
}
.data {
	font-size: 20px;
	color: #3D3D99;
	font-family: "Georgia", Georgia, serif;
}
#Tabs ul {
	padding: 0px;
	margin: 0px;
	margin-left: 10px;
	list-style-type: none;
}

#Tabs ul li {
	display: inline-block;
	clear: none;
	float: left;
	height: 24px;
}

#Tabs ul li a {
	position: relative;
	top:22px;
	left:430px;
	margin-top: 16px;
	display: block;
	margin-left: 6px;
	line-height: 24px;
	padding-left: 10px;
	background: #3D3D99;
	z-index: 9999;
	border: 1px solid #ccc;
	border-bottom: 0px;
	
	/* The following four lines are to make the top left and top right corners of each tab rounded. */
	-moz-border-radius-topleft: 4px;
	border-top-left-radius: 4px;
	-moz-border-radius-topright: 4px;
	border-top-right-radius: 4px;
	/* end of rounded borders */
	
	width: 130px;
	color: white;
	text-decoration: none;
	font-weight: bold;
}

#Tabs ul li a:hover {
	background-color: white;
	color:#3D3D99;
}

#Tabs #Content_Area { // this is the css class for the content displayed in each tab
	padding: 0 15px;
	clear:both;
	overflow:hidden;
	line-height:19px;
	position: relative;
	top: 20px;
	z-index: 5;
	height: 150px;
	overflow: hidden;
}
.submit {
	position:absolute;
	top:15px;
	right:20px;
	background-color:#3D3D99;
	color:white;
	width:80px;
	height:30px;
	box-shadow: 5px 5px 5px #888888;
	-moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
}
.submit:hover {
	background-color:white;
	color:#3D3D99;
}
</style>
</head>
<body>
<div class="header">
	<div class="title_left">ERICA SCOTT</div>
	<div id="Tabs">
		<ul>
		<li id="li_tab1"><a>Main Page</a></li>
		<li id="li_tab2"><a>About Me</a></li>
		<li id="li_tab3"><a>Contact Info</a></li>
		</ul>
	</div>
		<?php if ($_SESSION["logged_in"] == true) { ?>
			<form id="logout" name="logout" action="../index.php" method="post"> 
			<input type="submit" class="submit" name="logout" value="Logout">
			</form>
		<?php } else { ?>
			<form id="login" name="login" action="templates/login.php" method="post">
			<input type="submit" class="submit" name="login" value="Login">
			</form>
		<?php } ?>
</div>
</body>
</html>