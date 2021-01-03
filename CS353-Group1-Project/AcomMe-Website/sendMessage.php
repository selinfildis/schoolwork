<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login']) && $_GET['userID']){
    
    if(isset($_POST['sendMessage'])){
        sendMessage($_SESSION['userID'], $_GET['userID'], $_POST['message_title'], $_POST['message_body']);
    }
}else{
    header("Location: index.php");
    exit;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <form method="POST">
              <div class="col-md-12">
                    <input type="hidden" class="form-control" placeholder="To: " name="receiveID">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Message Title" name="message_title">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message_body" rows="12" placeholder="Message "></textarea>
                </div>
                  <button type="submit" name="sendMessage" value="true" class="btn btn-info">Send Message</button>
                  <button type="submit" class="btn btn-info">Discard</button><!--Sayfayı Temizleyecek-->
              </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>
