<?php
  require_once 'core/init.php';
    if(isset($_GET['cat'])){
      $cat_id = sanitize($_GET['cat']);
    }else {
      $cat_id = '';
    }
  
    $getProduct = mysql_query("SELECT * FROM products WHERE categories = '$cat_id'");
    $category = get_category($cat_id);
  include 'includes/header.php';
  include 'includes/navigation.php';
  if ($cat_id==2) {
    header('Location: home.php');
  }
    $filename = 'includes/headerpartial'.$cat_id.'.php';
    if(!file_exists($filename)){
      echo "<h2></h2>";
    }else{
      include 'includes/headerpartial'.$cat_id.'.php';
    }

 ?>

<div class="container-fuild">
	<div class="content"><br>
		<div class="container" style="background-color:white;color:black;">
			<div class="row">

				<br><h3 style="color:grey;"> &nbsp;<a href="home.php" style="color:black;">
          首页</a>  <?php echo $category['child'];?></h3><hr>
<!-- Included the different content -->

<?php
$filename = 'includes/sub_content/content'.$cat_id.'.php';
if(!file_exists($filename)){
  echo "<center><h2>建设中</h2><center>";
}else{
  include 'includes/sub_content/content'.$cat_id.'.php';
}
  ;?>
<!-- Included the different content  End-->
    <div>
      &nbsp;
    </div>

  <p>
    <a href="javascript:history.go(-1)" class="btn btn-warning btn-lg pull-right">
      返回
    </a>
    <!-- <a href="application.php" class="btn btn-warning btn-lg pull-right">
      网上申请贷款
    </a> -->
  </p>
  	<br><br>
		</div>
		</div>
	</div>
</div>



<!-- content End -->
<?php
  include 'includes/footer.php';
 ?>
