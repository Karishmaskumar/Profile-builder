<?php
// Connect to database
$conn = mysqli_connect('localhost:3307', 'root', '', 'profile_builder');
if (!$conn) {
  die('Connection failed: ' . mysqli_connect_error());
}
session_start();
  include 'mentee_header.php';
  // Retrieve uname from session
  if (isset($_SESSION["uname"])) {
    $uname = $_SESSION["uname"];
  } else {
    // Redirect to signup page if uname is not set
    header("Location: signup_mentee.php");
    exit;
  }

// Retrieve courses from courses table that are associated with the user
$sql = "SELECT courses.id, courses.name
        FROM courses
        INNER JOIN user_courses
        ON courses.id = user_courses.course_id
        WHERE user_courses.uname = '$uname'
        ";
$result = mysqli_query($conn, $sql);

// Handle form submission
if (isset($_POST['course_id']) && isset($_POST['status'])) {
  // Sanitize user input
  $course_id = mysqli_real_escape_string($conn, $_POST['course_id']);
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  
  // Update status of selected course
  $sql = "UPDATE user_courses
          SET status = '$status'
          WHERE uname = '$uname'
          AND course_id = '$course_id'";
  mysqli_query($conn, $sql);
  
  // Redirect to same page to prevent form resubmission on page refresh
  header('Location: update_status.php');
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Update Course Status</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
      body{
    padding-top : 600 px;
    padding-bottom : 500px;
    background-image: url("https://c4.wallpaperflare.com/wallpaper/83/667/620/blue-computer-backgrounds-wallpaper-preview.jpg");
    background-position: center;
    background-size: 100% 100%;
    position: relative;
    font-family: sans-serif;
}
select {
			padding: 10px;
			border: none;
			border-radius: 5px;
			background-color: #f2f2f2;
			font-size: 16px;
			cursor: pointer;
		}

		input[type="submit"] {
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			background-color: #0066b2;
			color: white;
			font-size: 16px;
			cursor: pointer;
		}
    label {
      font-size: 20px;
  display: block;
  margin-bottom: 10px;
}
      </style>
  </head>
  <body>
    <h1>Update Course Status</h1>
    <form method="POST" action="update_status.php">
      <label for="course_id">Select Course:</label>
      <select id="course_id" name="course_id">
        <?php
          // Loop through courses and create dropdown options
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
          }
        ?>
      </select><br><br>
      <label for="status">New Status:</label>
      <select id="status" name="status">
        <option value="on_set">On Set</option>
        <option value="on_progress">On Progress</option>
        <option value="completed">Completed</option>
      </select><br><br>
      <input type="submit" value="Update Status">
    </form>
  </body>
</html>