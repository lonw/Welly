<?php
include('../inc/config.php');
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';
//get accsss to the parents
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
$query = mysql_query("SELECT * FROM pageabout where lang = 0");

?>
  <h2 class="text-center">页面管理</h2><hr>
        <div class="container-fluid">




            <div class="row-fluid">
                <!--/span-->
                <div class="span10">
                	<div class="row-fluid">
		                <div class="span12" id="content">
		                    <div class="row-fluid">
		                        <!-- block -->
		                        <div class="block">
		                            <div class="block-content collapse in">
		                               	<form action="submit.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                      <?php  $data = mysql_fetch_array($query); ?>
                                        <textarea id="ckeditor_full" name="desc"><?php echo $data['deskripsi']; ?></textarea>
		                            	<br>
                                        <button class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
		                        </div>
		                        <!-- /block -->
		                    </div>
		                </div>
                	</div>
                </div>
            </div>
            <hr>
        </div>

        <!--/.fluid-container-->

<?php include 'includes/footer.php'; ?>
