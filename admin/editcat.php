<?php 
require('functions.php');
session_start();
$connection=mysqli_connect("localhost","root","");
    $db=mysqli_select_db($connection,"lms");
    $ID= "";
    $name="";
    $query="select * from category where id=$_GET[cno]";
            $query_run = mysqli_query($connection,$query);
            while($row=mysqli_fetch_assoc($query_run)){
             $ID=$row['id'];
             $name=$row['name'];
            
            }
?>
<!doctype html>
<html>
    <head>
        <title>User dashboard</title>
        <meta charset="utf-8" name="viewport" content="width-device,initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

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
                <a class="navbar-brand" href="admin_dashboard.php">Library Management System</a>
            </div>
        
        <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
        <font style="color: white"><span><strong>Employee id: <?php echo $_SESSION['empno'];?></strong></font>
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
    </nav>
    
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: yellow">
    <div class="container-fluid">
        <ul class="nav navbar-nav navbar-center">
            <li class="nav-item">
                <a href="admin_dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Books</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add book.php">Add new book</a>
                    <a class="dropdown-item" href="manage book.php">Manage books</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Category</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add category.php">Add new category</a>
                    <a class="dropdown-item" href="manage category.php">Manage category</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Authors</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add author.php">Add new author</a>
                    <a class="dropdown-item" href="manage author.php">Manage author</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="ssuebook_form.php" >Issue book</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="returnbook_form.php" >Return book</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<span><marquee>Library opens at 8.30 am and closes at 8.30pm</marquee></span>
<br><br>
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8">
<center><h3>Edit book details</h3></center>
           <form action="" method="post">
           <div class="form-group">
                <label for="id">Category ID:</label>
                <input type="number" name="id" class="form-control" value="<?php echo $ID;?>" disabled>
            </div>
            <div class="form-group">
                <label for="category">Category name:</label>
                <input type="text" name="category" class="form-control" value="<?php echo $name;?>" required>
            </div>
           
            <button type="submit" class="btn btn-primary" name="edit">EDIT</button>
           </form>
</div>
<div class="col-md-2"></div>
</div>
</BODY
</html>
<?php
if(isset($_POST['edit'])){
    $query = "SELECT name FROM category";
    $query_run = mysqli_query($connection, $query);
    $exists = false;
     while ($row = mysqli_fetch_assoc($query_run)) {
        if (strtolower($row['name']) == strtolower($_POST['category'])) {
            $exists = true;
            break;
        }
    }
    
    if ($exists) {
        echo '<script>alert("Category already exists.");</script>';
    } else{
    $query = "update category set  name= '$_POST[category]' where id=$_GET[cno]";
    $query_run = mysqli_query($connection, $query);
        
        
if ($query_run) {
    echo "<script>alert('Category updated successfully!'); window.location.href = 'manage category.php';</script>";
   
} else {
    echo "<script>alert('Update failed due to some error.... '); window.location.href = 'manage category.php';</script>";
    echo "Error: " . mysqli_error($connection);
}
}
}
?>
