<?php
session_start();

//if the session has not yet created a username , or username empty session
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    //redirect to the login page
    header('location:index.php');
}
?>
