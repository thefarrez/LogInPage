<?php
 require("connect2.php");
 include("functions.php");
 include("savecomment.php");
//bara inloggade användare kan kommentera 
if(logged_in())
 {
?>

<!DOCTYPE html>
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

                <form name="vForm" method="POST" action="savecomment.php" onsubmit = "return Validate()">
                 <h2> Vänligen lämna en kommentar </h2>
                  
                    <!--<label for="Name">Förnamn och Efternamn *<label>
                    <input name= "namn" id="namn" type="text" class="inputfield" /><br/>
                    <div id="namn_error"></div>

                    <label for="Email"> Epost *<label>
                    <input name= "email" id="email" type="text" class="inputfield" /><br/>
                    <div id="email_error"></div>required="required"-->
                    
                    <label for="subject"> Skriv om ett ämne <label>
                    <textarea name="kommentar" id="kommentar" cols="45" rows="8"  placeholder="Vad har du på hjärtat?" class="commentfielt"/></textarea>
                    <div id="kommentar_error"></div><br/>
                   
                    <input name="register" type="submit" class="buttom" value="Spara kommentaren"/>
                    <!--<P>Fält markerade med * är obligatoriska och måste fyllas i.</P>-->
                    
                    <script src="include/assets/js/java.js"></script>
                 
                </form>
        </div>
        
    <?php
            
 }

    else
    {
        header("location:login.php");
    }
  
    ?>
     </div>
    </body>
</html>
