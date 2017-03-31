<?php
require_once '../core/init.php';
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';
if (isset($_GET['delete'])) {
  $delete_id = sanitize($_GET['delete']);
  mysql_query("DELETE FROM users WHERE id = '$delete_id'");
  header('Location: users.php');
}
if ((isset($_GET['add']))||(isset($_GET['edit']))) {
  $fname = ((isset($_POST['fname']))?sanitize($_POST['fname']):'');
  $lname = ((isset($_POST['lname']))?sanitize($_POST['lname']):'');
  $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
  $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
  $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
  $permissions = ((isset($_POST['permissions']))?sanitize($_POST['permissions']):'');
  $errors = array();

  if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $usersResults = mysql_query("SELECT * FROM users WHERE id = '$edit_id'");
    $users = mysql_fetch_assoc($usersResults);

    $fname = ((isset($_POST['fname']) && $_POST['fname'] !='')?sanitize($_POST['fname']):$users['fname']);
    $lname = ((isset($_POST['lname']) && $_POST['lname']  !='')?sanitize($_POST['lname']):$users['lname']);
    $email = ((isset($_POST['email']) && $_POST['email']  !='')?sanitize($_POST['email']):$users['email']);
    $password = ((isset($_POST['password']) && $_POST['password']  !='')?sanitize($_POST['password']):$users['password']);
    $confirm = ((isset($_POST['password']) && $_POST['password']  !='')?sanitize($_POST['password']):$users['password']);
    $permissions = ((isset($_POST['permissions']) && $_POST['permissions']  !='')?sanitize($_POST['permissions']):$users['permissions']);

  }
  if ($_POST) {
    $getEmail = mysql_query("SELECT * FROM users WHERE email = '$email'");
    $emailCount = mysql_num_rows($getEmail);

    if ($emailCount != 0 && (isset($_GET['add']))) {
      $errors[] = 'That email already exists in database.';
    }
      $required = array('fname','lname', 'email', 'password', 'confirm', 'permissions');
      foreach ($required as $field) {
        if(empty($_POST[$field])){
          $errors[] = 'You must fill out all fields.';

        }
      }
      if(strlen($password) < 6){
        $errors[] = 'Your password must be at least 6 characters';
      }
      if($password != $confirm){
        $errors[] = 'Your password do not match';
      }
      if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'You must enter the valid email';
      }

      if(!empty($errors)){
        echo display_errors($errors);
      }
      else {
        ////add user to database
        $hashed = password_hash($password,PASSWORD_DEFAULT);
        $insertSql = "INSERT INTO users (fname,lname,email,password,permissions,last_login)
        VALUES ('$fname','$lname','$email','$hashed','$permissions','0000-00-00 00:00:00')";
        $_SESSION['success_flash'] = 'User has been updated!';
        if (isset($_GET['edit'])) {
          $insertSql = "UPDATE users SET fname = '$fname', lname = '$lname', email = '$email', password = '$hashed' ,
           permissions = '$permissions' WHERE id = $edit_id";
        }

        mysql_query($insertSql);
        header('Location: users.php');
      }
  }
?>
    <h2 class="text-center"><?php echo((isset($_GET['edit']))?'修改':'添加');?>用户</h2><hr>
    <form action="users.php?<?php echo((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" accept-charset="utf-8">
      <div class="form-group col-md-6">
        <label for="fname">First name:</label>
         <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $fname;?>">
      </div>
      <div class="form-group col-md-6">
      <label for="lname">Last name:</label>
       <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $lname;?>">
    </div>
      <div class="form-group col-md-6">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" class="form-control" value="<?php echo $email;?>">
      </div>
      <div class="form-group col-md-6">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" value="<?php echo $password;?>">
      </div>
      <div class="form-group col-md-6">
        <label for="confirm">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm" class="form-control" value="<?php echo $confirm;?>">
      </div>
      <div class="form-group col-md-6">
        <label for="name">Permissions:</label>
        <select class="form-control" name="permissions">
          <option value=""<?php echo(($permissions == '')?' selected':'');?>></option>
          <option value="editor"<?php echo(($permissions == 'editor')?' selected':'');?>>Editor</option>
          <option value="editor,admin"<?php echo(($permissions == 'editor,admin')?' selected':'');?>>Admin</option>
        </select>
      </div>
      <div class="form-group col-md-6 text-right" style="margin-top:25px;">
        <a href="users.php" class="btn btn-default">Cancel</a>
        <input type="submit" value="<?php echo((isset($_GET['edit']))?'Edit':'Add');?> User" class="btn btn-warning">
      </div>
    </form>
    <?php
}else {
$showUser = mysql_query("SELECT * FROM users ORDER BY lname");
?>
<!-- Users Home -->
<h2 class="text-center">用户管理</h2>
<a href="users.php?add=1" class="btn btn-warning pull-right" id="add-product-btn">Add New User</a>
<div class="clearfix"></div>
<hr>

<table class="table table-bordered table-striped table-condensed">
  <thead>
    <th></th><th>Name</th><th>Email</th><th>Join Date</th><th>Last Login</th><th>Permission</th>
  </thead>
  <tbody>
    <?php while($user = mysql_fetch_assoc($showUser)): ?>
      <tr>
      <td>
        <!-- delete excepted myself -->
        <?php if($user['id'] != $user_data['id']): ?>
          <a href="users.php?edit=<?php echo $user['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
          <a href="users.php?delete=<?php echo $user['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></a>
        <?php endif; ?>
      </td>
      <td><?php echo $user['fname'];?> <?php echo $user['lname'];?></td>
      <td><?php echo $user['email'];?></td>
      <td><?php echopretty_date($user['join_date']);?></td>
      <td><?php echo(($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login']));?></td>
      <td><?php echo $user['permissions'];?></td>
    </tr>
    <?php  endwhile; ?>
  </tbody>
</table>
<?php } include 'includes/footer.php'; ?>
