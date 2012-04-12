<!-- <?php 
include ('lang/lang_engine.php');
session_start();
$centguid = $_REQUEST['centguid'] ;
?> -->
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Customer Comment Center</title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
  
  <script src="js/ajax_master.js" type="text/javascript"></script>
  <script src="js/validate.js" type="text/javascript"></script>
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
	<td><div class="logo">&nbsp;</div></td>
	<td><div class="advert"> <i> <?php include('ad.php');?></i> </div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->
<?php 
include ('inc_banner.php');
?>


<!-- Middle Panel Start -->
<div class="middle">
<div style="margin:0 1 auto;font-size:10pt;color:#000000;text-align:center;"><?php echo Translator::translate('ccview_header',$lang);?></div>

<ul class="footerContact">
<div id="cform" style="display:block;width:796px;margin:5px auto">
<form action="" method="get" enctype="multipart/form-data" name="contactform" id="contactform">
	<input name="centguid" id="centguid" type="hidden" value="<?php echo $centguid;?>">
    <table style="width:500px;border:1px;margin:0 150px auto;">
      <tbody>
<?php
	include("connection.php");
	if ($centguid != NULL) {
		$query="select custguid,logoextn,disptitl,to_email,cc_email,lang from cc_center where centguid = '".$centguid."'";
		$result = mysql_query($query) or die ("query failed 0");
		while($row = mysql_fetch_array($result)) {
?>

		<tr>
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'><?php echo Translator::translate('list_tabhead_display',$lang);?>	</td>
          	<td style='border:0px;'>  <?php echo $row[2];?>          </td>
		</tr>
      		<tr>
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'><?php echo Translator::translate('list_tabhead_logo',$lang);?>	</td>
          	<td style='border:0px;'> <img width='150px' src= './logos/<?php echo $centguid.$row[1];?>'>  </td>
					</tr>
   		<tr>
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>	<?php echo Translator::translate('list_tabhead_toemail',$lang);?></td>
          	          	<td style='border:0px;'>      <?php echo $row[3];?>      </td>
		</tr>
      		<tr>
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>	<?php echo Translator::translate('list_tabhead_ccemail',$lang);?></td>
          	<td style='border:0px;'> <?php echo $row[4];?>           </td>
					</tr>
    	<tr>
			<td style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:right'>	<?php echo Translator::translate('ccnew_language',$lang);?></td>
          	<td style='border:0px;'>  
          	<select name='cboLanguage' id='coLanguage' class='combofield' style='width:300px;height:30px'>
<?php 		if ($row[5] == 'EN') {    ?>
          		<option value='en' selected><?php echo Translator::translate('ccnew_english',$lang);?></option>
          		<option value='fr'>			<?php echo Translator::translate('ccnew_french' ,$lang);?></option>
<?php 		} else {     ?>
          		<option value='en'>			<?php echo Translator::translate('ccnew_english',$lang);?></option>
          		<option value='fr' selected><?php echo Translator::translate('ccnew_french' ,$lang);?></option>
<?php 		}//endif  ?>
          		</select>
          	</td>
		</tr>
	
		<tr>
			<td colspan='2' style='width:150px;border:0px;padding:10px 10px 13px 10px;text-align:center'>
				<input class="back" value="" onclick="history.go(-1);" type="" ></input>
	      	</td>
		</tr>
		
<?php  }//endwhile

	}//endof outmost if
?>
	</tbody></table>
</form>
</div> <!-- cform div End -->

<div style="width:802px;height:10px;margin:5px 50px auto;border:0px;font-size:18px;display:none" id="cformafter">
</div>

</ul>
</div>
<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class="footer"> </div>
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
