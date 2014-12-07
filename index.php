<?php include_once('header.php');?>
<script src="js/jquery.min.js"></script>
<script>
var banner=1;
var time_delay=8000;
var t,k,p;
function hide(){
	clearTimeout(t);	
	$('#banner1').animate({opacity:'0'},0);
	$('#banner2').animate({opacity:'0'},0);
	$('#banner3').animate({opacity:'0'},0);
    $('#banner4').animate({opacity:'0',width:'960px'},0);
}

function slide(){
	clearTimeout(t);	
	banner=1;
    hide();
    $('#banner1').animate({opacity:'0', marginLeft:'-100px'},0);
	$('#banner1').animate({opacity:'1', marginLeft:'20px'},1000);
    $('#banner1').animate({opacity:'1', marginLeft:'0px'},800);
	t=setTimeout(part2,5000+time_delay);
}
function part2(){
	clearTimeout(t);
	banner=2;
	document.getElementById('banner2').style.marginLeft='50px';
    $('#banner2').animate({opacity:'0'},0);
    $('#banner2').animate({opacity:'1', marginLeft:'-20px'},2000);
    $('#banner2').animate({opacity:'1', marginLeft:'0px'},1500);
	t=setTimeout(part3,7000+time_delay);
}
function part3(){
	clearTimeout(t);	
	banner=3;
    $('#banner3').animate({opacity:'0'},0);
    $('#banner3').animate({opacity:'1', marginLeft:'-20px'},2000);
    $('#banner3').animate({opacity:'1', marginLeft:'0px'},1500);
	t=setTimeout(part4,9000+time_delay);
}
function part4(){
	clearTimeout(t);	
	banner=4;
	$('#banner4').animate({opacity:'0', width:'0'},0);
	$('#banner4').animate({opacity:'0.4', width:'750px'},1000);
	$('#banner4').animate({opacity:'1', width:'960px'},2500);
	t=setTimeout(slide,9000+time_delay);
}
    		

function next_banner(){
	banner++;
	if(banner==5) banner=1;
	$('#banner1').stop(true,true);
	$('#banner2').stop(true,true);
	$('#banner3').stop(true,true);
	$('#banner4').stop(true,true);
    hide();
	
	var div = '#banner'+ banner;
    $(div).animate({opacity:'0.3', marginLeft:'-100px'},0);
	$(div).animate({opacity:'1', marginLeft:'20px'},1000);
    $(div).animate({opacity:'1', marginLeft:'0px'},700);
	
	clearTimeout(t);	
	if(banner==4) t=setTimeout(part4,5000+time_delay);
	if(banner==1) t=setTimeout(slide,5000+time_delay);
	if(banner==2) t=setTimeout(part2,5000+time_delay);
	if(banner==3) t=setTimeout(part3,5000+time_delay);

}
function prev_banner(){
	banner--;
	if(banner==0) banner=4;
	$('#banner1').stop(true,true);
	$('#banner2').stop(true,true);
	$('#banner3').stop(true,true);
	$('#banner4').stop(true,true);
    hide();
	var div = '#banner'+ banner;
    $(div).animate({opacity:'0.3', marginLeft:'-100px'},0);
	$(div).animate({opacity:'1', marginLeft:'20px'},1000);
    $(div).animate({opacity:'1', marginLeft:'0px'},700);
	
	clearTimeout(t);	

	if(banner==4) t=setTimeout(slide,5000+time_delay);
	if(banner==1) t=setTimeout(part2,5000+time_delay);
	if(banner==2) t=setTimeout(part3,5000+time_delay);
	if(banner==3) t=setTimeout(slide,5000+time_delay);
	
}

</script>
<section class="main" id="banner" style="overflow:hidden">
	<div class="banner" style="height:300px; overflow:hidden">
        <div style="position:absolute; width:960px; text-align:left; display:block; overflow:hidden; z-index:1" id="divbanner1">
            	<img id="banner1" src="images/product/slide/1.jpg" height="300" width="960"/>
           	</div>
        <div style="position:absolute; width:960px; text-align:left; display:block; overflow:hidden; z-index:2" id="divbanner2">
            	<img id="banner2" src="images/product/slide/2.jpg" height="300" width="960"/>
           	</div>
        <div style="position:absolute; width:960px; text-align:center; display:block; overflow:hidden; z-index:3" id="divbanner3">
            	<img id="banner3" src="images/product/slide/3.jpg" height="300" width="960"/>
           	</div>
        <div style="position:absolute; width:960px; text-align:center; display:block; overflow:hidden; z-index:4" id="divbanner4">
            	<img id="banner4" src="images/product/slide/4.jpg" height="300" width="960"/>
           	</div>
   		<div class="next_prev_slide">
    		<div style="float:left"><img src="images/icon/prev.png" alt="" style="margin:4px 0 -4px 2px" onclick="prev_banner()"/></div>
    		<div style="float:right"><img src="images/icon/next.png" alt="" style="margin:4px 0 -4px 5px" onclick="next_banner()"/></div>
    	</div>
	</div>
</section>   
<article class="main" style="margin-bottom:-1px;">
	<section id="shoes">
    	<div class="left_banner">
    		<div><img src="images/product/left_banner_1.jpg" alt="" /></div>
    		<div><img src="images/product/left_banner_2.jpg" alt="" /></div>
    	</div>
    	<div class="big_shoes">
			<?php
			$sql = "SELECT * FROM `tintuc` ORDER BY `date` DESC LIMIT 0,2 ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
			?>        
        	<div>
                <div class="title_big_shoes" >
                	<p style="height:35px"><?php $date=explode('-',$row['date']); echo $date['2'].' | '.$date['1'].' | '.$date['0'];?></p>
                	<p style="font-weight:bold; height:85px"><?php echo $row['tieude']?></p>                    
                	<a href="news_detail.php?item=<?php echo $row['id'] ?>"><p style="font-style:italic;border-top:1px solid #000;font-size:12px; padding-top:10px;">Xem chi tiết</p></a>
                </div>
                <img src="images/news/<?php echo $row['id'] ?>.jpg"  height=""alt="" />
            </div>
	        <?php }?>
        </div>
        <?php
			$stt=1;
			$data_shoes=array();
			$data_shoes=NULL;
			$sql = "SELECT * FROM `sp` ORDER BY `date` DESC ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
				$data_shoes[$stt]=array(  "id"	   =>    $row["id"],
										  "ten"   =>	$row['ten'],
								);
				$stt++;
			}		?>
    	<div class="shoes">
    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[1]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[1]['id']?>_1.jpg" alt="" /></a></div>
    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[2]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[2]['id']?>_1.jpg" alt="" /></a></div>
    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[3]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[3]['id']?>_1.jpg" alt="" /></a></div>
            <div><a href="chitiet.php?item=sp-<?php echo $data_shoes[4]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[4]['id']?>_1.jpg" alt="" /></a></div>
    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[5]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[5]['id']?>_1.jpg" alt="" /></a></div>
    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[6]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[6]['id']?>_1.jpg" alt="" /></a></div>
    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[7]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[7]['id']?>_1.jpg" alt="" /></a></div>    		<div><a href="chitiet.php?item=sp-<?php echo $data_shoes[8]['id'] ?>"><img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[8]['id']?>_1.jpg" alt="" /></a></div>            <div class="clr"></div>
    	</div>
        <div class="clr"></div>
    </section>
    <section id="banner_body">
    	<div style="background:#0c7bdd;"><img src="images/product/slide/banner_body.jpg" width="749" height="207" alt="" /></div>
    </section>
   	<div class="left_banner">
        <div><img src="images/product/left_banner_3.jpg" /></div>
        <div><img src="images/product/left_banner_4.jpg" alt="" /></div>
   	</div>
   	<section id="">
    	<div class="shoes" style="width:840px;">
			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='7' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id']?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>
   			<div class="title_home">
            	<p>TÚI XÁCH</p>
                <div class="by_shadow_bl shoes_p2" style="width:150px; margin:1px 0 0 25px; opacity:0.8"> </div>
                <p class="shoes_p2" style="margin-top:5px;">ĐẲNG CẤP</p>
            </div>
   		</div>
    	<div class="shoes" style="width:840px;">
   			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='1' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id'] ?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>
   			<div class="title_home">
            	<div class="by_shadow_bl" style="width:210px;opacity:0.1;"></div>
                <p>DÂY NỊT</p>
                <div class="by_shadow_bl shoes_p2" style="width:150px; margin:1px 0 0 25px; opacity:0.8"> </div>
                <p class="shoes_p2" style="margin-top:5px;">THỜI TRANG</p>
            </div>
   		</div>
    	<div class="shoes" style="width:840px;">
   			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='3' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id'] ?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>
   			<div class="title_home">
            	<div class="by_shadow_bl" style="width:210px;opacity:0.2;"></div>
                <p>BÓP DA PRO</p>
                <div class="by_shadow_bl shoes_p2" style="width:150px; margin:1px 0 0 25px; opacity:0.8"> </div>
                <p class="shoes_p2" style="margin-top:5px;">PHONG CÁCH</p>
            </div>

   		</div>
    	<div class="shoes" style="width:840px;">
   			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='4' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
           	<a href="chitiet.php?item=pk-<?php echo $row['id'] ?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>
   			<div class="title_home">
            	<div class="by_shadow_bl" style="width:210px;opacity:0.3;"></div>
                <p>NÓN</p>
                <div class="by_shadow_bl shoes_p2" style="width:150px; margin:1px 0 0 25px; opacity:0.8"> </div>
                <p class="shoes_p2" style="margin-top:5px;">PHONG CÁCH</p>
            </div>

   		</div>
   	</section>
    <div class="clr"></div>
</article>
<script>slide();</script>
<?php include_once('footer.php')?>