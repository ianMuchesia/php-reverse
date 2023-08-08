<?php include('header.php'); ?>
<?php

$CountryId = 0;

include_once('controller/connect.php');
$dbs = new database();
$db = $dbs->connection();


$countryn = mysqli_query($db, "select * from country  ORDER BY Name");
$gendern = mysqli_query($db, "select * from gender  ORDER BY Name");
$rolen = mysqli_query($db, "select * from role  ORDER BY Name");
$statusn = mysqli_query($db, "select * from status  ORDER BY Name");
$maritaln = mysqli_query($db, "select * from maritalstatus  ORDER BY Name");
$owners = mysqli_query($db, "select * from owners  ORDER BY Name");
$vehicle = mysqli_query($db, "select * from vehicletype  ORDER BY vehicletype_name");
$county = mysqli_query($db, "select * from counties  ORDER BY Name");
$area = mysqli_query($db, "select * from areas  ORDER BY Name");

$result = "";
$id = "";
if (isset($_GET['msg'])) {
  $result = $_GET['msg'];
} else if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else if (isset($_GET['empid'])) {
  $empid = $_GET['empid'];
  $editempid = mysqli_query($db, "SELECT e.*,ss.StateId,cc.CountryId FROM employee e join city c on e.CityId=c.CityId join state ss on c.StateId=ss.StateId join country cc on cc.CountryId=ss.CountryId where EmpId='$empid'");
  $editemp = mysqli_fetch_assoc($editempid);
  $CountryId = $editemp["CountryId"];
  $StateId = $editemp['StateId'];
  $CityId = $editemp['CityId'];
}
?>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
  <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Client<i class="fa fa-angle-right"></i> Client Add</li>
</ol>
<!--grid-->
<div class="validation-system" style="margin-top: 0;">

  <div class="validation-form">
    <!---->
    <form method="POST" action="controller/employee.php?empedit=<?php echo isset($_GET['empid']) ? $_GET['empid'] : ''; ?>" enctype="multipart/form-data">
      <?php
      if ($result) {
        echo '<h4 style="color: #FF0000;">' . $result . '</h4>';
      } else {
        echo '<h4 style="color: #008000;">' . $id . '</h4>';
      }
      ?>
      <div class="vali-form-group">
        <p style="font-weight: bold; color:blue;">Personal information</p>
        <div class="col-md-4 control-label">
          <label class="control-label">Driver's ID*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" name="empid" title="Employee ID" value="<?php echo (isset($editemp["EmployeeId"])) ? $editemp["EmployeeId"] : ""; ?>" class="form-control" placeholder="client ID" required="">
          </div>
        </div>


        <div class="col-md-4 control-label">
          <label class="control-label">Driver's picture*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-picture-o" aria-hidden="true"></i>
            </span>
            <input type="file" name="pfimg" title="Profile Image" class="form-control" name="fileupload">
          </div>
        </div>

        <div class="col-md-4 control-label">
          <label class="control-label">Gender*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-male" aria-hidden="true"></i>
            </span>
            <select name="gender" title="Gender" required="" style="padding: 5px 5px; text-transform: capitalize;"">
                <option value="">-- Select Gender --</option>
                <?php while ($rw = mysqli_fetch_assoc($gendern)) { ?> 
                <option value=" <?php echo $rw["GenderId"]; ?>" <?php if (isset($editemp["Gender"]) && $editemp["Gender"] == $rw["GenderId"]) {
                                                                  echo "Selected";
                                                                } ?>> <?php echo $rw["Name"]; ?> </option>
            <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="clearfix"> </div>

      <div class="vali-form-group">
        <div class="col-md-4 control-label">
          <label class="control-label">First Name*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" name="fname" title="First Name" value="<?php echo (isset($editemp["FirstName"])) ? $editemp["FirstName"] : ""; ?>" class="form-control" placeholder="First Name" required="">
          </div>
        </div>

        <div class="col-md-4 control-label">
          <label class="control-label">Middle Name*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" name="mname" title="Middel Name" value="<?php echo (isset($editemp["MiddleName"])) ? $editemp["MiddleName"] : ""; ?>" class="form-control" placeholder="Middel Name" required="">
          </div>
        </div>

        <div class="col-md-4 control-label">
          <label class="control-label">Last Name*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" name="lname" title="Last Name" value="<?php echo (isset($editemp["LastName"])) ? $editemp["LastName"] : ""; ?>" class="form-control" placeholder="Last Name" required="">
          </div>
        </div>
        <div class="clearfix"> </div>
      </div>
      <div class="vali-form-group">
        <div class="col-md-4 control-label">
          <label class="control-label">Birth Date*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </span>
            <input type="text" id="Birthdate" title="Birth Date" name="bdate" placeholder="Birth Date" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="<?php echo (isset($editemp["Birthdate"])) ? $editemp["Birthdate"] : ""; ?>" class="form-control" required="">
          </div>
        </div>

        <div class="col-md-4 control-label">
          <label class="control-label">Marital*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <select name="marital" title="Marital" required="" style="text-transform: capitalize;">
              <option value="">-- Select Marital --</option>
              <?php while ($rw = mysqli_fetch_assoc($maritaln)) { ?>
                <option value="<?php echo $rw["MaritalId"]; ?>" <?php if (isset($editemp["MaritalStatus"]) && $editemp["MaritalStatus"] == $rw["MaritalId"]) {
                                                                  echo "Selected";
                                                                } ?>> <?php echo $rw["Name"]; ?> </option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-4 control-label">
          <label class="control-label">Mobile Number*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
            </span>
            <input type="text" name="mnumber" title="Mobile Number" value="<?php echo (isset($editemp["Mobile"])) ? $editemp["Mobile"] : ""; ?>" class="form-control" placeholder="Mobile Number" min="10" maxlength="10" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" required="">
          </div>
        </div>
      </div>

      <div class="clearfix"></div>

      <div class="vali-form-group">
        <div class="col-md-4 control-label">
          <label class="control-label">Next of Kin*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" name="next_of_kin" title="Next of Kin" value="<?php echo (isset($editemp["next_of_kin"])) ? $editemp["next_of_kin"] : ""; ?>" class="form-control" placeholder="Next of Kin" required="">
          </div>
        </div>

        <div class="col-md-8 control-label">
          <label class="control-label">Address*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-home" aria-hidden="true"></i>
            </span>
            <input type="text" name="address1" title="Address 1" value="<?php echo (isset($editemp["Address1"])) ? $editemp["Address1"] : ""; ?>" class="form-control" placeholder="Address Line 1" required="">
          </div>
        </div>
      </div>

      <div class="clearfix"></div>


      <div>
        <p style="font-weight: bold; color: blue;">Vehicle Information</p>
      </div>

      <div class="vali-form-group">
        <div class="col-md-4">
          <label class="control-label">Vehicle type*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <select name="vehicle" title="vehicle" required class="form-control" style="text-transform: capitalize;">
              <option value="">-- Type of vehicle --</option>
              <?php while ($rw = mysqli_fetch_assoc($vehicle)) { ?>
                <option value="<?php echo $rw["vehicletype_id"]; ?>" <?php if (isset($editemp["vehicleType"]) && $editemp["vehicleType"] == $rw["vehicletype_id"]) {
                                                                        echo "selected";
                                                                      } ?>><?php echo $rw["vehicletype_name"]; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <label class="control-label">Vehicle Registration No.*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
            </span>
            <input type="text" name="vehreg" title="Registration No" value="<?php echo (isset($editemp["regno"])) ? $editemp["regno"] : ""; ?>" class="form-control" placeholder="Registration No" required="">
          </div>
        </div>

        <div class="col-md-4">
          <label class="control-label">Vehicle owner*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-language" aria-hidden="true"></i>
            </span>
            <select name="position" title="Position" class="form-control" style="text-transform: capitalize;" required="">
              <option value="">-- Select Owner --</option>
              <?php while ($rw = mysqli_fetch_assoc($owners)) { ?>
                <option value="<?php echo $rw["PositinId"]; ?>" <?php if (isset($editemp["PositionId"]) && $editemp["PositionId"] == $rw["PositinId"]) {
                                                                  echo "selected";
                                                                } ?>><?php echo $rw["Name"]; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="vali-form-group">
        <div class="col-md-4">
          <label class="control-label">Shortcode*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-mobile" aria-hidden="true"></i>
            </span>
            <input type="text" name="shortcode" title="Shortcode" value="<?php echo (isset($editemp["shortcd"])) ? $editemp["shortcd"] : ""; ?>" class="form-control" placeholder="Shortcode" required="">
          </div>
        </div>

        <div class="col-md-3 control-label">
          <label class="control-label">Country*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-globe" aria-hidden="true"></i>
            </span>
            <select name="country" id="countryid" title="Country" required="" style="text-transform: capitalize;">
              <option value="">-- Select Country --</option>
              <?php while ($rw = mysqli_fetch_assoc($countryn)) { ?>
                <option value="<?php echo $rw["CountryId"]; ?>" <?php if (isset($editemp["CountryId"]) && $editemp["CountryId"] == $rw["CountryId"]) {
                                                                  echo "Selected";
                                                                } ?>> <?php echo $rw["Name"]; ?> </option>
              <?php } ?>
            </select>
          </div>
        </div>

        <div class="col-md-3 control-label">
          <label class="control-label">County*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
            </span>
            <select name="state" id="stateid" title="State" required="" style="text-transform: capitalize;">
              <option value="">-- Select County --</option>
              <?php while ($rw = mysqli_fetch_assoc($county)) { ?>
                <option value="<?php echo $rw["StateId"]; ?>" <?php if (isset($editemp["State"]) && $editemp["State"] == $rw["StateId"]) {
                                                                echo "Selected";
                                                              } ?>> <?php echo $rw["Name"]; ?> </option>
              <?php } ?>
            </select>
          </div>

          <div class="col-md-3 control-label">
            <label class="control-label">Area*</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
              </span>
              <select name="city" id="cityid" title="City" style="text-transform: capitalize;">
                <option value="">-- Select Area --</option>
                <?php while ($rw = mysqli_fetch_assoc($area)) { ?>
                  <option value="<?php echo $rw["CityId"]; ?>" <?php if (isset($editemp["city"]) && $editemp["city"] == $rw["CityId"]) {
                                                                  echo "Selected";
                                                                } ?>> <?php echo $rw["Name"]; ?> </option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <div>
          <div>
            <p style="font-weight: bold; color: blue;">Owner Information</p>
          </div>

          <div class="col-md-4 control-label">
            <label class="control-label">Name*</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-user" aria-hidden="true"></i>
              </span>
              <input type="text" name="owner_name" title="Owner Name" value="<?php echo (isset($editemp["owner_name"])) ? $editemp["owner_name"] : ""; ?>" class="form-control" placeholder="Owner Name" required="">
            </div>
          </div>

          <div class="col-md-4 control-label">
            <label class="control-label">ID Number*</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-id-card" aria-hidden="true"></i>
              </span>
              <input type="text" name="id_number" title="ID Number" value="<?php echo (isset($editemp["id_number"])) ? $editemp["id_number"] : ""; ?>" class="form-control" placeholder="ID Number" required="">
            </div>
          </div>

          <div class="col-md-4 control-label">
            <label class="control-label">Tele*</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone" aria-hidden="true"></i>
              </span>
              <input type="text" name="tele" title="Tele" value="<?php echo (isset($editemp["tele"])) ? $editemp["tele"] : ""; ?>" class="form-control" placeholder="Tele" required="">
            </div>
          </div>

          <div class="col-md-4 control-label">
            <label class="control-label">Address*</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-home" aria-hidden="true"></i>
              </span>
              <input type="text" name="address2" title="Address 2" value="<?php echo (isset($editemp["Address2"])) ? $editemp["Address2"] : ""; ?>" class="form-control" placeholder="Address Line 2" required="">
            </div>
          </div>

          <div class="col-md-4 control-label">
            <label class="control-label">Email*</label>
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope" aria-hidden="true"></i>
              </span>
              <input type="email" name="email" title="Email" value="<?php echo (isset($editemp["email"])) ? $editemp["email"] : ""; ?>" class="form-control" placeholder="Email" required="">
            </div>
          </div>

          <div class="clearfix"></div>

        </div>

        <div class="clearfix"> </div>
      </div>

      <div class="vali-form-group">
        <div class="col-md-3 control-label">
          <label class="control-label">Registration Date*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </span>
            <input type="text" id="JoinDate" title="Join Date" name="joindate" placeholder="Join Date" value="<?php echo (isset($editemp["JoinDate"])) ? $editemp["JoinDate"] : ""; ?>" class="form-control" required="" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
          </div>
        </div>

        <div class="col-md-3 control-label">
          <label class="control-label">Leave Date</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-calendar" aria-hidden="true"></i>
            </span>
            <input type="text" id="LeaveDate" title="Leave Date" name="leavedate" placeholder="Leave Date" value="<?php echo (isset($editemp["LeaveDate"])) ? $editemp["LeaveDate"] : ""; ?>" class="form-control" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
          </div>
        </div>

        <div class="col-md-3 control-label">
          <label class="control-label">Status</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
            </span>
            <select name="status" title="Status" required="" style="text-transform: capitalize;">
              <option value="">-- Select Status --</option>
              <?php while ($rw = mysqli_fetch_assoc($statusn)) { ?>
                <option value="<?php echo $rw["StatusId"]; ?>" <?php if (isset($editemp["StatusId"]) && $editemp["StatusId"] == $rw["StatusId"]) {
                                                                  echo "Selected";
                                                                } ?>> <?php echo $rw["Name"]; ?> </option>
              <?php } ?>
            </select>
          </div>
        </div>


        <div class="col-md-3 control-label">
          <label class="control-label">Email*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-envelope" aria-hidden="true"></i>
            </span>
            <input type="email" name="email" title="Email" value="<?php echo (isset($editemp["Email"])) ? $editemp["Email"] : ""; ?>" class="form-control" placeholder="Email Address" required="">
          </div>
        </div>

        <div class="col-md-3 control-label">
          <label class="control-label">Password*</label>
          <div class="input-group">
            <span class="input-group-addon">
              <i class="fa fa-pencil" aria-hidden="true"></i>
            </span>
            <input type="password" id="Psw" title="Password" value="<?php echo (isset($editemp["Password"])) ? $editemp["Password"] : ""; ?>" name="password" placeholder="Password " class="form-control" required="">
            <span class="input-group-addon">
              <a><i class='fa fa-eye' aria-hidden='false' onclick="passwordeyes()"></i></a>
            </span>
          </div>
        </div>

        <div class="clearfix"> </div>
      </div>
      <div class="col-md-12 form-group">
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-default">Reset</button>
        <input type="text" name="imagefilename" hidden="" value="<?php echo (isset($editemp['ImageName'])) ? $editemp['ImageName'] : ''; ?>">
      </div>
      <div class="clearfix"> </div>
    </form>
    <!---->
  </div>
</div>
<script>
  function passwordeyes() {
    var x = document.getElementById("Psw").type;
    if (x == "password")
      document.getElementById("Psw").type = "text";
    else
      document.getElementById("Psw").type = "password";
  }
</script>
<script>
  var OneStepBack;

  function nmac(val, e) {
    if (e.keyCode != 8) {
      if (val.length == 2)
        document.getElementById("mac").value = val + "-";
      if (val.length == 5)
        document.getElementById("mac").value = val + "-";
      if (val.length == 8)
        document.getElementById("mac").value = val + "-";
      if (val.length == 11)
        document.getElementById("mac").value = val + "-";
      if (val.length == 14) {
        document.getElementById("mac").value = val + "-";
      }
    }
  }

  function nmac1(val, e) {
    if (e.keyCode == 32) {
      return false;
    }

    if (e.keyCode != 8) {

      if (val.length == 2)
        document.getElementById("mac").value = val + "-";
      if (val.length == 5)
        document.getElementById("mac").value = val + "-";
      if (val.length == 8)
        document.getElementById("mac").value = val + "-";
      if (val.length == 11)
        document.getElementById("mac").value = val + "-";
      if (val.length == 14) {
        document.getElementById("mac").value = val + "-";
      }

      if (val.length == 17) {
        return false;
      }
    }
  }
</script>


<script>
  var birthdate = $('#Birthdate').val();
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1;
  var yy = today.getFullYear();
  var tdate = yy + "/" + mm + "/" + dd;

  $('#Birthdate').datetimepicker({
    yearOffset: 0,
    lang: 'ch',
    timepicker: false,
    format: 'Y/m/d',
    formatDate: 'Y/m/d',
    //minDate:'-1980/01/01', // yesterday is minimum date
    maxDate: tdate // and tommorow is maximum date calendar
  });

  $('#JoinDate').datetimepicker({
    yearOffset: 0,
    lang: 'ch',
    timepicker: false,
    format: 'Y/m/d',
    formatDate: 'Y/m/d',
    //minDate:'-1980/01/01', // yesterday is minimum date
    //maxDate: tdate // and tommorow is maximum date calendar
  });

  $('#LeaveDate').datetimepicker({
    yearOffset: 0,
    lang: 'ch',
    timepicker: false,
    format: 'Y/m/d',
    formatDate: 'Y/m/d',
    //minDate:'-1980/01/01', // yesterday is minimum date
    //maxDate: tdate // and tommorow is maximum date calendar
  });
</script>
<script>
  document.querySelector('#countryid').addEventListener('change', () => {
    const xhr = new XMLHttpRequest();
    const name = document.querySelector('#countryid').value



    if (!name) {
      return
    }

    xhr.open('GET', 'controller/process.php?countryid=' + name, true);

    xhr.onload = function() {
      if (this.status === 200) {

        const response = JSON.parse(this.responseText)


        output = response.map(item => (
          `<option value="${item['StateId']}">${item["Name"]}</option>`
        )).join("")
        document.querySelector('#stateid').innerHTML = `
      <option value="">--Select County--</option>
      ` + output
      }
    }
    xhr.send()
  })

  document.querySelector('#stateid').addEventListener('change', () => {
    const xhr = new XMLHttpRequest();
    const name = document.querySelector('#stateid').value



    if (!name) {
      return
    }

    xhr.open('GET', 'controller/process.php?countyid=' + name, true);

    xhr.onload = function() {
      if (this.status === 200) {


        const response = JSON.parse(this.responseText)


        output = response.map(item => (
          `<option value="${item['CityId']}">${item["Name"]}</option>`
        )).join("")
        document.querySelector('#cityid').innerHTML = `
      <option value="">--Select Area--</option>
      ` + output
      }
    }
    xhr.send()
  })
</script>
<?php include('footer.php'); ?>