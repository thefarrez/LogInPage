<?php

require("connect2.php");
include("functions.php");

if(logged_in())
{
    echo "you're logged in!";
?>
    <a href="comment.php">Leave a comment</a>
    <?php header("location:comment.php"); ?>

<?php
}
else
{   //andrat till loggin
    header("location:login.php");
    exit();//slutar här förhindrar att gå in i profile utan inloggning.
}
?>