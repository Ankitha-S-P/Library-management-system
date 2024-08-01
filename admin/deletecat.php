<?php 

session_start();
$connection=mysqli_connect("localhost","root","");
    $db=mysqli_select_db($connection,"lms");
    $query="delete from category where id=$_GET[cno]";
    $query_run=mysqli_query($connection,$query);
    if($query_run){
        ?>
               <script type="text/javascript">
            alert("Category deleted successfully!");
            window.location.href="manage category.php";
        </script>
        <?php
                }
             else {
                echo '<script type="text/javascript">
            alert("Deletion failed due to some error. Kindly try again.");
            window.location.href="manage category.php"';
            }
            mysqli_close($connection);
         ?>