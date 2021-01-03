<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login'])){
    $userInfo = getUserInfo($_SESSION['userID']);
    
    $error = array();
    if(isset($_POST['apply'])){
        
        
        if(!isset($_POST['name']) || strlen($_POST['name']) == 0){
            $error[] = 'Please Enter Name Field';
        }
        if(!isset($_POST['surname']) || strlen($_POST['surname']) == 0){
            $error[] = 'Please Enter Name Field';
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
        }
        if($userInfo->email != $_POST['email']){
            if(!emailCheck($_POST['email'])){
                $error[] = 'Email used!';
            }
        }
        if((isset($_POST['password']) || isset($_POST['re_password'])) && (strlen($_POST['password']) > 0 && strlen($_POST['re_password']) > 0)){
            if($_POST['password'] == $_POST['re_password']){
                $password = md5($_POST['password']);
                passwordUpdate($_SESSION['userID'],$password);
            }else{
                $error[] = 'Please enter password and Confirm password same!';
            }
        }
        
        if($_FILES['profilePicture']['tmp_name'] != 0){
            if($fileUpload->uploadItem('profile', $_SESSION['userID'].'.jpg', $_FILES['profilePicture']['tmp_name']) != false){
                profilePictureUpdate($_SESSION['userID']);
            }
        }
        
        if(count($error) == 0){
            profileUpdate($_SESSION['userID'], $_POST);
            $_SESSION['success'] = 'Profile Updated';
            header("Location: editProfile.php");
            exit;
        }else{
            $errorMessage = implode('<br>',$error);
        }
        
    }
    
    
    $userAddress = getUserAdress($_SESSION['userID']);
    $userPhone = getUserPhone($_SESSION['userID']);
    $birthDay = explode('-',$userInfo->birthDate);
    
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
                        <?php
                            if(count($error)>0){
                                echo '<div class="alert alert-danger" role="alert">'.$errorMessage.'</div>';
                            }
                            
                            if(isset($_SESSION['success'])){
                                echo '<div class="alert alert-success" role="alert">'.$_SESSION['success'].'</div>';
                                unset($_SESSION['success']);
                            }
                        ?>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $userInfo->name; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Surname" name="surname" value="<?php echo $userInfo->surname; ?>">
                        </div>

                        <div class="form-group">
                            <span id="helpBlock" class="help-block-strong">Birthday</span>
                            <div class="col-md-4">
                                <select class="form-control" name="day">
                                    <option>DD</option>
                                    <?php
                                        for($i = 1; $i <= 31; $i++){
                                            if($i == $birthDay[2]){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                            
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control col-md-4" name="month">
                                    <option>MM</option>
                                    <?php
                                        for($i = 1; $i <= 12; $i++){
                                            if($i == $birthDay[1]){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control col-md-4" name="year">
                                    <option>YY</option>
                                    <?php
                                        for($i = 1970; $i <= date('Y'); $i++){
                                            if($i == $birthDay[0]){
                                                echo '<option value="'.$i.'" selected>'.$i.'</option>';
                                            }else{
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <span id="helpBlock" class="help-block-strong" style="padding-top:10px;">Address</span>
                            <input type="text" class="form-control" placeholder="District" name="district" value="<?php echo $userAddress->district; ?>">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Street" name="street" value="<?php echo $userAddress->street; ?>">
                        </div>
                        <div class="form-group">
                            <input type="number" min="1" step="1" class="form-control" placeholder="Building #" name="building_number" value="<?php echo $userAddress->building_number; ?>">
                        </div>

                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="Country" name="country" value="<?php echo $userAddress->country; ?>">

                        </div>
                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="City" name="city" value="<?php echo $userAddress->city; ?>">
                        </div>

                        <div class="form-group" >
                            <input type="text" class="form-control" placeholder="Postal Code" name="postcode" value="<?php echo $userAddress->postcode; ?>">
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                          <!--Eski resim gözüksün-->
                            
                            <label for="exampleInputFile" style="color:white;">Profile Picture</label>
                            <br>
                            <?php if($userInfo->photo == NULL){
                                $imgUrl = s3Url.'profile/default.jpg';
                            }else{
                                $imgUrl = s3Url.'profile/'.$userInfo->photo;
                            }?>
                            <img style="height:100px;"  src="<?php echo $imgUrl; ?>">
                            
                            <input type="file" name="profilePicture" style="color:white;">
                            <!--<p class="help-block">Example block-level help text here.</p>-->
                        </div>


                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone_number" value="<?php echo $userPhone->phone_number; ?>">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" name="short_bio" rows="12" placeholder="Short Bio"><?php echo $userInfo->short_bio; ?></textarea>
                        </div>

                    </div>
                    <div class="col-md-4">

                      
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm Password" name="re_password">
                        </div>

                        <div class="form-group">
                            <input type="e-mail" class="form-control" placeholder="E-mail" name="email" value="<?php echo $userInfo->email; ?>">
                        </div>
                        <button type="submit" name="apply" value="true" class="btn btn-info">Apply</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>
