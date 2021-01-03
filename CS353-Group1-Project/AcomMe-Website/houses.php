<?php
include "header.php";
include "navbar.php";

if(isset($_SESSION['login'])){
    $houses = userHouses($_SESSION['userID']);

}else{
    header("Location: index.php");
    exit;
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">

            <div class="col-md-12">

                <div class="panel panel-default">
                    <?php
                        if(isset($_SESSION['success'])){
                            echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
                            unset($_SESSION['success']);
                        }
                    ?>
                    <div class="panel-body">
                        <a href="registerHouse.php" class="btn btn-info">Add House</a> - <a href="reservationApprove.php" class="btn btn-info">View House Reservations</a>
                        <table class="table table-striped">
                            <thead>
                            <th>Title</th>
                            <th>Description</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Edit</th>
                            </thead>
                            <tbody>
                                <?php foreach($houses as $data){ ?>
                                <tr>
                                    <td><?php echo $data->title; ?></td>
                                    <td><?php echo $data->description; ?></td>
                                    <td><?php echo $data->city; ?></td>
                                    <td><?php echo $data->country; ?></td>
                                    <td><a href="editHouse.php?id=<?php echo $data->accommodationID; ?>" class="btn btn-info">Edit House</a></td>
                                </tr>
                                <?php } ?>
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
