<?php
    require "./app/database.php";
    require "./app/LoginController.php";
    
    $login = new Login();
?>

<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="./web/css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
</head>

<body>

    <?php

    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: home.php");
        exit;
    }

    $errorMsg = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($login->checker($_POST['username'], $_POST['password']) == 1) {
            $_SESSION["loggedin"] = true;

            foreach ($login->selectAll($_POST['username'], $_POST['password']) as $userDetails) {
                $_SESSION["account"] = $userDetails['account'];
            }

            header("location: home.php");
            exit;
        } else {
            $errorMsg = "Login failed";
        }  
    } 
    ?>

    <div class="container">
        <div class="background">

        </div>
        <div class="loginContainer">
            <div class="login">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="loginTitle">
                        <span>Log In</span>
                    </div>
                    <div class="loginText">
                        <span>Username</span>
                        <input type="text" name="username" autocomplete="off" required>
                    </div>
                    <div class="loginText">
                        <span>Password</span>
                        <input type="password" name="password" autocomplete="off" required>
                    </div>
                    <div class="submitBtn">
                        <input type="submit" name="login" value="LOGIN">  
                    </div>
                    <div class="errorMsg">
                        <span><?php echo $errorMsg ?> </span>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


</body>

</html>