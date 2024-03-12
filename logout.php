<!-- logout.php -->
<?php
  // Start the session
  session_start();

  // Destroy all session data
  session_destroy();

  // Redirect to workwise.html
  header("Location: workwise.html");
  exit;
?>