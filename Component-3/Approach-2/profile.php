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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
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
                <div class="profile-nav__link profile-nav__link--profile active" data-target="profile">
                    <img class="profile-pic" src="Assets/profile.jpg" alt="Profile Photo" />
                    <ul>
                        <li class="name"><b><?php echo $res_Name ?></b></li>
                        <li class="username">@<b><?php echo $res_Uname ?></b></li>
                    </ul>
                </div>
                <li class="profile-nav__link" data-target="get-pro"><i class="fa-solid fa-bolt"
                        style="color: #ffaa01;"></i>Get Pro</li>
                <li class="profile-nav__link" data-target="history"><i class="fa-solid fa-clock-rotate-left"></i>History
                </li>
                <li class="profile-nav__link" data-target="my-details"><i class="fa-regular fa-pen-to-square"></i>My
                    Details</li>
                <li class="profile-nav__link" data-target="settings"><i class="fa-solid fa-gear"></i>Settings</li>
                <li>
                    <a href="php/logout.php"><button class="profile-nav__link--logout"><i
                                class="fa-solid fa-right-from-bracket"></i>Log Out</button></a>
                </li>
            </ul>
        </div>

        <div class="profile-content">
            <div id="profile" class="content-section active">
                <h1 class="heading1"><i style="color: #FF8A00; font-size: 24pt; margin-right: 10px;"
                        class="fa-solid fa-medal"></i>My Badges</h1>
                <div class="badge__slider--container">
                    <div class="badge__slider--inner">
                        <div class="badge__slider--badge">
                            <img src="Assets\badge1.png" alt="badge">
                        </div>
                        <div class="badge__slider--badge">
                            <img src="Assets\badge2.png" alt="badge">
                        </div>
                        <div class="badge__slider--badge">
                            <img src="Assets\badge3.png" alt="badge">
                        </div>
                    </div>
                </div>
                <h1 class="heading1"><i style="color: rgba(119,6,136,1); font-size: 24pt; margin-right: 10px;"
                        class="fa-solid fa-star"></i>My favourites</h1>
                <div class="favourite__slider--container">
                    <div class="favourite__slider--inner">
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                        <div class="favourite__slider--favourite">
                            <ul>
                                <img src="Assets/Album covers/Weezer album.jpg" alt="badge">
                                <h1 class="heading3">Buddy Holly</h1>
                                <p class="subheading2">Weezer</p>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="get-pro" class="content-section">
                <h1 class="heading1">Discover More, Enjoy More.</h1>
                <p class="subheading1">Upgrade to SongSwipe Pro to access premium features.</p>
                <div class="pro-container">
                    <div class="pro-info">
                        <img class="infographic" src="Assets/Get Pro Image.png" alt="pro">
                        <div class="pro-details">
                            <div class="detail">
                                <img src="Assets\Ad free icon.svg" alt="ad free">
                                <ul>
                                    <h1 class="heading2">Ad free listening</h1>
                                    <p>Enjoy uninterrupted listening</p>
                                </ul>
                            </div>
                            <div class="detail">
                                <img src="Assets\Offline discovery icon.svg" alt="offline">
                                <ul>
                                    <h1 class="heading2">Offline discovery</h1>
                                    <p>Explore new music without an internet connection</p>
                                </ul>
                            </div>
                            <div class="detail">
                                <img src="Assets\Collab playlist icon.svg" alt="collab">
                                <ul>
                                    <h1 class="heading2">Collaborative playlists</h1>
                                    <p>Share the music you love and discover new favorites as a team!</p>
                                </ul>
                            </div>
                            <div class="detail">
                                <img src="Assets\High quality audio icon.svg" alt="audio">
                                <ul>
                                    <h1 class="heading2">High fidelity audio</h1>
                                    <p>Enjoy superior sound for an immersive experience!</p>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="buy-pro">
                        <p>All of that for only <i class="highlight">$8.99</i> / month</p>
                        <a class="buy-btn" href="#buy-pro"><img src="Assets\Songswipe icon.png" alt="songswipe icon">Go
                            Pro</a>
                    </div>
                </div>
            </div>
            <div id="history" class="content-section">
                <h1 class="heading1">History</h1>
                <p class="subheading1">View your music discovery journey, song by song.</p>
                <h1 class="heading2">Today</h1>
                <table class="history">
                    <tr>
                        <th style="width: 40%; height:0px;">Title</th>
                        <th style="width: 40%; height:0px;">Album</th>
                        <th style="width: 20%; height:0px;">Duration</th>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                </table>
                <h1 class="heading2">Yesterday</h1>
                <table class="history">
                    <tr>
                        <th style="width: 40%; height:0px;">Title</th>
                        <th style="width: 40%; height:0px;">Album</th>
                        <th style="width: 20%; height:0px;">Duration</th>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                    <tr>
                        <td class="title">
                            <img src="Assets/Album covers/Weezer album.jpg" alt="album cover">
                            <ul>
                                <h2>Buddy Holly</h2>
                                <p>Weezer</p>
                            </ul>
                        </td>
                        <td>Weezer (Blue Album)</td>
                        <td>2:40</td>
                    </tr>
                </table>
            </div>
            <div id="my-details" class="content-section">
                <h1 class="heading1">My Details</h1>
                <p class="subheading1">Manage your personal information.</p>
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
                <h1 class="heading1">Settings</h1>
                <p class="subheading1">Update your preferences and account settings.</p>
                <div class="settings__container">
                    <div class="settings__container--settings">
                        <div class="settings__container--setting preview-length" id="preview-length-setting">
                            <h1 class="heading2"><i style="margin-right: 10px;"
                                    class="fa-solid fa-hourglass"></i>Preview length</h1>
                            <div class="preview-length__dropdown">
                                <button class="dropdown-btn" id="dropdown-btn">Select Time<i style="margin-left: 10px;"
                                        class="fa-solid fa-chevron-down"></i></button>
                                <div class="dropdown-content" id="dropdown-content">
                                    <a href="#" data-time="15s">15s</a>
                                    <a href="#" data-time="30s">30s</a>
                                    <a href="#" data-time="45s">45s</a>
                                </div>
                            </div>
                        </div>
                        <div class="settings__container--setting auto-scroll" id="auto-scroll-setting">
                            <h1 class="heading2"><i style="margin-right: 10px;" class="fa-solid fa-angles-down"></i>Auto
                                Scroll</h1>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="settings__container--setting push-notification" id="push-notification-setting">
                            <h1 class="heading2"><i style="margin-right: 10px;" class="fa-regular fa-bell"></i>Push
                                Notifications</h1>
                            <label class="switch">
                                <input type="checkbox">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="settings__container--setting default-platform" id="default-platform-setting">
                            <h1 class="heading2"><i style="margin-right: 10px;"
                                    class="fa-regular fa-circle-play"></i>Default Import Platform</h1>
                            <div class="preview-length__dropdown">
                                <button class="dropdown-btn" id="platform-dropdown-btn">Select Platform<i
                                        style="margin-left: 10px;" class="fa-solid fa-chevron-down"></i></button>
                                <div class="dropdown-content" id="platform-dropdown-content">
                                    <a href="#" data-platform="Spotify">Spotify</a>
                                    <a href="#" data-platform="YouTube Music">YouTube Music</a>
                                    <a href="#" data-platform="Apple Music">Apple Music</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="settings__container--tooltip">
                        <ul class="tooltip__preview-length" id="tooltip-preview-length">
                            <h1 class="heading2">Preview Length</h1>
                            <p class="subheading2">Set the length of song previews displayed in your feed.</p>
                        </ul>
                        <ul class="tooltip__auto-scroll" id="tooltip-auto-scroll">
                            <h1 class="heading2">Auto Scroll</h1>
                            <p class="subheading2">Enable or disable automatic scrolling through your song feed.</p>
                        </ul>
                        <ul class="tooltip__push-notification" id="tooltip-push-notification">
                            <h1 class="heading2">Push Notifications</h1>
                            <p class="subheading2">Receive notifications for new music releases or updates.</p>
                        </ul>
                        <ul id="tooltip-default-platform" class="tooltip__default-platform">
                            <h1 class="heading2">Default Import Platform</h1>
                            <p class="subheading2">Select your default music streaming platform for importing saved songs.</p>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="script-profile.js"></script>
</body>

</html>