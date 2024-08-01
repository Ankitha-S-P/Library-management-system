<?php
  $connection=mysqli_connect("localhost","root","");
  $db=mysqli_select_db($connection,"lms");
  $query="insert into users values(null,'$_POST[name]','$_POST[email]',$_POST[number],'$_POST[address]','$_POST[password]')";
  $query_run=mysqli_query($connection,$query);
  $id=mysqli_insert_id($connection);
?>
<script type="text/javascript">
    alert("Registration successfull. Please note down your user ID.\nUser ID=<?php echo $id; ?>");
    window.location.href="login.php";
</script>