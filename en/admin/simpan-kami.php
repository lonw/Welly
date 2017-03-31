<?php
//panggil file config.php untuk menghubung ke server
require_once '../core/init.php';

//tangkap data dari form
$deskripsi = ((isset($_POST['desc']) && !empty($_POST['desc']))?$_POST['desc']:'');

//simpan data ke database
$query = mysql_query("UPDATE pageabout SET deskripsi='$deskripsi'");

if ($query) {
    header('location:page.php');
}
?>
