<?php



$conn=new mysqli('localhost','root','','dentalcare');

// Query the database to retrieve data from the doctors and patients tables
$sql = "SELECT doctors.doctorname, patients.patientemail, patients.patientphone, patients.pdate 
        FROM doctors, patients
        WHERE doctors.doctorname = patients.pdoc
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

// Close the database connection
$conn->close();


?>