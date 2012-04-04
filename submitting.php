<?php
if(@$_REQUEST['act']=="1") {
  include("connection.php");

  if (@$_REQUEST['a5'] != NULL) {
	$query="select to_email, cc_email from cc_center where centguid = '".@$_REQUEST['a5']."'";
	$result = mysql_query($query) or die ("query failed");
	while($row = mysql_fetch_array($result)) {
		$to_email = $row[0];
		$cc_email = $row[1];
  	}	//endwhile

  $arr[0]=@$_REQUEST['a0'];
  $arr[1]=@$_REQUEST['a1'];
  $arr[2]=@$_REQUEST['a2'];
  $arr[3]=@$_REQUEST['a3'];
  $arr[4]=@$_REQUEST['a4'];

  $mailbody	=	 file_get_contents("mailer.html");

  $mailbody	=	 str_replace("[FNAME]",$arr[0],$mailbody);
  $mailbody	=	 str_replace("[LNAME]",$arr[1],$mailbody);
  $mailbody	=	 str_replace("[PHONE]",$arr[2],$mailbody);
  $mailbody	=	 str_replace("[EMAIL]",$arr[3],$mailbody);
  $mailbody	=	 str_replace("[COMM]",$arr[4],$mailbody);

  $from			=	 $arr[3];
  $headers   	=	 "MIME-Version: 1.0\r\n";
  $headers		.=	 "Content-Type: text/html;\n\tcharset=\"iso-8859-1\"\n";
  $headers		.=	 "From:".$from."\r\n";
  $headers		.=	 "CC:".$cc_email."\r\n";
  $subject 	    =    "Online feedback comment";
 } //endif2

  if(@mail($to_email,$subject,$mailbody,$headers))
    echo "OK";
  else
	echo "FAILED" ;

  mysql_close() ;
} //endif1
?>
