<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login.</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img src="Assets/SongSwipe logo.svg" alt="navbar logo" /></a>
        </div>
        <div class="links">
            <a href="myfinds.php">My Finds<img class="my-finds-icon-p" src="Assets/My Finds icon.svg"
                    alt="My Finds icon" /></a>
            <div class="divider"></div>
            <a href="profile.php">Profile<img class="profile-icon-p" src="Assets/Profile Icon.svg"
                    alt="Profile icon" /></a>
        </div>
    </div>
    <div class="login-container">

        <div class="login-box form-box">
            <?php

            include("php/config.php");
            if (isset($_POST['submit'])) {
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $password = mysqli_real_escape_string($con, $_POST['password']);

                $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);

                if (is_array($row) && !empty($row)) {
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['name'] = $row['Name'];
                    $_SESSION['id'] = $row['Id'];
                } else {
                    echo "<div class='message'>
                      <p>Wrong Email or Password</p>
                       </div> <br>";
                    echo "<a href='login.php'><button class='btn1'>Try again</button>";

                }
                if (isset($_SESSION['valid'])) {
                    header("Location: profile.php");
                }
            } else {


                ?>
                <header>Welcome Back!</header>
                <h1 class="">Please login to SongSwipe</h1>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off" required>
                    </div>

                    <div class="field">

                        <input type="submit" class="btn1" name="submit" value="Sign in" required>
                    </div>
                    <div class="small-links">
                        <ul>
                            <p>New to SongSwipe?</p>
                            <a href="register.php">Create your SongSwipe account</a>
                        </ul>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</body>

</html>