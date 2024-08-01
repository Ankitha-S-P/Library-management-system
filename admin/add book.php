<?php
session_start();
$connection=mysqli_connect("localhost","root","");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$db=mysqli_select_db($connection,"lms");
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
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

</head>
<body>
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
                <a class="nav-link" href="book issue.php" >Issue book</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="returnbook_form.php" >Return book</a>
            </li>
        </ul>
    </div>
</nav>
<br>
<span><marquee>Library opens at 8.30 am and closes at 8.30pm</marquee></span>
<br>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6" id="main_content">
           <center><h3>New book entry form</h3></center>
           <form action="" method="post">
        
            <div class="form-group">
                <label for="name">Book name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="authorname">Author name:</label>
                <select class="form-control" name="authorname" >
                    <option>-select author-</option>
                    <?php
                      $query="select * from `authors`";
                      $query_run=mysqli_query($connection,$query);
                      while($row=mysqli_fetch_assoc($query_run)){
                        ?>
                        <option><?php echo $row['name']; ?></option>
                        <?php
                      }
                    ?>
                </select>   
            </div>
            <div class="form-group">
                <label for="date">Purchase date:</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category">Category name:</label>
                <select class="form-control" name="category" required>
                    <option>-select category-</option>
                    <?php
                      $query="select * from category";
                      $query_run=mysqli_query($connection,$query);
                      while($row=mysqli_fetch_assoc($query_run)){
                        ?>
                        <option><?php echo $row['name']; ?></option>
                        <?php
                      }
                    ?>
                </select> 
            </div>
            <div class="form-group">
                <label for="price">Book price:</label>
                <input type="number" name="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add">Add new book</button>
           </form>
    </div>
<div class="col-md-3"></div>
</div>

</body>
</html>
<?php
if(isset($_POST['add'])){
   
   $query="select id from authors where name='$_POST[authorname]'";
   $query_run=mysqli_query($connection,$query);
   $row=mysqli_fetch_assoc($query_run);
   $authorid=$row['id'];

   $query="select id from category where name='$_POST[category]'";
   $query_run=mysqli_query($connection,$query);
   $row=mysqli_fetch_assoc($query_run);
   $category=$row['id'];
    $query = "INSERT INTO books VALUES ( null,'$_POST[name]',$authorid, '$_POST[date]', $category, $_POST[price])";
        
        $query_run = mysqli_query($connection, $query);
        $id=mysqli_insert_id($connection);
        if ($query_run) {
            echo "<script>alert('Book added successfully!\\n Book ID: $id');</script>";
        } else {
            echo '<script>alert("New book entry failed due to some error.... ");</script>';
            echo "Error: " . mysqli_error($connection);
        }
    }
    
    mysqli_close($connection);

?>
