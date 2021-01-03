<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login'])){
    $wishes = userWishes($_SESSION['userID']);
    if(isset($_GET['delete'])){
        deleteWish($_SESSION['userID'],$_GET['delete']);
        header("Location: wishlist.php");
        exit;
    }
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
                  <div class="panel-body">
                    <table class="table table-striped">
                      <tbody>
                        
                        <?php foreach($wishes as $data){ 
                            $houseData = getHouseData($data->wishesAccommodationID);
                            ?>
                            <tr>
                                <td><?php echo $houseData->title; ?></td>
                                <td><?php echo $houseData->city; ?></td>
                                <td><a href="wishlist.php?delete=<?php echo $data->wishesAccommodationID; ?>" class="btn btn-danger">Delete</a></td>
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
