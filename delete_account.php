<?require 'functions.php';
require 'sql.php';
require "session_start.php";
if( ! $loggedIn)
	header('location: login.php');

$errorText = array();

if ( isset($_POST['username'])  && isset($_POST['password'])) //if username and password were provided
	{$username = $sql->real_escape_string($_POST['username']);
	$pw = $sql->real_escape_string($_POST['password']);
	
	$sql->query("delete from user where username = '$username' and password = password('$pw') and id = ".$_SESSION['user']['id']);
	switch($sql->affected_rows)
		{case 0: $errorText[] = 'incorrect username or password'; break;
		case 1: header('location: logout.php'); break;
		default: $errorText[] = 'system error. Please contact web admins';
		}
	}//end if username and pw were provided
	

PrintHTMLHeader('Delete Account', '');

echo '<body>';
PrintHeader();
PrintMenu();
?>

<div class="Main">
<h1>Delete Account</h1>
<?DisplayErrors($errorText)?>
<form action="delete_account.php" method="post">
<?DisplayErrors($errorText)?>
<div><label for='username'>Your Username: </label><input <id='username' name="username" type="text" autofocus></div>
<div><label for='pw'>Password: </label><input id='pw' name="password" type="password"></div>
<b><u>Warning: This action cannot be undone.</u></b>
<div class='buttons'>
<input type="submit" value="Delete me">
<input type="reset" value="reset fields to their default values"></div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>