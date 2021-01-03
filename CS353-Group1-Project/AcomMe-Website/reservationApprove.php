<?php
include "header.php";
include "navbar.php";

if(isset($_SESSION['login'])){
    
    if(isset($_GET['delete'])){
        discardReservation($_GET['delete']);
    }else if(isset($_GET['approve'])){
        approveReservation($_GET['approve']);
    }
    
    $reservations = reservationRequestView($_SESSION['userID']);
}else{
    header("Location: index.php");
    exit;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <form method="POST" enctype="multipart/form-data">
                <div class"col-md-6 col-md-6-offset-3">
                     <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> User </th>
                                        <th> House </th>
                                        <th> Date </th>
                                        <th> Approval Status </th>
                                        <th> Approve/Delete/Message </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($reservations as $data){ ?>
                                        <tr>
                                            <td><?php echo $data->userName; ?></td>
                                            <td><a href="houseDisplay.php?id=<?php echo $data->offeringID; ?>"><?php echo $data->title; ?></a></td>
                                            <td><?php echo $data->reservation_start_date." - ".$data->reservation_end_date; ?></td>
                                            <td><?php if($data->confirmed == NULL) { echo "<span class='label label-danger'>Not Approved</span>"; }else{ echo"<span class='label label-success'>Approved</span>"; }?></td>
                                            <td> <?php if($data->confirmed == NULL) { ?>
                                                <a href="reservationApprove.php?approve=<?php echo $data->reservationID; ?>" class="btn btn-info">Approve</a> - 
                                                <a href="reservationApprove.php?delete=<?php echo $data->reservationID; ?>" class="btn btn-danger">Delete</a> - 
                                                <a href="message.php?user=<?php echo $data->reservationGuestID; ?>" class="btn btn-success">Message</a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>
