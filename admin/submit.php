<?php
//panggil file config.php untuk menghubung ke server
require_once '../core/init.php';

//tangkap data dari form
$deskripsi = ((isset($_POST['desc']) && !empty($_POST['desc']))?$_POST['desc']:'');

//Submit data ke database
$query = mysql_query("UPDATE pageabout SET deskripsi='$deskripsi' where lang = 0");

if ($query) {
    header('location:page.php');
}
?>
