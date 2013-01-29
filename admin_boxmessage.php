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
    $pref['popupbox_title'] = $_POST['popupbox_title'];
    $pref['popupbox_details'] = $_POST['popupbox_details'];

    $pref['popupbox_titlea'] = $_POST['popupbox_titlea'];
    $pref['popupbox_detailsa'] = $_POST['popupbox_detailsa'];

    $pref['popupbox_titleb'] = $_POST['popupbox_titleb'];
    $pref['popupbox_detailsb'] = $_POST['popupbox_detailsb'];

    $pref['popupbox_titleadmin'] = $_POST['popupbox_titleadmin'];
    $pref['popupbox_detailsadmin'] = $_POST['popupbox_detailsadmin'];

    $pref['popupbox_titleguest'] = $_POST['popupbox_titleguest'];
    $pref['popupbox_detailsguest'] = $_POST['popupbox_detailsguest'];


if (isset($_POST['popupbox_adminmessage'])) 
{$pref['popupbox_adminmessage'] = 1;}
else
{$pref['popupbox_adminmessage'] = 0;}

if (isset($_POST['popupbox_usermessage'])) 
{$pref['popupbox_usermessage'] = 1;}
else
{$pref['popupbox_usermessage'] = 0;}

if (isset($_POST['popupbox_usermessageb'])) 
{$pref['popupbox_usermessageb'] = 1;}
else
{$pref['popupbox_usermessageb'] = 0;}

    save_prefs();

$popup_msgtext = "Settings Saved";
}


//--------------------------------------------------------------------


$popup_text .= "<form method='post' action='".e_SELF."' id='popupform'>
<table class='fborder' width='100%'><tr>";


//-------------------------------# Box Display Settings #-----------------------------------

$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3' colspan=2><b>Box Text Display Settings (If Userclass Box is used those users will not see the Default box)</b></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Default Member Box Title:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='75' name='popupbox_title' value='" . $pref['popupbox_title'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Default Member Box Details:</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' rows='5' cols='100' name='popupbox_details'>".$tp->toFORM($pref['popupbox_details'])."</textarea>
</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Default Guest Box Title:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='75' name='popupbox_titleguest' value='" . $pref['popupbox_titleguest'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Default Guest Box Details:</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' rows='5' cols='100' name='popupbox_detailsguest'>".$tp->toFORM($pref['popupbox_detailsguest'])."</textarea>
</td>
</tr>

";
$popup_text .= "</table><br><br><table class='fborder' width='100%'>";
//-------------------------
	$sql->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['popupbox_userclassa']."","");
        $row = $sql->db_Fetch();
        $classnow = "".$row['userclass_name']."";

$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3'>Enable Userclass Box:</td>
<td colspan=2 class='forumheader3'>".($pref['popupbox_usermessage'] == 1 ? "<input type='checkbox' name='popupbox_usermessage' value='1' checked='checked' />" : "<input type='checkbox' name='popupbox_usermessage' value='0' />")." (If enabled, users in userclass will see this message instead of default)</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Userclass:</td>
<td style='width:70%' class='forumheader3'>
<select name='el_autoaddclass' size='1' class='tbox' style='width:50%'>
<option name='popupbox_userclassa' value='".$pref['popupbox_userclassa']."'>".$classnow."</option>";

	$sql2->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row2 = $sql2->db_Fetch()){

$popup_text .= "<option name='popupbox_userclassa' value='".$row2['userclass_id']."'>".$row2['userclass_name']."</option>";}

$popup_text .= "</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Box Title:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='75' name='popupbox_titlea' value='" . $pref['popupbox_titlea'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Box Details:</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' rows='5' cols='100' name='popupbox_detailsa'>".$tp->toFORM($pref['popupbox_detailsa'])."</textarea>
</td>
</tr>
";

$popup_text .= "</table><br><br><table class='fborder' width='100%'>";

//-------------------------
        $sql3 = new db;
	$sql3->db_Select("userclass_classes", "*", "WHERE userclass_id=".$pref['popupbox_userclassb']."","");
        $row3 = $sql3->db_Fetch();
        $classnowb = "".$row3['userclass_name']."";

$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3'>Enable Userclass Box:</td>
<td colspan=2 class='forumheader3'>".($pref['popupbox_usermessageb'] == 1 ? "<input type='checkbox' name='popupbox_usermessageb' value='1' checked='checked' />" : "<input type='checkbox' name='popupbox_usermessageb' value='0' />")." (If enabled, users in userclass will see this message instead of default)</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Userclass:</td>
<td style='width:70%' class='forumheader3'>
<select name='el_autoaddclass' size='1' class='tbox' style='width:50%'>
<option name='popupbox_userclassb' value='".$pref['popupbox_userclassb']."'>".$classnow."</option>";

        $sql4 = new db;
	$sql4->db_Select("userclass_classes", "*", "ORDER BY userclass_id ASC","");
        while($row4 = $sql4->db_Fetch()){

$popup_text .= "<option name='popupbox_userclassb' value='".$row4['userclass_id']."'>".$row4['userclass_name']."</option>";}

$popup_text .= "</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Box Title:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='75' name='popupbox_titleb' value='" . $pref['popupbox_titleb'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Box Details:</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' rows='5' cols='100' name='popupbox_detailsb'>".$tp->toFORM($pref['popupbox_detailsb'])."</textarea>
</td>
</tr>
";

$popup_text .= "</table><br><br><table class='fborder' width='100%'>";

//--------------------------

$popup_text .= "
<tr>
<td style='width:30%' class='forumheader3'>Enable Admin Box:</td>
<td colspan=2 class='forumheader3'>".($pref['popupbox_adminmessage'] == 1 ? "<input type='checkbox' name='popupbox_adminmessage' value='1' checked='checked' />" : "<input type='checkbox' name='popupbox_adminmessage' value='0' />")." (If enabled, Admins will see this message instead of default)</td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Admin Box Title:</td>
<td style='width:70%' class='forumheader3'><input class='tbox' type='text'  size='75' name='popupbox_titleadmin' value='" . $pref['popupbox_titleadmin'] . "' /></td>
</tr>
<tr>
<td style='width:30%' class='forumheader3'>Admin Box Details:</td>
<td style='width:70%' class='forumheader3'><textarea class='tbox' rows='5' cols='100' name='popupbox_detailsadmin'>".$tp->toFORM($pref['popupbox_detailsadmin'])."</textarea>
</td>
</tr>
";


$popup_text .= "</table><br><br><table class='fborder' width='100%'>";

//------------------------------------------------------------------------------------
$popup_text .= "
<tr>
<td colspan='2' class='fcaption' style='text-align: left;'><input type='submit' name='update' value='Save Settings' class='button' />\n
</td>
</tr></table></form>";





$ns->tablerender("AACGC Popup Box(Box Message)", $popup_text);

require_once(e_ADMIN . "footer.php");

