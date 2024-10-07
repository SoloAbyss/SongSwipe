<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>SongSwipe | Create Account</title>
</head>
<body>
      <div class="login-container">
        <div class="login-box form-box">

        <?php 
         
         include("php/config.php");
         if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $password = $_POST['password'];

         //verifying the unique email

         $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is already taken, please try another email.</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn1'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO users(Username,Email,Name,Password) VALUES('$username','$email','$name','$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registration successful!</p>
                  </div> <br>";
            echo "<a href='login.php'><button class='btn1'>Login</button>";
         

         }

         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Full Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn1" name="submit" value="Register" required>
                </div>
                <div class="small-links">
                        <ul>
                            <p>Already have an account?</p>
                            <a href="login.php">Sign in</a>
                        </ul>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>