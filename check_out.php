<?php 
	if($_GET['del']){
		$temp_del=explode('-',$_GET['del']);
		$table_del=$temp_del[0];
		$id_del_cookie=$temp_del[1];
		setcookie("sl_sp_mua",$_COOKIE['sl_sp_mua']-1);
		
		for($p=$id_del_cookie;$p<=$_COOKIE['sl_sp_mua'];$p++){
			$t=$p+1;
			setcookie("id_sanpham".$p,$_COOKIE['id_sanpham'.$t]);
			setcookie("id_mau_sp".$p,$_COOKIE['id_mau_sp'.$t]);
			setcookie("id_size_sp".$p,$_COOKIE['id_size_sp'.$t]);
		}
		unset($_COOKIE['id_sanpham'.$t]);
		unset($_COOKIE['id_mau_sp'.$t]);
		unset($_COOKIE['id_size_sp'.$t]);
		echo "<script>window.location='check_out.php';</script>";
	
	}

?>
<?php include_once('header.php');?>



<form action="check_out_finish.php" method="post" name="check_out">
<section style="width:922px; margin:8px auto 8px auto;background:#fff;padding:30px 18px 20px 20px;">
    <div>
    	<p style="float:left; padding-top:5px; font-weight:bold;font-size:14px;;">GIỎ HÀNG CỦA BẠN</p>
        <div style="float:right; cursor:pointer" onclick="document.check_out.submit()">
        	<div class="title_check_out" style="width:156px;">TIẾN HÀNH THANH TOÁN</div>
            <div style="background:url(images/bg/1.png) no-repeat;width:20px;height:25px; float:left;"></div>
            <div style="background:url(images/bg/2.png) repeat-x;height:25px; width:136px; float:left;"></div>
            <div style="background:url(images/bg/3.png) no-repeat;width:20px;height:25px; float:left;"></div>
            <div class="clr"></div>
        </div>
        <p style="font-size:11px; float:right; padding:5px 5px 0 5px;">Hoặc</p>
        <div style="float:right; cursor:pointer" onclick="window.location='index.php'">
        	<div class="title_check_out" style="width:156px;" >TIẾP TỤC MUA HÀNG</div>
            <div style="background:url(images/bg/1.png) no-repeat;width:20px;height:25px; float:left;"></div>
            <div style="background:url(images/bg/2.png) repeat-x;height:25px; width:136px; float:left;"></div>
            <div style="background:url(images/bg/3.png) no-repeat;width:20px;height:25px; float:left;"></div>
            <div class="clr"></div>
        </div>
        <div class="clr"></div>
		<div style="margin-top:20px;">
            <div>
                <div class="cot_1">SẢN PHẨM</div>
                <div class="cot_2">CHI TIẾT</div>
                <div class="cot_3">SỐ LƯỢNG</div>
                <div class="cot_4">THÀNH TIỀN</div>
                <div class="cot_5"></div>
                <div class="clr" style="height:1px; background:#000;"></div>
            </div>
            <?php
            $sl_san_pham_da_mua=$_COOKIE['sl_sp_mua'];
			for($i=1;$i<=$sl_san_pham_da_mua;$i++){
				
				$id_sp_tmp= $_COOKIE['id_sanpham'.$i];		// Tách dữ liệu sản phẩm, phụ kiện với ID sản phẩm
				$id_sp_array=explode('-',$id_sp_tmp);
				
				$table=$id_sp_array[0];		// Kiểm tra sản phẩm hay phụ kiện
				$id_database=$id_sp_array[1];
				

				$sql1 = "SELECT * FROM `$table` WHERE `id` = '$id_database'";
				$result1 = mysql_query($sql1, $connection);
				while ($row = mysql_fetch_array($result1)){

			?>
            <div>
                <div class="cot_1a" style="padding-top:15px">
                	<div style="float:left; border-right:1px solid #C9CACA;margin-right:10px;border-bottom:1px solid #C9CACA;">
                    	<img src="images/product/<?php if($table=='sp') echo 'shoes'; else if($table=='pk') echo 'other'?>/thumb_<?php echo $row['id']?>_1.jpg"/></div>
                    <p style="font-weight:bold;font-size:11px;"><?php echo $row['ten'] ;?></p>
                    <p style="font-size:10px;margin-top:3px;">Mã số:<?php echo $row['ma'] ;?></p>
                    <div class="clr"></div>
                </div>
                <div class="cot_2a">
                	<p style="float:left; font-size:11px; width:99px; height:20px">Đơn giá:</p><p style="font-size:11px;font-weight:bold; height:20px"><?php echo $dongia=str_replace(',','.',number_format($row['dongia'],0)) ?> VND</p>
                    <p style="float:left; font-size:11px; width:100px; height:20px">Màu sắc:</p><div style="font-size:11px;height:20px;">
                    	<?php
						$mau_array=explode('-',$_COOKIE["id_mau_sp".$i]);
						foreach($mau_array as $mau_code){
                        $sql2 = "SELECT * FROM `mau` WHERE `id` = '$mau_code'";
						$result2 = mysql_query($sql2, $connection);
						while ($row2 = mysql_fetch_array($result2)){?>
                        <p class="box_color" style=" margin:-2px 4px 0 -1px;background:rgba(<?php echo $row2['code'];?>,1);" ></p>
                        <?php }
						}?>
                        </div>
                    <p style="float:left; font-size:11px; width:99px; height:20px">Size:</p><p style="font-size:11px;height:20px; font-weight:bold;"><?php echo str_replace('-',' ',$_COOKIE['id_size_sp'.$i]);?></p>
                    <p style="font-size:11px;">Giao hàng 3 - 5 ngày làm việc</p>
                </div>
                <div class="cot_3a"><input onchange="check_gia(<?php echo $i ?>)" name="sl_<?php echo $i ?>" style="border:1px solid #000; border-bottom:1px solid #555; width:55px; height:12px; padding:2px 10px 2px 10px; font-size:11px; margin-top:10px" type="text"  value="1"/></div>
                <div class="cot_4a"><div style="padding-top:10px;font-weight:bold; font-size:11px" id="tong_item<?php echo $i; ?>"><?php echo $dongia?> VND</div></div>
                <div class="cot_5a" ><p style="font-size:11px; font-weight:bold; padding-top:10px; cursor:pointer;" onclick="window.location='check_out.php?del=<?php echo $_COOKIE['id_sanpham'.$i] ?>'"><img style="margin:-5px 7px -2px 0" src="images/icon/xoa.png" /> XÓA</p></div>
                <div class="clr" style="height:1px; background:#000;"></div>
                <input type="hidden" name="tong_item<?php echo $i?>" value="<?php echo $row['dongia']?>" style="border:none"/>
                <input type="hidden" name="dongia<?php echo $i?>" value="<?php echo $row['dongia'] ?>" />
            </div>

            <?php	} 
				}?>
                    <script>
                	function check_gia(number){
						var show=eval('document.getElementById("tong_item'+number+'")');
						var input = eval('document.check_out.sl_'+number);
						var dongia = eval('document.check_out.dongia'+number);
						var tong_item=eval('document.check_out.tong_item'+number);
						document.cookie="cookie_sl"+number+"="+input.value;
						
						tong_item.value=dongia.value*input.value;
						show.innerHTML=dongia.value*input.value+' VND';
						document.check_out.tongcong_tien.value=<?php
							for($j=1;$j<=$sl_san_pham_da_mua;$j++){ 
							?>eval(document.check_out.tong_item<?php echo $j;?>.value)<?php if($j<$sl_san_pham_da_mua) echo '+'; 
							}?>;
						document.getElementById('tongcong_tien').innerHTML=<?php
							for($j=1;$j<=$sl_san_pham_da_mua;$j++){ 
							?>eval(document.check_out.tong_item<?php echo $j;?>.value)<?php if($j<$sl_san_pham_da_mua) echo '+'; 
							}?> + ' VND';
						document.getElementById('tong_sl').innerHTML=<?php
							for($j=1;$j<=$sl_san_pham_da_mua;$j++){ 
							?>eval(document.check_out.sl_<?php echo $j;?>.value)<?php if($j<$sl_san_pham_da_mua) echo '+'; 
							}?>;
					}
                </script>
            <div>
                <div class="cot_2" style="margin-left:390px; font-weight:bold; padding:15px 0; width:120px">TỔNG CỘNG</div>
                <div class="cot_3" style="font-weight:bold ;padding:15px 0; text-align:center; width:80px" id="tong_sl"></div>
                <div class="cot_4"  style="font-weight:bold; padding:15px 0; margin-left:80px" id="tongcong_tien">135.000 VND</div>
                <div class="cot_5"></div>
                <div class="clr" style="height:1px; background:#000;"></div>
                <input type="hidden" name="tongcong_tien" />
                <script>document.getElementById('tongcong_tien').innerHTML=<?php
							for($j=1;$j<=$sl_san_pham_da_mua;$j++){ 
							?>eval(document.check_out.tong_item<?php echo $j;?>.value)<?php if($j<$sl_san_pham_da_mua) echo '+'; 
							}?> + ' VND';
						document.getElementById('tong_sl').innerHTML=<?php
							for($j=1;$j<=$sl_san_pham_da_mua;$j++){ 
							?>eval(document.check_out.sl_<?php echo $j;?>.value)<?php if($j<$sl_san_pham_da_mua) echo '+'; 
							}?>;
						document.check_out.tongcong_tien.value=<?php
							for($j=1;$j<=$sl_san_pham_da_mua;$j++){ 
							?>eval(document.check_out.tong_item<?php echo $j;?>.value)<?php if($j<$sl_san_pham_da_mua) echo '+'; 
							}?>;
                            
				</script>
            </div>           
        </div>
		<div style="float:left">
        	<div style="margin-top:10px">
            <p style=" float:left; font-size:30px; color:#32C3D3; margin-right:10px; margin-top:-5px; height:30px">&#149;</p><p style=" font-size:11px; padding-top:5px; width:250px">THANH TOÁN NGAY KHI NHẬN HÀNG</p><div class="clr"></div>
        	<p style=" float:left; font-size:30px; color:#32C3D3; margin-right:10px;margin-top:-5px; height:30px">&#149;</p><p style="font-size:11px;padding-top:5px">TRẢ HÀNG TRONG 30 NGÀY</p><div class="clr"></div>
        	<p style=" float:left; font-size:30px; color:#32C3D3; margin-right:10px;margin-top:-5px; height:30px">&#149;</p><p style="font-size:11px;padding-top:5px">HOÀN TIỀN MẶT</p><div class="clr"></div>
        	<p style=" float:left; font-size:30px; color:#32C3D3; margin-right:10px;margin-top:-5px; height:30px">&#149;</p><p style="font-size:11px;padding-top:5px">HOTLINE (08) 123456</p> </div><div class="clr">
			</div>
		</div>
        
            <div style="float:right; margin-top:10px; cursor:pointer" onclick="document.check_out.submit()">
                <div class="title_check_out" style="width:156px;">TIẾN HÀNH THANH TOÁN</div>
                <div style="background:url(images/bg/1.png) no-repeat;width:20px;height:25px; float:left;"></div>
                <div style="background:url(images/bg/2.png) repeat-x;height:25px; width:136px; float:left;"></div>
                <div style="background:url(images/bg/3.png) no-repeat;width:20px;height:25px; float:left;"></div>
                <div class="clr"></div>
            </div>
        
        <div class="clr"></div>
    </div>
</section>
</form>
<?php include_once('footer.php')?>