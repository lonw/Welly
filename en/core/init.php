<?php

	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$dbname = 'welly';
	//mengubung ke host
	$connect = mysql_connect($host, $user, $pass) or die(mysql_error());

	//memilih database yang akan digunakan
	$dbselect = mysql_select_db($dbname);
  mysql_query('set names utf8');


session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/en/config.php';
require_once BASEURL.'/en/helpers/helpers.php';
// require BASEURL.'vendor/autoload.php';
//
// $cart_id = '';
// if (isset($_COOKIE[CART_COOKIE])) {
//   $cart_id = sanitize($_COOKIE[CART_COOKIE]);
// }
//
if(isset($_SESSION['SBUser'])){
  $user_id = $_SESSION['SBUser'];
  $query = mysql_query("SELECT * FROM users WHERE id = '$user_id'");
  $user_data = mysql_fetch_assoc($query);


}
// challenge session login after 5 seconds disappear the session class
if(isset($_SESSION['success_flash'])){
  echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
  unset($_SESSION['success_flash']);
}
if(isset($_SESSION['error_flash'])){
  echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
  unset($_SESSION['error_flash']);
}
