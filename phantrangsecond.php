        <p onclick="window.location='<?php  echo $url.'?page=1'?>'">Đầu tiên</p>
		<p id="page_group"></p>
		<p onclick="next_page()"><img src="images/icon/next_nav.jpg" alt="" style="margin:2px 0 -1px 0" /></p>

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
		for(var i=start_group ; i< end_group ; i++){
			if(i==<?php echo $_GET['page']?>) var hover='_hover';<!--Set hover of page show -->
				else hover='';
			div_page+='<p id="page_group" onclick="window.location=\'<?php echo $url.'?page=';?>'+i+'<?php if($url2 !=NULL) echo $url2;?>\'">'+i+'</p>';
		}
		document.getElementById("page_group").innerHTML=div_page;
	}


</script>