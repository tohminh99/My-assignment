<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php require ('header.php');?>
<div style="padding-top: 100px;">
            <center>
       <form action="" method="POST">
           <table style="width: 500px; height: 200px;">
               <tr><h3>Ban or unban user.</h3></tr>
               <tr>
               <td>UserId:</td>
               <td><input type="text" name="userid" value=""></td>
               </tr>
               <tr>
               <td>Status(ban or unban):</td>
               <td><input type="text" name="userstatus" value=""></td>
               </tr>
               <tr><td><p>OR</p></td></tr>
               <tr>
                   <td>Enter the manga name you wish to update:</td>
                   <td><input type="text" name="manganame" value=""></td>
               </tr>
           </table>
           <p><input type="submit" name="submit" value="Submit"/></p>
           <p><input type="hidden" name="submitted" value="true" /></p>
           <a href="upload.php">Register new content</a>
       </form>
            </center></div>
<?php

if (isset($_POST['submitted']))
{
    $con=  mysqli_connect('localhost', 'root', '','hmanga'); 
    if($_POST['manganame']!="")
    {
    $mn=  mysqli_real_escape_string($con,$_POST['manganame']);
    $sql="SELECT id FROM manga WHERE name='$mn'";
    $result = mysqli_query($con,$sql);
    $count = mysqli_num_rows($result);
    if($count == 0)
    {
       echo "No such manga, please reenter the manga name.";
    }
    else if($count ==1)
    {
       $idresult=$con->query($sql);
       $id=$idresult->fetch_assoc();
       $_SESSION['carryid']=$id['id'];
       header("location: updatemanga.php");
    }
    }
    if($_POST['userid']!="" || $_POST['userstatus']!="")
    {
    if($_POST['userstatus']=='ban')
    {
        $_POST['userstatus']=0;
    }
    else if($_POST['userstatus']=='unban')
    {
        $_POST['userstatus']=1;
    }
    
    $userid= mysqli_real_escape_string($con,$_POST['userid']);
    $userstate= mysqli_real_escape_string($con,$_POST['userstatus']);
    $sql= "SELECT id,level FROM user WHERE username = '$userid'";
    $result = mysqli_query($con,$sql);
    $count = mysqli_num_rows($result);
    $lvlresult=$con->query($sql);
    $level = $lvlresult->fetch_assoc();
    $idresult=$con->query($sql);
    $id=$idresult->fetch_assoc();
    $selid=$id['id'];
    $lvl=$_POST['userstatus'];
    if($count == 0)
    {
        echo "no such user, please enter again.";
    }
    else if($count==1)
    {
        if($level['level']==$lvl)
        {
            echo "user already being ban or unban.";
        }
        else
        {
            $sql2="UPDATE user SET level=$lvl WHERE id=$selid";
            mysqli_query($con,$sql2);
        }
    }
    }
    mysqli_close($con);
}

?>
<?php require ('footer.php');?>