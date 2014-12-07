<?php	include_once('start_php.php');

function save(){
}
if(substr($_POST['control'],0,3)=='del'){
	$del = explode('-',$_POST['control']);
	$value_id=$del[1];
	$sql = "DELETE FROM `pk` WHERE  `id` = '$value_id'";
	$result = mysql_query($sql, $connection);
        /**
         * imtoantran 
         * delete image
         */
        for ($i=1;$i<6;$i++){
            $filename = "../images/product/other/".$value_id."_".$i.".jpg";
            if(file_exists($filename)){
                unlink($filename);
            }
            $filename = "../images/product/other/thumb_".$value_id."_".$i.".jpg";
            if(file_exists($filename)){
                unlink($filename);
            }
        }	

	$id_new=$value_id;
	$sql = "SELECT max(id) FROM  `pk`";
	$result = mysql_query($sql, $connection);
        $id_old = mysql_fetch_row($result)[0];
	if($id_old > $id_new){
		$query = "update `pk` set id = '%s' where id = '%s'";
		$query = sprintf($query,
                        mysql_real_escape_string($id_new),
                        mysql_real_escape_string($id_old)
                        );
		mysql_query($query);
        /**
         * imtoantran 
         * delete image
         */
        for ($i=1;$i<6;$i++){
            $filename = "../images/product/other/".$id_old."_".$i.".jpg";
            $new_name = "../images/product/other/".$id_new."_".$i.".jpg";
            if(file_exists($filename)){
                rename($filename,$new_name);
            }
            $filename = "../images/product/other/thumb_".$id_old."_".$i.".jpg";
            $new_name = "../images/product/other/thumb_".$id_new."_".$i.".jpg";
            if(file_exists($filename)){
                rename($filename,$new_name);
            }
        }
	$id_old++;
	}
	"<script>window.location='quanlypk.php';</script>";
}
if($_POST['control']=='save'){

}
if($_POST['control']=='save_close'){
	echo "<script>window.location='index.php';</script>";
}
if($_POST['control']=='save_new'){
	echo "<script>window.location='pkmoi.php?install=1';</script>";
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
<div id="menu_qlsp" style="margin:70px 0 0 40%; position:relative; color:#fff">
	<div style="width:1px; border-left:1px solid #e34929; height:65px; position:absolute; margin:8px 0 0 115px"></div>
	<span style="font-size:80px; margin-left:30px">‘’1</span><span style="font-size:30px; margin-left:15px">QUẢN LÝ SẢN PHẨM</span>
	<div style="margin-top:30px; background:#fff; width:471px">
			<div style="position:absolute; width:471px; height:33px; background:none; border-bottom:rgba(102,102,102,0.5) 2px solid; border-left:rgba(102,102,102,0.5) 2px solid; border-right:rgba(102,102,102,0.5) 2px solid"></div>
			<div style="margin-left:0" class="control_admin style_hover" onclick="document.form_KPV.control.value='save'; document.form_KPV.submit()">SAVE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_close'; document.form_KPV.submit()">SAVE & CLOSE</div>
			<div class="control_admin style_hover" onclick="document.form_KPV.control.value='save_new'; document.form_KPV.submit()">SAVE & NEW</div>
			<div class="control_admin style_hover" onclick="document.location='index.php'">CANCEL</div>
			<div class="clr"></div>
		</div>
</div>
<div style="position:relative;margin:50px 0 0 20px; float:left">
	<div style="margin-top:-20px">
    		<div class="style_hover" onclick="window.location='quanlysp.php'" style="background:#e34929; height:33px; width:110px; color:#fff; padding:8px 0 0 20px; float:left">GIÀY</div>
			<div class="style_hover" onclick="window.location='quanlypk.php'" style="background:rgba(144,255,0,0.8); height:33px; width:110px; color:#fff; padding:8px 0 0 20px; margin-left:10px;float:left">PHỤ KIỆN</div>
            <div class="clr"></div>
    </div>
    <script>
		
        function short(name){
			window.location='quanlypk.php?short='+name+'&ASC=<?php 
				if($_GET['ASC']==NULL) echo '0'; else if($_GET['ASC']==0) echo '1'; else echo '0';
				if($_GET['mucloai_choice']) echo '&mucloai_choice='.$_GET['mucloai_choice'];	
				
				?>&#menu_qlsp';
		}
    </script>
    <div style="margin-top:15px">
        <div>
            <div class="colum" style="cursor:pointer;" onclick="short('ten')">TÊN SẢN PHẨM</div>
            <div class="colum" style="cursor:pointer;" onclick="short('ma')" >MÃ SẢN PHẨM</div>
            <div class="colum" style="cursor:pointer; position:relative; z-index:9" id="choice_muc" > 
                <?php if($_GET['mucloai']) echo $_GET['mucloai']; else echo 'MỤC LOẠI'?>
			</div>
            <div id="down" class="colum" style="height:120px;margin:32px 0 0 300px; padding-top:5px; position:relative; z-index:10">
                	<?php
                	$sql8 = "SELECT * FROM `mucpk` ORDER BY `id` ASC";
					$result8 = mysql_query($sql8, $connection);
					while($row8= mysql_fetch_array($result8)){ ?>
                    <li style="cursor:pointer; padding-left:5px; font-size:11px" 
	                onclick="window.location='quanlypk.php?mucloai_choice=<?php echo $row8['id'] ?>&#menu_qlsp'" onmousemove="style.color='#87a310'" onmouseout="style.color='#fff'">    
                    <?php echo $row8['mucloai']?>
                	</li>
                    <?php }?>
            </div>
				<script type="text/javascript">
                    at_attach("choice_muc", "down", "click", "y", "");
                </script>
            <div class="colum" style="cursor:pointer;" onclick="short('dongia')" >ĐƠN GIÁ</div>
            <div class="colum">MÀU SẮC</div>
            <div class="colum" style="background:none;"></div>
            <div class="clr"></div>
        </div>
        <?php
        //Set DATABASE
        $stt=1;
        $data=array();
        $data=NULL;
		$short='date';
		if($_GET['short']) $short=$_GET['short']; else $short='ten';
		if($_GET['ASC']==1) $ASC='DESC'; else $ASC='ASC';
		if($_GET['mucloai_choice']) {$mucloai_choice="WHERE `mucloai`='".$_GET['mucloai_choice']."'";}
        $sql = "SELECT * FROM `pk` ".$mucloai_choice." ORDER BY `$short` $ASC ";
        $result = mysql_query($sql, $connection);
        while ($row = mysql_fetch_array($result)){
            $data[$stt]=array(
                "id"    =>    $row["id"],
                "ten"	=>	  $row['ten'],
            );
            $stt++;
        }

        //Set Các giá trị ban đầu
        $total_item=$stt-1;
        $item_of_page=7;
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


            <?php
            $id_sp=$data[$i]['id'];
			$sql = "SELECT * FROM `pk` WHERE `id`= '$id_sp'";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result))
			{?>
            <div style="margin-top:2px;">
            	<div class="colum2">
                	<div style="text-align:center; font-size:10px;"><?php echo $row['ten'] ?></div>
                	<img src="../images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" style="margin:15px 23px 0 23px" />
                </div>
            	<div class="colum2"><?php echo $row['ma'] ?></div>
            	<div class="colum2"><?php   $ID4 = $row['mucloai'];
											$sql3 = "SELECT * FROM `mucpk` WHERE `id` = $ID4";
											$result3 = mysql_query($sql3, $connection);
											$row4= mysql_fetch_array($result3); echo $row4['mucloai'];
					?></div>
            	<div class="colum2"><?php echo $row['dongia'] ?></div>
            	<div class="colum2"><?php

				if($row['mau']){
					$color=explode('-',$row['mau']);
					foreach($color as $value){
						$sql1 = "SELECT * FROM `mau` WHERE `id` = $value";
						$result1 = mysql_query($sql1, $connection);
						while ($row1 = mysql_fetch_array($result1)){
						?>
						<div class="box_color" style="background:rgba(<?php echo $row1['code'] ?>,1); margin-left:7px"></div>

                <?php   }
					}
				}?>
                </div>
				<div class="colum" style="background:none;">
                    <div class="quanlytintuc_edit style_hover" style="margin-left:4px; background:#fff; color:#000" onclick="window.location='pkmoi.php?item=<?php echo $row['id'] ?>'">EDIT</div>
                    <div class="quanlytintuc_edit style_hover" style="margin-left:2px; width:40px" onclick="document.form_KPV.control.value='del-<?php echo $row['id'] ?>'; document.form_KPV.submit()">DEL</div>
             	</div>
                <div class="clr"></div>
			</div>
           	<?php }?>



			<div class="clr"></div>
		<?php  }?>
    </div>
		<?php $url='quanlypk.php';
	  include_once('phantrangsecond.php');?>
</div>


<form action="" method="post" name="form_KPV">
	<input type="hidden" name="control" />
</form>

</body>
</html>