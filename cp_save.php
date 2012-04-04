<?php
session_start();
	include ("connection.php");
	include ('lang/lang_engine.php');
?>
<html><head>
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <?php if ($_SESSION['is_admin']) { ?>
	  <link href="css/layout2.css" rel="stylesheet" type="text/css"/>
  <?php } else { ?>
	  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
  <?php } ?>
</head>
<body>
  <!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	<td><div class="logo"></div></td>
	<td><div class="title"><center><h1> <?php Translator::translate('ccdel_title',$lang);?></h1></center> </div></td>
	<td><div class="advert"> <i> <?php Translator::translate('all_advert',$lang);?></i> </div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->
<?php include ('inc_banner.php');?>
 
<?php

if (isset($_POST['saveprofile'])) {
	$custname	= $_POST['txtCustName'];
	$custaddr	= $_POST['txtCustAddress'];
	$contact 	= $_POST['txtContact'];
	$contemail 	= $_POST['txtContEmail'];
	$contphone 	= $_POST['txtContPhone'];
	$custguid 	= $_POST['txtCustGuid'];
	$loginid 	= $_POST['txtLoginId'];
	$kennwort 	= $_POST['txtPassword'];
	
	include ('connection.php');

	if($custguid != NULL) { //edit action
		$query="update cc_customer set 	 custname='" . $custname ."', " .
										"custaddr='" . $custaddr ."', " . 
										"contact='" . $contact ."', " . 
										"contemail='" . $contemail . "', " . 
										"contphone='" . $contphone . "' " .
				" where custguid = '".$custguid."'";
		$result = mysql_query($query) or die ("query failed 0");
	} else { //new action
		include ('inc_guidgen.php');
		$guid = guid() ;
		$query = "insert into cc_customer values ('" . $guid . "'," .
											"'" . $custname . "'," .
											"'" . $custaddr . "'," .
											"'" . $contact . "'," .
											"'" . $contemail . "'," .
											"'" . $contphone . "')" ;
		$result = mysql_query($query) or die ("query failed 1");
		$query="insert into cc_user values ('" . $loginid ."', " .
				"'" . $kennwort ."', " .
				"'" . $guid ."', false, false )" ;
		$result = mysql_query($query) or die ("query failed 0");
		
	} //endelse
	mysql_close();
}
?>
<div class='middle'>
<div style="margin:30px auto;text-align:center;font-size:16;color:#000000;min-height:300px">

<?php 
if($custguid == NULL) { //new action

	$to				= 	"daniel@elecmicrotech.com";
	$from			=	$contemail;
	$headers   		=	"MIME-Version: 1.0\r\n";
	$headers		.=	"Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
	$headers		.=	"From:".$from."\r\n";
	$subject 	    =   "New Registration Notification";
	$mailbody 		= 	"New customer registration: customer unique ID =" . $guid ;
	$mailbody 		.=  "<br/>Login ID = " .  $loginid ;
	$mailbody 		.=  "<br/><br/>-Regards" ;
	
	if(@mail($to1,$subject,$mailbody,$headers)) {
		echo Translator::translate('ccdel_succ_msg',$lang); 
	 	echo Translator::translate('saveprofile_succ_msg',$lang);
		echo " <br/>";
	} else {
		echo Translator::translate('saveprofile_fail_msg',$lang);
		echo " <br/>";
	}//endif(@mail...
} else { //edit action
 	echo Translator::translate('saveprofile_upd_msg',$lang);
		echo " <br/>";
} //endelse for if($custguid)
?>
<br>	
	<br>	
	<br>	
	<br>	
		<ul class="footerContact" style="width:802;text-align:center">
				<input class="back" value="" onclick="history.go(-2);" type="" ></input>
		</ul>
	</div>
</div>
<!-- end of middle -->

<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!-- 	 Copyright End -->
</body>
</html>