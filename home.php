<?php require ('header.php');
?>

    <body>
      
        <div class="container">

        <!-- Portfolio Item Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Welcome
                   <?php 
                    if(!isset($_SESSION['nickname']))
                    {}
                    else
                    {
                        echo "<small>".$_SESSION['nickname']."</small>";
                    }
                    ?>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <!-- Related Projects Row -->
        <div class="row">

           
            <?php
             $con=  mysqli_connect('localhost', 'root', '','hmanga');
             $sql = "SELECT id,name,coverimg FROM manga ";
             $result=$con->query($sql);
            while($ans=mysqli_fetch_array($result))
            {
                echo '<div class="col-sm-3 col-xs-6" style="padding-bottom:15px;">';
                echo '<a href="mangapage.php?id='.$ans['id'].'">';
                echo '<img class="img-responsive portfolio-item" src="'.$ans['coverimg'].'" alt="">';
                echo "<center>";
                echo $ans['name'];
                echo "</center>";
                echo "</a>";
                echo "</div>";
             }
            mysqli_close($con);      
            ?>
                    
        </div>  

    
<?php require ('footer.php');?>