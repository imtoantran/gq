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
jQuery(document).ready(function($) {
	slide();
});
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