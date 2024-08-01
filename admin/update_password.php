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
$query = "select * from admin WHERE empno='$_SESSION[empno]'";
$query_run = mysqli_query($connection,$query);
while($row= mysqli_fetch_assoc($query_run)){
    $password=$row['password'];
    if($password==$_POST['old']){
         $query="update admin set password='$_POST[new]' where empno='$_SESSION[empno]'";
         $query_run=mysqli_query($connection,$query);
         echo '<script type="text/javascript">';
         echo 'alert("Password updated successfully !");';
         echo 'window.location.href="admin_dashboard.php";';
         echo '</script>';
    }
    else{
        echo '<script type="text/javascript">';
    echo 'alert("Update failed! ' . mysqli_error($connection) . '");';
    echo 'window.location.href="admin_dashboard.php";';
    echo '</script>';
    }
}
mysqli_close($connection);
?>
        