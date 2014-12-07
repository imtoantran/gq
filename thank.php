<?php 
		session_start();
		include_once('config/conn.php');
		$ma_donhang=strtoupper(substr(md5(rand()), 0, 7));
		while(1){
			$sql = "SELECT * FROM  `donhang` WHERE `mahang`= '$ma_donhang'";
			$result = mysql_query($sql, $connection);				
			if(mysql_num_rows($result)) $ma_donhang=strtoupper(substr(md5(rand()), 0, 7));
			else break;
		}
				
		
		

		$email=$_POST['email'];
		$sql = "SELECT * FROM  `kh` WHERE `email`= '$email'";
		$result = mysql_query($sql, $connection);				
		if($row5 = mysql_fetch_array($result)){
			for($m=1;$m<=$_COOKIE['sl_sp_mua'];$m++){								// Thêm đơn hàng
				$s = "INSERT INTO  `donhang` (`mahang`,`id_sp` ,`id_kh` ,`mau` ,`size` ,`sl` ,`date` ,`noidung`)";		
				$s.= "VALUES ('%s',  '%s', '%s',  '%s',  '%s',  '%s', CURDATE( ) ,  '%s');";
				$s = sprintf
					($s			
					,mysql_real_escape_string($ma_donhang)
					,mysql_real_escape_string($_COOKIE['id_sanpham'.$m])
					,mysql_real_escape_string($row5['id'])
					,mysql_real_escape_string($_COOKIE['id_mau_sp'.$m])
					,mysql_real_escape_string($_COOKIE['id_size_sp'.$m])
					,mysql_real_escape_string($_COOKIE['cookie_sl'.$m])
					,mysql_real_escape_string($_POST['noidung'])
					);
				mysql_query($s);
				
				$sp_pk_temp=explode('-',$_COOKIE['id_sanpham'.$m]);
				$sp_pk=$sp_pk_temp[0];
				$id_sp_dem=$sp_pk_temp[1];
				
				$sql12="SELECT * FROM  `dem` WHERE `sp_pk` = '$sp_pk' AND `ma_sp`= '$id_sp_dem'" ; 				
				$result12=mysql_query($sql12, $connection);
				$row12=mysql_fetch_array($result12);
                if($row12['sl']){					
					$query = "UPDATE  `dem` SET  `sl` =  %s  WHERE `sp_pk` = '$sp_pk' AND `ma_sp` = $id_sp_dem";
					$query = sprintf($query
						,mysql_real_escape_string($row12['sl']+1)
					);
					mysql_query($query);				
				}
				else {
					$s = "INSERT INTO  `dem` (`sp_pk` ,`sl` ,`ma_sp`)VALUES ('%s',  '%s',  '%s');";
					$s = sprintf
					($s
						,mysql_real_escape_string($sp_pk)
						,mysql_real_escape_string(1)
						,mysql_real_escape_string($id_sp_dem)
					);
					mysql_query($s);
					
				}
			}
		}
		else{
			$ngaysinh=$_POST['ngay'].'/'.$_POST['thang'].'/'.$_POST['nam'];
			$gioitinh=$_POST['gt'];
			$hoten=$_POST['ho'].' '.$_POST['ten'];
			$tt_khac=$hoten.'-'.$ngaysinh.'-'.$gioitinh;
			$dc=$_POST['dc'];
			if(isset($_POST['quan'])) $dc = $dc.', Quận/Huyện '.$_POST['quan'];
			if(isset($_POST['cityAddr'])) $dc = $dc.', Thành phố/Tỉnh '.$_POST['cityAddr'];
			
			$row = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM `kh`"));		//THêm kh
			$max_id=$row['MAX(id)']+1;		
			$s = "INSERT INTO  `kh` (`id` ,`email` ,`dc` ,`sdt` ,`tt_khac`)";
			$s.= "VALUES ('%s',  '%s',  '%s',  '%s',  '%s');";
			$s = sprintf
				($s			
				,mysql_real_escape_string($max_id)
				,mysql_real_escape_string($_POST['email'])
				,mysql_real_escape_string($dc)
				,mysql_real_escape_string($_POST['sdt'])
				,mysql_real_escape_string($tt_khac)
				);
			mysql_query($s);

			for($m=1;$m<=$_COOKIE['sl_sp_mua'];$m++){								// Thêm đơn hàng
				$s = "INSERT INTO  `donhang` (`mahang`, `id_sp`  ,`id_kh` ,`mau` ,`size` ,`sl` ,`date` ,`noidung`)";		
				$s.= "VALUES ('%s', '%s',  '%s',  '%s',  '%s',  '%s', CURDATE( ) ,  '%s');";
				$s = sprintf
					($s			
					,mysql_real_escape_string($ma_donhang)
					,mysql_real_escape_string($_COOKIE['id_sanpham'.$m])
					,mysql_real_escape_string($max_id)
					,mysql_real_escape_string($_COOKIE['id_mau_sp'.$m])
					,mysql_real_escape_string($_COOKIE['id_size_sp'.$m])
					,mysql_real_escape_string($_COOKIE['cookie_sl'.$m])
					,mysql_real_escape_string($_POST['noidung'])
					);
				mysql_query($s);
			}
			
		}
		
				
		for($t=1;$t<=$_COOKIE['sl_sp_mua'];$t++){
			
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
		}
?>
<?php include_once('header.php')?>



<section style="width:922px; margin:8px auto 8px auto;background:#fff;padding:30px 18px 20px 20px;">
	<div class="clr" style="height:1px; background:#000"></div>
    <p style="padding:10px 0; font-size:14px"># 1 QUỐC SHOES XIN CHẦN THÀNH CẢM ƠN QUÝ KHÁCH HÀNG ĐÃ ỦNG HỘ VÀ MUA SẮN TẠI GIAYCAOSANG.VN</p>
	<div class="clr" style="height:1px; background:#000"></div>
    <div style="width:300px; float:left; padding-top:35px">
    	<img src="images/bg/thank.jpg" />
        <img src="images/icon/thanks.jpg" style="margin:50px 0 0 30px" />
    </div>
    <div class="thank">
    			<p>Xin chào bạn <?php if(isset($_SESSION['user_quoc_id'])) echo $_SESSION['user_quoc_id'] ?> !</p>
                <p>Cám ơn quý khách đã tin tưởng mua sắm ở ANGELA. Chúng tôi hy vọng quý khách sẽ yêu thích sản phẩm đã mua.</p>
                <p>Mã đơn hàng của quý khách là:</p>
                <p><?php echo '#'.$ma_donhang ?></p>
				<p>Xin quý khách vui lòng thanh toán <span style="font-weight:bold"><?php echo $_POST['tongcong_tien']; ?> VND </span>vào một trong các tài khoản ngân hàng sau: </p>
                <p>*Ngân hàng: ĐÔNG Á BANK </p>
                <p>Số tài khoản: 28672424629</p>
                <p>Chủ tài khoản: NGUYỄN VĂN A</p>
                <p>Địa chỉ chi nhánh: ABD NGUYỄN TRÃI ST TAN BINH DIST</p>
                <p>Lưu ý!</p>
                <p>Chi phí chuyển khoản (nếu có) sẽ được thanh toán bởi người mua. Xin vui lòng thanh toán giá trị đơn hàng và chi phí chuyển khoản (nếu có). Quí khách vui lòng kiểm tra thông tin chi phí chuyển khoản tại ngân hàng của mình. Xin quý khách vui lòng ghi rõ Tên người mua hàng kèm theo mã số xác nhận đơn hàng khi chuyển khoản để chúng tôi có thể xác thực việc thanh toán. Sản phẩm của quý khách sẽ không được chuyển nếu việc thanh toán chưa hoàn tất. Nếu chúng tôi không nhận được thanh toán trong vòng 48 giờ thì đơn hàng sẽ bị hủy. Hãy liên hệ với chúng tôi qua email info@giaycaosang.vn hoặc số điện thoại 0909 123 345 để được giúp đỡ thêm. Hãy đăng ký thành viên để được cập nhật những sản phẩm mới nhất và những khuyến mãi đặc biệt của QUOC Shoes. Trân trọng,</p>
                <p>QUOC Shoes</p>
</div>
<div class="clr"></div>
</section>

<?php include_once('footer.php')?>