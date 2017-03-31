<?php
  require_once '../core/init.php';
  include('check-login.php');
  include 'includes/head.php';
  include 'includes/navigation.php';
  //get brands from database
  $results = mysql_query("SELECT * FROM solution ORDER BY name");
  $errors = array();

  //Edit solution
  if(isset($_GET['edit']) && !empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $edit_result = mysql_query("SELECT * FROM solution WHERE id = '$edit_id'");
    $eName = mysql_fetch_assoc($edit_result);
  }

  //Delete solution
  if(isset($_GET['delete']) && !empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    $sql = "DELETE FROM solution WHERE id = '$delete_id'";
    $db->query($sql);
    header('Location: solution.php');
  }

  //If add form is submitted
  if(isset($_POST['add_submit'])){
    $name = sanitize($_POST['name']);
      //Check if name is blank
    if($_POST['name'] == ''){
      $errors[] .='You must enter a name!';
    }
    //Check if name exists in database
    $sql = "SELECT * FROM solution WHERE name = '$name'";
    if(isset($_GET['edit'])){
      $sql = "SELECT * FROM solution WHERE name = '$name' AND id != '$edit_id'";
    }
    $result = mysql_query($sql);
    $count = mysql_num_rows($result);
    if($count > 0){
      $errors[] .= $name.' Already exists. Please Choose another name ...';
    }
    //display errors
    if (!empty($errors)) {
      echo display_errors($errors);
    }else {
      //Add brand to database
      $sql = "INSERT INTO solution (name) VALUES ('$name')";
      if(isset($_GET['edit'])){
        $sql = "UPDATE solution SET name = '$name' WHERE id = '$edit_id'";
      }
      $db->query($sql);
      header('Location: solution.php');
    }
  }
?>
<h2>导航管理</h2><hr>
<!-- solution Form -->
<div class="text-center">
  <form class="form-inline" action="solution.php<?php echo((isset($_GET['edit']))?'?edit='.$edit_id:''); ?>" method="post" accept-charset="utf-8">
    <div class="form-group">
      <?php
      $name_value = '';
      if(isset($_GET['edit'])){
        $name_value = $eName['name'];
      }else{
        if(isset($_POST['name'])){
          $name_value = sanitize($_POST['name']);
        }
      }  ?>
      <label for="name"><?php echo((isset($_GET['edit']))?'修改':'添加'); ?>服务:</label>
      <input type="text" name="name" id="name" class="form-control" value="<?php echo $name_value; ?>">
      <?php if(isset($_GET['edit'])): ?>
        <a href="solution.php" class="btn btn-default">取消</a>
      <?php endif; ?>
      <input type="submit" name="add_submit" value="<?php echo((isset($_GET['edit']))?'修改':'添加'); ?>服务" class="btn btn-warning">
    </div>
  </form>
</div> <hr>
<table class="table table-bordered table-striped table-auto table-condensed">
  <thead>
    <th></th><th>服务</th><th></th>
  </thead>
  <tbody>
    <?php while($name = mysql_fetch_assoc($results)): ?>
    <tr>
      <td><a href="solution.php?edit=<?php echo $name['id']; ?> " class='btn btn-xs btn-default'><span class="glyphicon glyphicon-pencil"></span></a></td>
      <td> <?php echo $name['name']; ?> </td>
      <td><a href="solution.php?delete=<?php echo $name['id']; ?>" class='btn btn-xs btn-default'><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>
<?php include 'includes/footer.php'; ?>
