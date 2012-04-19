<script><!--
function switch_to_english(){
	switch_lang('en') ;
}
function switch_to_french(){
	switch_lang('fr') ;
}

function switch_lang(new_lang) {
	var url = document.location.href ;

	url = url.replace("lang=fr","lang=") ;
	url = url.replace("lang=en","lang=") ;
	url = url.replace("lang=","lang="+new_lang) ;
	
	window.open('cc_list.php?lang=fr', '_self', '') ;
	return true ;
}

--></script>
<div class='banner'>
<table>
<!-- div style="margin:0 1 auto;font-size:10pt;color:#000000;text-align:left;width:398px;height:18px;" -->
<tr><td style='font-size:9pt;color:#000000;text-align:left;width:400px'>
<?php 
	echo Translator::translate('banner_msg_1');
	echo $lang;
?>
</td>
<td style='font-size:9pt;color:#000000;text-align:right;width:400px'>
<!--div style='margin:-20 400 auto;font-size:9pt;color:#000000;text-align:right;width:400px;height:18px;'-->

 <?php 
	echo Translator::translate('banner_msg_2');
 	echo $_SESSION['userName'].'.';

	if ($_SESSION['is_admin'] == true) {
?>
	Click here to <a href="admin.php?reason=signout">Logout</a><br/>
	<a href="cu_list.php"><?php echo Translator::translate('banner_msg_6');?></a> 
<?php

	} else {
?>
	<a href="index.php?reason=signout"><?php echo Translator::translate('banner_msg_3');?></a><br/>
	<a href="cp_register.php?act=view"><?php echo Translator::translate('banner_msg_4');?></a> | 
	<a href="cp_register.php?act=edit"><?php echo Translator::translate('banner_msg_5');?></a>
<?php
	}
?>

</td></tr></table>
</div>