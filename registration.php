<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
require ('header.php');
if (isset($_POST['submitted']))
{
$con=  mysqli_connect('localhost', 'root', '','hmanga');
$id=$_POST['regid'];
$idlen=  strlen($id);
$pass=$_POST['regpass'];
$passlen = strlen($pass);
$confirmpass=$_POST['confpass'];
$email=$_POST['regemail'];
$phnum=$_POST['regphonenum'];
$nickname=$_POST['regnickname'];
$nicklen=  strlen($nickname);
$valify=TRUE;

if(empty($_POST['regid']))
{
    $valify=false;
}
if($idlen>18 || $idlen<8)
{
    $valify=false;
}
if(!ctype_alnum($id))
{
    $valify=false;
}

$sql='SELECT username FROM user where username= "'.$id.'"';
$res=  mysqli_query($con, $sql);
if($res && mysqli_num_rows($res)>0)
{
    echo "<center>Username is taken.</center>";
    $valify=false;
}
if(empty($_POST['regpass']))
{
    $valify=false;
}
if($passlen<8 || $passlen >20)
{
    $valify = false;
}
if(!ctype_alnum($pass))
{
    $valify = false;
}
if(empty($_POST['confpass']))
{
    $valify=false;
}
$sql2='SELECT email FROM user where email="'.$email.'"';
$res2=mysqli_query($con, $sql2);
if($res2 && mysqli_num_rows($res2)>0)
{
    echo "<center>Email is taken.</center>";
    $valify=false;
}
if(empty($_POST['regemail']))
{
    $valify=false;
}
if(strpos($email,'@')==FALSE)
{
    $valify=false;
}
if(!ctype_digit($phnum))
{
    $valify=FALSE;
}
if(empty($_POST['regnickname']))
{
    $valify=false;
}
if($nicklen >12)
{
    $valify=FALSE; 
}
if(!ctype_alnum($nickname))
{
    $valify=FALSE;
}
if($pass !==$confirmpass)
{
    $valify=false;
}
if($valify !==TRUE)
{
    echo "<center>Your registration is not complete, please check your input.</center>";
}
else
{
 $query="INSERT INTO user (username,password,email,nickname,phonenumber) VALUES ('$id','$pass','$email','$nickname','$phnum')";
 $data= mysqli_query($con,$query)or die(mysqli_connect_error());
 if($data)
 {
    
    header("Location:login.php"); 
    
 }
}        
mysqli_close($con);
}
?>

        <script type="text/javascript">
            function regvalidate(){
                var id = document.getElementById("regid").value;
                var idlen =document.getElementById("regid").value.length;
                var pass = document.getElementById("regpass").value;
                var passlen=document.getElementById("regpass").value.length;
                var confpass=document.getElementById("confpass").value;
                var email=document.getElementById("regemail").value;
                var valemail=email.indexOf("@");
                var phnum=document.getElementById("regphonenum").value;
                var nickname=document.getElementById("regnickname").value;
                var nicknamelen=document.getElementById("regnickname").value.length;
                check=true;
                if(!id)
                {alert ("Please Enter the ID.");}
                else
                {
                    if(idlen > 18 || idlen<8)
                    {alert("Your ID must at least contain 8 words or not more than 18 words");}
                }
                if(!/^[0-9a-zA-Z]*$/g.test(document.getElementById("regid").value))
                {alert("Only enter charater or number.");}
                if(!pass)
                {alert("Please Enter the Password.");}
                else
                {
                    if(passlen>20 || passlen <8)
                    {alert("Your password must at least contain 8 words or not more than 20 words.");}
                }
                if(!/^[0-9a-zA-Z]*$/g.test(document.getElementById("regpass").value))
                {alert("Only enter charater or number as your password.");}
                if(!confpass)
                {alert ("Please confirm the password.")}
                else
                {
                    if(pass !== confpass)
                    {alert("Both of your password was not same.");}
                }
                if(!email)
                {alert("Please Enter your Email.")}
                else
                {
                    if(valemail < 1)
                    {alert("Your Email is not valid.");}
                }
                if(!/^[0-9]*$/g.test(document.getElementById("regphonenum").value))
                {alert ("Enter only number as your phone number.");}
                if(!nickname)
                {alert("Please enter a nickname.")}
                else
                {
                    if(!/^[0-9a-zA-Z]*$/g.test(document.getElementById("regnickname").value))
                    {
                        alert ("Enter charater or number as your nickname.");
                    }
                    else
                    {
                        if(nicknamelen>12)
                        {alert("Your nickname should not more than 12 words.")}
                    }
                }
              
            }
            </script>
            
            <div style="padding-top: 100px;">
            <center>
            <form action="" method="POST" name="form">
            <table style="width: 400px; height: 200px;">
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="regid" id="regid" value="<?php if (isset($_POST['regid'])) {print htmlspecialchars($_POST['regid']);} ?>"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="regpass" id="regpass" value=""></td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confpass" id="confpass" value=""></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="regemail" id="regemail" value="<?php if (isset($_POST['regemail'])) {print htmlspecialchars($_POST['regemail']);} ?>"></td>
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="text" name="regphonenum" id="regphonenum" value="<?php if (isset($_POST['regphonenum'])) {print htmlspecialchars($_POST['regphonenum']);} ?>"></td>
                </tr>
                <tr>
                    <td>NickName:</td>
                    <td><input type="text" name="regnickname" id="regnickname" value="<?php if (isset($_POST['regnickname'])) {print htmlspecialchars($_POST['regnickname']);} ?>"></td>
                </tr>
            </table>
           <input type="hidden" name="submitted" value="true" />
           <p style="padding-top: 25px;"><input type="submit" name="submit" value="Register" onclick="regvalidate()"/></p>
            </form>
                </center>
            </div>

<?php require ('footer.php');?>