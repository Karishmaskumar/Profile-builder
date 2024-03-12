<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
* {box-sizing: border-box;}

body { 
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.header {
  overflow: hidden;
  background-color: black;
  padding: 20px 10px;
}

.header a {
  float: left;
  color: whitesmoke;
  text-align: center;
  padding: 12px;
  text-decoration: none;
  font-size: 18px; 
  line-height: 25px;
  border-radius: 4px;
}

.header a.logo {
  font-size: 25px;
  font-weight: bold;
}

.header a:hover {
    display: inline-block;
    padding: 10px 30px;
    font-weight: 300;
    text-decoration: none;
    border-radius: 200px;
    background-color: #0066b2;
    border: 1px solid #0066b2;
    color: #fff;
    transition: background-color 0.2s, border 0.2s, color 0.2s;
}

.header a.active {
    display: inline-block;
    padding: 10px 30px;
    font-weight: 300;
    text-decoration: none;
    border-radius: 200px;
    background-color: #0066b2;
    border: 1px solid #0066b2;
    color: #fff;
    transition: background-color 0.2s, border 0.2s, color 0.2s;
}

.header-right {
  float: right;
}

#notification {
  position: fixed;
  top: 75px;
  right: 0;
  width: 40%;
  background-color: #1c1b1bc2;
  padding: 10px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
  z-index: 9999;
}

@media screen and (max-width: 500px) {
  .header a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }
}
</style>
</head>
<body>

<div class="header">
    <img src="logo.JPG" height="70" width="70" alt="logo" class="logo">
  <div class="header-right">
    <a href="dashboard_mentee.php">Dashboard</a>
    <a href="recommendations_mentee.php">Recommendations</a>
    <a href="vertical-timeline.php">Track skills</a>
    <a href="add_course.php">Track progress</a>
    <a href="logout.php">Logout</a>
    <?php
    $con = mysqli_connect("localhost:3307", "root", "", "profile_builder");

    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
  
    //session_start();
    if (isset($_SESSION["uname"])) {
        $uname = $_SESSION["uname"];
      } else {
        // Redirect to signup page if uname is not set
        header("Location: signup_mentee.php");
        exit;
      }
    
    // Retrieve the user's notifications from the user_courses table
    $sql = "SELECT * FROM user_courses WHERE uname = '$uname'";
    $result = $con->query($sql);

// Array to store the notifications
$notifications = array();
$notification = "";

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $courseId = $row['course_id'];
    $status = $row['status'];
    $notification = "";

    if ($status === 'on_set') {
      $notification = "Congrats! You have started a new course.";
    } else if ($status === 'completed') {
      $notification = "Congrats! You have completed a course.";
    }

    // Add the notification to the array
    $notifications[$courseId] = $notification;
  }
}?>

    <div id="notification" class="dropdown">
    <div class="dropdown-content">
    <button onclick="closeNotification()">Close</button>
      <?php if (is_array($notifications)) {
        foreach ($notifications as $courseId => $notification) { ?>
            <a href="#"><?php echo $notification; ?></a>
            <?php }
        } else { ?>
          <p>No notifications</p>
        <?php }  ?>
        
      </div>
      
      
    </div>
</div>
<script>
function showNotification() {
  document.getElementById("notification").style.display = "block";
}
</script>
<script>
      function closeNotification() {
  document.getElementById("notification").style.display = "none";}

</script>


  </div>
</div>



</body>
</html>



