$("#video").Watermark("Only Valid Youtube Links will be Accepted:");

$('a').live("click",function(){
	var href=$(this).attr('href');
	if(href!='' && href!='#' && href!=undefined){
	window.scroll(0,0);	
	}
});

$("#button").live("click",function() {
$('.error').hide();
var fname = $("input#fname").val();
if (fname == "") {
$("label#fname_error").show();
$("input#fname").focus();
return false;
}
if(fname.match(/[\(\)\<\>\,\;\:\\\"\[\]]/))
{
$("label#fname_error1").show();
$("input#fname").focus();
return false;	
}
var lname = $("input#lname").val();
if (lname == "") {
$("label#lname_error").show();
$("input#lname").focus();
return false;
}
if(lname.match(/[\(\)\<\>\,\;\:\\\"\[\]]/))
{
$("label#lname_error1").show();
$("input#lname").focus();
return false;	
}
var email = $("input#emaill").val();
if (email == "") {
$("label#email_error").show();
$("input#emaill").focus();
return false;
}
if(email.match(/[\(\)\<\>\,\;\:\\\"\[\]]/))
{
$("label#email_error1").show();
$("input#emaill").focus();
return false;	
}
if(!email.match(/^[^@]+@[^@.]+\.[^@]*\w\w$/))
{
$("label#email_error2").show();
$("input#emaill").focus();
return false;	
}	
var pass = $("input#passs").val();
if (pass == "") {
$("label#pass_error").show();
$("input#passs").focus();
return false;
}	
var pass2 = $("input#passs2").val();
if (pass2 != pass) {
$("label#pass2_error").show();
$("input#passs2").focus();
return false;
}		
var captcha = $("input#captcha").val();
if (captcha == "") {
$("label#captcha_error").show();
$("input#captcha").focus();
return false;
}	
var dataString ='fname='+fname+'&lname='+lname+'&email='+email+'&pass='+pass+'&captcha='+captcha;
$('#button').css("display","none");
$('#loaderr').css("display","inherit");
$.ajax({
type: "POST",
url: "bin/signup.php",
data: dataString,
success: function(html) {
$('.register').html(html); 
document.getElementById('fname').value='';
document.getElementById('lname').value='';
document.getElementById('emaill').value='';
document.getElementById('passs').value='';
document.getElementById('passs2').value='';
document.getElementById('captcha').value='';		      
$('#loaderr').css("display","none");
$('#button').css("display","inherit");
}});
return false;
});


	var c=1;
	var i=1;var k;
	var j=0;
	var cache=[],page=[];
	
$(document).ready(function(){
var recentHash = ""; 
var loader=setInterval(function pollHash() {
if (window.location.hash==recentHash) {
return;
}
recentHash = window.location.hash;
var r=recentHash.slice(3,recentHash.length);
if(r!="")
{
	for(k=0;k<=i;k++){
		if(r==page[k]){
j=5;
z=k;			
		}
	}
	if(j==5){
$('.content1').html(cache[z]);
$.ajax({
url: r,
success: function(html){
	if(html!=cache[z]){
$('.content1').html(html);
cache[z]=html;
page[z]=r;
	j=0;
	}
}
});		
	}
	else if(j==0){
	c=1;
$('.content1').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=6px style=margin-bottom:2px></div></center>');
$.ajax({
url: r,
success: function(html){
$('.content1').html(html);
cache[i]=html;
page[i]=r;
i++;
	
}
});
	}
}
},10);
});
		
$(".frequest").live("click",function(){
var element = $(this);
var I = element.attr("name");
var type = element.attr("id");
if(type=='accept'){
$(".accepted"+I).fadeOut("slow");
$.ajax({
type: "POST",
url: "request.php",
data: "frequest="+I,
cache: false,
success: function(html){
}});}
if(type=='decline'){
$(".accepted"+I).fadeOut("slow");
$.ajax({
type: "POST",
url: "request.php",
data: "frequest_decline="+I,
cache: false,
success: function(html){}});}});

$(".trequest").live("click",function(){
var element = $(this);
var I = element.attr("name");
$.ajax({
type: "POST",
url: "request.php",
data: "trequest="+I,
cache: false,
success: function(html){
$("#trequest"+I).fadeOut("slow");}});});

$(".comment_buttonef").live("click",function(){
var element = $(this);
var I = element.attr("id");
$("#slidepanel"+I).fadeIn("slow");
$('#textboxcontent'+I).focus();
return false;});

$(".comment_input").live("keyup",function(e){
	
var Id = $(this).attr("name");
var Id2 =$('.comment_hidden'+Id).attr("id");
var describe =$('.comment_category'+Id).attr("id");
var test = $("#textboxcontent"+Id).val();
if(test.length>80)
{
$(this).css('height','45px');	
}

test=test.slice(0,(test.length-1));
test2=test.slice(0,1);		
var unicode=e.keyCode? e.keyCode : e.charCode;
if (unicode == 220) { 
document.getElementById('textboxcontent'+Id).value=test+"\n";
$(this).css('height','45px');
}
if(test.length>160)
{
alert('word limit exceded');	
}else{
if (unicode == 13) { 
if(test=='' ||  test2=='\n')
{
document.getElementById('textboxcontent'+Id).value='';
}

else{
var dataString = 'textcontent='+ test + '&com_msgid=' + Id +'&com_msgid2=' + Id2+'&describe='+describe;
$("#main_comment_box"+Id).append('<div class="comment_loading'+Id+'" style="float:left;width:100%" align="center">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div>');
document.getElementById('textboxcontent'+Id).value='';
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$(".comment_loading"+Id).html('');
$("#main_comment_box"+Id).append(html);
element.css('height','16px');
}});}}}return false;});

$("#older").live("click",function(){
	var c1=parseInt(c);
var element = $(this);
$(this).html('Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px>');
var datas= "c="+ c;	
$.ajax({
type: "POST",
url: "request.php",
data: datas,
cache: false,
success: function(html){
$(".old_updates").append(html);
$('.'+c1).css('display','none');
}});
c++;});

$(".love").live("click",function() 
{
var id = $(this).attr("id");
var id2 = $(this).attr("name");
$(this).html('Thanx for Voting');
var parent = $('.comment_category'+id).attr('id');
var dataString = 'vote='+ id +'&upid=' +id2+'&vote_describe='+parent;
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html)
{
$('#votes'+id).html(html);
}});return false;});
 
 $(".lover").live("click",function() 
{
var id = $(this).attr("id");
var id2 = $(this).attr("name");
var id3 = $(this).attr("title");
var dataString = 'share_upid='+ id +'&share_uid=' +id2+'&share_describe='+id3;
if(Boxy.confirm("Share with Buddies?",function() {
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$(this).html('This '+id3+' has been shared');
} });},{title: "Confimation"}));return false;});
var refreshId = setInterval(function(){	 
$('.chatrefresh').load('ctest.php');
$('.alert_box').load('alerts.php');
var more_updates=$('.more_updater').attr('id');
var more_type=$('.more_updater').attr('name');
if(more_type=='mn'){
$.ajax({
type: "POST",
url: "request.php",
data: 'more_updates='+more_updates,
cache: false,
success: function(html){
$('.old_updates').prepend(html).fadeIn('fast');
}
});
}
$.ajax({
type: "POST",
url: "request.php",
data: 'alert_num=0',
cache: false,
success: function(html){
$('.alert_num').html(html);
}
});
},14000);

$(".comment_button").live("click",function() {
var element = $(this);
function text_to_link(text) {
var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
return text.replace(exp,"<a href='$1' target='_blank'>$1</a>");}
var boxval = $("#content").val();	
var dataString = 'content='+ boxval;	
if(boxval==''){
Boxy.alert("Please Enter some text",null, {title: "Error"});
}else{
document.getElementById('content').value='Wait while your thought is being shared';
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$('.old_updates').prepend(html);
document.getElementById('content').value='';}});}return false;});

$('.delete_update').live("click",function(){
var ID = $(this).attr("id");
var dataString = 'msg_id='+ ID;
if(Boxy.confirm("Delete this update?",function() {
$(".bar"+ID).fadeOut("fast");
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
}});},{title: "Confirmation"}));});

$('.delete_sugg').live("click",function(){
var ID = $(this).attr("id");
$('#sugg_name'+ID).fadeOut('fast');
});

$('.delete_comment').live("click",function() {
var ID = $(this).attr("id");
var ID2 = $(this).attr("name");
var dataString = 'msg_id2='+ ID +'&msg_upid=' +ID2;
if(Boxy.confirm("Delete this comment?",function() {
 $("#comment_load"+ID).fadeOut('fast');
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
}});},{title: "Confirmation"}));});

$('.delete_video').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'video_id='+ ID; 
if(Boxy.confirm("Delete this comment?",function() {
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$("#videos"+ID).slideUp('medium');
}});}));});

$('.vid_submit').live("click",function()  
{
var video = $('#video').val();
var dataString = 'video='+ video;
$('.vid_submit').css('display','none');
$('.help_loader').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>'); 
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$('.video_load').html(html);
document.getElementById('video').value='';
$('.vid_submit').css('display','inherit');
$('.google').load('update_delete.php');
}});});

$('.link_submit').live("click",function()  
{
var wlink = $('#web_link').val();
var dataString = 'wlink='+ wlink;
var exp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
if(!wlink.match(exp)){
Boxy.alert("Enter a valid URL",null, {title: "Error"});
}
else{
$('.link_submit').css('display','none');
$('.help_loader').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>');	 
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
document.getElementById('web_link').value='http://';
$('.old_updates').prepend(html);
$('.help_loader').html('');
$('.link_submit').css('display','block');
}});}});

$('#album_submit').live("click",function() 
{
var video = $('#album_name').val();
var dataString = 'album_name='+ video;	
if(video=='Create New Album')
{
Boxy.alert("Please Enter a Name",null, {title: "Error"});
} 
else if(video.length>40)
{
Boxy.alert("Length too large",null, {title: "Error"});
} 
else{
$('#album_submit').css("display","none");
document.getElementById('album_name').value='';
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$('#album_submit').css("display","inherit");
window.location.href="#!/album.php?v=0";
}});}return false;});

$('.thButton').live("click",function() 
{
var email = $('#email').val();
var pass = $('#pass').val();
var provider = $('#provider').val();
var step=$('#step').val();
var dataString = 'email_box='+ email+'&password_box='+pass+ '&provider_box='+provider+'&step='+step; 
$('.invites').html('<center><img src=loader2.gif style=margin-top:50px></center>');
$.ajax({
type: "POST",
url: "invited/index.php",
data: dataString,
cache: false,
success: function(html){
$('.content1').html(html);
$('.invited2').load('invited/index.php'); 
}});return false;});

$(".todo").live("click",function(){ 
var val = $(this).attr("id");
if(val==11)
{
$('.update_box').html("<textarea name=content id=content maxlength=1024></textarea><br /><input type=submit  value=Update  id=v1 name=submit class=comment_button />");		
$('#content').focus();	
}
if(val==13)
{
$('.update_box').html("<input type=text id=video /><input type=submit class=vid_submit id=v1 value=Attach />&nbsp;<div class=video_load ></div>");
$("#video").Watermark("Only Valid Youtube Links will be Accepted:");
}
if(val==12)
{
$('.update_box').html('<input type="text" id="web_link" /><input type="submit" class="link_submit" id="v1" value="Attach" /><div class="link_load" ></div>');
$("#web_link").Watermark("http://");
}
if(val==14)
{
$('.update_box').html('<input type="text" id="google_search" /><input type=submit id="google_submit" class=v>');
$("#google_search").Watermark("Google Search:");
}
if(val==15)
{
$('.update_box').html('<input type="text" id="torrent_search" /><input type="submit" id="torrent_submit" class=v /> ');
$("#torrent_search").Watermark("Torrent Search:");
}});

$(".request").live("click",function(){
var element = $(this);
var I = element.attr("id");
if(Boxy.confirm("<b>Are you sure you want to be buddies</b>?",function() {
	$(".req").html('Your request has been sent. Wait for response from the other side');
$("#sugg"+I).html('<font color="#666">Buddy Request Sent</font>');
setTimeout(function(){
$('#sugg_name'+I).fadeOut('slow');
},1000);
$.ajax({
type: "POST",
url: 'request.php',
data: 'uider='+I+'&ser=2',
cache: false,
success: function(html){	  
  }});
  },{title: "Confirmation"}));
  });
  

$('#message_submit').live("click",function() 
{
var message_subject = $('#message_subject').val();
var message_message = $('#message_message').val();
var element = $(this);
var message_to = element.attr("name");
var dataString = 'message_subject='+message_subject+'&message_message='+message_message+'&message_to='+message_to;
 
$('.message_send').html('Message Sent');
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
 }});return false;});

$('.message_reply').live("click",function() 
{
var mid= $(this).attr('id');	
$(this).html('<textarea style="width:500px; height:30px" id="message_reply2'+mid+'" class="message_reply2" name="'+mid+'"></textarea><div style="font-size:9px">Press enter to send message</div><br>');
$('#message_reply2'+mid).focus();
});

$('.message_reply2').live("keyup",function(e) 
{
var mid= $(this).attr('name');	
var test = $(this).val();
if(test.length>80)
{
$(this).css('height','40px');	
}
if(test.length>200)
{
alert('word limit exceded');	
}
test=test.slice(0,(test.length-1));
test2=test.slice(0,1);		
var unicode=e.keyCode? e.keyCode : e.charCode   		 					 
if (unicode == 13) { 
if(test=='' ||  test2=='\n')
{
document.getElementById('message_reply2'+mid).value='';
}
else{
var dataString = 'mid='+ mid+'&mid_value='+test;
document.getElementById('message_reply2'+mid).value='';
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$("#message_reply_response"+mid).append(html);
}});}}});

$('#latest_updates').live("click",function() 
{
$('.google').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>').load('update_delete.php');
});

function bgpos(left,top) {
$("#starBlue").css("background-position",(left + "px " + top + "px"));
}

 function bgpos2(val,which) {
uid=$(which).attr("id");
$.ajax({
type: "POST",
url: "request.php",
data: 'rating='+ val+'&uid2='+uid,
cache: false,
success: function(html){
}
});
if($(which).attr("src") == "smileys/star.gif") {
$(which).attr("src","smileys/star_blue.gif");
$(which).prevAll().attr("src","smileys/star_blue.gif");
}
else { 
$(which).attr("src","smileys/star.gif");
$(which).nextAll().attr("src","smileys/star.gif");
}}

$('#google_submit').live("click",function()
{
var google_search = $('#google_search').val();
window.location.href="#!/search.php?g="+google_search;
});
 
$('.alerts').live("click",function()
{
var alert_id = $(this).attr('id');
$('#'+alert_id).css('background-color','white');
dataString='alert_id='+alert_id;
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){}}); });

$('.alerts_open').live("click",function()
{
var alert_id = $(this).attr('id');
$('#'+alert_id).css('background-color','white');
dataString='alert_id='+alert_id;
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){}}); });
  
$('#torrent_submit').live("click",function()
{
$('#torrent_submit').css('display','none');
$('.help_loader').prepend('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>');
var torrent_search = $('#torrent_search').val();
dataString='torrent_search='+torrent_search;
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$('.google').html(html);
$('#torrent_submit').css('display','inherit');}});});
 
function torrent_share(torrent_link){	
if(confirm("Share with Buddies?"))
{ 
dataString='torrent_share_link='+torrent_link;
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){}});}}

$('#place_coord').live("click",function()
{
$('.help_loader').html('<center><div class="final_loader">Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px></div></center>');
var geo = google.gears.factory.create('beta.geolocation');
function updatePosition(position) {
dataString= 'place_coord='+position.latitude + ',' + position.longitude;
$.ajax({
type: "POST",
url: "request.php",
data: dataString,
cache: false,
success: function(html){
$('.google').load('update_delete.php');
}});}

function handleError(positionError) {
alert('Could not get a fixed position.');
$('.help_loader').html('');
}

geo.getCurrentPosition(updatePosition, handleError);
});
	
$('.album_pic_add').live("click",function()
{
var album_id=$(this).attr('id');
var user_id=$(this).attr('name');
$('.album_pic_adder'+album_id).css("display","block");	
});
	
$('.view_all').live("click",function()
{
var upid=$(this).attr('id');
var uuid=$('.comment_hidden'+upid).attr('id');
var view_describe=$('.comment_category'+upid).attr('id');
$.ajax({
type: "POST",
url: "request.php",
data: 'view_upid='+upid+'&view_uuid='+uuid+'&view_describe='+view_describe,
cache: false,
success: function(html){
$('#all_comment'+upid).html(html);
}});});

$('.buddy_remove').live("click",function()
{
var remove_buddy=$(this).attr('id');
if(Boxy.confirm("Remove from your Buddy List ?",function() {
	$('#remove_bud'+remove_buddy).fadeOut('fast');	
$.ajax({
type: "POST",
url: "request.php",
data: 'remove_buddy='+remove_buddy,
cache: false,
success: function(html){
}});},{title: "Confimation"}));});
	
function chatonline(uid){
$.ajax({
type: "POST",
url: "request.php",
data: 'chatonline_uid='+uid,
cache: false,
success: function(html){}});}
	
function chatoffline(uid){
$.ajax({
type: "POST",
url: "request.php",
data: 'chatoffline_uid='+uid,
cache: false,
success: function(html){
}});}


$('.more_updates_click').live("click",function()
{
$(this).hide();
var more_id=$(this).attr('id');
var add_id=$(this).attr('name');
var val_id=$(this).attr('value');
for(var i=1;i<=add_id;i++)
{
$('.'+more_id+i+val_id).fadeIn('slow');	
}
});

$(window).scroll(function () {
if ($(window).height() + $(window).scrollTop() == $(document).height()) {
	var c1=parseInt(c);
	var c2=$('.more_updater').attr('name');
	if(c2=='main'){
	$('.'+c1).html('Loading&nbsp;&nbsp;<img src=loader2.gif width=30px height=3px style=margin-bottom:2px>');
var datas= "c="+ c;	
$.ajax({
type: "POST",
url: "request.php",
data: datas,
cache: false,
success: function(html){
$(".old_updates").append(html);
$('.'+c1).css('display','none');;
}});
c++;
	}
}
});

$('.ialerts_click').live("click",function(){
	$('.right_toggle').toggle();
	
});
$('.ibuddy_click').live("click",function(){
	$('.right_toggle2').toggle();
});

$('.yoyo').live("click",function(){
	var upid=$(this).attr('name');
$('#video_thumbnail'+upid).hide();
$('#video_video'+upid).show();
	
	
});
