<?php include_once('header.php');?>

<?php
	if($_POST['user']){
	
    	$user=$_POST['user'];
		$pass=$_POST['pass'];
		
	
		$sql = "SELECT * FROM  `thanhvien` WHERE `user`= '$user' AND `pass`= '$pass'";
		$result = mysql_query($sql, $connection);				
		if(mysql_num_rows($result)){

			session_start();
			session_register("user_quoc_id", "user_quoc_password");  
			$_SESSION['user_quoc_id'] = $user;   
			$_SESSION['user_quoc_password'] = $pass;
			?><script> window.location = "index.php";</script><?php 
		}
	}
	if($_POST['user_sign_up'] && $_POST['pass_sign_up']){
		if($_POST['pass_sign_up']==$_POST['pass_sign_up_cf']){
			$row = mysql_fetch_array(mysql_query("SELECT MAX(id) FROM `thanhvien`"));
			$max_id=$row['MAX(id)']+1;
			$s = "INSERT INTO  `quoc`.`thanhvien` (`id` ,`user` ,`pass` ,`email`,`date`)";		
			$s.= "VALUES ('%s',  '%s',  '%s',  '%s', CURDATE( ));";
			$s = sprintf
				($s			
				,mysql_real_escape_string($max_id)
				,mysql_real_escape_string($_POST['user_sign_up'])
				,mysql_real_escape_string($_POST['pass_sign_up'])
				,mysql_real_escape_string($_POST['email_sign_up'])
				);
			if(mysql_query($s)){
				session_start();
				session_register("user_quoc_id", "user_quoc_password");  
				$_SESSION['user_quoc_id'] = $_POST['user_sign_up'];   
				$_SESSION['user_quoc_password'] = $_POST['pass_sign_up'];
				?><script> window.location = "index.php";</script><?php 
			}
		}
		else{
			$notice='Mật khẩu không khớp, vui lòng nhập lại';
			
		}
	}
?>
<section style="width:922px; margin:8px auto 8px auto;background:#fff;padding:30px 18px 20px 20px;">
    <form action="" method="post" name="login">
	<div class="clr" style="height:1px; background:#000"></div>
    <p style="padding:10px 0; font-size:14px"># QUÝ KHÁCH HÀNG ĐĂNG KÝ HOẶC ĐĂNG NHẬP ĐỂ CHÚNG TÔI HỖ TRỢ TỐT NHẤT.</p>
	<div class="clr" style="height:1px; background:#000"></div>
    
    <div style="float:left">
        <div style="position:absolute; height:370px; width:240px; background:#000; z-index:1; margin:20px 0 0 0"></div>
    	<img src="images/bg/login.jpg" height="370" width="240" style="position:relative; z-index:1; margin:27px 0 0 10px"/>
    </div>
    <input type="text" style="border:none; position:absolute; color:#000; width:300px; margin:3px 0 0 30px" name="notice" value="<?php echo $notice?>" />
	<div style="float:left; border:1px solid #000; padding:20px 30px 0 30px; width:230px; margin:27px 0 0 30px; height:310px">
        	<p style="font-weight:bold; font-size:12px; text-align:center; margin-bottom:20px">PHẦN DÀNH CHO KHÁCH HÀNG MỚI</p>
      		<p style="font-size:11px; padding:5px 0">Username:</p>
            <input type="text" name="user_sign_up" class="input_check" />
            <p style="font-size:10px; font-style:italic; width:230px; line-height:1.5">Chúng tôi sẽ gửi thư xác nhận đến địa chỉ email này. Xin hãy chắc chắn rằng bạn có thể truy cập và sử dụng địa chỉ email này để nhận thư.</p>
            <div class="clr"></div>
            
            <p style="width:130px; float:left; font-size:11px; padding:10px 0 5px 0">Mật khẩu:</p>
            <p style="font-size:11px; padding:10px 0 5px 0 ">Nhập lại mật khẩu:</p>
            <input type="password" name="pass_sign_up" class="input_check2" style="margin-right:30px"/>
            <input type="password" name="pass_sign_up_cf" class="input_check2"/>
            <div class="clr"></div>

            <p style="font-size:11px; padding:10px 0 5px 0">Email:</p>
            <input type="text" name="email_sign_up" class="input_check" />
            <div class="clr" style="height:20px"></div>
            
            <input value="ĐĂNG KÝ" type="submit" class="add_giohang" style="border:none;color:#000; cursor:pointer; font-size:11px; padding:4px 0 4px 0; height:22px; width:120px; margin:10px 0 0 55px">
            <div class="clr" style="height:30px"></div>
    </div>
	<div style="float:left; border:1px solid #000; padding:20px 30px 0 30px; width:230px; margin:27px 0 0 40px; height:310px">
        	<p style="font-weight:bold; font-size:12px; text-align:center; margin-bottom:20px">PHẦN DÀNH CHO THÀNH VIÊN</p>
            <p style="font-size:11px; padding:5px 0">Username:</p>
            <input type="text" name="user" class="input_check" />
			<p style="font-size:11px; padding:20px 0 5px 0">Password</p>
            <input type="password" name="pass" class="input_check" />
            <input value="ĐĂNG NHẬP" type="submit" class="add_giohang" style="border:none;color:#000; cursor:pointer; font-size:11px; padding:4px 0 4px 0; height:22px; width:120px; margin:50px 0 0 55px">
	</div>
    </form>    
    <div class="clr"></div>
</section>

<?php include_once('footer.php');?>