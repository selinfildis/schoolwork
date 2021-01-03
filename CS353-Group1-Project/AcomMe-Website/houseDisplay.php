<?php
include "header.php";
include "navbar.php";
if(isset($_GET['id'])){
    $houseInfo = getHouseInfo($_GET['id']);
    $housePhotos = getHousePhoto($houseInfo->accommodationID);
    if(isset($_POST['makeReservation'])){

        makeReservation($_SESSION['userID'], $_POST);
        $_SESSION['reservationSuccess'] = true;
        header("Location: seeReservations.php");
        exit;
    }
    
    if(isset($_GET['addWish'])){
        addWish($_SESSION['userID'], $houseInfo->accommodationID);
    }
}else{
    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <form method="POST" enctype="multipart/form-data">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                          <h3>House Info</h3>
                          <div name="house-info">
                            <p><?php echo $houseInfo->description; ?></p>
                          </div>
                        </div>
                    </div>
                    <?php foreach($housePhotos as $photo){ ?>
                    <div class="col-md-6">
                        <div class="thumbnail">
                            <img src="<?php echo s3Url.'house/'.$photo->photo; ?>">
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <form method="POST">
                            <div class="panel-body">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="datepicker" placeholder="Date Range" name="DateRanges" value="<?php echo $houseInfo->offering_start_date.' - '.$houseInfo->offering_end_date; ?>">
                                </div>
                                <div class="form-group">
                                    <input type="number" min="1" step="1" max="<?php echo $houseInfo->guest_number; ?>" class="form-control" placeholder="#ofPeople" name="people" value="1">
                                </div>
                                <div name="reservation-details">Offering Price: <?php echo $houseInfo->offering_price; ?>$
                                </div>
                                <br>
                                <input type="hidden" name="offeringID" value="<?php echo $houseInfo->offeringID; ?>">
                                <input type="hidden" name="offeringPrice" value="<?php echo $houseInfo->offering_price; ?>">
                                <?php if(isset($_SESSION['login'])){ ?>
                                <button type="submit" name="makeReservation" value="true" class="btn btn-info">Make Reservation</button>
                                <a href="sendMessage.php?userID=<?php echo $houseInfo->host_ID; ?>" class="btn btn-info">Message User</a>
                                <a href="houseDisplay.php?id=<?php echo $_GET['id']; ?>&addWish" class="btn btn-info">Add to Wishlist</a>
                                <?php }else{ ?>
                                <a href="login.php" class="btn btn-info">Make Reservation</a>
                                <a href="login.php" class="btn btn-info">Message User</a>
                                <a href="login.php" class="btn btn-info">Add to Wishlist</a>
                               <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div name="review-div">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(function () {

            $('input[name="DateRanges"]').daterangepicker({
                autoUpdateInput: false,
                minDate: "<?php echo $houseInfo->offering_start_date; ?>",
                maxDate: "<?php echo $houseInfo->offering_end_date; ?>",
                locale: {
                    format: 'YYYY/MM/DD',
                    cancelLabel: 'Clear'
                }
            });

            $('input[name="DateRanges"]').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
            });

            $('input[name="DateRanges"]').on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
        });
    </script>

<?php
include "footer.php";
?>
