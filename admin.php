<html><head>
<?php	
session_start();
$page_name = "admin.php";
include("inc_login.php");
include("lang/lang_engine.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title><?php echo Translator::translate('admin_title',$lang);?></title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
 
</head>
<body class='admin'>
<div class="header">
<table>
  <tr>
	<td><div class="logo"></div></td>
	<td><div class="advert"> <i><?php echo Translator::translate('all_advert',$lang);?></i> </div></td>
  <tr>
</table>
</div>
<!-- Header Panel End -->

<!-- Banner Panel Start -->

<!-- Middle Panel Start -->
<div class="middle">
<div  style="margin:0 1 auto;font-size:10pt;color:#000000;text-align:center;"> <?php echo Translator::translate('admin_subtitle',$lang);?></div>
<ul class="footerContact">
<form name="login" action="admin.php" method="POST">
<table style='width:500px;border:10px;margin:0 160px auto;'>
	<tr>
		<td colspan="2" style="width:150px;border:0px;padding:10px 0px 13px 10px;text-align:center;font-color:#000099">
			<h2> <?php echo Translator::translate('all_login',$lang);?> </h2>	
		</td>
	<tr>		
	<tr>
		<td style="border:0px;padding:10px 10px 13px 10px;text-align:right;font-color:#000099">
				<?php echo Translator::translate('index_label_login',$lang);?> :
		</td>
		<td>
			<input class='textfield' type="text" name="userName" value="admin" >	
		</td>
	<tr>
	<tr>
		<td style="border:0px;padding:10px 10px 13px 10px;text-align:right;font-color:#000099">
			<?php echo Translator::translate('index_label_password',$lang);?> :
		</td>
		<td>
			<input class='textfield' type="password" name="password" value="admin" >	
		</td>
	<tr>
	<tr>
		<td style="border:0px;padding:10px 10px 13px 10px;text-align:right;font-color:#000099">
			<?php echo Translator::translate('all_language',$lang);?> :
		</td>
		<td>
			<select name='cboLanguage' id='cboLanguage' class='combofield' style='width:300px;height:30px'>
				<option selected value='en'> <?php echo Translator::translate('ccnew_english',$lang);?> </option>
				<option value='fr'> <?php echo Translator::translate('ccnew_french',$lang);?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan='2' style="border:0px;padding:10px 0px 13px 10px;text-align:center;">
			<input class='send' type="submit" name="login" value="" />		
			<input class='reset' type="reset" name="reset" value="" />
		</td>
	<tr>
</table>
</form>
</ul>
</div>
<!-- Middle Panel End -->

<div class='footer'></div>

<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!--  Copyright End -->
</body>
</html>
