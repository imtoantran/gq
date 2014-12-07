<?php 
	$danhmucphukien = $db->query("SELECT * FROM mucpk");
	$activated_dmpk = $_GET['muc'];
	foreach ($danhmucphukien as $key => $value) {
		print '<li'.(($activated_dmpk==$value['id'])?' class="active"':'').'><a href="other.php?muc='.$value['id'].'&#show_sp">'.$value['mucloai'].'</a></li>';
	}
?>