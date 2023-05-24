<?php




$Aemail=$_POST['AdminEmail'];
$Apass=$_POST['AdminPass'];
$conn=new mysqli('localhost','root','','dentalcare');
if($conn->connect_error){
    die('Connection Failed : '.$conn->connect_error);
}
else{
    if (empty($Aemail) && empty($Apass)) {
        echo "Please enter your email and password.";
    }


    if (empty($Aemail) && !empty($Apass)) {
        echo "Please enter your email.";
    }


    if (!empty($Aemail) && empty($Apass)) {
        echo "Please enter your password5.";
    }


    if (!empty($Aemail) && !empty($Apass)) {
        $sql = "SELECT * FROM admin WHERE adminemail='$Aemail'";
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


            $qryStr = "insert into admin(adminemail,adminpass) values('$Aemail','$Apass')";
            $res = $conn->query($qryStr);
            echo
            "
                            <script>
                            alert('Admin Added Successfully');
                            document.location.href='test.php';
                            </script>
                            
                            
                            ";
            $conn->close();
        }
    }

}

?>