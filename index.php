<?php
	session_start();
	$conn = new mysqli("localhost", "root", "", "project");
	if(isset($_POST['student']))
	{
		$name = $_POST['name'];
		$college = $_POST['college'];
		$regdno = $_POST['regdno'];
		$semester = $_POST['semester'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		if($name == "" || $college == "" || $regdno == "" || $semester == "" || $phone == "" || $password == "" || $cpassword == "")
		{
			echo "<script>alert('Error Occurred');</script>";
		}
		else
		{
			if($password == $cpassword)
			{
				$sql = "Insert into login(name, college, registration, semester, phone, password) values('$name', '$college', '$regdno', '$semester', '$phone', '$password')";
				if ($conn->query($sql) === TRUE) {
					echo "<script>alert('Student record Inserted');</script>";
				} else {
					echo "<script>alert('Error Occurred');</script>";
				}
			}
			else
			{
				echo "<script>alert('Password doesn`t match');</script>";
			}
		}
	}
	if(isset($_POST['admin']))
	{
		$name = $_POST['name'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];
		if($name == "" || $phone == "" || $password == "" || $cpassword == "")
		{
			echo "<script>alert('Error Occurred');</script>";
		}
		else
		{
			if($password == $cpassword)
			{
				$sql = "Insert into admin(name, phone, password) values('$name', '$phone', '$password')";
				if ($conn->query($sql) === TRUE) {
					echo "<script>alert('Admin record Inserted');</script>";
				} else {
					echo "<script>alert('Error Occurred');</script>";
				}
			}
			else
			{
				echo "<script>alert('Password doesn`t match');</script>";
			}
		}
	}
	if(isset($_POST['login']))
	{
		$phone = $_POST['lphone'];
		$pass = $_POST['lpass'];
		$role = "";
		if(isset($_POST['role']))
		{
			$role = $_POST['role'];
		}
		else
		{
			echo "<script>alert('Error');</script>";
		}
		if($role == 'student')
		{
			$sql = "Select * from login where phone = '$phone' and password = '$pass'";
			$result = $conn->query($sql);
			if($result->num_rows== 1)
			{
				while($rows = $result->fetch_assoc())
				{
					$id = $rows['id'];
					$name = $rows['name'];
					$_SESSION['id'] = $id;
					$_SESSION['name'] = $name;
					echo "<script>alert('success');</script>";
					header("Location: view.php");
				}
			} else {
				echo "<script>alert('Error Occurred');</script>";
			}
		}
		if($role == 'admin')
		{
			$sql = "Select * from admin where phone = '$phone' and password = '$pass'";
			$result = $conn->query($sql);
			if($result->num_rows== 1)
			{
				while($rows = $result->fetch_assoc())
				{
					$name = $rows['name'];
					$_SESSION['name'] = $name;
					echo "<script>alert('success');</script>";
					header("Location: adminview.php");
				}
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
	height: 80px; 
	background: #A9A9A9; 
	color: purple; 
	font-size: 50px; 
	border-radius: 0px 0px 20px 20px;  
	padding-top:20px;
	font-family: Monotype Cursiva;
}
.frame
{
	margin: 80px  350px;
}
.login
{
	background: azure;
	border: 5px #2F4F4F solid; 
	width: 500px; 
	height: 330px; 
	padding: 30px;
	padding-top: 10px;
	border-radius:40px;
	font-size: 30px;
}
.register
{
	background: azure;
	border: 5px #2F4F4F solid; 
	width: 500px; 
	height: 430px; 
	padding: 30px;
	padding-top: 10px;
	border-radius:40px;
	font-size: 30px;
	display:none;
	float: left;
}
td
{
	width: 200px;
	font-size: 30px;
}
.textbox
{
	width: 250px; 
	font-size:20px; 
	border-radius: 10px;
}
.button
{
	
	font-size:20px; 
	border-radius: 10px;
}

</style>
<body background="0.jpg" style="margin:0px;">
<div class="header">
<center>
	Welcome to Attendence System
</center>
</div>
 	<div class = "frame">
 		<div style="float: left;">
		 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 </div>
		<div id = "login" class="login" style="float: left;">
			<center><h3><u>LOGIN</u></h3></center>
			<form method ="post">
			<table>
				<tr>
					<td>Phone Number</td>
					<td><input type = "text" name = "lphone" class="textbox"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type = "password" name = "lpass" class="textbox"></td>
				</tr>
				<tr>
					<td>Role</td>
					<td style="width: 240px;"><input type = "radio" name = "role" value = "student"> student
								<input type = "radio" name = "role" value = "admin"> admin
					</td>
				</tr>
				<tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr>
				<tr>
					<td colspan = "2">
						<center><input type = "submit" name = "login" class = "button"></center>
					</td>
				</tr>
				<tr><td> </td></tr>
			</table>
			</form>
			Not Yet Registered? <a onclick="studentregister();" style="color:blue; cursor:pointer;">Create one!</a>
		</div>
		<div id = "studentregister" class = "register">
			<h3><img src = "1.png" width="50px;" onclick="login();" style="cursor:pointer">&emsp;<u>STUDENT REGISTER</u></h3>
			<form method="post">
			<table>
				<tr>
					<td>Name</td>
					<td><input type = "text" name = "name" class="textbox"></td>
				</tr>
				<tr>
					<td>College`s Name</td>
					<td><input type = "text" name = "college" class="textbox"></td>
				</tr>
				<tr>
					<td>Registration No.</td>
					<td><input type = "text" name = "regdno" class="textbox"></td>
				</tr>
				<tr>
					<td>Semester</td>
					<td><input type = "text" name = "semester" class="textbox"></td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td><input type = "text" name = "phone" class="textbox"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type = "password" name = "password" class="textbox"></td>
				</tr>
				<tr>
					<td style="width:240px;">Confirm Password</td>
					<td style="width:260px;"><input type = "password" name = "cpassword" class="textbox"></td>
				</tr>
				<tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr>
				<tr>
					<td colspan = "2">
						<center><input type = "submit" name = "student" class = "button"></center>
					</td>
				</tr>
				<tr><td> </td></tr>
			</table>
			</form>
		</div>
		<div id = "adminscroll" style="float: left; display: none;">
		 	<img src = "right.png" width = "30px" height = "70px" style="margin-top: 140px; cursor: pointer;" onmouseover="this.src='rightactive.png'" onmouseout="this.src='right.png'" onclick = "adminregister();">
		</div>
		<div id = "studentscroll" style="float: left; display: none;">
		 	<img src = "left.png" width = "30px" height = "70px" style="margin-top: 140px; cursor: pointer;" onmouseover="this.src='leftactive.png'" onmouseout="this.src='left.png'" onclick = "studentregister();">
		</div>
		<div id = "adminregister" class = "register" style = "height:320px">
			<h3><img src = "1.png" width="50px;" onclick="login();" style="cursor:pointer">&emsp;&emsp;&nbsp;<u>ADMIN REGISTER</u></h3>
			<form method="post">
			<table>
				<tr>
					<td>Name</td>
					<td><input type = "text" name = "name" class="textbox"></td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td><input type = "text" name = "phone" class="textbox"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type = "password" name = "password" class="textbox"></td>
				</tr>
				<tr>
					<td style="width:240px;">Confirm Password</td>
					<td style="width:260px;"><input type = "password" name = "cpassword" class="textbox"></td>
				</tr>
				<tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr><tr><td> </td></tr>
				<tr>
					<td colspan = "2">
						<center><input type = "submit" name = "admin" class = "button"></center>
					</td>
				</tr>
				<tr><td> </td></tr>
			</table>
			</form>
		</div>
	</div>
	
	
 	
</body>
<script>
	function studentregister()
	{
		document.getElementById("studentregister").style.display = "block";
		document.getElementById("adminscroll").style.display = "block";
		document.getElementById("login").style.display = "none";
		document.getElementById("adminregister").style.display = "none";
		document.getElementById("studentscroll").style.display = "none";
	}
	function login()
	{
		document.getElementById("login").style.display = "block";
		document.getElementById("studentregister").style.display = "none";
		document.getElementById("adminscroll").style.display = "none";
		document.getElementById("adminregister").style.display = "none";
		document.getElementById("studentscroll").style.display = "none";
	}
	function adminregister()
	{
		document.getElementById("adminregister").style.display = "block";
		document.getElementById("studentscroll").style.display = "block";
		document.getElementById("login").style.display = "none";
		document.getElementById("studentregister").style.display = "none";
		document.getElementById("adminscroll").style.display = "none";
	}
</script>
</html>