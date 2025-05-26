<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : login.php
// Description: This is the login page for the site, and will query the database against the PHP password hash
// using password_verify(). This means any account within the database needs to be created using PHP, as the MySQL
// password hash is different. After a successful login, a session will be created against the user.
-->
<!DOCTYPE html>
<html lang="en">
<?php
include 'menu.inc.php';
draw_headerhtml("Login");
include 'settings.php';
include 'functionsite.php';
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



?>

<body>
<main>
    <section id="hero">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate="novalidate" class="submission">
            <h2>Login</h2>
                <label for="username" class="hero-subtext">Username</label>
                <input type="text" placeholder="Enter Username" id="username" name="username" required>
                <p class="error"><?php echo $nameErr;?></p>

                <label for="password" class="hero-subtext">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
                <p class="error"><?php echo $passErr;?></p>

                <button type="submit" class="video-link">Submit</button>
                <p class="error"><?php echo $formErr;?></p>
                <span class="error"><a href="register.php">Register</a></span>

        </form>

    </section>
    <section class="eoiresult">
    <h2>Video on Enhancments</h2>
<iframe src="https://liveswinburneeduau-my.sharepoint.com/personal/100589839_student_swin_edu_au/_layouts/15/embed.aspx?UniqueId=a5090c75-9b3d-4c1d-a766-1115d4bee979&embed=%7B%22af%22%3Atrue%2C%22ust%22%3Atrue%7D&referrer=StreamWebApp&referrerScenario=EmbedDialog.Create" width="640" height="360" frameborder="0" scrolling="no" allowfullscreen title="2025-05-22 17-01-17.mp4"></iframe>
</section>
</main>

<?php draw_footerhtml(); ?>
</body>
</html>