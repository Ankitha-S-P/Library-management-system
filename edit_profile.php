<?php 
session_start();
$connection=mysqli_connect("localhost","root","");
$db=mysqli_select_db($connection,"lms");
$name="";
$email="";
$mobile="";
$address="";
$query="select * from users where email='$_SESSION[email]'";
$query_run=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($query_run)){
    $name=$row['name'];
    $email=$row['email'];
    $mobile=$row['number'];
    $address=$row['address'];
}
?>
<!doctype html>
<html>
    <head>
        <title>User dashboard</title>
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
                <a class="navbar-brand" href="user_dashboard.php">Library Management System</a>
            </div>
        
        <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
        <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
            <div class="nav navbar-nav navbar-right" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">My profile</button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="profile.php">view profile</a></li>
            <li><a class="dropdown-item" href="edit_profile.php">edit profile</a></li>
            <li><a class="dropdown-item" href="change_password.php">change password</a></li>
          </ul>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
    </li>
      </ul>
    </div>
    </div> 
    </nav><br>
    <span><marquee>Library opens at 8.30 am and closes at 8.30pm</marquee></span>
    <br>
   <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="update.php" method="post">
            <div class="form-group">
            <label>User ID:</label>
            <input type="text" class="form-control" value="<?php echo $_SESSION['id'];?>" disabled>
                <label>Name:</label>
                <input type="text" class="form-control" value="<?php echo $name ?>" name="name" >
                <label>Email id:</label>
                <input type="text" class="form-control" value="<?php echo $email ?>" name="email" disabled>
                <label>Mobile  No.:</label>
                <input type="number" class="form-control" value="<?php echo $mobile ?>" name="number">
                <label >Address:</label>
                <textarea rows="3" cols="50"  class="form-control" name="address"><?php echo $address ?></textarea>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
    <div class="col-md-4"></div>
   </div>
    </BODY>
</html>
