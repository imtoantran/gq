<?php include_once('header.php')?>
<section class="main" id="banner">
	<div class="banner">
   		<img src="images/product/other/slide.jpg" alt="" />
	</div>
</section>   
<article class="main" style="margin-bottom:-1px;">
   	<div class="left_banner">
        <div>
        <div style="position:absolute;"></div>
        <img src="images/product/shoes/bg_moive.jpg" style="height:209px !important" /></div>
        <div class="text_left_menu" style="background:#fff;height:631px">
        	<p style="padding:10px 0 7px 10px;">DANH MỤC</p>
            <p class="by_shadow_bl" style="width:90px;margin-left:5px;margin-top:-7px;"></p>
            	<a href="other.php?muc=7&#show_sp"><li>&#149; Túi xách</li></a>
            	<a href="other.php?muc=1&#show_sp"><li>&#149; Dây nịt</li></a>
            	<a href="other.php?muc=2&#show_sp"><li>&#149; Kính mát</li></a>
            	<a href="other.php?muc=3&#show_sp"><li>&#149; Bóp da</li></a>
                <a href="other.php?muc=5&#show_sp"><li>&#149; Đồng hồ</li></a>
                <a href="other.php?muc=4&#show_sp"><li>&#149; Khăn choàng</li></a>
				<a href="other.php?muc=6&#show_sp"><li>&#149; Sản phẩm khác</li></a>
                
			<p style="padding:10px 0 7px 10px;">CHỌN GIÁ</p>
            <p class="by_shadow_bl" style="width:90px;margin-left:5px;margin-top:-7px;"></p>
	            <?php if($_GET['muc'])$url='other.php?muc='.$_GET['muc'].'&gia='; else $url='?gia='?>
            	<a href="<?php echo $url?>1&#show_sp"><li style="font-size:11px;">&#149; <span style="color:#fff">&#149;</span>< 300.000</li></a>
            	<a href="<?php echo $url?>2&#show_sp"><li style="font-size:11px;">&#149; 300.000 - 500.000</li></a>
            	<a href="<?php echo $url?>3&#show_sp"><li style="font-size:11px;">&#149; 500.000 - 1.000.000</li></a>
            	<a href="<?php echo $url?>4&#show_sp"><li style="font-size:11px;">&#149; <span style="color:#fff">&#149;</span>> 1.000.000</li></a>
			<p style="padding:10px 0 7px 10px;">CHỌN MÀU</p>
            <p class="by_shadow_bl" style="width:90px;margin-left:5px;margin-top:-7px;"></p>
            <div style="margin-left:2px;">
				<?php $color=array("52,52,52","202,174,152","181,149,85","144,93,46","29,97,83","241,118,42", "156,130,113","237,0,140","235,38,41","147,73,170 ", "52,90,255","226,226,226","204,155,40","76,63,54","37,105,158");
                    foreach($color as $value){?>
                    <div class="box_color" style="background:rgba(<?php echo $value ?>,0.4)">
                        <div style="background:rgba(<?php echo $value ?>,1)"></div>
                    </div>
                <? }?>
                <div class="clr"></div>
			</div>
            <p style="padding:20px 0 10px 35px">Trước</p>
            <p class="by_shadow_bl" style="width:42px; margin-left:32px;margin-top:-10px;"></p>
				<li style="text-align:center;padding-right:20px;">1</li>
				<li style="text-align:center;padding-right:20px;">2</li>
				<li style="text-align:center;padding-right:20px;">3</li>
				<li style="text-align:center;padding-right:20px;">4</li>
            <p class="by_shadow_bl" style="width:42px;margin-left:32px;margin-top:0px;"></p>
            <p style="padding:3px 0 7px 40px;">Sau</p>
        </div>
   	</div>
	<section id="show_sp">
    	<div class="shoes" style="width:840px;">
        <?php
			if($_GET['gia']){
				if($_GET['gia']==1) $dongia_seach ="< 300000";
				if($_GET['gia']==2) $dongia_seach =">= 300000 AND `dongia` < 500000";
				if($_GET['gia']==3) $dongia_seach =">= 500000 AND `dongia` < 1000000";
				if($_GET['gia']==4) $dongia_seach =">= 1000000 ";
			}
			if($_GET['muc'] && $_GET['gia']){ 
				$dk= "WHERE `mucloai` = '".$_GET['muc']."' AND `dongia`".$dongia_seach;
			}
			else if($_GET['muc']){
				$dk= "WHERE `mucloai` = ".$_GET['muc'];
			}
			else if($_GET['gia']){ 
				$dk="WHERE `dongia`".$dongia_seach;
			}
			else $dk='';
			
			$sql = "SELECT * FROM `pk` $dk ORDER BY `date` DESC LIMIT 0,16 ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id']?>"><div><img src="images/product/other/<?php echo $row['id']?>_1.jpg" alt="" /></div></a>
		<?php } ?>
        </div>
   	</section>
    <div class="clr"></div>
    <section id="banner_body">
    	<div style="background:#0c7bdd;"><img src="images/product/other/banner_body.jpg" width="749" height="207" alt="" /></div>
    </section>
   	<div class="left_banner">
        <div>
            <div style="position:absolute;"></div>
            <img src="images/product/shoes/bg_banchay.jpg" style="height:209px !important" />
			<div class="text_left_menu" style="background:#fff;height:631px"></div>
		</div>
   	</div>
   	<section>
    	<div class="shoes" style="width:840px;">
		<?php
		    $sql = "SELECT * FROM `dem` WHERE `sp_pk` = 'pk' ORDER BY `sl` DESC LIMIT 0,16 ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
        <a href="chitiet.php?item=pk-<?php echo $row['ma_sp'] ?>"><div><img src="images/product/other/<?php echo $row['ma_sp'] ?>_1.jpg" alt="" /></div></a>
        <?php }?>

        </div>
   	</section>
    <div class="clr"></div>
</article>
<div class="clr" style="height:5px"></div>

<?php include_once('footer.php')?>