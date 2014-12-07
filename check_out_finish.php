<?php include_once('header.php')?>
<?php 
		$ma_giam_gia=$_POST['ma'];
			$sql = "SELECT * FROM `ma_giam_gia` WHERE `ma` =  '$ma_giam_gia'";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
				$phantram=$row['phantram'];
			}

?>

<script type="text/javascript" src="js/tqp_script.js"></script>
<script type="text/javascript" src="js/dropdown2.js"></script>
<section style="width:922px; margin:8px auto 8px auto;background:#fff;padding:30px 18px 20px 20px;">
	<div class="clr" style="height:1px; background:#000;"></div>
    <div class="tieude_check_fn" style="width:290px">
    	1. THÔNG TIN KHÁCH HÀNG
    </div>
    <div class="tieude_check_fn" style="width:290px">
    	2. HÌNH THỨC THANH TOÁN
    </div>
    <div class="tieude_check_fn">
    	3. XÁC NHẬN ĐƠN HÀNG
    </div>
    <div class="clr" style="height:1px; background:#000;"></div>
    <form action="thank.php" method="post" name="check_out_fn">
    <input type="hidden" name="tongcong_tien" value="<?php if($ma_giam_gia) {$tong_tien_giam=$_POST['tongcong_tien']*$ma_giam_gia/100; echo $tong_tien_giam;} else echo $_POST['tongcong_tien'];?>" />
    <div class="tieude_check_fn" style="width:290px; padding-top:10px">
    	<p>Địa chỉ email</p>
        <input type="text" name="email" class="input_check" />
        <p style="font-size:10px; font-style:italic; width:230px; line-height:1.5">Chúng tôi sẽ gửi thư xác nhận đến địa chỉ email này. Xin hãy chắc chắn rằng bạn có thể truy cập và sử dụng địa chỉ email này để nhận thư.</p>
        <div class="clr"></div>
        
        <p style="width:130px; float:left">Mật khẩu</p>
        <p>Nhập lại mật khẩu</p>
        <input type="password" name="pass" class="input_check2" style="margin-right:30px"/>
        <input type="password" name="pass_cf" class="input_check2"/>
        <div class="clr"></div>

        <p style="width:130px; float:left">Họ</p>
        <p>Tên</p>
        <input type="text" name="ho" class="input_check2" style="margin-right:30px"/>
        <input type="text" name="ten" class="input_check2"/>
        <div class="clr"></div>

        <p>Số điện thoại</p>
        <input type="text" name="sdt" class="input_check" />
        <div class="clr"></div>
		<div>
            <img src="images/icon/down_arrow.png" id="gt1" style="position:absolute; margin: 32px 0 0 208px" height="10" width="18" />
            <p style="width:130px; float:left">Ngày sinh</p>
            <p>Giới tính</p>
            <input type="text" name="ngay" class="input_check" style="width:30px; padding:0; text-align:center"/>
            <input type="text" name="thang" class="input_check" style=" width:30px; padding:0; text-align:center"/>
            <input type="text" name="nam" class="input_check" style="width:40px; padding:0; text-align:center"/>
    
            <input type="text" name="gt" id="gt" class="input_check2" style="margin-left:21px; float:none" value=""/>
	        <div id="gtdown" style="width:98px; margin-left:130px; padding-top:5px; overflow:visible; overflow-x:hidden; min-height:30px; border:1px solid #666; position:static; background:#fff; z-index:10">
            <li style="cursor:pointer; padding-left:5px; font-size:11px" 
                onclick="check_out_fn.gt.value='Nam';document.getElementById('gtdown').style.visibility='hidden'" 
                onmousemove="style.background='#87a310'" 
                onmouseout="style.background='#fff'">    
				Nam</li>
			<li style="cursor:pointer; padding-left:5px; font-size:11px" 
                onclick="check_out_fn.gt.value='Nữ';document.getElementById('gtdown').style.visibility='hidden'" 
                onmousemove="style.background='#87a310'" 
                onmouseout="style.background='#fff'">    
				Nữ</li>
            
            </div>
            <script type="text/javascript">
                    at_attach("gt", "gtdown", "click", "y", "");
                    at_attach("gt1", "gtdown", "click", "y", "");
            </script>  
		</div>
        <div class="clr"></div>
        

        <p>Địa chỉ</p>
        <input type="text" name="dc" class="input_check" />
        <div class="clr"></div>

		<div style="float:left; width:100px">
            <img src="images/icon/down_arrow.png" id="cityAddr1" style="position:absolute; margin: 32px 0 0 78px" height="10" width="18" />
            <img src="images/icon/down_arrow.png" id="quan1" style="position:absolute; margin: 32px 0 0 208px" height="10" width="18" />
            <p style="width:130px">Tỉnh/ Thành</p>
            <input type="text" id="cityAddr" name="cityAddr" class="input_check2" style="margin-right:30px; float:none; cursor:pointer"/>
            <div id="city_down" style="width:116px; margin-top:-1px; padding-top:5px; overflow:visible; overflow-x:hidden; height:250px; background:#fff; border:1px solid #666;">
            <?php 
            $number=0;
            $array=array("TP. Hà Nội","TP. Hồ Chí Minh","TP. Hải Phòng","TP. Đà Nẵng","TP. Cần Thơ",
                         "An Giang","Bà Rịa – Vũng Tàu","Bạc Liêu","Bắc Giang","Bắc Kạn","Bắc Ninh","Bến Tre",
                         "Bình Dương","Bình Định","Bình Phước","Bình Thuận","Cao Bằng","Cà Mau",
                         "Đăk Lăk","Đăk Nông","Điện Biên","Đồng Nai","Đồng Tháp","Gia Lai","Hà Giang",
                         "Hà Nam","Hà Tĩnh","Hải Dương","Hậu Giang","Hòa Bình","Hưng Yên","Khánh Hòa",
                         "Kiên Giang","Kon Tum","Lai Châu","Lào Cai","Lạng Sơn","Lâm Đồng",
                         "Long An","Nam Định","Nghệ An","Ninh Bình","Ninh Thuận","Phú Thọ",
                         "Phú Yên","Quảng Bình","Quảng Nam","Quảng Ngãi","Quảng Ninh",
                         "Quảng Trị","Sóc Trăng","Sơn La","Tây Ninh","Thanh Hóa","Thái Bình",
                         "Thái Nguyên","Thừa Thiên – Huế","Tiền Giang","Trà Vinh","Tuyên Quang",
                         "Vĩnh Long","Vĩnh Phúc","Yên Bái");
            foreach($array as $value){$number++;
            ?> 
                <li style="cursor:pointer; padding-left:5px; font-size:11px" 
                onclick="check_out_fn.cityAddr.value='<?php echo $value ?>';changeTqp('cityAddr', 'quan', 'dist', 1);document.getElementById('city_down').style.visibility='hidden'" 
                onmousemove="style.background='#87a310'" 
                onmouseout="style.background='#fff'">    
                    <?php echo $value ?>
                </li>		
            <?php }?>
            </div>
            <script type="text/javascript">
                at_attach("cityAddr", "city_down", "click", "y", "");
                at_attach("cityAddr1", "city_down", "click", "y", "");
            </script>
                </div>
            <div style="float:left; width:100px; margin-left:30px">
                <p>Quận/ Huyện</p>       
                <input type="text" name="quan" id="quan" readonly="readonly" class="input_check2" style="cursor:pointer"/>
                <div id="dist" style="width:116px; margin-top:24px; padding-top:5px; overflow:visible; overflow-x:hidden; min-height:100px; border:1px solid #666;background:#fff;"></div>
                <script type="text/javascript">
                    at_attach("quan", "dist", "click", "y", "");
                    at_attach("quan1", "dist", "click", "y", "");
                </script>            
        	</div>

        <div class="clr"></div>

        <p>Ghi chú</p>
        <textarea name="noidung" class="input_check" id="noidung" style="height:85px; resize:none; overflow:hidden; padding-top:5px" type="text"></textarea>
        <div class="clr"></div>

    </div>
    </form>
    <div class="tieude_check_fn2" style="width:290px;padding-top:20px; margin-left:-4px">
        <div class="box_color" style="background:rgba(0,0,0,1); float:left; margin-right:10px"><div style=" margin:4px; background:#fff; height:4px; width:4px;"></div></div>
        <div style="padding-top:3px; font-size:11px">    Thanh toán trực tiếp khi nhận hàng</div>
        <div class="clr" style="height:10px"></div>
       <div class="box_color" style="background:rgba(0,0,0,1); float:left; margin-right:10px"><div style=" margin:4px; background:#fff; height:4px; width:4px;"></div></div>
        <div style="padding-top:3px; font-size:11px">    Chuyển khoản ngân hàng</div>
        <div class="clr"></div>
    </div>
    <div class="tieude_check_fn2" style="padding-top:20px; width:340px">
     	<form method="post" action="" name="giam_gia">
        <input type="hidden" name="tongcong_tien" value="<?php echo $_POST['tongcong_tien']?>" />        
		<div class="cot_1" style="width:120px">SẢN PHẨM</div>
		<div class="cot_2" style="width:100px;text-align:center;">SỐ LƯỢNG</div>
		<div class="cot_3"  style="width:100px; text-align:right;">ĐƠN GIÁ</div>
        <div class="clr" style="background:#444444; height:1px; width:346px; border-top:1px solid #BBBBBB;"></div>   
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
        
        <div style="padding-top:20px">
        <div class="cot_1" style="width:120px">
        	<img src="images/product/<?php if($table=='sp') echo 'shoes'; else if($table=='pk') echo 'other'?>/thumb_<?php echo $row['id']?>_1.jpg"/>
			<div style="font-size:11px;padding-top:5px;"><?php echo $row['ten'] ?></div>
            <div style="font-size:11px;padding-top:2px;">Size: <?php echo str_replace('-',' ',$_COOKIE['id_size_sp'.$i]) ?></div>
            
            </div>
		<div class="cot_2" style="width:100px; text-align:center; font-size:11px; padding-top:20px"><?php echo $_COOKIE['cookie_sl'.$i]?></div>
		<div class="cot_3"  style="width:100px; text-align:right; font-size:11px; padding-top:20px"><?php echo $_POST['tong_item'.$i]?> VND</div>
        <div class="clr"></div>
        <input type="hidden" name="tong_item<?php echo $i?>"  value="<?php echo $_POST['tong_item'.$i]?>"/>

        </div>
        <?php } 
		}?>
        
        <div class="clr" style="background:#444444; height:1px; width:346px; border-top:1px solid #BBBBBB; margin-top:15px"></div>   
        <div style="height:30px; width:1px; background:#444444; border-left:1px solid #BBBBBB; margin-left:125px;"></div>
        <div style="background:#444444; height:1px; width:200px; border-top:1px solid #BBBBBB; margin-left:146px;">
        	<div style="position:absolute; margin:-23px 0 0 40px; font-size:11px;">THÀNH TIỀN: </div>
            <div style="position:absolute; margin:-23px 0 0 135px; font-size:11px; text-align:right;"><?php if($phantram) {$tong_tien_giam=(($_POST['tongcong_tien'])-(($_POST['tongcong_tien']*$phantram)/100)); echo $tong_tien_giam;} else echo $_POST['tongcong_tien'];?> VND</div>
        </div>
        <div style=" margin:50px 0 0 00px">

        	<p style="float:left; font-size:11px; text-decoration:underline; margin-right:10px; padding-top:1px">Mã giảm giá:</p>
            <input name="ma" type="text" style="background:url(images/icon/box.jpg); height:12px; width:132px; float:left; font-size:11px; border:none; padding:2px 10px 2px 10px"  />	   
            <div class="add_giohang" onclick="document.giam_gia.submit();" style=" cursor:pointer;float:left; font-size:11px; padding:1px 0 2px 0; height:13px; width:80px; margin:-1px 0 0 10px ">SỬ DỤNG</div>
        </div>
        	    <div style="float:right; margin-top:30px; cursor:pointer" onclick="document.check_out_fn.submit()">
                <div class="title_check_out" style="width:156px;">HOÀN TẤT MUA HÀNG</div>
                <div style="background:url(images/bg/1.png) no-repeat;width:20px;height:25px; float:left;"></div>
                <div style="background:url(images/bg/2.png) repeat-x;height:25px; width:112px; float:left;"></div>
                <div style="background:url(images/bg/3.png) no-repeat;width:20px;height:25px; float:left;"></div>
                <div class="clr"></div>
        </div>
        </div>
		</form>

    </div>  
    <div class="clr"></div>

</section>

<?php include_once('footer.php')?>