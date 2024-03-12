<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
* {box-sizing: border-box;}
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
</body>
<?php

$connect = new PDO("mysql:host=localhost;dbname=profile_builder", "root", "");
session_start();
  include 'mentor_header.html';
  // Retrieve uname from session
  if (isset($_SESSION["uname"])) {
    $uname = $_SESSION["uname"];
  } 
  else {
    // Redirect to signup page if uname is not set
      $uname = ""; // Default value if uname is not set
}

// Check if the uname parameter is passed in the URL
if (isset($_GET["uname"])) {
    $uname = $_GET["uname"];
}
//$uname = $_SESSION["uname"];
//$uname = "janedoe";
// Query the database to retrieve the user's data
$query = "SELECT * FROM track WHERE uname = '$uname'";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();


?>

<html>  
    <head>  
        <title>PROGRESS TRACKER</title>
        <script src="js/jquery.js"></script>
        <script src="js/timeline.min.js"></script>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/timeline.min.css" />
		<style>
            .timeline__item{
                background-color: #B9D9EB;
            }
            .timeline__content{
                background-color: #B9D9EB;
            }
            .panel-title{
                font-size: 25px;
            }
        </style>
    </head>  
    <body>  
        <div class="container">
			<br />
			<h3 align="center" ><a href=""><span style="color:white">SKILL TRACKER</span></a></h3><br />

			<div class="panel panel-default" style="background-color: transparent;">
				<div class="panel-heading">
                    <h2 class="panel-title">YOUR JOURNEY</h2>
                </div>
                <div class="panel-body">
                	<div class="timeline">
                        <div class="timeline__wrap">
                            <div class="timeline__items">
                            <?php
                            foreach($result as $row)
                            {
                            ?>
                            	<div class="timeline__item">
                                    <div class="timeline__content">
                                    	<h2><?php echo $row["tech_skills"]; ?></h2>
                                    	<p><?php echo $row["entry_datetime"]; ?></p>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
    </body>  
</html>

<script>
$(document).ready(function(){
    jQuery('.timeline').timeline();
});
</script>