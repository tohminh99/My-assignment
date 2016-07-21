<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require ('header.php');?>
        <div><center>
                <form action="" method="post" style="padding-bottom: 50px;">
            <table style="width: 600px;">
                <tr>
                    <td>Search:</td>
                    <td><input type="text" name="searchword" value=""></td>
                    <td>Search By:</td>
                    <td><select name="searchoption">
                            <option value="name">Name</option>
                            <option value="author">Author</option>
                            <option value="all">All</option>
                        </select></td>
                    <td><input value="Search" type="submit">
                        <input type="hidden" name="submitted" value="true" /></td>
                </tr>
            </table>
            
        </form></center>
<?php
if(isset($_POST['submitted']))
{
    $con=  mysqli_connect('localhost', 'root', '','hmanga');
    $searchword=  mysqli_real_escape_string($con,$_POST['searchword']);
    if($_POST['searchoption']=='name')
    {
        $sql = "SELECT id,name,author,coverimg FROM manga WHERE name LIKE '%".$searchword."%'";
        $result=$con->query($sql);
        echo '<table style="width:800px;">';
        while($row=mysqli_fetch_array($result))
        {   
            echo "<tr>";
            $name=$row['name'];
            $author=$row['author'];
            $getid=$row['id'];
            
            echo "<td style='padding-bottom:10px;'>" ."<img src='",$row['coverimg'],"' width='175' height='200' />"."</td>";
            echo "<td>"."Name:".$name."</td>";
            echo "<td>"."Author:".$author."</td>";
            echo "<td>"."Link:"."<a href='"."mangapage.php?id=".$getid."'>"."Link"."</a>"."</td>";
            echo "</tr>";
        }    
        echo "</table>";
    }
    else if($_POST['searchoption']=='author')
    {
        $sql = "SELECT id,name,author,coverimg FROM manga WHERE author LIKE '%".$searchword."%'";
        $result=$con->query($sql);
        echo "<table>";
        while($row=mysqli_fetch_array($result))
        {
            echo "<tr>";
            $name=$row['name'];
            $author=$row['author'];
            $getid=$row['id'];
            echo "<td>"."<img src='",$row['coverimg'],"' width='175' height='200' />"."</td>";
            echo "<td>"."Name:".$name."</td>";
            echo "<td>"."Author:".$author."</td>";
            echo "<td>"."Link:"."<a href='"."mangapage.php?id=".$getid."'>"."Link"."</a>"."</td>";
            echo "</tr>";
        }
         echo "</table>";
    }
    else if($_POST['searchoption']=='all')
    {
        $sql = "SELECT id,name,author,coverimg FROM manga WHERE name LIKE '%".$searchword."%' OR author LIKE '%".$searchword."%'";
        $result=$con->query($sql);
        echo "<table>";
        while($row=mysqli_fetch_array($result))
        {
            echo "<tr>";
            $name=$row['name'];
            $author=$row['author'];
            $getid=$row['id'];
            echo "<td>" ."<img src='",$row['coverimg'],"' width='175' height='200' />"."</td>";
            echo "<td>"."Name:".$name."</td>";
            echo "<td>"."Author:".$author."</td>";
            echo "<td>"."<a href='"."mangapage.php?id=".$getid."'>"."Link"."</a>"."</td>";
            echo "</tr>";
        }
         echo "</table>";
    }
    mysqli_close($con);
}
?>
</div>
<?php require ('footer.php');?>