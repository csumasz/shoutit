<?php
    require_once("database.php");
    $sql="SELECT * FROM shouts ORDER BY time DESC LIMIT 8";
    $shouts=mysqli_query($conn, $sql);

    if(isset($_POST["submit"])){
        $user=mysqli_real_escape_string($conn, $_POST["user"]);
        $message=mysqli_real_escape_string($conn, $_POST["message"]);

        date_default_timezone_set("Europe/Brussels");
        $time=date("H:i:s a", time());
        if( !isset($user) || $user=="" || !isset($message) || $message==""){
            $error="Please fill your name and a message!";
            header("location:test.php?error=" . urlencode($error));
            exit;
        }else{
            $query="INSERT INTO shouts (user, message, time)
            VALUES ('$user', '$message', '$time')";
            if(!mysqli_query($conn, $query)){
                die("Error:" . mysqli_error($conn));
            }else{
                header("location:test.php");
                exit;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shout It</title>
    <link rel="stylesheet" href="css/test.css">
</head>
<body>
    <div id="container">
        <header>
            <h1>Shout It!</h1>
        </header>
        <div id="shouts">
            <ul>
                <?php foreach($shouts as $shout) :?>
                    <li class="shout"><?php echo $shout["time"]?>- <strong><?php echo $shout["user"]?>:</strong> <?php echo $shout["message"]?> </li>
                <?php endforeach?>
            </ul>
        </div>
        <div id="inputs">
            <div id="error">
                <?php if(isset($_GET["error"])) :?>
                    <span><?php echo $_GET["error"];?></span>
                <?php endif ?>
            </div>
            <form action="test.php" method="post">
                <input type="text" name="user" placeholder="Enter your name">
                <input type="text" name="message" placeholder="Enter your message">
                <input type="submit" name="submit" value="Shout It Out">
            </form>
        </div>
    </div>
    
</body>
</html>