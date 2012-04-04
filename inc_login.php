<?php
ob_start() ;
include("connection.php");
$error_message = '';
$reason = @$_REQUEST['reason'];
if($reason == 'timeout') {
	$error_message = "<center><font size='3'color='red'>Your session timed out. Relogin.</font></center>" ;

	unset($_SESSION['custguid']);
	unset($_SESSION['userName']);
	session_destroy();
} 

if($reason == 'signout') {
	$error_message = "<center><font size='3' color='green'>Thanks you, ". $_SESSION['userName'].". Click here to <a href='$page_name?reason=relogin'>login </a> again</font></center>";
	unset($_SESSION['custguid']);
	unset($_SESSION['userName']);
	session_destroy();
	} 

if($reason == 'unknown') {
	$error_message = "<center><font size='3'color='red'>Unknown error occurred. Relogin.</font></center>" ;

	unset($_SESSION['custguid']);
	unset($_SESSION['userName']);
	session_destroy();
} 


//if1
if (isset($_POST['login'])) {  
	$userName = $_POST['userName']; 
	$password = $_POST['password'];
	$lang = $_POST['cboLanguage'];
	
//if3	
	if($userName!="" || $password!="") {
		$query = "SELECT custguid FROM cc_user where loginid='".$userName."' and password='".$password."' and isactive=true and isadmin = " ;
		if ($page_name == "admin.php")
			$query = $query . "true" ;
		else
			$query = $query . "false" ;

		$result = mysql_query($query) or die("query failed");

		while ($row=mysql_fetch_array($result)) {
			/* set the cache limiter to 'private' */
			session_cache_limiter('private');
			$cache_limiter = session_cache_limiter();
	
			/* set the cache expire to 30 minutes */
			session_cache_expire(3);
			$cache_expire = session_cache_expire();
	
			session_name();
			if (session_start()) {
				$_SESSION['custguid'] = $row[0] ;
				$_SESSION['userName'] = $userName ;
				$_SESSION['lang'] = $lang ;
				echo $row[0] . "<br/>" ;
				echo $userName . "<br/>";
				
				if ($page_name == "admin.php")			{
					$_SESSION['is_admin'] = true ;
				} else {
					$_SESSION['is_admin'] = false;
				}
				header("Location:cc_list.php");
			} else {
				echo "<font size='3'color='red'>Failed to start a new session. Try again.</font>" ;
			}	
		} //endwhile
	//else3			
		} else {	
					
		}//endif3
//else1
} else {
	//echo "<font size='5'color='red'>You are not a registered Admin</font>" ;
}	//endif1

ob_end_flush() ;
mysql_close() ;
?>
