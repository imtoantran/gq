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
		// HOME Banner
		$i=$_POST['dv1'];
		$name_upload='left_banner_'.$i;	
		$uploadpath = '../images/product/';
		$input_img='Get_url_Image1';			
		include('upload_image_base_nothumb.php');
		// HOME Slide
		$j=$_POST['dv2']-4;
		$name_upload=$j;	
		$input_img='Get_url_Image2';
		$uploadpath = '../images/product/slide/';			
		include('upload_image_base_nothumb.php');
		// HOME Banner top
		$k=3;
		$name_upload='banner_body';	
		$uploadpath = '../images/product/slide/';			
		$input_img='Get_url_Image'.$k;
		include('upload_image_base_nothumb.php');
		
		// Hàng giày
		$l=5;
		$name_upload='slide';	
		$uploadpath = '../images/product/shoes/';	
		$input_img='Get_url_Image'.$l;		
		include('upload_image_base_nothumb.php');
		
		$m=4;
		$name_upload='banner_body';	
		$uploadpath = '../images/product/shoes/';
		$input_img='Get_url_Image'.$m;			
		include('upload_image_base_nothumb.php');

		// Phụ kiện
		$n=7;
		$name_upload='slide';	
		$uploadpath = '../images/product/other/';	
		$input_img='Get_url_Image'.$n;		
		include('upload_image_base_nothumb.php');
		
		$o=6;
		$name_upload='banner_body';	
		$uploadpath = '../images/product/other/';	
		$input_img='Get_url_Image'.$o;		
		include('upload_image_base_nothumb.php');
		
		// Tin tức
		$p=8;
		$name_upload='slide';	
		$uploadpath = '../images/product/news/';			
		$input_img='Get_url_Image'.$p;
		include('upload_image_base_nothumb.php');

		
		
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
<img src="../images/bg/bg_admin.jpg" width="100%" style="position:absolute" /><div style="padding-top:40px; cursor:pointer;">
<div style="width:402px; height:109px; background:#fff; position:relative; padding:12px 0 0 100px" onclick="window.location='index.php'">
		<img src="../images/ico-banner/logo_admin.jpg" />
	</div>
</div>
<div style="margin:70px 0 0 40%; position:relative; color:#fff">
	<div style="width:1px; border-left:1px solid #e34929; height:65px; position:absolute; margin:8px 0 0 115px"></div>
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">HÌNH ẢNH</span>
  		<div style="margin-top:20px; background:#fff; width:471px; margin-left:150px">
        <div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(102,102,102,0.5) 2px solid; border-left:rgba(102,102,102,0.5) 2px solid; border-right:rgba(102,102,102,0.5) 2px solid"></div>
			<div style="margin-left:0" class="control_admin style_hover" onclick="document.form_KPV.control.value='save'; document.form_KPV.submit()">SAVE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_close'; document.form_KPV.submit()">SAVE & CLOSE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_new'; document.form_KPV.submit()">SAVE & NEW</div>
			<div class="control_admin style_hover" onclick="document.location='index.php'">CANCEL</div>
			<div class="clr"></div>
		</div>
</div>
<script src="../js/jquery.min.js"></script>

<script> 
var data = new Array();
function change_data(number){
	if(number<=4){
		document.form_KPV.dv1.value=number;
		document.form_KPV.show_url_slide1.value='';
		document.form_KPV.Get_url_Image1.value='';
		positon_a=number;
	}
	else 
	{
		document.form_KPV.dv2.value=number;
		document.form_KPV.show_url_slide2.value='';
		document.form_KPV.Get_url_Image2.value='';
		positon_b=number;
	}
	

}
var positon_a=1;
var positon_b=1;
$(document).ready(function(){
  $("#dv1").click(function(){ $("#arrow_down").animate({marginLeft:'50px'},"fast"); change_data(1) });
  $("#dv2").click(function(){ $("#arrow_down").animate({marginLeft:'170px'},"fast"); change_data(2)});
  $("#dv3").click(function(){ $("#arrow_down").animate({marginLeft:'285px'},"fast"); change_data(3)});
  $("#dv4").click(function(){ $("#arrow_down").animate({marginLeft:'400px'},"fast"); change_data(4)});
  
  $("#dv1b").click(function(){ $("#arrow_downb").animate({marginLeft:'50px'},"fast"); change_data(5)});
  $("#dv2b").click(function(){ $("#arrow_downb").animate({marginLeft:'170px'},"fast"); change_data(6)});
  $("#dv3b").click(function(){ $("#arrow_downb").animate({marginLeft:'285px'},"fast"); change_data(7)});
  $("#dv4b").click(function(){ $("#arrow_downb").animate({marginLeft:'400px'},"fast"); change_data(8)});
});
</script>


<form method="post" name="form_KPV" id="form_KPV" action="" enctype="multipart/form-data">
        <input type="hidden" name="control" id="" />
        <input type="hidden" name="dv1" id="" value="1" />
        <input type="hidden" name="dv2" id="" value="5" />

<div style=" width:975px; position:relative; margin:50px auto 0 auto">
	<div style="height:30px;">
         <div style="float:left; height:2px; border-bottom:1px solid #fff; width:30%; margin-left:100px;"></div>
         <div style="float:right; height:2px; border-bottom:1px solid #fff; width:30%; margin-right:100px;"></div>
         <div class="clr"></div>
    	<div style=" font-size:18px; color:#fff;text-align:center;position:static; margin-top:-15px;">HOME PAGE</div>
    </div>
	<div style="position:relative; float:left">
		<img id="arrow_down" src="../images/icon/down_arrow.png" style="margin-top:25px; margin-left:50px; position:absolute; z-index:10" />
		<div style="background:#fff; width:471px;">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(154,83,91,1) 1px solid; border-left:rgba(157,149,148,1) 1px solid; border-right:rgba(157,149,148,1) 1px solid"></div>
			<div id="dv1" class="menu style_hover" style="margin-left:0px">Banner 1:</div>
			<div id="dv2" class="menu style_hover">Banner 2:</div>
			<div id="dv3" class="menu style_hover">Banner 3:</div>
			<div id="dv4" class="menu style_hover">Banner 4:</div>
			<div class="clr"></div>
		</div>	

		<div  style="position:relative;margin:15px 0 0 1px">
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
				<input type="text" name="show_url_slide1" onClick="GetFileClick(1)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
				<input type="file" name="Get_url_Image1" id="Get_url_Image1" value ="Select" onchange="readURL(this,1)" style="display:none">
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<div style="margin-left:30px; position:relative; float:left">
		<img id="arrow_downb" src="../images/icon/down_arrow.png" style="margin-top:25px; margin-left:50px; position:absolute; z-index:10" />
		<div style="background:#fff; width:471px;">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(154,83,91,1) 1px solid; border-left:rgba(157,149,148,1) 1px solid; border-right:rgba(157,149,148,1) 1px solid"></div>
			
			<div id="dv1b" class="menu style_hover" style="margin-left:0px">Slide 1:</div>
			<div id="dv2b" class="menu style_hover">Slide 2:</div>
			<div id="dv3b" class="menu style_hover">Slide 3:</div>
			<div id="dv4b" class="menu style_hover">Slide 4:</div>
			<div class="clr"></div>
		</div>			
		<div style="position:relative;margin:15px 0 0 1px">
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
				<input type="text" name="show_url_slide2" onClick="GetFileClick(2)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
				<input type="file" name="Get_url_Image2" id="Get_url_Image2" value ="Select" onchange="readURL(this,2)" style="display:none">
				<div class="clr"></div>
			</div>
		</div>
        <div style="position:relative;margin:15px 0 0 1px">
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Banner body</div>
				<div class="clr"></div>
			</div>
		</div>
		<div style="position:relative;margin:5px 0 0 1px">
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
				<input type="text" name="show_url_slide3" onClick="GetFileClick(3)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
				<input type="file" name="Get_url_Image3" id="Get_url_Image3" value ="Select" onchange="readURL(this,3)" style="display:none">
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<div class="clr"></div>	
</div>
<div style=" width:975px; position:relative; margin:70px auto 0 auto">
	<div style="height:30px;">
         <div style="float:left; height:2px; border-bottom:1px solid #fff; width:30%; margin-left:100px;"></div>
         <div style="float:right; height:2px; border-bottom:1px solid #fff; width:30%; margin-right:100px;"></div>
         <div class="clr"></div>
    	<div style=" font-size:18px; color:#fff;text-align:center;position:static; margin-top:-15px;">HÀNG GIÀY</div>
    </div>
	<div style="position:relative; float:left">
		<div  style="position:relative;margin:0px 0 0 1px">
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Banner body</div>
				<div class="clr" style="height:5px"></div>
			</div>
            <div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
				<input type="text" name="show_url_slide4" onClick="GetFileClick(4)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
				<input type="file" name="Get_url_Image4" id="Get_url_Image4" value ="Select" onchange="readURL(this,4)" style="display:none">
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<div style="margin-left:30px; position:relative; float:left">			
		<div style="position:relative;margin:0px 0 0 1px">
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Banner top</div>
				<div class="clr" style="height:5px"></div>
			</div>
			<div>
				<div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
				<input type="text" name="show_url_slide5" onClick="GetFileClick(5)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
				<input type="file" name="Get_url_Image5" id="Get_url_Image5" value ="Select" onchange="readURL(this,5)" style="display:none">
				<div class="clr"></div>
			</div>
		</div>
	</div>
	<div class="clr"></div>	
</div>
<div style=" width:975px; position:relative; margin:70px auto 0 auto">
        <div style="height:30px;">
            <div style="float:left; height:2px; border-bottom:1px solid #fff; width:30%; margin-left:100px;"></div>
            <div style="float:right; height:2px; border-bottom:1px solid #fff; width:30%; margin-right:100px;"></div>
            <div class="clr"></div>
            <div style=" font-size:18px; color:#fff;text-align:center;position:static; margin-top:-15px;">PHỤ KIỆN</div>
        </div>
        <div style="position:relative; float:left">
            <div  style="position:relative;margin:0px 0 0 1px">
                <div>
                    <div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Banner body</div>
                    <div class="clr" style="height:5px"></div>
                </div>
                <div>
                    <div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
                    <input type="text" name="show_url_slide6" onClick="GetFileClick(6)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
                    <input type="file" name="Get_url_Image6" id="Get_url_Image6" value ="Select" onchange="readURL(this,6)" style="display:none">
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <div style="margin-left:30px; position:relative; float:left">
            <div style="position:relative;margin:0px 0 0 1px">
                <div>
                    <div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Banner top</div>
                    <div class="clr" style="height:5px"></div>
                </div>
                <div>
                    <div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
                    <input type="text" name="show_url_slide7" onClick="GetFileClick(7)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
                    <input type="file" name="Get_url_Image7" id="Get_url_Image7" value ="Select" onchange="readURL(this,7)" style="display:none">
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
<div style=" width:975px; position:relative; margin:70px auto 0 auto">
        <div style="height:30px;">
            <div style="float:left; height:2px; border-bottom:1px solid #fff; width:30%; margin-left:100px;"></div>
            <div style="float:right; height:2px; border-bottom:1px solid #fff; width:30%; margin-right:100px;"></div>
            <div class="clr"></div>
            <div style=" font-size:18px; color:#fff;text-align:center;position:static; margin-top:-15px;">TIN TỨC</div>
        </div>
        <div style="margin-left:30px; position:relative; float:left">
            <div style="position:relative;margin:0px 0 0 472px">
                <div>
                    <div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Banner top</div>
                    <div class="clr" style="height:5px"></div>
                </div>
                <div>
                    <div style="float:left; background:#e34929; height:33px; width:114px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
                    <input type="text" name="show_url_slide8" onClick="GetFileClick(8)" style="float:left; background:#fff; height:33px; width:355px; border:none; color:#000;padding:0px 0 0 15px" />
                    <input type="file" name="Get_url_Image8" id="Get_url_Image8" value ="Select" onchange="readURL(this,8)" style="display:none">
                    <div class="clr"></div>
                </div>
            </div>
        </div>
        <div class="clr"></div>
    </div>
</form>

<script>
		document.form_KPV.tieude.value=data["tieude1"];
		document.form_KPV.noidung.value=data["noidung1"];
		document.form_KPV.tieude2.value=data["tieude5"];
		document.form_KPV.noidung2.value=data["noidung5"];

</script>
<script>
		function GetFileClick(stt_img){
						var Get_url_Image=eval ('document.form_KPV.Get_url_Image'+stt_img);
						Get_url_Image.click();
					}
					function readURL(input,stt_img) {				
						var show_url_slide=eval('document.form_KPV.show_url_slide'+stt_img);
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
</body>
</html>