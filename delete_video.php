<?require 'session_start.php';
require 'sql.php';
if ( ! $loggedIn)
	header('location: login.php');

if(isset($_GET['id']))
	{$videoId = (int) $_GET['id'];
	
	$sql->query("delete from video where id = $videoId and userid = ".$_SESSION['user']['id']); //fails if video does not belong to user
	header('location: index.php');
	}//end if GET id is set
else
	header('location: search.php');
?>