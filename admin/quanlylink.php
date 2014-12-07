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
		$query = "UPDATE  `link` SET  `link` =  '%s' WHERE  `id` =1";
		$query = sprintf($query,mysql_real_escape_string($_POST['link1']));mysql_query($query);
		$query = "UPDATE  `link` SET  `link` =  '%s' WHERE  `id` =2";
		$query = sprintf($query,mysql_real_escape_string($_POST['link2']));mysql_query($query);
		$query = "UPDATE  `link` SET  `link` =  '%s' WHERE  `id` =3";
		$query = sprintf($query,mysql_real_escape_string($_POST['link3']));mysql_query($query);
		$query = "UPDATE  `link` SET  `link` =  '%s' WHERE  `id` =4";
		$query = sprintf($query,mysql_real_escape_string($_POST['link4']));mysql_query($query);
		$query = "UPDATE  `link` SET  `link` =  '%s' WHERE  `id` =5";
		$query = sprintf($query,mysql_real_escape_string($_POST['link5']));mysql_query($query);
		
}
if($_POST['control']=='save'){
	save();

}
if($_POST['control']=='save_close'){
	save();
	echo "<script>window.location='index.php';</script>";
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
<script type="text/javascript" language="javascript" src="../js/ckeditor/ckeditor.js"></script>

</head>

<body>
<img src="../images/bg/bg_admin.jpg" width="100%" style="position:absolute" />
<div style="padding-top:40px; cursor:pointer;">
<div style="width:402px; height:109px; background:#fff; position:relative; padding:12px 0 0 100px" onclick="window.location='index.php'">
		<img src="../images/ico-banner/logo_admin.jpg" />
	</div>
</div>
<div style="margin:70px 0 0 40%; position:relative; color:#fff">
	<div style="width:1px; border-left:1px solid #e34929; height:65px; position:absolute; margin:8px 0 0 115px"></div>
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">GIỚI THIỆU</span>
	<div style="margin-top:30px; background:#fff; width:471px">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(102,102,102,0.5) 2px solid; border-left:rgba(102,102,102,0.5) 2px solid; border-right:rgba(102,102,102,0.5) 2px solid"></div>
			<div style="margin-left:0" class="control_admin style_hover" onclick="document.form_KPV.control.value='save'; document.form_KPV.submit()">SAVE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_close'; document.form_KPV.submit()">SAVE & CLOSE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_new'; document.form_KPV.submit()">SAVE & NEW</div>
			<div class="control_admin style_hover" onclick="document.location='index.php'">CANCEL</div>
			<div class="clr"></div>
		</div>
</div>
<form method="post" name="form_KPV" id="form_KPV" action="" enctype="multipart/form-data">
	<input type="hidden" name="control" value="0" />
<div style="position:relative;margin:50px 0 0 20px">
<?php 		$data=array();
		$sql = "SELECT * FROM  `link` ORDER BY `id` ASC";
		$result = mysql_query($sql, $connection);
		while ($row = mysql_fetch_array($result)){
		$id=$row['id'];
		$data[$id]=$row['link'];
		}
?>
		<div>
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">FACEBOOK</div>
			<input name="link1" type="text" value="<?php echo $data[1]?>" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">TWITTER</div>
			<input name="link2" type="text" value="<?php echo $data[2]?>" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">RSS</div>
			<input name="link3" type="text" value="<?php echo $data[3]?>" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">PRINCESS</div>
			<input name="link4" type="text" value="<?php echo $data[4]?>" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
</div>
</form>
</body>
</html>