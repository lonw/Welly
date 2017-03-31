<?php
  require_once '../core/init.php';
  include('check-login.php');
  include 'includes/head.php';
  include 'includes/navigation.php';
  //get brands from database
?>

<br><br><br><br><br><br>

<form id="signInForm" class="form-horizontal"
    data-fv-framework="bootstrap"
    data-fv-icon-valid="glyphicon glyphicon-ok"
    data-fv-icon-invalid="glyphicon glyphicon-remove"
    data-fv-icon-validating="glyphicon glyphicon-refresh">

    <div class="form-group">
        <label class="col-xs-3 control-label">Username</label>
        <div class="col-xs-5">
            <input type="text" class="form-control" name="username"
                required
                data-fv-notempty-message="The username is required" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-xs-3 control-label">Password</label>
        <div class="col-xs-5">
            <input type="password" class="form-control" name="password"
                required
                data-fv-notempty-message="The password is required" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-6 col-xs-offset-3">
            <button type="submit" class="btn btn-default">Sign in</button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#signInForm').formValidation();
});
</script>
<?php include 'includes/footer.php'; ?>
