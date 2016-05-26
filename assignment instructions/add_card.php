<?php

require_once 'db_login.php';

#
#  Check to see if the user has entered data into the form.
#

if ( ! isset($_POST['donor_name']) )   # if we don't have a value in the title field, display the form to prompt for movie deails
    {
 
     echo "<div id='add_form'>";
     echo "Please enter the following donor information. Press the ADD button when ready:<p>\n";
     echo "  <form method='post' action='add_card.php'  enctype='multipart/form-data'>\n";

     echo "   <label for='donor_name'>Donor Name:</label>   \n";
     echo "  <input type='text' size=30 maxlength=30 id='donor_name' name='donor_name' value='' autofocus tabindex=1><br>\n";

     echo "   <label for='blood_type'>Blood Type:</label>   \n";
     echo "          <select name='b_type[]'  id='blood_type' value=''  tabindex='2'/><br>\n";
     echo "             <option value='A+'>A+</option>\n";
     echo "             <option value='A-'>A-</option>\n";
     echo "             <option value='B+'>B+</option>\n";
     echo "             <option value='B-'>B-</option>\n";
     echo "             <option value='AB+'>AB+</option>\n";
     echo "             <option value='AB-'>AB-</option>\n";
     echo "             <option value='O+'>O+</option>\n";
     echo "             <option value='O-'>O-</option>\n";
     echo "          </select><br>\n";

     echo "   <input type='hidden' name='MAX_FILE_SIZE' value='200000' />\n";
     echo "   <label for='donor_photo'>Donor Photo:</label>\n";
     echo "   <input type='file' name='donor_photo' id='donor_photo'  tabindex='2'/><BR>\n";
 

     echo "   <input type='submit' name='ADD' value='ADD'>\n";
     echo "  </form>\n";
     echo "</div>\n";
   }
else    # we need to post this data to the database
   {

     if( $_POST['ADD'] )
       {
         $connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);
         if ($connection->connect_error) die($connection->connect_error);

         $donor_name    = $_POST['donor_name'];

         $blood_type   = $_POST['b_type'];
         $type = $blood_type[0];
 
         $query  = "insert into donors (id,blood_grp,photo,name) values (NULL,'$type','','$donor_name')";

         $result = $connection->query($query);

         $Donor_id = $connection->insert_id;   # retrieve the record ID for the movie that was added
    
#
#  update the database with the appropriate filename for the cover art. Need the Movie ID before we can do this.
#

 if ($_FILES)
  {
    $name = $_FILES['donor_photo']['name'];
    $tmpname = $_FILES['donor_photo']['tmp_name'];

    switch($_FILES['donor_photo']['type'])    # http://php.net/manual/en/features.file-upload.php
    {
      case 'image/jpeg': $ext = 'jpg'; break;
      case 'image/gif':  $ext = 'gif'; break;
      case 'image/png':  $ext = 'png'; break;
      case 'image/tiff': $ext = 'tif'; break;
      default:           $ext = '';    break;
    }

    if ($ext)                                           # see lecture 11 slide 35
    {
      $new_fn = './images/donor_photo_' . $Donor_id . "." . $ext;
      $status = move_uploaded_file($tmpname,$new_fn);   # http://php.net/manual/en/function.move-uploaded-file.php
      
      $query  = "update donors  set photo='$new_fn' where id=$Donor_id";

      $result = $connection->query($query);
    }
    else echo "'$name' is not an accepted image file";
  }
  else echo "No image has been uploaded";

  $connection->close();


  echo "<table border=1 width=30%>";
  echo "   <tr><td colspan=2 align='center' >Donor ID: $Donor_id</td></tr>";
  echo "   <tr><td rowspan=2><img src='" . $new_fn . "' height='100'></td><td>Donor Name: $donor_name</td></tr>";
  echo "   <tr><td>Blood Type: $type</td></tr>";
  echo "</table><p>";
  echo "The donor ' $donor_name ' was successfully added.";

 }  # if the POST used the ADD button...


}

?>

