<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <img href="php/logout.php" src="Assets/SongSwipe logo.svg" alt="navbar logo">
        </div>
        <div class="filter-container">
            <div class="filter-inner">
                <div class="filter">
                    <a>Pop</a>
                </div>
                <div class="filter">
                    <a>Rap</a>
                </div>
                <div class="filter">
                    <a>Hip-Hop</a>
                </div>
                <div class="filter">
                    <a>RnB</a>
                </div>
                <div class="filter">
                    <a>Rock</a>
                </div>
                <div class="filter">
                    <a>Metal</a>
                </div>
                <div class="filter">
                    <a>Indie</a>
                </div>
                <div class="filter">
                    <a>Jazz</a>
                </div>
                <div class="filter">
                    <a>Electronic</a>
                </div>
                <div class="filter">
                    <a>Drum & Bass</a>
                </div>
                <div class="filter">
                    <a>Chill</a>
                </div>
                <div class="filter">
                    <a>Bubblegum Pop</a>
                </div>
                <div class="filter">
                    <a>Emo</a>
                </div>
                <div class="filter">
                    <a>K-Pop</a>
                </div>
                <div class="filter">
                    <a>J-Pop</a>
                </div>
                <div class="filter">
                    <a>Soundtracks & Musicals</a>
                </div>
                <div class="filter">
                    <a>Country</a>
                </div>
                <div class="filter">
                    <a>Folk</a>
                </div>
                <div class="filter">
                    <a>Acoustic</a>
                </div>
                <div class="filter">
                    <a>Latin</a>
                </div>
                <div class="filter">
                    <a>Blues</a>
                </div>
                <div class="filter">
                    <a>Punk</a>
                </div>
            </div>
        </div>
        <div class="links">
            <a href="#myfinds">My Finds<img class="my-finds-icon" src="Assets/My Finds icon.svg" alt="My Finds icon"></a>
            <div class="divider"></div>
            <a href="profile.php"><img class="profile-icon" src="Assets/Profile Icon.svg" alt="Profile icon"></a> 
        </div>
        
    </div>
   
    <div class="media-carousel">
        <ul class="songs">
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Buddy Holly<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
            <li><img src="Assets/Weezer blue albumb.jpg" alt="landscape-placeholder">Test Song<p>Weezer</p></li>
        </ul>
        <div class="actions">
            <div class="top">
                <button class="action-btn prev"><i class="fa-solid fa-circle-arrow-up"></i></button>
                <button class="action-btn next"><i class="fa-solid fa-circle-arrow-down"></i></button>
            </div>        
            <div class="bottom">
                <button class="action-btn"><i class="fa-regular fa-heart"></i></button>
                <button class="action-btn"><i class="fa-solid fa-heart-crack"></i></button>
                <button class="action-btn"><i class="fa-solid fa-plus"></i></button>
            </div>

        </div>
    </div>
    <div class="drag-proxy"></div>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Draggable.min.js"></script>
    <script src="script.js"></script>
</body>
</html>