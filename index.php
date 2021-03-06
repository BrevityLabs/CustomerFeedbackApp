<?php	
session_start();
$page_name = "index.php";
include("inc_login.php");
include("lang/lang_engine.php");
?>

<html><head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title><?php echo Translator::translate('title_launchpad',$lang);?></title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
 
</head>

<body>
<div class='outerregular'>

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

<!-- Middle Panel Start -->

<div class="middle">
<H3> <?php echo Translator::translate('index_what_ccenter',$lang);?></H3>
<p style='text-align:left;width:790px'>
<?php echo Translator::translate('index_ccenter_defn',$lang);?> <br/>
</p>
<p>
&nbsp; - &nbsp; <?php echo Translator::translate('index_exist_user',$lang);?><br/> 
&nbsp; - &nbsp; <a href="cp_register.php?act=new"><?php echo Translator::translate('index_new_user',$lang);?></a>
</p>
<?php
	if($error_message != '')
		echo $error_message;
?>

<ul class="footerContact">
<form name="login" action="index.php" method="POST"> 
    <table style="width:400px;border:10px;margin:0px auto;">
    	<tr><td></td><td></td></tr>
        <tr>
          <td style="width:150px;border:1px;text-align:right;"><?php echo Translator::translate('index_label_login',$lang);?> :</td>
          <td style="border:0px;">
			 <input class="textfield" name="userName" type="text" value="mukul"/>
          </td>
        </tr>
        <tr>
          <td  style="border:1px;text-align:right;"><?php echo Translator::translate('index_label_password',$lang);?> :</td>
          <td  style="border:0px;">
				<input class="passwordfield" name="password" type="password" value="password"/>
			</td>
        </tr>
		<tr>
			<td style="border:1px;text-align:right;font-color:#000099">
				<?php echo Translator::translate('all_language',$lang);?> :
			</td>
			<td>
				<select name='cboLanguage' id='cboLanguage' style='width:200px;height:36px'>
					<option selected value='en'> <?php echo Translator::translate('ccnew_english',$lang);?> </option>
					<option value='fr'> 		<?php echo Translator::translate('ccnew_french',  $lang);?> </option>
				</select>
			</td>
		</tr>
	<tr>
		<td colspan='2'>
			<div style="width:400px;margin:10px 7px auto;padding-bottom:5px;border:0px;text-align:center">
				<input name="login" class="send" value="" type="submit" />
				<input name="reset" class="reset" value="" type="reset" /> 
			</div>
		</td>
	</tr>
    </table>
</form>
</ul>
</div>
<!-- Middle Panel End -->

<!-- Footer Panel Start -->
<div class="footer"  style='text-align:center;'>
<a href="admin.php" style='font-size:10pt;color:#0000EE'><?php echo Translator::translate('index_admin_login',$lang);?> </a>
</div>
<!-- Footer Panel End -->

<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
?>
<!--  Copyright End -->
</div>
</body>
</html>
