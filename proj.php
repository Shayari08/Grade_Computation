<?php
// Database connection details
$servername = "localhost";
$username = "root@localhost";
$password = "1_Direction";
$dbname = "proj";

// Establish a connection to the MySQL database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to fetch all records from the `grades` table
function getAllGrades() {
    global $conn;
    
    $sql = "SELECT * FROM grades";
    $result = mysqli_query($conn, $sql);
    
    $grades = array();
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $grades[] = $row;
        }
    }
    
    return $grades;
}

// Function to insert a new record into the `grades` table
function insertGrade($grade, $minScore, $maxScore) {
    global $conn;
    
    $sql = "INSERT INTO grades (grade, min_score, max_score)
            VALUES ('$grade', $minScore, $maxScore)";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a record from the `grades` table
function deleteGrade($grade) {
    global $conn;
    
    $sql = "DELETE FROM grades WHERE grade = '$grade'";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

// Example usage

// Retrieve all records from the `grades` table
$grades = getAllGrades();

// Display the retrieved records
foreach ($grades as $grade) {
    echo "Grade: " . $grade['grade'] . "<br>";
    echo "Minimum Score: " . $grade['min_score'] . "<br>";
    echo "Maximum Score: " . $grade['max_score'] . "<br><br>";
}

// Insert a new record
if (insertGrade("NewGrade", 90, 95)) {
    echo "New record inserted successfully!";
} else {
    echo "Failed to insert new record.";
}

// Delete a record
if (deleteGrade("F")) {
    echo "Record deleted successfully!";
} else {
    echo "Failed to delete record.";
}

// Close the database connection
mysqli_close($conn);
?>
