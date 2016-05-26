1 (function($) {
2     $.fn.extend( {
3         limiter: function(limit, elem) {
4             $(this).on("keyup focus", function() {
5                 setCount(this, elem);
6             });
7             function setCount(src, elem) {
8                 var chars = src.value.length;
9                 if (chars > limit) {
10                     src.value = src.value.substr(0, limit);
11                     chars = limit;
12                 }
13                 elem.html( limit - chars );
14             }
15             setCount($(this)[0], elem);
16         }
17     });
18 })(jQuery);
To setup the limiter, simply include a call similar to the one below:

1 var elem = $("#chars");
2 $("#text").limiter(100, elem);
The first parameter is the character limit integer and the second is a jQuery element representing the target object to display the characters remaining. This is not a replacement for the maxlength parameter or server-side validation, just a visual way to represent the limit.
