<?php include('header.php'); ?>
<?php
	include_once('controller/connect.php');
	
	$dbs = new database();
	$db=$dbs->connection();

	$page="";
	if(isset($_GET['search']))
	{
		$SearchName = $_GET['search'];
		$RecordeLimit = 10;
		$search = mysqli_query($db,"select count(ownerId) as total from owners where Name like '%".$SearchName."%' ");
		
		$SName = mysqli_fetch_array($search);
		
		$number_of_row =ceil($SName['total']/10); 
		if(isset($_GET['bn']) &&intval($_GET['bn']) <= $number_of_row && intval($_GET['bn'] !=0))
		{

			$Skip = (intval($_GET["bn"]) * $RecordeLimit) - $RecordeLimit;

			$sql = mysqli_query($db,"select * from owners where Name like '%".$SearchName."%'  LIMIT $Skip,$RecordeLimit ");
		}
		else
		{
			$sql = mysqli_query($db,"select * from owners where  Name like '%".$SearchName."%' LIMIT $RecordeLimit");
			
		}

		for($i=0;$i<$number_of_row;$i++)
		{
			$d = $i+1;
			if(isset($_GET["search"]))
			{
				$page .= "<a href='?search=$SearchName&bn=$d'>$d</a>&nbsp &nbsp &nbsp";
			}
			else
			{
				$page .= "<a href='?bn=$d'>$d</a>&nbsp &nbsp &nbsp";
			}					            
		} 
	}
	else if(isset($_GET['ownerId']))
	{
		$ownerid = $_GET['ownerId'];
		mysqli_query($db,"delete from owners where ownerId='$ownerid'");
		echo "<script>window.location='ownerview.php';</script>";
	}
	else
	{
		$RecordeLimit = 10;
		$search = mysqli_query($db,"select count(ownerId) as total from owners ");
		$SName = mysqli_fetch_array($search);
		
		$number_of_row =ceil($SName['total']/10);
		if(isset($_GET['bn']) && intval($_GET['bn']) <= $number_of_row && intval($_GET['bn'] != 0 ))
		{
			$Skip = (intval($_GET["bn"]) * $RecordeLimit) - $RecordeLimit;
			$sql = mysqli_query($db,"select * from owners LIMIT $Skip,$RecordeLimit");
		}
		else
		{
			$sql = mysqli_query($db,"select * from owners  LIMIT $RecordeLimit");
		}

		for($i=0;$i<$number_of_row;$i++)
		{
			$d = $i+1;
		    $page .= "<a href='?bn=$d'>$d</a>&nbsp &nbsp &nbsp";
		}
	}
?>
<link rel="stylesheet" type="text/css" href="css/table-style.css" />
<!-- <link rel="stylesheet" type="text/css" href="css/basictable.css" /> -->
<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#table').basictable();

      $('#table-breakpoint').basictable({
        breakpoint: 768
      });

      $('#table-swap-axis').basictable({
        swapAxis: true
      });

      $('#table-force-off').basictable({
        forceResponsive: false
      });

      $('#table-no-resize').basictable({
        noResize: true
      });

      $('#table-two-axis').basictable();

      $('#table-max-height').basictable({
        tableWrapper: true
      });
    });
</script>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>client<i class="fa fa-angle-right"></i>Owner View</li>
</ol>

<div class="validation-system" style="margin-top: 0;">	
<div class="validation-form">
 	<div>
		<div class="w3l-table-info">
		<h2>Owner View</h2>
		<br>
	  	<form method="GET" action="#">
			<input style="float: right;" type="submit" name="searchview">
			<input style="float: right;" placeholder="Search" value="<?php echo(isset($SearchName))?$SearchName:''; ?>" type="search-box" name="search"><br>
		</form>
		<table id="table">
		<thead>
			<tr>
				<th style="text-transform: capitalize;">Owner Name</th>
				<th style="text-transform: capitalize;">Email</th>
				<th style="text-transform: capitalize; text-align: center;">Address</th>
				<th style="text-transform: capitalize; text-align: center;">Telephone</th>
			</tr>
		</thead>
		<tbody>
		<?php while($row = mysqli_fetch_assoc($sql)) { ?>
			<tr>
			<td><?php $fname= (isset($row['Name']))?$row['Name']:""; echo ucfirst($fname)."&nbsp;"; ?></td>
				
         
			<td><?php $fname= (isset($row['owner_email']))?$row['owner_email']:""; echo ucfirst($fname)."&nbsp;"; ?></td>
				

				<td style="width: 105px;"><?php $fname = (isset($row['owner_address']))?$row['owner_address']:"";  echo ucfirst("<center>".$fname."</center>"); ?></td>
				
				<td style="width: 105px;"><?php $fname = (isset($row['owner_tel']))?$row['owner_tel']:"";  echo ucfirst("<center>".$fname."</center>"); ?></td>
			</tr>
		<?php }?>
		</tbody>
		</table>
		<div><?php echo $page; ?></div>
		</div>  
	</div>
 </div>
</div>
<!-- The Modal -->
<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>

<?php include('footer.php'); ?>



<!--image Popup-->
<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
</script>
<!--End image Popup -->