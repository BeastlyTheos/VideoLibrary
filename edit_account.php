<?require 'functions.php';
require 'sql.php';
REQUIRE "session_start.php";
if( ! $loggedIn)
	header('location login.php');
	
$errorText = array(); //used for storing texts about form errors to show the user

if ( count($_POST)) //if there is post data
	{ValidateAccountData();
	if ( 0 == count($errorText)) //if the update was successful
		{//update session variables
		$_SESSION['user'] = $sql->query('select * from user where id = '.$_SESSION['user']['id'])->fetch_assoc();
		
		header('location: index.php'); //just send them home :P
		}//end if update was successful
	}//if there is post data

$userid = $_SESSION['user']['id'];
$data = $sql->query('select * from user where id = '. $_SESSION['user']['id']);
$data = $data->fetch_assoc();
//requires error checking in case failed to query user data

PrintHTMLHeader('Edit '.$_SESSION['user']['username'], '');

echo '<body>';
PrintHeader();
PrintMenu();
?>

<div class="Main">
<h1>Edit Account</h1>
<form action="edit_account.php" method="post">
<?DisplayErrors($errorText)?>
<div>	<label for='fn'>first name: </label><input id='fn' value="<?echo $data['firstName'];?>" type="text" name="firstName"/></div>
<div><label for='ln'>last name: ></label><input id='ln' value="<?echo $data['lastName'];?>" type="text" name="lastName"/></div>
<div><label for='em'>email: ></label><input id='em' value="<?echo $data['email']?>" type="text" name="email"/></div>
<div><label for='pw'>password: ></label><input id='pw' type="password" name="password"/></div>
<div><label for='vpw'>verify password: ></label><input id='vpw' type="password" name="passwordConfirmation"/></div>
<div><label for='male'>Male: </label><input id='male' type="radio" name="sex" value="male" <?echo 'male'==$data['sex']?'checked':''?>/></div>
<div><label for='female'>Female: </label><input id='female' type="radio" name="sex" value="female" <?echo 'female'==$data['sex']?'checked':''?>/></div>
<div><label for='other'>Other: </label><input id='other' type="radio" name="sex" value="other" <?echo 'other'==$data['sex']?'checked':''?>/></div>
<div><label for='undisclosed'>Choose not to disclose: </label><input id='undisclosed' type="radio" name="sex" value="undisclosed"  <?echo 'undisclosed'==$data['sex']? 'checked="checked"' : ''?>/></div>
<div><label for='age'>age: ></label><input id='age' type="text" name="age"   value="<?echo $data['age']?>"/></div>
<div><input name="inactivityEmails" type="checkbox" <?echo $data['inactivityEmails']? 'checked="checked"' : ''?> id='inactivityEmails'/><label for='inactivityEmails'>Send me emails when I haven't watched anything in over 30 days</label></div>
<div class='buttons'>
<input type="submit" value="Edit my profile"/>
<input type="reset" value="reset all fields to their default values"/></div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>