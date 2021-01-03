<html>
<head>
<script>
function myFunction() {
    var x = document.getElementById("field");
    if(x.elements[0] == null)
		window.alert("Enter username");
	if(x.elements[1] == null)
		window.alert("Enter password");
}
</script>
</head>
<body>
	<div>
		<form action = "" method = "post">
			<label>UserName  :</label><input  class = "box" type="text" name="uname" ><br>
			<label>Password  :</label> <input  class = "box" type="password" name="pass"><br><br>
			<input type="submit" value="Submit">
		</form> 
		<?php 
			
			$username = "selin.fildis";
			$password = "f1kjhn7y";
			$hostname = "dijkstra2.ug.bcc.bilkent.edu.tr"; 

			//connection to the database
			$dbhandle = mysqli_connect($hostname, $username, $password, "selin_fildis") 
			or die("Unable to connect to mysqli");
			
		   include("config.php");
		   
		   
		  // if($_SERVER["REQUEST_METHOD"] == "POST") {
			  // username and password sent from form 
			  $id = null;
			  $uname = $_GET['uname'];
			  $pass = $_GET['pass'];
			  
			  $sql = "SELECT Host.hid FROM Host WHERE Host.nickname = '$uname' and Host.password = '$pass';";
			  $result = mysqli_query($db,$sql);
			  
			  //$count = mysqli_num_rows($result);
			  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
			  $id=$row['hid'];
			  // If result matched $uname and $mypassword, table row must be 1 row
				
			  //if($count == 1) {
				
				//$_SESSION['login_user'] = $uname;
				if($id != null && $result !=null)
					header("location: ./Host.php?=$id");
				else {
					echo "Your Login Name or Password is invalid";
				}
		   //}

			
		?>
	</div>
</body>
</html>