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
    
    $query = "SELECT `book no`,`return date` FROM `issued books` where `user id`=$_POST[userid]";
    $query_run = mysqli_query($connection, $query);
    if (!$query_run) {
        die("Query failed: " . mysqli_error($connection));
    }
    $exists = false;
    $user_exists=false;
    $book_exists = false;
    $book_no = $_POST['id'];
    $user_id = $_POST['userid'];
    $returneddate= $_POST['date'];
    
    while ($row = mysqli_fetch_assoc($query_run)) {
        if ($row['book no'] ==  $book_no ) {
            $exists = true;
            $actualreturn=$row['return date'];
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
// to check if book is issued
    if (!$exists) {
?>
        <script type="text/javascript">
    alert("This book was not issued to this user.");
    window.location.href="returnbook_form.php";
</script>



// to check if user exists
<?php
    } 
    else if(!$user_exists){
?>
        <script type="text/javascript">
    alert("Invalid user ID. Kindly check again and try.");
    window.location.href="returnbook_form.php";
</script>

//TO check if book no is valid
<?php
    } 
    else if(!$book_exists){
?>
        <script type="text/javascript">
    alert("Invalid book Number. Kindly check again and try.");
    window.location.href="returnbook_form.php";
</script>

// confirmation and return
<?php
    }
    else {
       $diff=0;
       $fine=0;
       $date = new DateTime($returneddate);
       $returndate=new DateTime($actualreturn);
       if($date>$returndate){
       $interval = $returndate->diff($date);
       $diff=abs($interval->d);
       $fine=$diff * 2;// Rs.2 fine per day
       }
       //update return table
      
       $query = "insert into `returned books` values ($_POST[id], $_POST[userid],$_SESSION[empno],'$_POST[date]',$diff,$fine)";
       $query_run = mysqli_query($connection, $query);

       if($query_run){
        
        $query = "delete from `issued books` where `book no`=$_POST[id]";
        $query_run = mysqli_query($connection, $query);
    
       // update user table
       
       $query = "update users set fine=fine + $fine where id=$_POST[userid]";
       $query_run = mysqli_query($connection, $query);
       
   ?>
          <script type="text/javascript">
       alert("Book returned succesfully.");
       window.location.href="returnbook_form.php";
   </script>
   <?php
           }
        else {
           echo '<script type="text/javascript">
       alert("Book return failed due to some error. Kindly try again.");
       window.location.href="returnbook.php"';
       }
      
   }
    mysqli_close($connection); 
    ?>