<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include 'includes/head.php';
$hashed = $user_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['id'];
$errors = array();
?>

<div id="login-form">
  <div>
    <?php
    if ($_POST) {
        // form validation
        if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
          $errors[] = 'You must fill out all fields.';
        }
        // password is more than 6 characters
        if(strlen($password) < 6){
          $errors[] = '密码最少由6个字母或者数字组成.';
        }
        // if new password matchs confirm
        if ($password != $confirm) {
          $errors[] = '确认密码不相符.';
        }
        if(!password_verify($old_password, $hashed)){
          $errors[] = '旧密码不相符';
        }
        // check for errors...
        if (!empty($errors)) {
          echo display_errors($errors);
        }else {
          //change password
          mysql_query("UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'");
          $_SESSION['success_flash'] = '您的密码已经更新!';
          header('Location: index.php');
        }
  }
  ?>
</div>
  <h2 class="text-center">更改密码</h2><hr>
  <form action="change_password.php" method="post" accept-charset="utf-8">
    <div class="form-group">
      <label for="old_password">旧密码:</label>
      <input type="password" name="old_password" id="old_password" class="form-control" value="<?php echo $old_password;?>">
    </div>
    <div class="form-group">
      <label for="password">新密码:</label>
      <input type="password" name="password" id="password" class="form-control" value="<?php echo $password;?>">
    </div>
    <div class="form-group">
      <label for="confirm">确认密码:</label>
      <input type="password" name="confirm" id="confirm" class="form-control" value="<?php echo $confirm;?>">
    </div>
    <div class="form-group">
      <a href="index.php" class="btn btn-default">取消</a>
      <input type="submit" value="确定" class="btn btn-warning">
    </div>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
