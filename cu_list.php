<?php
session_start();
include("lang/lang_engine.php");
$isadmin = $_SESSION['is_admin'];
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

if (!isset($_SESSION['custguid'])) {
	header("Location:index.php?reason=timeout") ;
	exit();
}
?>
  
  <title><?php echo Translator::translate('title_launchpad',$lang);?></title>
	  
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
	<td><div class="advert"> <?php include ('ad.php');?> </div></td>
	<tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->
<?php include ('inc_banner.php');?>
<!-- Middle Panel Start -->

<div class="middle">
<table style='width:792px;'><tr>
	<td>
		<div style="width:398px;font-size:10pt"> 
			<?php echo Translator::translate('ccuser_header',$lang);?>
		</div>
	</td><td>
	</td>
</tr></table>
<table style="border:1px">
	<tr class="listing">
		<th>#</th>
		<th><?php echo Translator::translate('ccuser_th_cust',$lang);?></th>
		<th><?php echo Translator::translate('ccuser_th_login',$lang);?></th>
		<th> <?php echo Translator::translate('ccuser_th_password',$lang);?> </th>
		<th> <?php echo Translator::translate('ccuser_th_active',$lang);?></th>
		<th> <?php echo Translator::translate('ccuser_th_action',$lang);?></th>
	</tr>
<?php
include("connection.php");

//get the customer details 	
	
	$query="select b.custguid, b.custname, a.loginid, a.password, a.isactive from cc_user a, cc_customer b where a.custguid = b.custguid";
	$result = mysql_query($query) or die ("query failed 0");
	$count = 0;
	while($row = mysql_fetch_array($result)) {
		$checked = $row[4] ? 'checked' : '' ;
?>
<form action="cu_save.php" method="post" enctype="multipart/form-data" name="userform" id="userform">

<tr>
	<td><center><?php echo ++$count; ?></center></td>
	<td style="border:1px;text-align:center"><?echo $row[1];?> <input type='hidden' class='textfield' name='custguid' id='custguid' value='<?echo $row[0];?>'></td>
	<td style="border:1px;text-align:center"><?echo $row[2];?> <input type='hidden' class='textfield' name='loginid' id='loginid' value='<?echo $row[2];?>'></td>
	<td style="border:1px;text-align:center"><input class='textfield' name='password' id='password' value='<?echo $row[3];?>'> </td>
	<td style="border:1px;text-align:center"><input class='' type='checkbox' name='isactive' id='isactive' <?php echo $checked; ?>> </td>
	<td style="border:1px;">
		<input type="submit" value="" class="savebutton" name="save_user" id="save_user" onclick="validate_user_data('save','<?echo $row[2];?>');">
		<input type="button" class="delbutton" name="delete_user" id="delete_user" onclick="validate_user_data('delete','<?echo $row[2];?>');">
	</td>
</tr>
</form>
<?php	
	} //endwhile	
?>
	<tr> <td colspan=6>		<ul class="footerContact" style="width:788;text-align:center">
				<input class="back" value="" onclick="history.go(-1);" type="" ></input>
		</ul>
	</td></tr>
</table>

</div> <!-- listing -->

<!-- Middle Panel End -->

<!-- Footer Panel Start -->

<div class="footer">
<ul class="footerContact">
</ul>
</div>
<!-- Footer Panel End -->


<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!--  Copyright End -->

</div>
</body>
</html>
