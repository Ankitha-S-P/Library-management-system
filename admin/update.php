<?php
session_start(); // Ensure session is started

// Establish connection
$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select database
$db = mysqli_select_db($connection, "lms");
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}

// Prepare update query with placeholders
$query = "UPDATE admin SET name=?, email=?, number=? WHERE empno=?";
$stmt = mysqli_prepare($connection, $query);

if ($stmt === false) {
    die('MySQL prepare error: ' . mysqli_error($connection));
}

// Bind parameters and execute
mysqli_stmt_bind_param($stmt, "ssis", $_POST['name'], $_POST['email'], $_POST['number'],  $_SESSION['empno']);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    echo '<script type="text/javascript">';
    echo 'alert("Updated successfully !");';
    echo 'window.location.href="admin_dashboard.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Update failed !' . mysqli_error($connection) . '");';
    echo 'window.location.href="admin_dashboard.php";';
    echo '</script>';
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
        