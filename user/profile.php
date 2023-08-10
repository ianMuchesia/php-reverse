<?php include('userheader.php');?>
<?php //print_r($_SESSION);exit;
	include_once('../controller/connect.php');
	
	$dbs = new database();
	$db=$dbs->connection();
	
	
?>
               	<div class="s-12 l-10">
               	<h1>Profile</h1><hr>
               	<div class="clearfix"></div>
               	</div>
               	<form action="" method="post">

               	<div class="s-12 l-2">
                 	<table>
                 		<tbody>
                 		
                 			<tr>
                 				<td align="center"><u style="margin-bottom: 5px;"><b><?php echo ucfirst($_SESSION['User']['Name'])."&nbsp;"; ?></b></u></td>
                 			</tr>
                 			<tr>
                 				<td align="center"><b>ID :-</b> <?php echo(isset($_SESSION['User']['id_number']))?$_SESSION['User']['id_number']:"Null";?></td>
                 			</tr>
                 		</tbody>
                 	</table>
               	</div>
               	<div class="s-12 l-4" >
                 	<table>
                 		<tbody>
                 			
                 			
                 			<tr>
                 				<td style="text-align: right;"><b>Email :</b></td>
                 				<td ><?php echo(isset($_SESSION['User']['owner_email']))?$_SESSION['User']['owner_email']:"Null";?></td>
                 			</tr>
                 			<tr>
                 				<td style="text-align: right;"><b>Mobile No :</b></td>
                 				<td ><?php echo(isset($_SESSION['User']['owner_tel']))?$_SESSION['User']['owner_tel']:"Null";?></td>
                 			</tr>
                 			
                 			<tr>
                 				<td style="text-align: right;"><b>Address :</b></td>
                 				<td ><?php echo(isset($_SESSION['User']['owner_address']))?$_SESSION['User']['owner_address']:"Null";?> ,</td>
                 			</tr>
                 	
                 		
                 		</tbody>
                 	</table>
               	</div>
               	<div class="s-12 l-3">
                 	
               	</div>
               	</form>

<div id="myModal" class="modal">
<span class="close">&times;</span>
<img class="modal-content" id="img01">
<div id="caption"></div>
</div>



<?php include('userfooter.php');?>

<!-- The Modal -->


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