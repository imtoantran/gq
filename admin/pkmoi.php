<?php	session_start();
		if(empty($_SESSION['user_id']) OR empty($_SESSION['user_password']) ) {
   		header('Location: login.php' ); 
		}
		
		include_once('../config/conn.php');
		include('SimpleImage.php');
		$sql1 = "SELECT * FROM `mau` ORDER BY `id` ASC";
		$code_mau=array();
		$result1 = mysql_query($sql1, $connection);
		while ($row1 = mysql_fetch_array($result1)){
			$code_mau[$row1['id']]=$row1['code'];
		}
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
function install($code_mau){
		$mau='';
		$data_onoff=explode('-',$_POST['data_onoff']);
		$mau=implode('-',$data_onoff);
		$mau=trim($mau);		
		$n= strlen($mau); $mau=substr($mau,0,$n-1);
		
		$size='';
		$code_size=array("35","36","37","38","39","40","41","42");
		$data_onoff2=explode('-',$_POST['data_onoff2']);
		foreach($data_onoff2 as $value) $size.=$code_size[$value-16].', ';
		$size=trim($size);
		$n=strlen($size); $size=substr($size,0,$n-3);
				
		//UPLOAD IMAGE

		$row = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM `pk`"));
		$max_id=$row['MAX(id)']+1;
		$n=0;														// Số lương ảnh upload
		for($i=1;$i<=5;$i++){
			$input_img='Get_url_Image'.$i;
			$name_upload=$max_id.'_'.$i;	
			$uploadpath = '../images/product/other/';
			
			include('upload_image_base.php');
		}
		//UPLOAD DATABASE		
		$dongia=str_replace('.','',$_POST['dongia']);		// Xóa dấu . và , trong giá tiền để phục vụ short trong database
		$dongia=str_replace(',','',$dongia);

		$s = "INSERT INTO `pk` (`id` ,`ten` ,`ma` ,`mucloai` ,`dongia` ,`mau` ,`size` ,`mota` ,`cachdung` ,`giaonhan` ,`hinhanh` ,`date`)";		
		$s.= "VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', CURDATE( ));";
		$s = sprintf
			($s			
			,mysql_real_escape_string($max_id)
			,mysql_real_escape_string($_POST['ten'])
			,mysql_real_escape_string($_POST['ma'])
			,mysql_real_escape_string($_POST['mucloai'])
			,mysql_real_escape_string($dongia)
			,mysql_real_escape_string($mau)
			,mysql_real_escape_string($size)
			,mysql_real_escape_string($_POST['mota'])
			,mysql_real_escape_string($_POST['cachdung'])
			,mysql_real_escape_string($_POST['giaonhan'])
			,mysql_real_escape_string($n)			

			);
		if(mysql_query($s)){
			if($_POST['control']=='save_new') echo "<script>window.location='pkmoi.php?install=1';</script>";		
			else if($_POST['install']=='1') echo "<script>window.location='pkmoi.php?item=".$max_id."';</script>";}
		}
function save($code_mau){
		$mau='';
		$data_onoff=explode('-',$_POST['data_onoff']);
		$mau=implode('-',$data_onoff);
		$mau=trim($mau);		
		$n= strlen($mau); $mau=substr($mau,0,$n-1);
		$dongia=str_replace('.','',$_POST['dongia']);		// Xóa dấu . và , trong giá tiền để phục vụ short trong database
		$dongia=str_replace(',','',$dongia);
		
		$size='';
		$code_size=array("35","36","37","38","39","40","41","42");
		$data_onoff2=explode('-',$_POST['data_onoff2']);
		foreach($data_onoff2 as $value) $size.=$code_size[$value-16].', ';
		$size=trim($size);
		$n=strlen($size); $size=substr($size,0,$n-3);
		$query = "UPDATE `pk` SET `ten` = '%s',`ma` = '%s',`mucloai` = '%s',`dongia` = '%s',`mau` = '%s',`size` = '%s',`mota` = '%s',`cachdung` = '%s',`giaonhan` = '%s',`hinhanh` = '%s' WHERE `pk`.`id` ='%s'";
		$query = sprintf($query
			,mysql_real_escape_string($_POST['ten'])
			,mysql_real_escape_string($_POST['ma'])
			,mysql_real_escape_string($_POST['mucloai'])
			,mysql_real_escape_string($dongia)
			,mysql_real_escape_string($mau)
			,mysql_real_escape_string("")
			,mysql_real_escape_string($_POST['mota'])
			,mysql_real_escape_string($_POST['cachdung'])
			,mysql_real_escape_string($_POST['giaonhan'])
			,mysql_real_escape_string(5)
			,mysql_real_escape_string($_POST['item'])			
		);
		mysql_query($query);

		for($i=1;$i<=5;$i++){
			$input_img='Get_url_Image'.$i;
			$name_upload=$_POST['item'].'_'.$i;	
			$uploadpath = '../images/product/other/';
			
			include('upload_image_base.php');
		}
		if($_POST['control']=='save_new') echo "<script>window.location='pkmoi.php?install=1';</script>";
		else if($_POST['control']=='save_close') echo "<script>window.location='quanlypk.php';</script>";
		else echo "<script>window.location='pkmoi.php?item=".$_POST['item']."';</script>";


}

if($_POST['control']=='save'&&$_POST['ten']!=NULL){
	if($_POST['install']=='1') install($code_mau); else save($code_mau);
}

else if($_POST['control']=='save_close'&&$_POST['ten']!=NULL){
	if($_POST['install']=='1') install($code_mau); else save($code_mau);
}

else if($_POST['control']=='save_new'&&$_POST['ten']!=NULL){
	if($_POST['install']=='1') install($code_mau); else save($code_mau);
}
if($_GET['item']!=NULL){
		$id=$_GET['item'];
		$sql = "SELECT * FROM  `pk` WHERE  `id` =  '$id'";
		$result = mysql_query($sql, $connection);
		$item = mysql_fetch_array($result);
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
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">CẬP NHẬT SẢN PHẨM</span>
	<div style="margin-top:30px; background:#fff; width:471px">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(102,102,102,0.5) 2px solid; border-left:rgba(102,102,102,0.5) 2px solid; border-right:rgba(102,102,102,0.5) 2px solid"></div>
			<div style="margin-left:0" class="control_admin style_hover" onclick="save_data();document.form_quoc.control.value='save'; document.form_quoc.submit()">SAVE</div>
			<div class="control_admin style_hover" onclick="save_data();document.form_quoc.control.value='save_close'; document.form_quoc.submit()">SAVE & CLOSE</div>
			<div class="control_admin style_hover" onclick="save_data();document.form_quoc.control.value='save_new'; document.form_quoc.submit()">SAVE & NEW</div>
			<div class="control_admin style_hover" onclick="document.location='<?php	if($_GET['item']==NULL)echo 'index.php'; else echo 'quanlypk.php';?>'">CANCEL</div>
			<div class="clr"></div>
		</div>
</div>
<form method="post" name="form_quoc" id="form_quoc" action="" enctype="multipart/form-data">
	<input type="hidden" name="control" value="0" />
    <input type="hidden" name="install" value="<?php if($_GET['install']==1) echo '1'; else echo '0'; ?>" />
    <input type="hidden" name="item" value="<?php if($_GET['item']!=NULL) echo $_GET['item']; else echo '0';?>"/>
    <input type="hidden" name="hinhanh" />
    <input type="hidden" name="mucloai" value="<?php if($_GET['item']==NULL) echo '7'; else echo $item['mucloai'] ?>" />
    <input type="hidden" name="data_onoff" />
    <input type="hidden" name="data_onoff2" />
	<?php for($i=1;$i<=5;$i++){?>
	<input type="file" name="Get_url_Image<?php echo $i ?>" id="Get_url_Image<?php echo $i ?>" value ="Select" onchange="readURL(this,<?php echo $i ?>)" style="display:none">
	<?php }?>


<div style="position:relative;margin:20px 0 0 20px; float:left">
		<div>
			<div class="style_hover" onclick="window.location='spmoi.php'" style="background:#e34929; height:33px; width:110px; color:#fff; padding:8px 0 0 20px; float:left">GIÀY</div>
			<div class="style_hover" onclick="window.location='pkmoi.php'" style="background:rgba(144,255,0,0.8); height:33px; width:110px; color:#fff; padding:8px 0 0 20px; margin-left:10px;float:left">PHỤ KIỆN</div>
            <div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Tên sản phẩm</div>
			<input name="ten" type="text"  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" value="<?php if($_GET['item']!=NULL) echo $item['ten']?>"  <?php if($_GET['item']!=NULL) echo 'value= "'.$item["tieude"].'"'?> />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Mã sản phẩm</div>
			<input name="ma" type="text"  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" value="<?php if($_GET['item']!=NULL) echo $item['ma']?>"  <?php if($_GET['item']!=NULL) echo 'value= "'.$item["tieude"].'"'?> />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
        	<div style="position:absolute; height:58px; width:280px; background:rgba(146,146,146,0.7);margin:-12px 0 0 450px;padding:2px 0 0 10px;">
            	<?php 
					$mucloai=array();
					$sql4 = "SELECT * FROM `mucpk` ORDER BY `id` ASC LIMIT 0,6 ";
					$result4 = mysql_query($sql4, $connection);
					while ($row4 = mysql_fetch_array($result4)){$idmuc=$row4['id']; $mucloai[$idmuc]['mucloai']=$row4['mucloai'];
				?>
                <div style="float:left; width:135px; margin-top:2px; font-size:10px; color:#fff; cursor:pointer;" onclick="form_quoc.mucloai_show.value='<?php echo $row4['mucloai'];?>'; form_quoc.mucloai.value='<?php echo $row4['id']?>' "><?php echo $row4['mucloai']?></div>
               	<?php }?>
            </div>
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Mục loại</div>
			<input name="mucloai_show" type="text" disabled="disabled"  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" value="<?php if($_GET['item']!=NULL) { if($item['mucloai']<7) 
			{$idmuc=$item['mucloai']; echo $mucloai[$idmuc]['mucloai'];} else echo 'TÚI XÁCH';} else echo 'TÚI XÁCH'?>"  />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Đơn giá</div>
			<input name="dongia" type="text"  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" value="<?php if($_GET['item']!=NULL) echo str_replace(',','.',number_format($item['dongia'],0)) ?>"   />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Chọn màu</div>
            <div style="width:350px; position:absolute; margin:-4px 0 0 120px;">
					<?php
            		foreach($code_mau as $id_mau => $code){	
					?>
                    <div class="box_color" style="background:rgba(<?php echo $code ?>,1); margin-left:7px"></div>

                <?php }?>
                <?php
					foreach($code_mau as $id_mau => $code){	
	
					?>
                    <div onclick="set_on_off('onoff_<?php echo $id_mau?>')" class="box_color" style="background:rgba(255,255,255,1); margin-left:7px; margin-top:1px;"><div  id="<?php echo 'onoff_'.$id_mau?>" style="display:none;margin:5px; background:#929292; height:5px; width:5px;"></div></div>

                <?php }?>	
            </div>
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
                        <script>
					 
							function set_on_off(name_on_off){ 
								var number=name_on_off.substring(6,11);
								var text=name_on_off.substring(0,6);
								var dk=eval(text+'['+number+']');
								if(dk==0){
									onoff_[number]=1;
									document.getElementById(name_on_off).style.display='block';
		
								}
								else if(dk==1){
									onoff_[number]=0;
									document.getElementById(name_on_off).style.display='none';									
	
								}
							}
							function save_data(){								
									var data='';
									var data2='';
									for(var i=1;i<=15;i++){
										if(onoff_[i]!=0) data+=i+'-';
									}
									for(var i=16;i<=23;i++){
										if(onoff_[i]!=0) data2+=i+'-';
									}
									
									document.form_quoc.data_onoff.value=data;
							}
							var onoff_ = new Array();
							
							for(var i=1;i<24;i++) onoff_[i]=1;		//Set ON tất cả các onoff
							<?php 
							if($_GET['item'] && $item['mau']){
								$mamau=array();
								$mamau=explode('-',$item['mau']);
								foreach($mamau as $array_codemau){?>onoff_[<?php echo $array_codemau; ?>]=0;<?php }   // Set off các mục cần chọn.
							}
							
								?>
							
							for(var i=1;i<24;i++) set_on_off("onoff_"+i);// Đảo ngược các onoff
							
						</script>
			<div class="clr"></div>		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Mô tả</div>
			<textarea name="mota"  style=" resize:none;float:left; background:#fff; width:360px; border:none; color:#000;padding:10px 0 0 15px; margin-top:0;" id="" cols="30" rows="10"><?php if($_GET['item']!=NULL) echo $item['mota']?></textarea>
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Cách dùng</div>
			<input name="cachdung" type="text"  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" value="<?php if($_GET['item']!=NULL)echo $item['cachdung']?>"   />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Giao nhận</div>
			<input name="giaonhan" type="text"  style="float:left; background:#fff; height:33px; width:360px; border:none; color:#000;padding:0px 0 0 15px" value="<?php if($_GET['item']!=NULL)echo $item['giaonhan']?>"  />
			<div class="clr"></div>
		</div>
</div>
	<div style="position:relative;margin:244px 0 0 40px; float:left">
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
			<input type="text" name="show_url_slide1" onClick="GetFileClick(1)"  style="float:left; background:#fff; height:33px; width:260px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
			<input type="text" name="show_url_slide2" onClick="GetFileClick(2)"  style="float:left; background:#fff; height:33px; width:260px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
			<input type="text" name="show_url_slide3" onClick="GetFileClick(3)"  style="float:left; background:#fff; height:33px; width:260px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
			<input type="text" name="show_url_slide4" onClick="GetFileClick(4)"   style="float:left; background:#fff; height:33px; width:260px; border:none; color:#000;padding:0px 0 0 15px" />
			<div class="clr"></div>
		</div>
		<div style="margin-top:15px">
			<div style="float:left; background:#e34929; height:33px; width:120px; color:#fff; padding:8px 0 0 20px">Hình ảnh</div>
			<input type="text" name="show_url_slide5" onClick="GetFileClick(5)"  style="float:left; background:#fff; height:33px; width:260px; border:none; color:#000;padding:0px 0 0 15px" />
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