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
?>

<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$mail = new PHPMailer(true);         

if(isset($_POST['submit'])){

try {
    //Server settings
    $mail->SMTPDebug = 1;                               
    $mail->isSMTP();                                     
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'sioraneti@gmail.com';               
    $mail->Password = 'Sioranetihj30';                           
    $mail->SMTPSecure = 'tls';                            
    $mail->Port = 587;                                 

    //Recipients
    $rec = $_POST['rec'];

    $mail->setFrom('sioraneti@gmail.com', 'Mailer');
    $mail->addAddress($rec, 'Joe User');   

    //Content
    $mail->isHTML(true);                                
    $mail->Subject = 'This is a test mail';
    $var = '5';

    $stmt = $conn->query('SELECT id FROM users WHERE email=\'' . $_POST['rec'] . '\';');
    $user = $stmt->fetch();
    print_r($user);

    $mail->Body    = '<a href="http://localhost/phpmailer/index.php?id='.$user['0'].'">Cliquez ici</a>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

}

    $stmt = $conn->query("SELECT id FROM users WHERE id=11");
    $user = $stmt->fetch();
    $pl =  $user['id'];

    

    if(isset($_GET['id'])){
        if($pl   ==  $_GET['id']){
            echo 'reussite';

            //  $sql = "INSERT INTO users (name) VALUES ('Doe')";
            //  $conn->prepare($sql)->execute($data);

        }else{
            echo 'echoue';
        }
    }


?>


 <!-- <p>Bonjour <?php echo $_GET['id']; ?> !</p>  -->


<form action="index.php" method="post">
    <input type="email" name="rec" placeholder="Here your mail">
    <input type="submit" value="Send" name="submit">
</form>
