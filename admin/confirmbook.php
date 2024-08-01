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
    
    $query = "SELECT `book no` FROM `issued books`";
    $query_run = mysqli_query($connection, $query);
    if (!$query_run) {
        die("Query failed: " . mysqli_error($connection));
    }
    $exists = false;
    $user_exists=false;
    $book_exists = false;
    $book_no = $_POST['id'];
    $user_id = $_POST['userid'];
    $issuedate= $_POST['date'];
    while ($row = mysqli_fetch_assoc($query_run)) {
        if ($row['book no'] ==  $book_no ) {
            $exists = true;
            break;
        }
    }
    $query = "SELECT id FROM users";
    $query_run = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        if ($row['id'] ==  $user_id ) {
            $user_exists = true;
            break;
        }
    }

    $query = "SELECT id FROM books";
    $query_run = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        if ($row['id'] ==  $book_no ) {
            $book_exists = true;
            break;
        }
    }
// to check if book is already issued
    if ($exists) {
?>
        <script type="text/javascript">
    alert("Book with book no: <?php echo $_POST['id'] ?> has been issued already.");
    window.location.href="issuebook_form.php";
</script>



// to check if user exists
<?php
    } 
    else if(!$user_exists){
?>
        <script type="text/javascript">
    alert("Invalid user ID. Kindly check again and try.");
    window.location.href="issuebook_form.php";
</script>

//TO check if book no is valid
<?php
    } 
    else if(!$book_exists){
?>
        <script type="text/javascript">
    alert("Invalid book Number. Kindly check again and try.");
    window.location.href="issuebook_form.php";
</script>

// confirmation and issuing
<?php
    }
    else {

$query = "select b.name as bookname,a.name as authorname, u.name as username  from users u,books b, authors a where b.id=$_POST[id] and u.id=$_POST[userid] and b.`author id`=a.id";
$query_run = mysqli_query($connection, $query);
$bookname="";
$username="";
$authorname="";
while($row=mysqli_fetch_assoc($query_run)){
    $bookname=$row['bookname'];
    $username=$row['username'];
    $authorname=$row['authorname'];
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
        <script>
        function redirectToPage() {
            window.location.href = "issuebook_form.php";
        }
    </script>
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
                <a class="nav-link" href="issuebook_form.php" >Issue book</a>
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
           <center><h3>Book issue</h3></center>
           <form action="issue_book.php" method="post" >
            <div class="form-group">
                <label >Book ID:</label>
                <input type="number" name="bid" class="form-control" value="<?php echo $book_no; ?>" readonly >
            </div>
            <div class="form-group">
                <label >Book Name:</label>
                <input type="text" name="bname" class="form-control" value="<?php echo $bookname; ?>" readonly >
            </div>
            <div class="form-group">
                <label >User ID:</label>
                <input type="number" name="uid" class="form-control" value="<?php echo $user_id; ?>" readonly >
            </div>
            <div class="form-group">
                <label >User name:</label>
                <input type="text" name="uname"  class="form-control" value="<?php echo $username; ?>" readonly >
            </div>
            <div class="form-group">
                <label >Author name:</label>
                <input type="text" name="aname" class="form-control" value="<?php echo $authorname; ?>" readonly >
            </div>
            <div class="form-group">
                <label >Issue Date:</label>
                <input type="date" name="issuedate" class="form-control" value="<?php echo $issuedate; ?>" readonly>
            </div>
           
           <h4> Kindly verify the book details and submit to confirm book issue.</h4>
           <button type="submit" class="btn btn-primary" name="issue">Issue book</button>
           <button type="button" class="btn btn-primary" onclick="redirectToPage()">Back to previous page</button>
          </form>
    </div>
<div class="col-md-3"></div>
</div>
</body>
</html>
 <?php } mysqli_close($connection); ?>