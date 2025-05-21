<!--
// Unit/Assignment: COS10032 Comp Systems Project Assignment 3
// Author: Nicole Reichert
// Name : register.php
// Description: This is the register page to create an account to manage the EOIs and access via the login
// page as part of an enhancement to the Assignment. It will check for valid email addresses via the
// include at functionsite.php and perform a hash to then insert into the userdata table.
-->

<!DOCTYPE html>
<html lang='en'>




<?php
// Author: Nicole Reichert (100589839) for COS10032 Comp. Systems Project
// Assignment 2, PHP Forms (EOI). Team: Arvin Z, Matt C, Lachlan, Cale, Nicole
include 'settings.php';
include 'functionsite.php';
include 'menu.inc.php';
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


draw_headerhtml("Register Account");
?>


<body>

<main>
    <section id="hero">

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" novalidate="novalidate" class="submission">
            <h2>Register</h2>
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
<?php draw_footerhtml(); ?>
</body>
</html>