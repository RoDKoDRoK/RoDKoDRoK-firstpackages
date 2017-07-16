

function ajaxCall(iddivdest,ajaxdest,params,callback=null)
{
	$.ajax({
				async: "true",
				type: "post",
				url: "index.php?chainconnector=ajax&ajax="+ajaxdest,
				data: params, //+"&lang="+lang,
				error: function(errorData) { $("#"+iddivdest).html(errorData); },
				success: function(data) {
							$("#"+iddivdest).html(data);
							$("#"+iddivdest).fadeIn("slow", "linear");														if(callback && typeof(callback) === "function")								callback();
						}
		});
}
function initWindows(){	if(document.getElementById("initwindow"))		return;		$("#init").append("<div id='initwindow'></div>");	$("#initwindow").append("<div id='widewindow' class='window' style='display:none'></div>");	$("#initwindow").append("<div id='smallwindow' class='window' style='display:none'></div>");	$("#initwindow").append("<div id='mediumwindow' class='window' style='display:none'></div>");}//centerPopup('idDeMonElement');function centerPopup(element) {	var topcour=window.scrollY + 200; //($(window).height() - $("#"+element).outerHeight()) / 2;	var leftcour=($(window).width() - $("#"+element).outerWidth()) / 2;	document.getElementById(element).style.top=topcour;	document.getElementById(element).style.left=leftcour;}function windowCall(iddivwindowdest,ajaxdest,params){	ajaxCall(iddivwindowdest,ajaxdest,params);		centerPopup(iddivwindowdest);}$(document).ready(function(){	initWindows();});


