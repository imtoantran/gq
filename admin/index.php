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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GIAY QUOC ADMIN</title>
<link href="base.css" media="screen" rel="stylesheet" type="text/css" />
<link href="admin.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/dropdown2.js"></script>
<style>
.menu{
float:left; padding:80px 0 0 0; text-align:center; font-size:18px; width:177px; height:177px; background:#fff; border-right:1px solid rgba(102,102,102,0.8); border-bottom:1px solid rgba(102,102,102,0.7);  color:#000
}
.box_black{
	position:absolute; background:rgba(0,0,0,0.8); height:40px; width:40px; border-left:1px solid #636363; border-top:1px solid #595959; border-right:1px solid #3f3f3f
}
</style>
</head>

<body>
<img src="../images/bg/bg_admin.jpg" width="100%" style="position:absolute" />
<div style="padding-top:40px; cursor:pointer;">
<div style="width:402px; height:109px; background:#fff; position:relative; padding:12px 0 0 100px" onclick="window.location='index.php'">
		<img src="../images/ico-banner/logo_admin.jpg" />
	</div>
</div>
<div style="margin:70px 0 0 20%; position:relative">
	<a href="hinhanh.php"><div class="menu"><div style="margin:56px 0 0 0" class="box_black"></div>HÌNH ẢNH</div></a>
	<a href="tintucmoi.php?install=1"><div class="menu" style="margin-left:2px"><div style="margin:-80px 0 0 0" class="box_black"></div>TIN TỨC MỚI</div></a>
	<a href="quanlytintuc.php"><div  class="menu" style="margin-left:2px"><div style="margin:56px 0 0 0" class="box_black"></div>QUẢN LÝ TIN TỨC</div></a>
	<a href="spmoi.php?install=1"><div  class="menu" style="margin-left:2px"><div style="margin:-80px 0 0 0" class="box_black"></div>CẬP NHẬT S/P</div></a>
	<div class="clr" style="height:10px"></div>
	<a href="quanlysp.php"><div  class="menu"><div style="margin:56px 0 0 0" class="box_black"></div>QUẢN LÝ S/P</div></a>
	<a href="donhang.php"><div  class="menu" style="margin-left:2px"><div style="margin:-80px 0 0 0" class="box_black"></div>ĐƠN HÀNG</div></a>
	<a href="quanlylink.php"><div class="menu" style="margin-left:2px"><div style="margin:56px 0 0 0" class="box_black"></div>QUẢN LÝ LINK</div></a>
	<a href="taikhoan.php"><div  class="menu" style="margin-left:2px"><div style="margin:-80px 0 0 0" class="box_black"></div>TÀI KHOẢN</div></a>
	<div class="clr"></div>
	
	
</body>
</html>