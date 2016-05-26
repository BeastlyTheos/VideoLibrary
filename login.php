<?require_once 'functions.php';
require 'sql.php';
require  'session_start.php';
if($loggedIn)
	header('location: index.php');

$errorText = array(); //string array for form errors

//validate post data
if(isset($_POST['username']) && isset($_POST['password']))
	{//fetch data for given user, and check if password is valid
	$username = $sql->real_escape_string($_POST['username']);
	$pw = $sql->real_escape_string($_POST['password']);
	
	$res = $sql->query("select password = password('$pw') as isPWCorrect from user where username = '$username'");
	if($row = $res->fetch_assoc())
		{if($row['isPWCorrect'])
			{$res = $sql->query("select id, username, firstName, lastName from user where username = '$username'");
			$_SESSION['user']   = $res->fetch_assoc();
			
	if(isset($_POST['rememberMe']) && "on" == $_POST['rememberMe'])
				setcookie('vidlib', $_SESSION['user']['id'], time()+ 86400); //from slides: 			setcookie("vidlib",encrypt($row['ID']),time()+60*60*24*30*12);
				//setcookie('vidlib', openssl_encrypt($_SESSION['user']['id'], 'AES-256-CBC', 'ThisIsASecretHash'), time()+ 86400); //from slides: 			setcookie("vidlib",encrypt($row['ID']),time()+60*60*24*30*12); //frigg server does not have openssl function
				
			header('location: index.php');
			}//end if credentials validate
		}//end if there's such a user
	else
		$errorText[] = 'Sorry, incorrect username or password';
	}//end if there is post data

PrintHTMLHeader('login', '');

echo '<body>';
PrintHeader();
PrintMenu();
?>

<div class="Main">
<h1>Login</h1>
or <a href="add_account.php">register.</a>
<form action="login.php" method="post">
<?displayErrors($errorText);?>
<div><label for='username'>Username: </label><input id='username' name="username" type="text"/></div>
<div><label for='pw'>Password: </label><input id='pw' name="password" type="password" /></div>
<div><input name="rememberMe" type="checkbox" id='rememberMe'/><label for='rememberMe'>Remember me</label></div>
<div class='buttons'>
<input type="submit" value="login"/>
<input type="reset" value="reset fields to their default values"/></div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>