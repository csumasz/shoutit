<?php
    require_once("database.php");
    if(isset($_POST["submit"])){
        $user = mysqli_real_escape_string($conn, $_POST["user"]);
        $message = mysqli_real_escape_string($conn, $_POST["message"]);

        date_default_timezone_set("Europe/Brussels");
        $time = date("H:i:s a", time());

        if(!isset($user) or $user == "" or !isset($message) or $message == ""){
            $error = "Please fill in your name and a message!";
            header("location:index.php?error=" . urlencode($error));
            exit;
        }else{  
            $query = "INSERT INTO shouts (user, message, time)
                    VALUES ('$user', '$message', '$time')";
            if(!mysqli_query($conn, $query)){
                die("Error:" . mysqli_error($conn));
            }else{
                header("location:index.php");
                exit;
            }
        }
    }
?>