<?php 
/*
 * cc_save is called from within the JavaScript function called validate_center(). This function converts all the 
 * get parameter names in 'a#' format where '#' is a serial number. Care must be taken in retrieving them in right order.  
 */
session_start() ;
include ('connection.php');
include ('lang/lang_engine.php');
?>
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title> </title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
   
  <script src="js/ajax_master.js" type="text/javascript"></script>
  <script src="js/validate.js" type="text/javascript"></script>
 
</head>

<body>
<div class='outeradmin'>
<!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	<td><div class="logo"></div></td>
	<td><div class="advert"> <?php include('ad.php');?> </div></td>
  </tr>
</table>
</div>

<?php include ('inc_banner.php'); ?>


<div class='middle'>
<div style="margin:30px auto;text-align:center;font-size:16;color:#000000;min-height:300px">
<?php

if (isset($_POST['save_user'])) {
	$custguid	= $_POST['custguid'];
	$loginid 	= $_POST['loginid'];
	$password 	= $_POST['password'];
	$is_active 	= $_POST['isactive'];
	
	$isactive = false ;
	$isactive = ($is_active == 'on') ? true : false ;
	
	$query="update cc_user set password='"	. $password 	. "', " .
							"isactive='"	. $isactive	. "' "  .
					" where loginid = '"	. $loginid		."'" ;	
	$result = mysql_query($query) or die ("query failed 0");
	}

	$query="select contemail from cc_customer where custguid='" .  $custguid ."'" ;
	$result = mysql_query($query) or die ("query failed 2");
	while($row = mysql_fetch_array($result)) {
		$contemail = $row[0];
	}
	
	$to				= 	$contemail;
	$from			=	"daniel@elecmicrotech.com";
	$headers   		=	"MIME-Version: 1.0\r\n";
	$headers		.=	"Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
	$headers		.=	"From:".$from."\r\n";
	$subject 	    =   "User profile change notification";
	$mailbody 		= 	"Dear " . $loginid  . ",\r\n";
	$mailbody 		.=  "Your profile at the customer comment center has been changed. The password is  = " .  $password . "\r\n";
	$mailbody 		.=  "and/or the profile has been set active.\r\n";
	$mailbody 		.=  "-Regards" ;
	
	if(@mail($to1,$subject,$mailbody,$headers)) {
		echo Translator::translate('cusave_succ_msg', $lang);
		echo '<br/>' ;
	} else {
		echo Translator::translate('cusave_fail_msg', $lang);
		echo '<br/>' ;
	}//endif(@mail...
?>
	<br>	
	<br>	
	<br>	
	<br>	
		<ul class="footerContact" style="width:802;text-align:center">
				<input class="back" value="" onclick="history.go(-1);" type="" ></input>
		</ul>
	</div>
</div>
		
<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!-- 	 Copyright End -->
</div></body></html>