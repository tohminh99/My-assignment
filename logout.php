<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start() ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_destroy();
        echo "<center>You are loged out.You will be redirect to the homepage</center>";
        header( "refresh:5; url=home.php" ); 
        ?>
    </body>
</html>