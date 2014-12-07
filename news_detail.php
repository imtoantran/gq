<?php include_once('header.php')?>
<section class="main" id="banner">
	<div class="banner">
   		<img src="images/news/slide.jpg" alt="" />
        <div style="background:#F3E662;border-bottom: 1px solid #C2B959; height:1px">
	</div>
</section>   
<section class="main" style="background:#fff;padding-bottom:20px;">
    <div style="float:left; width:420px; margin-left:120px;">
        <?php
			$id=$_GET['item'];
			$sql = "SELECT * FROM `tintuc` WHERE `id` = $id ";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
				
			for($j=1;$j<=$row['anh'];$j++){	?>
            <div style="float:left">
                <img src="images/news/<?php echo $row['id'].'-'.$j?>.jpg" alt="" width=420, height=420/>
            </div>
            <?php }?>
    </div>    
    <div class="title_news"><?php echo $row['tieude'];?></div> 
    <div class="title_news_text">
		<?php 	
					$noidung=nl2br($row['noidung']);
					$noidung= str_replace('<br />','</p><p>',$noidung);
					$noidung='<p>'.$noidung.'</p>';
					echo show_html($noidung,1);?>
    </div>
    <?php }?>
    <div class="clr" style="height:2px;"></div>
</section>

<?php include_once('footer.php')?>