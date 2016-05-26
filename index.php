<?//header("Content-type: text/html; charset=utf-8");
require_once 'functions.php';
require 'sql.php';
include "session_start.php";
if ( ! $loggedIn)
	header('location: login.php');

if(isset($_GET['startAt']))
	{$startAt = (int) $_GET['startAt'];
	if(0 > $startAt)
		$startAt = 0;
	}
else
	$startAt = 0;

$videos = $sql->query('select id, title, coverArtFileExt from video where userid = '.$_SESSION['user']['id']." order by id asc limit $startAt, 12");


PrintHTMLHeader($_SESSION['user']['username'].'\'s videos',
'');
echo '<body>';
PrintHeader();
PrintMenu();
?>





<div class="Main">
<h1><?echo 'Welcome, '.$_SESSION['user']['firstName'].' '.$_SESSION['user']['lastName']?></h1>
<?if( ! $videos || 0 === $videos->num_rows)
	echo '<p>You don\'t have any videos uploaded yet. Why don\'t you try <a href="add_video.php">adding one?</a></p>';
else{//print available videos
PrintVideosTable($videos, $startAt);
if($startAt) //if there are prior videos
	echo '<a href="?startAt='.($startAt-12).'">previous</a>';
if(12 == $videos->num_rows) //if there are possibly more videos to display (bugged if total numvideos%12==0
	echo '<a href="?startAt='.($startAt+12).'">next</a>';
}?>
</div>

<div id="DetailsDialog" title="details of selected video"></div>
<?PrintFooter()?>
<script type="text/javascript" src="scripts/index.js"></script>
</body>
</html>