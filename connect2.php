<?php
$con = mysqli_connect("dbtrain.im.uu.se", "dbtrain_537","etlqhy", "dbtrain_537");

if(mysqli_connect_error())
{
    echo"Ett fel har uppstått".mysqli_connect_error();
}
 if (!session_id()) session_start(); //används då conc anropas ska vara på sen.
?>