<?require_once 'sql.php';

function PrintHTMLHeader($title, $pageIncludes)
{?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?echo $title?></title>

<link rel="stylesheet" type="text/css" href="style/reset.css"></link>
<link rel="stylesheet" type="text/css" href="style/global.css"></link>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.min.js"></script>
<link type="text/css" rel="stylesheet" href="jquery-ui-1.11.4/jquery-ui.min.css"/>
<script type="text/javascript"  src="jquery-ui-1.11.4/external/jquery/jquery.js"></script>
<script type="text/javascript" src="jquery-ui-1.11.4/jquery-ui.min.js"></script>

<?echo $pageIncludes?>
</head>
<?}//end print HTML header

function PrintHeader()
{?><div id="container">
<div class='Header'>
<img alt='movie reel' id='HeaderLogo' src="imag/movie-reel.jpg" height="50"/><br/>
<div id='TitleText'><b>My Video</b> Collection</div>
<div id='SubTitle'>An individual video library</div>
</div>
<?}//end print header

/*PrintMenu
uses global $loggedIn*/
function PrintMenu()
{global $loggedIn;
?><div class="Menu">
<ul>
<li><a href="">Home</a></li>
<?echo $loggedIn?
'
<li><a href="edit_account.php">Edit Account></a></li>
<li><a href="delete_account.php">Delete Account</a></li>
<li><a href="add_video.php">Add Video</a></li>
<li><a href="edit_video.php">Edit Video</a></li>
<li><a href="delete_video.php">Delete Video</a></li>
<li><a href="search.php">Search</a></li>
<li><a href="logout.php">logout</a></li>
</ul>
': '
<li><a href="add_account.php">Create Account</a></li>
<li><a href="login.php">login</a></li>
</ul>
' ?>
</div>
<?}//end print menu

function PrintFooter()
{?>
<div class="Footer">&copy; 3420 Web Dev Inc.</div>
</div>
<?}

function PrintVideosTable($videos, $startAt)
{echo "<table>
<tbody>
<tr>";
PrintVideoCell($videos->fetch_assoc()); //print initial cell since we already know it exists
for ( $i = 1 ; $i < $videos->num_rows && $i < 12 ; $i++)
	{if($i%4 == 0) //if this is the start of a new row
		echo '</tr><tr>';
	printVideoCell($videos->fetch_assoc());
	}//end of for loop

echo '</tr>
</tbody>
</table>';
}

function PrintVideoCell($v)
{$id = $v['id'];
$title = $v['title'];
$coverArt = $v['coverArtFileExt']? "coverArt/$id.".$v['coverArtFileExt'] : 'movie-reel.jpg'; //set default cover art to movie reel.jpg

echo "<td>
<div class='CoverArtContainer'><img alt='cover art' src='imag/$coverArt' width='75'/></div>
<div class='CellTitle'>$title</div>
<div class='IconContainer'>
<button alt='details' class='DetailsButton' id='$id'><span class='DetailsIcon'></span></button>
<a title='Edit video' href='edit_video.php?id=$id'><span class='EditIcon'></span></a>
<a title='delete video' href='delete_video.php?id=$id'><span class='DeleteIcon'></span></a>
</div>
</td>
";
}//end print video cell

function LoginUser()
{global $sql;
$username = $sql->real_escape_string($_POST['username']);
$_SESSION['user'] = $sql->query("select id, username, firstName, lastName from user where username = '$username'")->fetch_assoc();
if(isset($_POST['rememberMe']) && "on" == $_POST['rememberMe'])
	setcookie('vidlib', $_SESSION['user']['id'], time()+ 86400); //from slides: 			setcookie("vidlib",encrypt($row['ID']),time()+60*60*24*30*12);
}//end login

function DisplayErrors($text)
{if ( 0 != count($text))
	{echo 'Please correct the following '.count($text)." errors: <br/>\n<ul>\n";
	foreach ($text as $et)
		echo "<li>$et</li>\n";
echo "</ul><br/>\n";
}
}//end display errors

/*Validate Account data
validates account data, and submits to mysql if successful
uses global $errorText to store validation and mysql errors
uses $loggedIn to determine if it is called from the registering page, or the editing page*/
function ValidateAccountData()
{global $errorText;
global $sql;
global $loggedIn;

try{
global $sql;

/*validate values
general format of a value validation is:
if invalid:
	add error message to the list, or set value to default
else set value to what's provided
*/

if( ! $loggedIn) //only check username if registering
	{if( 0 == strlen($_POST['username']))
		$errorText[] = 'Username is required';
	else
		$username = $sql->real_escape_string($_POST['username']);
	}
	if( ! $loggedIn && (0 == strlen($_POST['password']) || 0 == strlen($_POST['passwordConfirmation']))) //if the user is registering, and has not provided a password
	$errorText[] = 'password and password confirmation are required';
else if ($_POST['password'] != $_POST['passwordConfirmation'])
	$errorText[] = 'passwords do not match';
$password = $sql->real_escape_string($_POST['password']); //executes regardless. later error handling validates this against empty string
if( 0 == strlen($_POST['firstName']))
	$errorText[] = 'first name is required';
else
	$firstName = $sql->real_escape_string($_POST['firstName']);
if( 0 == strlen($_POST['lastName']))
	$errorText[] = 'last name is required';
else
	$lastName = $sql->real_escape_string($_POST['lastName']);
if( 0 == strlen($_POST['email']))
	$errorText[] = 'email is required';
else
	$email = $sql->real_escape_string($_POST['email']);
if( 0 == strlen($_POST['age']))
	$errorText[] = 'age is required';
else
	$age = (int) $_POST['age'];
	
//set non-required values
if( ! isset($_POST['sex']))
	$sex = 'undisclosed';
else
	$sex = $sql->real_escape_string($_POST['sex']);
if( ! isset($_POST['inactivityEmails']))
	$inactivityEmails = 0;
else
	$inactivityEmails = (int) $_POST['inactivityEmails'];
		
if ( 0 == count($errorText)) //if there's no errors, submit the data
	{

	if ($loggedIn)
		{$query = 'update user set ';
		if('' != $password)
			$query .= "password = password('$password'), ";
		$query .= "firstName = '$firstName', lastName = '$lastName', email = '$email', sex = '$sex', age = $age, inactivityEmails = $inactivityEmails where id = ".$_SESSION['user']['id'];
		$sql->query($query);
		}
	else
		$sql->query("insert into user set username = '$username', password = password('$password'), firstName = '$firstName', lastName = '$lastName', email = '$email', sex = '$sex', age = $age, inactivityEmails = $inactivityEmails");

	if($sql->errno) //if registration fails
		{switch ($sql->errno)
			{			case 1062: $errorText[] = 'username is already taken. Please select another'; break;
			default: $errorText[] = 'Sorry, an unknown database error has occured. Please contact the administrater';
			}
		}//end if registration fails
	else
		{$_SESSION['user']['firstName'] = $firstName;
		$_SESSION['user']['lastName'] = $lastName;
		}
	}//END IF THERE'S NO VALIDATION ERRORS
}//end try
catch(exception $e)
{$errorText[] = 'Sorry, an unhandled error has occured. Please try again, or contact the web admin';	 
	throw $e;
	}
}//end validate account data

/*Validate video data
*validates video data, and submits to mysql if successful
*if this is called from the edit script, data will be updated to the row with id = $_POST['id']
*else data will be insertted
*uses global $errorText to store validation and mysql errors, including errors inserting genre, which happen even if the other data is inserted/updated successfully
uses $_POST['id'] to determine if it's being called from add video, or edit video
*returns video id on success, false on failure*/
function ValidateVideoData()
{global $errorText, $debug, $sql;

try{
global $sql;

//validate values
if( 0 == strlen($_POST['title']))
	$errorText[] = 'Title is required';
else
	$title = $sql->real_escape_string($_POST['title']);
if( 0 == strlen($_POST['rating']))
	$errorText[] = 'rating is required';
else
	$rating = $sql->real_escape_string($_POST['rating']);
if( 0 == strlen($_POST['yearOfRelease']))
	$errorText[] = 'Year of Release is required';
else
	$yearOfRelease = (int) $_POST['yearOfRelease'];
if( 0 == strlen($_POST['runtime']))
	$errorText[] = 'runtime is required';
else
	$runtime = (int) $_POST['runtime'];
	
//set non-required values
if ( 0 == strlen($_POST['theatreReleaseDate']))
	$theatreReleaseDate = "";
else
	$theatreReleaseDate = $sql->real_escape_string($_POST['theatreReleaseDate']); 
if ( 0 == strlen($_POST['DVDReleaseDate']))
	$DVDReleaseDate = "";
else
	$DVDReleaseDate = $sql->real_escape_string($_POST['DVDReleaseDate']);
if( ! isset($_POST['actors']))
	$actors = '';
else
	$actors = $sql->real_escape_string($_POST['actors']);
if( ! isset($_POST['studio']))
	$studio = '';
else
	$studio = $sql->real_escape_string($_POST['studio']);
		if( ! isset($_POST['plotSummary']))
	$plotSummary = '';
else
	$plotSummary = $sql->real_escape_string($_POST['plotSummary']);
if( ! isset($_POST['hasDVD']))
	$hasDVD = 0;
else
	$hasDVD = 'on' == $_POST['hasDVD']? 1:0;
if( ! isset($_POST['hasBluRay']))
	$hasBluRay = 0;
else
	$hasBluRay = 'on' == $_POST['hasBluRay']? 1:0;
if( ! isset($_POST['hasHD']))
	$hasHD = 0;
else
	$hasHD = 'on' == $_POST['hasHD']? 1:0;
if( ! isset($_POST['hasSD']))
	$hasSD = 0;
else
	$hasSD = 'on' == $_POST['hasSD']? 1:0;

//if no errors so far, try to submit data
if ( 0 == count($errorText)) //if there's no errors, try to submit the data
	{if(isset($_POST['id'])) //if there's an ID in the post, meaning this function was called from edit_video
		{$id = (int) $_POST['id'];
		$query = "update video set title = '$title', rating = '$rating', yearOfRelease = '$yearOfRelease', runtime = $runtime, theatreReleaseDate = '$theatreReleaseDate', DVDReleaseDate = '$DVDReleaseDate', actors = '$actors', studio = '$studio', plotSummary = '$plotSummary', hasDVD = $hasDVD, hasBluRay = $hasBluRay, hasHD = $hasHD, hasSD = $hasSD where id = $id and userid = ".$_SESSION['user']['id'];
		$sql->query($query);
		 //this is designed to fail if the video ID does not belong to the logged in user
		}
	else //this function is called  from the add_video page
		{$query = "insert into video set title = '$title', rating = '$rating', yearOfRelease = '$yearOfRelease', runtime = $runtime, theatreReleaseDate = '$theatreReleaseDate', DVDReleaseDate = '$DVDReleaseDate', actors = '$actors', studio = '$studio', plotSummary = '$plotSummary', hasDVD = $hasDVD, hasBluRay = $hasBluRay, hasHD = $hasHD, hasSD = $hasSD, userid = ".$_SESSION['user']['id'];
		$sql->query($query);
		$id = $sql->insert_id;
		}
	
	if(0 != $sql->errno) 
		{switch ($sql->errno) //so far, I don't have handling for any specific errors
			{default: $errorText[] =  $debug? $id.$query.'<br/>'.$sql->error: 'Sorry, an unknown database error has occured. Please contact the admin';}
		}//end if registration fails
	else //registration succeeded. insert genres and upload cover art
		{//cover art file upload
		if(0 === $_FILES['coverArt']['error'])
			{//validate file extention
			    switch($_FILES['coverArt']['type'])
				    {case 'image/jpeg': $ext = 'jpg'; break;
				case 'image/gif':  $ext = 'gif'; break;
				case 'image/png':  $ext = 'png'; break;
				case 'image/tiff': $ext = 'tif'; break;
				default:           $ext = '';    break;
				}
				
			if($ext)
				{move_uploaded_file($_FILES['coverArt']['tmp_name'], "imag/coverArt/$id.$ext");
				$sql->query("update video set coverArtFileExt = '$ext' where id = $id and userid = ".$_SESSION['user']['id']); 
				}
			else
				$errorText[] = 'Only .png, .tif,  and .jpg filetypes are allowed for the cover art';
			}//end file uploading
			

		//insert genres
		if(isset($_POST['genre']))
			{//build sql query
			$genres = "($id, '".$sql->real_escape_string($_POST['genre'][0])."')"; //first genre
			for($i = 1 ; $i < count($_POST['genre']) ; $i++) //starts at the second genre
				$genres .= ", ($id, '".$sql->real_escape_string($_POST['genre'][$i])."')"; //add a comma, followed by the next genre
			
			if(isset($_POST['id'])) //if this function is called from the edit_video page
				$sql->query("delete from video_genre where videoId = $id"); //clear the current genres
				
			$sql->query("insert into video_genre values $genres");
			
			//error handling
			if(0 != $sql->errno)  
				{switch ($sql->errno)
				{default: $errorText[] = 'error with genres: '. $debug? $sql->error: 'Sorry, an unknown database error has occured. Please contact the admin';}
				}//end if inserting genres fails
			}//end inserting genres

		return $id;
		}//end video was insertted 
	}//END IF THERE'S NO VALIDATION ERRORS
return false;//something went wrong
}//end try
catch (exception $e)
{$errorText[] = 'Sorry, an unhandled error has occured. Please try again, or contact the web admin';	 
	throw $e;
	}
}//end validate account data
?>