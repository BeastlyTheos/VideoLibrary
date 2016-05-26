<?$debug = false;
require 'functions.php';
require 'sql.php';
include "session_start.php";
if( ! $loggedIn)
	header('location: login.php');

$errorText = array(); //used for storing texts about form errors to show the user

if ( count($_POST)) //if there is post data
	{$id = ValidateVideoData(); //also updates the data if valid
	if ($id && 0 == count($errorText)) //validation and insertion were successful
		 		header('location: display_details.php?id='.$id);
	}//end if there is post data


if ( isset($_GET['id']) || isset($_POST['id'])) //if there is get data, or if there was form data recieved via post
	{$id = isset($_GET['id'])? (int) $_GET['id']: (int) $_POST['id'];
	$v = $sql->query('select * from video where id = '.$id)->fetch_assoc();
	
	//query for genres, using this code that would be much simpler if my db violated fn1
	$res = $sql->query('select name from genre order by name asc'); //get all possible genres
	while ($g = $res->fetch_assoc()) //load into an array
		$genres[$g['name']] = false; //= false meaning this video does not have this genre
	$res = $sql->query('select genre from video_genre where videoId = '.$id); //query genres of the video
	while($g = $res->fetch_assoc())
		$genres[$g['genre']] = true;
	}//end if there's get data
else
	header('location: search.php'); //redirect the user to search for a video

PrintHTMLHeader('Editing '.$v['title'], '');

echo '<body>';
PrintHeader();
PrintMenu();
?>

<div class="Main">
<h1><?echo $v['title']?></h1>
<form action="edit_video.php" method="post" enctype='multipart/form-data'>
<?DisplayErrors($errorText)?>
<div><input type="hidden" name="id" value="<?echo $v['id']?>"/></div>
<div><label for='title'>Title: </label><input id='title' type="text" name="title"  value="<?echo $v['title']?>"/></div>
<div><label for='rating'>Rating: </label>
<select id='rating' name="rating">
<option value=""></option>
<option value="G" <?echo 'G'==$v['rating']? 'selected="selected"' : ''?>>G</option>
<option value="PG" <?echo 'PG'==$v['rating']? 'selected="selected"' : ''?>>PG</option>
<option value="14A" <?echo '14A'==$v['rating']? 'selected="selected"' : ''?>>14A</option>
<option value="18A" <?echo '18A'==$v['rating']? 'selected=selected"' : ''?>>18A</option>
<option value="A" <?echo 'A'==$v['rating']? 'selected="selected"' : ''?>>A</option>
<option value="E" <?echo 'E'==$v['rating']? 'selected="selected"' : ''?>>E</option>
</select></div>
<div><label for='genre'>Genre: </label>
<select id='genre' name="genre[]" multiple="multiple">
<?foreach($genres as $name => $exists)
	printf("<option value='%s'  %s>%s</option>\n", $name, $exists? 'selected="selected"' : '', $name);
	?>
</select></div>
<div><label for='YoR'>Year of Release: </label><input id='YoR' name="yearOfRelease" type="text"  value="<?echo $v['yearOfRelease']?>"/></div>
<div><label for='runtime'>Runtime: </label><input id='runtime' name="runtime" type="text" value="<?echo $v['runtime']?>"/></div>
<div><label for='trd'>Theatre Release Date: </label><input id='trd' name="theatreReleaseDate" type="text" value="<?echo $v['theatreReleaseDate']?>"/><span class="placeholder">dd-mm-yyyy</span></div>
<div><label for='drd'>DVD Release Date: </label><input id='drd' name="DVDReleaseDate" type="text" value="<?echo $v['DVDReleaseDate']?>"/><span class="placeholder">dd-mm-yyyy</span></div>
<div><label for='actors'>Actors: </label><input id='actors' name="actors" type="text" value="<?echo $v['actors']?>"/></div>
<div><label for='coverArt'>Cover: </label><input id='coverArt' name="coverArt" type="file"/></div>
<div><label for='studio'>Studio: </label><input id='studio' name="studio" type="text" value="<?echo $v['studio']?>"/></div>
<div><label for='plotSummary'>Plot Summary: </label><textarea id="plotSummary" name="plotSummary" cols="75" rows="5"><?echo htmlspecialchars($v['plotSummary'])?></textarea></div>
<fieldset>
<legend>Video Formats: </legend>
<input name="hasDVD" type="checkbox" <?echo $v['hasDVD']? 'checked="checked"' : '';?> id='dvd'/><label for='dvd'>DVD</label>
<input name="hasBluRay" type="checkbox" <?echo $v['hasBluRay']? 'checked="checked"' : '';?> id='br'/><label for='br'>BluRay</label>
<input name="hasSD" type="checkbox" <?echo $v['hasSD']? 'checked="checked"' : ''?> id='sd'/><label for='sd'>Digital SD (standard definition)</label>
<input name="hasHD" type="checkbox" <?echo $v['hasHD']? 'checked="checked"' : ''?> id='hd'/><label for='hd'>digital HD (high definition)</label>
</fieldset>

<div class='buttons'>
<input type="submit" value="edit video"/>
<input type="reset" value="reset all fields to default values"/>
</div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>