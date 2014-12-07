<?php include_once('header.php')?>
<section class="main" id="banner">
	<div class="banner">
   		<img src="images/news/slide.jpg" alt="" />
        <div style="background:#F3E662;border-bottom: 1px solid #C2B959; height:1px">
	</div>
</section>   
<section class="main" style="background:#fff">
<div style="float:right; width:840px;">
	<?php
	$p=1;
 			//Set DATABASE
			$stt=1;
			$data=array();
			$data=NULL;
			$sql = "SELECT * FROM `tintuc` ORDER BY `date` DESC ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
				$data[$stt]=array(  "id"	   =>    $row["id"],
									"tieude"	=>	$row['tieude'],
									"noidung"	=> 	$row['noidung'],
									"date"	=> 	$row['date']
								);
				$stt++;
			}			

			//Set Các giá trị ban đầu
			$total_item=$stt-1;
			$item_of_page=8;
			$page_of_group=5;
			$temp_page_of_group=3;
						
            include_once('admin/phantrangfist.php');
			
						
			for($i=$start_item_view; $i<$end_item_view; $i++)
			{   $j=($i-1)*10;
				
				
	if($p==2){	
	?>
    <div class="title_news">TIN TỨC THỜI TRANG GIÀY VÀ PHỤ KIỆN DA</div>    
    <?php }?>
	<div style="float:<?php if($i%2==0)echo "right"; else echo "left"?>; ">
		<div class="news">
            <p style="font-size:10px;padding-top:30px;"><?php $date=explode('-',$data[$i]['date']); echo $date['2'].' | '.$date['1'].' | '.$date['0'];?> </p>
            <a href="news_detail.php?item=<?php echo $data[$i]['id'] ?>">
            	<p style="font-size:12px;padding-top:25px;padding-right:5px;font-weight:bold;"><?php echo $data[$i]['tieude'] ?></p>
           	</a>
            <p class="by_shadow_bl" style="margin-top:30px;width:190px;opacity:0.7;"></p>
            <a href="news_detail.php?item=<?php echo $data[$i]['id'] ?>">
            	<p style="font-size:11px; margin-top:60px;font-style:italic;">Xem chi tiết</p>
            </a>
	    </div>        
        <img src="images/news/<?php echo $data[$i]['id']?>.jpg" alt="" width = 420, height = 420/>
	</div>
    <?php $p++;}?>
    <div class="clr"></div>
	<div class="title_news" style="padding-left:100px; width:320px;">
    <?php $url='news.php';
	  include_once('phantrangsecond.php');?>
   
        <br />
    </div>
</div>
<div class="clr"></div>
</section>

<?php include_once('footer.php')?>