<?php


/*
#######################################
#     e107 website system plguin      #
#     AACGC Popup Box                 #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/

$popup_text .='<script type="text/javascript">


var ns4=document.layers
var ie4=document.all
var ns6=document.getElementById&&!document.all
var dragswitch=0
var nsx
var nsy
var nstemp

function drag_dropns(name){
if (!ns4)
return
temp=eval(name)
temp.captureEvents(Event.MOUSEDOWN | Event.MOUSEUP)
temp.onmousedown=gons
temp.onmousemove=dragns
temp.onmouseup=stopns}

function gons(e){
temp.captureEvents(Event.MOUSEMOVE)
nsx=e.x
nsy=e.y}
function dragns(e){
if (dragswitch==1){
temp.moveBy(e.x-nsx,e.y-nsy)
return false}}

function stopns(){temp.releaseEvents(Event.MOUSEMOVE)}

function drag_drop(e){
if (ie4&&dragapproved){
crossobj.style.left=tempx+event.clientX-offsetx
crossobj.style.top=tempy+event.clientY-offsety
return false}
else if (ns6&&dragapproved){
crossobj.style.left=tempx+e.clientX-offsetx+"px"
crossobj.style.top=tempy+e.clientY-offsety+"px"
return false}}

function initializedrag(e){
crossobj=ns6? document.getElementById("showimage") : document.all.showimage
var firedobj=ns6? e.target : event.srcElement
var topelement=ns6? "html" : document.compatMode && document.compatMode!="BackCompat"? "documentElement" : "body"
while (firedobj.tagName!=topelement.toUpperCase() && firedobj.id!="dragbar"){
firedobj=ns6? firedobj.parentNode : firedobj.parentElement}

if (firedobj.id=="dragbar"){
offsetx=ie4? event.clientX : e.clientX
offsety=ie4? event.clientY : e.clientY

tempx=parseInt(crossobj.style.left)
tempy=parseInt(crossobj.style.top)

dragapproved=true
document.onmousemove=drag_drop}}
document.onmouseup=new Function("dragapproved=false")


function hidebox(){
crossobj=ns6? document.getElementById("showimage") : document.all.showimage
if (ie4||ns6)
crossobj.style.visibility="hidden"
else if (ns4)
document.showimage.visibility="hide"}

</script>';


//-----------------------------------------------------------------------

if ($pref['popupbox_alttables'] == "1"){
$themea = "forumheader3";
$themeb = "indent";}
else
{$themea = "";
$themeb = "";}

if (USER){
$popupboxtitle = "".$pref['popupbox_title']."";
$popupboxdetails = "".$pref['popupbox_details']."";}
else
{$popupboxtitle = "".$pref['popupbox_titleguest']."";
$popupboxdetails = "".$pref['popupbox_detailsguest']."";}


if ($pref['popupbox_usermessage'] == "1"){
$sql3 = new db;
$sql3->db_Select("user", "*", "WHERE user_id='".USERID."'","");
$row3 = $sql3->db_Fetch();
if ($row3['user_class'] == "".$pref['popupbox_userclassa'].""){
$popupboxtitle = "".$pref['popupbox_titlea']."";
$popupboxdetails = "".$pref['popupbox_detailsa']."";}}

if ($pref['popupbox_usermessageb'] == "1"){
$sql4 = new db;
$sql4->db_Select("user", "*", "WHERE user_id='".USERID."'","");
$row4 = $sql4->db_Fetch();
if ($row4['user_class'] == "".$pref['popupbox_userclassb'].""){
$popupboxtitle = "".$pref['popupbox_titleb']."";
$popupboxdetails = "".$pref['popupbox_detailsb']."";}}

if ($pref['popupbox_adminmessage'] == "1"){
if (ADMIN){
$popupboxtitle = "".$pref['popupbox_titleadmin']."";
$popupboxdetails = "".$pref['popupbox_detailsadmin']."";}}

//----------------------------------------------------------------------

$popup_text .= "
<div id='showimage' style='position:absolute;width:250px;left:".$pref['popupbox_locationside']."px;top:".$pref['popupbox_locationtop']."px'>
<table border='0' width='250' bgcolor='#000000' cellspacing='0' cellpadding='2'><tr>
<td width='100%'>";

$popup_text .= "
<table border='".$pref['popupbox_border']."' bordercolor='#".$pref['popupbox_bordercolor']."' width='100%' cellspacing='0' cellpadding='0' height='36px'>
<tr>

<td id='dragbar' style='cursor:hand; cursor:pointer' width='100%' onMousedown='initializedrag(event)' class='".$themea."'>
<ilayer width='100%' onSelectStart='return false'>
<layer width='100%' onMouseover='dragswitch=1;if (ns4) drag_dropns(showimage)' onMouseout='dragswitch=0'>
<font face='Verdana' color='#".$pref['popupbox_titlefcolor']."' size='".$pref['popupbox_titlefsize']." '><strong>".$popupboxtitle."</strong></font>
</layer>
</ilayer>
</td>

<td style='cursor:hand' class='".$themeb."'>
<a href='#' onClick='hidebox();return false'><img src='".e_PLUGIN."aacgc_popup_box/images/close.png' alt='Close This Box' width='20px'></a>
</td>

</tr>
<tr>

<td width='100%' bgcolor='#".$pref['popupbox_dbgcolor']."' style='padding:4px' colspan='2' class='".$themeb."'>
<font color='#".$pref['popupbox_detailsfcolor']."' size='".$pref['popupbox_detailsfsize']."'>
".$popupboxdetails."
</font></td>
      
</tr>";


if ($pref['popupbox_imagesection'] == "1"){

if ($pref['popupbox_imagelinka'] == "")
{$imagea = "".e_PLUGIN."aacgc_popup_box/images/blank.png";}
else
{$imagea = "".$pref['popupbox_imagelinka']."";}
if ($pref['popupbox_imagelinkb'] == "")
{$imageb = "".e_PLUGIN."aacgc_popup_box/images/blank.png";}
else
{$imageb = "".$pref['popupbox_imagelinkb']."";}

$popup_text .= "<tr><td class='".$themeb."' colspan=2>
<div width='50%'><center><img src='".$imagea."' width='".$pref['popupbox_imgwa']."', height='".$pref['popupbox_imgha']."'></img></center></div>
<div width='50%'><center><img src='".$imageb."' width='".$pref['popupbox_imgwb']."', height='".$pref['popupbox_imghb']."'></img></center></div>
</td>
</tr>";}


$popup_text .= "
</table>
</td>
</tr></table>

</div>";


print $popup_text;

?>

