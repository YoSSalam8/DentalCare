<?php

    $Uemail=$_POST['UserEmail'];
    $Upass=$_POST['UserPass'];
    $conn=new mysqli('localhost','root','','dentalcare');
    if($conn->connect_error){
        die('Connection Failed : '.$conn->connect_error);
    }



    else{
        if (empty($Uemail) && empty($Upass)) {
            echo "Please enter your email and password.";
        }


        if (empty($Uemail) && !empty($Upass)) {
            echo "Please enter your email.";
        }


        if (!empty($Uemail) && empty($Upass)) {
            echo "Please enter your password.";
        }


        if (!empty($Uemail) && !empty($Upass)) {










            $sql = "SELECT * FROM patients WHERE patientemail='$Uemail'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                echo
                "
                            <script>
                            alert('Please try again with another email');
                            document.location.href='SIgnUp.html';
                            </script>
                            
                            
                            ";
                $conn->close();
            } else {

                $qryStr="insert into patients(patientemail,patientpass) values('$Uemail','$Upass')";
                $res=$conn->query($qryStr);

                echo
                "
                            <script>
                            alert('Email Registered Successfully');
                            document.location.href='log.php';
                            </script>
                            
                            
                            ";
                $conn->close();
            }




            $conn->close();

        }


    }

    ?>