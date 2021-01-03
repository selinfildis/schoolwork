<?php
include "header.php";
include "navbar.php";

$error = array();
    if(isset($_POST['register'])){
        
        if(!isset($_POST['name']) || strlen($_POST['name']) == 0){
            $error[] = 'Please Enter Name Field';
        }
        if(!isset($_POST['surname']) || strlen($_POST['surname']) == 0){
            $error[] = 'Please Enter Surname Field';
        }
        if(!isset($_POST['day']) || strlen($_POST['day']) == 0 || !isset($_POST['month']) || strlen($_POST['month']) == 0 || !isset($_POST['year']) || strlen($_POST['year']) == 0){
            $error[] = 'Please Enter Birthday Field';
        }
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
        if(!isset($_POST['phone_number']) || strlen($_POST['phone_number']) == 0){
            $error[] = 'Please Enter phone number Field';
        }
        if(!isset($_POST['short_bio']) || strlen($_POST['short_bio']) == 0){
            $error[] = 'Please Enter short bio Field';
        }
        if(!isset($_POST['email']) || strlen($_POST['email']) == 0){
            $error[] = 'Please Enter Email Field';
        }else{
            if (!emailCheck($_POST['email'])) {
                $error[] = 'Email used!';
            }
        }
        
        if(!isset($_POST['userName']) || strlen($_POST['userName']) == 0){
            $error[] = 'Please Enter Username Field';
        }else{
            
            if(!userNameCheck($_POST['userName'])){
                $error[] = 'Username used!';
            }
        }
        
        if(!isset($_POST['password']) || strlen($_POST['password']) == 0){
            $error[] = 'Please Enter Password Field';
        }
        
        if(!isset($_POST['re_password']) || strlen($_POST['re_password']) == 0){
            $error[] = 'Please Enter Confirm Password Field';
        }
        





    if((isset($_POST['password']) || isset($_POST['re_password'])) && (strlen($_POST['password']) > 0 && strlen($_POST['re_password']) > 0)){
            if($_POST['password'] != $_POST['re_password']){
                $error[] = 'Please enter password and Confirm password same!';
            }
        }
        
        
        if(count($error) == 0){
            if(isset($_FILES['profilePicture'])){
                register($_POST,$_FILES);
            }else{
                register($_POST,NULL);
            }
            $_SESSION['success'] = 'Register Success';
            header("Location: login.php");
            exit;
        }else{
            $errorMessage = implode('<br>',$error);
        }
        
    }
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        
                        <?php
                        
                        if (count($error) > 0) {
                            echo '<div class="alert alert-danger" role="alert">' . $errorMessage . '</div>';
                        }

                        if (isset($_SESSION['success'])) {
                            echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
                            unset($_SESSION['success']);
                        }
                        ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Surname" name="surname">
                        </div>
                        
                        <div class="form-group">
                            <span id="helpBlock" class="help-block-strong">Birthday</span>
                            <div class="col-md-4">
                                <select class="form-control" name="day">
                                    <option>DD</option>
                                    <?php
                                        for($i = 1; $i <= 31; $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control col-md-4" name="month">
                                    <option>MM</option>
                                    <?php
                                        for($i = 1; $i <= 12; $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control col-md-4" name="year">
                                    <option>YY</option>
                                    <?php
                                        for($i = 1970; $i <= date('Y'); $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        
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
                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="City" name="city">
                        </div>
                        
                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="Postal Code" name="postcode">
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputFile" style="color:white;">Profile Picture</label>
                            <input type="file" name="profilePicture" style="color:white;">
                            <!--<p class="help-block">Example block-level help text here.</p>-->
                        </div>
                        
                        <div class="form-group">
                            <label style="color:white;">Gender</label><br>
                            <label class="radio-inline" style="color:white;">
                                <input type="radio" name="gender" value="male"> Male
                            </label>
                            <label class="radio-inline" style="color:white;">
                                <input type="radio" name="gender" value="female"> Female
                            </label>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone_number">
                        </div>
                        
                        <div class="form-group">
                            <textarea class="form-control" name="short_bio" rows="12" placeholder="Short Bio"></textarea>
                        </div>

                    </div>
                    <div class="col-md-4">
                        
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" name="userName">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="re_password">
                        </div>
                        
                        <div class="form-group">
                            <input type="e-mail" class="form-control" placeholder="E-mail" name="email">
                        </div>
                        <button type="submit" name="register" value="true" class="btn btn-info">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>