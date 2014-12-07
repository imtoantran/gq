		unset($_COOKIE['sl_sp_mua']);		
		for($p=1;$p<=$_COOKIE['sl_sp_mua'];$p++){	
			unset($_COOKIE['id_sanpham'.$p]);
			unset($_COOKIE['id_mau_sp'.$p]);
			unset($_COOKIE['id_size_sp'.$p]);
			unset($_COOKIE['cookie_sl'.$p]);
		}