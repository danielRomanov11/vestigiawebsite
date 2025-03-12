<?php
session_start();
include "dbconnect.php";
$name = $email = $password = $confirm_password = "";
$name_err = $email_err = $password_err = $confirm_password_err = "";
$error = false; 
$err_msg = "";

if (isset($_POST['submit'])){

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    // validate fields
    if ($name == ""){
        $name_err = "Name is mandatory";
        $error = true;
    }

    if ($email == ""){
        $email_err = "Email is mandatory";
        $error = true;
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_err = "Invalid Email format";
            $error = true;
        }
    else{   // check if email already registered
        $sql = "select * from users where email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows >0){
            $email_err = "Email already registered";
            $error = true;
        } 
    }

    if ($password == ""){
        $password_err = "Password is mandatory";
        $error = true;
    }
    elseif (strlen($password) < 6) {
        $password_err = "Password must be atleast 6 characters";
        $error = true;
        }
    
    if ($confirm_password == ""){
        $confirm_password_err = "Confirm Password is mandatory";
        $error = true;
    }

    if ($password !="" && $confirm_password !=""){
        if ($password != $confirm_password){
            $confirm_password_err = "Passwords do not match";
            $error = true;
        }
    }

    // all validations passed
    if (!$error){
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "insert into users (name, email, password) value(?, ?, ?)";
        try{
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $password);
            $stmt->execute();
            $_SESSION['name'] = $name;
            setcookie("username", $name, time()+365*24*3600, "/");
            header("location: profile.php");
            exit();
        }
        catch(Exception $e){
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
    <title>Sign Up - Vestigia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" href="images/vestigiaLogo.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="account.css">
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
    border-color: var(--error-color); /* Change border color to error color */
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
</head>

<body>
    <div class="wrapper" id="signup">
        <div class="logo-container">
            <img src="images/vestigiaLogoBig.png" alt="Vestigia Logo" class="logo">
        </div>
        <br>
        
        
        <?php
        if (!empty($succ_msg)){ ?>
            <div class="alert alert-success">
                <?= $succ_msg?>
            </div>
        <?php } ?>

        <?php if (!empty($error_msg)){ ?>
            <div class="alert alert-danger">
                <?= $error_msg?>
            </div>
        <?php } ?>

        <form action="" method="post">
            <div class="input-group">
                <input type="text" name="name" id="name" placeholder="Name" value="<?=$name?>" required>
                <div class="input-err text-danger"><?= $name_err?></div>
            </div>

            <div class="input-group">
                <input type="email" name="email" id="email" placeholder="Email" value="<?=$email?>" required>
                <div class="input-err text-danger"><?= $email_err?></div>
            </div>
            <div class="input-group password">
                <input type="password" name="password" id="password" placeholder="Password">
                <div class="input-err text-danger"><?= $password_err?></div>
            </div>
            <div class="input-group">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <div class="input-err text-danger"><?= $confirm_password_err?></div>
            </div>
            <button type="submit" class="signup" name="submit">
                Sign Up
            </button>
        </form>
        <div class="social-login-container">
            <button class="social-login google-login">
                <i class="fab fa-google"></i> Sign Up With Google
            </button>
            <button class="social-login facebook-login">
                <i class="fab fa-facebook"></i> Sign Up With Facebook
            </button>
        </div>
        <div class="links">
            <br>
            <p>Already Have Account? <a href="login.php">Sign In Here.</a><bR>&copy; 2025 Vestigia. All Rights Reserved.</p>
        </div>
    </div>
</body>

</html>
