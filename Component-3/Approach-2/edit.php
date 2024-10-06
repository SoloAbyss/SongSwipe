<?php 
   session_start();

   include("php/config.php");
   if(!isset($_SESSION['valid'])){
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
    <title>SongSwipe | Edit Profile</title>
</head>
<body>
    <div class="navbar">
        <div class="logo">
            <a href="index.php"><img href="index.html" src="Assets/SongSwipe logo.svg" alt="navbar logo" /></a>
        </div>
        <div class="links">
            <a href="#myfinds">My Finds<img class="my-finds-icon-p" src="Assets/My Finds icon.svg"
                    alt="My Finds icon" /></a>
            <div class="divider"></div>
            <a class="nav-active" href="#profile">Profile<img class="profile-icon-p" src="Assets/Profile Icon.svg"
                    alt="Profile icon" /></a>
        </div>
    </div>
    <div class="login-container">
        <div class="login-box form-box">
            <?php 
               if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $name = $_POST['name'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE users SET Username='$username', Email='$email', Name='$name' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='profile.php'><button class='btn1'>Go back to profile</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['Username'];
                    $res_Email = $result['Email'];
                    $res_Name = $result['Name'];
                }

            ?>
            <header>Edit Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Full Name</label>
                    <input type="text" name="name" id="name" value="<?php echo $res_Name; ?>" autocomplete="off" required>
                </div>
                
                <div class="edit-field">
                    <input type="submit" class="btn1" name="submit" value="Update" required>
                    <a href="profile.php" class="btn2">Cancel</a>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>