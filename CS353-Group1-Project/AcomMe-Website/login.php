<?php
include "header.php";
include "navbar.php";
$loginData = false;
if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    
    $loginData = login($username, $password);
    
    if($loginData){
        $_SESSION['login']=true;
        $_SESSION['username'] = $loginData->username;
        $_SESSION['userID'] = $loginData->userID;
        $_SESSION['loginSuccess'] = true;
        header("Location: index.php");
        exit;
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            
            <form class="col-md-4 col-md-offset-4" method='POST'>
                <?php if($loginData == false && isset($_POST['username']) && isset($_POST['password'])){?>
                  <div class="alert alert-danger" role="alert">Wrong Username or/and Password!</div>  
                <?php } ?>
                <div class="form-group">
                    <input type="text" class="form-control" name='username' placeholder="Username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name='password' placeholder="Password">
                </div>
                <button type="submit" class="btn btn-info">Login</button>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>