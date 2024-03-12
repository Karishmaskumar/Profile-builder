<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mentor Registration Form</title>
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
    width: 600px;
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
    background:#fb2525 ;
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
    </style>
  </head>
  <body>
  <?php
    $con = mysqli_connect("localhost", "root", "", "profile_builder");
    // Check connection
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    // When form submitted, insert values into the database.
  
        
      
      // Handle form submission
      session_start();

// Retrieve uname from session
if (isset($_SESSION["uname"])) {
  $uname = $_SESSION["uname"];
} else {
  // Redirect to signup page if uname is not set
  header("Location: signup_mentor.php");
  exit;
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mentor_id = $_POST['mentor_id'];
    $degree = $_POST['degree'];
    $major = $_POST['major'];
    $tech_skills = $_POST['tech_skills'];
    $areas_of_interest = $_POST['areas_of_interest'];
    $job_titles = $_POST['job_titles'];
    $job_locations = $_POST['job_locations'];
    $experience = $_POST['experience'];
     
        
        // Insert data into the database
        $query = "INSERT INTO mentor (mentor_id,uname,degree,major,tech_skills,areas_of_interest,job_titles,job_locations,experience)
        VALUES ('$mentor_id','$uname','$degree','$major','$tech_skills','$areas_of_interest','$job_titles','$job_locations','$experience')";
        $result = mysqli_query($con, $query);
        if ($result) {
          // Redirect to login page
          header('Location: dashboard_mentor.php');
          exit();
        } else {
          // Display error message
          echo "<div class='form'>
                <h3>Required fields are missing.</h3><br/>
                <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                </div>";
        }
    }
        else{
      
?>
 <div class="register-box">
      <h1>Mentor Registration Form</h1>
      <form class="form" action="" method="post">
      
      

      <label for="id">Mentor ID:</label>
        <input type="number" id="mentor_id" name="mentor_id" placeholder="Enter your mentor id" required>

        <label for="degree">Degree:</label>
        <input type="text" id="degree" name="degree" placeholder="Enter the degree..Eg:BTECH" required>

        <label for="major">Major:</label>
        <input type="text" id="major" name="major" placeholder="enter your major..Eg:Computer Science" required>

        <label for="tech_skills">Tech Skills:</label>
        <input type="text" id="tech_skills" name="tech_skills" placeholder="enter your technical skills..Eg:Java" required>

        <label for="areas_of_interest">Areas of Interest:</label>
        <input type="text" id="areas_of_interest" name="areas_of_interest"placeholder="enter your areas of interest..Eg:Artificial Intelligence" >

        <label for="job_titles">Job Titles:</label>
        <input type="text" id="job_titles" name="job_titles"placeholder="enter the job title..Eg:Data Scientist" >

        <label for="job_locations">Job Locations:</label>
        <input type="text" id="job_locations" name="job_locations"placeholder="Enter Job location..Eg:India">

        <label for="experience">Experience:</label>
        <input type="number" id="experience" name="experience"placeholder="Enter the years of job experience" >

        <input type="submit"  name="login" value="Submit">
      </form>
    </div>
    
<?php
    }
?>
</body>
</html>
