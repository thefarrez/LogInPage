<?php


//skapar fram random salt
function randomSalt($length = 8) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}


//jämför med exiterande email i databasen
function email_exists($email, $con)
{
    $result = mysqli_query($con, "SELECT id FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}


//ger behörighet
function logged_in()
{   //det skulle bara räcka me session.
    if(isset($_SESSION['email']) || isset($_COOKIE['email']))
    {
        return true;
    }
    else
    {
        return false;
    }
}



?>