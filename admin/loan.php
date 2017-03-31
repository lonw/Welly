<?php
require_once '../core/init.php';
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';
if (isset($_GET['delete'])) {
  $delete_id = sanitize($_GET['delete']);
  mysql_query("DELETE FROM loan WHERE id = '$delete_id'");
  header('Location: loan.php');
}
if (isset($_GET['approval'])) {
  $id = (int)$_GET['id'];
  $approval = (int)$_GET['approval'];
  $approvalSql = "UPDATE loan SET approval = '$approval' WHERE id = '$id'";
  $db->query($approvalSql);
  header('Location: loan.php');
}
$showUser = mysql_query("SELECT * FROM loan ORDER BY id");
?>
<!-- Users Home -->
<h2 class="text-center">贷款管理</h2>

<hr>

<table class="table table-bordered table-striped table-condensed">
  <thead>
    <th></th><th>申请编号</th><th>贷款类型</th><th>申请人姓名</th><th>电邮地址</th><th>电话</th><th>审批结果</th>
  </thead>
  <tbody>
    <?php while($approval = mysql_fetch_assoc($showUser)): ?>
      <tr>
      <td>
        <a href="detail.php?view=<?php echo $approval['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-search">查看详细</span></a>

        <a href="loan.php?delete=<?php echo $approval['id'];?>" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove">删除申请</span></a>
      </td>
      <td><?php echo $approval['id'];?></td>
      <td><?php echo $approval['type'];?></td>
      <td><?php echo $approval['name'];?></td>
      <td><?php echo $approval['email'];?></td>
      <td><?php echo $approval['phone'];?></td>
      <td><a href="loan.php?approval=<?php echo(($approval['approval'] == 0)?'1':'0')?>&id=<?php echo $approval['id'];?>" class="btn btn-xs btn-default">
        <span class="glyphicon glyphicon-<?php echo(($approval['approval']==1)?'thumbs-up':'thumbs-down');?>"></span>
        <?php echo(($approval['approval']==0)?'等待审批':'已通过');?></td>
    </tr>
    <?php  endwhile; ?>
  </tbody>
</table>
<?php  include 'includes/footer.php'; ?>
