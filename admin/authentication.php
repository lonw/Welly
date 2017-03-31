<?php
include('../inc/config.php');

session_start();

// Capture data from the login form
$username = $_POST['username'];
$password = $_POST['password'];

// To prevent sql injection
// We use mysql_real_escape_string
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

// Check the data sent, whether empty or not
if (empty($username) && empty($password)) {
    // If the username and password blank
    header('location:index.php?error=1');
    break;
} else if (empty($username)) {
    // If only an empty username
    header('location:index.php?error=2');
    break;
} else if (empty($password)) {

  // If passwords are empty
  // Redirect to the index page
    header('location:index.php?error=3');
    break;
}

$q = mysql_query("select * from users where email='$username' and password='$password'");

if (mysql_num_rows($q) == 1) {
    // If the username and password are already registered in the database
	 $_SESSION['username'] = $username;
    header('location:dashboard.php');
} else {
    // If username or password are not registered in the database
    header('location:index.php?error=4');

}

?>
