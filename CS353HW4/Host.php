<?php echo "Wow you made it"?>
<?php 
	$id = $_GET['id'];
	$username = "selin.fildis";
	$password = "f1kjhn7y";
	$hostname = "dijkstra2.ug.bcc.bilkent.edu.tr"; 

	//connection to the database
	$dbhandle = mysqli_connect($hostname, $username, $password, "selin_fildis") 
	or die("Unable to connect to mysqli");
	$result = mysqli_query($dbhandle,"SELECT FROM WHERE;");
	
		



?>
<html>
<head>
</head>
<body>
<form method="POST" >
<label for="date"> Date : </label>
  <select id="cmbMake" name="Date" onchange="document.getElementById('selected_text').value=this.options[this.selectedIndex].text">
		<option value="0">Select Date</option>
		<option value="1">21/11/2016</option>
		<option value="2">22/11/2016</option>
		<option value="3">23/11/2016</option>
		<option value="4">24/11/2016</option>
		<option value="5">25/11/2016</option>
		<option value="6">26/11/2016</option>
		<option value="7">27/11/2016</option>

</select>
<input type="hidden" name="selected_text" id="selected_text" value="" />
<input type="submit" name="search" value="Search"/>
</form>
</body>
</html>