<?require'sql.php';
include"session_start.php";

$username = $password = $firstName = $lastName = $email = $sex = $age = $inactivityEmails;
$errorText = array(); //used for storing texts about form errors to show the user


if ( count($_POST)) //if there is post data
	{//validate required values
	if( 0 == strlen($_POST['username']))
		$errorText[] = 'Username is required';
	else
		$username = $_POST['username'];
		if( 0 == strlen($_POST['password']) || 0 == strlen($_POST['passwordConfirmation']))
		$errorText[] = 'password and password confirmation are required';
	else if ($_POST['password'] != $_POST['passwordConfirmation'])
		$errorText[] = 'passwords do not match';
	else
		$password = $_POST['password'];
	if( 0 == strlen($_POST['firstName']))
		$errorText[] = 'first name is required';
	else
		$firstName = $_POST['firstName'];
	if( 0 == strlen($_POST['lastName']))
		$errorText[] = 'last name is required';
	else
		$lastName = $_POST['lastName'];
	if( 0 == strlen($_POST['email']))
		$errorText[] = 'email is required';
	else
		$email = $_POST['email'];
	if( 0 == strlen($_POST['age']))
		$errorText[] = 'age is required';
	else
		$age = (int) $_POST['age'];
	
	if ( 0 == count($errorText)) //if there's no users, submit the data
		{//set non-required values
		if( ! isset($_POST['sex']))
			$sex = 'undisclosed';
		else
			$sex = $_POST['sex'];
		if( ! isset($_POST['inactivityEmails']))
			$inactivityEmails = 0;
		else
			$inactivityEmails = (int) $_POST['inactivityEmails'];
		
		$stmt = $sql->prepare('insert into user set username = ?, password = password(?), firstName = ?, lastName = ?, email = ?, sex = ?, age = ?, inactivityEmails = ?');
		$stmt->bind_param('ssssssii', $username, $password, $firstName, $lastName, $email, $sex, $age, $inactivityEmails);
		$stmt->execute();
		
		if($sql->errno) //if registration fails
			{switch ($sql->errno)
				{			case 1062: $errorText[] = 'username is already taken. Please select another'; break;
				default: $errorText[] = 'Sorry, an unknown database error has occured. Please contact the administrater';
				}
			}//end if registration fails
		else //successful registration!
			{//start the session and log in  the user. this block is borrowed from login.php
			$_SESSION['username'] = $_POST['username'];
			if(isset($_POST['rememberMe']) && "on" == $_POST['rememberMe'])
				setcookie('vidlib', $_POST['username'], 10000000);
		
			header('location: ');
			}//end if registration did not fail
		}//end if there are no form errors
	}//if there is post data
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title><?echo $loggedIn?'Edit Profile':'Create Profile'?></title>
<link rel="stylesheet" type="text/css" href="style/reset.css">
<link rel="stylesheet" type="text/css" href="style/global.css">
</head>

<body>
<?include"header.php";
include"menu.php";?>

<div class="Main">
<h1><?echo $loggedIn?'Edit Profile':'Create Account'?></h1>
<form action='profile.php' method="post">
<?if ( 0 != count($errorText))
	{echo 'Please correct the following '.count($errorText)." errors: <br>\n";
	foreach ($errorText as $et)
		echo "$et.<br>\n";
	}
?>
<label>Username: ><input type="text" name="username" value="<?echo $username?>" autofocus></label><br/>
<label>Password: ><input type="password" name="password" ></label><br/>
<label>Verify Password: ><input type="password" name="passwordConfirmation"></label><br/>
<label>First Name: ><input type="text" name="firstName"></label><br/>
<label>Last Name: ><input type="text" name="lastName"></label><br/>
<label>Email: ><input type="email" name="email" placeholder="example@video.com"></label><br/>
<label>Male: <input type="radio" name="sex" value="male"></label><br>
<label>Female: <input type="radio" name="sex" value="female"></label><br>
<label>Other: <input type="radio" name="sex" value="other"></label><br>
<label>Choose not to disclose: <input type="radio" name="sex" value="undisclosed"></label><br>
<label>Age: ><input type="range" min=0 max=120 value=18 name="age" ></label><br/>
<label><input name="inactivityEmails" type="checkbox">Send me emails when I haven't watched anything in over 30 days</label><br>
<label><input name="rememberMe" type="checkbox">Remember my username and password</label><br>
<input type="submit" value="register">
<input type="reset" value="reset all fields to their default values">
</form>
</div>

<?include"footer.php";?>
</body>
</html>