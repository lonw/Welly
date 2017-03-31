<?php
   require_once 'core/init.php';
   include 'includes/header.php';
   include 'includes/navigation.php';
   include 'includes/headerpartial5.php';
   if (isset($_GET['hire'])) {
     $string= '<h2 style="color:grey;">&nbsp;招聘职位 - Job Center</h2><br>';

     $leftside = ' <h3 id="hireme" class="bg-success">招聘职位 - JOB CENTER</h3>
                   <ul style="padding-left: 0px;">
                     <li>Office Assistant </li>
                     <li>IT Technician </li>
                     <li>暂无</li>
                   </ul>';
   }else {
     $string= '<h2 style="color:grey;">&nbsp;联系我们 - CONTACTS</h2><br>';

      $leftside = ' <h3 class="bg-success">联系资料 - CONTACT INFO</h3>
                    <h4 style="text-decoration: underline;">加拿大多伦多 伟力集团总部</h4>
                      <h6>7270 Woodbine Ave, Suite 203 <br>Markham, ON Canada, L3R 4B9</h6>
                     Phone#: +1 905-604-5622
                     <br>INFO@WELEMEDIA.COM<br>
                     <a href="https://www.google.ca/maps/place/7270+Woodbine+Ave+%23203,+Markham,+ON+L3R+4B9/@43.8204651,-79.3534693,17z/data=!3m1!4b1!4m5!3m4!1s0x89d4d36416317847:0xad01951a54be0526!8m2!3d43.8204613!4d-79.3512806"
                     target="_blank" class="btn btn-success btn-xs">
                       详细地址
                     </a>
                   <br>';
   }

   if (isset($_GET['add'])) {
   $email= ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):'');
   $name= ((isset($_POST['name']) && $_POST['name'] != '')?sanitize($_POST['name']):'');
   $phone= ((isset($_POST['phone']) && !empty($_POST['phone']))?sanitize($_POST['phone']):'');
   $content= ((isset($_POST['content']) && !empty($_POST['content']))?sanitize($_POST['content']):'');
   $attachment= ((isset($_POST['attachment']) && $_POST['attachment'] != '')?sanitize($_POST['attachment']):'');
   $dbpath = '';
   $target_dir = "uploads/";
   $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
   $uploadOk = 1;
   $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
   $check = getimagesize($_FILES["attachment"]["tmp_name"]);
   if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
      // Check if file already exists
   if (file_exists($target_file)) {
       echo "Sorry, file already exists.";
       $uploadOk = 0;
   }
   // Check file size
   if ($_FILES["attachment"]["size"] > 500000) {
       echo "Sorry, your file is too large.";
       $uploadOk = 0;
   }
   // Allow certain file formats
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc" && $imageFileType != "docx" ) {
       echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
       $uploadOk = 0;
   }
   // Check if $uploadOk is set to 0 by an error
   if ($uploadOk == 0) {
       echo "Sorry, your file was not uploaded.";
   // if everything is ok, try to upload file
   } else {
       if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
           echo "The file ". basename( $_FILES["attachment"]["name"]). " has been uploaded.";

       } else {
           echo "Sorry, there was an error uploading your file.";
       }
   }
       if ($_POST) {
       // insert into database
       mysql_query("INSERT INTO feedback(`email`, `name`, `phone`, `content`, `attachment`)
       VALUES ('$email','$name','$phone','$content','$target_file')");
         echo'<h4 class="bg-success" style="color:green;" align="center">&nbsp;提交成功 - Success</h4>';
       }
 }?>

 <div class="container-fuild">
   <div class="content">
     <div class='row wrap'>

       <div class="col-md-12" align="center">
 				<br>
 				<?php echo $string;?>


           <div class="container" align="left" style="background-color:white;color:black;">
             <?php include 'googlemap.php' ?>
            <div class="col-md-4">
              <?php echo $leftside;?>


            </div>
            <div class="col-md-8">

              <form class="form-horizontal" action="contact.php?add=true" method="post" accept-charset="utf-8" enctype="multipart/form-data">

              <!-- Text input-->
              <div class="form-group">
                <label class="control-label" for="name">姓名 Name  :</label>
                <div>
                <input id="name" name="name" type="text" class="form-control input-md" placeholder="Name" required>
                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="control-label" for="phone">电话 Phone # :</label>
                <div>
                <input id="phone" name="phone" type="text"  class="form-control input-md" placeholder="Phone #" required>

                </div>
              </div>

              <!-- Text input-->
              <div class="form-group">
                <label class="control-label" for="email">电邮地址 Email :</label>
                <div>
                <input id="email" name="email" type="email"  class="form-control input-md" placeholder="Email" required>
                </div>
              </div>

             <!-- Text input-->
             <div class="form-group">
               <label class="control-label" for="content">内容 Content :</label>
               <div>
               <textarea id="content" name="content" type="text" class="form-control input-md" rows="5" required></textarea>
               </div>
             </div>

              <div class="form-group">
 						    <label for="attachment">附件 Attachment :</label>
 						    <input type="file" name="attachment" id="attachment">
 						    <p class="help-block">请上传档案到这里.</p>
 						  </div>

              <!-- Button -->
              <div class="form-group">
                <label class="col-md-12 control-label" for="singlebutton"></label>
                <div class="col-md-12">
                  <a href="javascript:history.go(-1)" class="btn btn-success">返回</a>
                  <button type="submit" name="add" class="btn btn-success">提交申请</button>
                  <button type="reset" class="btn btn-success">清空表格</button>

                </div>
              </div>
              </form>
 						<br><br><br>
            </div>
            </div>
     </div>
     </div>
 </div>
 </div>

 <!-- content End -->
 <?php
   include 'includes/footer.php';
  ?>
