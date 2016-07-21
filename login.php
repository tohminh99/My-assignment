<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php require ('header.php');?>
        <script type="text/javascript">
            function validate(){
            var username = document.getElementById("a").value;
            var password = document.getElementById("b").value;
            if(!username || !password)
            {alert("Please enter the id or password");}
             }
            </script>
            <div style="padding-top: 100px;">
            <center>
             <form action="" method="POST">
                 <table style="width: 300px; height: 100px;">
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="logid" id="a" value=""></td>
                </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="logpassword" id="b" value=""></td>
            </tr>
            </table>
                 <p style="padding-top: 50px;"><input type="submit" name="submit" value="Log In" onclick="validate()"/></p>
            <p><input type="hidden" name="submitted" value="true" /></p>
             </form>
                <a href="registration.php">Not yet a user ? Click here to Register.</a>
                </center>
                </div>
                
<?php
if (isset($_POST['submitted']))
{
if(empty($_POST['logid']) || empty($_POST['logpassword']))
{
    echo "Please Enter the Id and Pass";
}
 else 
{
$con=  mysqli_connect('localhost', 'root', '','hmanga');
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = mysqli_real_escape_string($con,$_POST['logid']);
    $mypassword = mysqli_real_escape_string($con,$_POST['logpassword']);
    $sql = "SELECT id,level,nickname FROM user WHERE username = '$myusername' and password = '$mypassword'";
    $lvlresult=$con->query($sql);
    $level = $lvlresult->fetch_assoc();  
    $result = mysqli_query($con,$sql);
    $count = mysqli_num_rows($result);
    if($count == 1) {
        
         $_SESSION['user'] = $myusername;
         $_SESSION['lvlcheck']=$level['level'];
         $_SESSION['nickname']=$level['nickname'];
         if($level['level']==1)
         {header("location: redirection.php");}
         else if ($level['level']==2)
         {header("location: admin.php");}
         else
         {header("location: error.php");}
      }else {
         echo "<center>Your Login Name or Password is invalid</center>";
      }
      mysqli_close($con);
}

 }
}
?>
 <?php require ('footer.php');?>