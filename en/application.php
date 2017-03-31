<?php
  require_once 'core/init.php';
  include 'includes/header.php';
  include 'includes/navigation.php';
  include 'includes/headerpartial.php';

  if (isset($_GET['add'])) {
  $type= ((isset($_POST['type']) && $_POST['type'] != '')?sanitize($_POST['type']):'');
  $name= ((isset($_POST['name']) && !empty($_POST['name']))?sanitize($_POST['name']):'');
  $sin= ((isset($_POST['sin']) && !empty($_POST['sin']))?sanitize($_POST['sin']):'');
  $gender= ((isset($_POST['gender']) && !empty($_POST['gender']))?sanitize($_POST['gender']):'');
  $ms= ((isset($_POST['ms']) && $_POST['ms'] != '')?sanitize($_POST['ms']):'');
  $bd= ((isset($_POST['bd']) && $_POST['bd'] != '')?sanitize($_POST['bd']):'');
  $phone= ((isset($_POST['phone']) && $_POST['phone'] != '')?sanitize($_POST['phone']):'');
  $email= ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):'');
  $address= ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):'');
  $paddress= ((isset($_POST['paddress']) && $_POST['paddress'] != '')?sanitize($_POST['paddress']):'');
  $cemployer= ((isset($_POST['cemployer']) && $_POST['cemployer'] != '')?sanitize($_POST['cemployer']):'');
  $pemployer= ((isset($_POST['pemployer']) && $_POST['pemployer'] != '')?sanitize($_POST['pemployer']):'');
  $jobtitle= ((isset($_POST['jobtitle']) && $_POST['jobtitle'] != '')?sanitize($_POST['jobtitle']):'');
  $pjobtitle= ((isset($_POST['pjobtitle']) && $_POST['pjobtitle'] != '')?sanitize($_POST['pjobtitle']):'');
  $jobtime= ((isset($_POST['jobtime']) && $_POST['jobtime'] != '')?sanitize($_POST['jobtime']):'');
  $pjobtime= ((isset($_POST['pjobtime']) && $_POST['pjobtime'] != '')?sanitize($_POST['pjobtime']):'');
  $aincome= ((isset($_POST['aincome']) && $_POST['aincome'] != '')?sanitize($_POST['aincome']):'');
  $propertyaddress= ((isset($_POST['propertyaddress']) && $_POST['propertyaddress'] != '')?sanitize($_POST['propertyaddress']):'');
  $houseprice= ((isset($_POST['houseprice']) && $_POST['houseprice'] != '')?sanitize($_POST['houseprice']):'');
  $martgage= ((isset($_POST['martgage']) && $_POST['martgage'] != '')?sanitize($_POST['martgage']):'');
  $closingdate= ((isset($_POST['closingdate']) && $_POST['closingdate'] != '')?sanitize($_POST['closingdate']):'');
  $cash= ((isset($_POST['cash']) && $_POST['cash'] != '')?sanitize($_POST['cash']):'');
  $bank= ((isset($_POST['bank']) && $_POST['bank'] != '')?sanitize($_POST['bank']):'');
  $otherassets= ((isset($_POST['otherassets']) && $_POST['otherassets'] != '')?sanitize($_POST['otherassets']):'');
  $holdaddress= ((isset($_POST['holdaddress']) && $_POST['holdaddress'] != '')?sanitize($_POST['holdaddress']):'');
  $cvalue= ((isset($_POST['cvalue']) && $_POST['cvalue'] != '')?sanitize($_POST['cvalue']):'');
  $pdate= ((isset($_POST['pdate']) && $_POST['pdate'] != '')?sanitize($_POST['pdate']):'');
  $apropertytax= ((isset($_POST['apropertytax']) && $_POST['apropertytax'] != '')?sanitize($_POST['apropertytax']):'');
  $oriprice= ((isset($_POST['oriprice']) && $_POST['oriprice'] != '')?sanitize($_POST['oriprice']):'');
  $ancondofees= ((isset($_POST['ancondofees']) && $_POST['ancondofees'] != '')?sanitize($_POST['ancondofees']):'');
  $mortgagebal= ((isset($_POST['mortgagebal']) && $_POST['mortgagebal'] != '')?sanitize($_POST['mortgagebal']):'');
  $maturitydate= ((isset($_POST['maturitydate']) && $_POST['maturitydate'] != '')?sanitize($_POST['maturitydate']):'');
  $monthlypayment= ((isset($_POST['monthlypayment']) && $_POST['monthlypayment'] != '')?sanitize($_POST['monthlypayment']):'');
  $rate= ((isset($_POST['rate']) && $_POST['rate'] != '')?sanitize($_POST['rate']):'');
  $ratetype= ((isset($_POST['ratetype']) && $_POST['ratetype'] != '')?sanitize($_POST['ratetype']):'');
  $termtype= ((isset($_POST['termtype']) && $_POST['termtype'] != '')?sanitize($_POST['termtype']):'');
      if ($_POST) {
      // insert into database
      
      mysql_query("INSERT INTO loan(`type`, `name`, `sin`, `gender`, `ms`, `bd`, `phone`, `email`, `address`, `paddress`,`cemployer`, `pemployer`,
      `jobtitle`, `pjobtitle`, `jobtime`, `pjobtime`, `aincome`, `propertyaddress`, `houseprice`, `martgage`,
      `closingdate`, `cash`, `bank`, `otherassets`, `holdaddress`, `cvalue`, `pdate`, `apropertytax`, `oriprice`, `ancondofees`,
      `mortgagebal`, `maturitydate`, `monthlypayment`, `rate`, `ratetype`, `termtype`)
      VALUES ('$type','$name','$sin','$gender','$ms','$bd','$phone','$email','$address','$paddress',
        '$cemployer','$pemployer','$jobtitle','$pjobtitle','$jobtime','$pjobtime','$aincome','$propertyaddress','$houseprice','$martgage',
        '$closingdate','$cash','$bank','$otherassets','$holdaddress','$cvalue','$pdate','$apropertytax','$oriprice','$ancondofees','$mortgagebal',
        '$maturitydate','$monthlypayment','$rate','$ratetype','$termtype')");
      echo'<h4 style="color:green;" align="center">&nbsp;提交成功 - Success</h4>';
      }
}?>
 <div class="container-fuild">
 	<div class="content"><br>
 		<div class="container" style="background-color:white;color:black;">
 			<div class="row">

 <div class="col-md-12">
   <!-- Form Start-->
<h1>伟力集团 - 贷款申请表</h1>
<form class="form-horizontal" action="application.php?add=true" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend class="bg-success">基本信息 Basic Information</legend>
<span>( 如果现在地址居住不满三年，请填写前地址信息 Please fill in previous address if curerent < 3 year )</span>
<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes">贷款类型 Type of Mortgage :</label>
  <div class="col-md-4">
    <select name="type" class="form-control" required>
      <option value="" required>请选择</option>
      <option value="房屋贷款" >房屋贷款</option>
      <option value="土地贷款" >土地贷款</option>
      <option value="私人贷款" >私人贷款</option>
      <option value="商业贷款" >商业贷款</option>
      <option value="建筑贷款" >建筑贷款</option>
      <option value="联合贷款" >联合贷款</option>
    </select>

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">姓名 Name  :</label>
  <div class="col-md-4">
  <input id="name" name="name" type="text" class="form-control input-md" required>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="textinput">社会保险卡 SIN # :</label>
  <div class="col-md-4">
  <input id="sin" name="sin" type="text"  class="form-control input-md" required>

  </div>
</div>

<!-- Multiple Radios (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">性别 Gender :</label>
  <div class="col-md-4">
    <label class="radio-inline" for="gender">
      <input type="radio" name="gender" value="1" required>
      男 Male
    </label>
    <label class="radio-inline" for="gender">
      <input type="radio" name="gender" value="2">
      女 Female
    </label>
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="checkboxes">婚姻状况 Marital Status :</label>
  <div class="col-md-5">
    <label class="radio-inline" for="ms">
      <input type="radio" name="ms" value="1" required>
      已婚 Married
    </label>
    <label class="radio-inline" for="ms">
      <input type="radio" name="ms" value="2">
      单身 Single
    </label>
    <label class="radio-inline" for="ms">
      <input type="radio" name="ms" value="3">
      同居 Common Law
    </label>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="bd">生日 Birth Date :</label>
  <div class="col-md-4">
  <input id="bd" name="bd" type="text" placeholder="年/月/日 YYYY/MM/DD " class="form-control input-md" required>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="phone">电话 Phone # :</label>
  <div class="col-md-4">
  <input id="phone" name="phone" type="text"  class="form-control input-md" required>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">电邮地址 Email :</label>
  <div class="col-md-4">
  <input id="email" name="email" type="email"  class="form-control input-md" required>

  </div>
</div>

<!-- Text input-->
<div class="form-group">

  <label class="col-md-4 control-label" for="address">地址 Address :</label>
  <div class="col-md-4">
  <input id="address" name="address" type="text"  class="form-control input-md" required>
  </div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="add_fields_placeholder">居住满三年Curerent Address< 3 year ?: </label>
<div class="col-md-4"><select name="add_fields_placeholder" id="add_fields_placeholder" class="form-control">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</div>
<!-- Text input-->
<div class="form-group" id="basicfield">
  <label class="col-md-4 control-label" for="paddress">前地址 Previous Address :</label>
  <div class="col-md-4">
  <input id="basic" name="paddress" type="text" class="form-control input-md">

  </div>
</div>
<br>
<!-- Form Name -->
<legend class="bg-success">工作信息 Basic Information</legend>
<span>( 如果工作不满三年，请填写前工作信息 Please fill in previous employment information if curerent < 3 year )</span>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cemployer">工作单位 Current Employer:</label>
  <div class="col-md-4">
  <input id="cemployer" name="cemployer" type="text"  class="form-control input-md" required>

  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="jobtitle">职位 Job Title :</label>
  <div class="col-md-4">
  <input id="jobtitle" name="jobtitle" type="text"  class="form-control input-md" required>

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="jobtime">在职时间 Time at job :</label>
  <div class="col-md-4">
  <input id="jobtime" name="jobtime" type="text" placeholder="年/月/日 YYYY/MM/DD " class="form-control input-md" required>

  </div>
</div>
<div class="form-group">
<label class="col-md-4 control-label" for="add_jobs_placeholder">工作满三年Curerent Job< 3 year ?: </label>
<div class="col-md-4"><select name="add_jobs_placeholder" id="add_jobs_placeholder" class="form-control">
    <option value="Yes">Yes</option>
    <option value="No">No</option>
</select></div>
</div>
<!-- Text input-->
<div class="form-group" id="jobfield1">
  <label class="col-md-4 control-label" for="pemployer">前工作单位 Previous Employer :</label>
  <div class="col-md-4">
  <input id="job1" name="pemployer" type="text"  class="form-control input-md">

  </div>
</div>

<!-- Text input-->
<div class="form-group" id="jobfield2">
  <label class="col-md-4 control-label" for="pjobtitle">前职位 Previous Job Title ：</label>
  <div class="col-md-4">
  <input id="job2" name="pjobtitle" type="text"  class="form-control input-md">

  </div>
</div>
<!-- Text input-->
<div class="form-group" id="jobfield3">
  <label class="col-md-4 control-label" for="pjobtime">前在职时间 Time at job ：</label>
  <div class="col-md-4">
  <input id="job3" name="pjobtime" type="text" placeholder="年/月/日 YYYY/MM/DD " class="form-control input-md" >

  </div>
</div>
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="aincome">每年收入 Annual Income:</label>
  <div class="col-md-4">
<input id="aincome" name="aincome" type="text" placeholder="$" class="form-control input-md">
  </div>
</div>

<br>
<legend class="bg-success">房屋信息 Subject Property</legend>

   <div class="col-md-6">
<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="propertyaddress">房屋地址 Property Address :</label>
  <div class="col-md-4">
  <input id="propertyaddress" name="propertyaddress" type="text"  class="form-control input-md" required>
  </div>
</div>

<div class="form-group">
   <label class="col-md-4 control-label" for="houseprice">成交价 House Price :</label>
   <div class="col-md-4">
<input id="houseprice" name="houseprice" type="text" placeholder="$" class="form-control input-md" required>
   </div>
   </div>
 <div class="form-group">
    <label class="col-md-4 control-label" for="martgage">贷款数额 Martgage Amount :</label>
    <div class="col-md-4">
 <input id="martgage" name="martgage" type="text" placeholder="$" class="form-control input-md" required>
    </div>
  </div>
    </div><div class="col-md-6">
  <div class="form-group">
     <label class="col-md-4 control-label" for="closingdate">交接日期Closing Date:</label>
     <div class="col-md-4">
  <input id="closingdate" name="closingdate" type="text" placeholder="年/月/日 YYYY/MM/DD " class="form-control input-md" required>
     </div>
   </div>


<div class="form-group">
   <label class="col-md-4 control-label" for="cash">现金 Cash :</label>
   <div class="col-md-4">
<input id="cash" name="cash" type="text" placeholder="$" class="form-control input-md" required>
   </div>
 </div>

 <div class="form-group">
    <label class="col-md-4 control-label" for="bank">持分银行 Bank :</label>
    <div class="col-md-4">
 <input id="bank" name="bank" type="text"  class="form-control input-md" required>
    </div>
  </div>

  <div class="form-group">
     <label class="col-md-4 control-label" for="otherassets">其他资产Other Assets:</label>
     <div class="col-md-4">
  <input id="otherassets" name="otherassets" type="text" placeholder="$" class="form-control input-md" required>
     </div>
   </div>

</div>
<br>
   <legend class="bg-success">现有物业 Properties</legend>
   <div class="col-md-12">
      <div class="col-md-6">
   <!-- Text input-->
   <div class="form-group">
     <label class="col-md-4 control-label" for="holdaddress">地址 Address :</label>
     <div class="col-md-4">
     <input id="holdaddress" name="holdaddress" type="text"  class="form-control input-md" required>
     </div>
   </div>
  <div class="form-group">
     <label class="col-md-4 control-label" for="cvalue">物业现价 Current Value :</label>
     <div class="col-md-4">
  <input id="cvalue" name="cvalue" type="text" placeholder="$" class="form-control input-md" required>
     </div>
   </div>
   <div class="form-group">
      <label class="col-md-4 control-label" for="pdate">购置时间 Purchase Date :</label>
      <div class="col-md-4">
   <input id="pdate" name="pdate" type="text" placeholder="年/月/日 YYYY/MM/DD " class="form-control input-md" required>
      </div>
    </div>
    <div class="form-group">
       <label class="col-md-4 control-label" for="apropertytax">年地税 Annual Property Tax :</label>
       <div class="col-md-4">
    <input id="apropertytax" name="apropertytax" type="text" placeholder="$" class="form-control input-md" required>
       </div>
     </div>
     <div class="form-group">
        <label class="col-md-4 control-label" for="oriprice">物业原价 Original Price :</label>
        <div class="col-md-4">
     <input id="oriprice" name="oriprice" type="text" placeholder="$" class="form-control input-md" required>
        </div>
      </div>
     <div class="form-group">
        <label class="col-md-4 control-label" for="ancondofees">年物业费 Annual Condo Fees :</label>
        <div class="col-md-4">
     <input id="ancondofees" name="ancondofees" type="text" placeholder="$" class="form-control input-md" required>
        </div>
      </div>
    </div>
      <div class="col-md-6">
        <div class="form-group">
              <label class="col-md-4 control-label" for="mortgagebal">贷款余款 Mortgage Balance :</label>
              <div class="col-md-4">
           <input id="mortgagebal" name="mortgagebal" type="text" placeholder="$" class="form-control input-md" required>
              </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
              <label class="col-md-4 control-label" for="maturitydate">到期日Maturity Date :</label>
              <div class="col-md-4">
           <input id="maturitydate" name="maturitydate" type="text" placeholder="年/月/日 YYYY/MM/DD " class="form-control input-md" required>
              </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
              <label class="col-md-4 control-label" for="monthlypayment">月还款 Monthly Payment :</label>
              <div class="col-md-4">
           <input id="monthlypayment" name="monthlypayment" type="text" placeholder="$" class="form-control input-md" required>
              </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
              <label class="col-md-4 control-label" for="rate">当前利率 Rate :</label>
              <div class="col-md-4">
           <input id="rate" name="rate" type="text"  class="form-control input-md" required>
              </div>
        </div>
      </div>
      <div class="col-md-6">
        <!-- Multiple Checkboxes (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="checkboxes">利率类型 Rate Type :</label>
          <div class="col-md-5">
            <label class="radio-inline" for="checkboxes-0">
              <input type="radio" name="ratetype" value="1" required>
              Fixed
            </label>
            <label class="radio-inline" for="checkboxes-1">
              <input type="radio" name="ratetype" value="2">
              Variable
            </label>

          </div>
        </div>
      </div>
      <div class="col-md-6">

        <!-- Multiple Checkboxes (inline) -->
        <div class="form-group">
          <label class="col-md-4 control-label" for="checkboxes">期限类型Term Type :</label>
          <div class="col-md-4">
            <select name="termtype" class="form-control" required>
              <option value="">请选择</option>
              <option value="Closed">Closed</option>
              <option value="Open">Open</option>
              <option value="">Convertible</option>
            </select>

          </div>
        </div>
      </div>


</div>
<p><input type="checkbox"  name="terms" required> I accept the <u>Terms and Conditions</u></p>

<!-- Button -->
<div class="form-group" align="center">
  <label class="col-md-12 control-label" for="singlebutton"></label>
  <div class="col-md-12">
    <a href="javascript:history.go(-1)" class="btn btn-warning">Back</a>
    <button type="submit" name="add" class="btn btn-warning">提交申请</button>
    <button type="reset" class="btn btn-warning">清空表格</button>

  </div>
</div>
</fieldset>
</form>
   <!-- Form End-->

</div>
</div>
</div>



</div><!-- content End -->

<?php
  include 'includes/footer.php';
 ?>
