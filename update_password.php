<?php
session_start(); 

$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
$password="";
$db = mysqli_select_db($connection, "lms");
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}
$query = "select * from users WHERE email='$_SESSION[email]' and id=$_SESSION[id]";
$query_run = mysqli_query($connection,$query);
while($row= mysqli_fetch_assoc($query_run)){
    $password=$row['password'];
    if($password==$_POST['old']){
         $query="update users set password='$_POST[new]' where email='$_SESSION[email]' and id=$_SESSION[id]";
         $query_run=mysqli_query($connection,$query);
         if($query_run){
         echo '<script type="text/javascript">';
         echo 'alert("Password updated successfully !");';
         echo 'window.location.href="user_dashboard.php";';
         echo '</script>';
         }
         else{
            echo '<script type="text/javascript">';
    echo 'alert("Update failed! ' . mysqli_error($connection) . '");';
    echo 'window.location.href="user_dashboard.php";';
    echo '</script>';
         }
    }
    else{
        echo '<script type="text/javascript">';
    echo 'alert("Wrong current password ' . mysqli_error($connection) . '");';
    echo 'window.location.href="user_dashboard.php";';
    echo '</script>';
    }
}
mysqli_close($connection);
?>
        