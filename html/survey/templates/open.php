<?php header('Content-type: text/html; charset=utf-8'); ?>
<!DOCTYPE HTML>
<html>
<head>
 <meta http-equiv="Content-type" content="text/html;charset=utf-8" />
 <title></title>
 <style type="text/css">
 body {
 background-color: #FFFFFF;
 width: 960px;
 }
 .gap {
 margin-top:24px;
 }
 .group {
 margin-left:40px;
 }
 input {
/*  margin-left: 12px; */
 }
 .desc {
 margin-left:24px;
 margin-top:24px;
 margin-bottom:12px;
 font-weight:bold;
 }
 
  .desc2 {
 margin-left:24px;

 }
 
 </style>
 
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
	<script type="text/javascript">


$(document).ready(function() {
	//Syntax: checkboxlimit(checkbox_reference, limit)
	checkboxlimit($(".question1"));
	checkboxlimit($(".question2"));
	checkboxlimit($(".question3"));
	checkboxlimit($(".question4"));
	checkboxlimit($(".question5"));
	checkboxlimit($(".question6"));
	checkboxlimit($(".question7"));
	checkboxlimit($(".question8"));
	checkboxlimit($(".question9"));
	checkboxlimit($(".question10"));
	checkboxlimit($(".question11"));
	checkboxlimit($(".question12"));
	checkboxlimit($(".question13"));
	checkboxlimit($(".question14"));
	checkboxlimit($(".question15"));
	checkboxlimit($(".question16"));
	checkboxlimit($(".question17"));
	checkboxlimit($(".question18"));
	checkboxlimit($(".question19"));
	checkboxlimit($(".question20"));
	checkboxlimit($(".question21"));
	checkboxlimit($(".question22"));
	checkboxlimit($(".question23"));
	checkboxlimit($(".question24"));
	//selectboxlimit($('select.s0')); //They decided not to use the automatic numbering system to see if potential employee can follow directions
	//selectboxlimit($('select.s1')); //But at least we have the code for that now for the most part.
	//selectboxlimit($('select.s2'));
	//selectboxlimit($('select.s3'));
	//selectboxlimit($('select.s4'));
	//selectboxlimit($('select.s5'));
	//selectboxlimit($('select.s6'));
	//selectboxlimit($('select.s7'));
	//selectboxlimit($('select.s8'));
	//selectboxlimit($('select.s9'));
	//selectboxlimit($('select.s10'));
	//selectboxlimit($('select.s11'));

});

function selectboxlimit(selectgroup) {
	var selectgroup = selectgroup;
	//alert(selectgroup.length);
	for (var i=0; i<selectgroup.length; i++){
		//alert('test');
		selectgroup[i].value = i+1;
		selectgroup[i].onfocus=function() {
			this.recent=this.value;
		}
		selectgroup[i].onchange=function() {
			var lastvalue = this.recent;
			if (this.value > lastvalue) {
				group = $("select."+this.className)
				for (var x=0; x<group.length; x++) {
					if (group[x].value <= this.value && group[x] != this && group[x].value >= lastvalue) {
						group[x].value = group[x].value - 1;
					}
				}
			} else {
				group = $("select."+this.className)
				for (var x=0; x<group.length; x++) {
					if (group[x].value >= this.value && group[x] != this && group[x].value <= lastvalue) {
						group[x].value = parseInt(group[x].value) + 1;
					}
				}
			}
			
		}
	}
}

function checkboxlimit(checkgroup, limit){
	var checkgroup=checkgroup;
	for (var i=0; i<checkgroup.length; i++){
		checkgroup[i].onclick=function(){
		
			for (var i=0; i<checkgroup.length; i++) {
				$uncheckgroup = this.value;
				if (checkgroup[i].value == $uncheckgroup && checkgroup[i] != this) checkgroup[i].checked = false;
			}

		}
	}
}

function errorchecking() {
	var selectgroup;
	selectgroup = $("select");
	var obj = {};
	var obj2 = {};
	var errnums1 = [];
	var errnums2 = [];
	var quesnums1 = [];
	var quesnums2 = [];
	var message = "You have not correctly completed your answers in ";
	var message1 = "";
	var message2 = "";
	var joinword = "";
	var returnval = true;
	
	for (var i=0; i<selectgroup.length; i++) {
			var questionnum;
			if (parseInt(selectgroup[i].name) < 81) {
				questionnum = parseInt((parseInt(selectgroup[i].name)-3)/6);
				if (selectgroup[i].value == "--") {
					errnums1.push(questionnum);
					returnval = false;
				} else {
					if (!obj[questionnum]) obj[questionnum] = [];
					obj[questionnum].push(selectgroup[i].value);
				}
			//alert('Question Number: '+this.name)
			} else {
				questionnum = parseInt((parseInt(selectgroup[i].name)-77)/4);
				if (selectgroup[i].value == "--") {
					errnums2.push(questionnum);
					returnval = false;
				} else {
					if (!obj2[questionnum]) obj2[questionnum] = [];
					obj2[questionnum].push(selectgroup[i].value);
				}
			}
	}
	
/*
	for (var i=1; i<25; i++) {
		var mostleastgroup;
		mostleastgroup = $("input.question"+i);
		var most = false;
		var least = false;
		for (var ii=0, len=mostleastgroup.length;ii<len;ii++) {
			if (mostleastgroup[ii].checked) {
				if (mostleastgroup[ii].value == "Most") most = true;
				if (mostleastgroup[ii].value == "Least") least = true;
			}
		};
		if (!(most == true && least == true)) {
			errnums2.push(i);
			returnval = false;	
		}
	}
*/

	for (var i=1; i<13; i++) {
		if (obj[i]) {
			//alert(uniqueArr(obj[i]).length);
			if (uniqueArr(obj[i]).length < 6) {
				//alert(uniqueArr(obj[i]).length);
				errnums1.push(i);
				returnval = false;
			}
		}
	}
	
	for (var i=1; i<25; i++) {
		if (obj2[i]) {
			//alert(uniqueArr(obj[i]).length);
			if (uniqueArr(obj2[i]).length < 4) {
				//alert(uniqueArr(obj2[i]).length);
				errnums2.push(i);
				returnval = false;
			}
		}
	}
	
	var namefields;
	namefields = $("input.reqfields");
	nameprobs = false;
	
	for (var i=0; i<namefields.length; i++) {
		if (namefields[i].value == namefields[i].defaultValue || namefields[i].value == "") {
			nameprobs = true;
			returnval = false;
		}
	}
	
	errnums1.sort(function(a,b) {return a-b});
	errnums2.sort(function(a,b) {return a-b});
	
	if (nameprobs == true) {
		if (errnums1.length > 0 || errnums2.length > 0) {
			message = message + "the name and information fields and in ";
		} else {
			message = message + "the name and information fields.";
		}
		
	}
	
	if (errnums1.length > 0 && errnums2.length > 0) joinword = " and ";
	
	if (errnums1.length > 0) {
		var pluralending = "";
		if(uniqueArr(errnums1).length > 1) pluralending = "s";
		message1 = "section 1, question" + pluralending + " " + uniqueArr(errnums1).join(", ");
	}

	if (errnums2.length > 0) {
		var pluralending = "";
		if (uniqueArr(errnums2).length > 1) pluralending = "s";
		message2 = "section 2, question" + pluralending + " " +uniqueArr(errnums2).join(", ");
	}
	
	if (!returnval) {
		alert(message + message1 + joinword + message2 + ".\nPlease check your answers and try again.");
	}

	return returnval;
}

function uniqueArr(origArr) {
	    var newArr = [],  
        origLen = origArr.length,  
        found,  
        x, y;  
          
    for ( x = 0; x < origLen; x++ ) {  
        found = undefined;  
        for ( y = 0; y < newArr.length; y++ ) {  
            if ( origArr[x] === newArr[y] ) {   
              found = true;  
              break;  
            }  
        }  
        if ( !found) newArr.push( origArr[x] );      
    }  
   return newArr; 
}

function QuestionCount(origArr) {
	    var newArr = [],  
        origLen = origArr.length,  
        found,  
        x, y;  
          
    for ( x = 0; x < origLen; x++ ) {  
        found = undefined;  
        for ( y = 0; y < newArr.length; y++ ) {  
            if ( origArr[x] === newArr[y] ) {   
              found = true;  
              break;  
            }  
        }  
        if ( !found) newArr.push( origArr[x] );      
    }  
   return newArr; 
}

</script>

</head>

<body>

