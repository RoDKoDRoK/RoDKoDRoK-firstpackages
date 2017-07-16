

function ajaxCall(iddivdest,ajaxdest,lang)
{
	$.ajax({
				async: "true",
				type: "post",
				url: "ajax.php",
				data: "ajax="+ajaxdest+"&lang="+lang,
				error: function(errorData) { $("#"+iddivdest).html(errorData); },
				success: function(data) {
							$("#"+iddivdest).html(data);
							$("#"+iddivdest).fadeIn("slow", "linear");
						}
		});
}



