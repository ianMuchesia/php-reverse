
<?php include('header.php');?>
<?php
  include_once('controller/connect.php');
  
  $dbs = new database();
  $db=$dbs->connection();


  function reports_table_data(){
    global $db;

    $query = "SELECT reports.shortcode,reports.issue ,owners.Name, employee.FirstName, employee.LastName, employee.EmpId,reports.reported_by
          FROM reports
          LEFT JOIN vehicle ON reports.shortcode = vehicle.shortcode
          LEFT JOIN owners ON vehicle.owner = owners.id_number
          LEFT JOIN employee ON owners.id_number = employee.owner_id";

$stmt = $db->prepare($query);

$stmt->execute();
$result = $stmt->get_result();
//$row = $result->fetch_assoc();
$rows = $result->fetch_all(MYSQLI_ASSOC);
return $rows;
  }

  $reports = reports_table_data();
 
  
  
  ?>

<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="home.php">Home</a><i class="fa fa-angle-right"></i>Filed Reports<i class="fa fa-angle-right"></i>Records</li>
</ol>

<table class="table" >
  <thead >
    <tr>
      <th  style="background: #202a29;" scope="col">#</th>
      <th scope="col"  style="background: #202a29;">Report</th>
      <th scope="col"  style="background: #202a29;">Owner</th>
      <th scope="col"  style="background: #202a29;">Driver</th>
      <th scope="col"  style="background: #202a29;">Reported By</th>
      <th scope="col"  style="background: #202a29;">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    for($i=0;$i<count($reports);$i++){
        echo '
        <tr>
      <th scope="row" style="color: black;">'.($i+1) .'</th>
      <td style="color: black;">'.$reports[$i]['issue']. '</td>
      <td style="color: black;">'.$reports[$i]['Name']. '</td>
      <td style="color: black;">'.$reports[$i]['FirstName'] ." ".$reports[$i]['LastName']. '</td>
      <td style="color: black;">'.$reports[$i]['reported_by']. '</td>
      <td style="color: black;"><a href="detailview.php?employeeid='.$reports[$i]['EmpId'].'" class="btn btn-success">view details</a></td>
    </tr>
        ';
    }
    ?>
  </tbody>
</table>


<?php include('footer.php'); ?>