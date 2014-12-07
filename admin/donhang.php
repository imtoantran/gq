<?php	include_once('start_php.php');

function save(){
}
if(substr($_POST['control'],0,3)=='del'){
	$del = explode('-',$_POST['control']);
	$value_id=$del[1];
	$sql = "DELETE FROM `donhang` WHERE  `mahang` = '$value_id'";
	$result = mysql_query($sql, $connection);
	/*echo "<script>window.location='donhang.php';</script>";*/
}
if($_POST['control']=='save'){

}
if($_POST['control']=='save_close'){
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

<body style="	background-color:#030302;">
<img src="../images/bg/bg_admin.jpg" width="100%" style="position:absolute" />
<div style="padding-top:40px; cursor:pointer;">
<div style="width:402px; height:109px; background:#fff; position:relative; padding:12px 0 0 100px" onclick="window.location='index.php'">
		<img src="../images/ico-banner/logo_admin.jpg" />
	</div>
</div>
<div style="margin:70px 0 0 40%; position:relative; color:#fff">
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
<div style="position:relative;margin:50px 0 0 20px; float:left" id="menu_qlsp">
    <script>
		
        function short(name){
			window.location='donhang.php?short='+name+'&ASC='+<?php 
				if($_GET['ASC']==NULL) echo '0'; else if($_GET['ASC']==0) echo '1'; else echo '0';
				
				?>+'&#menu_qlsp';
		}
    </script>
    <div style="margin-top:15px">
        <div>
            <div class="colum" style="cursor:pointer;" onclick="short('id_sp')">TÊN SẢN PHẨM</div>
            <div class="colum" >Thông tin sản phẩm</div>
            <div class="colum" style="cursor:pointer;" onclick="short('mahang')">Mã đơn hàng</div>
            <div class="colum">Thông tin khách hàng</div>
            <div class="colum" >Ghi chú</div>
            <div class="colum" style="cursor:pointer;" onclick="short('date')">Ngày đặt hàng</div>
            <div class="colum" style="background:none;"></div>
            <div class="clr"></div>
        </div>
        <?php
        //Set DATABASE
        $stt=1;
        $data=array();
        $data=NULL;
		$short='mahang';
		if($_GET['short']) $short=$_GET['short'];
		if($_GET['ASC']==1) $ASC='DESC'; else $ASC='ASC';
        $sql = "SELECT * FROM `donhang`  ORDER BY `$short` $ASC ";
        $result = mysql_query($sql, $connection);
        while ($row = mysql_fetch_array($result)){
            $data[$stt]=array(
                "mahang"    =>    $row["mahang"],
				"id_sp"    =>    $row["id_sp"],
                "id_kh"	=>	$row['id_kh'],
				"mau" => $row['mau'],
				"size" => $row['size'],
				"sl" => $row['sl'],
				"date" => $row['date'],
				"noidung" => $row['noidung'],
            );
            $stt++;
        }

        //Set Các giá trị ban đầu
        $total_item=$stt-1;
        $item_of_page=20;
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
			$table_array=explode('-',$data[$i]['id_sp']);
			$table=$table_array[0];
			$id_sp=$table_array[1];
			$sql = "SELECT * FROM `$table` WHERE `id`= '$id_sp'";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result))
			{?>
            <div <?php  if($data[$i]['mahang']!=$data[$i-1]['mahang']) echo 'style="margin-top:2px;"';?>>
            	<div class="colum2">
                	<div style="text-align:center; font-size:10px;"><?php echo $row['ten'] ?></div>
                	<img src="../images/product/<?php if($table=='sp') echo 'shoes'; else echo 'other'; ?>/<?php echo $row['id'] ?>_1.jpg" alt="" style="margin:15px 23px 0 23px" />
                </div>
            	<div class="colum2">
                  <p style="font-size:11px; height:20px">Mã Sản Phẩm: <?php echo $row['ma'] ?></p>
                  <p style="font-size:11px; height:20px">Số lượng: <?php echo $data[$i]['sl']?></p>
                  <p style="font-size:11px; height:20px; float:left">Màu sắc: <?php

					if($data[$i]['mau']){
					$n= strlen($data[$i]['mau']); $mau=substr(trim($data[$i]['mau']),0,$n-1);
					$color=explode('-',$mau);
					foreach($color as $value){
						$sql1 = "SELECT * FROM `mau` WHERE `id` = $value";
						$result1 = mysql_query($sql1, $connection);
						while ($row1 = mysql_fetch_array($result1)){
						?>
						<div class="box_color" style=" margin-top:-1px;background:rgba(<?php echo $row1['code'] ?>,1); margin-left:7px"></div>

                <?php   }
					}
				}?></p>
                <div class="clr"></div>
                    <p style="font-size:11px;">Size: <?php echo str_replace('-',' ',$data[$i]['size']);?></p>
              </div>
            	<div class="colum2">
                <p style=" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'visibility:hidden' ?>;font-size:11px; font-weight:bold;">Mã Đơn hàng: <?php echo '#'.$data[$i]['mahang']?></p><br />


				<?php   $ID4 = $row['mucloai'];
											if($table=='sp') $muc_loai='muc'; else $muc_loai='mucpk';
											$sql3 = "SELECT * FROM `$muc_loai` WHERE `id` = $ID4";
											$result3 = mysql_query($sql3, $connection);
											$row4= mysql_fetch_array($result3); echo $row4['mucloai'];
					?>
                    
                    </div>
           	  <div class="colum2" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'visibility:hidden' ?>;>
              <?php
			  	$id_kh=$data[$i]['id_kh'];
              	$sql0 = "SELECT * FROM `kh` WHERE `id`= '$id_kh'";
				$result0 = mysql_query($sql0, $connection);
				while ($row0 = mysql_fetch_array($result0)){?>
                <p style=" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'visibility:hidden' ?>;font-size:11px; height:20px">Email: <?php echo $row0['email']; ?> </p>
                <p style=" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'visibility:hidden' ?>;font-size:11px; height:20px">Số điện thoại: <?php echo $row0['sdt']; ?> </p>
                <p style=" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'visibility:hidden' ?>;font-size:11px; ">Địa chỉ: <?php echo $row0['dc']; ?> </p>
                <p style=" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'visibility:hidden' ?>;font-size:11px; height:20px; width:125px;">Thông tin khác: <?php echo $row0['tt_khac']; ?> </p>

              	<?php }?>
              </div>
            	<div class="colum2">
                <?php echo $data[$i]['noidung'];?>
                </div>
            	<div class="colum2"><?php $date_sp=explode('-',$data[$i]['date']);
				if($data[$i]['mahang']!=$data[$i-1]['mahang']) echo $date_sp[2].'/ '.$date_sp[1].'/ '.$date_sp[0]; ?></div>
				<div class="colum" style="background:none;">
				  	<div class="quanlytintuc_edit style_hover" style=" <?php  if($data[$i]['mahang']==$data[$i-1]['mahang']) echo'display:none' ?>;margin-left:2px; width:40px" onclick="document.form_KPV.control.value='del-<?php echo $data[$i]['mahang'] ?>'; document.form_KPV.submit()">DEL</div>
             	</div>
                <div class="clr"></div>
			</div>
           	<?php }?>



			<div class="clr"></div>
		<?php  }?>
    </div>
		<?php $url='donhang.php';
	  include_once('phantrangsecond.php');?>
</div>


<form action="" method="post" name="form_KPV">
	<input type="hidden" name="control" />
</form>

</body>
</html>