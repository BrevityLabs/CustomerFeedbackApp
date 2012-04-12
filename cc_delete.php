<?php
session_start();
	include ("connection.php");
	include ('lang/lang_engine.php');
	
	$centguid = $_REQUEST['centguid'] ;
		if ($centguid != NULL) {
			$query="delete from cc_center where centguid = '" . $centguid . "'";
			$result = mysql_query($query) or die ("query failed 0");
		}	
		mysql_close(); 
?>

<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo Translator::translate('ccdel_title',$lang);?></title>
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php if ($_SESSION['is_admin']) { ?>
<div class='outeradmin'>
<?php } else { ?>
<div class='outerregular'>
<?php } ?>

  <!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	<td><div class="logo"></div></td>
	<td><div class="advert"> <?php include('ad.php');?> </div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->
  
 
<!-- Banner Panel Start -->
<?php include ('inc_banner.php');?>
 
 <!-- Middle Panel Start -->
<div class="middle"> 
	<div style="margin:30px auto;text-align:center;font-size:16;color:#000000;min-height:300px"><?php echo Translator::translate('ccdel_succ_msg',$lang);?> 
	<br>	
	<br>	
	<br>	
	<br>	
		<ul class="footerContact" style="width:802;text-align:center">
				<input class="back" value="" onclick="history.go(-1);" type="" ></input>
		</ul>
	</div>
 </div>
<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class="footer">
 <div style="text-align: center">
 </div>
</div>
<!-- Footer Panel End -->

<!-- Copyright Start --> 
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!--	 Copyright End -->
</div>
</body>
</html>
 