<?session_start();

if(isset($_SESSION['user'])) //if this user is already logged in
	$loggedIn = true;
else if(isset($_COOKIE['vidlib'])) //if user has valid cookie
	{//validate that cookie corresponds to a userid
	require_once 'sql.php';
	
	$userid = (int) $_COOKIE['vidlib'];
	//$userid = (int) openssl_decrypt($_COOKIE['vidlib'], 'AES-256-CBC', 'ThisIsASecretHash'); //frigg doesn't have ssl function
	$result = $sql->query("select id, username, firstName, lastName  from user where id = $userid");
	if($result->num_rows)
		{$_SESSION['user'] = $result->fetch_assoc();
		$loggedIn = true;
		}//end if there is a vidlib cookie which corresponds to a user
	}//end if there is a vidlib cookie
else //user is not logged in
	$loggedIn = false;
?>