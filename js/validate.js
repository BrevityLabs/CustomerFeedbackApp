var lang = '';
function validate_data(action, id) {

	if(action == 'view') {
		window.open("cc_view.php?centguid="+id,"_self","") ;		
	} else {
		if(action == 'edit') {
			window.open("cc_new.php?centguid="+id,"_self","") ;		
		}else {
			if(action == 'delete') {
				if (confirm("Are you sure to delete the comment center?")) {
					window.open("cc_delete.php?centguid="+id,"_self","") ;
				}
			} else {
				if (action == 'new'){
						window.open('cc_new.php','_self','');
				} //end if
			}// end else
		}//end else
	}
}

function validate_contact(fn,ln,ph,em,co, ln) {
lang = ln;

var arr=new Array();
arr[0] 		=			isBlank('txtFirstName',fn);
arr[1]		=			isBlank('txtLastName',ln);
arr[2]		=			isBlank('txtPhone',ph);
arr[3]		=			isBlank('txtEmail',em);
arr[4]		=			isBlank('txtEnquiry',co);

if(arr[2]	==	true)
	arr[2]	=	phoneCheck('txtPhone','Phone');

if(arr[3]	==	true)
	arr[3]	=	emailCheck('txtEmail','Email');

var flag    =	true;
for(var ctr=0;ctr<arr.length;ctr++) {
		if(arr[ctr]==false) {
			flag=false;
		}
}
var arr_val=new Array();
if(flag==true) {
	arr_val[0]=getVal('txtFirstName');
	arr_val[1]=getVal('txtLastName');
	arr_val[2]=getVal('txtPhone');
	arr_val[3]=getVal('txtEmail');
	arr_val[4]=getVal('txtEnquiry');
	arr_val[5]=getVal('uniqueid');
	var qrstring="";
	for(var x=0;x<arr_val.length;x++) {
		var objN="a"+x;
		qrstring += "&"+objN+"="+arr_val[x];
	}
	var url  =  "submitting.php?act=1"+qrstring;
	process(url, contactUpdated);	
}
return false;
}


/*
 * Validates before creation of a new center or modifying an existing center.
 * Checks if all the fields are entered, emails are in right format.
 * TODO: Logo file is either gif, jpg or png. 
 */
function validate_center() {
	var arr=new Array();
	arr[0] 		=			isBlank('txtDisplayTitle','');
//	arr[1]		=			isBlank('txtLogoFilename','');
	arr[2]		=			isBlank('txtToEmail','');
	arr[3]		=			isBlank('txtCCEmail','');
	arr[4]		=			isBlank('cboLanguage','');

	if(arr[2]	==	true)
		arr[2]	=	emailCheck('txtToEmail','');

	if(arr[3]	==	true)
		arr[3]	=	emailCheck('txtCCEmail','');

	var flag    =	true;
	for(var ctr=0;ctr<arr.length;ctr++) {
			if(arr[ctr]==false) {
				flag=false;
			}
	}
	return flag;
}

function contactUpdated() {
		
	var data = handleResponse("text");
	var _innerHTML = "";
	if (data!=undefined) {
		data = data.replace(/^\s+|\s+$/g,"") ;
		if (data=='OK' || data=='FAILED'){
			document.getElementById('cform').style.display='none';
			if (data=='OK'){
				
				if(lang=="en")					
					_innerHTML = "<div style='text-align:center'>Thank you contacting with us. We will contact you soon</div>" ;
				
				else
					_innerHTML = "<div style='text-align:center'> Votre commentaire a été envoyé ,nous allons vous contacter prochainement   </div>" ;					
			
			} else if (data=='FAILED') {
				
				if(lang=="en")				
					_innerHTML = "<div style='text-align:center'>Message sent failed. Check the provided email address</div>";
				else
					_innerHTML = "<div style='text-align:center'> Message a échoué à envoyer. S'il vous plaît vérifier Courriel  </div>";
			
			}
			document.getElementById('cformafter').innerHTML= _innerHTML;
			document.getElementById('cformafter').style.display='block';
			document.getElementById('cformafter').style.height='300px';
			setTimeout("reset_display();",4000);
		}
	}
}

function reset_display() {
	var url = "cc_run.php?centguid="+document.getElementById('uniqueid').value;
	url += '&lang='+lang;
	window.open(url,"_self","") ;	
}

function delayer() {
}

function delayer_refresh(url) {
	window.location=url;
}

function isBlank(objName,DefValue) {
    if( (document.getElementById(objName).value == "") ||  (document.getElementById(objName).value== DefValue) ){
		document.getElementById(objName).style.color ="red";
		document.getElementById(objName).value = DefValue;
		return false;
	}	else	{
		return true;
	}
}

function getCheckedVal(objName) {
	var chk=document.getElementById(objName).checked;
	if(chk==true) {
		return '1';
	}	else	{
		return '0';
	}
}

function isBlankDDL(objName,DefValue,DisplaySpan){

    if( (document.getElementById(objName).value == "0") ||  (document.getElementById(objName).value == "") || (document.getElementById(objName).value == DefValue) ){
		document.getElementById(DisplaySpan).style.color = "red";
		document.getElementById(DisplaySpan).innerHTML = DefValue;
		return false;
	} else {
		document.getElementById(DisplaySpan).innerHTML = "";
		return true;
	}
}

function changecolor(objName,DefValue){ 
   if(document.getElementById(objName).value == DefValue) {	
		document.getElementById(objName).style.color ="#111111";
		document.getElementById(objName).value = "";  
	}
}

function getVal(objName){   
    return document.getElementById(objName).value;
}


function emailCheck(objName,DefValue) {
	if( (!echeck(document.getElementById(objName).value)) ||  (document.getElementById(objName).value== DefValue) ) {
		document.getElementById(objName).style.color ="red";
		document.getElementById(objName).value = DefValue;
		return false;
	} else {
		return true;
	}
}

function phoneCheck(objName,DefValue) {
	if( (!numCheck(document.getElementById(objName).value)) ||  (document.getElementById(objName).value== DefValue) ) {
		document.getElementById(objName).style.color ="red";
		document.getElementById(objName).value = DefValue;
		return false;
	} else {
		return true;
	}
}

// used to show controls based the selection 
function echeck(value) {
var re = new RegExp(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i);

if (re.test(value)) 
     return true;
else 
     return false;
}


function numCheck(value) {
//var re = new RegExp(/^\(?([2-9][0-8][0-9])\)?[-. ]?([2-9][0-9]{2})[-. ]?([0-9]{4})$/);
var re = new RegExp(/^(1?(-?\d{3})-?)?(\d{3})(-?\d{4})$/);

if (re.test(value))
     return true;
else 
     return false;
}

function maximize_size() {
	top.window.moveTo (100,100) ;
	top.window.outWidth = 100 ;
	top.window.outerHeight = 100 ;
}

function disableEnterKey(e)
{
     var key;

     if(window.event) {
          key = window.event.keyCode;   		  //IE
		  alert (key) ;

     } else {									  //Mozilla
          key = e.which; 
		  alert (key) ;
	 }
//disable alt, crtl

     if(key == 13)
          return false;
     else
          return true;
}
