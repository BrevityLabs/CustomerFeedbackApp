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
<div class="banner">
<div style="margin:0 1 auto;font-size:10pt;color:#000000;text-align:left;border:1px ;width:398px;height:18px;">Language is set as: <?php echo $lang;?></div>
<div style="margin:-20 400 auto;font-size:9pt;color:#000000;text-align:right;border:1px ;width:400px;height:18px;">
You are logged in as <?php echo $_SESSION['userName'];?>.

<?php 
	if ($_SESSION['is_admin'] == true) {
?>
	Click here to <a href="admin.php?reason=signout">Logout</a>
<?php

	} else {
?>
	Click here to <a href="index.php?reason=signout">Logout</a><br/>
	Click here to <a href="cp_register.php?act=view"><b>view</b> </a> or <a href="cp_register.php?act=edit"><b> modify </b></a>your profile
<?php
	}
?>

</div>
</div>