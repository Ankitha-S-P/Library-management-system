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
   <div class="row" style="margin:15px">
      <div class="col-md-9" >
        <div class="card bg-light" >
            <div class="card-header"><center>Books currently issued</center></div>
              <div class="card-body">
                 <table class="table  table-striped">
                    <tr>
                    <th>Book No.</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Issue date</th>
                    <th>Return date<br>(without fine)</th>
                    </tr>
                    <?php
                      $query="SELECT b.id as bookno,b.name as name, a.name as aname,i.`issue date` as issuedate, i.`return date` as returndate 
                             FROM `issued books` i 
                             JOIN `books` b ON i.`book no` = b.id 
                             JOIN `authors` a ON b.`author id` = a.id 
                             WHERE i.`user id` =$_SESSION[id]";
                      $query_run=mysqli_query($connection,$query);
                      while($row=mysqli_fetch_assoc($query_run)){
                        echo "
                          <tr>
                            <td>$row[bookno]</td>
                            <td>$row[name]</td>
                            <td>$row[aname]</td>
                            <td>$row[issuedate]</td>
                            <td>$row[returndate]</td>
                          </tr>
                        ";
                      }
                      mysqli_close($connection); 
                    ?>
                 </table>
              </div>
        </div>
      </div>
   </div>
    </BODY>
</html>
