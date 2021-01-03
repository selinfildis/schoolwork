<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login'])){
    if(isset($_POST['update'])){
        updateHouse($_GET['id'], $_POST, $_FILES);
    }
    
    $houseData = getHouseData($_GET['id']);
    $amenityData = houseAmenity($_GET['id']);
    $housePhotos = getHousePhoto($_GET['id']);
    
    
}else{
    header("Location: index.php");
    exit;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">

                  <div class="col-md-3">
                    <?php foreach($housePhotos as $photo){ ?>
                    <div class="col-md-12">
                        <div class="thumbnail">
                            <img src="<?php echo s3Url.'house/'.$photo->photo; ?>">
                        </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                            <span id="helpBlock" class="help-block-strong" style="padding-top:10px;">Address</span>
                            <input type="text" class="form-control" placeholder="District" name="district" value="<?php echo $houseData->district; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Street" name="street" value="<?php echo $houseData->street; ?>">
                        </div>
                        <div class="form-group">
                                <input type="number" min="1" step="1" class="form-control" placeholder="Building #" name="building_number" value="<?php echo $houseData->building_number; ?>">
                        </div>

                        <div class="form-group" >
                                <input type="text" class="form-control" placeholder="Country" name="country" value="<?php echo $houseData->country; ?>">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $houseData->city; ?>">
                        </div>

                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="Postal Code" name="postcode" value="<?php echo $houseData->postcode; ?>">
                        </div>
                        

                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                            <input type="number" min="10" step="10" class="form-control" placeholder="Price Per Night" name="offering_price" value="<?php echo $houseData->offering_price; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="#ofBedrooms" name="bed_number" value="<?php echo $houseData->bed_number; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="#ofBathrooms" name="bath_number" value="<?php echo $houseData->bath_number; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="#ofGuests" name="guest_number" value="<?php echo $houseData->guest_number; ?>">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker" placeholder="Date Range" name="DateRange" value="<?php echo $houseData->offering_start_date.' - '.$houseData->offering_end_date; ?> ">
                        </div>
                    <div class="form-group">
                          <input type="text" class="form-control" placeholder="House Title" name="title" value="<?php echo $houseData->title; ?>">
                      </div>
                      <div class="form-group">
                          <textarea class="form-control" name="description" rows="12" placeholder="Description"><?php echo $houseData->description; ?></textarea>
                      </div>
                  </div>
                  <div class="col-md-3">

                    <div class="panel panel-default">
                          <div class="panel-body">
                            <div style="vertical-align: left;" method="post">
                              <?php foreach(amenityList() as $data){ ?>
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name='isHave[]' value="<?php echo $data->amenityID; ?>" <?php if(in_array($data->amenityID, $amenityData)) { echo 'checked'; } ?>>
                                              <?php echo $data->name; ?>
                                      </label>
                                  </div>
                                  <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" style="color:black;">Upload Pictures</label>
                                <input type="file" name="housePhotos[]" accept="image/jpg,image/jpeg" multiple>
                            </div>
                              <button type="submit" name="update" class="btn btn-info">Update</button>
                          </div>
                      </div>
                  </div>
                </div>
            </form>
          </div>
    </div>
<?php
include "footer.php";
?>
