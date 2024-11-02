<?php 
session_start();
include '../dataBaseConn.php';
$name = $_SESSION['name'];
mysqli_query($conn, "UPDATE admins SET login='no' WHERE name='$name'");
session_unset();
session_destroy();
header("Location: index.php");
?>