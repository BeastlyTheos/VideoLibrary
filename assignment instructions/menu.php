<div class="Menu">
<a href="index.html">Home</a><br>
<?php echo $loggedIn?
'
<a href="profile.php">Edit Account></a><br>
<a href="delete_account.html">Delete Account</a><br>
<a href="add_video.html">Add Video</a><br>
<a href="edit_video.html">Edit Video</a><br>
<a href="delete_video">Delete Video</a><br>
<a href="search.html">Search</a><br>
<a href="logout.php">logout</a><br>
': '
<a href="register.php">Create Account</a><br>
<a href="login.php">login</a><br>
' ?>
</div>