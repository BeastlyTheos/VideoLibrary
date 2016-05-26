<?require 'functions.php';
include"session_start.php";
if ( ! $loggedIn)
	header('location: login.php');
	
//check for GET id
if( ! isset($_GET['id']))
	header('location: search.php');


PrintHTMLHeader('Details of video', ''); //'.$v['title'], '');
	
echo '<body>';

PrintHeader();
PrintMenu();
?>
	
<?require 'getVideoGrid.php'?>

<?PrintFooter()?>
</body>
</html>