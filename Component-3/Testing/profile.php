<?php
session_start();

include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
}
?>

<?php
$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT*FROM users WHERE Id=$id");

while ($result = mysqli_fetch_assoc($query)) {
    $res_Uname = $result['Username'];
    $res_Email = $result['Email'];
    $res_Name = $result['Name'];
    $res_id = $result['Id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>SongSwipe | Profile</title>
</head>

<body>
    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img href="index.html" src="Assets/SongSwipe logo.svg" alt="navbar logo" /></a>
        </div>
        <div class="links">
            <a href="myfinds.php">My Finds<img class="my-finds-icon-p" src="Assets/My Finds icon.svg"
                    alt="My Finds icon" /></a>
            <div class="divider"></div>
            <a class="nav-active" href="#profile">Profile<img class="profile-icon-p" src="Assets/Profile Icon.svg"
                    alt="Profile icon" /></a>
        </div>
    </div>

    <div class="profile-container">
        <div class="profile-nav">
            <ul>
                <div class="profile-link active" data-target="profile">
                    <img class="profile-pic" src="Assets/profile.png" alt="Profile Photo" />
                    <li class="name"><b><?php echo $res_Name ?></b></li>
                    <li class="username">@<b><?php echo $res_Uname ?></b></li>
                </div>
                <li data-target="get-pro"><i class="fa-solid fa-bolt" style="color: #ffaa01;"></i>Get Pro</li>
                <li data-target="history"><i class="fa-solid fa-clock-rotate-left"></i>History</li>
                <li data-target="my-details"><i class="fa-regular fa-pen-to-square"></i>My Details</li>
                <li data-target="settings"><i class="fa-solid fa-gear"></i>Settings</li>
                <li>
                    <a href="php/logout.php"><button class="logout">Log Out</button></a>
                </li>
            </ul>
        </div>

        <div class="profile-details">
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
                <p class="subheading">Manage your personal information.</p>
                <div class="details-container">
                    <div class="top-details">
                        <div class="detail-box detail-box">
                            <!-- Content for the left box (e.g., Name) -->
                            <h2>Name</h2>
                            <p><b><?php echo $res_Name ?></p>
                        </div>
                        <div class="detail-box detail-box-right">
                            <!-- Content for the right box (e.g., Username) -->
                            <h2>Username</h2>
                            <p><b><?php echo $res_Uname ?></b></p>
                        </div>
                    </div>

                    <div class="bottom-details">
                        <!-- Content for the bottom box (e.g., Email) -->
                        <h2>Email</h2>
                        <p> <b><?php echo $res_Email ?></p>
                    </div>
                </div>
                <?php
                    echo "<a href='edit.php?Id=$res_id' class='btn-edit-profile'>Edit profile</a>";
                ?>
            </div>
            <div id="settings" class="content-section">
                <h1>Settings</h1>
                <p>Update your preferences and account settings.</p>
            </div>
        </div>
    </div>
    <script src="script-profile.js"></script>
</body>

</html>