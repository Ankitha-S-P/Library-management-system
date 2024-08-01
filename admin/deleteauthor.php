<?php 

session_start();
$connection=mysqli_connect("localhost","root","");
    $db=mysqli_select_db($connection,"lms");
    $query="delete from authors where id=$_GET[ano]";
    $query_run=mysqli_query($connection,$query);
    if($query_run){
        ?>
               <script type="text/javascript">
            alert("Author deleted successfully!");
            window.location.href="manage author.php";
        </script>
        <?php
                }
             else {
                echo '<script type="text/javascript">
            alert("deletion failed due to some error. Kindly try again.");
            window.location.href="manage author.php"';
            }
            mysqli_close($connection);
         ?>