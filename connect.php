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
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];

    // Validate and sanitize input
    $name = mysqli_real_escape_string($conn, $name);
    // You may want to hash the password for better security
    $pass = mysqli_real_escape_string($conn, $pass);
    $phone = mysqli_real_escape_string($conn, $phone);

    // SQL query to insert user registration data
    $sql = "INSERT INTO `register` (`name`, `pass`, `phone`) VALUES ('$name', '$pass', '$phone')";

    // Execute query
    $result = mysqli_query($conn, $sql);

    // Check for query success
    if ($result) {
        echo "Data Submitted";
    } else {
        echo "Query Failed: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
