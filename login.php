
<!doctype html>
<html>
    <head>
        <title>LMS</title>
        <meta charset="utf-8" name="viewport" content="width-device,initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        #side_bar{
            background-color: gray;
            padding: 40px;
            width: 350px;

        }
    </style>
    </head>
    <BODY>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="signup.php">Library Management System</a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="admin\admin_login.php">Admin Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">User Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">User register</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <span><marquee>Library opens at 8.30 am and closes at 8.30pm</marquee></span>
    <br>
    <div class="row">
        <div class="col-md-4" id="side_bar">
            <h3>Amenities</h3>
            <ul>
                <li>Over 1000 books across 15 languages.</li>
                <li>Free WiFi.</li>
                <li>E-Books across 25 languages.</li>
                <li>Open on all days of a week.</li>
                <li>Weekly and daily magazines.</li>
            </ul>
        </div>
        <div class="col-md-8" id="main_content">
           <center><h3>User Login</h3></center>
           <form action="" method="post">
           <div class="form-group">
                <label for="id">User ID:</label>
                <input type="number" name="id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" class="form-control" required>
            </div>
            
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
           </form>
           <?php
session_start();

if(isset($_POST['login'])){
    $connection = mysqli_connect("localhost", "root", "", "lms");

    if(mysqli_connect_errno()){
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    $query = "SELECT * FROM users WHERE email='$email' and id=$id";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) > 0){
        $row = mysqli_fetch_assoc($query_run);
        if($row['password'] == $_POST['password']){
            // Password matches, set session variables and redirect
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            mysqli_close($connection);
            header("Location: user_dashboard.php");
            exit;
        } else {
            // Incorrect password
            echo '<br><br><center><span class="alert-danger">Wrong Password !!</span></center>';
        }
    } else {
        // Email not found
        echo 'Email not found';
    }

    mysqli_close($connection);
}
?>

    </div>
    </div>
    

    </BODY>
</html>
