<?require'sql.php';
$videoId = $sql->real_escape_string($_GET['id']);
//next line should be split into two lines for better error handling
if ( ! $v = $sql->query('select * from video where id = '.$videoId)->fetch_assoc()) //retrieves video data in associative array
	return "";

//need to do error checking here

	//retrieve list of genres
$genresSQL = $sql->query('select genre from video_genre where videoId = '.$v['id']);
$genresArray = array();
while ($g = $genresSQL->fetch_row())
	$genresArray[] = $g{0};
$genresString  = implode($genresArray, ', ');
if('' === $genresString)
	$genresString = 'none';
//end retrieving video data
	
function ShowAvailabilityIcon($format)
	{global $v;
	if( $v["has$format"])
		echo '<img src="imag/button_ok16.png" alt="format available"/>';
	else
		echo '<img src="imag/button_cancel16.png" alt="format not available"/>';
	}
?>	
	

<div id="DetailsMain">
<img alt="cover art" src="imag/<?echo $v['coverArtFileExt']? 'coverArt/'.$v['id'].'.'.$v['coverArtFileExt'] : 'movie-reel.jpg'?>"/><br/>
<div id="details">
<h1><?echo $v['title']?></h1>
<ul>
<li>DVD <?ShowAvailabilityIcon('DVD')?></li>
<li>Blue Ray <?ShowAvailabilityIcon('BluRay')?></li>
<li>Digital HD<?ShowAvailabilityIcon('HD')?></li>
<li>Digital SD<?ShowAvailabilityIcon('SD')?></li>
</ul>
<span class='left'><span class="label">CHV Rating:</span><?echo $v['rating']?></span><span><span class="right"><span class="label">Release Year:</span><?echo $v['yearOfRelease']?></span><br/>
<span class="label">Studio:</span><?echo $v['studio']?><br/>
<span class='left'><span class="label">In theatres:</span><?echo $v['theatreReleaseDate']?></span>
<span class='right'><span class="label">on DVD:</span><?echo $v['DVDReleaseDate']?></span><br/>
<span class="label">Starring:</span><?echo $v['actors']?><br/>
<span class="label">Genre:</span><?echo $genresString?><br/>
</div>

<div id="plot"><span class="label">Plot Summary: </span><?echo $v['plotSummary']?></div>
</div>
