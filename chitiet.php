<?php include_once('header.php');
$id_sp_temp=explode('-',$_GET['item']);
$id_sp=$id_sp_temp[1];
$table_sp=$id_sp_temp[0];
$sql = "SELECT * FROM `$table_sp` WHERE `id`= '$id_sp'";
$result = mysql_query($sql, $connection);
while ($row = mysql_fetch_array($result))
{?>
<script src="js/jquery.min.js"></script>
<script> 
var nextslide=1;
$(document).ready(
	function(){
  		$("#prev").click(
			function(){
				var endslide=document.getElementById('slide_img').value;
				if(nextslide < endslide){
				var next_slide_img = eval('$("#slide' + nextslide + '")');
				next_slide_img.animate({width:'toggle'});
				 nextslide++; }

			}
		);
		$("#next").click(
			function(){
				if(nextslide>1){
					nextslide--;
					var next_slide_img = eval('$("#slide' + nextslide + '")');
					next_slide_img.animate({width:'toggle'});
				}
			}
		);
		$("#prev2").click(
			function(){
				var endslide=document.getElementById('slide_img2').value;
				if(nextslide < endslide){
				var next_slide_img = eval('$("#slide2' + nextslide + '")');
				next_slide_img.animate({width:'toggle'});
				 nextslide++; }

			}
		);
		$("#next2").click(
			function(){
				if(nextslide>1){
					nextslide--;
					var next_slide_img = eval('$("#slide2' + nextslide + '")');
					next_slide_img.animate({width:'toggle'});
				}
			}
		);
	}
);
</script>
<article id="sanpham" style="overflow:hidden">
    <section id="leftmenu">
    	<div class="title_chitiet" onclick="show('chitiet_1')">
        	<div class="button_ex_down"> <img id="chitiet_1_img" src="images/icon/down.png" alt="" /></div>
        	<?php
			$id_mucloai=$row['mucloai'];
			if($table_sp=='sp') $mucloai='muc'; else $mucloai='mucpk';
			if($table_sp=='sp') $sp_pk= 'shoes'; else $sp_pk=  'other';
			$sql1 = "SELECT * FROM `$mucloai` WHERE `id`= '$id_mucloai'";
			$result1 = mysql_query($sql1, $connection);
			$row1 = mysql_fetch_array($result1); echo $row1['mucloai'];
			 ?> - <?php echo $row['ten'] ?>	</div>
    	<div class="chitiet" id="chitiet_1">
        	<p><?php echo $row['mota']?></p>
        	<p style="margin-top:7px;">Mã giày: <?php echo $row['ma'];?></p>
		</div>
        <div class="by_shadow_bl" style="width:260px; margin-top:10px"> </div>
        
        <div class="title_chitiet" style="margin-top:10px; cursor:pointer" onclick="show('chitiet_2')">
        	<div class="button_ex_down"> <img id="chitiet_2_img" src="images/icon/ex.png" alt="" /></div>CÁCH DÙNG & BẢO QUẢN
             </div>
		<div class="chitiet" style="display:none" id="chitiet_2" >
        	<p><?php echo $row['cachdung'] ?></p>
		</div>
        <div class="by_shadow_bl" style="width:260px; margin-top:10px"> </div>
        
        <div class="title_chitiet" style="margin-top:10px;" onclick="show('chitiet_3')">
        	<div class="button_ex_down"> <img  src="images/icon/ex.png" alt=""  id="chitiet_3_img" /></div>GIAO HÀNG & HOÀN TRẢ
			</div>
		<div class="chitiet" style="display:none;" id="chitiet_3">
        	<p><?php echo $row['giaonhan'] ?></p>        	
		</div>
        <div class="by_shadow_bl" style="width:260px; margin-top:10px"> </div>
    </section>
    <section id="img_chitiet">
    	<img src="images/product/<?php if($table_sp=='sp') echo 'shoes'; else echo 'other'?>/<?php echo $row['id']?>_1.jpg" id="show_img_big" alt="" height="460" width="460" />
        <?php
		for($i=1;$i<=$row['hinhanh'];$i++){?>
           <div class="thumb_img" onclick="document.getElementById('show_img_big').src='images/product/<?php if($table_sp=='sp') echo 'shoes'; else echo 'other'?>/<?php echo $row['id'].'_'.$i?>.jpg'">
	       <?php
		    	$url_img='images/product/'.$sp_pk.'/thumb_'.$row['id'].'_'.$i.'.jpg';
		   		echo '<img src="'.$url_img.'" alt="" />'; ?>
			</div> 
		<?php }?>
        <div class="clr"></div> 
    </section>
    <section id="chitiet_product">
        <div class="by_shadow_bl" style="width:220px; margin-top:20px"> </div>
    	<div class="title_chitiet" style="margin-top:12px;font-size:18px;"><?php echo 'VND: '.str_replace(',','.',number_format($row['dongia'],0));?></div>        	
        <div class="by_shadow_bl" style="width:220px; margin-top:0px"> </div>
        <p style="margin-top:30px;font-size:14px;"><?php echo $row['ten'];?></p>
        <p style="margin-top:17px">Chọn màu:</p>
        		<?php 
					$colortmp=explode('-',$row['mau']);
					$color=array();
					
					foreach($colortmp as $value){
						$sql1 = "SELECT * FROM `mau` WHERE `id`= '$value'";
						$result1 = mysql_query($sql1, $connection);
						$row1 = mysql_fetch_array($result1); $color[]=$row1['code'];
					}
					$stt_mau=1;
                    foreach($color as $value){?>
                    <div class="box_color"   onclick="set_on_off('onoffA<?php echo $stt_mau; ?>')"  style=" cursor:pointer;background:rgba(<?php echo $value ?>,1); margin-left:7px">
                    <img src="images/icon/check.png"  style="margin:-2px; display:none"  id="onoffA<?php echo $stt_mau; ?>" alt="" /></div>
                <?php  $stt_mau++; }?>

                <div class="clr"></div>
        <p style="margin-top:15px">Chọn size:</p>
       			<div style="margin-left:-4px">
				<?php $size=explode(', ',$row['size']);
                    $stt_size=1;
					foreach($size as $value){?>                  
                    <div class="box_color" onclick="set_on_off('onoffB<?php echo $stt_size; ?>')" style=" cursor:pointer;background:rgba(186, 186, 186,0.2); margin-left:10px;height:22px;width:22px;;">
                    	<div onclick="setmau()" style="background:rgba(186, 186, 186,1);font-size:10px; text-align:center;padding-top:3px;height:18px;width:22px;"><?php echo $value?>
                        <img src="images/icon/star.png"  style="margin:-5px 0 0 8px; display:none"  id="onoffB<?php echo $stt_size; ?>" alt="" /></div>
                    </div>
                <?php $stt_size++; }?>
                	<script>	var onoffA = new Array();
							var onoffA_mau= new Array();
							<?php
							for($i=1;$i<$stt_mau;$i++){?>
							onoffA[<?php echo $i ?>]=0;
							<?php }
							$i=1;
							foreach($colortmp as $value){?>
							onoffA_mau[<?php echo $i?>] = '<?php echo $value?>';
							<?php $i++;
							}?>
							
							var onoffB = new Array();
							var onoffB_size= new Array();
							<?php
							for($i=1;$i<$stt_size;$i++){?>
							onoffB[<?php echo $i ?>]=0;
							<?php }
							$i=1;
							foreach($size as $value){?>
							onoffB_size[<?php echo $i?>] = '<?php echo $value?>';
							<?php $i++;
							}?>
							
							
					function save_data(){		
											
							var data1='';
							var data2='';
							<?php
							for($i=1;$i<$stt_mau;$i++){?>
							if(onoffA[<?php echo $i?>]!=0) data1+=onoffA_mau[<?php echo $i; ?>]+'-';
							<?php }?>
							
							<?php
							for($i=1;$i<$stt_size;$i++){?>
							if(onoffB[<?php echo $i?>]!=0) data2+=onoffB_size[<?php echo $i; ?>]+'-';
							<?php }?>

							document.cookie = "sl_sp_mua=<?php $sl_sp_mua =$_COOKIE['sl_sp_mua']+1; echo $sl_sp_mua;?>";						
							document.cookie = "id_sanpham<?php echo $sl_sp_mua?>=<?php echo $_GET['item']?>";
							document.cookie = "id_mau_sp<?php echo $sl_sp_mua?>="+data1;
							document.cookie = "id_size_sp<?php echo $sl_sp_mua?>="+data2;
							document.cookie = "cookie_sl<?php echo $sl_sp_mua?>=1";
							}
						function set_on_off(name_on_off){ 
								var number=name_on_off.substring(6,11);
								var text=name_on_off.substring(0,6);
								var dk=eval(text+'['+number+']');
								var A_B=name_on_off.substring(5,6);
								if(A_B=='A'){
									if(dk==0){
										onoffA[number]=1;
										document.getElementById(name_on_off).style.display='block';
			
									}
									else if(dk==1){
										onoffA[number]=0;
										document.getElementById(name_on_off).style.display='none';									
		
									}
								}
								else if(A_B=='B'){
									if(dk==0){
										onoffB[number]=1;
										document.getElementById(name_on_off).style.display='block';
			
									}
									else if(dk==1){
										onoffB[number]=0;
										document.getElementById(name_on_off).style.display='none';									
		
									}
								}
							}

                </script>
                <div class="clr"></div>
                </div>
        <div class="add_giohang" onclick="save_data(); window.location='check_out.php'">CHO VÀO GIỎ HÀNG</div>    
    </section>
    <div class="clr"></div>
</article>
<article id="link_sanpham">
    <nav class="like">
	    <div class="like_text">SẢN PHẨM CÓ THỂ BẠN SẼ THÍCH</div>
        <div class="next_prev_big">
			<div style="float:left; cursor:pointer;" id="prev2"><img src="images/icon/prev_big.png" alt="" /></div>
        	<div style="float:right; cursor:pointer;" id="next2"><img src="images/icon/next_big.png" alt="" /></div>
        </div>
        <div style="margin-left:25px;">
			<?php
			$sl_anh_show2=1;
            $sql = "SELECT * FROM `donhang` ORDER BY `date` DESC LIMIT 0,20";
			$result = mysql_query($sql, $connection);
			while ($row = mysql_fetch_array($result)){
				$array_daxem=explode('-',$row['id_sp']);
				$table_daxem=$array_daxem[0];
				$id_daxem=$array_daxem[1];	
				
			?>
				<a href="chitiet.php?item=<?php echo $item_daxem;?>"><div style="overflow:hidden;" id="slide2<?php echo $sl_anh_show2?>" class="like_img"><img height="200px" width="200px" src="images/product/<?php if($table_daxem=='sp') echo 'shoes'; else echo 'other';?>/<?php echo $id_daxem?>_1.jpg" alt="" /></div></a>
            <?php $sl_anh_show2++;
			}?>
            <input type="hidden" id="slide_img2" value="<?php echo $sl_anh_show2 ?>"/>
            <div class="clr"></div>
        </div>
        <div class="like_nuttron">
			<span>&#149;</span><span>&#149;</span><span>&#149;</span><span>&#149;</span><span>&#149;</span>
        </div>   	
    </nav>
    <nav class="like">
	    <div class="like_text">SẢN PHẨM BẠN ĐÃ XEM</div>
        <div class="next_prev_big">
			<div style="float:left; cursor:pointer;" id="prev"><img src="images/icon/prev_big.png" alt="" /></div>
        	<div style="float:right; cursor:pointer;" id="next"><img src="images/icon/next_big.png" alt="" /></div>
        </div>
        <div style="margin-left:35px; height:230px; overflow:hidden;" id="group_slide">
        	<?php 
			if($_COOKIE['spdaxem']){
				$sp_daxem = explode('/',$_COOKIE['spdaxem']);
				$sp_daxem= array_unique( $sp_daxem );
				unset($_COOKIE['spdaxem']);
				$new_cokie=implode('/',$sp_daxem);
				$sl_anh_show=0;
				foreach($sp_daxem as $item_daxem){
					$sl_anh_show++;
					$array_daxem=explode('-',$item_daxem);
					$table_daxem=$array_daxem[0];
					$id_daxem=$array_daxem[1];
					?>
					<a href="chitiet.php?item=<?php echo $item_daxem;?>"><div style="overflow:hidden;" id="slide<?php echo $sl_anh_show?>" class="like_img"><img height="200px" width="200px" src="images/product/<?php if($table_daxem=='sp') echo 'shoes'; else echo 'other';?>/<?php echo $id_daxem?>_1.jpg" alt="" /></div></a>
				<?php 
					if($sl_anh_show==20) break;
					}
			}?>
            <input type="hidden" id="slide_img" value="<?php echo $sl_anh_show ?>"/>
            <div class="clr"></div>
        </div>
        <div class="like_nuttron">
			<span>&#149;</span><span>&#149;</span><span>&#149;</span><span>&#149;</span><span>&#149;</span>
        </div>
    </nav>
    <div class="clr"></div>
</article>
<script>
function show(div){
	document.getElementById(div).style.display='block';
	var img =eval('document.getElementById("'+div+'_img")');
	img.src='images/icon/down.png';
}
document.cookie="spdaxem=<?php if($new_cokie) echo $new_cokie.'/'.$_GET['item']; else echo $new_cokie;?>"

</script>
<?php
}
include_once('footer.php')?>