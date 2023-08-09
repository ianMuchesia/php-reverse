<?php
	include_once('connect.php');
	$dbs = new database();
	$db=$dbs->connection();
	session_start();
	if(isset($_POST['submit']))
	{
		$data=$_POST;
		$editid = 0;
		if(isset($_GET['empedit']) && $_GET['empedit'] > 0){ 
			$editid = $_GET['empedit'];
		};
		$empid=$data['empid'];
		$img=$_FILES['pfimg']['name'];
		$gender=$data['gender'];
		$fname=$data['fname'];
		$mname=$data['mname'];
		$lname=$data['lname'];
		
		$mnumber=$data['mnumber'];
		$driver_email=$data['driver_email'];
		$address1=$data['address1'];
		
		
		$city=$data['area'];
		$joindate=$data['joindate'];
	
		
	$shortcode = $data['shortcode'];
		$password=$data['password'];
		$marital=$data['marital'];
		$owner=$data['owner'];
		$imagefilename = $data['imagefilename'];
		$ImageComplete=false;
		$vehicleType = $data['vehicle'];
		$vehreg=$data['vehreg'];
		$owner_name=$data['owner_name'];
		$owner_email=$data['owner_email'];
		$owner_tel = $data['tele'];
		$owner_id=$data['id_number'];
		$address2=$data['address2'];


		if($editid==0){
			$sql = mysqli_query($db,"select * from employee where Email='$driver_email'");
		}
		else{
			$sql = mysqli_query($db,"select * from employee where Email='$driver_email' and empid!=$editid");
		}
		
		if(mysqli_num_rows($sql) > 0)
		{
			header("location:../employeeadd.php?msg=Email address all ready existed!");exit;
		}
		else
		{
			if(!empty($_FILES['pfimg']['name']))
			{
				$name=$_FILES['pfimg']['name'];
				$temp=$_FILES['pfimg']['tmp_name'];
				$size=$_FILES['pfimg']['size'];
				$type=$_FILES['pfimg']['type'];
						
				if($type != "image/jpg" && $type != "image/png" && $type != "image/jpeg" && $type != "image/gif")
				{
					header("location:../employeeadd.php?msg=Invalid image !");exit;
				}
				else
				{
					if($size > 1000000)
					{
						header("location:../employeeadd.php?msg=File size upto 1MB required ! ");exit;
					}
					else
					{	
						$ImageComplete=true;
					}				
				}
			}
			else
			{
				$in = $_POST["imagefilename"];
				
				if(file_exists("../image/".$in))
				{
					$ImageComplete=true;
				}
				else
				{
					header("location:../employeeadd.php?msg=Pleaes Select Profile Image! ");exit;	
				}
			}	
		}

		if($ImageComplete)
		{
			$roleid = $_SESSION['User']['RoleId'];
			date_default_timezone_set("Asia/Kolkata");
			$datetime = date("Y-m-d h:i:s");

			// print_r([$empid, $fname, $mname, $lname, $gender , $address1, $address2, $city, $mnumber, $driver_email, $password, $owner,$vehicleType, $marital, $shortcode,$owner_name,$owner_email, $owner_tel, $owner_id]);
			if($editid==0){
			
				if(!empty($_FILES['pfimg']['name']))
				{
					$name = rand(222,333333).$name;
					move_uploaded_file($temp,"../image/".$name);
				}
				else
				{
					$name = $_POST["imagefilename"];
				}
				mysqli_query($db,"INSERT INTO owners VALUES (null,'$owner_name','$owner_id','$owner_email','$address2','$password','$owner_tel')");

				mysqli_query($db,"insert into employee values(null,'$empid','$fname','$mname','$lname','$gender','$address1','$city','$mnumber','$driver_email','$owner','$datetime',null,null,'$joindate',null,null,'$name', '$vehicleType', '$marital',null,null, '$owner_id')");

				$autoInc_id = mysqli_insert_id($db);

				if($autoInc_id){
					$shortcodeVal = $shortcode . $autoInc_id;
				
				}
				
				



				mysqli_query($db ,"INSERT INTO vehicle VALUES('$vehicleType',null,'$owner_id','$city','$shortcodeVal', '$vehreg')");

			
				header("location:../detailview.php?id=$autoInc_id");exit;
			}
			else
			{
				if(!empty($_FILES['pfimg']['name']))
				{
					$name = rand(222,333333).$name;
					move_uploaded_file($temp,"../image/".$name);
				}
				else
				{
					$name = $_POST["imagefilename"];
				}
				mysqli_query($db,"update employee set EmployeeId='$empid',FirstName='$fname',MiddleName='$mname',LastName='$lname',Gender='$gender',Address1='$address1',CityId='$city',Mobile='$mnumber',Email='$driver_email',marital_status='$marital',ModifiedDate=current_timestamp(),JoinDate='$joindate',ImageName='$name' where EmpId='$editid' ");

				header("location:../detailview.php?employeeid=$editid");exit;
			}
			/*"(EmpId,EmployeeId,FirstName,MiddleName,LastName,Birthdate,Gender,Address1,Address2,Address3,CityId,Mobile,Email,Password,AadharNumber,MaritalStatus,PositionId,CreatedBy,CreatedDate,ModifiedBy,ModifiedDate,JoinDate,LeaveDate,LastLogin,LastLogout,StatusId,RoleId,ImageName,MacAddress)";*/
		}
	}
?>