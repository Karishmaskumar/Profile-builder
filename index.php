<!DOCTYPE html>
<html>
<head>
	<title>My To-Do List</title>
	<style>
		table {
			border-collapse: collapse;
			width: 70%;
			align: center;
			margin-left:auto;
			margin-right:auto;
		}

		th, td {
			text-align: left;
			padding: 8px;
		}

		th {
			background-color: black;
			color: white;
		}

		tr{
			background-color: white;
			border:1px solid black;
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
	</style>

</head>
<body>
	
	<?php
		// Connect to the database
		$db = mysqli_connect("localhost:3307", "root", "", "profile_builder");
		session_start();
		include 'mentee_header.php';
		?>
		<h1 style="text-align: center;color:white">My To-Do List</h1>
		<?php
		// Retrieve uname from session
		if (isset($_SESSION["uname"])) {
		  $uname = $_SESSION["uname"];
		} else {
		  // Redirect to signup page if uname is not set
		  header("Location: signup_mentee.php");
		  exit;
		}
		// Select all courses from the "courses" table
		$sql = "SELECT id, name FROM courses";
		$result = mysqli_query($db, $sql);

		// Check if there are any courses
		if (mysqli_num_rows($result) > 0) {
			// Display the to-do list
			echo '<table>';
			echo '<tr><th>Course</th><th>Status</th></tr>';
			while ($row = mysqli_fetch_assoc($result)) {
				$id=$row['id'];
				// Get the status of the course for the current user
				$sql2 = "SELECT status FROM user_courses WHERE uname = '$uname' AND course_id = " . $row['id'];
				$result2 = mysqli_query($db, $sql2);
				if (mysqli_num_rows($result2) > 0) {
					$row2 = mysqli_fetch_assoc($result2);
					$status = $row2['status'];
				} else {
					$status = "Not Started";
				}
				// Display the course and its status
				echo '<tr><td>' . $row['name'] . '</td><td>' . $status . '</td></tr>';

			}

				/*
				$sql = "SELECT * FROM courses INNER JOIN user_courses WHERE uname = '$uname' and course_id = $id";
				$result = $db->query($sql);
				if (!$result) {
					// Handle query error
					echo "Error executing query: " . mysqli_error($db);
				  } else if ($result->num_rows > 0) {
				  $row = $result->fetch_assoc();
				 /* $basic_info_complete = !empty($row['uname']);
				  $education_complete = !empty($row['degree']) && !empty($row['major']) && !empty($row['tech_skills']);
				  $experience_complete = !empty($row['areas_of_interest']) && !empty($row['job_titles']) && !empty($row['job_locations']) && !empty($row['experiences']);
				  */
			
				  
				/*$completed= trim($row['status']) == 'complete';
				$inprogress = trim($row['status']) == 'on_progress' ;
				$justset = trim($row['status']) == 'on_set';
				
				$completion_level = 0;
			
				if ($completed) {
					$completion_level =100;
				} 
				else if ($inprogress) {
					$completion_level = 30;
				}
				else{
					$justset =0;
				}
			  
			  // Create data table for pie chart
			  $data = array(
				array('Task', 'Completion Level'),
				array('Completed', $completion_level),
				array('Remaining', 100 - $completion_level)
			  );
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
					}
				  };
			
				  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
				  chart.draw(data, options);
				}
			  </script>
			  <div id='chart_div' style='width: 30%; height: 400px; position: absolute; top: 55%; right: 20%; transform: translateY(-55%);'></div>";
			  // Display completion percentage and remaining tasks
			  echo "<p>Your profile is $completion_level% complete.</p>";
			  if (!empty($remaining_tasks)) {
				echo "<p>The following tasks are remaining: " . implode(', ', $remaining_tasks) . "</p>";
			  }
			} else {
			  echo "User info not found";
			}
			}
			echo '</table>';
		} else {
			echo '<p>No courses found.</p>';
		}*/


	}
	?>


<?php
$sql = "SELECT status, COUNT(*) AS count FROM user_courses WHERE uname = '$uname' GROUP BY status";
$result = $db->query($sql);

if (!$result) {
  // Handle query error
  echo "Error executing query: " . mysqli_error($db);
} else if ($result->num_rows > 0) {
  $courses = array();
  $totalCourses = 0;
  
  while ($row = mysqli_fetch_assoc($result)) {
    $status = trim($row['status']);
    $count = (int)$row['count'];
    $courses[$status] = $count;
    $totalCourses += $count;
  }

  $completed = isset($courses['completed']) ? $courses['completed'] : 0;
  $inprogress = isset($courses['on_progress']) ? $courses['on_progress'] : 0;
  $justset = isset($courses['on_set']) ? $courses['on_set'] : 0;

  $data = array(
    array('Task', 'Completion Level'),
    array('Completed', $completed),
    array('In Progress', $inprogress),
    array('On Set', $justset),
  );

  $data_json = json_encode($data);

  // Display pie chart using Google Charts API
  echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
        <script type='text/javascript'>
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
            var data = google.visualization.arrayToDataTable($data_json);

            var options = {
              title: 'Course Completion Status',
              pieHole: 0.5,
              slices: {
                0: { color: '#2ecc71' },
                1: { color: '#e74c3c' },
                2: { color: '#3498db' },
              }
            };

            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
          }
        </script>
        <div id='chart_div' style='width:35%; height: 300px; position: absolute; top: 70%; right: 50; left: 33%;'></div>";

  /*// Display completion status and remaining tasks
  echo "<p>Out of $totalCourses courses:</p>";
  echo "<p>$completed courses are complete.</p>";
  echo "<p>$inprogress courses are in progress.</p>";
  echo "<p>$justset courses are on set.</p>";*/

  $db->close();
} else {
  echo "User info not found";
}
?>


</body>
</html>