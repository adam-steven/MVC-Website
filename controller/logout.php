<?php
//change the session information to null
session_start();
$_SESSION['username'] = "";
header("location: ../view/week4.php");
?>