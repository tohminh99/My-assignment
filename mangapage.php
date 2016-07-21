<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require ('header.php');
if (!isset($_SESSION['user'])) {
header('Location: login.php');
}
?>

        <?php
            $id=$_GET['id'];
            $con=  mysqli_connect('localhost', 'root', '','hmanga');
            $sql = "SELECT name,author,pubdate,lastdate,vol,coverimg,description FROM manga WHERE id=$id";
            $result = mysqli_query($con,$sql); 
            $row = mysqli_fetch_assoc($result);
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
            echo    '</ul>';
            echo "Vol that available:";
            $sql2 = "SELECT id,mangaid,vol FROM mangacontent WHERE mangaid=$id";
            $result2=$con->query($sql2);
            while($row2=mysqli_fetch_array($result2))
            {
            $getid=$row2['id'];
            $vol=$row2['vol'];
            echo "<a href='"."viewpdf.php?id=".$getid."'>".$vol."</a> ";
           
            }
            mysqli_close($con);
            ?>
            

        </div>     
    
 <?php require ('footer.php');?>
