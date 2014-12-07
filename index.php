<?php include_once('header.php');?>
<?php include_once 'banner.php' ?>
<article class="main" style="margin-bottom:-1px;">

	<section id="shoes">

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
                <div class="featured-image-wrap">
                    <img src="images/news/<?php echo $row['id'] ?>.jpg"  height=""alt="" />
                </div>
            </div>
	        <?php }?>
        </div>
        <?php
            /* featured products */
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
    		<div>
                <a href="chitiet.php?item=sp-<?php echo $data_shoes[1]['id'] ?>">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[1]['id']?>_1.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="#">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes_blank.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="chitiet.php?item=sp-<?php echo $data_shoes[2]['id'] ?>">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[2]['id']?>_1.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="chitiet.php?item=sp-<?php echo $data_shoes[3]['id'] ?>">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[3]['id']?>_1.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="chitiet.php?item=sp-<?php echo $data_shoes[4]['id'] ?>">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[4]['id']?>_1.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="#">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes_blank.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="chitiet.php?item=sp-<?php echo $data_shoes[5]['id'] ?>">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[5]['id']?>_1.jpg" alt="" />
                </a>
            </div>
            <div>
                <a href="chitiet.php?item=sp-<?php echo $data_shoes[6]['id'] ?>">
                    <img onerror="this.src='images/icon/error.jpg'" src="images/product/shoes/<?php echo $data_shoes[6]['id']?>_1.jpg" alt="" />
                </a>
            </div>
    	</div>
        <div class="clr"></div>
    </section>

   	<section id="pk">
    <div id="navigation">
        <div>Sản phẩm khác</div>
        <nav>
            <ul>
            <?php include_once 'danhmucphukien.php'; ?>
            </ul>
        </nav>      
    </div>    
    	<div class="shoes" style="width:840px;">
			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='7' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id']?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>

   		</div>
    	<div class="shoes" style="width:840px;">
   			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='1' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id'] ?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>

   		</div>
    	<div class="shoes" style="width:840px;">
   			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='3' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
            <a href="chitiet.php?item=pk-<?php echo $row['id'] ?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>

   		</div>
    	<div class="shoes" style="width:840px;">
   			<?php
			$sql = "SELECT * FROM `pk` WHERE `mucloai`='4' ORDER BY `date` DESC LIMIT 0,3";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){?>
           	<a href="chitiet.php?item=pk-<?php echo $row['id'] ?>"><div><img onerror="this.src='images/icon/error.jpg'" src="images/product/other/<?php echo $row['id'] ?>_1.jpg" alt="" /></div></a>
			<?php }?>

   		</div>
   	</section>

    <div class="clr"></div>
</article>
<?php include_once('footer.php')?>