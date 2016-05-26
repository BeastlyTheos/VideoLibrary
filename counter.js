 (function1()(jQuery);
 
function function1($) {
     $.fn.extend( {limiter: function2(limit, elem) });
 }
 
function function2(limit, elem)  
 {$(this).on("keyup focus", function3() );
             
function function3()
	{setCount(this, elem);
	             }
             
             function setCount(src, elem)
	             {var chars = src.value.length;
	                 if (chars > limit)
		{src.value = src.value.substr(0, limit);
		                    chars = limit;
		                 }
	elem.html( limit - chars );
	}
             
             
             setCount($(this)[0], elem);
         }
         
//to  setup the limiter, simply include a call similar to the one below:
var elem = $("#chars");
$("#text").limiter(100, elem);
//The first parameter is the character limit integer and the second is a jQuery element representing the target object to display the characters remaining. This is not a replacement for the maxlength parameter or server-side validation, just a visual way to represent the limit.
