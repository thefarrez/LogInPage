<?php
require("connect2.php");
include("functions.php");

if(logged_in())
{     
    header("location:comment.php");
    exit();
}

$error ="";
$sucess="";

if(isset($_POST['submit']))
{
    $firstname =mysqli_real_escape_string($con,$_POST['fname']);
    $lastname =mysqli_real_escape_string($con,$_POST['lname']);
    $email =mysqli_real_escape_string($con,$_POST['email']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    $passwordConfirm =mysqli_real_escape_string($con, $_POST['passwordConfirm']);
   

    //validation av input
   if(strlen($firstname)<3)
   {
       $error ="Förnamnet är för kort";
   }
   else if(strlen($lastname)<3)
   {
       $error ="Efternamnet är för kort";
   }
   else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
   {
       $error = "Vänligen uppge en giltig epost-adress";
   }
   //kalla funktionen emeilexists från functions
   else if(email_exists($email, $con))
   {
       $error = "Denna epost-adress är redan registrerad, Uppge en annan adress eller Logga in!";
   }
   else if(strlen($password)<6)
   {
       $error ="Lösenordet måste innehålla mer än 6 tecken";
   }
   else if ($password !==$passwordConfirm)
    {
        $error ="Lösenorden överensstämmer EJ, Försök igen!";
    }
    
    
    else
    {       //kallar på funktionen randomSalt
            $salt = randomSalt(20);
            $password = md5($password.$salt);

            $insertQuery ="INSERT INTO users (firstname, lastname, email, password, salt) VALUES ('$firstname', '$lastname', '$email', '$password', '$salt')";
            if( mysqli_query($con, $insertQuery))
            {
                $sucess ="Er registering har lyckats, ni kan nu logga in";
                header("refresh:4;url= login.php");
            }
            else
            {
                $error ="Registreringen misslyckades";
            }
            
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Registration </title>
        <link rel ="stylesheet" href="include/assets/css/style.css"/>
    </head>
   

    <body>

        <!--<div id="error"><?php echo $error ?></div>
        <div id="sucess"><?php echo $sucess ?></div>-->

     <div id="main">
        <div id="menu">
         <?php include("nav.php"); ?>
        </div>

        <div id="formDiv">
            <form name="vForm" method="POST" action="index.php" onsubmit = "return Validate()">
            
            <label>Förnamn</label><br/>
            <input type="text" name="fname" class="inputfield"/>
            <div id="fname_error"></div>
            
            <br/><label>Efternamn</label><br/>
            <input type="text" name="lname" class="inputfield" />
             <div id="lname_error"></div>
            
            <br/><label>Epost-adress</label><br/>
            <input type="email" name="email"class="inputfield" />
            <div id="email_error"></div>

            <br/><label>Lösenord</label><br/>
            <input type="password" name="password" class="inputfield" />
             <div id="password_error"></div>

            
            <br/><label>Bekräfta lösenord</label><br/>
            <input type="password" name="passwordConfirm" class="inputfield" />
            <div id="passwordc_error"></div>
            
             <br/><input type="submit" name="submit" value="Registrera" class ="buttom "/>
              <tr>
                <td><a href="login.php">Redan medlem?</a></td>
            </tr>
             <!--break (försökte med preline i css men det blve inte snyggt)-->
                 <script src="include/assets/js/java1.js"></script>
            </form>
         </div>
            <div id="error"><?php echo $error ?></div>
            <div id="sucess"><?php echo $sucess ?></div>
      </div>
    </body>
</html>