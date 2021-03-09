<?php
function Logout()
{
  session_start(); // Start Session / Resume Current Session
  session_destroy(); // Destroy Session
  header("Location: ../View/index.php"); // Redirect to index page
}
?>
