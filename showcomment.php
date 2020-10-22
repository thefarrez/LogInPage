<?php
require("connect2.php");
include("functions.php");

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

            <div class="commentshow">
            <div><h4> Användare : kommentar</h4></div>

    <?php
                require("connect2.php");
                $query= "SELECT* FROM kommentar";
                $result = mysqli_query($con, $query);

                while($row = mysqli_fetch_array($result)) 
                    {
                    $commentname= strtoupper($row  ["namn"]);
                    $comment=$row ["kommentar"]; 

                    echo "$commentname :  <i> $comment </i> <br>";
                }
                $con->close();
    }
    //icke inloggade användare skickas till loginpage
    else
    {
        header("location:login.php");
    }
    
    ?>
            </div>
        </div>
    </body>
</html>