<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="index.html"><img href="index.html" src="Assets/SongSwipe logo.svg" alt="navbar logo" /></a>
        </div>
        <div class="links">
            <a href="#myfinds">My Finds<img class="my-finds-icon-p" src="Assets/My Finds icon.svg"
                    alt="My Finds icon" /></a>
            <div class="divider"></div>
            <a href="#profile">Profile<img class="profile-icon-p" src="Assets/Profile Icon.svg"
                    alt="Profile icon" /></a>
        </div>
    </div>

    <div class="container">
        <!-- Vertical Navigation Pane -->
        <div class="vertical-nav">
            <ul>
                <div class="profile nav-item active" data-target="profile">
                    <img class="profile-pic" src="Assets/profile.png" alt="Profile Photo" />
                    <ul>
                        <li class="name">Maximus Abrahamse</li>
                        <li class="username">@SoloAbyss</li>
                    </ul>
                </div>
                <li class="nav-item" data-target="get-pro">Get Pro</li>
                <li class="nav-item" data-target="history">History</li>
                <li class="nav-item" data-target="my-details">My Details</li>
                <li class="nav-item" data-target="settings">Settings</li>
            </ul>
        </div>

        <!-- Content Section -->
        <div class="content-area">
            <div id="profile" class="content-section active">
                <h1>Profile</h1>
                <p>Upgrade to Pro to access premium features.</p>
            </div>
            <div id="get-pro" class="content-section">
                <h1>Get Pro</h1>
                <p>Upgrade to Pro to access premium features.</p>
            </div>
            <div id="history" class="content-section">
                <h1>History</h1>
                <p>Your past activities and purchases.</p>
            </div>
            <div id="my-details" class="content-section">
                <h1>My Details</h1>
                <p>Manage your personal information.</p>
                <div class="name">
                    <p>Name</p>
                    <div class="detail-field">
                        <p>Maximus Abrahamse</p>
                        <a href="edit.php"> <button class="btn">Edit</button> </a>
                    </div>
                </div>
            </div>
            <div id="settings" class="content-section">
                <h1>Settings</h1>
                <p>Update your preferences and account settings.</p>
            </div>
        </div>
    </div>
    <script src="script-profile.js"></script>



    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a> </p>
        </div>

        <div class="right-links">

            <?php

            $id = $_SESSION['id'];
            $query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

            while ($result = mysqli_fetch_assoc($query)) {
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
                $res_Name = $result['Name'];
                $res_id = $result['Id'];
            }

            echo "<a href='edit.php?Id=$res_id'>Edit profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <b><?php echo $res_Name ?></b>
                    <p>@<b><?php echo $res_Uname ?></b></p>
                </div>
                <div class="box">
                    <p>Your email is <b><?php echo $res_Email ?></b>.</p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
                    <p><b><?php echo $res_Name ?></b></p>
                </div>
            </div>
        </div>

    </main>
</body>

</html>