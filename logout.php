<?php
// filename: logout.php, Jory Lord, cis355, 2015-02-26
// logs the current user out.

// ----- Connect to database -----
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: Login.php"); // Redirecting To Home Page
}
?>