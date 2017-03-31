<?php

$pquery = mysql_query("SELECT * FROM categories WHERE parent = 0");
ob_start();
?>

<!-- Naviagation Start -->
<div class="top-header" style="background-color: #ff9000;";>
  <div class="container">
    <div class="row">

  <div id="topheader" class="pull-left">
    <a href="#" class="btn btn-lg" style="color: #02414a;">
          <span class="fa fa-map-marker" aria-hidden="true"></span>
          &nbsp;7270 Woodbine Ave, Suite 203 Markham
        </a><a href="#" class="btn btn-lg" style="color: #02414a;"><span class="fa fa-phone" aria-hidden="true"></span>&nbsp; 950-405-93039</a>
  </div>

  <div id="topheader" class="pull-right">
  <a class="btn btn-social-icon btn-lg btn-twitter" style="color: #02414a;"><span class="fa fa-twitter"></span></a>
  <a class="btn btn-social-icon btn-lg btn-linkedin" style="color: #02414a;"><span class="fa fa-linkedin"></span></a>
  <a class="btn btn-social-icon btn-lg btn-facebook" style="color: #02414a;"><span class="fa fa-facebook"></span></a>
  <a class="btn btn-social-icon btn-lg btn-flickr" style="color: #02414a;"><span class="fa fa-flickr"></span></a>
  &nbsp;&nbsp;&nbsp;<a href="en/home.php" style="color: #02414a;"><img src="images/bg/en.png" alt="" /> EN</a>
</div>
</div>

</div>
</div>
<nav>


<!-- Top Header's Bar End-->
<div class="header-wrap">
<div class="header">
<div class="logo_text">
<img src="images/logo.png" id="logo" style="padding-left: 15px;height: 60px;margin-bottom: 3px;margin-top: -6px;">
<b id="responsivelogotext"  style="color:white;">伟力集团</b>
<ul class="menu pull-right" style="padding-top: 25px;">

<li class="dropdown li logo">
    <i class=" dropdown-toggle" data-toggle="dropdown"><span class="hidden-lg">选项<b class="caret"></b></span></i>
    <!-- Small Menu -->
  <ul class="dropdown-menu menu" style="margin-top: 0px;opacity: 1;left: -10px;">
    <li class="li  "><a href="home.php" class="no-u" ><u>集团简介</u></a></li>
<?php while($parent = mysql_fetch_assoc($pquery)) :?>
      <li class="li  "><a href="category.php?cat=<?php echo $parent['id'];?>" class="no-u"><u><?php echo $parent['category'];?></u></a></li>
  <?php endwhile; ?>
    <li class="li  "><a href="aboutus.php" class="no-u"><u>关于我们</u></a></li>
    <li class="li  "><a href="contact.php" class="no-u"><u>联系我们</u></a></li>
  </ul>
  <!-- Small Menu -->
</li>
<li class="dropdown li visited">
<a href="home.php" class="dropdown-toggle no-u"><u>集团简介</u><b class="caret"></b></a>
          <ul class="dropdown-menu menu">
            <li class="li visited"><a href="home.php#news" class="no-u"><u>集团新闻</u></a></li>
          </ul>
</li>
<?php
$pquery = mysql_query("SELECT * FROM categories WHERE parent = 0");
?>
  <?php while($parent = mysql_fetch_assoc($pquery)) :?>
    <?php
    $parent_id = $parent['id'];

    $cquery = mysql_query("SELECT * FROM categories WHERE parent = '$parent_id'");
    ?>
<li class="dropdown li visited">
<a href="category.php?cat=<?php echo $parent['id'];?>" class="dropdown-toggle no-u"><u><?php echo $parent['category'];?></u><b class="caret"></b></a>
<ul class="dropdown-menu menu" >
  <?php while ($child = mysql_fetch_assoc($cquery)) : ?>
  <li class="li visited"><a href="category.php?cat=<?php echo $child['id'];?>" class="no-u"><u><?php echo $child['category']; ?></u></a></li>
  <?php endwhile; ?>
</ul>
</li>
 <?php endwhile; ?>

<li class="dropdown li visited">
  <a href="aboutus.php" class="dropdown-toggle no-u"><u>关于我们 </u><b class="caret"></b></a>
          <ul class="dropdown-menu menu">
            <li class="li visited"><a href="profile.php" class="no-u"><u>公司简介</u></a></li>
            <li class="li visited"><a href="history.php" class="no-u"><u>发展历程</u></a></li>
            <li class="li visited"><a href="members.php" class="no-u"><u>核心团队</u></a></li>
            <li class="li visited"><a href="moment.php" class="no-u"><u>精彩瞬间</u></a></li>
          </ul>
</li>
<li class="dropdown li visited ">
<a href="contact.php" class="dropdown-toggle no-u"><u>联系我们</u><b class="caret"></b></a>
<ul class="dropdown-menu menu">
  <li class="li visited"><a href="contact.php?hire=1" class="no-u"><u>伟力招聘</u></a></li>

</ul>
</li>

</ul>
  <p style="font-size:12px;color:white;margin-left: 23px;letter-spacing: 2.5px;">
    WELLY INTERNATIONAL MEDIA LTD
  </p>

</div>
</div>
</div>
</nav>
<!-- Naviagation Start -->
