function ValidateAccountData()
{var f = document.forms[0];
var isValid = true;

var v = f["title"].value;
if(null == v || "" == v)
	{document.getElementById("TitleError").className = "InputError";
	isValid = false;
	}
else
	document.getElementById("TitleError").className = "InputValid";

v = f["rating"].value;
$("#RatingError").remove();
if ( null == v || "" == v )
	{$("#rating").parent().append('<span id="RatingError" class="InputError">Rating is required.</span>');
	isValid = false;
	}

v = f["genre"].value;
if(null == v || "" == v)
	{
	document.getElementById("GenreError").className = "InputError";
	isValid = false;
	}
else {
document.getElementById("GenreError").className = "InputValid";
}

v = f["theatreReleaseDate"].value;
if ( 0 < v.length && ! v.match(/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/(19|20)\d\d$/) )
	{document.getElementById("TRDError").className = "InputError";
	isValid = false;
	}
else
	document.getElementById("TRDError").className = "InputValid";


v = f["DVDReleaseDate"].value;
if ( 0 < v.length && ! v.match(/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/(19|20)\d\d$/) )
	{document.getElementById("DRDError").className = "InputError";
	isValid = false;
	}
else
	document.getElementById("DRDError").className = "InputValid";


v = $("input[type='checkbox']:checked");
if(null == v || 0 == v.length)
	{document.getElementById("VideoFormatError").className = "InputError";
	isValid = false;
	}
else
	document.getElementById("VideoFormatError").className = "InputValid";

return isValid;
}




(function($) {
$.fn.extend( {
limiter: function(limit, elem) {
$(this).on("keyup focus", function() {
setCount($(this), elem); 
});
function setCount(src, elem) {
var chars = src.val().length;
if (chars > limit) {
src.val(src.val().substr(0, limit));
chars = limit;
}
elem.html( limit - chars );
}
var numAlerts = 0;
setCount(this, elem);
}
});
})(jQuery);

$(document).ready(function() {
	$("#ps").limiter(1000, $("#PSCounter"));
	//$("#TheatreReleaseDate").datepicker();
	$("#DVDReleaseDate").datepicker();
	datePickerController.createDatePicker(
		{// Associate the text input to a DD/MM/YYYY date format                            
		formElements: { "TheatreReleaseDate": "%m/%d/%Y"},
		noFadeEffect: true,
		labelText: "Theater Release Date"
		        });
	});
