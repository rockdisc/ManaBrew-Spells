<!-- this is the sign up page, home is the main page, use username & password test by going into the log in page -->
<?php

    include("data.php");
    session_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Player</title>
    <link href="signIn.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="bigcontainer">
    <div id="signup">
    <h2>Sign Up</h2>
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">

        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="password">
        <input type="submit" name="submit" value="Sign Up">

        </form>
        <a href="logIn.php">Login Here</a>
    </div>
</div>

</body>
</html>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if(empty($username)){
        echo "<h1>Username is empty</h1>";
    }
    elseif(empty($password)){
        echo "<h1>Password is empty</h1>";
    }
    else{
        $sql = "INSERT INTO players (username, password) VALUES ('$username', '$password')";
        try {
            mysqli_query($conn, $sql);
            echo "Sign Up Successful";
            $_SESSION['user'] = $username;
            header("Location: home.php");
        }
        catch (mysqli_sql_exception) {
            echo "<h1>Username is taken</h1>";
        }
    }

}


mysqli_close($conn);

?>