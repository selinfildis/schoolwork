<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login'])){
    
    if(isset($_GET['discard'])){
        discardReservation($_GET['discard']);
    }
    $reservations = getMyReservation($_SESSION['userID']);
}else{
    header("Location: index.php");
    exit;
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">

              <div class="col-md-12">
                  <?php if(isset($_SESSION['reservationSuccess'])){ ?>
                    <div class="alert alert-success" role="alert">Reservation Success!</div>  
                                    
                   <?php unset($_SESSION['reservationSuccess']); } ?>
                <div class="panel panel-default">
                  <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> Host </th>
                          <th> House </th>
                          <th> Date </th>
                          <th> Approval Status </th>
                          <th> Cancel</th>
                        </tr>
                    </thead>
                  <tbody>
                    
                        <?php foreach($reservations as $data){ ?>
                      <tr>
                          <td><?php echo $data->userName; ?></td>
                          <td><a href="houseDisplay.php?id=<?php echo $data->offeringID; ?>"><?php echo $data->title; ?></a></td>
                          <td><?php echo $data->reservation_start_date." - ".$data->reservation_end_date; ?></td>
                          <td><?php if($data->confirmed == NULL) { echo "<span class='label label-danger'>Not Approved</span>"; }else{ echo"<span class='label label-success'>Approved</span>"; }?></td>
                          <td> <?php if($data->confirmed == NULL) { ?><a href="seeReservations.php?discard=<?php echo $data->reservationID; ?>" class="btn btn-info">Discard</a> <?php } ?></td>
                      </tr>
                        <?php } ?>
                  </tr>
                  </tbody>
                    </table>

                  </div>
                </div>
              </div>
        </div>
    </div>
<?php
include "footer.php";
?>
