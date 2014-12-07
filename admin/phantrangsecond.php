<div style="position:relative; margin:20px 162px 0 0; color:#fff; height:33px;">
	<p class="style_hover" style="float: right; width:60px;height:33px; background:#e34929; padding:8px 0 0 0 ; margin-top:5px; text-align:center" onclick="next_page()">NEXT</p>
		<div id="page_group" style="margin: 0 5px 0 0"></div>
	<p class="style_hover" style=" float: right; width:60px;height:33px; background:#e34929; padding:8px 0 0 0 ; margin:5px 5px 0 0; text-align:center" onclick="prev_page()">FIST</p><!---	số trang sẽ hiển thị tự động trong div id:page_group. nội dung được set trong code java dưới cùng -->

</div>

<script>
		var group_view=<?php 		
		if($_GET['page']%$page_of_group!=0)
			if($_GET['page']%$page_of_group!=1)
				echo ((($_GET['page']-(($_GET['page'])%($page_of_group)))/($page_of_group))+1);
			else echo ((($_GET['page']-(($_GET['page'])%($page_of_group)))/($page_of_group)));
		
		else echo ($_GET['page'] / $page_of_group);				
		?>;
		if(group_view><?php echo $total_group ?>)group_view=<?php echo $total_group ?>;
		if(group_view <=0) group_view=1 ;
				
		set_group_page();
	
		function prev_page(){
			window.location='<?php  echo $url.'?page=';
									if($page_view>1) echo $page_view-1; else echo $page_view;
									if($url2 !=NULL) echo $url2;
									?>';
									
		}
		function next_page(){
			window.location='<?php  echo $url.'?page='; 
									if($page_view<($total_page)) echo $page_view+1;else echo $page_view;
									if($url2 !=NULL) echo $url2;
									?>';
		}
		function fist_group(){
			group_view=1;set_group_page();
			set_group_page();
		}
		function last_group(){
			group_view=<?php echo $total_group -1?>;
			set_group_page();
		}
		
		
		function prev_group_page(){
			if(group_view>1){
				group_view--;
				set_group_page();
			}
		}		
		function next_group_page(){	
			if(group_view<(<?php echo $total_group -1?>)){		
				group_view++;
				set_group_page();
			}
		}	
	function set_group_page(){
		var div_page="";
		var hover='';
		var start_group=((group_view-1)*<?php echo $page_of_group ?>+1);		
		var end_group= start_group+ <?php echo $page_of_group + $temp_page_of_group?>;
		if(end_group > <?php echo $total_page?>) end_group=(<?php echo $total_page?>+1);
		for(i=(end_group-1) ; i>=start_group ; i--){
			if(i==<?php echo $_GET['page']?>) var hover='_hover';<!--Set hover of page show -->
				else hover='';
			div_page+='<p class="style_hover" style="float:right;width:35px; height:33px; background:#e34929; padding:8px 0 0 10px ; margin:5px 5px 0 0" onclick="window.location=\'<?php echo $url.'?page=';?>'+i+'<?php if($url2 !=NULL) echo $url2;?>\'">'+i+'</p>';
		}
		document.getElementById("page_group").innerHTML=div_page;
	}


</script>