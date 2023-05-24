<?php

$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}


session_start();

if (isset($_SESSION['UserEmail'])) {
    $email = $_SESSION['UserEmail'];

    $sql = "SELECT doctors.doctorname, patients.patientemail, patients.patientphone, patients.pdate 
        FROM doctors, patients
        WHERE doctors.doctorname = patients.pdoc AND doctors.doctoremail='$email'
        ORDER BY patients.pdate ASC";

    $result = $conn->query($sql);

// Check if the query returned any rows
    if ($result->num_rows > 0) {
        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Add a new row to the HTML table
            echo "<tr>";
            echo "<td>" . $row["doctorname"] . "</td>";
            echo "<td>" . $row["patientemail"] . "</td>";
            echo "<td>" . $row["patientphone"] . "</td>";
            echo "<td>" . $row["pdate"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No results found.";
    }
}
else{
    header("Location: login.html");
    exit;
}
// Close the database connection
$conn->close();
?>