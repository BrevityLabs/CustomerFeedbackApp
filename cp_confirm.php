<?php
include("lang/lang_engine.php");
include ('connection.php');
?>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <title><?php echo Translator::translate('admin_title',$lang);?></title>
	  
  <link href="css/reset.css" rel="stylesheet" type="text/css"/>
  <link href="css/layout.css" rel="stylesheet" type="text/css"/>
 
</head>
<body class='regular'>
<div class="header">
<div class="title" style="text-align:center;margin:0 120 auto"><h1> New User Registration: Confirmation process</h1> </div>
</div>
<div class="banner">
	<i></i>
</div>

<div class='middle'>
<H3> Confirmation step 3 - you have been redirected from the email sent by us. </H3>
<table><tr><td style="width:150px;border:0px;padding:10px 0px 13px 10px;text-align:center;font-color:#000099;font-size:14pt"> 
<?php

$custguid=$_REQUEST['guid'] ;
$username=$_REQUEST['user'];

if($username!="" || $custguid!="") {
	$query = "SELECT count(*) FROM cc_user where custguid = '". $custguid."' and loginid='".$username."' and isadmin = false and isactive = false" ;
	//echo $query ;
	$result = mysql_query($query) or die("select query failed");
	
	while ($row=mysql_fetch_array($result)) {
		if ($row[0] == 0) { //either there is no user or the user got confirmed already 
			echo "Oops ! There is no user pending for confirmation or there is no such user at all.Try login <a href='index.php'> here </a> using the registered user and password." ;
		} else {
				$query = "Update cc_user set isactive = true where custguid = '". $custguid."' and isactive = false" ;
				$result = mysql_query($query) or die("update query failed");
				echo "Congrats! Now your profile is active. You can login using the registered user and password. Click <a href='index.php'> here </a> to proceed";
		}
	}
}
else {
	echo "The confirmation request is incorrect or got corrupt. Contact the administrator of the site." ;
}
?>
</td></tr></table>
</div>

<div class='footer'></div>

<!-- Copyright Start -->
<?php 
	include('inc_copyright.php');
	mysql_close();
?>
<!-- 	 Copyright End -->

</body></html>