<?php

$Demail=$_POST['DocEmail'];
$Dpass=$_POST['DocPass'];
$Dname=$_POST['DocName'];
$Dser=$_POST['service'];
$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    if (empty($Demail) && empty($Dpass)) {
        echo "Please enter your email and password.";
    }


    if (empty($Demail) && !empty($Dpass)) {
        echo "Please enter your email.";
    }


    if (!empty($Demail) && empty($Dpass)) {
        echo "Please enter your password22.";
    }

    if(empty($Dname)){
        echo"Please Enter Doctor's Name";
    }

    if(empty($Dser)){
        echo"Please Enter The Doctor's Service Number";
    }

    if (!empty($Demail) && !empty($Dpass) && !empty($Dname) && !empty($Dser)) {

        $sql = "SELECT * FROM doctors WHERE doctoremail='$Demail'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            echo
            "
                            <script>
                            alert('This Email Has Been Taken.Please try again with another email');
                            document.location.href='test.php';
                            </script>
                            
                            
                            ";
            $conn->close();
        } else {


            $qryStr = "insert into doctors(doctoremail,doctorpass,doctorname,ser_id) values('$Demail','$Dpass','$Dname','$Dser')";
            $res = $conn->query($qryStr);
            echo
            "
                            <script>
                            alert('Doctor Added Successfully');
                            document.location.href='test.php';
                            </script>
                            
                            
                            ";
            $conn->close();
        }

    }
}

?>