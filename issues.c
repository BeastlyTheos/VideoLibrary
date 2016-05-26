  notes to marker:
 username = samwise password = you 
site at frigg.trentu.ca/~theodorecooke 
db dump doesn't have full dataset,   but all the structure is there 
I tested this cross browser, and all the functionality was there, but I wasn't able to test the quality of the style 
there's two inputs for ratings. one for stars,the other for self-sensorship rating. I can't change the name of the stars element, cause I cannot understand the code, and I cannot change the name of the other one, cause that'll break the php

general:
 Canadianised the date format and rating system (Canadian Home Video Rating System) 
designed accounts with the ability to edit usernames, then discovered Jacque doesn't want them editable 
since I have userids that stay constant, I think it is ok for me to leave usernames editable 
session originally just stored username, now stores object with userid, username, firstName, and lastName 
pages that require the user be logged in redirect to the login page. this is basically everything.
 hash function = openssl_encrypt($value, 'AES-256-CBC', 'hashstring') this hash function isn't available on frigg, nor is the encrypn function from the notes therefore, not encrypting rememberMe cookie 
ALL JavaScript/jQuery (including the event handlers) must be in an external js file.
 If form validation fails, the form should not continue with submission.

 to do:
 HTML pages must validate to XHTML 1.0 Strict. (http://validator.w3.org/) CSS must validate to CSS 3 standards. (http://jigsaw.w3.org/css-validator/)
 proper error logging so users don't see every php error 
setup password restrictions to force the user to have a secure password 
use htmlspecialchars when displaying any user-provided text code 
add parameter to htmlspecialchars on search.php such that it uses ENT_HTML5 charset 
maybe use regexp to validate more than just dates 
format checkboxes are not preselecting on edit video 
should just change mysql date fields to text, or could use year and date formats with code like | date_format(DVDReleaseDate, '%d-%m-%Y') |, then when entering, need to confirm they're written right 
salt the password incryption 
change naming convention so unique elements such as menu, main, and footer are specified by id, not by class. before submitting, search for all #s to find css ids in global. css, and make sure they shouldn't be changed to classes 
rename imag folder to img, then fix all im src 
can dynamically set the sizes of text inputs based on sizes of the sql elements 
set age to be a non-required value 
review requirements for both user accounts and video records 
add fieldset to add and edit videos around the sex radio buttons 
remove placeholders and type=email since they're apparently not xhtml 1.0 strict 

JavaScript 
2. *there's two inputs for ratings. one for stars,the other for self-sensorship rating. I can't change the name of the stars element, cause I cannot understand the code, and I cannot change the name of the other one, cause that'll break the php
3. *the default implementation of this is not accessible to me.
4. Using jQuery, jQuery UI and AJAX, to modify the index page so that clicking the details link under a movie uses AJAX to load the display details page for that movie in a jQuery UI dialog pop-up.
 This will allow the user to view the details of each movie without ever leaving the page. (
Note: you';ll need to modify the display details page to strip out the site wrapper (header, nav, footer), the dialog should just display the details part of the page.)
You should not be using an alert for any of your error messages 

questions:
 if I take the below line, remove the div, and move the div styles to the image, what happens?
<div class='CoverArt'><img src='/img/$coverArt' width='75'></div>
why do span elements appear on different lines when the code has them on different lines? 

template:
menu now uses php to determine which links to show 

index.php 
displays friendly message if user has no videos 

add account.php 
successful registration automatically logs in, and returns to index.php 
redirects to profile.php if logged in 
post validation moved to library function 
removed placeholders and type=email since they're apparently not xhtml 1.0 strict 


edit account.php 
not updating email preferences.
 probably a problem in the validation function 

validate account data function 
might have a problem with updating email preferences

delete account:
only deletes account if provided username matches session username, and if password is correct 

add video.php 
to activate multi-select mode in jaws, hit shift 8 
using Ontario standard film rating system 
textarea maybe should have rows and columns specified by css instead of inline style. Should be use css now 
textarea seems to be too narrow 
do some error checking for file upload. this involves moving file upload code before the insertion Edit video 
mmulti-select box for genre might not be pre-selecting 
no error handling if sql cannot find video with given id. This line should also be split into two statements for better error handling 
code for querying and displaying genres is more complex than needs to be because I insisted on my db being fn1 
there's two inputs for ratings. one for stars,the other for self-sensorship rating. I can't change the name of the stars element, cause I cannot understand the code, and I cannot change the name of the other one, cause that'll break the php
the current method for the char counter doesn't work on ff nor chrome. fixed by changing PSCounter from a input to a span
stars slider needs css to remove margins from the divs
js was appending a new InputError span every time the add video button was clicked. fixed by removing any element with id = RatingError before even checking if there is an error

validate video data 
if cover art has incorrect filetype, or there is an error with genre insertion, error message is added to errorText, but is not displayed because video is still inserted when code for cover art file upload is moved before record insertion, the record insertion should be modified to include the file extention maybe dates shouldn't be required fields need to fix date formats.
 are currently rearranged to format yyyy-dd-mm delete_video.
php Seems to work display details.
php need error checking when selecting video data.
 check line 11 double check what jacque said about the formatting of this page.
 Can't find much special Shouldn't this page have links to delete and/or edit? has one small, but unsolvable issue preventing it from validating search.
php searches for multiple words using regexp I'd prefer a better error message if no videos are found Maybe there's a bug caused by bad logic in the body's if else series login.
php notes for this file might be confused with notes for session_start.
php validates session_start.
php assumes vidlib cookie is not encrypted notes for login.
php might reference this file by mistake logout.
php All good sql.
php:
 works, but logic of variable declarations at top could be cleaned up database:
 video table DVDReleaseDate and TheatreReleaseDate need their datatypes altered to date.
 done.
 now is it possible to specify anytihng other than yyyy-mm-dd? currently have a field for rating, but I actually need two rating fields, one for some sort of numeric rating, and another for the G, PG, PG14, etc from Jamie's notes:
 input size=6 maxlength=4 plot summary should be 5x75
</body>
</html>
