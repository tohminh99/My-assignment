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
        <?php
        session_start();
        session_destroy();
        echo "There is some error happening or it was your account being banned.";
        header( "refresh:5; url=home.php" ); 
        ?>
    </body>
</html>
