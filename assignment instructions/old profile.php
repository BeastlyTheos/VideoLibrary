<?
include"session_start.php";

if( ! $loggedIn)
	header('location: register.php');

$errorText = array(); //used for storing texts about form errors to show the user

if ( count($_POST)) //if there is post data
	{
	
	//validate required values
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
		var_dump($stmt);
echo mysqli_error($sql);
		$stmt->bind_param('ssssssii', $username, $password, $firstName, $lastName, $email, $sex, $age, $inactivityEmails);
		$stmt->execute();
		
		//start the session and log in  the user. this block is borrowed from login.php
		session_start();
		$_SESSION['username'] = $_POST['username'];
		if(isset($_POST['rememberMe']) && "on" == $_POST['rememberMe'])
			setcookie('vidlib', $_POST['username'], 10000000);
		
		header('location: ');
		}//end if there are no form errors
	}//if there is post data
	
require_once 'sql.php';
$data = $sql->query('select * from user where username = "'.$_SESSION['username'].'"')->fetch_assoc();
if($sql->errno)
echo $sql->error;
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Edit Profile</title>
<link rel="stylesheet" type="text/css" href="style/reset.css">
<link rel="stylesheet" type="text/css" href="style/global.css">
</head>

<body>
<?include"header.php";
include"menu.php";?>

<div class="Main">
<h1>Edit Profile</h1>
<form action="edit_profile.php" method="post">
	<label>first name: <input value="<?echo $data['firstName'];?>" type="text" name="firstName" autofocus></label><br/>
<label>last name: ><input value=<?echo $data['lastName']?>" type="text" name="lastName"  autocomplete="on"></label><br/>
<label>email: ><input value="<?echo $data['email']?>" type="email" name="email" autocomplete="on" placeholder="example@video.com"></label><br/>
<label>password: ><input type="password" name="password"></label><br/>
<label>verify password: ><input type="password" name="passwordConfirmation"></label><br/>
<label>Male: <input type="radio" name="sex" value="male" <?echo 'male'==$data['sex']?'checked':''?>></label><br>
<label>Female: <input type="radio" name="sex" value="female" <?echo 'female'==$data['sex']?'checked':''?>></label><br>
<label>Other: <input type="radio" name="sex" value="other" <?echo 'other'==$data['sex']?'checked':''?>></label><br>
<label>Choose not to disclose: <input type="radio" name="sex" value="undisclosed"  <?echo 'undisclosed'==$data['sex']?'checked':''?>></label><br>
<label>age: ><input type="range" min=0 max=120 value=25 name="age"  autocomplete="on" <?echo $data['age']?>></label><br/>
<label><input name="inactivityEmails" type="checkbox" <?echo $data['inactivityEmails']?'checked':''?>>Send me emails when I haven't watched anything in over 30 days</label><br>
<input type="submit" value="Edit my profile">
<input type="reset" value="reset all fields to their default values">
</form>
</div>

<?include"footer.php";?>
</body>
</html>