<?php

/*
#######################################
#     e107 website system plguin      #
#     AACGC Popup Box                 #    
#     by M@CH!N3                      #
#     http://www.AACGC.com            #
#######################################
*/


require_once("../../class2.php");
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
} 
require_once(e_ADMIN . "auth.php");
require_once(e_HANDLER . "userclass_class.php");


if (isset($_POST['update']))
{ 
    $pref['popupbox_titlefsize'] = $_POST['popupbox_titlefsize'];
    $pref['popupbox_titlefcolor'] = $_POST['popupbox_titlefcolor'];
    $pref['popupbox_tbgcolor'] = $_POST['popupbox_tbgcolor'];


    $pref['popupbox_detailsfsize'] = $_POST['popupbox_detailsfsize'];
    $pref['popupbox_detailsfcolor'] = $_POST['popupbox_detailsfcolor'];
    $pref['popupbox_dbgcolor'] = $_POST['popupbox_dbgcolor'];



    $pref['popupbox_width'] = $_POST['popupbox_width'];
    $pref['popupbox_height'] = $_POST['popupbox_height'];
    $pref['popupbox_border'] = $_POST['popupbox_border'];
    $pref['popupbox_bordercolor'] = $_POST['popupbox_bordercolor'];

    $pref['popupbox_locationtop'] = $_POST['popupbox_locationtop'];
    $pref['popupbox_locationside'] = $_POST['popupbox_locationside'];

    $pref['popupbox_imagelinka'] = $_POST['popupbox_imagelinka'];
    $pref['popupbox_imgwa'] = $_POST['popupbox_imgwa'];
    $pref['popupbox_imgha'] = $_POST['popupbox_imgha'];
    $pref['popupbox_imagelinkb'] = $_POST['popupbox_imagelinkb'];
    $pref['popupbox_imgwb'] = $_POST['popupbox_imgwb'];
    $pref['popupbox_imghb'] = $_POST['popupbox_imghb'];



if (isset($_POST['popupbox_alttables'])) 
{$pref['popupbox_alttables'] = 1;}
else
{$pref['popupbox_alttables'] = 0;}

if (isset($_POST['popupbox_imagesection'])) 
{$pref['popupbox_imagesection'] = 1;}
else
{$pref['popupbox_imagesection'] = 0;}


    save_prefs();

$popup_msgtext = "Settings Saved";
}


//--------------------------------------------------------------------


$popup_text .= "<form method='post' action='".e_SELF."' id='popupform'>
<table class='fborder' width='100%'><tr>";



//-------------------------------# Box #-----------------------------------
$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>Box Settings</b></td>
</tr>";

/*
$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3'>Box Height:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_height' value='" . $pref['popupbox_height'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Box Width:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_width' value='" . $pref['popupbox_width'] . "' /></td>
</tr>";
*/

$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3'>Border Size:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_border' value='" . $pref['popupbox_border'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Border Color:</td>
<td style='width:70%' class='forumheader3'>#<input class='tbox' type='text'  size='15' name='popupbox_bordercolor' value='" . $pref['popupbox_bordercolor'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Distance From Top:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_locationtop' value='" . $pref['popupbox_locationtop'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Distance From Side:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_locationside' value='" . $pref['popupbox_locationside'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Use Website Theme For Popup:</td>
<td colspan=2 class='forumheader3'>".($pref['popupbox_alttables'] == 1 ? "<input type='checkbox' name='popupbox_alttables' value='1' checked='checked' />" : "<input type='checkbox' name='popupbox_alttables' value='0' />")." (If enabled, title and detail background color options do not apply)</td>
</tr>
";

//-------------------------------# Title #-----------------------------------
$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>Title Settings</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Title Font Size:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_titlefsize' value='" . $pref['popupbox_titlefsize'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Title Font Color:</td>
<td style='width:70%' class='forumheader3'>#<input class='tbox' type='text'  size='15' name='popupbox_titlefcolor' value='" . $pref['popupbox_titlefcolor'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Title Background Color:</td>
<td style='width:70%' class='forumheader3'>#<input class='tbox' type='text'  size='15' name='popupbox_tbgcolor' value='" . $pref['popupbox_tbgcolor'] . "' /></td>
</tr>
";

//-------------------------------# Details #-----------------------------------
$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>Detail Settings</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Detail Font Size:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_detailsfsize' value='" . $pref['popupbox_detailsfsize'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Detail Font Color:</td>
<td style='width:70%' class='forumheader3'>#<input class='tbox' type='text'  size='15' name='popupbox_detailsfcolor' value='" . $pref['popupbox_detailsfcolor'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Detail Background Color:</td>
<td style='width:70%' class='forumheader3'>#<input class='tbox' type='text'  size='15' name='popupbox_dbgcolor' value='" . $pref['popupbox_dbgcolor'] . "' /></td>
</tr>
";

//-------------------------------# Image Section #-----------------------------------
$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>Image Settings</b> (leave blank for no image in either section)</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Enable Image Section:</td>
<td colspan=2 class='forumheader3'>".($pref['popupbox_imagesection'] == 1 ? "<input type='checkbox' name='popupbox_imagesection' value='1' checked='checked' />" : "<input type='checkbox' name='popupbox_imagesection' value='0' />")." (If enabled, allows 2 images to be placed at the bottom of the popup)</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Image #1 Location: (full address including http;//)</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='100' name='popupbox_imagelinka' value='" . $pref['popupbox_imagelinka'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Image #1 Width:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_imgwa' value='" . $pref['popupbox_imgwa'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Image #1 Height:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_imgha' value='" . $pref['popupbox_imgha'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Image #2 Location: (full address including http;//)</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='100' name='popupbox_imagelinkb' value='" . $pref['popupbox_imagelinkb'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Image #2 Width:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_imgwb' value='" . $pref['popupbox_imgwb'] . "' />px</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Image #2 Height:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='10' name='popupbox_imghb' value='" . $pref['popupbox_imghb'] . "' />px</td>
</tr>

";



//------------------------------------------------------------------------------------
$popup_text .= "
<tr>
<td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' />\n
</td>
</tr></table></form>";





$ns->tablerender("AACGC Popup Box(settings)", $popup_text);

require_once(e_ADMIN . "footer.php");
