<?php
session_start();
	include ("connection.php");
	include ('lang/lang_engine.php');
	
	$loginid = $_REQUEST['loginid'] ;
		if ($loginid != NULL) {
			$query="delete from cc_user where loginid = '" . $loginid . "'";
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
<div class='outeradmin'>

  <!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	<td><div class="logo"></div></td>
	<td><div class="advert"><?php include('ad.php')?></div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->
  
 
<!-- Banner Panel Start -->
<?php include ('inc_banner.php');?>
 
 <!-- Middle Panel Start -->
<div class="middle"> 
<ul class="footerContact" style="width:802;text-align:center">
<table style="margin:30px auto;text-align:center;font-size:16;color:#000000;min-height:300px"><tr><td>
	<?php echo Translator::translate('cudel_succ_msg',$lang);?>
</td></tr><tr><td>	
	<input class="back" value="" onclick="history.go(-1);" type="" ></input>
</td></tr></table>
</ul>
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
 