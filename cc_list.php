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
  <script> <!--
	function open_ccenter(guid,lang) {
			var wn_props = "left=0,top=0,fullscreen=1,toolbar=0,location=0,directories=no,status=no,menubar=0,scrollbars=0,resizable=no" ;
			wn_props += ",width="+screen.width ;
			wn_props += ",height="+screen.height ;
			lang = lang.toLowerCase() ;
			center_win = window.open('cc_run.php?lang='+lang+'&centguid='+guid,'center_win',wn_props);
			center_win.focus();			
  	}
  -->
  </script>
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
	<td><div class="advert"> <?php include ('ad.php');?> </div></td>
	<tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->
<?php include ('inc_banner.php');?>
<!-- Middle Panel Start -->

<div class="middle">
<table style='width:786px;'><tr>
	<td>
		<div style="width:396px;font-size:10pt"> 
			<?php echo Translator::translate('list_ccenter_header',$lang);?>
		</div>
	</td><td>
<?php  if ($_SESSION['is_admin'] == false) { ?>
	<div  style="width:390px;text-align:right;font-size:10pt">
		<?php echo Translator::translate('list_create_new',$lang);?>:	
		<input type="button" class="newbutton" name="butNewClient" id="butNewClient" onclick="validate_data('new','');" ></input>
	</div>
<?php 	} ?>					
	</td>
</tr></table>
<table style="border:1px">
	<tr class="listing">
		<th><?php echo Translator::translate('list_tabhead_serial',$lang);?></th>
		<th> <?php echo Translator::translate('list_tabhead_logo',$lang);?> </th>
		<th> <?php echo Translator::translate('list_tabhead_display',$lang);?></th>
		<th> <?php echo Translator::translate('list_tabhead_toemail',$lang);?></th>
		<th><?php echo Translator::translate('list_tabhead_ccemail',$lang);?></th>
		<th> <?php echo Translator::translate('list_tabhead_lang',$lang);?></th>
		<th> <?php echo Translator::translate('list_tabhead_action',$lang);?></th>
	</tr>
<?php
include("connection.php");

//get the customer details 	
	
	if ($isadmin)
		$query="select centguid, custguid, logoextn, disptitl,to_email,cc_email,lang from cc_center";
	else
		$query="select centguid, custguid, logoextn, disptitl,to_email,cc_email,lang from cc_center where custguid='". $_SESSION['custguid'] ."'" ;
	$result = mysql_query($query) or die ("query failed 0");
	$count = 0;
	while($row = mysql_fetch_array($result)) {
		echo "<tr>";
		echo  "<td width='30px'><center>".++$count."</center></td>" ;
		for ($i = 2; $i < 7; $i++) {
			if ($i == 2) {
				$dataval = $row[0] . $row[$i] ;
?>
	<td style="border:1px ;">
		<img width='150px' src='./logos/<?echo $dataval;?>'>
		</img>
	</td>
<?php
				
			}  else {
				$dataval = $row[$i] ;
?>
<td style="border:1px ;">
	<a 	href='' 
		onclick="open_ccenter('<?echo $row[0];?>','<?echo $row[6];?>');">
		<?echo $dataval;?>
	</a>

</td>
<?php
			}//endif
		}//endfor ?>
<td style="border:1px;width:75px">
	<input type="button" class="viewbutton" name="butViewClient" id="butViewClient" 
	onclick="validate_data('view','<?echo $row[0];?>');"/><input type="button" class="edtbutton" name="butEditClient" id="butEditClient" 
	onclick="validate_data('edit','<?echo $row[0];?>');"/><input type="button" class="delbutton" name="butDeleteClient" id="butDeleteClient" onclick="validate_data('delete','<?echo $row[0];?>');"/>
</td>
</tr>
<?php		} //endwhile	
?>
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
