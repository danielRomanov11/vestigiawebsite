<?php
session_start();
include "dbconnect.php";
$email = $password = "";
$email_err = $password_err = "";
$error = false; 
$error_msg = "";

if (isset($_POST['submit'])){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (isset($_POST['remember']))
        $remember = $_POST['remember'];
   
    // validate fields

    if ($email == ""){
        $email_err = "Email is mandatory";
        $error = true;
    }

    if ($password == ""){
        $password_err = "Password is mandatory";
        $error = true;
    }

     // all validations passed
     if (!$error){

        $sql = "SELECT * FROM users WHERE email = ?";
        try{
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $stored_password = $row['password'];
                if (password_verify($password, $stored_password)){
                    // login successful
                    if (isset($_POST['remember'])){
                        setcookie("remember_email", $email, time()+365*24*3600, "/");
                        setcookie("remember", $remember, time()+365*24*3600, "/");
                        setcookie("username", $row['name'], time()+365*24*3600, "/");
                    } else {
                        setcookie("remember_email", "", time() - 3600, "/");
                        setcookie("remember", "", time() - 3600, "/");
                    }
                    $_SESSION['username'] = $row['name']; // Ensure session is set
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['member_since'] = $row['member_since'];
                    header("Location: index.php");
                    exit();
                } else {
                    $error_msg = "Incorrect Password";
                }
            } else {
                $error_msg = "Email id not registered";
            }
        } catch(Exception $e){
            $error_msg = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Vestigia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="images/vestigiaLogo.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <style>
    :root {
    --dark-color: #262626;  /* Dark Background */
    --main-color: #861818;  /* Main Red Color */
    --highlight-color: #ffd700; /* New Gold highlight */
    --light-color: #f5f5f5; /* Light gray text */
    --error-color: red; /* Error color */
}

*{
    margin: 0;
    padding: 0;
    font-family: 'Open Sans', sans-serif; /* Apply Open Sans font */
}

html{
    color: var(--light-color);
    text-align: center;
}
body{
    min-height: 100vh;
    background-image: url(images/signupBackground.jpg);
    background-size: cover;
    background-position: right;
    overflow: hidden;
}
.wrapper{
    box-sizing: border-box;
    background-color: #262626;
    min-height: 100vh; /* Adjusted height */
    width: 60%; /* Adjusted width */
    padding: 40px; /* Increased padding */
    border-radius: 20px; /* Adjusted border radius */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between; /* Ensure content is spaced out */
    transform: scale(1); /* Reset scale */
    margin: auto; /* Center the wrapper */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); /* Center the wrapper */
    text-align: center; /* Ensure text is centered */
}

form{
    width: min(400px, 100%);
    margin-top: 5px; /* Further reduced margin */
    margin-bottom: 5px; /* Further reduced margin */
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px; /* Further reduced gap */
}

form > div{
    width: 100%;
    display: flex;
    justify-content: center;
}

form input{
    border-radius: 10px;
    padding: 0.5em; /* Further reduced padding */
    border: 2px solid transparent; /* Set initial border to transparent */
    background-color: var(--main-color);
    color: var(--highlight-color);
    width: 100%;
    box-sizing: border-box;
    transition: background-color 150ms ease, border-color 150ms ease; /* Transition only background-color and border-color */
}

form input::placeholder {
    color: var(--highlight-color); /* Set placeholder text color to highlight color */
}

form input:hover::placeholder {
    color: var(--main-color); /* Change placeholder text color to main color on hover */
}

.logo{
    width: 250px; /* Set a fixed width */
    height: 250px; /* Set a fixed height */
    object-fit: contain; /* Ensure the image fits within the container without stretching */
    margin-bottom: -75px;
    margin-top: -50px;
}

form input:hover{
    background-color: var(--highlight-color);
    border-color: black; /* Change border color on hover */
    color: var(--main-color);
    cursor: pointer; /* Added to change the cursor to pointer */
}

form input:focus{
    outline: none;
}

form button{
    margin-top: 5px; /* Further reduced margin */
    border: none;
    border-radius: 1000px;
    padding: .5em 2em; /* Further reduced padding */
    background-color: var(--main-color);
    color: var(--highlight-color);
    font-weight: 600;
    cursor: pointer; /* Added to change the cursor to pointer */
}

form button:hover{
    background-color: var(--highlight-color);
    color: var(--main-color);
}

form button.signup {
    margin-top: 5px; /* Further reduced margin */
    border: none;
    border-radius: 1000px;
    padding: 0.5em 1em; /* Further reduced padding */
    font-size: 0.9em; /* Further reduced font size */
    background: var(--highlight-color);
    color: var(--dark-color);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

form button.signup:hover {
    background: var(--main-color);
    color: var(--highlight-color);
    transform: scale(1.05);
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.3);
}

.social-login {
    border: none;
    border-radius: 1000px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 3px; /* Further reduced space between logo and text */
    white-space: nowrap; /* Ensure text stays on one line */
    padding: 0.2em 0.5em; /* Further reduced padding */
    margin-top: 2px; /* Further reduced margin */
}

.google-login {
    background-color: #db4437;
    color: white;
}

.google-login:hover {
    background-color: #c33d2e;
    color: var(--highlight-color);
}

.facebook-login {
    background-color: #3b5998;
    color: white;
}

.facebook-login:hover {
    background-color: #334d84;
    color: var(--highlight-color);
}

.social-login-container {
    display: flex;
    gap: 5px; /* Further reduced space between the buttons */
}

a:hover{
    color: var(--light-color);
    text-decoration: underline;
}

a{
    color: var(--highlight-color);
}

forgot-password {
    color: var(--highlight-color);
    text-decoration: none; /* Remove text decoration */
    margin-top: 5px; /* Further reduced margin */
}

forgot-password:hover {
    color: var(--light-color);
}

links {
    margin-top: 5px; /* Further reduced margin */
    text-align: center; /* Ensure text is centered */
}

@media (max-width: 1100px) {
    .wrapper {
        width: min(600px, 100%);
        border-radius: 0;
    }
}

@media (max-width: 768px) {
    body {
        background-image: none; /* Hide background image on smaller screens */
        background-color: var(--dark-color); /* Set a fallback background color */
    }
    .wrapper {
        width: 100%;
        border-radius: 0;
    }
}

@media (min-width: 769px) and (max-width: 1100px) {
    .wrapper {
        width: min(600px, 100%);
        border-radius: 0;
    }
}

@media (min-width: 1101px) {
    .wrapper {
        width: max(40%);
        border-radius: 0 20px 20px 0;
    }
}

form div.incorrect input{
    color: red;
    font-weight: 600;
    margin-top: 5px; /* Further reduced margin */
}

form input.error {
    border-color: var (--error-color); /* Change border color to error color */
    font-style: italic; /* Italicize the text */
}

form input.signup {
    margin-top: 5px; /* Further reduced margin */
    border: none;
    border-radius: 1000px;
    padding: 0.5em 0.5em; /* Further reduced padding */
    font-size: 0.9em; /* Further reduced font size */
    background: linear-gradient(135deg, var(--highlight-color) 30%, #e6c200);
    color: var (--dark-color);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
}

form input.signup:hover {
    background: linear-gradient(135deg, var(--main-color) 30%, #6b1313);
    color: var(--highlight-color);
    transform: scale(1.05);
    box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.3);
}
  </style>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const forgotPasswordLink = document.querySelector(".recover a");
    forgotPasswordLink.addEventListener("click", function(event) {
        event.preventDefault();
        const overlay = document.createElement("div");
        overlay.style.position = "fixed";
        overlay.style.top = "0";
        overlay.style.left = "0";
        overlay.style.width = "100%";
        overlay.style.height = "100%";
        overlay.style.backgroundColor = "rgba(0, 0, 0, 0.7)";
        overlay.style.zIndex = "999";
        document.body.appendChild(overlay);

        const popup = document.createElement("div");
        popup.style.position = "fixed";
        popup.style.top = "50%";
        popup.style.left = "50%";
        popup.style.transform = "translate(-50%, -50%)";
        popup.style.backgroundColor = "#262626";
        popup.style.padding = "20px";
        popup.style.borderRadius = "10px";
        popup.style.boxShadow = "0px 4px 6px rgba(0, 0, 0, 0.2)";
        popup.style.zIndex = "1000";
        popup.style.textAlign = "center";
        popup.innerHTML = `
            <h2 style="color: var(--highlight-color);">Recover Password</h2>
            <p style="color: var(--light-color);">Please enter your email address to recover your password.</p>
            <input type="email" id="recover-email" placeholder="Enter email" style="padding: 0.5em; border-radius: 10px; border: 2px solid transparent; background-color: var(--main-color); color: var(--highlight-color); width: 100%; box-sizing: border-box; margin-bottom: 10px;">
            <button id="recover-submit" style="border: none; border-radius: 1000px; padding: .5em 2em; background-color: var(--main-color); color: var(--highlight-color); font-weight: 600; cursor: pointer;">Submit</button>
            <button id="recover-cancel" style="border: none; border-radius: 1000px; padding: .5em 2em; background-color: var(--error-color); color: var(--highlight-color); font-weight: 600; cursor: pointer; margin-left: 10px;">Cancel</button>
        `;
        document.body.appendChild(popup);

        document.getElementById("recover-cancel").addEventListener("click", function() {
            document.body.removeChild(popup);
            document.body.removeChild(overlay);
        });

        document.getElementById("recover-submit").addEventListener("click", function() {
            const email = document.getElementById("recover-email").value;
            if (email) {
                // Handle the email submission logic here
                alert("Recovery email sent to " + email);
                document.body.removeChild(popup);
                document.body.removeChild(overlay);
            } else {
                alert("Please enter a valid email address.");
            }
        });
    });
});
</script>
</head>
<body>
    <div class="wrapper">
        <img src="images/vestigiaLogoBig.png" alt="Vestigia Logo" class="logo">
        <div class="err-msg">
            <?php if (!empty($error_msg)){ ?>
                <div class="alert alert-danger">
                    <?= $error_msg ?>
                </div>
            <?php } ?>
        </div>
        <form action="" method="post">
            <?php
            $display_email = isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : $email;
            $checked = !empty($remember) ? "checked" : (isset($_COOKIE['remember']) ? "checked" : "");
            ?>
            <div class="input-group">
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter email"
                    value="<?= htmlspecialchars($display_email) ?>"
                />
                <div class="input-err text-danger"><?= $email_err ?></div>
            </div>
            <div class="input-group">
                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter password"
                />
                <div class="input-err text-danger"><?= $password_err ?></div>
            </div>
            
                <button
                    type="submit"
                    name="submit"
                    class="signup">
                    Login
                </button>
             <p class="recover">
        <a href="recover-password.php">Recover Password</a>
      </p>
            
        </form>
       
 
    <div class="social-login-container">
            <button class="social-login google-login">
                <i class="fab fa-google"></i> Login With Google
            </button>
            <button class="social-login facebook-login">
                <i class="fab fa-facebook"></i> Login With Facebook
            </button>
        </div>
        <div class="links">
            <br>
            <p>Don't have an account? <a href="register.php">Register Here.</a><bR>&copy; 2025 Vestigia. All Rights Reserved.</p>
            
        </div>
  </div>
</body>
</html>