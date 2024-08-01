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
    $dateString = $_POST['issuedate']; 
    $date = new DateTime($dateString);
    $date->modify('+15 days');
    $returndate = $date->format('Y-m-d');
    $query = "insert into `issued books` values ($_POST[bid], $_POST[uid],$_SESSION[empno],'$_POST[issuedate]','$returndate','issued')";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
?>
       <script type="text/javascript">
    alert("Book issued succesfully.");
    window.location.href="issuebook_form.php";
</script>
<?php
        }
     else {
        echo '<script type="text/javascript">
    alert("Book issue failed due to some error. Kindly try again.");
    window.location.href="issuebook.php"';
    }
    mysqli_close($connection);
 ?>
