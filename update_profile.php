<?php
	// Database connection details
	$con = mysqli_connect("localhost:3307", "root", "", "profile_builder");
	// Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	// Get the username from the session variable
	session_start();
	if (isset($_SESSION["uname"])) {
		$uname = $_SESSION["uname"];
	} else {
		echo "Error updating profile: uname variable is not defined";
		exit();
	}

	// Get form data
	$degree = isset($_POST["degree"]);
	$major = isset($_POST["major"]);
	$tech_skills = isset($_POST["tech_skills"]);
	$areas_of_interest = isset($_POST["areas_of_interest"]);
	$job_titles = isset($_POST["job_titles"]);
    $job_locations=isset($_POST["job_locations"]);
	$experience = isset($_POST["experience"]);
    var_dump($_POST);

	// Update the database with the new values
	if (!empty($degree) && !empty($major)) {
		$sql = "UPDATE mentor INNER JOIN SIGNUP ON SIGNUP.uname = mentor.uname SET mentor.degree = '$degree', mentor.major = '$major', mentor.tech_skills = '$tech_skills', mentor.areas_of_interest = '$areas_of_interest', mentor.job_titles = '$job_titles', mentor.experience = '$experience' WHERE SIGNUP.uname = '$uname'";
	}else {
		$sql = "UPDATE mentor INNER JOIN SIGNUP ON SIGNUP.uname = mentor.uname SET mentor.tech_skills = '$tech_skills', mentor.areas_of_interest = '$areas_of_interest', mentor.job_titles = '$job_titles', mentor.experience = '$experience' WHERE SIGNUP.uname = '$uname'";
	}

	if (mysqli_query($con, $sql)) {
		echo "Profile updated successfully";
	} else {
		echo "Error updating profile: " . mysqli_error($con);
	}

	// Close the database connection
	$con->close();
    //header('Location:dashtry1.php');
    //exit()
?>