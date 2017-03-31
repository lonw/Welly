<?php
session_start();

if (!empty($_SESSION['username'])) {
    header('location:dashboard.php');
}
?>

<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <meta charset="utf-8">
        <title> WELLY 后台登录 </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet" href="css/supersized.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body oncontextmenu="return false">

      <?php
      // This php code we use to display an error message
      if (!empty($_GET['error'])) {
        if ($_GET['error'] == 1) {
          echo '<h3 align="center">Username and Password can not be empty!</h3>';
        } else if ($_GET['error'] == 2) {
          echo '<h3 align="center">Username can not be empty!</h3>';
        } else if ($_GET['error'] == 3) {
          echo '<h3 align="center">Password can not be empty!</h3>';
        } else if ($_GET['error'] == 4) {
          echo '<h3 align="center">Username and Password are not listed!</h3>';
        }
      }
      ?>
        <div class="page-container">
            <h1>WELLY 后台登录</h1>
            <form action="authentication.php" method="post" accept-charset="utf-8">
				<div>
					<input id="username" type="username" name="username" class="username" placeholder="Email Address" autocomplete="off"/>
				</div>
                <div>
					<input id="password" type="password" name="password" class="password" placeholder="Password" oncontextmenu="return false" onpaste="return false" />
                </div>
                <button type="submit">登录 / Sign in</button>
                <a href="../home.php"><button type="button">Back / Return</button></a>
            </form>
            <div class="connect">
                <p>Idea For Investor, Reliable Stability</p>
                <p style="margin-top:20px;">稳健长久</p>
            </div>
        </div>


        <!-- Javascript -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="js/supersized.3.2.7.min.js"></script>
        <script src="js/supersized-init.js"></script>

    </body>

</html>
