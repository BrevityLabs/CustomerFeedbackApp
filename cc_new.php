<html>
<!-- <?php 
include ('connection.php');
include ('lang/lang_engine.php');
session_start();

$centguid = $_REQUEST['centguid'];
$custguid = $_SESSION['custguid'];

if ($centguid != NULL)
	$is_new = false ;
else
	$is_new = true ;

//if $custguid is empty means admin is trying to create a center.

?> -->
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></meta>

  <title><?php echo Translator::translate('all_title',$lang);?></title>

  <link href="css/reset.css" rel="stylesheet" type="text/css"></link>
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
 	<td><div class="logo" style="background:url(./images/admincoy.jpg) no-repeat;">&nbsp;</div></td> 
	<td><div class="title" style="text-align:center;"><h1>
	<?php 
	if ($is_new)
		echo Translator::translate('ccnew_header',$lang);
	else
		echo Translator::translate('ccmod_header',$lang);
	?></h1> </div></td>
	<td><div class="advert"> <i> <?php echo Translator::translate('all_advert',$lang);?></i> </div></td>
  </tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->
<?php include ('inc_banner.php');?>

<!-- Middle Panel Start -->
<div class="middle">
<ul class="footerContact">
<div id="cform" style="display:block">
<form action="cc_save.php" method="post" enctype="multipart/form-data" name="centerform" id="centerform">
	<input type='hidden' id='centguid' name='centguid' value='<?php echo $centguid;?>'></input>
	<input type='hidden' id='custguid' name='custguid' value='<?php echo $custguid; ?>'></input>
	<table style="width:500px;border:10px;margin:0 200px auto;">
      <tbody>
<?php 
if (!$is_new) {
		$query="select custguid,logoextn,disptitl,to_email,cc_email,lang from cc_center where centguid = '".$centguid."'";
		$result = mysql_query($query) or die ("query failed 0");
		while($row = mysql_fetch_array($result)) {
			$logoextn = $row[1];
			$disptitl = $row[2];
			$to_email = $row[3];
			$cc_email = $row[4];
			$lang_    = $row[5];
		}
}
?>      
      <tr>
<?php 	$tmp = Translator::translate('list_tabhead_display',$lang); ?>
     <td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'><?php echo $tmp;?>	</td>
<?php 
if(!$is_new) {
	$tmp = $disptitl;
}
?>
          	<td style='border:0px;'>          	
          	<input name="txtDisplayTitle" id="txtDisplayTitle" class="textfield" value="<?php echo $tmp;?>" ></input>
            </td>
		</tr>
   		<tr>
<?php 	$tmp = Translator::translate('list_tabhead_logo',$lang); ?>
   		<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'><?php echo $tmp; ?>	</td>
          	<td style='border:0px;'> 
<?php 
if(!$is_new) {
	$tmp = $centguid.$logoextn  ;
}
?>
      		<input type="file" name="txtLogoFilename" id="txtLogoFilename" class="textfield" value="<?php echo $tmp;?>" ></input>
<?php 
if(!$is_new) {
	echo "<img src='./images/" . $centguid.$logoextn . "'>" ;
} 
?>
          	</td>
		</tr>
<tr>
<?php 	$tmp = Translator::translate('list_tabhead_toemail',$lang); ?>
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>	<?php echo $tmp;?></td>
          	<td style='border:0px;'>  
<?php 
if(!$is_new) {
	$tmp = $to_email  ;
}
?>
          		<input name="txtToEmail" id="txtToEmail" class="textfield" value="<?php echo $tmp;?>" ></input>
          	</td>
		</tr>
      		<tr>
<?php 	$tmp = Translator::translate('list_tabhead_ccemail',$lang); ?>
      		
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'><?php echo $tmp;?></td>
          	<td style='border:0px;'>  
<?php 
if(!$is_new) {
	$tmp = $cc_email  ;
}
?>
          	<input name="txtCCEmail" id="txtCCEmail" class="textfield" value="<?php echo $tmp;?>" ></input>
          	</td>
		</tr>
    	<tr>
    	<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>	<?php echo Translator::translate('ccnew_language',$lang);?></td>
          	<td style='border:0px;'>  
          	<select name='cboLanguage' id='cboLanguage' class='combofield' style='width:300px;height:30px'>
<?php 		if (!$is_new && $lang_ == 'EN') {    ?>
          		<option value='en' selected><?php echo Translator::translate('ccnew_english',$lang);?></option>
          		<option value='fr'>			<?php echo Translator::translate('ccnew_french' ,$lang);?></option>
<?php 		} else 
				if (!$is_new && $lang_ == 'FR') {     
?>
          		<option value='en'>			<?php echo Translator::translate('ccnew_english',$lang);?></option>
          		<option value='fr' selected><?php echo Translator::translate('ccnew_french' ,$lang);?></option>
<?php 		} else { 
?>
          		<option value='en'><?php echo Translator::translate('ccnew_english',$lang);?></option>
          		<option value='fr'><?php echo Translator::translate('ccnew_french' ,$lang);?></option>
<?php 		}
?>
          		</select>
          	</td>
		</tr>
		
    	<tr>
			<td colspan='2' style='width:500px;border:0px;padding:10px 0px 13px 10px;text-align:center'>	
				<input name="save_center" class="save" value="" onclick="return validate_center();" type="submit" ></input>
				<input name="reset_center" class="reset" value="" onclick="" type="reset" ></input>
				<input name="cancel_center" class="cancel" value="" onclick="history.go(-1);" type="" ></input>
				</td>
		</tr>
</tbody></table>

</form>
</div> <!-- cform div End -->
</ul>
<ul class="footerContact">
	<div style='width:802px;height:10px;margin:5px 50px auto;border:0px;font-size:18px;display:none' id='cformafter'></div>
</ul>
</div>


<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class='footer'></div>
<!-- Footer Panel End -->

<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!-- Copyright End -->

</body>
</html>