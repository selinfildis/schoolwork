<html>
<head>
</head>
<body>
<div style = "text-align: left;">
<?php
	$show = $_GET['show'];
	$username = "selin.fildis";
	$password = "f1kjhn7y";
	$hostname = "dijkstra2.ug.bcc.bilkent.edu.tr"; 

	//connection to the database
	$dbhandle = mysqli_connect($hostname, $username, $password, "selin_fildis") 
	or die("Unable to connect to mysqli");
	$result = mysqli_query($dbhandle,"SELECT Channel.cname FROM Channel, Shows WHERE Shows.pname = '$show' AND Shows.cid = Channel.cid");
	
	while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
		echo "<h1>";
		$channel = $fetch['cname'];
		echo $channel;
		echo "</h1>";
	}
	$result = mysqli_query($dbhandle,"SELECT Host.name, Shows.day, Shows.time FROM Host, Shows WHERE Shows.pname = '$show' AND Shows.hid = Host.hid");
	
	while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
		echo "<h2>$show by ";

		$host = $fetch['name'];
		$day = $fetch['day'];
		$time = $fetch['time'];
		echo "$host on $day at $time</h2>";
	}
	echo "<h3> Guests: </h3>";
	$result = mysqli_query($dbhandle,"SELECT Guest.gname, Guest.profession, Guest.short_bio FROM Guest, Shows, guest_show WHERE Shows.pname = '$show' AND Shows.sid = guest_show.sid AND Guest.gid = guest_show.gid");
	
	while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
		echo "<div align=\"justify\">";
		$guest = $fetch['gname'];
		$prof = $fetch['profession'];
		$bio = $fetch['short_bio'];
		echo "<h4>$guest, $prof</h4><p>$bio</p>";
		echo "</div>";
	}
	
?>
		</div>
		<br>
		<div style = "text-align: center;">
		<a href="./login.php" type="button">
		Login</a>
		</div>
</body>
</html>