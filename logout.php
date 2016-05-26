<?session_start();
unset($_SESSION['username']);
session_destroy();
setcookie('vidlib', '', time(-1000));

header('location: index.php');
?>