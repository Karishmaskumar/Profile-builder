<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Mentee Registration Form</title>
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
  header("Location: signup_mentee.php");
  exit;
}

// If form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$mentee_id = $_POST['mentee_id'];
$school_or_college = $_POST['school_or_college'];
$start_year = $_POST['start_year'];
$end_year = $_POST['end_year'];
$tech_skills = $_POST['tech_skills'];
$areas_of_interest = $_POST['areas_of_interest'];
$job_titles = $_POST['job_titles'];
$job_locations = $_POST['job_locations'];
        
        // Insert data into the database
        $query = "INSERT INTO MENTEE(mentee_id,uname,school_or_college,start_year,end_year,tech_skills,areas_of_interest,job_titles,job_locations)
                  VALUES ('$mentee_id','$uname','$school_or_college','$start_year','$end_year','$tech_skills','$areas_of_interest','$job_titles','$job_locations')";
        $query2 = "INSERT INTO track (uname,tech_skills,areas_of_interest) VALUES ('$uname','$tech_skills','$areas_of_interest')";
        
        $result = mysqli_query($con, $query);

        $result2 = mysqli_query($con, $query2);
        if ($result) {
          // Redirect to login page
          header('Location: dashboard_mentee.php');
          exit();
        } else {
          // Display error message
          echo "<div class='form'>
                <h3>Required fields are missing.</h3><br/>
                </div>";
        }

        if ($result2) {
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
        else{
?>
 <div class="register-box">
      <h1>Mentee Registration Form</h1>
      <form class="form" action="" method="post">
      
      

        <label for="mentee_id">Mentee ID:</label>
        <input type="number" id="mentee_id" name="mentee_id" placeholder="Enter your mentee id" required>

        <label for="school_or_college">School/college:</label>
        <input type="text" id="school_or_college" name="school_or_college" placeholder="Enter your school/college name" required>

        <label for="start_year">Start Year:</label>
        <input type="number" id="start_year" name="start_year" placeholder="enter the start year.." required>

        <label for="end_year">End Year:</label>
        <input type="number" id="end_year" name="end_year" placeholder="enter the end year.." required>

        <label for="tech_skills">Technical Skills:</label>
        <input type="text" id="tech_skills" name="tech_skills" placeholder="enter your technical skills..Eg:C" >

        <label for="areas_of_interest">Areas of Interest:</label>
        <input type="text" id="areas_of_interest" name="areas_of_interest" placeholder="enter the areas of interest..Eg:Artificial Engineering" >

        <label for="job_titles">Job Title:</label>
        <input type="text" id="job_titles" name="job_titles" placeholder="Enter Job Title..Eg:Data Scientist">

        <label for="job_locations">Job_locations:</label>
        <input type="text" id="job_locations" name="job_locations" placeholder="Enter Job location..Eg:India">

        <input type="submit"  name="login" value="Submit">
      </form>
    </div>
    
<?php
    }
?>
</body>
</html>
