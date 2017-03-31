<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/init.php';
include 'includes/head.php';
include 'includes/navigation.php';


$presults = mysql_query("SELECT * FROM products WHERE deleted = 1");
if (isset($_GET['reuse'])) {
  $id = sanitize($_GET['reuse']);
  mysql_query("UPDATE products SET deleted = 0 WHERE id = '$id'");
  $_SESSION['success_flash'] = 'User has been added!';
  header('Location: products.php');
}
 ?>
 <h2 class="text-center">产品回收桶</h2>

<div class="clearfix"></div>
<br>
<br>
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
         <a href="archived.php?reuse=<?php echo $product['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-ok"></span></a>
       </td>
       <td><?php echo $product['title'];?></td>
       <td><?php echomoney($product['price']);?></td>
       <td><?php echo $category;?></td>
       <td><?php echo(($product['featured'] == 1)?'Featured Product':'No');?></td>
       <td>0</td>
     </tr>
   <?php endwhile; ?>
   </tbody>
 </table>

<?php  include 'includes/footer.php'; ?>
