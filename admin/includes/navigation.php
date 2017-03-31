<!-- Top Nav Bar -->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> 伟力集团</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php">控制中心</a></li>
        <!-- Menu item -->
        <li><a href="categories.php">方案导航</a></li>
        <li><a href="loan.php">贷款申请</a></li>
        <!-- <li><a href="products.php">服务产品</a></li> -->
        <li><a href="page.php">页面管理</a></li>
        <?php if (has_permission('admin')): ?>
        <li><a href="users.php">管理员</a></li>
        <?php endif; ?>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Hello <?php echo $user_data['fname'];?>!
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu" role="menu">
            <li><a href="change_password.php">修改密码</a></li>
        </ul>
        </li>
        </ul>
      </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> 登出</a></li>
          </ul>
  </div>
</div>
</nav>
