<?php	    if($_GET['page']==NULL) $_GET['page']=1;			
		//Tìm tổng số trang;
			if($total_item<1){
				$page_view = $_GET['page'];
				$start_item_view=0;
				$end_item_view=0;	
				$total_page=1;
				$total_group=1;
			}
			else {
				if($total_item % $item_of_page == 0) { 
					if($total_item == 0) $total_page = 0; 
					else $total_page=$total_item / $item_of_page;
				}
				else $total_page=((($total_item-($total_item%$item_of_page))/$item_of_page)+1);
		//Set đk vòng lặp FOR
				$page_view = $_GET['page'];							
				$start_item_view=(($page_view-1)*$item_of_page)+1;
				$end_item_view=$item_of_page+$start_item_view;			
				if($page_view==$total_page) {
				if($total_item % $item_of_page!=0) $end_item_view=$start_item_view+$total_item%$item_of_page;
				}				
		//Set Group view
				if($total_page % $page_of_group==0){
					if($total_page==0) $total_group=0;
					else $total_group=$total_page / $page_of_group;
				}
				else $total_group=((($total_page-($total_page % $page_of_group))/$page_of_group )+1);			
			}
			