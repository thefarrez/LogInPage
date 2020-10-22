<?php
require("connect2.php");
include("functions.php");

if(logged_in())
{
    header("location:profile.php");
    header("location:comment.php");
    exit();//slutar här
}

$succes="";
$error = "";

if(isset($_POST['submit']))
{
        $email =mysqli_real_escape_string($con,$_POST['email']);
        $password =mysqli_real_escape_string($con,$_POST['password']);
        
        $result2 = mysqli_query($con,"SELECT salt FROM users WHERE email = '$email'");
        $salta = mysqli_fetch_assoc($result2);
        $salt = $salta['salt'];
        $password= md5($password.$salt);
        
        $checkbox= isset($_POST['keep']);

if(email_exists($email, $con))
{

        $result = mysqli_query($con, "SELECT password FROM users WHERE email = '$email'");
        $returnpassword = mysqli_fetch_assoc($result);
        $passwordreturn= $returnpassword['password'];

        if(($password)!== $passwordreturn)
        {
            $error = "Lösenordet är felaktigt!!";
        }
        else
        {

            $result3 = mysqli_query($con,"SELECT firstname FROM users WHERE email = '$email'");
            $get = mysqli_fetch_assoc($result3);
            $fname = $get['firstname'];
            $_SESSION['firstname'] =$fname;

            $_SESSION['email'] =$email;//loggas in

            if($checkbox == "on")
            {
                setcookie("email", $email, time()+7200);//nyckel och värdet.efter två timmar går cookiet ut
                
            }

            $succes= "Välkommen! Nu är du inloggad";
            header("refresh:3;url= comment.php");
            // header ("location: comment.php");
           
        }
}
    else
    {
        $error = "Denna epost-adress är inte registrerad, Du skickas nu till registreringen!";
         header("refresh:4;url=index.php");
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title> Logg in sidan </title>
        <link rel ="stylesheet" href="include/assets/css/style.css"/>
    </head>

        <body>


     <div id="main">
       
            <div id="menu">
                <?php include("nav.php"); ?>
            </div>
            
                
            <div id="formDiv">
                
                <form  name="vForm" method="POST" action="login.php"  onsubmit = "return Validate()">
            
                    <label>Epost</label><br/>
                    <input type="text" name="email" class="inputfield"/>
                    <div id="email_error"></div>

                    <br/><label>Lösenord</label><br/>
                    <input type="password" name="password" class="inputfield" />
                    <div id="password_error"></div>

                    <br/><input type ="checkbox" name="keep"/>
                    <label>Kom ihåg mig</label><br/>

                    <input type="submit" name="submit" value="Logga in" class ="buttom"/>
                    <tr>
                        <br><td><a class="reglink" href="index.php">Inte medlem än?</a></td>
                    </tr>
                    <script src="include/assets/js/java2.js"></script>
                </form>
                
            </div>
            <div id="sucess"><?php echo $succes ?></div>
            <div id="error"><?php echo $error ?></div>
      </div>
    </body>
</html>