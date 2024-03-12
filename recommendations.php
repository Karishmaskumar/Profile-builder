<!-- recommend.php -->
<!DOCTYPE html>
<html>
<head>
	<title>Recommendations</title>
</head>
<body>
	
	<?php
		// Connect to the database
		$servername = "localhost:3307";
		$username = "root";
		$password = "";
		$dbname = "profile_builder";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		}
		session_start();
		include 'mentee_header.php';
		// Retrieve uname from session
		if (isset($_SESSION["uname"])) {
		  $uname = $_SESSION["uname"];
		} 
		// Get the mentee's id from the URL parameter
		//$mentee_id = $_GET["id"];

		// Query to find matching mentors and their usernames
		$sql = "SELECT S.uname
				FROM Mentee E, Mentor M, Signup S
				WHERE E.uname = '$uname'
				AND E.areas_of_interest = M.areas_of_interest
				AND M.mentor_id = S.id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			echo "<h2>Recommended Mentors:</h2>";
			echo "<ul>";
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<li>".$row["uname"]."</li>";
		    }
		    echo "</ul>";
		} else {
		    echo "No recommended mentors found.";
		}

		// Close the database connection
		$conn->close();
	?>
</body>
</html>