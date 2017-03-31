<?php
include('../inc/config.php');
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';
$query = mysql_query("SELECT * FROM pageabout where lang = 1");

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
