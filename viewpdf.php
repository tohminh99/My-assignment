<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
    </body>
</html>
 <?php
 $id=$_GET['id'];
 $con=  mysqli_connect('localhost', 'root', '','hmanga');
 $sql = "SELECT mangafile FROM mangacontent WHERE id=$id";
 $result = mysqli_query($con,$sql); 
 $row = mysqli_fetch_assoc($result);
 $file=$row['mangafile'];
 header('Content-type:application/pdf');
 header('Content-Transfer-Encoding:binary');
 header('Accept-Ranges:bytes');
 @readfile($file);
 mysqli_close($con);
        ?>