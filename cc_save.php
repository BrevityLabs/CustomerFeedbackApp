<?php 
/*
 * cc_save is called from within the JavaScript function called validate_center(). This function converts all the 
 * get parameter names in 'a#' format where '#' is a serial number. Care must be taken in retrieving them in right order.  
 */
session_start() ;
include ('connection.php');
include ('lang/lang_engine.php');
include ('inc_banner.php');
?>
<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title> </title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <?php if ($_SESSION['is_admin']) { ?>
	  <link href="css/layout2.css" rel="stylesheet" type="text/css"/>
  <?php } else { ?>
	  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
  <?php } ?>
   
  <script src="js/ajax_master.js" type="text/javascript"></script>
  <script src="js/validate.js" type="text/javascript"></script>
 
</head>

<body>

<!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	<td><div class="logo"></div></td>
	<td><div class="title" style="text-align:center;"><h1>  </h1> </div></td>
	<td><div class="advert"> <i><?php Translator::translate('all_advert',$lang);?></i> </div></td>
  </tr>
</table>
</div>

<div class='middle'>
<div style="margin:30px auto;text-align:center;font-size:16;color:#000000;min-height:300px">
<?php

if (isset($_POST['save_center'])) {
	$disp_title	= $_POST['txtDisplayTitle'];
	$disp_title = str_replace("'","&apos;",$disp_title);
	$disp_title = str_replace('"','&quot;',$disp_title);
	$logo_file	= basename ($_FILES['txtLogoFilename']['name']);
	$to_email 	= $_POST['txtToEmail'];
	$cc_email 	= $_POST['txtCCEmail'];
	$language 	= $_POST['cboLanguage'];
	$language   = strtoupper($language);
	$centguid 	= $_POST['centguid'];
	$custguid   = $_POST['custguid'];
	
	if ($logo_file != NULL) {
		$target_path = "./images/";
		
		$target_path = $target_path . $logo_file;
		$temp_file   = $_FILES['txtLogoFilename']['tmp_name'] ;
		
		if(move_uploaded_file($temp_file, $target_path)) {
			echo "The file ".  $logo_file .	" has been uploaded";
		} else {
			echo "There was an error uploading the file, please try again!";
		}
		
		//strip the file name of logo and keep the extn
		$ext = strrchr($logo_file, '.') ;
	}
				
	if($centguid != NULL) { //edit action
		$query="update cc_center set custguid='" . $custguid ."', " ;
			if ($ext != NULL) 
				$query .= "logoextn='" . $ext 		."', " ;

			$query .=	"disptitl='" . $disp_title 	. "', " . 
						"to_email='" . $to_email 	. "', " .
						"cc_email='" . $cc_email 	. "', " .
						"lang ='" . $language . "' " .
						" where centguid = '".$centguid."'";
		$result = mysql_query($query) or die ("query failed 0");
	} else { //new action
		include ('inc_guidgen.php');
		$guid = guid() ;
		$query = "insert into cc_center values ('" . $guid . "'," .
								"'" . $custguid . "'," ;
								"'" . $ext 		. "', " . 
								"'" . $disp_title . "', " . 
								"'" . $to_email . "'," .
								"'" . $cc_email . "'," .
								"'" . $language . "')" ;
		$result = mysql_query($query) or die ("query failed 1");		
	} //endelse
}

if($centguid == NULL) { //new action
	$query="select contemail from cc_customer where custguid='" .  $custguid ."'" ;
	$result = mysql_query($query) or die ("query failed 2");
	while($row = mysql_fetch_array($result)) {
		$contemail = $row[0];
	}
	
	$to				= 	"daniel@elecmicrotech.com";
	$from			=	$contemail;
	$headers   		=	"MIME-Version: 1.0\r\n";
	$headers		.=	"Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
	$headers		.=	"From:".$from."\r\n";
	$subject 	    =   "New Center Registration Notification";
	$mailbody 		= 	"New Center Registration: center unique ID =" . $guid ;
	$mailbody 		.=  "<br/>Login ID = " .  $loginid ;
	$mailbody 		.=  "<br/><br/>-Regards" ;
	
	if(@mail($to1,$subject,$mailbody,$headers)) {
	
?>
<?php echo Translator::translate('ccsave_succ_msg', $lang);?> <br/>
<a href="cc_list.php"><?php echo Translator::translate('all_go_back2main', $lang);?></a>

<?php 
	} else {
?>
<?php echo Translator::translate('ccsave_fail_msg', $lang);?> <br/>
<a href="cc_list.php"><?php echo Translator::translate('all_go_back2main', $lang);?></a>

<?php 		
	}//endif(@mail...

} else {
	echo Translator::translate('ccsave_succ_msg', $lang);
	echo " <br/>" ;
}
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
		
<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!-- 	 Copyright End -->
