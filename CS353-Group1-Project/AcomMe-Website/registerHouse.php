<?php
include "header.php";
include "navbar.php";
$error = array();

if(isset($_SESSION['login'])){
    $houses = userHouses($_SESSION['userID']);
    if(isset($_POST['register'])){
        if(!isset($_POST['district']) || strlen($_POST['district']) == 0){
            $error[] = 'Please Enter District Field';
        }
        if(!isset($_POST['street']) || strlen($_POST['street']) == 0){
            $error[] = 'Please Enter street Field';
        }
        if(!isset($_POST['building_number']) || strlen($_POST['building_number']) == 0){
            $error[] = 'Please Enter building Field';
        }
        if(!isset($_POST['country']) || strlen($_POST['country']) == 0){
            $error[] = 'Please Enter country Field';
        }
        if(!isset($_POST['city']) || strlen($_POST['city']) == 0){
            $error[] = 'Please Enter city Field';
        }
        if(!isset($_POST['postcode']) || strlen($_POST['postcode']) == 0){
            $error[] = 'Please Enter postcode Field';
        }
        if(!isset($_POST['offering_price']) || strlen($_POST['offering_price']) == 0){
            $error[] = 'Please Enter Price Per Night Field';
        }
        
        if(!isset($_POST['bed_number']) || strlen($_POST['bed_number']) == 0){
            $error[] = 'Please Enter #ofBedrooms Field';
        }
        if(!isset($_POST['bath_number']) || strlen($_POST['bath_number']) == 0){
            $error[] = 'Please Enter #ofBathrooms Field';
        }
        if(!isset($_POST['guest_number']) || strlen($_POST['guest_number']) == 0){
            $error[] = 'Please Enter #ofGuests Field';
        }
        if(!isset($_POST['DateRange']) || strlen($_POST['DateRange']) == 0){
            $error[] = 'Please Enter Date Range Field';
        }
        if(!isset($_POST['title']) || strlen($_POST['title']) == 0){
            $error[] = 'Please Enter House Titlee Field';
        }
        if(!isset($_POST['description']) || strlen($_POST['description']) == 0){
            $error[] = 'Please Enter Description Field';
        }

        if(count($error) == 0){
            if(isset($_FILES['housePhotos'])){
                registerHouse($_SESSION['userID'], $_POST,$_FILES);
            }else{
                registerHouse($_SESSION['userID'], $_POST,NULL);
            }
            $_SESSION['success'] = 'House Register Success';
            header("Location: houses.php");
            exit;
        }else{
            $errorMessage = implode('<br>',$error);
        }

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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <span id="helpBlock" class="help-block-strong" style="padding-top:10px;">Address</span>
                            <input type="text" class="form-control" placeholder="District" name="district">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Street" name="street">
                        </div>
                        <div class="form-group">
                                <input type="number" min="1" step="1" class="form-control" placeholder="Building #" name="building_number">
                        </div>

                        <div class="form-group" >
                                <input type="text" class="form-control" placeholder="Country" name="country">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="City" name="city">
                        </div>

                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="Postal Code" name="postcode">
                        </div>
                        <div class="form-group">
                            <input type="number" min="10" step="10" class="form-control" placeholder="Price Per Night" name="offering_price">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="#ofBedrooms" name="bed_number">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="#ofBathrooms" name="bath_number">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="#ofGuests" name="guest_number">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" id="datepicker" placeholder="Date Range" name="DateRange">
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="panel panel-default">
                          <div class="panel-body">
                            <div style="vertical-align: left;" method="post">
                              <?php foreach(amenityList() as $data){ ?>
                                  <div class="checkbox">
                                      <label>
                                          <input type="checkbox" name='isHave[]' value="<?php echo $data->amenityID; ?>" <?php if(isset($_POST['isHave'])){if(in_array($data->amenityID, $_POST['isHave'])) { echo 'checked'; }} ?>>
                                              <?php echo $data->name; ?>
                                      </label>
                                  </div>
                                  <?php } ?>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile" style="color:black;">Upload Pictures</label>
                                <input type="file" name="housePhotos[]" accept="image/jpg,image/jpeg" multiple>
                            </div>
                          </div>
                      </div>


                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="House Title" name="title">
                      </div>
                      <div class="form-group">
                          <textarea class="form-control" name="description" rows="12" placeholder="Description "></textarea>
                      </div>
                        <button type="submit" name="register" class="btn btn-info">Confirm House</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>
