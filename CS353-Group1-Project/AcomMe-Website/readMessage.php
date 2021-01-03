<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login']) && $_GET['id']){
    
    if(isset($_GET['id'])){
        $data = getMessage($_GET['id']);
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
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Message Title" name="message_title" value="<?php echo $data->message_title; ?>" disabled>
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="message_body" rows="12" placeholder="Message " disabled><?php echo $data->message_body; ?></textarea>
                </div>
                  <a href="inbox.php?delete=<?php echo $data->message_ID; ?>" class="btn btn-danger">Delete</a>
              </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>
