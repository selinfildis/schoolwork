<?php 
include "header.php";
include "navbar.php";
if(isset($_GET['city']) && isset($_GET['DateRange']) && isset($_GET['people']) && strlen($_GET['DateRange']) > 0 && strlen($_GET['people']) > 0 ){
    if(isset($_POST['advanceSearch'])){
        $date = explode(' - ',$_POST['DateRange']);
        if(!isset($_POST['isHave'])){
            $_POST['isHave'] = array();
        }
        $results = AdvanceSearch($_POST['city'], $date[0], $date[1], $_POST['people'], $_POST['isHave'], $_POST['minPrice'], $_POST['maxPrice']);
    }else{
        $date = explode(' - ',$_GET['DateRange']);
        $results = search($_GET['city'], $date[0], $date[1], $_GET['people']);
    }
    

}else{
    header("Location: index.php");
    exit;
}
?>
<div class="container search-page">
    <div class="row">
        <div class="col-md-12">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="City" name="city" value="<?php if(isset($_GET['city'])){ echo $_GET['city']; } ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="datepicker" placeholder="Date Range" name="DateRange" value="<?php if(isset($_GET['DateRange'])){ echo $_GET['DateRange']; } ?>">
                </div>
                
                <div class="form-group">
                    <input type="number" min="1" step="1" class="form-control" placeholder="#ofPeople" name="people" value="<?php if(isset($_GET['people'])){ echo $_GET['people']; } ?>">
                </div>
                
                <button type="submit" class="btn btn-info">Search</button>
            </form>
        </div>
        
        <div class="col-sm-9 col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Search Result</h3>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <?php foreach($results as $result){
                            $houseImages = getHousePhoto($result->accommodationID);
                            if(count($houseImages) > 0){
                                $img = current(getHousePhoto($result->accommodationID))->photo;
                            }else{
                                $img = 'default.png';
                            }
                            
                        ?>
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img src="<?php echo s3Url.'house/'.$img; ?>" style="height:150px;">
                                    <div class="caption">
                                        <a href="houseDisplay.php?id=<?php echo $result->offeringID; ?>"><p><?php echo $result->title; ?></p></a>
                                    </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
        <div class="col-sm-3 col-md-3">
            <div class="panel panel-default">
                
                <div class="panel-body">
                    
                <form style="vertical-align: left;" method='POST'>
                    <?php if(isset($_GET['city']) && isset($_GET['DateRange']) && isset($_GET['people']) && !isset($_GET['advanceSearch'])){ ?>
                    <input type='hidden' name='city' value='<?php echo $_GET['city']; ?>'>
                    <input type='hidden' name='DateRange' value='<?php echo $_GET['DateRange']; ?>'>
                    <input type='hidden' name='people' value='<?php echo $_GET['people']; ?>'>
                    <input type='hidden' name='advanceSearch' value='true'>    
                    <?php } ?>
                    <div class="form-group">
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
                        <input type="number" min="0" step="10" class="form-control" placeholder="Min Price" name="minPrice" value="<?php if(isset($_POST['minPrice'])){ echo $_POST['minPrice']; } ?>">
                    </div>
                    <div class="form-group">
                        <input type="number" min="0" step="10" class="form-control" placeholder="Max Price" name="maxPrice" value="<?php if(isset($_POST['maxPrice'])){ echo $_POST['maxPrice']; } ?>">
                    </div>
                    <button type="submit" class="btn btn-info">Search</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>