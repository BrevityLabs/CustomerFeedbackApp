<?php 
	include("connection.php");
	include('lang/lang_engine.php');
	//override session language with site language
	$lang = $_REQUEST['lang'];
		
?>
<html xmlns="http://www.w3.org/1999/xhtml"><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title>Customer Comment Center&#153</title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>

  <script src="js/ajax_master.js" type="text/javascript"></script>
  <script src="js/validate.js" type="text/javascript"></script>
  <script> <!-- 
  	window.onfocus = temp ;

	function temp(){
		if (twitter_window != null)
			twitter_window.close() ;
	
	}
	var tm = 0;
	var t ;
	var twitter_window ;	

	function timer_reset() {
		tm = 0 ;
	}
	
	function set_timer_on() {
		tm=tm+1;

		//if you are not happy with 3 minutes of twitter time, increase the count below.
		if(tm >= 180) {
			twitter_window.close() ;
			tm=0;
			return ;
		}

		t = setTimeout("set_timer_on();",1000);
	}
	
	function open_twitter_window() {
		var window_props = 'top=0,left=0,width='+ screen.width +
			',height='+screen.height + ",fullscreen=1,toolbar=0" + 
			',location=0,directories=0,status=no,menubar=0,scrollbars=0,resizable=0' ; 
		twitter_window=window.open(
			'http://twitter.com/',
			'', 
			window_props);
		set_timer_on();
	}

-->
</script>
</head>

<body>
<div class='outerregular'>
<?php
	
	$centguid = @$_REQUEST['centguid'] ;

	if ($centguid != NULL) {
		$query="select disptitl, logoextn from cc_center where centguid = '".$centguid."'";
		$result = mysql_query($query) or die ("query failed 0");
		while($row = mysql_fetch_array($result)) {
				$title = $row[0] ;
				$logoextn = $row[1];
		}
	}	
?>

<!-- Header Panel Start -->
<div class="header">
<table>
  <tr>
	<td><div class="logo" style="background:url(./logos/<?php echo $centguid.$logoextn; ?>) no-repeat;">&nbsp;</div></td>
	<td><div class="advert"> <?php include ('cust_ad.php');?> </div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->

<?php mysql_close(); ?>

<!-- Banner Panel Start -->
<!-- div class="banner">
	<i>< ?php echo Translator::translate('all_banner',$lang);? ></i>
</div-->

<!-- Middle Panel Start -->
<div class="middle">
<ul class="footerContact">
<div id="cform" style="display:block">
<form action="" method="get" enctype="multipart/form-data" name="contactform" id="contactform">
	<input name="uniqueid" id="uniqueid" type="hidden" value="<?php echo $centguid;?>">
    <table style="width:500px;border:10px;margin:0 130px auto;">
      <tbody>
        <tr>
<?php $fn = Translator::translate('cc_first_name',$lang);?>
        	<td><?php echo $fn;?>:  </td>
          <td> <input name="txtFirstName" id="txtFirstName" class="textfield" value="<?php echo $fn;?>" 
          	onclick="changecolor('txtFirstName','<?php echo $fn;?>')" onfocus="changecolor('txtFirstName','<?php echo $fn;?>')" ></input>
          </td>
        </tr>
        <tr>
<?php $ln = Translator::translate('cc_last_name',$lang);?>        
        <td><?php echo $ln?>:</td>
          <td><input name="txtLastName" id="txtLastName" class="textfield" value="<?php echo $ln;?>" 
          	onclick="changecolor('txtLastName','<?php echo $ln;?>')" onfocus="changecolor('txtLastName','<?php echo $ln;?>')" ></input></td>
        </tr>
        <tr>
<?php $ph = Translator::translate('cc_phone',$lang);?>        
          <td><?php echo $ph;?>:</td>
		  <td><input name="txtPhone" id="txtPhone" class="textfield" value="<?php echo $ph;?>" 
		  	onclick="changecolor('txtPhone','<?php echo $ph;?>')" onfocus="changecolor('txtPhone','<?php echo $ph;?>')"></input></td>
        </tr>
        <tr>
<?php $em = Translator::translate('cc_email',$lang);?>
        <td><?php echo $em?>:</td>
          <td><input name="txtEmail" id="txtEmail" class="textfield" value="<?php echo $em;?>" 
          	onclick="changecolor('txtEmail','<?php echo $em;?>')" onfocus="changecolor('txtEmail','<?php echo $em;?>')"></input></td>
        </tr>

        <tr>
<?php $co = Translator::translate('cc_comment',$lang);?>        
<?php $co1 = Translator::translate('cc_enter_comment',$lang);?>        
          <td><?php echo $co?>:</td>
          <td>
			<textarea name="txtEnquiry" id="txtEnquiry" class="textArea" 
							onclick="changecolor('txtEnquiry','<?php echo $co1?>')" 
							onfocus="changecolor('txtEnquiry','<?php echo $co1?>')"><?php echo $co1;?></textarea></td>
        </tr>
      </tbody>
</table>
<?php 
	$params = "'" . $fn . "','" . $ln . "','" . $ph . "','" . $em . "','" . $co1 . "','" . $lang . "'" ;
?>
<div style="text-align:center;width:800px;margin:20px 10px auto;padding-bottom:5px;border:0px;">
	<input class="send" value="" onclick="return validate_contact(<?php echo $params;?>);" type="submit" ></input>
    <input class="reset" value="" onclick="" type="reset" ></input> 
</div>
</form>
</div> <!-- cform div End -->
<div style="width:800px;height:10px;margin:5px 5px auto;border:0px;font-size:18px;display:none" id="cformafter">
</div>
</ul>
</div>

<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class="footer">
 <ul class="footerContact">
 <div style="text-align:center;">
    <input class="chatlive" value="" onclick="open_twitter_window();" type="" ></input> 	  <p/>
	  <a href="#" onclick="open_twitter_window();">
		  <font color="#ff6600"><font size="4"><?php echo Translator::translate('cc_twitter_launch',$lang);?></font></font>
	  </a>
  </div>
  </ul>
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
