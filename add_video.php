<?require_once 'functions.php';
require_once 'sql.php';
include "session_start.php";
if( ! $loggedIn)
	header('location: login.php');

$errorText = array(); //used for storing texts about form errors to show the user

if ( count($_POST)) //if there is post data
	{$videoId = ValidateVideoData(); //also inserts the data if valid
	if ( is_numeric($videoId)) //validation and insertion were successful
		{
		header('location: display_details.php?id='.$videoId);
		}//end if there are no form errors
	//	else 
		//	{//log contents of $errorText}
	}//if there is post data

$genres = $sql->query ('select name from genre order by name asc');

PrintHTMLHeader('Add video',
	'<link rel="stylesheet" type="text/css" href="rateit/src/rateit.css"></link>'.
	'<link rel="stylesheet" href="//assets.cms.gov/resources/libs/datepicker/v6/css/datepicker.css" />'.
	'<script type="text/javascript" src="rateit/src/jquery.rateit.js"></script>'.
	'<script type="text/javascript" src="//assets.cms.gov/resources/libs/datepicker/v6/js/datepicker.js"></script>'.
	'<script type="text/javascript" src="scripts/add_video.js"></script>'
	);

echo '<body>';
PrintHeader();
PrintMenu();
?>

<div class="Main">
<h1>add Video</h1>
<form action="add_video.php" method="post" enctype='multipart/form-data'  onsubmit="return ValidateAccountData()">
<?DisplayErrors($errorText)?>
<div><label for='title'>Title: </label><input id='title' type="text" name="title"/><span id="TitleError" class="InputValid">title is required</span></div>
<div><label for="backing2b">Stars: </label>
<select id="backing2b" name="stars">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
</select>
<div class="rateit" data-rateit-backingfld="#backing2b"></div>
</div>
<div><label for='rating'>Rating: </label>
<select id='rating' name="rating">
<option value=""></option>
<option value="G">G</option>
<option value="PG">PG</option>
<option value="14A">14A</option>
<option value="18A">18A</option>
<option value="A">A</option>
<option value="E">E</option>
</select></div>
<div><label for='genre'>Genre: </label>
<select id='genre' name="genre[]" multiple="multiple">
<?while($g = $genres->fetch_row())
	echo "<option value='$g[0]'>$g[0]</option>\n";
?></select><span id="GenreError" class="InputValid">Genre is required</span></div>
<div><label for='YoR'>Year of Release: </label><input id='YoR' name="yearOfRelease" type="text"/></div>
<div><label for='rt'>Runtime: </label><input id='rt' name="runtime" type="text" maxlength="3"/></div>
<div><label for='TheatreReleaseDate'>Theatre Release Date: </label><input id='TheatreReleaseDate' name="theatreReleaseDate" type="text"/><span id="TRDError" class="InputValid"> invalid date format. </span><span class="placeholder">(mm-dd-yyyy)</span></div>
<div><label for='DVDReleaseDate'>DVD Release Date: </label><input id='DVDReleaseDate' name="DVDReleaseDate" type="text"/><span id="DRDError" class="InputValid"> invalid date format. </span><span class="placeholder">(mm-dd-yyyy)</span></div>
<div><label for='actors'>Actors: </label><input id='actors' name="actors" type="text"/></div>
<div><label for='ca'>Cover: </label><input id='ca' name="coverArt" type="file"/></div>
<div><label for='studio'>Studio: </label><input id='studio' name="studio" type="text"/></div>
<div><label for='ps'>Plot Summary: </label><textarea id='ps' name="plotSummary" cols="75" rows="5" maxlength=1000></textarea><span id="PSCounter" type="text" value="0" >0</span></div>
<fieldset>
<legend>Video Formats: </legend>
<span id="VideoFormatError" class="InputValid">Please select at least one video format.</span><br/>
<input name="hasDVD" type="checkbox" id='dvd'/><label for='dvd'>DVD</label>
<input name="hasBluRay" type="checkbox" id='br'/><label for='br'>BluRay</label>
<input name="hasSD" type="checkbox" id='sd'/><label for='sd'>Digital SD (standard definition)</label>
<input name="hasHD" type="checkbox" id='hd'/><label for='hd'>digital HD (high definition)</label>
</fieldset>
<div class='buttons'>
<input type="submit" value="add video"/>
<input type="reset" value="reset all fields to default values"/>
</div>
</form>
</div>

<?PrintFooter()?>
</body>
</html>