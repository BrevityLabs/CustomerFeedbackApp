var outMethod="";//manage text  out put or xml output
var doc="";
var rt="";
var reqType="";
var isAsynch="true";

//common message script
function process(url,method) {
	if(url != "") {	
		outMethod=method;
		if(navigator.appName=="Netscape"){
			//reqType="GET";
			httpRequest("GET",url,true);
		} else {
			//reqType="POST";
			httpRequest("POST",url,true);
		}
	}
}

//Initialize a request object that is already constructed
function initReq(reqType,url,isAsynch) {
	request.onreadystatechange=outMethod;
	request.open(reqType,url,isAsynch);
	request.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=UTF-8");
	request.send(null);
}

//Wrapper function for constructing a request object.
function httpRequest(reqType,url,asynch) {
	//Mozilla based web browsers
	if(window.XMLHttpRequest) {
		request=new XMLHttpRequest();
	}
	//For Internet explorer
	else if(window.ActiveXObject) {
		request=new ActiveXObject("Msxml2.XMLHTTP");
		if(!request) {
			request=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	
	if(request)	{
	   initReq(reqType,url,asynch)
	} else {
		alert("Your browser does not permit the user of all of this application's features");
	}
}

//Event handler for request
function handleResponse(output) {
	if(request.readyState==4) {	
		if(request.status==200) {
			if(output == "text") {
				doc=request.responseText;
			} else	{
				doc=request.responseXML;
			}
			return doc;
		}
	}
}
