<?php
$conn = mysqli_connect("localhost", "root", "", "shoutit");

if(!$conn){
    echo("Failed to connect to Database:" . mysqli_connect_error());
}
?>