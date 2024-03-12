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
            background-image: linear-gradient(rgba(0, 0, 0, 0.6),rgba(0, 0, 0, 0.6)),url(bg1.jpeg);
            background-position: center;
            background-size: cover;
            height: 100vh;
            position: relative;
            font-family: sans-serif;
            font-size: 20PX;
        }
        .login-box{
            width: 350px;
            height: 500px;
            background: rgb(0, 0, 0);
            color: #fff;
            top: 50%;
            left: 50%;
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
            background:#fb2525 ;
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
        // Check user is exist in the database
        $query    = "SELECT * FROM SIGNUP WHERE uname='$uname'
                     AND pass='" . md5($pass) . "'";
        $result = mysqli_query($con, $query) ;
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['uname'] = $uname;
            // Redirect to user dashboard page
            header("Location: dashboard_mentor.php");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="login">
    <div class="login-box">
        
   <img src="img.png" class="dp">

        <h1 class="login-title">LOGIN</h1>
        
 <form style="margin-top: 10%" action="offloginform.php" method="POST">

 <div class="form-group">
 <label for="uname">User Name</label>
 <input type="text" name="uname" placeholder="Enter User ID">
 </div>

 <div class="form-group">
 <label for="pass">Password</label>
 <input type="Password" name="pass" id="pass" placeholder="Enter Password">
 </div>
 
 
 <input type="submit" name="login" value="Login" style="margin-top: 10%;">


                    <a href="offsignupform.php">New to WorkWise?Create an account!!</a>
  </form>
    </div>
<?php
    }
?>
</body>
</html>