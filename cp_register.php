<?php	
//if new is chosen while session is still alive then kill the session
if ($_REQUEST['act'] == 'new') {
	unset($_SESSION['custguid']);
	unset($_SESSION['userName']);
	session_destroy();
}
//start afresh
session_start();

include("lang/lang_engine.php");
include ('connection.php');
	
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title><?php echo Translator::translate('admin_title',$lang);?></title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
 
<script><!--

function validate_password(){
	var lid;	
	lid=document.getElementById('txtPassword').value;
	lid = lid.replace(/^\s+|\s+$/g,"") ;
	
	if(lid == ''){
		alert("Password cannot be empty");
		return false ;
	}
	if(lid.length < 6) {
		alert("Password too short. Should be equal to or longer than 6 characters");
		return false ;
	}
	return true;
}
function validate_login(){
	var lid;	
	lid=document.getElementById('txtLoginId').value;
	lid = lid.replace(/^\s+|\s+$/g,"") ;
	
	if(lid == ''){
		alert("Login ID cannot be empty");
		return false ;
	}
	if(lid.length < 6) {
		alert("Login ID too short. Should be equal to or longer than 6 characters");
		return false ;
	}
	var pwd ;
	if(pwd == ''){
		alert("Password cannot be empty");
		return false ;
	}
	if(pwd.length < 6) {
		alert("Password is too short. Should be equal to or longer than 6 characters");
		return false ;
	}
	
	return true;	
}

function compare(){
	var pw1, pw2;

	pw1=document.getElementById('txtPassword').value;
	pw2=document.getElementById('txtRPassword').value;
	pw1 = pw1.replace(/^\s+|\s+$/g,"") ;

	if(trim(pw1) == ''){
		alert("password cannot be empty");
		return false ;
	}
	pw2 = pw2.replace(/^\s+|\s+$/g,"") ;
	if(pw1 !== pw2){
		alert("password mismatch");
		return false ;
	}
	return true ;
}
--></script>
</head>
<?php if ($_SESSION['is_admin']) { ?>
<body class='admin'>
<?php } else { ?>
<body class='regular'>
<?php } ?>

<div class="header">
<table>
  <tr>
	<td><div class="logo">&nbsp;</div></td>
	<td><div class="advert"> <i><?php include('ad.php');?></i> </div></td>
  <tr>
</table>
</div>

<div class="banner">
	<?php include ('inc_banner.php');?>
</div>

<?php

// The act parameter can have 3 values - new, edit or view. In case of other values, it should just view.
$action = @$_REQUEST['act'];

$custname	= "" ;
$custaddr	= "" ;
$contact 	= "" ;
$contemail 	= "" ;
$contphone 	= "" ;
$custguid 	= "" ;

if ($action == 'view' || $action == 'edit') { //edit or view
	$custguid = $_SESSION ['custguid'];
	
	$query="select custguid, custname, custaddr, contact, contemail, contphone from cc_customer where custguid = '".$custguid."'";
	$result = mysql_query($query) or die ("query failed 0");
	while($row = mysql_fetch_array($result)) {
		$custguid 	= $row[0] ;
		$custname	= $row[1] ;
		$custaddr	= $row[2] ;
		$contact 	= $row[3] ;
		$contemail 	= $row[4] ;
		$contphone 	= $row[5] ;
	}
}

if ($action == 'view') {
?>
<div class='middle'>
	<div style="margin:0 1 auto;font-size:10pt;color:#000000;text-align:center;"> <?php echo Translator::translate('cpview_header',$lang);?> </div>
<ul class="footerContact">
<table style='width:500px;border:10px;margin:0 180px auto;'>
	<tr><td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_org_name', $lang);?> : </td><td><?php echo $custname;?></td></tr>
	<tr><td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_address', $lang);?> : </td><td><?php echo $custaddr;?></td></tr>
	<tr><td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_contact', $lang);?> : </td><td><?php echo $contact;?></td>	</tr>
	<tr><td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_email', $lang);?> : </td><td><?php echo $contemail;?></td>	</tr>
	<tr><td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_phone', $lang);?> : </td><td><?php echo $contphone;?></td>	</tr>
	<tr><td colspan=2 style='text-align: center'><input class='back' type='' name='' onclick='history.go(-1);' value=''></td></tr>
	
</table>
<?php 	
} 

if ($action == 'edit' || $action == 'new') { // for new and edit
?>
<div class='middle'>
	<div style="margin:0 1 auto;font-size:10pt;color:#000000;text-align:center;"> <?php 
	if ($action == 'new')
		echo Translator::translate('cpnew_header',$lang);
	else 
		echo Translator::translate('cpedit_header',$lang);
	?> </div>
	<form action="cp_save.php" method="POST" id="cform" name="cform">
	<input type='hidden' name='txtCustGuid' id='txtCustGuid' value='<?php echo $custguid;?>'>
<ul class="footerContact">
<table style='width:500px;border:10px;margin:0 160px auto;'>
  <tr>
		<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_org_name', $lang);?>:</td>
		<td> <input class='textfield' type='text' name='txtCustName' id='txtCustName' value='<?php echo $custname;?>'></td>
  </tr><tr>
		<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_address', $lang);?>: </td>
		<td><textarea  class='textarea'  name='txtCustAddress' id='txtCustAddress'> <?php echo $custaddr;?></textarea></td>
  </tr><tr>
		<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_contact', $lang);?>: </td>
		<td><input  class='textfield' type='text' name='txtContact' id='txtContact' value='<?php echo $contact;?>'> 	</td>
  </tr><tr>
		<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_email', $lang);?>: </td>
		<td><input  class='textfield' type='text' name='txtContEmail' id='txtContEmail' value='<?php echo $contemail;?>'> </td>
  </tr><tr>
		<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('pro_label_phone', $lang);?>:</td>
		<td> <input  class='textfield' type='text' name='txtContPhone' id='txtContPhone' value='<?php echo $contphone;?>'> 	</td>
  </tr>
<?php if ($action=='new') { 
?>
  <tr>
		<td style='text-align:right;color:#0077EE'> <?php echo Translator::translate('index_label_login', $lang);?>: </td>
		<td><input  class='textfield' type='text' name='txtLoginId' id='txtLoginId' value='' onblur='return validate_login();'> </td>
  </tr><tr>
		<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('index_label_password', $lang);?>: </td>
		<td> <input  class='textfield' type='password' name='txtPassword' id='txtPassword' value='' onblur='return validate_password();'> </td>
  </tr><tr>
	<td style='text-align:right;color:#0077EE'><?php echo Translator::translate('index_label_repeat_password', $lang);?>: </td>
	<td> <input  class='textfield' type='password' name='txtRPassword' id='txtRPassword' value='' onblur='return compare();'> 	</td>
  </tr>
<?php 
	}//if($action=='new') ...
?>
  <tr>
  		<td colspan=2 style='text-align: center'><input class='save' type='submit' name='saveprofile' onclick='return validate_login();' value=''></input>
			<input class='reset' type='reset' onlick='' value=''></input>
  			<input class='back' type='' onclick='history.go(-1);' value=''></input></td>
  </tr>
</table>
	
<?php 
} //endelseif($action == 'edit' || $action == 'new' )
?>
</ul>
</form>
</div>

<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!--  Copyright End -->
</body></html>