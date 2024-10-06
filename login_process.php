<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mera_cafe";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetching data from the form
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Validate and sanitize input
    $name = mysqli_real_escape_string($conn, $name);
    $pass = mysqli_real_escape_string($conn, $pass);

    // SQL query to check user credentials using prepared statement
    $sql = "SELECT * FROM `register` WHERE `name`=? AND `pass`=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if a row is returned
    if (mysqli_stmt_num_rows($stmt) > 0) {
        header("Location: after-login.html");
        // Perform further actions, such as setting session variables
    } else {
        echo "Invalid username or password";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>
