<?php 
	include("connection.php");
	include('lang/lang_engine.php');
	//override session language with site language
	$lang = $_REQUEST['lang'];
	$scr_wd = $_REQUEST['wd'];
	$scr_ht = $_REQUEST['ht'];
	
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
<?php //calculate the size of middle div i.e. screen height - 125 header - 100 footer - 40 copyright
if ($scr_wd > 800) {	//wider screen
	$h1 = $scr_ht ;
	$w1 = round($h1 * 1.33) ;
} else {
	$w1 = $scr_wd ;
	$h1 = round($w1 / 1.33) ;
}
$style = 'width:'. $w1 . 'px;height:'. $h1 . 'px;margin:0px auto; ' ;
?>
<body>
<div class='outerregular'  style='<?php echo $style;?>'>
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
<?php 
	$style = 'width:'. $w1 . 'px;height:'. 125 . 'px;margin:auto;' ;
?>
<div class="header" style='<?php echo $style;?>'>
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
<?php 
	$hmid = ($h1 - 126 - 61 - 21 - 51) ; //screen height - header - footer - copyright - location bar
	$hcform = 350 ;
	$hpad = ($hmid - $hcform)/2 ;
	$style = 'width:' . $w1 . 'px;height:' . ($hmid - $hpad) . 'px;margin:auto;' ;
?>
<div class="middle" style='<?php echo $style;?>'>

<ul class="footerContact">
<?php 
	$style = 'width:'. $w1 . 'px;height:'. $hcform . 'px;margin:' . $hpad . 'px auto;' ;
?>
<div id="cform" style="<?php echo $style;?>">
<form action="" method="get" enctype="multipart/form-data" name="contactform" id="contactform">
	<input name="uniqueid" id="uniqueid" type="hidden" value="<?php echo $centguid;?>">
    <table style="width:500px;border:0px;margin:auto;">
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
	$style = 'width:'. $w1 . 'px;text-align:center;margin:20px auto;padding-bottom:5px; ' ;
?>
<div style="<?php echo $style;?>">
	<input class="send" value="" onclick="return validate_contact(<?php echo $params;?>);" type="submit" ></input>
    <input class="reset" value="" onclick="" type="reset" ></input> 
</div>
</form>
</div> <!-- cform div End -->
<div style="width:<?php echo $w1;?>px;height:10px;margin:5px 5px auto;font-size:18px;display:block" id="cformafter">
</div>
</ul>
</div>

<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class="footer" style='width:<?php echo $w1;?>px;height:60px;margin:0 auto; '>
 <ul class="footerContact">
 <div style="width:<?php echo $w1;?>px;text-align:center;">
    <input class="chatlive" value="" onclick="open_twitter_window();" type="" ></input> 	  <p/>
	  <a href="#" onclick="open_twitter_window();">
		  <font color="#ff6600"><font size="4"><?php echo Translator::translate('cc_twitter_launch',$lang);?></font></font>
	  </a>
  </div>
  </ul>
</div>
<!-- Footer Panel End -->

<!-- Copyright Start -->
<div class="copyright" style='width:<?php echo $w1;?>px;height:20px;'>
	<div style="text-align: center;">
		<font size='2' color="#333333">&copy; 2012 Elecmicrotech. All rights reserved.</font>
	</div>
</div>
<!--	 Copyright End -->
</div>
</body>
</html>
