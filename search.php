<?require 'functions.php';
require'sql.php';
require "session_start.php";
if( ! $loggedIn)
	header('location: login.php');

$keywords = ''; //initialise keywords so code in body doesn't fail

if(isset($_GET['keywords']) && $_GET['keywords']) //if keywords are provided 
	{if(isset($_GET['startAt'])) //at which index to start the sql limit clause
		{$startAt = (int) $_GET['startAt'];
		if(0 > $startAt)
			$startAt = 0;
		}
	else //startAt not provided
		$startAt = 0; //set to default
	
	$keywords = $_GET['keywords'];
	$regexpKeywords = $sql->real_escape_string( str_replace(' ', '|', $keywords));
	$videos = $sql->query("select id, title, coverArtFileExt from video where title regexp '$regexpKeywords' and userid = ".$_SESSION['user']['id']." order by id asc limit $startAt, 12");
	}//end if get keywords were provided

PrintHTMLHeader('Search Videos', '');

echo '<body>';
PrintHeader();
PrintMenu();
?>

<div class="Main">
<h1>search my videos</h1>
<?if( ! $keywords)
	echo '<p>Enter search terms below to search videos.</p>';
else if( ! $videos || ! $videos->num_rows)
	echo '<p>Sorry, no videos were found with '.htmlspecialchars($keywords).' in their title.</p>';
else{//print available videos
	PrintVideosTable($videos, $startAt);
	if($startAt) //if there are prior videos
	echo '<a href="search.php?keywords='.urlencode($_GET['keywords']).'&startAt='.($startAt-12).'">previous</a>';
if(12 == $videos->num_rows) //if there are possibly more videos to display (will accidently show if numVideos%12==0
	echo '<a href="search.php?keywords='.urlencode($_GET['keywords']).'&startAt='.($startAt+12).'">next</a>';
}?>

<form action="search.php" method="get">
<div><label for="keywords">Keywords: </label><input id="keywords" name="keywords" type="text" value="<?echo htmlspecialchars($keywords)?>"/></div>
<div><input type="submit" value="search by these keywords"/></div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>