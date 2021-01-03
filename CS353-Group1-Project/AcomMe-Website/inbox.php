<?php
include "header.php";
include "navbar.php";
if(isset($_SESSION['login'])){
    if(isset($_GET['delete'])){
        deleteMessage($_GET['delete']);
    }
    $messages = getUserInbox($_SESSION['userID']);
    
    
}else{
    header("Location: index.php");
    exit;
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 main-page">
            <form method="POST" enctype="multipart/form-data">
              <div class= "col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th> From </th>
                          <th> Message Header </th>
                          <th> Date </th>
                          <th> Action </th>
                        </tr>
                    </thead>
                  <tbody>
                      <?php foreach($messages as $data){ ?>
                        <tr>
                            <td><a href="sendMessage.php?userID=<?php echo $data->sendID; ?>"><?php echo getUserData($data->sendID)->userName; ?></a></td>
                            <td><a href="readMessage.php?id=<?php echo $data->message_ID; ?>"><?php echo $data->message_title; ?></a></td>
                            <td><?php echo $data->date; ?></td>
                            <td><a href="inbox.php?delete=<?php echo $data->message_ID; ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                      <?php } ?>
                  </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>
