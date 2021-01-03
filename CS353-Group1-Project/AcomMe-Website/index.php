<?php 
include "header.php";
include "navbar.php";
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <?php
                if(isset($_SESSION['loginSuccess'])){
                    echo '<div class="alert alert-success" role="alert">Login Success!<br>Welcome '.$_SESSION['username'].'</div>';
                    unset($_SESSION['loginSuccess']);
                }
            ?>
            <form class="form-inline" action="search.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="City" name="city">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="datepicker" placeholder="Date Range" name="DateRange">
                </div>
                
                <div class="form-group">
                    <input type="number" min="1" step="1" class="form-control" placeholder="#ofPeople" name="people">
                </div>
                
                <button type="submit" class="btn btn-info">Search</button>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>