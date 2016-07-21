<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require ('header.php');?>
<?php
$idcarrier=$_SESSION['carryid'];
$con=  mysqli_connect('localhost', 'root', '','hmanga');
$sql = "SELECT name,author,pubdate,lastdate,vol,coverimg,description FROM manga WHERE id=$idcarrier";
$result = mysqli_query($con,$sql); 
$row = mysqli_fetch_assoc($result);
?><?php
            echo '<div class="col-md-8" style="width: 630px;">';
            echo '<img class="img-responsive" src="'.$row['coverimg'].'" alt="">';
            echo '</div>';

            echo '<div class="col-md-4" style="width:initial;">';
            echo '<h3>Description</h3>';
            echo '<p>'.$row['description'].'</p>';
            echo '<h3>Manga Details</h3>';
            echo    '<ul style="padding-left:0px;">';
            echo "<p>Name:".$row['name']."</p>";
            echo "<p>Author:".$row['author']."</p>";
            echo "<p>Publish Date:".$row['pubdate']."</p>";
            echo "<p>Last Updated date:".$row['lastdate']."</p>";
            echo "<p>Vol:".$row['vol']."</li>"; 
            echo    '</ul>';?>
            <form enctype="multipart/form-data" action="" method="post" name="changer">
                <table style="width: 400px; height: 60px;">
                <tr>
                    <td>Upload File</td>
                    <td><input name="mangafile" accept="application/pdf" type="file"></td>
                </tr>
                <tr>
                    <td>Vol</td>
                    <td><input type="number" name="vol" value=""></td>   
                </tr>    
                
            </table>
            <input value="Submit" type="submit">
            <p><input type="hidden" name="submitted" value="true" /></p>
            </form>
            <a href="admin.php">Return to admin panel</a>
            </div>
        
<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
if(isset($_POST['submitted']))
{
    
$vol=$_POST['vol'];
$file=rand(1000,100000)."-".$_FILES['mangafile']['name'];
$file_loc = $_FILES['mangafile']['tmp_name'];
$folder="upload/";
$fml=$folder.$file;
move_uploaded_file($file_loc,$folder.$file);
$sql="INSERT INTO mangacontent (mangaid,vol,mangafile) VALUES('$idcarrier','$vol','$fml')" ;
mysqli_query($con,$sql); 
date_default_timezone_set("Asia/Kuala_Lumpur");
$lastupdatedate=date('Y-m-d');
$sql2="UPDATE manga SET vol='$vol',lastdate='$lastupdatedate' WHERE id=$idcarrier";
mysqli_query($con,$sql2);
mysqli_close($con);
}
?>
<?php require ('footer.php');?>