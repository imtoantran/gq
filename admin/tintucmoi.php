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
function install(){
		$row = mysql_fetch_array(mysql_query("SELECT MAX(Id) FROM `tintuc`"));
		$max_id=$row['MAX(Id)']+1;
		$s = "INSERT INTO  `tintuc` (`id` ,`tieude` ,`noidung` ,`date`
		)";

		
		$s.= "VALUES ('%s',  '%s',  '%s','" . date('Y-m-d',time()) . "')";
		$s = sprintf
			($s			
			,mysql_real_escape_string($max_id)
			,mysql_real_escape_string($_POST['tieude'])
			,mysql_real_escape_string(stripslashes(htmlspecialchars($_POST['noidung'])))
			,mysql_real_escape_string(date('Y-m-d',time()))
			);
		mysql_query($s);

		
		//UPLOAD IMAGE
		$input_img='Get_url_Image1';
		$uploadpath = '../images/news/';
		$name_upload=$max_id;      // directory to store the uploaded files
		include('upload_image_base_nothumb.php');
			
		if($_POST['install']=='1') echo "<script>window.location='tintucmoi.php?item=".$max_id."';</script>";
		
		for($i=2;$i<=5;$i++){
			$input_img='Get_url_Image'.$i;
			$name_upload=$max_id.'-'.$i;	
			$uploadpath = '../images/news/';
			
			include('upload_image_base_nothumb.php');
		}

}
function save(){
		$query = "UPDATE `tintuc` SET `tieude` = '%s', `noidung` = '%s' where `id` = '%s'";
		$query = sprintf($query
				,mysql_real_escape_string($_POST['tieude'])
				,mysql_real_escape_string(stripslashes(($_POST['noidung'])))
				,mysql_real_escape_string($_POST['item'])
				);
		mysql_query($query);

		
		$input_img='Get_url_Image1';
		$uploadpath = '../images/news/';
		$name_upload=$_POST['item'];      // directory to store the uploaded files
		include('upload_image_base_nothumb.php');
			
		for($i=2;$i<=5;$i++){
			$input_img='Get_url_Image'.$i;
			$name_upload=$_POST['item'].'-'.($i-1);	
			$uploadpath = '../images/news/';
			
			include('upload_image_base_nothumb.php');
		}
}

if($_POST['control']=='save'){
	if($_POST['install']=='1') install(); else save();
}

if($_POST['control']=='save_close'){
	if($_POST['install']==1) install(); else save();
	
	if($_GET['item']==NULL)echo "<script>window.location='index.php';</script>";
	else echo "<script>window.location='quanlytintuc.php';</script>";
}

if($_POST['control']=='save_new'){
/* toantran fix syntax error
	if($_POST['install'==1]) install();
*/
	if($_POST['install']=='1') install();
	else save();
	echo "<script>window.location='tintucmoi.php?install=1';</script>";
}
if($_GET['item']!=NULL){
		$id=$_GET['item'];
		$sql = "SELECT * FROM  `tintuc` WHERE  `id` =  '$id'";
		$result = mysql_query($sql, $connection);
		$item = mysql_fetch_array($result);
		$item['tieude'];
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
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">TIN TỨC</span>
	<div style="margin-top:30px; background:#fff; width:471px">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(102,102,102,0.5) 2px solid; border-left:rgba(102,102,102,0.5) 2px solid; border-right:rgba(102,102,102,0.5) 2px solid"></div>
			<div style="margin-left:0" class="control_admin style_hover" onclick="document.form_quoc.control.value='save'; document.form_quoc.submit()">SAVE</div>
			<div class="control_admin style_hover" onclick="document.form_quoc.control.value='save_close'; document.form_quoc.submit()">SAVE & CLOSE</div>
			<div class="control_admin style_hover" onclick="document.form_quoc.control.value='save_new'; document.form_quoc.submit()">SAVE & NEW</div>
			<div class="control_admin style_hover" onclick="document.location='<?php	if($_GET['item']==NULL)echo 'index.php'; else echo 'quanlytintuc.php';?>'">CANCEL</div>
			<div class="clr"></div>
		</div>
</div>
<form method="post" name="form_quoc" id="form_quoc" action="" enctype="multipart/form-data" >
	<input type="hidden" name="control" value="0" />
    <input type="hidden" name="install" value="<?php if($_GET['install']==1) echo '1'; else echo '0'; ?>" />
    <input type="hidden" name="item" value="<?php if($_GET['item']!=NULL) echo $_GET['item']; else echo '0';?>"/>
<div style="position:relative;margin:50px 0 0 20px">
		<div>
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Ảnh đại diện</div>
			<input type="text" name="show_url_slide1" onClick="GetFileClick(1)" style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<input type="file" name="Get_url_Image1" id="Get_url_Image1" value ="Select" onchange="readURL(this,1)" style="display:none">

			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Tiêu đề</div>
			<input type="text" name="tieude"  <?php if($_GET['item']!=NULL) echo 'value= "'.$item["tieude"].'"'?>  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Ảnh bài viết</div>
			<div style="float:left; background:#e34929; height:33px; width:20px; color:#fff; padding:8px 0px 0 6px;margin-left:7px;">1</div>
			<input type="text" name="show_url_slide2" onClick="GetFileClick(2)" style="float:left; background:#fff; height:33px; width:125px; border:none; color:#000;padding:0px 0 0 15px" />
			<input type="file" name="Get_url_Image2" id="Get_url_Image2" value ="Select" onchange="readURL(this,2)" style="display:none">
            
			<div style="float:left; background:#e34929; height:33px; width:20px; color:#fff; padding:8px 0px 0 6px;margin-left:5px;">2</div>
			<input type="text" name="show_url_slide3" onClick="GetFileClick(3)" style="float:left; background:#fff; height:33px; width:125px; border:none; color:#000;padding:0px 0 0 15px" />
			<input type="file" name="Get_url_Image3" id="Get_url_Image3" value ="Select" onchange="readURL(this,3)" style="display:none">
            
			<div style="float:left; background:#e34929; height:33px; width:20px; color:#fff; padding:8px 0px 0 6px;margin-left:5px;">3</div>
			<input type="text" name="show_url_slide4" onClick="GetFileClick(4)" style="float:left; background:#fff; height:33px; width:125px; border:none; color:#000;padding:0px 0 0 15px" />
			<input type="file" name="Get_url_Image4" id="Get_url_Image4" value ="Select" onchange="readURL(this,4)" style="display:none">
            
			<div style="float:left; background:#e34929; height:33px; width:20px; color:#fff; padding:8px 0px 0 6px;margin-left:5px;">4</div>
			<input type="text" name="show_url_slide5" onClick="GetFileClick(5)" style="float:left; background:#fff; height:33px; width:125px; border:none; color:#000;padding:0px 0 0 15px" />
			<input type="file" name="Get_url_Image5" id="Get_url_Image5" value ="Select" onchange="readURL(this,5)" style="display:none">
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:540px; width:120px; color:#fff; padding:8px 0 0 15px">Mô tả</div>
			<div style="float:left"><textarea id="text_content"  name="noidung" style="background:#fff; height:540px; width:602px; border:none; color:#000;padding:8px 0 0 15px; resize:none"><?php if($_GET['item']!=NULL) echo $item["noidung"]?></textarea></div>
			<div class="clr"></div>
		</div>
		<script type="text/javascript">
				
		function GetFileClick(stt_img){
						var Get_url_Image=eval ('document.form_quoc.Get_url_Image'+stt_img);
						Get_url_Image.click();
					}
					function readURL(input,stt_img) {				
						var show_url_slide=eval('form_quoc.show_url_slide'+stt_img);
								show_url_slide.value=input.files[0]['name'];
						if (input.files && input.files[0]) {
							var reader = new FileReader();
							var ss=$(input).attr('name');
							var n=ss.split('Get_url_Image'+stt_img);
							reader.onload = function (e) {
								$('#viewimg'+n[1]).css({'display':'block','margin-left':'332px','margin-top':'-88px'});
								$('#viewimg'+n[1]).attr('src', e.target.result);
							}
							reader.readAsDataURL(input.files[0]);						
						}
		}
		</script>
</div> </form>
</body>
</html>