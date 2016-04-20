var tempcontents;

function Browser() {

  var ua, s, i;

  this.isIE    = false;
  this.isNS    = false;
  this.version = null;

  ua = navigator.userAgent;

  s = "MSIE";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isIE = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  s = "Netscape6/";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = parseFloat(ua.substr(i + s.length));
    return;
  }

  // Treat any other "Gecko" browser as NS 6.1.

  s = "Gecko";
  if ((i = ua.indexOf(s)) >= 0) {
    this.isNS = true;
    this.version = 6.1;
    return;
  }
}

var browser = new Browser();

// Global object to hold drag information.

var dragObj = new Object();
dragObj.zIndex = 0;

function dragStart(event, id) {

  var el;
  var x, y;

  // If an element id was given, find it. Otherwise use the element being
  // clicked on.

  if (id)
    dragObj.elNode = document.getElementById(id);
  else {
    if (browser.isIE)
      dragObj.elNode = window.event.srcElement;
    if (browser.isNS)
      dragObj.elNode = event.target;

    // If this is a text node, use its parent element.

    if (dragObj.elNode.nodeType == 3)
      dragObj.elNode = dragObj.elNode.parentNode;
  }

  // Get cursor position with respect to the page.

  if (browser.isIE) {
    x = window.event.clientX + document.documentElement.scrollLeft
      + document.body.scrollLeft;
    y = window.event.clientY + document.documentElement.scrollTop
      + document.body.scrollTop;
  }
  if (browser.isNS) {
    x = event.clientX + window.scrollX;
    y = event.clientY + window.scrollY;
  }

  // Save starting positions of cursor and element.

  dragObj.cursorStartX = x;
  dragObj.cursorStartY = y;
  dragObj.elStartLeft  = parseInt(dragObj.elNode.style.left, 10);
  dragObj.elStartTop   = parseInt(dragObj.elNode.style.top,  10);

  if (isNaN(dragObj.elStartLeft)) dragObj.elStartLeft = 0;
  if (isNaN(dragObj.elStartTop))  dragObj.elStartTop  = 0;

  // Update element's z-index.

  //dragObj.elNode.style.zIndex = ++dragObj.zIndex;

  // Capture mousemove and mouseup events on the page.

  if (browser.isIE) {
    document.attachEvent("onmousemove", dragGo);
    document.attachEvent("onmouseup",   dragStop);
    window.event.cancelBubble = true;
    window.event.returnValue = false;
  }
  if (browser.isNS) {
    document.addEventListener("mousemove", dragGo,   true);
    document.addEventListener("mouseup",   dragStop, true);
    event.preventDefault();
  }
}

function dragGo(event) {

  var x, y;

  // Get cursor position with respect to the page.

  if (browser.isIE) {
    x = window.event.clientX + document.documentElement.scrollLeft
      + document.body.scrollLeft;
    y = window.event.clientY + document.documentElement.scrollTop
      + document.body.scrollTop;
  }
  if (browser.isNS) {
    x = event.clientX + window.scrollX;
    y = event.clientY + window.scrollY;
  }

  // Move drag element by the same amount the cursor has moved.

  dragObj.elNode.style.left = (dragObj.elStartLeft + x - dragObj.cursorStartX) + "px";
  dragObj.elNode.style.top  = (dragObj.elStartTop  + y - dragObj.cursorStartY) + "px";

  if (browser.isIE) {
    window.event.cancelBubble = true;
    window.event.returnValue = false;
  }
  if (browser.isNS)
    event.preventDefault();
}

function dragStop(event) {

  // Stop capturing mousemove and mouseup events.

  if (browser.isIE) {
    document.detachEvent("onmousemove", dragGo);
    document.detachEvent("onmouseup",   dragStop);
  }
  if (browser.isNS) {
    document.removeEventListener("mousemove", dragGo,   true);
    document.removeEventListener("mouseup",   dragStop, true);
  }
}



function GetXmlHttp() {
  var xmlhttp = false;
  if (window.XMLHttpRequest)
  {
    xmlhttp = new XMLHttpRequest()
  }
  else if (window.ActiveXObject)// code for IE

  {
    try
    {
      xmlhttp = new ActiveXObject("Msxml2.XMLHTTP")
    } catch (e) {
      try
      {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
      } catch (E) {
        xmlhttp=false
      }
    }
  }
  return xmlhttp;
}




function dbUpdate (strURL) {

   var req = GetXmlHttp(); // function to get xmlhttp object
     if (req)
     {
      req.onreadystatechange = function()
     {
      if (req.readyState == 4) { //data is retrieved from server
       if (req.status == 200) { // which reprents ok status                    
//document.getElementById('productDiv').innerHTML=req.responseText; used to echo out any returned data
      }
      else
      { 
         // alert("There was a problem while using XMLHTTP:\n");
      }
      }            
      }        
    req.open("GET", strURL, true); //open url using get method
    req.send(null);
     }


}



function dbUpdate2 (x,section,itemID) {
	dbUpdate('/videoView.php?bLink='+x+'&path='+window.location.pathname+'&section='+section+'&itemID='+itemID);
}


// Added by BRT 2013-07-16 
function swapVideoZB_inline( playlistfields, zbid ){

	var vids = playlistfields.split(";");
	var numvids = vids.length;

	var flashVid = vids[0];
	var html5Vid = vids[1].replace(/^\s+/,"");

	dbUpdate('/videoView.php?playlist=' + flashVid + '&path=' + window.location.pathname);

	// alert( "Agent: " + navigator.userAgent + ";" );

	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	var isiPod = navigator.userAgent.match(/iPod/i) != null;
	var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
	var isDroid = navigator.userAgent.match(/droid/i) != null;
	var isTestFF = navigator.userAgent.match(/WOW64; rv:22.0/i) != null;
	var isTestCH = navigator.userAgent.match(/28.0.1500.72 Safari/i) != null;
	
	var isAppleDevice = isiPad || isiPod || isiPhone;
	var isTest = isTestFF || isTestCH || isTest;
	var isHTML5Device = isAppleDevice || isDroid ; // || isTest;

        var wd = "475";
        var ht = "267";
	
	// alert( "numvids: " + numvids + ", isAppleDevice: " + isAppleDevice + ", isDroid: " + isDroid + ", isHTML5Device: " + isHTML5Device + ";" );
	// alert( "1: " + (numvids == 2) + ", 1+2: " + (numvids == 2 && isHTML5Device) + ";" );
	if (numvids == 2 && isHTML5Device) {
	
		// alert( 'WD:' + wd + ", HT: " + ht + ";" );
		// alert( 'HTML5 Video:' + html5Vid + ";" );
		// + '<source src="http://h.zeitbyte.com/o1/zb3.1/american_botanical/hosted-videos/html5-videos/' + html5Vid + '.mp4" type="video/mp4; codecs=\'avc1.42E01E, mp4a.40.2\'" />'
		innerCode = 	'<div class="video-js-box" style="width: ' + wd + '; height: ' + ht + ';">'
				+ '<video id="video_1" class="video-js" width="' + wd + '" height="' + ht + '" autoplay="autoplay" controls="controls" preload="auto">'
				+ '<source src="http://h.zeitbyte.com/o1/zb3.1/american_botanical/hosted-videos/html5-videos/' + html5Vid + '.mp4" type="video/mp4" />'
				+ '</video>'
				+ '</div>';

		// alert( 'Inner HTML:' + innerCode + ";" );
		document.getElementById('vidcontent-inline').innerHTML = innerCode;

	} else {
		var plurl = "http://h.zeitbyte.com/o1/zb3.1/american_botanical/playlists/playlists/" + flashVid + ".xml";
                var movie = "http://h.zeitbyte.com/o1/zb3.1/american_botanical/flash/player/zplayer.swf?"
				+ "configUrl=http://h.zeitbyte.com/o1/zb3.1/american_botanical/flash/player/player_config.xml&"
				+ "videoWidth=" + wd + "&"
				+ "videoHeight=" + ht + "&"
				+ "stageWidth=" + wd + "&"
				+ "stageHeight=" + ht + "&"
				+ "playlistUrl=" + plurl + "&"
				+ "autoPlay=true&"
				+ "playerUid=" + zbid + "\"'";

		document.getElementById('vidcontent-inline').innerHTML =
			"<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'"
				+ "codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0'"
				+ "width='" + wd + "' height='" + ht + "'"
				+ "id='zplayer' align='middle'>"
				+ "<param name='allowScriptAccess' value='always' />"
				+ "<param name='allowFullScreen' value='true' />"
				+ "<param name='quality' value='high' />"
				+ "<param name='movie' value='" + movie + "' />"
				+ "<param name='bgcolor' value='#000000' />"
				+ "<embed src='" + movie + "'"
				+    "quality='high' bgcolor='#000000'"
				+    "width='" + wd + "' height='" + ht + "'"
				+    "name='zplayer' align='middle'"
				+    "allowscriptaccess='always'"
				+    "allowfullscreen='true'"
				+    "type='application/x-shockwave-flash'"
				+    "pluginspage='http://www.adobe.com/go/getflashplayer' />"
				+ "</object>";
	}

}
// End of BRT addition

function swapVideoZB(playlistfields, zbid) {

	var numberofelements = playlistfields.split(";").length;

	var playlist = playlistfields.split(";")[0];
	var html5vid = playlistfields.split(";")[1].replace(/^\s+/,"");

	dbUpdate('/videoView.php?playlist='+playlist+'&path='+window.location.pathname);


	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	var isiPod = navigator.userAgent.match(/iPod/i) != null;
	var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
	
	var isAppleDevice = isiPad || isiPod || isiPhone;
	
	if (numberofelements == 2 && isAppleDevice) {
		document.getElementById('vidcontent').innerHTML = 
			'<div class="video-js-box" style="width: 874px; height: 480px; position: absolute;"><video id="video_1" class="video-js" width="854" height="480" controls="controls" preload="auto" onloadstart="VideoJS.setupAllWhenReady();">'
				+ '<source src="http://h.zeitbyte.com/o1/zb3.1/american_botanical/hosted-videos/html5-videos/'+html5vid+'.mp4" type="video/mp4; codecs="avc1.42E01E, mp4a.40.2"" /></video></div>';
	} else {
		document.getElementById('vidcontent').innerHTML =
			"<object classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'"
				+ "codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0'"
				+ "width='854' height='480'"
				+ "id='zplayer' align='middle'>"
				+ "<param name='allowScriptAccess' value='always' />"
				+ "<param name='allowFullScreen' value='true' />"
				+ "<param name='quality' value='high' />"
				+ "<param name='movie'"
				+ "value='http://h.zeitbyte.com/o1/zb3.1/american_botanical/flash/player/zplayer.swf?configUrl=http://h.zeitbyte.com/o1/zb3.1/american_botanical/flash/player/player_config.xml&videoWidth=854&videoHeight=480&stageHeight=480&stageWidth=854&playlistUrl=http://h.zeitbyte.com/o1/zb3.1/american_botanical/playlists/playlists/"+playlist+".xml&autoPlay=false&playerUid="+zbid+"' />"
				+ "<param name='bgcolor' value='#000000' />"
				+ "<embed src='http://h.zeitbyte.com/o1/zb3.1/american_botanical/flash/player/zplayer.swf?configUrl=http://h.zeitbyte.com/o1/zb3.1/american_botanical/flash/player/player_config.xml&videoWidth=854&videoHeight=480&stageHeight=480&stageWidth=854&playlistUrl=http://h.zeitbyte.com/o1/zb3.1/american_botanical/playlists/playlists/"+playlist+".xml&autoPlay=false&playerUid="+zbid+"'"
				+ "quality='high' bgcolor='#000000'"
				+ "width='854' height='480'"
				+ "name='zplayer' align='middle'"
				+ "allowscriptaccess='always'"
				+ "allowfullscreen='true'"
				+ "type='application/x-shockwave-flash'"
				+ "pluginspage='http://www.adobe.com/go/getflashplayer' />"
				+ "</object>";
	}

	if (parseInt(navigator.appVersion)>3) {
		if (navigator.appName=="Netscape") {
			winW = window.innerWidth;
			winH = window.innerHeight;
		}
		if (navigator.appName.indexOf("Microsoft")!=-1) {
			winW = document.body.offsetWidth;
			winH = document.body.offsetHeight;
		}
	}  

	div = document.getElementById('VideoBox');
	
	if (div.style.display == "none") showVideo( 854, 496 ); //was 854, 480
	
	if (div.style.display != 'none') {
	
		if(isAppleDevice) {
			jQuery("#VideoBox").animate({
				top: (getScrollY()+200)+"px",
				left: "53px"
				}, 500);
		} else {
			jQuery("#VideoBox").animate({
				top: (getScrollY()+200)+"px",
				left: ((winW - 854)/2)+"px"
				}, 500);
		}
	}
	
	document.getElementById('vidbar').style.display = 'inline';
}

function swapVideo(videoURL) {

	document.getElementById('vidcontent').innerHTML = "<object width='429' height='300' align='left' class='speaks_video_object_box2' id='videoObject' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000'>  <param value='transparent' name='wmode'>  <param value='always' name='allowScriptAccess'>  <param value='flvFileName=http://vid0.herbdoc.com" + videoURL +".flv&amp;framePicURL=http://vid0.herbdoc.com" + videoURL + ".jpg' id='videoFlashVars' name='FlashVars'>  <param id='movie' value='http://vid0.herbdoc.com/player/VidPlayFSClose3.swf' name='movie'>  <param value='best' name='quality'>  <param value='true' name='allowFullScreen'>  <param value='#ffffff' name='bgcolor'>  <embed id='embedObject' width='429' height='300' align='left' allowfullscreen='true' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' allowscriptaccess='always' bgcolor='#ffffff' wmode='transparent' name='energyshot1' quality='best' flashvars='flvFileName=http://vid0.herbdoc.com" + videoURL + ".flv&amp;framePicURL=http://vid0.herbdoc.com" + videoURL + ".jpg' src='http://vid0.herbdoc.com/player/VidPlayFSClose3.swf'> </object>";

  if (parseInt(navigator.appVersion)>3) {
    if (navigator.appName=="Netscape") {
      winW = window.innerWidth;
      winH = window.innerHeight;
    }
    if (navigator.appName.indexOf("Microsoft")!=-1) {
     winW = document.body.offsetWidth;
     winH = document.body.offsetHeight;
    }
   }  

	div = document.getElementById('VideoBox');
	
	if (div.style.display == "none") showVideo( 435, 300 );
	
	if (div.style.display != 'none') {
         jQuery("#VideoBox").animate({
         	top: (getScrollY()+200)+"px",
         	left: ((winW - 435)/2)+"px"
         }, 500);
    }
}

function showVideo( totalW, totalH ) {
  if (parseInt(navigator.appVersion)>3) {
    if (navigator.appName=="Netscape") {
      winW = window.innerWidth;
      winH = window.innerHeight;
    }
    if (navigator.appName.indexOf("Microsoft")!=-1) {
     winW = document.body.offsetWidth;
     winH = document.body.offsetHeight;
    }
   }  

   var iframeW = totalW;
   var iframeH = totalH;
   var iframeTop = getScrollY() + 200;
   var darkframeTop = 171;

   var minscreenwidth = 1919;
   var screenwidth = screen.width - 0;


   screenW = winW;  
   screenH = winH;
   bodyH = document.body.scrollHeight;
   
   div = document.getElementById('VideoBox');

   div.style.left = (((screenW -iframeW)/2+iframeW/2-50))+"px";
   div.style.top = (iframeTop+iframeH/2-50)+"px";
   
   var isiPad = navigator.userAgent.match(/iPad/i) != null;
var isiPod = navigator.userAgent.match(/iPod/i) != null;
var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
	
var isAppleDevice = isiPad || isiPod || isiPhone;

if (isAppleDevice) {
	AppleWidth = document.body.offsetWidth;
         $("#VideoBox").show();
         $("#VideoBox").animate({
         	height: iframeH+"px",
         	top: (getScrollY()+200)+"px"
         }, 500);
         $("#VideoBox").animate({
         	width: iframeW+"px",
         	left: "53px"
         }, 500, function(){
         	$("#PopIframe").show("fast");
		 }); 
	} else {
         $("#VideoBox").show();
         $("#VideoBox").animate({
         	height: iframeH+"px",
         	top: (getScrollY()+200)+"px"
         }, 500);
         $("#VideoBox").animate({
         	width: iframeW+"px",
         	left: ((screenW -iframeW)/2)+"px"
         }, 500, function(){
         	$("#PopIframe").show("fast");
		 }); 
	}  
}

function putContents(innerdiv) {
	videocontents = document.getElementById('vidcontent');
	
	videocontents.innerHTML = innerdiv;
}

function hideVideo() {

var isiPad = navigator.userAgent.match(/iPad/i) != null;
var isiPod = navigator.userAgent.match(/iPod/i) != null;
var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
	
var isAppleDevice = isiPad || isiPod || isiPhone;

if (!isAppleDevice) {

var internalVar=document.getElementById('vidcontent').innerHTML;
myVarArray1=internalVar.split("playlists/playlists/");
var internalVar2=myVarArray1[1];

myVarArray2=internalVar2.split(".xml");

//alert("v2="+myVarArray2[0]);

	dbUpdate('/videoView.php?playlist='+myVarArray2[0]+'&path='+window.location.pathname+'&close=yes');

}
	videobox = document.getElementById('VideoBox')
	
	videobox.style.display = 'none';
	videobox.style.height = '50px';
	videobox.style.width = '50px';
	document.getElementById('vidcontent').innerHTML = '';
}
