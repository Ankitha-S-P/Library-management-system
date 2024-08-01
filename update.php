<?php
session_start(); 

$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$db = mysqli_select_db($connection, "lms");
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}

$query = "UPDATE users SET name=?,  number=?, address=? WHERE email=?";
$stmt = mysqli_prepare($connection, $query);

if ($stmt === false) {
    die('MySQL prepare error: ' . mysqli_error($connection));
}

mysqli_stmt_bind_param($stmt, "siss", $_POST['name'],$_POST['number'], $_POST['address'], $_SESSION['email']);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Updated successfully !");';
    echo 'window.location.href="user_dashboard.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Update failed !' . mysqli_error($connection) . '");';
    echo 'window.location.href="user_dashboard.php";';
    echo '</script>';
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
        