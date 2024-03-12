<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
	<style type="text/css">
		/* Add your CSS styles here */
           
/* Add your CSS styles here */

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body{
    padding-top : 800 px;
    padding-bottom : 700px;
    background-image: url("https://c4.wallpaperflare.com/wallpaper/83/667/620/blue-computer-backgrounds-wallpaper-preview.jpg");
    background-position: center;
    background-size: 100% 100%;
    position: relative;
    font-family: sans-serif;
}

.cust_profile_container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

.register-box {
  width: 70%;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  padding: 20px;
  color: #000;
  padding: 10px;
}

.Name {
  font-size: 28px;
  font-style: italic;
}

label {
  font-size: 18px;
  margin-bottom: 10px;
}

label[name="name"],
label[name="uname"],
label[name="email"],
label[name="phone"],
label[name="city"],
label[name="country"],
label[name="role"],
label[name="mentee_id"],
label[name="school_or_college"],
label[name="job_titles"],
label[name="job_locations"],
label[name="start_year"],
label[name="end_year"],
label[name="tech_skills"],
label[name="area_of_interest"] {
  font-style: italic;
  line-height: 100px;
}

h1 {
  margin: 0;
  padding: 0 0 20px;
  text-align: center;
  font-size: 28px;
  color: #fff;
}

.register-box p {
  margin: 0;
  padding: 0;
  font-weight: bold;
  color: #fff;
}

.register-box input,
.register-box textarea {
  width: 100%;
  margin-bottom: 20px;
  border: none;
  border-bottom: 1px solid #fff;
  background: transparent;
  outline: none;
  height: 30px;
  color: #fff;
  font-size: 13px;
}

.register-box textarea {
  height: 80px;
}

.register-box input[type="submit"] {
  border: none;
  outline: none;
  height: 30px;
  background: #fb2525;
  color: #fff;
  font-size: 18px;
  border-radius: 20px;
  cursor: pointer;
}

.register-box input[type="submit"]:hover {
  background: #ffffff;
  color: #000;
}

.register-box a {
  font-size: 15px;
  line-height: 20px;
  color: darkgrey;
}

.register-box a:hover {
  color: #57d3cd;
}

/* Additional CSS for aligning rows */

.form-row {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

	</style>
</head>
<body>
<!DOCTYPE html>
<html>
<head>
	<title>Profile Dashboard</title>
</head>
<body>
<?php
// Database connection details
$con = mysqli_connect("localhost:3307", "root", "", "profile_builder");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

session_start();
include("mentee_header.php");
// Retrieve uname from session
if (isset($_SESSION["uname"])) {
  $uname = $_SESSION["uname"];
} else {
  // Redirect to signup page if uname is not set
  header("Location: signup_mentee.php");
  exit;
}

// Retrieve existing user data from the database
// Retrieve existing user data from the database
$sql = "SELECT SIGNUP.fname, SIGNUP.lname, SIGNUP.uname, SIGNUP.email, SIGNUP.phone, SIGNUP.city, SIGNUP.country, SIGNUP.role, mentee.school_or_college, mentee.start_year, mentee.end_year, mentee.tech_skills, mentee.areas_of_interest, mentee.job_titles, mentee.job_locations FROM SIGNUP INNER JOIN mentee ON SIGNUP.uname = mentee.uname WHERE SIGNUP.uname = '$uname'";
$result = $con->query($sql);

// Check if the user exists in the database
if ($result->num_rows > 0) {
  // Fetch the user data
  $row = $result->fetch_assoc();
  $fname = $row["fname"];
  $lname = $row["lname"];
  $uname = $row["uname"];
  $email = $row["email"];
  $phone = $row["phone"];
  $city = $row["city"];
  $country = $row["country"];
  $role = $row["role"];
  $mentee_id = $row["mentee_id"];
  $school_or_college = $row["school_or_college"];
  $start_year = $row["start_year"];
  $end_year = $row["end_year"];
  $tech_skills = $_POST["tech_skills"];
  $areas_of_interest = $row["areas_of_interest"];
  $job_titles = $row["job_titles"];
  $job_locations = $row["job_locations"];
} else {
  echo "User not found.";
  exit;
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve the form data
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $city = $_POST["city"];
  $country = $_POST["country"];
  $school_or_college = $_POST["school_or_college"];
  $start_year = $_POST["start_year"];
  $end_year = $_POST["end_year"];
  $tech_skills = $_POST["tech_skills"];
  $areas_of_interest = $_POST["areas_of_interest"];
  $job_titles = $_POST["job_titles"];
  $job_locations = $_POST["job_locations"];

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format";
  }
  // Validate phone number format
  elseif (!preg_match("/^\d{10}$/", $phone)) {
    echo '<span style="color: red;">Invalid phone number format</span>';
  } else {
    // Update the user's profile information in the database
    $updateSql = "UPDATE SIGNUP INNER JOIN mentee ON SIGNUP.uname = mentee.uname SET
      SIGNUP.fname = '$fname',
      SIGNUP.lname = '$lname',
      SIGNUP.email = '$email',
      SIGNUP.phone = '$phone',
      SIGNUP.city = '$city',
      SIGNUP.country = '$country',
      mentee.school_or_college = '$school_or_college',
      mentee.start_year = '$start_year',
      mentee.end_year = '$end_year',
      mentee.tech_skills = '$tech_skills',
      mentee.areas_of_interest = '$areas_of_interest',
      mentee.job_titles = '$job_titles',
      mentee.job_locations = '$job_locations'
      WHERE SIGNUP.uname = '$uname'";
$query2 = "INSERT IGNORE INTO track (uname,tech_skills,areas_of_interest) VALUES ('$uname','$tech_skills','$areas_of_interest')";

$result = mysqli_query($con, $updateSql);
$result2 = mysqli_query($con, $query2);

if ($result && $result2) {
  // Redirect to login page
  header('Location: dashboard_mentee.php');
  exit();
} else {
  // Display error message
  echo "<div class='form'>
        <h3>Required fields are missing.</h3><br/>
        </div>";
}
}
}

// Close the database connection
$con->close();
?>
 <!DOCTYPE html>
    <html>
    <head>
      <title>Edit Profile</title>
    </head>
    <body>
</br></br>
      <h1>Edit Profile</h1>
      
      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Display existing data in input fields -->
        <label for="fname">First Name:</label>
        <input type="text" name="fname" value="<?php echo $fname; ?>"><br></br></br>

    
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" value="<?php echo $lname; ?>"><br><br></br>
    
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>"><br><br></br>
    
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $phone; ?>"><br><br></br>
    
        <label for="city">City:</label>
        <input type="text" name="city" value="<?php echo $city; ?>"><br><br></br>
    
        <label for="country">Country:</label>
        <input type="text" name="country" value="<?php echo $country; ?>"><br><br></br>
    
        <label for="school_or_college">School or College:</label>
        <input type="text" name="school_or_college" value="<?php echo $school_or_college; ?>"><br><br></br>
    
        <label for="start_year">Start Year:</label>
        <input type="text" name="start_year" value="<?php echo $start_year; ?>"><br><br></br>

        <label for="end_year">End Year:</label>
        <input type="text" name="end_year" value="<?php echo $end_year; ?>"><br><br></br>
    
        <label for="tech_skills">Technical Skills:</label>
        <input type="text" name="tech_skills" value="<?php echo $tech_skills; ?>"><br></br></br>
    
        <label for="areas_of_interest">Areas of Interest:</label>
        <input type="text" name="areas_of_interest" value="<?php echo $areas_of_interest; ?>"><br></br></br>
    
        <label for="job_titles">Job Titles:</label>
        <input type="text" name="job_titles" value="<?php echo $job_titles; ?>"><br></br></br>
    
        <label for="experience">Job Locations:</label>
        <textarea name="job_locations"><?php echo $job_locations; ?></textarea><br></br></br>
    
        <input type="submit" value="Save">
      </form>
    </body>
    </html>