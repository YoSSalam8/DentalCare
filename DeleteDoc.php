<?php

$Demail=$_POST['DocEmail1'];
$Dpass=$_POST['DocPass1'];

$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else {
    if (empty($Demail) && empty($Dpass)) {
        echo "Please enter your email and password.";
    }


    if (empty($Demail) && !empty($Dpass)) {
        echo "Please enter your email.";
    }


    if (!empty($Demail) && empty($Dpass)) {
        echo "Please enter your password.";
    }


    if (!empty($Dpass) && !empty($Demail)) {


        $sql = "SELECT * FROM doctors WHERE doctoremail='$Demail' AND doctorpass='$Dpass'";
        $result = mysqli_query($conn, $sql);
// Check if any rows were returned

        if ($result->num_rows > 0) {

            $qryStr="Delete FROM doctors WHERE doctoremail='$Demail' AND doctorpass='$Dpass'";
            $res=$conn->query($qryStr);

            echo
            "
                            <script>
                            alert('Doctor Deleted.');
                            document.location.href='test.php';
                            </script>";



            $conn->close();
            exit;

        }
        else{
            echo
            "
                            <script>
                            alert('Doctor Not Found.');
                            document.location.href='test.php';
                            </script>";



            $conn->close();
            exit;


        }


    }
}
?>