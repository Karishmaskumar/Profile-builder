<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<style type="text/css">
           
*{
    margin: 50;
    padding: 50;
    
}
body{
    padding-top : 500 px;
    padding-bottom : 500px;
    background-image: url("https://c4.wallpaperflare.com/wallpaper/83/667/620/blue-computer-backgrounds-wallpaper-preview.jpg");
    background-position: center;
    background-size: 100% 100%;
    position: relative;
    font-family: sans-serif;
}



.register-box {
  width: 70%;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.3);
  color:antiquewhite;
  background-color: #000;
  margin: auto; 
  padding: 20px;
  margin-top:30px;
  width: 900px;
}

.Name {
  font-size: 28px;

  font-style: italic;
}

label {
  font-size: 18px;
  margin-bottom: 10px;
}

label[name="name"] {
  
  font-style: italic;
  line-height: 1.5;
}

label[name="uname"] {
  font-style: italic;
  line-height: 1.5;
}

label[name="email"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="phone"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="city"],
label[name="country"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="role"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="mentee_id"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="school_or_college"],
label[name="job_titles"],
label[name="job_locations"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="start_year"],
label[name="end_year"] {
    font-style: italic;
    line-height: 1.5;
}

label[name="tech_skills"],
label[name="area_of_interest"] {
  font-style: italic;
  line-height: 1.5;
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
  include 'mentor_header.html';
  // Retrieve uname from session
  if (isset($_SESSION["uname"])) {
    $uname = $_SESSION["uname"];
  } else {
    // Redirect to signup page if uname is not set
    header("Location: signup_mentor.php");
    exit;
  }

  // Query to retrieve data for the logged in user
  $sql = "SELECT SIGNUP.fname, SIGNUP.lname, SIGNUP.uname, SIGNUP.email, SIGNUP.phone, SIGNUP.city, SIGNUP.country, SIGNUP.role, mentor.mentor_id, mentor.degree, mentor.major, mentor.tech_skills, mentor.areas_of_interest, mentor.job_titles, mentor.experience FROM SIGNUP INNER JOIN mentor ON SIGNUP.uname = mentor.uname WHERE SIGNUP.uname = '$uname'";

  // Execute the query and get the result set
  $result = $con->query($sql);

  // Check if there are any results
  if ($result->num_rows > 0) {
    // Output data of the logged in user
    while ($row = $result->fetch_assoc()) {
      $fname = $row["fname"];
      $lname = $row["lname"];
      $uname = $row["uname"];
      $email = $row["email"];
      $phone = $row["phone"];
      $city = $row["city"];
      $country = $row["country"];
      $role = $row["role"];
      $mentor_id = $row["mentor_id"];
      $degree = $row["degree"];
      $major = $row["major"];
      $tech_skills = $row["tech_skills"];
      $areas_of_interest = $row["areas_of_interest"];
      $job_titles = $row["job_titles"];
      $experience = $row["experience"];
    }
  } else {
    echo "0 results";
  }

  // Close the database connection
  //$con->close();
?>

<div class="register-box">
  <br/>
  
  
  <h1>PROFILE DETAILS</h1>
  <!--<table>
    <tr>
      <td>Name</td>
      <td><?php // echo isset($fname) ? $fname : "N/A"; ?> <?php echo isset($lname) ? $lname : "N/A"; ?></td>
    </tr>
    <tr>
      <td>UserName:</td>
      <td><?php //echo isset($uname) ? $uname : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><?php //echo isset($email) ? $email : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Phone:</td>
      <td><?php //echo isset($phone) ? $phone : "N/A"; ?></td>
    </tr>
    <tr>
      <td>City:</td>
      <td><?php //echo isset($city) ? $city : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Country:</td>
      <td><?php //echo isset($country) ? $country : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Role:</td>
      <td><?php //echo isset($role) ? $role : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Mentor ID:</td>
      <td><?php //echo isset($mentor_id) ? $mentor_id : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Degree:</td>
      <td><?php //echo isset($degree) ? $degree : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Major :</td>
      <td><?php // echo isset($major) ? $major : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Technical skills :</td>
      <td><?php //echo isset($tech_skills) ? $tech_skills : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Areas of interest :</td>
      <td><?php //echo isset($areas_of_interest) ? $areas_of_interest : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Job titles:</td>
      <td><?php //echo isset($job_titles) ? $job_titles : "N/A"; ?></td>
    </tr>
    <tr>
      <td>Experience :</td>
      <td><?php //echo isset($experience) ? $experience : "N/A"; ?></td>
    </tr>
  </table>
</body>
</html>-->

<form method="POST" action="" id="myform">
	<div class="cust_profile_container">
		
		
			<div class="editable-field">
				<label for="fname">First Name:</label>
				<input type="text" id="fname" name="fname" value="<?php echo $fname ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="lname">Last Name:</label>
				<input type="text" id="lname" name="lname" value="<?php echo $lname ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="uname">Username:</label>
				<input type="text" id="uname" name="uname" value="<?php echo $uname ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="email">Email:</label>
				<input type="text" id="email" name="email" value="<?php echo $email ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="phone">Phone:</label>
				<input type="text" id="phone" name="phone" value="<?php echo $phone ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="city">City:</label>
				<input type="text" id="city" name="city" value="<?php echo $city ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="country">Country:</label>
				<input type="text" id="country" name="country" value="<?php echo $country ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="role">Role:</label>
				<input type="text" id="role" name="role" value="<?php echo $role ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="mentor_id">Mentor ID:</label>
				<input type="text" id="mentor_id" name="mentor_id" value="<?php echo $mentor_id ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="degree">Degree:</label>
				<input type="text" id="degree" name="degree" value="<?php echo $degree ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="major">Major:</label>
				<input type="text" id="major" name="major" value="<?php echo $major ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="tech_skills">Tech Skills:</label>
				<input type="text" id="tech_skills" name="tech_skills" value="<?php echo $tech_skills ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="areas_of_interest">Areas of Interest:</label>
				<input type="text" id="areas_of_interest" name="areas_of_interest" value="<?php echo $areas_of_interest ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="job_titles">Job Titles:</label>
				<input type="text" id="job_titles" name="job_titles" value="<?php echo $job_titles ?>"readonly>
			</div>
			<div class="editable-field">
				<label for="experience">Experience:</label>
				<input type="text" id="experience" name="experience" value="<?php echo $experience ?>"readonly>
        <a href="edit_profile.php">Edit profile</a>
			</div>
		</div>


    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 

    <script> 
$(document).ready(function() { 
  $('#saveChanges').click(function() { 
    $.ajax({ 
      type: 'POST', 
      url: 'update_profile.php', 
      data: $('#myform').serialize(), 
      success: function(response) { 
        // Handle success response 
        console.log('Form submitted successfully'); 
        alert(response); 
      }, 
      error: function(xhr, status, error) { 
        // Handle error response 
        console.log('Form submission error: ' + error); 
        alert('Error updating profile: ' + error); 
      } 
    }); 
  }); 
}); </script>
   



    
    <?php 
    



    $sql = "SELECT * FROM mentor WHERE mentor_id =$mentor_id";
    $result = $con->query($sql);
    if (!$result) {
        // Handle query error
        echo "Error executing query: " . mysqli_error($con);
      } else if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
     /* $basic_info_complete = !empty($row['uname']);
      $education_complete = !empty($row['degree']) && !empty($row['major']) && !empty($row['tech_skills']);
      $experience_complete = !empty($row['areas_of_interest']) && !empty($row['job_titles']) && !empty($row['job_locations']) && !empty($row['experiences']);
      */

      
    $education_complete = trim($row['degree']) != '' && trim($row['major']) != '' && trim($row['tech_skills']) != '';
    $experience_complete = trim($row['areas_of_interest']) != '' && trim($row['job_titles']) != '' && trim($row['job_locations']) != '' && trim($row['experience']) != '';
      $completion_level = 0;

    if ($education_complete) {
        $completion_level =50;
    } 
    if ($experience_complete) {
        $completion_level += 50;
    }
    else{
        $completion_level =50;
    }
  
  // Create data table for pie chart
  $data = array(
    array('Task', 'Completion Level'),
    array('Completed', $completion_level),
    array('Remaining', 100 - $completion_level)
  );
  echo "Completion level: " . $completion_level . "%";
  $data_json = json_encode($data);
  
  // Display pie chart using Google Charts API
  echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
  <script type='text/javascript'>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable($data_json);

      var options = {
        title: 'Profile Completion',
        pieHole: 0.5,
        slices: {
          0: { color: '#2ecc71' },
          1: { color: '#e74c3c' }
        },
        backgroundColor: 'black',
        titleTextStyle: {
          color: 'white'
        },
        legendTextStyle: {
          color: 'white'
        }
      };

      var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
  </script>
  <div id='chart_div' style='width: 35%; height: 300px; position: absolute; top: 87%; right: 50; left: 33%; transform: translateY(-55%);'></div>";
  // Display completion percentage and remaining tasks
  
  if (!empty($remaining_tasks)) {
    echo "<p>The following tasks are remaining: " . implode(', ', $remaining_tasks) . "</p>";
  }
} else {
  echo "User info not found";
}

$con->close();

?>

</body>
</html>