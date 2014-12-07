<?php
session_start();
$user=NULL;
include_once('config/conn.php');
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
function show_html($text_html,$show){
		if($show=='1') $text_html=str_replace('<strong>','<b>',(htmlspecialchars_decode	($text_html)));
		else if($show==0) $text_html=str_replace('<strong>','<b>',strip_tags(htmlspecialchars_decode	($text_html)));
		$text_html=str_replace('</strong>','</b>',$text_html);
		$text_html=str_replace('<em>','<i>',$text_html);
		$text_html=str_replace('</em>','</i>',$text_html);
		return $text_html;
}
function check_img($file_path){
		$url = @getimagesize($file_path);
		if(is_array($url)){
			return $file_path;
		}
		else {
			return NULL;
		}
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Quoc</title>
<link href="style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
<header>
  <div style="width:540px; float:left;"> <a href="index.php">
    <div style="height:145px; background:#ff4848">
      <p id="logo" class="logo" <?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false) echo 'style="margin-top:-10px"'; ?> >Quốc</p>
      <p style="margin:115px 0 0 140px;position:absolute;">Tiếp bước chân bạn</p>
    </div>
    </a>
    <div class="seach">
      <form action="seach.php" method="post" name="seach" >
        <input type="text" name="in_seach" id="" value="Tìm kiếm..." onclick="seach.in_seach.value=''"/>
        <img src="images/icon/seach.jpg" alt="" style="cursor:pointer;" onclick="seach.submit()" />
      </form>
    </div>
  </div>
  <div style="float:left; width:420px">
    <nav style="position:absolute;">
      <ul class="menu">
        <a href="index.php">
        <li class="item-1">Trang chủ</li>
        </a> <a href="shoes.php">
        <li class="item-2">Giày da</li>
        </a> <a href="other.php">
        <li class="item-3">Phụ kiện da</li>
        </a> <a href="news.php">
        <li class="item-4">Tin tức</li>
        </a>
      </ul>
    </nav>
    <div class="login"> 
        <a href="check_out.php"><p><?php if($_COOKIE['sl_sp_mua']<1) echo '0'; else echo $_COOKIE['sl_sp_mua']; ?></p><div style=" float:right; color:#fff; margin-left:14px;"><span>GIỎ HÀNG </span><img src="images/icon/check_out.jpg" alt="" /> </div> 
        </a>     
        <a href="<?php if(isset($_SESSION['user_quoc_id'])) echo 'log_out.php'; else echo 'login.php';?>"><div style=" float:right; color:#fff; margin-left:2px"> <span><?php if(isset($_SESSION['user_quoc_id'])) echo 'THOÁT'; else echo 'ĐĂNG NHẬP'?></span></div></a>
        <a href="login.php"><div style="float:right; color:#fff;text-transform:uppercase"><span><?php if(isset($_SESSION['user_quoc_id'])) echo 'Hi! '.$_SESSION['user_quoc_id']; else echo 'ĐĂNG KÝ'?>/ </span></div></a>
        <div class="clr"></div>
    </div>
    <div class="clr" style="margin-top:-10px"></div>
    <div class="connect">Kết nối với chúng tôi
      <?php
        		for($i=1;$i<=4;$i++){ 
				$sql = "SELECT * FROM  `link` WHERE `id` ='$i' "; $result = mysql_query($sql, $connection);
				$row= mysql_fetch_array($result);?>
      <a href="<?php echo $row['link']?>"> <img src="images/icon/social_netwrork/<?php echo $i?>.jpg" /> </a>
      <?php }?>
    </div>
  </div>
  <div class="clr"></div>
</header>
