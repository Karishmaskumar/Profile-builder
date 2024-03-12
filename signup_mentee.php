<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Mentee Registration</title>
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
}
.register-box{
    width: 440px;
    height: 820px;
    background: rgb(0, 0, 0);
    color: #fff;
    top: 50%;
    left: 20%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 30px 30px;
}

h1{
    margin: 0;
    padding: 0 0 20px;
    text-align: center;
    font-size: 28px;
}
.register-box p{
    margin: 0;
    padding: 0;
    font-weight: bold;
}
.register-box input{
    width:100%;
    margin-bottom:20px;    
}
.register-box input[type="text"], input[type="password"]
{
    border:none;
    border-bottom: 1px solid #fff;
    background:transparent ;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 14px;
}
.register-box input[type="text"], input[type="password"]
{
    border:none;
    border-bottom: 1px solid #fff;
    background:transparent ;
    outline: none;
    height: 30px;
    color: #fff;
    font-size: 13px;
}
.register-box input[type="submit"]
{
    border: none;
    outline: none;
    height: 30px;
    background:#0066b2 ;
    color:#fff;
    font-size: 18px;
    border-radius: 20px;    
}
.register-box input[type="submit"]:hover
{
    cursor: pointer;
    background: #ffffff;
    color: #000;
}
.register-box a{
    font-size: 15px;
    line-height: 20px;
    color: darkgrey;
}
.register-box a:hover{
    color : #57d3cd;
}


    .dp{
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: absolute;
            top: -50px;
            left: 165px;
        }
   </style>
</head>
<body>
<?php

$con = mysqli_connect("localhost", "root", "", "profile_builder");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Define an array to store validation errors
$errors = array();

// When form submitted, insert values into the database.
session_start();

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $role = $_POST["role"];

    // Store uname in session
    $_SESSION["uname"] = $uname;

    // Validate form fields
    if (empty($fname)) {
        $errors["fname"] = "First name is required.";
    }

    if (empty($lname)) {
        $errors["lname"] = "Last name is required.";
    }

    if (empty($uname)) {
        $errors["uname"] = "Username is required.";
    }

    if (strlen($pass) < 6) {
        $errors["pass"] = "Password should have at least 6 characters.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Valid email is required.";
    }

    if (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
        $errors["phone"] = "Valid 10-digit phone number is required.";
    }

    if (empty($city)) {
        $errors["city"] = "City is required.";
    }

    if (empty($country)) {
        $errors["country"] = "Country is required.";
    }

    // If there are no validation errors
    if (empty($errors)) {
        $query = "INSERT into SIGNUP (fname, lname, uname, pass, email, phone, city, country, role) 
                  VALUES ('$fname','$lname','$uname','" . md5($pass) . "','$email','$phone','$city','$country','$role')";
        $result = mysqli_query($con, $query);
        if ($result) {
            header("Location: mentee.php");
            exit;
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>register</a> again.</p>
                  </div>";
        }
    }
}

// Close the database connection
mysqli_close($con);
?>

<div class="register-box">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <img src="img.png" class="dp"><br><br>
        <h1 class="login-title">Registration</h1>
        <p>Your first name</p>
        <input type="text" name="fname" placeholder="Enter your first name" value="<?php if (isset($fname)) { echo $fname; } ?>" required>
        <?php if (isset($errors["fname"])) { echo "<p class='error'>" . $errors["fname"] . "</p>"; } ?>

        <p>Your last name</p>
        <input type="text" name="lname" placeholder="Enter your last name" value="<?php if (isset($lname)) { echo $lname; } ?>" required>
        <?php if (isset($errors["lname"])) { echo "<p class='error'>" . $errors["lname"] . "</p>"; } ?>

        <p>Your username</p>
        <input type="text" name="uname" placeholder="Enter your username" value="<?php if (isset($uname)) { echo $uname; } ?>" required>
        <?php if (isset($errors["uname"])) { echo "<p class='error'>" . $errors["uname"] . "</p>"; } ?>

        <p>Password</p>
        <input type="password" name="pass" placeholder="At least 6 characters" required>
        <?php if (isset($errors["pass"])) { echo "<p class='error'>" . $errors["pass"] . "</p>"; } ?>

        <p>Email</p>
        <input type="text" name="email" placeholder="Enter your email" value="<?php if (isset($email)) { echo $email; } ?>" required>
        <?php if (isset($errors["email"])) { echo "<p class='error'>" . $errors["email"] . "</p>"; } ?>

        <p>Mobile number</p>
        <input type="text" name="phone" placeholder="Enter your phone number" value="<?php if (isset($phone)) { echo $phone; } ?>" required>
        <?php if (isset($errors["phone"])) { echo "<p class='error'>" . $errors["phone"] . "</p>"; } ?>

        <p>City</p>
        <input type="text" name="city" placeholder="Enter your city" value="<?php if (isset($city)) { echo $city; } ?>" required>
        <?php if (isset($errors["city"])) { echo "<p class='error'>" . $errors["city"] . "</p>"; } ?>

        <p>Country</p>
        <input type="text" name="country" placeholder="Enter your country" value="<?php if (isset($country)) { echo $country; } ?>" required>
        <?php if (isset($errors["country"])) { echo "<p class='error'>" . $errors["country"] . "</p>"; } ?>

        <p>Role</p>
        <select name="role" id="role" required>
            <option value="mentor">Mentor</option>
            <option value="mentee">Mentee</option>
        </select><br><br>

        <input type="submit" name="submit" value="Register"> <br>
        <a href="workwise.html">Already have an account? Click here to login</a>
    </form>
</div>

</body>
</html>