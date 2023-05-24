<?php

$Demail=$_POST['AdminEmail1'];
$Dpass=$_POST['AdminPass1'];

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


        $sql = "SELECT * FROM admin WHERE adminemail='$Demail' AND adminpass='$Dpass'";
        $result = mysqli_query($conn, $sql);
// Check if any rows were returned

        if ($result->num_rows > 0) {

            $qryStr="Delete FROM admin WHERE adminemail='$Demail' AND adminpass='$Dpass'";
            $res=$conn->query($qryStr);

            echo
            "
                            <script>
                            alert('Admin Deleted.');
                            document.location.href='test.php';
                            </script>";



            $conn->close();
            exit;

        }
        else{
            echo
            "
                            <script>
                            alert('Admin Not Found.');
                            document.location.href='test.php';
                            </script>";



            $conn->close();
            exit;


        }


    }
}
?>