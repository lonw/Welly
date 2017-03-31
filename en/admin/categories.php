<?php
include('../inc/config.php');
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';

 //get accsss to the parents
$result = mysql_query("SELECT * FROM categories WHERE parent = 0");
$errors = array();
$category = '';
$post_parent = '';

//Edit Category
if(isset($_GET['edit']) && !empty($_GET['edit'])){ //if get edit event and not empty, go edit it
  $edit_id = (int)$_GET['edit'];
  $edit_id = sanitize($edit_id);
  $edit_result = mysql_query("SELECT * FROM categories WHERE id = '$edit_id'");
  $edit_category = mysql_fetch_assoc($edit_result);
}

// Delete category
if(isset($_GET['delete']) && !empty($_GET['delete'])){
  $delete_id = (int)$_GET['delete'];
  $delete_id = sanitize($delete_id);
  $result = mysql_query("SELECT * FROM categories WHERE id = '$delete_id'");
  $category = mysql_fetch_assoc($result);
  if($category['parent'] == 0){
    mysql_query("DELETE FROM categories WHERE parent = '$delete_id'");
  }

  mysql_query("DELETE FROM categories WHERE id = '$delete_id'");
  header('Location: categories.php');
}

//Process Form
if(isset($_POST) && !empty($_POST)){
  $post_parent = sanitize($_POST['parent']);
  $category = sanitize($_POST['category']);
  $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent'";
  if(isset($_GET['edit'])){
    $id = $edit_category['id'];
    $sqlform = "SELECT * FROM categories WHERE category = '$category' AND parent = '$post_parent' AND id !='$id'";
  }
  $fresult = mysql_query($sqlform);
  $count = mysql_num_rows($fresult);
  //if category is blank
  if($category == ''){
    $errors[] .= 'The category cannot be left blank.';
  }

  // If exists in the database
  if($count > 0){
    $errors[] .= $category. ' already exists. Please choosee a new category.';
  }

  // Display Errors or Update database
  if(!empty($errors)){
    //Display Errors
    $display = display_errors($errors);?>
    <script>
      jQuery('document').ready(function(){
        jQuery('#errors').html('<?php echo $display; ?>');
      });
    </script>
    <?php  }else{
    //update database
    $updatesql = "INSERT INTO categories (category, parent) VALUES ('$category','$post_parent')";
    if(isset($_GET['edit'])){
      $updatesql = "UPDATE categories SET category = '$category', parent = '$post_parent' WHERE id = '$edit_id'";
    }
    mysql_query($updatesql);
    header('Location: categories.php');
  }
}
$category_value = '';
$parent_value = 0;
if(isset($_GET['edit'])){
  $category_value = $edit_category['category'];
  $parent_value = $edit_category['parent'];
}else{
  if(isset($_POST)){
    $category_value = $category;
    $parent_value = $post_parent;
  }
}
?>
<h2 class="text-center">种类管理</h2><hr>
<div class="row">

  <!-- Form -->
  <div class="col-md-6">
    <form class="form" action="categories.php<?php echo((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post" accept-charset="utf-8">
      <legend><?php echo((isset($_GET['edit']))?'修改':'添加');?>类型</legend>
      <div id="errors"></div>
      <div class="form-group">
        <label for="parent">产品归类</label>
        <select class="form-control" name="parent" id="parent">
          <option value="0"<?php echo(($parent_value == 0)?' selected="selected"':'');?>>主类</option>
          <?php while($parent = mysql_fetch_assoc($result)) : ?>
            <option value="<?php echo $parent['id'];?>"<?php echo(($parent_value == $parent['id'])?' selected="selected"':'');?>><?php echo $parent['category'];?></option>
          <?php endwhile; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="category">类别名称:</label>
        <input type="text" class="form-control" id="category" name="category" value="<?php echo $category_value;?>">
      </div>
      <div class="form-group">
        <input type="submit" value="<?php echo((isset($_GET['edit']))?'修改':'添加');?>种类" class="btn btn-warning">
      </div>
  </div>

    <!-- category table -->
  <div class="col-md-6">
    <table class="table table-bordered ">
        <thead>
          <th>类型</th><th>分类为</th><th></th>
        </thead>
        <tbody>
          <?php
          $sql="SELECT * FROM categories WHERE parent = 0"; //get accsss to the parents
          $result = mysql_query($sql);
           while($parent = mysql_fetch_assoc($result)):
             $parent_id = (int)$parent['id'];
             $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
             $cresult = mysql_query($sql2);
            ?>
            <tr class="bg-primary">
              <td><?php echo $parent['category']; ?></td>
              <td>主类</td>
              <td>
                <a href="categories.php?edit=<?php echo $parent['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="categories.php?delete=<?php echo $parent['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
              </td>
            </tr>
            <?php while($child = mysql_fetch_assoc($cresult)): ?>
              <tr class="bg-info">
                <td><?php echo $child['category']; ?></td>
                <td><?php echo $parent['category']; ?></td>
                <td>
                  <a href="categories.php?edit=<?php echo $child['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                  <a href="categories.php?delete=<?php echo $child['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
              </tr>
            <?php endwhile;?>
          <?php endwhile;?>

        </tbody>
      </table>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
