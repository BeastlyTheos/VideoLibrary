<?require_once 'functions.php';
include_once "session_start.php";
if($loggedIn)
	header('location: edit_account.php');

$errorText = array(); //used for storing texts about form errors to show the user

if ( count($_POST)) //if there is post data
	{ValidateAccountData();
	if ( 0 == count($errorText)) //successful registration!
		{LoginUser();		
		header('location: index.php');
		}//end if there are no form errors
	}//if there is post data


PrintHTMLHeader( 'register', '');

echo '<body>';
PrintHeader();
PrintMenu($loggedIn);
?>

<div class="Main">
<h1>Create Account</h1>
<form action='add_account.php' method="post">
<?DisplayErrors($errorText)?>
<div><label for="username">Username: </label><input id='username' type="text" name="username"/></div>
<div><label for="password">Password: </label>><input id='password' type="password" name="password"/></div>
<div><label for='passwordConfirm'>Verify Password: ></label><input id='passwordConfirm' type="password" name="passwordConfirmation"/></div>
<div><label for='firstName'>First Name: ></label><input id='firstName' type="text" name="firstName"/></div>
<div><label for='lastName'>Last Name: ></label><input id='lastName' type="text" name="lastName"/></div>
<div><label for='email'>Email: ></label><input id='email' type="text" name="email"/></div>
<div><label for='male'>Male: </label><input id='male' type="radio" name="sex" value="male"/></div>
<div><label for='female'>Female: </label><input id='female' type="radio" name="sex" value="female"/></div>
<div><label for='other'>Other: </label><input id='other' type="radio" name="sex" value="other"/></div>
<div><label for='undisclosed'>Choose not to disclose: </label><input id='undisclosed' type="radio" name="sex" value="undisclosed"/></div>
<div><label for='age'>Age: ></label><input id='age' type="text" name="age"/></div>
<div><input name="inactivityEmails" type="checkbox" id='inactivityEmails'/><label for='inactivityEmails'>Send me emails when I haven't watched anything in over 30 days</label></div>
<div><input name="rememberMe" type="checkbox" id='rememberMe'/><label for='rememberMe'>Remember my username and password</label></div>
<div class='buttons'>
<input type="submit" value="register"/>
<input type="reset" value="reset all fields to their default values"/></div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>