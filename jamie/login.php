<?php
$title = "myVids - Login";
 include "header.php"?>
 
 <div id="main">
    <form action="<?php echo $PHP_SELF?>" method="post" id="loginform">
        <div id="loginformcont">
        
        <div><label for="user">Username:</label><input type="text" name="user" id="user" value="" /></div>
        <div><label for="user">Password:</label><input type="password" name="pass" id="pass" /></div>
         <div><input type="checkbox" name="remember" id="remember" />
         <label for="remember">Remember Me</label></div>
         <div class="error"><?php echo $error?></div>
         <div id="buttons">
                <input type ="submit" name="submit" value="Login" />
                <input type="reset" name="reset" value ="Reset" />
            </div>
        </div>
    </form>
    
</div>
<?php include "footer.php"?>