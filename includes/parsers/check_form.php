<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';

$username = sanitize($_POST['username']);
$passwd = sanitize($_POST['passwd']);

$errors = array();
$required = array(
  'username' => '用户名',
  'passwd'   => '密码',
);

  if ($_POST) {
      // form validation
      if (empty($_POST['username']) || empty($_POST['passwd'])) {
        $errors[] = '请输入邮箱和密码.';
      }
      // check if valid username address
      if (!filter_var($username,FILTER_VALIDATE_EMAIL)) {
        $errors[] = '请输入有效邮箱和密码';
      }
      //check if username exists in the database
      $query = mysql_query("SELECT * FROM users WHERE email ='$username'");
      $user = mysql_fetch_assoc($query);
      $userCount = mysql_num_rows($query);
      // echo $userCount;
      if ($userCount == 0) {
        $errors[] = '您的邮箱不存在.';
      }
      if(!password_verify($passwd, $user['password'])){
        $errors[] = '您的邮箱或密码不正确，请再输入一次.';
      }
      // check for errors...
      if (!empty($errors)) {
        echo display_errors($errors);
      }else {
        echo 'passed';
        //log user in
          $user_id = $user['id'];
          login($user_id);

      }
}

 ?>
