<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : login.php
// Description: This is the login page for the site, and will query the database against the PHP password hash
// using password_verify(). This means any account within the database needs to be created using PHP, as the MySQL
// password hash is different. After a successful login, a session will be created against the user.
-->
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="CLAM Careers - Your Gateway to the Future of IT">
  <meta name="keywords" content="IT Careers, Cyber Security, CLAM, Web, Australia, Future Tech">
  <meta name="author" content="Arvin Zia">
  <title>CLAM Careers - Login</title>
  <link rel="stylesheet" href="../styles/style.css">
  <style>

    </style>
</head>


<?php
include 'settings.php';
include 'functionsite.php';
include 'menu.inc.php';
//https://github.com/ircmaxell/password_compat/blob/master/lib/password.php
include 'password.php';
//create a new mySQLi connection
$conn = new mysqli($host, $user, $password, $database);
// Check for POST
session_start();

$nameErr = $passErr = $websiteErr = $formErr = "";
$readyToTransact = False;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!isset($_POST['username']) || !isset($_POST['password']) || empty($_POST['password']) || empty($_POST['username']) ) {
    $nameErr = "* Name is required";
    $passErr = "* Password is required";

    } else {
        $readyToTransact = True;
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    }

 };


// Prepare SQLi query!
// This is safer that a static query
if ($stmt = $conn->prepare("SELECT id, password FROM userdata WHERE username = ?")) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();
    if (password_verify($password, $hashedPassword)) {
        // create session variables
        session_regenerate_id(true);
        $_SESSION['account_loggedin'] = TRUE;
        $_SESSION['account_name'] = $_POST['username'];
        $_SESSION['user_id'] = $userId;
        //
        echo 'Welcome ' . htmlspecialchars($_SESSION['account_name'], ENT_QUOTES, 'UTF-8') . '!';
        header("location: manage.php");
    }
    }
    $stmt->close();
} else {
    $formErr = "Error preparing statement: " . $conn->error . "";
    //header("location: login.php");

}
$conn->close();

draw_headerhtml("Login");

?>

<body>
<main>
    <section id="hero">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate="novalidate" class="submission">
            <h2>Login</h2>
                <label for="username"><h4 class="hero-subtext">Username</h4></label>
                <input type="text" placeholder="Enter Username" name="username" required>
                <p class="error"><?php echo $nameErr;?></p>

                <label for="password"><h4 class="hero-subtext">Password</h4></label>
                <input type="password" name="password" placeholder="Enter Password" required>
                <p class="error"><?php echo $passErr;?></p>

                <button type="submit" class="video-link">Submit</button>
                <p class="error"><?php echo $formErr;?></p>

        </form>
    </section>
</main>
<?php draw_footerhtml(); ?>
</body>
</html>