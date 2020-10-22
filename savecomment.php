<?php
 require("connect2.php");
        
$message="";
if(isset($_POST['kommentar'])){

    //isset($_POST['namn']) && isset($_POST['email']) &&
    // $namn =mysqli_real_escape_string($con,$_POST['namn']);
    // $email =mysqli_real_escape_string($con,$_POST['email']);
    $kommentar = mysqli_real_escape_string($con, $_POST['kommentar']);
    
//      if(strlen($namn)<3)
//    {
//     //    session_start();
//     //    $_SESSION['message'] = "name misses";
//        echo " Skriv för- och efternamn";
//        header("refresh:3;url=comment.php");
//    }
//    else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
//    {
//        echo "Vänligen ange en giltig epost";
//        header("refresh:3;url=comment.php");

//    }
    
    if ($kommentar=="")
   {
       echo "Vänligen fyll i kommentarsfälte";
   }

        else
        {
            $sql = "INSERT INTO kommentar (namn,email, kommentar) VALUES ('" . $_SESSION['firstname'] . "','" . $_SESSION['email'] . " ',' " . $kommentar . "')";
           

            if( mysqli_query($con, $sql))
        {
            $message= "Tack för din kommentar";
             header("location:showcomment.php");
        }
        else
        {
            $message= "Din kommentar innehåller felaktiga värden, Försök igen!";
            // header("refresh:4;url=comment.php");
        }


        }
        // header("refresh:4;url= showcomment.php");
    
}

?>
<!--<div id="sucess"><?php echo $message ?></div>-->



