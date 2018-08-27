<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$servername;dbname=mailer", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }


    $stmt = $conn->query('SELECT id FROM users WHERE name=\'' . $_POST['rec'] . '\';');
    $user = $stmt->fetch();
    var_dump($user,'----');
?>


<form action="test.php" method="post">
    <input type="text" name="rec" placeholder="Here your mail">
    <input type="submit" value="Send" name="submit">
</form>
