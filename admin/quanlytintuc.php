<?php	include_once('start_php.php');

function save(){
}
if(substr($_POST['control'],0,3)=='del'){
	$del = explode('-',$_POST['control']);
	$value_id=$del[1];
	$sql = "DELETE FROM `tintuc` WHERE  `id` = '$value_id'";
	$result = mysql_query($sql, $connection);
	unlink("../images/news/".$value_id."-1.jpg");
	unlink("../images/news/".$value_id."-2.jpg");
	unlink("../images/news/".$value_id."-3.jpg");
	unlink("../images/news/".$value_id."-4.jpg");
	unlink("../images/news/".$value_id.".jpg");
	
	$id_old=$value_id;
	$sql = "SELECT * FROM  `tintuc` WHERE `id` > '$id_old' ORDER BY  `id` ASC";
	$result = mysql_query($sql, $connection);
	while ($row = mysql_fetch_array($result)){
		$id_new=$row['id'];
		$query = "update `tintuc` 
							set id = '%s'
							where id = '%s'
						 ";
		$query = sprintf($query
							,mysql_real_escape_string($id_old)
							,mysql_real_escape_string($id_new)
						);
		mysql_query($query);
		rename("../images/news/".$id_new.".jpg", "../images/news/".$id_old.".jpg");
		rename("../images/news/".$id_new."-1.jpg", "../images/news/".$id_old."-1.jpg");
		rename("../images/news/".$id_new."-2.jpg", "../images/news/".$id_old."-2.jpg");
		rename("../images/news/".$id_new."-3.jpg", "../images/news/".$id_old."-3.jpg");
		rename("../images/news/".$id_new."-4.jpg", "../images/news/".$id_old."-4.jpg");

		$id_old++;
	}
}
if($_POST['control']=='save'){

}
if($_POST['control']=='save_close'){
	echo "<script>window.location='index.php';</script>";
}
if($_POST['control']=='save_new'){
	echo "<script>window.location='tintucmoi.php?install=1';</script>";
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
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">QUẢN LÝ TIN TỨC</span>
	<div style="margin-top:30px; background:#fff; width:471px">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(102,102,102,0.5) 2px solid; border-left:rgba(102,102,102,0.5) 2px solid; border-right:rgba(102,102,102,0.5) 2px solid"></div>
			<div style="margin-left:0" class="control_admin style_hover" onclick="document.form_KPV.control.value='save'; document.form_KPV.submit()">SAVE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_close'; document.form_KPV.submit()">SAVE & CLOSE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_new'; document.form_KPV.submit()">SAVE & NEW</div>
			<div class="control_admin style_hover" onclick="document.location='index.php'">CANCEL</div>
			<div class="clr"></div>
		</div>
</div>
<div style="position:relative;margin:50px 0 0 20px; float:left; width:700px">
<?php
			//Set DATABASE
			$stt=1;
			$data=array();
			$data=NULL;
			$sql = "SELECT * FROM `tintuc` ORDER BY `tintuc`.`id` ASC ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
				$data[$stt]=array(  "id"	   =>    $row["id"],
									"tieude"	=>	$row['tieude'],
								);
				$stt++;
			}			

			//Set Các giá trị ban đầu
			$total_item=$stt-1;
			$item_of_page=10;
			if($total_item % $item_of_page == 0) { 
					if($total_item == 0) $total_page = 0; 
					else $total_page=$total_item / $item_of_page;
				}
				else $total_page=((($total_item-($total_item%$item_of_page))/$item_of_page)+1);
				
			$page_of_group=$total_page;
			$temp_page_of_group=0;
			
            include_once('phantrangfist.php');
						
			for($i=$start_item_view; $i<$end_item_view; $i++)
			{?>
			
		<div style="margin-top:10px">
			<div style="float:left; background:#e34929; height:33px; width:45px; color:#fff; padding:8px 0 0 0px; text-align:center; text-align:center"><?php echo $i ?></div>
			<p style="float:left; background:#fff; height:33px; width:400px; border:none; color:#000;padding:10px 0 0 15px"> <?php echo $data[$i]['tieude'] ?></p>
			<div class="quanlytintuc_edit style_hover" style="margin-left:5px; padding:0;width:1px" onclick="window.location='tintucmoi.php?item=<?php echo $i ?>'"></div>
            <div class="quanlytintuc_edit style_hover" style="margin-left:4px; background:#fff; color:#000" onclick="window.location='tintucmoi.php?item=<?php echo $i ?>'">EDIT</div>
			<div class="quanlytintuc_edit style_hover" style="margin-left:2px; width:40px" onclick="document.form_KPV.control.value='del-<?php echo $i ?>'; document.form_KPV.submit()">DEL</div>
			<div class="clr"></div>
		</div>
		<?php }?>
</div>
<?php $url='quanlytintuc.php';
	  include_once('phantrangsecondtintuc.php');?>
<form action="" method="post" name="form_KPV">
	<input type="hidden" name="control" />
</form>

</body>
</html>