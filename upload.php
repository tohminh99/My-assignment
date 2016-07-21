<!DOCTYPE html>
<?php require ('header.php');?>
        <div style="padding-top: 50px;">
        <center>
        <form enctype="multipart/form-data" action="" method="post" name="changer">
            <table style="width: 600px; height: 200px">
           <tr>
               <td>Enter the manga name:</td>
               <td><input type="text" name="manganame" value=""></td>
           </tr>
           <tr>
               <td>Enter the author name:</td>
               <td><input type="text" name="authorname" value=""></td>
           </tr> 
          <tr>
              <td>Upload Cover Image(jpeg):</td>
              <td><input name="image" accept="image/jpeg" type="file"></td>
          </tr>
          <tr>
              <td>Description:</td>
              <td><textarea name="description" cols="50" rows="5"></textarea></td>
          </tr>
        </table>
        <input value="Submit" type="submit">
        <p><input type="hidden" name="submitted" value="true" /></p>
        </form>
            <a href="admin.php">Back to the admin panel</a>
        </center>
        </div>
<?php
if(isset($_POST['submitted']))
{
$manganame=$_POST['manganame']; 
$authorname=$_POST['authorname']; 
date_default_timezone_set("Asia/Kuala_Lumpur");
$pubdate=date('Y-m-d');
$description=$_POST['description'];
$con=  mysqli_connect('localhost', 'root','', 'hmanga');
$file=rand(1000,100000)."-".$_FILES['image']['name'];
$file_loc = $_FILES['image']['tmp_name'];
$folder="upload/";
$wm=$folder.$file;
move_uploaded_file($file_loc,$folder.$file);
$sql="INSERT INTO manga (name,author,pubdate,coverimg,description) VALUES('$manganame','$authorname','$pubdate','$wm','$description')";
 mysqli_query($con,$sql); 
 mysqli_close($con);
}
?>
<?php require ('footer.php');?>