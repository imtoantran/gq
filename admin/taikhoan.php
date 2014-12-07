<?php	session_start();
		if(empty($_SESSION['user_id']) OR empty($_SESSION['user_password']) ) {
   		header('Location: login.php' ); 
		}
		include_once('../config/conn.php');
		function text_readmore($text,$lengh_text){
			$text=trim($text);
			$noi_dung_text_readmore=NULL;
			
			if(strlen($text)>$lengh_text){
				$text=substr($text,0,($lengh_text+3));
				$array_text=explode(' ',$text);			
				$lengh=count($array_text);
				for($k=0; $k < $lengh-1; $k++) {
					$noi_dung_text_readmore = $noi_dung_text_readmore.$array_text[$k].' ';
				}
				echo $noi_dung_text_readmore.' ...';
				
			}
			else echo $text;		
		}
function save(){
		if($_POST['user'] && $_POST['user'] !=NULL && $_POST['pass'] !=NULL ){
			$query = "UPDATE `user` SET `name` = '%s', `pass` = '%s'";
			$query = sprintf($query
					,mysql_real_escape_string($_POST['user'])
					,mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['pass'])))
					);
			mysql_query($query);
			?><script>window.location='index.php';</script><?php 
		}
}
if($_POST['control']=='save'){
	save();

}
if($_POST['control']=='save_close'){
	save();
}
if($_POST['control']=='save_new'){
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GIAY QUOC ADMIN</title>
<link href="base.css" media="screen" rel="stylesheet" type="text/css" />
<link href="admin.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/dropdown2.js"></script>

</head>

<body>
<img src="../images/bg/bg_admin.jpg" width="100%" style="position:absolute" />
<div style="padding-top:40px; cursor:pointer;">
<div style="width:402px; height:109px; background:#fff; position:relative; padding:12px 0 0 100px" onClick="window.location='index.php'">
		<img src="../images/ico-banner/logo_admin.jpg" />
	</div>
</div>
<div style="margin:70px 0 0 40%; position:relative; color:#fff">
	<div style="width:1px; border-left:1px solid #e34929; height:65px; position:absolute; margin:8px 0 0 115px"></div>

	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">TÀI KHOẢN</span>
    <div id="notice" style=" font-size:14px; position:absolute"><?php echo $_POST['notice']; ?></div>

	<form action="" method="post" name="form_KPV">
	<input type="hidden" name="control" />
    <input type="hidden" name="notice" />
	<div style="margin-top:30px">
			<div style="float:left; background:#e34929; height:33px; width:140px; color:#fff; padding:8px 0 0 20px">Username</div>
			<input onKeyPress="check_key()"name="user" type="text" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:20px">
			<div style="float:left; background:#e34929; height:33px; width:140px; color:#fff; padding:8px 0 0 20px">Password</div>
			<input onKeyPress="check_key()" name="pass" type="password" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
        <div style="margin-top:20px">
			<div style="float:left; background:#e34929; height:33px; width:140px; color:#fff; padding:8px 0 0 20px">Confirm Password</div>
			<input onKeyPress="check_key()" name="pass2" type="password" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
        
		<div style="margin-top:20px">
			<div onClick="document.form_KPV.control.value='save_close'; if(document.form_KPV.pass.value!=''){if(document.form_KPV.pass.value==document.form_KPV.pass2.value) {document.form_KPV.notice.value='Change your accound success';document.form_KPV.submit()} else document.getElementById('notice').innerHTML='Confirm password incorrect '} else document.getElementById('notice').innerHTML='! Emty Password '" style=" cursor:pointer;background:#e34929; height:33px; width:84px; color:#fff; padding:9px 0 0 0; text-align:center">SAVE</div>
		</div>
		</form>
	
</div>
</body>
</html>