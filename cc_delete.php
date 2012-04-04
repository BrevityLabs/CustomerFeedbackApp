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

</body>
</html>
 