<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "project");
	if(!isset($_SESSION['name']))
	{
		header("location : index.php");
	}

?>
<html>
<head><title>Welcome to Attendence System</title></head>
<style>
.header
{
	height: 90px; 
	background: #A9A9A9; 
	color: purple; 
	font-size: 40px; 
	border-radius: 0px 0px 20px 20px;  
	padding-top:20px;
	font-family: Monotype Cursiva;
}
.name
{
	margin-left: 1050px;
	font-size: 30px;
	border: 2px aqua solid;
	border-radius: 10px;
	display: inline-block;
	padding: 2px 5px;
	background: aqua;
	cursor: pointer;
}
.logout
{
	margin-left: 1210px;
	font-size: 25px;
	border: 2px violet solid;
	border-radius: 10px;
	display: none;
	padding: 2px 5px;
	background: violet;
	cursor: pointer;
}
td
{
	font-size: 25px;
	width: 400px;
}
</style>

<body bgcolor="azure" style="margin:0px;">
<div class="header">
<center>
	Welcome to Attendence System
</center>
<div class="name" onclick = "name();">
	<?php 
		$sname = $_SESSION['name']; 
		echo $sname;
	?>
</div>
<div id = "logout" class = "logout">
	<a href="logout.php">logout</a>
</div>
</div>

<div>
<br>
<center><h1><u>List of Students</u></h1>	</center>
	<table width="1200px" style = 'margin-left:100px; margin-top: 30px; border-color: violet; text-align:center;' border = "10">
		<tr><td style="background: #259885;"><b>Name</b></td>
			<td style="background: #259885;"><b>College</b></td>
			<td style="background: #259885;"><b>Registration No.</b></td>
			<td style="background: #259885;"><b>Semester</b></td>
			<td style="background: #259885;"><b>Phone Number</b></td>
			<td style="background: #259885;"><b>No.of Days Present</b></td>
		</tr>
		<?php
			$sql = "Select * from login";
			$result = $conn->query($sql);
			if($result->num_rows >0)
			{
				while($rows = $result->fetch_assoc())
				{
					$id = $rows['id'];
					$name = $rows['name'];
					$college = $rows['college'];
					$regd = $rows['registration'];
					$semester = $rows['semester'];
					$phone = $rows['phone'];
					$c=0;
					$asql = "Select * from attendence where lid = '$id'";
					$aresult = $conn->query($asql);
					$c = $aresult->num_rows;
					echo "	
							<tr>
							<td><a href = 'view.php?id=".$id."'>".$name."</a></td>
							<td>".$college."</td>
							<td>".$regd."</td>
							<td>".$semester."</td>
							<td>".$phone."</td>
							<td>".$c."</td>
							</tr>
					";
					
				}
			}
		?>
	</table>
</div>
</body>
</html>