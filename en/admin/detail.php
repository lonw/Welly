<?php
require_once '../core/init.php';
include('check-login.php');
include 'includes/head.php';
include 'includes/navigation.php';
if (isset($_GET['view'])) {

  $view_id = sanitize($_GET['view']);
  mysql_query("SELECT * FROM loan WHERE id = '$view_id'");
}
$showUser = mysql_query("SELECT * FROM loan WHERE id = '$view_id'");
?>
<!-- Users Home -->

      <!-- Form Start-->
 <button class="btn btn-success pull-right" onclick="javascript:window.print()">Print</button> <h1>伟力集团 - 贷款申请表</h1>
   <form class="form-horizontal" action="application.php?add=true" method="post" accept-charset="utf-8" enctype="multipart/form-data">
   <fieldset>
   <?php while($approval = mysql_fetch_assoc($showUser)): ?>
   <!-- Form Name -->
   <legend class="bg-success">基本信息 Basic Information</legend>
   <span>( 如果现在地址居住不满三年，请填写前地址信息 Please fill in previous address if curerent < 3 year )</span>
   <!-- Multiple Checkboxes (inline) -->
   <div class="form-group">
     <label class="col-md-4 control-label" for="checkboxes">贷款类型 Type of Mortgage :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['type'];?></label>
     </div>
   </div>
   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="name">姓名 Name  :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['name'];?></label>
     </div>
   </div>

   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="textinput">社会保险卡 SIN # :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['sin'];?></label>   </div>
   </div>

   <!-- Multiple Radios (inline) -->
   <div class="form-group">
     <label class="col-md-4 control-label" for="radios">性别 Gender :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['gender']==1?'男':'女';?></label>
     </div>
   </div>

   <!-- Multiple Checkboxes (inline) -->
   <div class="form-group">
     <label class="col-md-4 control-label" for="checkboxes">婚姻状况 Marital Status :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['ms']==1?'已婚':'';?><?php echo $approval['ms']==2?'单身':'';?><?php echo $approval['ms']==3?'同居':'';?></label>
     </div>
   </div>

   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="bd">生日 Birth Date :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['bd'];?></label> </div>
   </div>

   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="phone">电话 Phone # :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['phone'];?></label> </div>
   </div>

   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="email">电邮地址 Email :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['email'];?></label></div>
   </div>

   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="address">地址 Address :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['address'];?></label> </div>
   </div>

   <!-- Text input-->
   <div class="form-group" id="basicfield">
     <label class="col-md-4 control-label" for="paddress">前地址 Previous Address :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['paddress'];?></label></div>
   </div>
   <br>
   <!-- Form Name -->
   <legend class="bg-success">工作信息 Basic Information</legend>
   <span>( 如果工作不满三年，请填写前工作信息 Please fill in previous employment information if curerent < 3 year )</span>
   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="cemployer">工作单位 Current Employer:</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['cemployer'];?></label></div>
   </div>

   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="jobtitle">职位 Job Title :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['jobtitle'];?></label></div>
   </div>
   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="jobtime">在职时间 Time at job :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['jobtime'];?></label></div>
   </div>

   <!-- Text input-->
   <div class="form-group" id="jobfield1">
     <label class="col-md-4 control-label" for="pemployer">前工作单位 Previous Employer :</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['pemployer'];?></label></div>
   </div>

   <!-- Text input-->
   <div class="form-group" id="jobfield2">
     <label class="col-md-4 control-label" for="pjobtitle">前职位 Previous Job Title ：</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['pjobtitle'];?></label></div>
   </div>
   <!-- Text input-->
   <div class="form-group" id="jobfield3">
     <label class="col-md-4 control-label" for="pjobtime">前在职时间 Previous Time at job ：</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['pjobtime'];?></label></div>
   </div>
   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="aincome">每年收入 Annual Income:</label>
     <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['aincome'];?></label></div>
   </div>

   <br>
   <legend class="bg-success">房屋信息 Subject Property</legend>
   <div class="col-md-12">
      <div class="col-md-6">
   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="propertyaddress">房屋地址 Property Address :</label>
     <div class="col-md-8">
       <label class="col-md-8 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['propertyaddress'];?></label></div>
   </div>

   <div class="form-group">
      <label class="col-md-4 control-label" for="houseprice">成交价 House Price :</label>
      <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['houseprice'];?></label></div>
      </div>
    <div class="form-group">
       <label class="col-md-4 control-label" for="martgage">贷款数额 Martgage Amount :</label>
       <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['martgage'];?></label></div>
     </div>
       </div><div class="col-md-6">
     <div class="form-group">
        <label class="col-md-4 control-label" for="closingdate">交接日期Closing Date:</label>
        <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['closingdate'];?></label></div>
      </div>


   <div class="form-group">
      <label class="col-md-4 control-label" for="cash">现金 Cash :</label>
      <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['cash'];?></label></div>
    </div>

    <div class="form-group">
       <label class="col-md-4 control-label" for="bank">持分银行 Bank :</label>
       <div class="col-md-6">
       <label class="col-md-6 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['bank'];?></label></div>
     </div>

     <div class="form-group">
        <label class="col-md-4 control-label" for="otherassets">其他资产Other Assets:</label>
        <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['otherassets'];?></label></div>
      </div>

   </div>
   <br>
      <legend class="bg-success">现有物业 Properties</legend>
      <div class="col-md-12">
         <div class="col-md-6">
      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label" for="holdaddress">地址 Address :</label>
        <div class="col-md-8">
       <label class="col-md-8 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['holdaddress'];?></label></div>
      </div>
     <div class="form-group">
        <label class="col-md-4 control-label" for="cvalue">物业现价 Current Value :</label>
        <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['cvalue'];?></label></div>
      </div>
      <div class="form-group">
         <label class="col-md-4 control-label" for="pdate">购置时间 Purchase Date :</label>
         <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['pdate'];?></label></div>
       </div>
       <div class="form-group">
          <label class="col-md-4 control-label" for="apropertytax">年地税Annual Property Tax:</label>
          <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['apropertytax'];?></label></div>
        </div>
        <div class="form-group">
           <label class="col-md-4 control-label" for="oriprice">物业原价 Original Price :</label>
           <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['oriprice'];?></label></div>
         </div>
        <div class="form-group">
           <label class="col-md-4 control-label" for="ancondofees">年物业费 Annual Condo Fees :</label>
           <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['ancondofees'];?></label></div>
         </div>
       </div>
         <div class="col-md-6">
           <div class="form-group">
                 <label class="col-md-4 control-label" for="mortgagebal">贷款余款 Mortgage Balance :</label>
                 <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['mortgagebal'];?></label></div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
                 <label class="col-md-4 control-label" for="maturitydate">到期日Maturity Date :</label>
                 <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['maturitydate'];?></label></div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
                 <label class="col-md-4 control-label" for="monthlypayment">月还款 Monthly Payment :</label>
                 <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['monthlypayment'];?></label></div>
           </div>
         </div>
         <div class="col-md-6">
           <div class="form-group">
                 <label class="col-md-4 control-label" for="rate">当前利率 Rate :</label>
                 <div class="col-md-4">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['rate'];?></label></div>
           </div>
         </div>
         <div class="col-md-6">
           <!-- Multiple Checkboxes (inline) -->
           <div class="form-group">
             <label class="col-md-4 control-label" for="checkboxes">利率类型 Rate Type :</label>
             <div class="col-md-5">
       <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['ratetype'];?></label>

             </div>
           </div>
         </div>
         <div class="col-md-6">

           <!-- Multiple Checkboxes (inline) -->
           <div class="form-group">
             <label class="col-md-4 control-label" for="checkboxes">期限类型Term Type :</label>
             <div class="col-md-4">
                      <label class="col-md-4 control-label" for="checkboxes" style="text-decoration: underline;"><?php echo $approval['termtype'];?></label></div>
           </div>
         </div>


   </div>
   <!-- Button -->
   <div class="form-group" align="center">
     <div class="col-md-12"><button class="btn btn-success pull-right" onclick="javascript:window.print()">Print</button>
       <a href="javascript:history.go(-1)" class="btn btn-success">Back</a>
     </div>
   </div>
     <?php  endwhile; ?>
   </fieldset>
   </form>
      <!-- Form End-->


<?php  include 'includes/footer.php'; ?>
