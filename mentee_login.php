<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <style>

        *{
            margin: 0;
            padding: 0;
            
        }
        body{
            background-image: linear-gradient(rgba(0, 0, 0, 0.1),rgba(0, 0, 0, 0.1)),url("https://media.licdn.com/dms/image/C5612AQEZGZ_ccnoedw/article-cover_image-shrink_600_2000/0/1520079527994?e=2147483647&v=beta&t=dPGPfcZoAzgIuN8CYMnbCT3vXKzacevAa4izGzEX6sI");
            background-position: center;
            background-size: cover;
            height: 100vh;
            position: relative;
            font-family: sans-serif;
            font-size: 20PX;
        }
        .login-box{
            width: 500px;
            height: 500px;
            background: rgb(0, 0, 0);
            color: #fff;
            top: 40%;
            left: 25%;
            position: absolute;
            transform: translate(-50%,-50%);
            box-sizing: border-box;
            padding: 70px 30px;
        }
        .dp{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: absolute;
            top: -50px;
            left: 125px;
        }
        h1{
            margin: 0;
            padding: 0 0 20px;
            text-align: center;
            font-size: 22px;
        }
        .login-box p{
            margin: 0;
            padding: 0;
            font-weight: bold;
        }
        .login-box input{
            width:100%;
            margin-bottom:20px;    
        }
        .login-box input[type="text"], input[type="password"]
        {
            border:none;
            border-bottom: 1px solid #fff;
            background:transparent ;
            outline: none;
            height: 40px;
            color: #fff;
            font-size: 14px;
        }
        .login-box input[type="submit"]
        {
            border: none;
            outline: none;
            height: 40px;
            background:#0066b2;
            color:#fff;
            font-size: 18PX;
            border-radius: 20px;    
        }
        .login-box input[type="submit"]:hover
        {
            cursor: pointer;
            background: #ffffff;
            color: #000;
        }
        .login-box a{
            font-size: 13px;
            line-height: 20px;
            color: darkgrey;
        }
        .login-box a:hover{
            color : #07c5ff;
        }

    </style>
</head>

<body>
<?php
    $con = mysqli_connect("localhost:3307", "root", "", "profile_builder");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['uname'])) {
        $uname = stripslashes($_REQUEST['uname']);    // removes backslashes
        $uname = mysqli_real_escape_string($con, $uname);
        $pass = stripslashes($_REQUEST['pass']);
        $pass = mysqli_real_escape_string($con, $pass);
        // Check if the username and password are valid
        $query = "SELECT * FROM SIGNUP WHERE uname='$uname' AND pass='" . md5($pass) . "'";
        $result = mysqli_query($con, $query);
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['uname'] = $uname;
            // Redirect to user dashboard page
            header("Location: dashboard_mentee.php");
            exit();
        } else {
            $error_message = "Incorrect username or password.";
        }
    }
?>
    <form class="form" method="post" name="login">
        <div class="login-box">
            <h1 class="login-title">LOGIN</h1>
            <form style="margin-top: 10%;" action="" method="POST">
                <div class="form-group">
                    <label for="uname">User Name</label>
                    <input type="text" name="uname" placeholder="Enter User ID">
                </div>
                <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="pass" id="pass" placeholder="Enter Password">
                </div>
                <input type="submit" name="login" value="Login" style="margin-top: 10%;">
                <a href="workwise.html">New to WorkWise? Create an account!!</a>
                <br/>
                <?php
                    if (isset($error_message)) {
                        echo '<p style="color: #0066b2;">' . $error_message . '</p>';
                    }
                ?>
            </form>
        </div>
    </form>
</body>
</html>