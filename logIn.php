<?php
include("data.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In Player</title>
    <link href="signIn.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="signup">
    <h2>Login</h2>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">

    <input type="text" name="username" placeholder="Username">
    <input type="password" name="password" placeholder="password">
    <input type="submit" name="login" value="Login">

    </form>
    
    <a href="index.php">Signup Here</a>
</div>

</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];  
    $password = $_POST['password'];  

    //to prevent from mysqli injection  
    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($conn, $username);  
    $password = mysqli_real_escape_string($conn, $password);  
    $sql = "SELECT *FROM players WHERE username = '$username' AND password = '$password'";  
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
    $count = mysqli_num_rows($result);  
     
    if(empty($username)){
        echo "<h1>Username is empty</h1>";
    }
    elseif(empty($password)){
        echo "<h1>Password is empty</h1>";
    }
    if($count == 1){  
        echo "<h1><center> Login successful </center></h1>";  
        $_SESSION['user'] = $username;
        header("location: home.php");
    }  
    else{  
        echo "<h1> Login failed. Invalid username or password.</h1>";  
    }
    
}
mysqli_close($conn);

?>