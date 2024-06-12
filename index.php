<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "assignment-php"; 

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connection Successful<br>";

// SQL query to create a table
$sql = "CREATE TABLE IF NOT EXISTS phptable (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    user_id VARCHAR(50) NOT NULL,
    course_name VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'phptable' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $stmt = $conn->prepare("INSERT INTO phptable (name, email, user_id, course_name) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $user_id, $course_name);

    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_id= $_POST['user_id']; 
    $course_name = $_POST['course_name'];
    
    

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


$conn->close();
?>
