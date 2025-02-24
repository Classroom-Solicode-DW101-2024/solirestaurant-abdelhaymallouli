<?php
session_start(); // Start the session

// Debugging: Print all session variables
echo "<pre>";
echo "Session variables in test.php:\n";
print_r($_SESSION);
echo "</pre>";

// Check if the client name is set in the session
if (isset($_SESSION['client_name'])) {
    echo "<h1>Welcome, " . htmlspecialchars($_SESSION['client_name']) . "!</h1>";
} else {
    echo "<h1>Welcome, Guest!</h1>";
    echo "<p>No client name found in the session.</p>";
}
?>