<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GIAY QUOC ADMIN</title>
<link href="base.css" media="screen" rel="stylesheet" type="text/css" />
<link href="admin.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/dropdown2.js"></script>
<script type="text/javascript">
	function check_key(){
		
	}
</script>

</head>
<?php
	if($_POST['user']){
		include_once('../config/conn.php');
		
    	$user=$_POST['user'];
		$pass=$_POST['pass'];
		
	
		$sql = "SELECT * FROM  `user` WHERE `name`= '$user' AND `pass`= '$pass'";
		$result = mysql_query($sql, $connection);				
		if(mysql_num_rows($result)){

			session_start();
			session_register("user_id", "user_password");  
			$_SESSION['user_id'] = $user;   
			$_SESSION['user_password'] = $pass;
			?><script> window.location = "index.php";</script><?php 
		}
	}		
?>

<body>
<img src="../images/bg/bg_admin.jpg" width="100%" style="position:absolute" />
<div style="padding-top:40px; cursor:pointer;">
<div style="width:402px; height:109px; background:#fff; position:relative; padding:12px 0 0 100px">
		<img src="../images/ico-banner/logo_admin.jpg" />
	</div>
</div>
<form action="" method="post" name="login">
<div style="margin:70px 0 0 40%; position:relative; color:#fff">
	<div style="width:1px; border-left:1px solid #e34929; height:65px; position:absolute; margin:8px 0 0 115px"></div>
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">CPANEL LOGIN</span>
	<div style="margin-top:30px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Username</div>
			<input onkeypress="check_key()"name="user" type="text" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:20px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Password</div>
			<input onkeypress="check_key()" name="pass" type="password" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:20px">
		<button type="submit" style=" border:none; cursor:pointer;background:#e34929; height:33px; width:84px; color:#fff; padding:0px 0 54px0 0; text-align:center">Login</button>
		</div>	
</div>
</form>
</body>
</html>