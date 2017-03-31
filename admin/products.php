<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';

//Delete Product
if (isset($_GET['delete'])) {
  $id = sanitize($_GET['delete']);
  mysql_query("UPDATE products SET deleted = 1 WHERE id = '$id'");
  header('Location: products.php');
}
$dbpath = '';
if (isset($_GET['add']) || isset($_GET['edit'])) {
  $showBrand = mysql_query("SELECT * FROM brand ORDER BY brand");
  $showParent = mysql_query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
  $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
  $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
  $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
  $category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
  $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
  $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
  $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
  $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):'');
  $sizes = rtrim($sizes,',');
  $saved_image = '';

  if(isset($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $productResults =mysql_query("SELECT * FROM products WHERE id = '$edit_id'");
    $product = mysql_fetch_assoc($productResults);
    if (isset($_GET['delete_image'])) {
      $imagei =(int)$_GET['imagei'] - 1;
      $images = explode(',',$product['image']);
      $image_url = $_SERVER['DOCUMENT_ROOT'].$images[$imagei];
      unlink($image_url);
      unset($images[$imagei]);
      $imageString = implode(',',$images);
      $db->query("UPDATE products SET image = '{$imageString}' WHERE id = '$edit_id'");
      header('Location: products.php?edit='.$edit_id);
    }

    $category = ((isset($_POST['child']) && $_POST['child'] !='')?sanitize($_POST['child']):$product['categories']);
    $title = ((isset($_POST['title']) && $_POST['title']  !='')?sanitize($_POST['title']):$product['title']);
    $brand = ((isset($_POST['brand']) && $_POST['brand']  !='')?sanitize($_POST['brand']):$product['brand']);
    $parentQuery = $db->query("SELECT * FROM  categories WHERE id = '$category'");
    $parentResult = mysql_fetch_assoc($parentQuery);
    $parent = ((isset($_POST['parent']) && $_POST['parent']  !='')?sanitize($_POST['parent']):$parentResult['parent']);
    $price = ((isset($_POST['price']) && $_POST['price']  !='')?sanitize($_POST['price']):$product['price']);
    $list_price = ((isset($_POST['list_price']) && $_POST['list_price']  !='')?sanitize($_POST['list_price']):$product['list_price']);
    $description = ((isset($_POST['description']))?sanitize($_POST['description']):$product['description']);
    $sizes = ((isset($_POST['sizes']) && $_POST['sizes']  !='')?sanitize($_POST['sizes']):$product['sizes']);
    $sizes = rtrim($sizes,',');
    $saved_image = (($product['image'] != '')?$product['image']:'');
    $dbpath = $saved_image;
  }
  if(!empty($sizes)) {
    $sizeString = sanitize($sizes);
    $sizeString = rtrim($sizeString,',');
    // echo $sizeString;
    $sizesArray = explode(',',$sizeString);
    $sArray = array();
    $qArray = array();
    $tArray = array();
    foreach ($sizesArray as $ss) {
      $s = explode(':', $ss);
      $sArray[] = $s[0];
      $qArray[] = $s[1];
      $tArray[] = $s[2];
    }
  }else {$sizesArray = array();}
  if($_POST){
     $errors = array();
    $required = array('title', 'brand', 'price', 'parent', 'child', 'sizes');
    $allowed = array('png','jpg','jpeg','gif');
    $uploadPath = array();
    $tmpLoc = array();
    foreach ($required as $field ) {
      if($_POST[$field]  == ''){
        $errors[] = 'All Fields With and Astrisk are required.';
        break; //get errors and stop looping
      }
    }
     $photoCount = count($_FILES['photo']['name']);
    // File check field
    if($photoCount  > 0) {
      for ($i=0; $i < $photoCount; $i++) {
        //   //for show the data of the image that was uploaded --delevelop mode
          $name = $_FILES['photo']['name'][$i];
          $nameArray = explode('.',$name);
          $fileName = $nameArray[0];
          $fileExt = $nameArray[1];
          $mime = explode('/',$_FILES['photo']['type'][$i]);
          $mimeType = $mime[0];
          $mimeExt = $mime[1];
          $tmpLoc[] = $_FILES['photo']['tmp_name'][$i];
          $fileSize = $_FILES['photo']['size'][$i];
          $uploadName = md5(microtime().$i).'.'.$fileExt;
          $uploadPath[] = BASEURL.'images/products/'.$uploadName;
          if ($i !=0) {
            $dbpath .= ',';
          }
          $dbpath .= '/images/products/'.$uploadName;
          if($mimeType != 'image'){
            $errors[] = '必须是图片档案格式.';
          }
          if (!in_array($fileExt, $allowed)) {
            $errors[] = '图片档案格式必须是 png, jpg, jpeg, 或者 gif.';
          }
          if ($fileSize > 1194304){
            $errors[] = '上传档案太大,只能接受每张图片1MB以下.';
          }
          // if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
          //   $errors[] = '档案后续不符，请联络管理员，资资的男朋友.';
          // }
      }
    }
    if(!empty($errors)){
      echo display_errors($errors);
    }
    else {
      //upload file
      if ($photoCount > 0) {
        for ($i=0; $i < $photoCount; $i++) {
          move_uploaded_file($tmpLoc[$i],$uploadPath[$i]);
        }
      }
      // insert into database
      $insertSql = "INSERT INTO products (`title`,`price`,`list_price`,`brand`,`categories` ,`sizes` ,`image`,`description`)
      VALUES ('$title','$price','$list_price','$brand', '$category','$sizes','$dbpath','$description')";
      if (isset($_GET['edit'])) {
        $insertSql = "UPDATE products SET title = '$title', price = '$price', list_price = '$list_price', brand = '$brand' ,
         categories = '$category', sizes = '$sizes' , image = '$dbpath', description = '$description' WHERE id = $edit_id";
      }
      $db->query($insertSql);
      header('Location: products.php');

    }
  }
?>
  <h2 class="text-center"><?php echo((isset($_GET['edit']))?'修改':'添加');?>产品</h2><hr>
  <form action="products.php?<?php echo((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
  <div class="form-group col-md-3">
    <label for="title">标题*:</label>
    <input type="text" name="title" class="form-control" id="title" value="<?php echo $title;?>">
  </div>
  <div class="form-group col-md-3">
    <label for="brand">品牌*:</label>
    <select class="form-control" id="brand" name="brand">
      <option value=""<?php echo(($brand == '')?' selected':'');?>></option>
      <?php while($b = mysql_fetch_assoc($showBrand)): ?>
        <option value="<?php echo $b['id'];?>"<?php echo(($brand == $b['id'])?' selected':'');?>><?php echo $b['brand'];?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="parent">主类*:</label>
    <select class="form-control" id="parent" name="parent">
      <option value=""<?php echo(($parent == '')?' selected':'');?>></option>
      <?php while($p = mysql_fetch_assoc($showParent)): ?>
        <option value="<?php echo $p['id'];?>"<?php echo(($parent == $p['id'])?' selected':'');?>><?php echo $p['category'];?></option>
      <?php endwhile; ?>
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="child">子类*:</label>
    <select id="child" name="child" class="form-control">
    </select>
  </div>
  <div class="form-group col-md-3">
    <label for="price">售价*:</label>
    <input type="text" id="price" name="price" class="form-control" value="<?php echo $price;?>">
  </div>
  <div class="form-group col-md-3">
    <label for="list_price">原价*:</label>
    <input type="text" id="list_price" name="list_price" class="form-control" value="<?php echo $list_price;?>">
  </div>
  <div class="form-group col-md-3">
    <label for="">存货 & 尺码</label>
    <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">尺寸 & 货存</button>
  </div>
  <div class="form-group col-md-3">
    <label for="sizes">尺码 & 货存 概括</label>
    <input type="text" class="form-control" name="sizes" id='sizes' value="<?php echo $sizes;?>" readonly>
  </div>
  <div class="form-group col-md-6">
    <?php if($saved_image != ''): ?>
      <?php
        $imagei = 1;
        $images = explode(',',$saved_image); ?>
      <?php foreach($images as $image): ?>
      <div class="saved-image col-md-4">
        <img src="<?php echo $image;?>" alt="saved_image"/><br>
        <a href="products.php?delete_image=1&edit=<?php echo $edit_id;?>&imagei=<?php echo $imagei;?>" class="text-danger">删除图片</a>
      </div>
    <?php
    $imagei++;
    endforeach; ?>
    <?php else: ?>
      <label for="photo">产品图片:</label>
      <input type="file" name="photo[]" id="photo" accept="image/*" class="form-control" multiple>
    <?php endif ?>
  </div>
  <div class="form-group col-md-6">
    <label for="description">描述:</label>
    <textarea id="description" name="description" class="form-control" rows="20"><?php echo $description;?></textarea>
  </div>
  <div class="form-group pull-right">
    <input type="submit" value="<?php echo((isset($_GET['edit']))?'修改':'添加');?>产品" class="btn btn-warning">
    <a href="products.php" class="btn btn-default">取消</a>
  </div><div class="clearfix"></div>
  </form>
  <!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">尺码 & 数量 (注意:请字母或数字)</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
        <?php for($i=1;$i <= 12;$i++): ?>
          <div class="form-group col-md-2">
            <label for="size<?php echo $i;?>">尺码/颜色:</label>
            <input type="text" name="size<?php echo $i;?>" id="size<?php echo $i;?>" value="<?php echo((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
          </div>
          <div class="form-group col-md-2">
            <label for="qty<?php echo $i;?>">数量:</label>
            <input type="number" name="qty<?php echo $i;?>" id="qty<?php echo $i;?>" value="<?php echo((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
          </div>
          <div class="form-group col-md-2">
            <label for="threshold<?php echo $i;?>">临界值:</label>
            <input type="number" name="threshold<?php echo $i;?>" id="threshold<?php echo $i;?>" value="<?php echo((!empty($tArray[$i-1]))?$tArray[$i-1]:'');?>" min="0" class="form-control">
          </div>
        <?php endfor; ?>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
        <button type="button" class="btn btn-warning" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;" >保存设定</button>
      </div>
    </div>
  </div>
</div>
<?php }else{
$presults = mysql_query("SELECT * FROM products WHERE deleted = 0");
if (isset($_GET['featured'])) {
  $id = (int)$_GET['id'];
  $featured = (int)$_GET['featured'];
  mysql_query("UPDATE products SET featured = '$featured' WHERE id = '$id'");
  header('Location: products.php');
}
 ?>
 <h2 class="text-center">产品管理</h2>
<a href="products.php?add=1" class="btn btn-warning pull-right" id="add-product-btn">添加产品</a>
<div class="clearfix"></div>
 <hr>
 <table class="table table-bordered table-condensed table-striped">
   <thead><th></th><th>产品</th><th>售价</th><th>类型</th><th>特别推荐</th><th>成交</th></thead>
   <tbody>
   <?php while($product = mysql_fetch_assoc($presults)):
        $childID = $product['categories'];
        $result = mysql_query("SELECT * FROM categories WHERE id = '$childID'");
        $child = mysql_fetch_assoc($result);
        $parentID = $child['parent'];
        $presult = mysql_query("SELECT * FROM categories WHERE id = '$parentID'");
        $parent = mysql_fetch_assoc($presult);
        $category = $parent['category'].'~'.$child['category'];
      ?>
     <tr>
       <td>
         <a href="products.php?edit=<?php echo $product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
         <a href="products.php?delete=<?php echo $product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
       </td>
       <td><?php echo $product['title'];?></td>
       <td><?php echo money($product['price']);?></td>
       <td><?php echo $category;?></td>
       <td><a href="products.php?featured=<?php echo(($product['featured'] == 0)?'1':'0')?>&id=<?php echo $product['id'];?>" class="btn btn-xs btn-default">
         <span class="glyphicon glyphicon-<?php echo(($product['featured']==1)?'minus':'plus');?>"></span>
       </a>&nbsp <?php echo(($product['featured'] == 1)?'已推荐':'');?></td>
       <td>0</td>
     </tr>
   <?php endwhile; ?>
   </tbody>
 </table>

<?php } include 'includes/footer.php'; ?>
<script>
  jQuery('document').ready(function(){
    get_child_options('<?php echo $category;?>');
  });
</script>
