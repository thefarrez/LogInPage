<?php 

	require("connect2.php");
	include("functions.php");
	
	$error = "";
	$sucess="";
	
	if(isset($_POST['savep']))
	{
		$password = $_POST['password'];
		$confirmPassw = $_POST['passwordConfirm'];
		
		if(strlen($password) < 6)
		{
			$error = "Lösenordet måste innehålla mer än 6 tecken";
		}
		else if($password !== $confirmPassw)
		{
			$error = "Lösenorden överensstämmer Ej, Försök igen";
		}
		else
		{
			$salt = randomSalt(20);
        	$password = md5($password.$salt);
			
			$email = $_SESSION['email'];
			if(mysqli_query($con, "UPDATE users SET password='$password', salt='$salt' WHERE email='$email'"))
			{
				$sucess = "Lösenordet har ändrats";
			}
			
		}
	}
	//bara inloggade personer ska ha access till denna funktion
	if(logged_in())
	{
		
		
	?>
	<html>
		<head>
			 <link rel ="stylesheet" href="include/assets/css/style.css"/>
		</head>
			<body>

			<div id="main">
				<div id="menu">
					<?php include("navinloggad.php"); ?>
				</div>

				<div id="formDiv">
				<form method="POST" action="changepassword.php">
					<label>Nytt lösenord</label><br/>
					<input type="password" name="password" class="inputfield"/><br/><br/>

					<label>Bekräfta lösenord</label><br/>
					<input type="password" name="passwordConfirm" class="inputfield" /><br/><br/>

					<input type="submit" name="savep" value="Spara lösenord " class="buttom"/>
				</form>
					</div>
				<div id="error"><?php echo $error ?></div>
				<div id="sucess"><?php echo $sucess ?></div>
			</div>
		</body>
	</html>


	<?php	    
	}
    //icke inloggade hänvisas till login sidan
    else
	{   
		header("location: login.php");
	}
	
?>