Trent University 
COIS 3420H 
Assignment #3 
Due: December 7th, 2015. 


JavaScript/jQuery can be used for validation to improve server performance, and to improve usability. ALL JavaScript/jQuery 
(including the event handlers) must be in an external js file. If form validation fails, the form should not continue with submission. 
Your JavaScript should validate the following: 

1. 
You must complete the following form validation for the Add Vid page 
a. 
Something is entered for title (correctness not really important) 
i. 
For this error, place the error message in the HTML, something like 
<span id=”titleerror”>You must enter a title</span> 
ii. 
Write two CSS classes, one where the element is visible and styled as an error message, the other where the 
element is invisible (use the visibility property). The second class should be applied initially. 
iii. 
The validation should then change the CSS class for the span element to make the error “appear” when 
appropriate 
b. 
An MPAA rating must be selected 
i. 
For this error, there should not be a pre-existing error message in the HTML 
ii. 
Use jQuery to create the appropriate form element and add it to the DOM. It should also remove the 
element if it’s no longer needed 
iii. 
Make sure to style the error the same as the title for consistency (you can actually use the same class) 
c. 
At least one genre should be selected 
i. 
You can use either above methods for displaying the error 
d. 
Theatre, and DVD release (if they have anything in them) must be in a valid date format (I prefer mm/dd/yyyy, but 
if you’d like to validate to MySQL format for easy of inserting into the database..that’s fine) 
i. 
Again you can display the error message any way you want 
e. 
Plot summary must be less then 1000 characters. 
i. 
Include a jQuery based visual counter which decreases as the user types, and doesn’t let them type more 
then 1000 characters 
ii. 
There is a good (and up to date) example, here 
http://www.scriptiny.com/2012/09/jquery-input-textarea-limiter/ 
f. 
At least one video type must be selected 
i. 
You can use either method for displaying the error 
2. 
Use the jQuery RateIt plugin to replace the Rating dropdown with a visual star rating system (Use the progressive 
enhancement using select version) 
i. 
http://rateit.codeplex.com/ 
3. 
Use jQueryUI to add a date selector to each of the dates on the Add Vid page 
Bonus Content: You can add an extra 10% to this assignment's grade by including the following task. There is no penalty for NOT 
including item #4. 

4. 
Using jQuery, jQuery UI and AJAX, to modify the index page so that clicking the details link under a movie uses AJAX to 
load the display details page for that movie in a jQuery UI dialog pop-up. This will allow the user to view the details of each 
movie without ever leaving the page. (Note: you’ll need to modify the display details page to strip out the site wrapper 
(header, nav, footer), the dialog should just display the details part of the page.) 
You should not be using an alert for any of your error messages 

your submission MUST include current/maintained/updated versions of your naming convention, your data dictionary as well as your 
project issues document. 

For submission, please zip the entire directory, keeping the directory structure intact, and submit on blackboard, along with a link to 
the live version of the application and credentials for logging in. Blackboard submission ZIP files should be named: 
firstname_lastname_Assignment3.zip. 

Note: using the firebug extension will make working with JavaScript a lot less headache inducing. 


