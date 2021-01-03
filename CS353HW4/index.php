
<html>
<head>
<title>TV Guide</title>
<style>
table, th, td {
    border: 1px solid black;
}
</style>

</head>
	<body>
	<div style = "text-align: center;">
		<table align="center" >
			<tr>
				<td>      </td>
				<td>Monday</td>
				<td>Tuesday</td>
				<td>Wednesday </td>
				<td>Thursday </td>
				<td>Friday </td>
				<td>Saturday </td>
				<td>Sunday </td>
			</tr>
	<?php 
			
			$username = "selin.fildis";
			$password = "f1kjhn7y";
			$hostname = "dijkstra2.ug.bcc.bilkent.edu.tr"; 

			//connection to the database
			$dbhandle = mysqli_connect($hostname, $username, $password, "selin_fildis") 
			 or die("Unable to connect to mysqli");
			
			
			$program = "";
			$host = "";
			$channel = "";
			$day = "";
			$time = "";
			echo "<tr>";
			echo "<td>20:00:00</td>";
			echo "<td>";
			echo "<a href = \"./";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Monday' AND Shows.time='20:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
			echo '</a>';
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Tuesday' AND Shows.time='20:00:00'");
			$program = "";
			$host = "";
			$channel = "";
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
			$program = $fetch['pname'];
			$host = $fetch['name'];
			$channel = $fetch['cname'];}
			echo"info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";				
			
			
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Wednesday' AND Shows.time='20:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Thursday' AND Shows.time='20:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Friday' AND Shows.time='20:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
				
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Saturday' AND Shows.time='20:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
				
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Sunday' AND Shows.time='20:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
					
			echo "</td>";
			echo "</tr>";
			
			
			
			echo "<tr>";
			echo "<td>21:00:00</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Monday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Tuesday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
			$program = $fetch['pname'];
			$host = $fetch['name'];
			$channel = $fetch['cname'];}
			echo"info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";				
			
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Wednesday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Thursday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Friday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Saturday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
				
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Sunday' AND Shows.time='21:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
					
			echo "</td>";
			echo "</tr>";
			
			
			
			
			
			echo "<tr>";
			echo "<td>22:00:00</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Monday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];}
				echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";				
			
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Tuesday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
			$program = $fetch['pname'];
			$host = $fetch['name'];
			$channel = $fetch['cname'];}
			echo"info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";				
			
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Wednesday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}	
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Thursday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Friday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}	
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Saturday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}	
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";
				echo "</td>";
				echo "<td>";
				
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT pname, name, cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Sunday' AND Shows.time='22:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}	
			
			
			echo"<a href= \"./info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";			
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			
			echo "<td>23:00:00</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Monday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}
			echo"info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Tuesday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
			$program = $fetch['pname'];
			$host = $fetch['name'];
			$channel = $fetch['cname'];
							
			}
			echo"info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";
			echo "</td>";
			echo "<td>";
			echo "<a href = \"./";
			$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Wednesday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
							
			}	
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";	
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Thursday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
							
			}
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";	
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Friday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}	
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Saturday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
								
			}	
			echo"info.php?show=$program\">";
				echo "$program</a><br>$channel<br>$host";
				echo "</td>";
				echo "<td>";
				echo "<a href = \"./";
				$program = "";
			$host = "";
			$channel = "";
			$result = mysqli_query($dbhandle,"SELECT Shows.pname, Host.name, Channel.cname FROM Shows,Channel, Host WHERE Shows.cid = Channel.cid AND Shows.hid = Host.hid AND Shows.day = 'Sunday' AND Shows.time='23:00:00'");
			while ($fetch = mysqli_fetch_array($result,MYSQLI_BOTH )){
				$program = $fetch['pname'];
				$host = $fetch['name'];
				$channel = $fetch['cname'];
							
			}
			echo"info.php?show=$program\">";
			echo "$program</a><br>$channel<br>$host";	
			echo "</td>";
			echo "</tr>";
	?>
	
	
		</table>
		
		</div>
		<br>
		<div style = "text-align: center;">
		<a href="./login.php" type="button">
		Login</a>
		</div>
	</body>
</html>