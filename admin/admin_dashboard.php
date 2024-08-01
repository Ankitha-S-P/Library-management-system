<?php 
require('functions.php');
session_start();

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
<div class="row" style="margin:10px">
<div class="col-md-3" style="padding:10px">
     <div class="card bg-light" style="width:300px">
            <div class="card-header">Registered books:</div>
        <div class="card-body">
            <p class="card-text">No. of registered books: <?php echo book_count(); ?></p>
            <a href="regbooks.php" class="btn btn-danger" target="_blank">View registered books</a>
        </div>
     </div>
    </div>
    <div class="col-md-3" style="padding:10px">
     <div class="card bg-light" style="width:300px">
            <div class="card-header">Registered users:</div>
        <div class="card-body">
            <p class="card-text">No. of available users: <?php echo user_count(); ?></p>
            <a href="regusers.php" class="btn btn-danger" target="_blank">View registered users</a>
        </div>
     </div>
    </div>
    <div class="col-md-3" style="padding:10px">
     <div class="card bg-light" style="width:300px">
            <div class="card-header">Registered category:</div>
        <div class="card-body">
            <p class="card-text">No. of category: <?php echo category_count(); ?></p>
            <a href="categorylist.php" class="btn btn-danger" target="_blank">View categories</a>
        </div>
     </div>
    </div>
    <div class="col-md-3" style="padding:10px">
     <div class="card bg-light" style="width:300px">
            <div class="card-header">Registered authors:</div>
        <div class="card-body">
            <p class="card-text">No. of available authors: <?php echo authors_count(); ?></p>
            <a href="regauthors.php" class="btn btn-danger" target="_blank">View registered authors</a>
        </div>
     </div>
    </div>
    <div class="col-md-3" style="padding:10px">
     <div class="card bg-light" style="width:300px">
            <div class="card-header">Issued books:</div>
        <div class="card-body">
            <p class="card-text">No. of issued books: <?php echo issued_books_count(); ?></p>
            <a href="issuelist.php" class="btn btn-danger" target="_blank">View issued books</a>
        </div>
     </div>
    </div>
    
    <div class="col-md-3" style="padding:10px">
     <div class="card bg-light" style="width:300px">
            <div class="card-header">Returned books:</div>
        <div class="card-body">
            <p class="card-text"></p>
            
            <a href="returnhistory.php" class="btn btn-danger" target="_blank">View returned books history</a>
        </div>
     </div>
    </div>
</div>
    </BODY>
</html>
