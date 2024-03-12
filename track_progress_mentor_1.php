<!DOCTYPE html>
<html>
<head>
	<title>To-Do List</title>
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
		include 'mentor_header.html';

		// Retrieve uname from the URL parameter
		if (isset($_GET["uname"])) {
			$uname = $_GET["uname"];
		} else {
			// Redirect to signup page if uname is not set
			header("Location: signup_mentee.php");
			exit;
		}
	?>
	</br>
	<h1 style="text-align: center;color:white">To-Do List for <?php echo $uname; ?></h1></br>

	<?php
		// Select all courses from the "courses" table
		$sql = "SELECT id, name FROM courses";
		$result = mysqli_query($db, $sql);

		// Check if there are any courses
		if (mysqli_num_rows($result) > 0) {
				// Display the to-do list
				echo '<table>';
				echo '<tr><th>Course</th><th>Status</th></tr>';
				while ($row = mysqli_fetch_assoc($result)) {
					$id = $row['id'];
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
				echo '</table>';
		} else {
			echo '<p>No courses found.</p>';
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

			$db->close();
		} else {
			echo "User info not found";
		}
	?>
</body>
</html>