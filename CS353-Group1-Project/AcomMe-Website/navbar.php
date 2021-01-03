 <nav class="navbar navbar-blue navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">AccomoMe</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav navbar-right">
            <?php if(isset($_SESSION['login'])){
                if($_SESSION['login'] == true){
                    //echo '<li>Welcome '.$_SESSION['username'].'</li>';
                    echo '<li><a href="editProfile.php">Profile</a></li>';
                    echo '<li><a href="houses.php">Houses</a></li>';
                    echo '<li><a href="seeReservations.php">Reservations</a></li>';
                    echo '<li><a href="wishlist.php">Wishlist</a></li>';
                    echo '<li><a href="inbox.php">Inbox</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';

                }
            }else{
                echo '<li><a href="login.php">Login</a></li>'
                     .'<li><a href="register.php">Register</a></li>';
            }
            ?>
          </ul>
        </div>
      </div>
    </nav>
