<?php



$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
$sql = $sql = "SELECT doctors.doctorname, patients.patientemail, patients.patientphone, patients.pdate 
        FROM doctors, patients
        WHERE doctors.doctorname = patients.pdoc
        ORDER BY patients.pdate ASC";
$result = $conn->query($sql);

// Fetch the data and output it as JSON
if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = array_values($row);
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}

// Close the connection
$conn->close();
?>


?>