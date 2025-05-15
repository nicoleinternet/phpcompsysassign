<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="description" content="CLAM Careers - Your Gateway to the Future of IT">
    <meta name="keywords" content="IT Careers, Cyber Security, CLAM, Web, Australia, Future Tech">
    <meta name="author" content="Arvin Zia">
    <title>CLAM Careers - Login</title>
    <link rel="stylesheet" href="../styles/style.css">
    <!-- TO ADD INTO CSS LATER NICOLE -->
    <style>
        .error {
            color: rgb(213, 13, 13);
            font-size:1em;
            font-weight:600;
            /*display: flex;*/
        }
        .submission {
            text-align: center;
        }
    </style>
</head>
<body>


<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'settings.php';
include 'functionsite.php';
$conn = new mysqli($host, $user, $password, $database);
session_start();
$nameErr = $emailErr = $formErr = $passErr = "";
$username = $password = $email = "";
$fields = ['username', 'email', 'password'];
$okayToTransact = False;
// Check for POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


// Check required fields
    if (!is_array_set($fields)) {
        $passErr = "Fields are missing";
        if (!isset($_POST['username']) || empty($_POST['username'])) {
            $nameErr = "Username is required";
        }
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            $emailErr = "Email is required";
        }
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            $passErr = "Password is required";
        }
    }


    if (isValidSignUpEmail($email, $conn)) {
        $okayToTransact = False;
        $emailErr = "Email is already in use";
    } else {
        $username = test_input($_POST["username"]);
        $email = test_input($_POST["email"]);
        $password = test_input($_POST["password"]);
        $okayToTransact = True;
    }


    $nameErr = $username;
    $emailErr = $email;
    $passErr = $password;


    if ($okayToTransact) {
        if ($stmt = $conn->prepare("INSERT INTO userdata (username, email_address, password) VALUES (?, ?, ?)")) {
            $password_hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("sss", $username, $email, $password_hashed);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $formErr = "";
                    $formErr = "Registration Successful!";
                } else {
                    $formErr = "";
                    $formErr = "Nothing was inserted.";
                }
            } else {
                $formErr = "Execute failed: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $formErr = "Prepare failed: " . $conn->error;
        }

        $conn->close();
    }
}
?>
<header>
    <a href="index.html">
        <img src="../images/logo.png" alt="CLAM Logo" width="100"> <!-- Path changed. Moved all images to corresponding image folder - Cale -->
    </a>
    <h1>Welcome to CLAM Careers</h1>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="jobs.html">Jobs</a></li>
            <li><a href="apply.html">Apply</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="enhancements.html">Enhancements</a></li>
            <li><a href="mailto:105907067@student.swin.edu.au">Contact Us</a></li> <!-- Changed to "Contact Us" rather than "Contact" - Cale -->
        </ul>
    </nav>
</header>


<main>
    <section id="hero">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate="novalidate" class="submission">
            <h2>REGISTER</h2>
            <label for="username"><h4 class="hero-subtext">Username</h4></label>
            <input type="text" placeholder="Enter Username" name="username" required>
            <p class="error"><?php echo $nameErr;?></p>

            <label for="email"><h4 class="hero-subtext">Email Address</h4></label>
            <input type="email" placeholder="Enter Email Address" name="email" required>
            <p class="error"><?php echo $emailErr;?></p>

            <label for="password"><h4 class="hero-subtext">Password</h4></label>
            <input type="password" name="password" placeholder="Enter Password" required>
            <p class="error"><?php echo $passErr;?></p>

            <button type="submit" class="video-link">Submit</button>
            <p class="error"><?php echo $formErr;?></p>

        </form>
    </section>
</main>

</body>
</html>