<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "project");
	if(!isset($_SESSION['name']))
	{
		header("location : index.php");
	}
	else
	{
		if(isset($_SESSION['id']))
		{
			$id = $_SESSION['id'];
		}
	}
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
	}
	if(isset($_POST['add']))
	{
		$date = date('Y-m-d', time());
		$ssql = "Select * from attendence where date = '$date' and lid = '$id'";
		$sresult = $conn->query($ssql);
		if($sresult->num_rows > 0)
		{
			echo "<script>alert('Today`s attendence already inserted.');</script>";
		}
		else
		{
			$insql = "Insert into attendence(lid, date, status) values('$id', '$date', 'PRESENT')";
			if ($conn->query($insql) === TRUE) {
				echo "<script>alert('Attendence record Inserted');</script>";
			} else {
				echo "<script>alert('Error Occurred');</script>";
			}
		}
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
.button
{
	background: pink;
	padding: 5px 15px;
	font-size: 25px;
	border-radius: 40px 0px;
	cursor: pointer;
	border-width: 0px;
}
#add
{
	margin: 120px 220px;
	background: #538893;
	font-size: 30px;
	border-radius: 40px;
	padding: 50px 80px 50px 100px;
}
#view
{
	display: none;
	margin: 120px 220px;
	background: #538893;
	font-size: 30px;
	border-radius: 40px;
	padding: 20px 50px;
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
	<table width="800px" style = 'margin-left:200px; margin-top: 30px; border-color: violet;' border = "10">
		<?php
			$sql = "Select * from login where id = '$id'";
			$result = $conn->query($sql);
			if($result->num_rows== 1)
			{
				while($rows = $result->fetch_assoc())
				{
					$name = $rows['name'];
					$college = $rows['college'];
					$regd = $rows['registration'];
					$semester = $rows['semester'];
					$phone = $rows['phone'];
					echo "	<tr><td>Name</td>
							<td>".$name."</td></tr><tr>
							<td>College</td>
							<td>".$college."</td></tr><tr>
							<td>Registration No.</td>
							<td>".$regd."</td></tr><tr>
							<td>Semester</td>
							<td>".$semester."</td></tr><tr>
							<td>Phone Number</td>
							<td>".$phone."</td></tr>
					";
					
				}
			}
		?>
	</table>
</div>
<div style="margin-top: 50px; margin-left: 350px; float: left;">
	<button class = "button" onclick="add();">Add Attendence</button>
	<button class = "button" style="margin-left: 80px;" onclick="view();">View Attendence</button>
</div>
<div id = "add">
	<br>
	"Please click on the Add button, if you are present."
	<br><br>
	<center>
		<form method = "post">
			<button name = "add" style="background: pink;padding: 5px 15px;font-size: 25px;cursor: pointer;border-width: 0px; border-radius: 20px;">
			Add
			</button>
		</form>
	</center>
</div>
<div id = "view">
	<table width="800px" style = 'border-color: violet;' border = "10">
		<tr>
			<td>Sl.No.</td>
			<td>Date</td>
			<td>Status</td>
		</tr>
		<?php
			$c = 0;
			$sql = "Select * from attendence where lid = '$id' ORDER BY date ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0)
			{
				while($rows = $result->fetch_assoc())
				{
					$dt = $rows['date'];
					$date = date("d-m-Y", strtotime($dt));
					$status = $rows['status'];
					$c++;
					echo "	<tr>
								<td>".$c."</td>
								<td>".$date."</td>
								<td>".$status."</td>
							</tr>
					";
					
				}
				echo "Total no. of days present = ".$c;
			}
		?>
	</table>
</div>
</body>
<script>
	function name()
	{
		if(document.getElementById('logout').style.display == 'none')
		{
			document.getElementById('logout').style.display = 'inline-block';
		}
		else
		{
			document.getElementById('logout').style.display = 'none';
		}
	}
	function add()
	{
		document.getElementById('view').style.display = 'none';
		document.getElementById('add').style.display = 'block';
	}
	function view()
	{
		document.getElementById('add').style.display = 'none';
		document.getElementById('view').style.display = 'block';
	}

</script>
</html>